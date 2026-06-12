<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Users Control') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/users/index.css'])
</head>
<body>
@include('components/header_adm')

<main>
    <h1>{{ __('Users') }}</h1>

    <!--Flash-->
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

        <!--Card 1: Search + filter tabs-->
    <section class="card">

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="search-row" id="search-form">
            <input
                type="text"
                name="search"
                id="search-input"
                value="{{ request('search') }}"
                placeholder="{{ __('Search by username, email or ID…') }}"
                autocomplete="off"
            >
            <!--keep active filter when searching-->
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="total">
                {{ __('Total Users:') }} <strong>{{ $totalUsers }}</strong>
            </span>
        </form>

        <!--Filter tabs-->
        <div class="filters">
            @php
                $active = request('filter', 'all');
            @endphp

            @foreach([
                'all'      => __('All Users'),
                'active'   => __('Active Users'),
                'inactive' => __('Inactive Users'),
                'admin'    => __('Admin Users'),
            ] as $key => $label)
                <a
                    href="{{ request()->fullUrlWithQuery(['filter' => $key, 'page' => 1]) }}"
                    class="btn {{ $active === $key ? 'active' : '' }}"
                >{{ $label }}</a>
            @endforeach

            <a href="{{ route('admin.users.create') }}" class="btn create">
                + {{ __('Create User') }}
            </a>
        </div>

    </section>

    <br>

    <!--Card 2: Table-->
    <section class="card">
        <table>
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('USERNAME') }}</th>
                    <th>{{ __('EMAIL') }}</th>
                    <th>{{ __('USER TYPE') }}</th>
                    <th>{{ __('STATUS') }}</th>
                    <th>{{ __('ACTIONS') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="td-id">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td class="td-email">{{ $user->email }}</td>

                        <!--Role dropdown-->
                        <td>
                            <div class="inline-select-wrap">
                                <select
                                    class="inline-select"
                                    data-user="{{ $user->id }}"
                                    data-field="role"
                                    data-url="{{ route('admin.users.field', $user) }}"
                                >
                                    <option value="client"  {{ $user->role   === 'client' ? 'selected' : '' }}>{{ __('Client') }}</option>
                                    <option value="admin"   {{ $user->role   === 'admin'  ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                </select>
                                <span class="select-arrow">▾</span>
                            </div>
                        </td>

                        <!--Status dropdown-->
                        <td>
                            <div class="inline-select-wrap">
                                <select
                                    class="inline-select"
                                    data-user="{{ $user->id }}"
                                    data-field="status"
                                    data-url="{{ route('admin.users.field', $user) }}">
                                    <option value="active"   {{ $user->status === 'active'   ? 'selected' : '' }}>{{ __('Active') }}</option>
                                    <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                </select>
                                <span class="select-arrow">▾</span>
                            </div>
                        </td>

                        <!--Actions-->
                        <td class="td-actions">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit">
                                {{ __('Edit') }}
                            </a>
                            <a href="{{ route('admin.users.delete', $user) }}" class="btn-action btn-delete"
                               onclick="return confirm('{{ __('Delete this user?') }}')">
                                {{ __('Delete') }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">{{ __('No users found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!--Pagination-->
        <div class="pagination">
            <!--Previous-->
            @if($users->onFirstPage())
                <span class="page-arrow disabled">«</span>
            @else
                <a class="page-arrow" href="{{ $users->previousPageUrl() }}">«</a>
            @endif

            <!--Page numbers-->
            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if($page === $users->currentPage())
                    <span class="page active">{{ $page }}</span>
                @elseif($page === 1 || $page === $users->lastPage() || abs($page - $users->currentPage()) <= 2)
                    <a class="page" href="{{ $url }}">{{ $page }}</a>
                @elseif(abs($page - $users->currentPage()) === 3)
                    <span class="page-ellipsis">…</span>
                @endif
            @endforeach

            <!--Next-->
            @if($users->hasMorePages())
                <a class="page-arrow" href="{{ $users->nextPageUrl() }}">»</a>
            @else
                <span class="page-arrow disabled">»</span>
            @endif
        </div>

    </section>
</main>

<script>
(function () {
    'use strict'

    //Live search
    const searchInput = document.getElementById('search-input')
    const searchForm  = document.getElementById('search-form')
    let   searchTimer = null

    searchInput?.addEventListener('input', () => {
        clearTimeout(searchTimer)
        searchTimer = setTimeout(() => searchForm.submit(), 400)
    })

    searchInput?.addEventListener('keydown', e => {
        if (e.key === 'Enter') { clearTimeout(searchTimer); searchForm.submit() }
    })

    //Inline role / status update (AJAX) 
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content
                 ?? '{{ csrf_token() }}'

    document.querySelectorAll('.inline-select').forEach(select => {
        // store original value to revert on error
        let lastValue = select.value

        select.addEventListener('change', async () => {
            const url   = select.dataset.url
            const field = select.dataset.field
            const value = select.value
            const wrap  = select.closest('.inline-select-wrap')

            wrap.classList.add('saving')

            try {
                const res = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ field, value }),
                })

                if (!res.ok) throw new Error('Server error')

                lastValue = value
                wrap.classList.remove('saving')
                wrap.classList.add('saved')
                setTimeout(() => wrap.classList.remove('saved'), 1500)

                // Update row style based on status
                if (field === 'status') {
                    const row = select.closest('tr')
                    row.classList.toggle('row-inactive', value === 'inactive')
                }

            } catch {
                select.value = lastValue
                wrap.classList.remove('saving')
                wrap.classList.add('error')
                setTimeout(() => wrap.classList.remove('error'), 2000)
                alert('{{ __("Failed to update. Please try again.") }}')
            }
        })
    })

    // Mark inactive rows on load
    document.querySelectorAll('.inline-select[data-field="status"]').forEach(s => {
        if (s.value === 'inactive') s.closest('tr')?.classList.add('row-inactive')
    })
})()
</script>

</body>
</html>