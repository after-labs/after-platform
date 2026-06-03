<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Orders') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/backend/orders/index.css'])
</head>
<body>
@include('components/header_adm')

<main>
    <h1>{{ __('Orders') }}</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- ── Card 1: Search + filtros ── --}}
    <section class="card">

        <form method="GET" action="{{ route('admin.orders.index') }}"
              class="search-row" id="search-form">
            <input
                type="text"
                name="search"
                id="search-input"
                value="{{ request('search') }}"
                placeholder="{{ __('Search by customer name, email or order ID…') }}"
                autocomplete="off"
            >
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="total">
                {{ __('Total Orders:') }} <strong>{{ $totalOrders }}</strong>
            </span>
        </form>

        <div class="filters">
            @php $active = request('filter', 'all'); @endphp

            @foreach([
                'all'         => __('All'),
                'in_progress' => __('In Progress'),
                'completed'   => __('Completed'),
                'refused'     => __('Refused'),
            ] as $key => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $key, 'page' => 1]) }}"
                   class="btn {{ $active === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach

            <span class="filter-sep">|</span>

            @foreach([
                'today' => __('Today'),
                'week'  => __('This Week'),
                'month' => __('This Month'),
            ] as $key => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $key, 'page' => 1]) }}"
                   class="btn {{ $active === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

    </section>

    <br>

    {{-- ── Card 2: Tabela ── --}}
    <section class="card">
        <table>
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('CUSTOMER') }}</th>
                    <th>{{ __('EMAIL') }}</th>
                    <th>{{ __('TOTAL') }}</th>
                    <th>{{ __('STATUS') }}</th>
                    <th>{{ __('DATE') }}</th>
                    <th>{{ __('DETAILS') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="{{ $order->status === 'refused' ? 'row-refused' : '' }}">
                        <td class="td-id">{{ $order->id }}</td>
                        <td>{{ $order->user?->name ?? '—' }}</td>
                        <td class="td-email">{{ $order->user?->email ?? '—' }}</td>

                        <td class="td-total">${{ number_format($order->total, 2) }}</td>

                        {{-- Status inline --}}
                        <td>
                            <div class="inline-select-wrap">
                                <select
                                    class="inline-select status-select"
                                    data-url="{{ route('admin.orders.status', $order) }}"
                                    data-status="{{ $order->status }}"
                                >
                                    <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                    <option value="completed"   {{ $order->status === 'completed'   ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                    <option value="refused"     {{ $order->status === 'refused'     ? 'selected' : '' }}>{{ __('Refused') }}</option>
                                </select>
                                <span class="select-arrow">▾</span>
                            </div>
                        </td>

                        <td class="td-date">
                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                            
                        </td>

                        {{-- Botão que abre o popup --}}
                        <td>
                            <button
                                type="button"
                                class="btn-details"
                                data-order="{{ json_encode([
                                    'id'         => $order->id,
                                    'customer'   => $order->user?->name ?? '—',
                                    'email'      => $order->user?->email ?? '—',
                                    'date'       => $order->created_at->format('d/m/Y H:i'),
                                    'total'      => number_format($order->total, 2),
                                    'status'     => $order->status,
                                    'items'      => $order->items->map(fn($i) => [
                                        'name'     => $i->gameVersion?->game?->name ?? '—',
                                        'edition'  => $i->gameVersion?->edition_name ?? '',
                                        'platform' => $i->gameVersion?->platform?->name ?? '',
                                        'units'    => $i->units,
                                        'price'    => number_format($i->price, 2),
                                        'subtotal' => number_format($i->units * $i->price, 2),
                                        'image'    => asset($i->gameVersion?->game?->media->where('type','poster')->first()?->path
                                                      ?? $i->gameVersion?->game?->media->where('type','banner')->first()?->path
                                                      ?? ''),
                                    ])->values()
                                ]) }}"
                            >{{ __('Details') }}</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">{{ __('No orders found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            @if($orders->onFirstPage())
                <span class="page-arrow disabled">«</span>
            @else
                <a class="page-arrow" href="{{ $orders->previousPageUrl() }}">«</a>
            @endif

            @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                @if($page === $orders->currentPage())
                    <span class="page active">{{ $page }}</span>
                @elseif($page === 1 || $page === $orders->lastPage() || abs($page - $orders->currentPage()) <= 2)
                    <a class="page" href="{{ $url }}">{{ $page }}</a>
                @elseif(abs($page - $orders->currentPage()) === 3)
                    <span class="page-ellipsis">…</span>
                @endif
            @endforeach

            @if($orders->hasMorePages())
                <a class="page-arrow" href="{{ $orders->nextPageUrl() }}">»</a>
            @else
                <span class="page-arrow disabled">»</span>
            @endif
        </div>
    </section>
</main>

{{-- ══════════════════════════════════════
     ORDER DETAILS POPUP
     ══════════════════════════════════════ --}}
<div id="order-modal" class="modal-backdrop" aria-hidden="true">
    <div class="modal-box" role="dialog">

        <div class="modal-header">
            <div class="modal-title-row">
                <h3>{{ __('Order Details') }}</h3>
                <span class="modal-order-id"></span>
            </div>
            <button type="button" class="modal-close" id="modal-close">✕</button>
        </div>

        {{-- Info grid --}}
        <div class="modal-info-grid">
            <div class="info-cell">
                <span class="info-label">{{ __('Customer') }}</span>
                <span class="info-value" id="m-customer"></span>
            </div>
            <div class="info-cell">
                <span class="info-label">{{ __('Email') }}</span>
                <span class="info-value" id="m-email"></span>
            </div>
            <div class="info-cell">
                <span class="info-label">{{ __('Date') }}</span>
                <span class="info-value" id="m-date"></span>
            </div>
            <div class="info-cell">
                <span class="info-label">{{ __('Total') }}</span>
                <span class="info-value" id="m-total"></span>
            </div>
            <div class="info-cell">
                <span class="info-label">{{ __('Status') }}</span>
                <span class="info-value" id="m-status"></span>
            </div>
        </div>

        {{-- Items --}}
        <p class="items-label">{{ __('Items') }}</p>
        <div class="modal-items" id="m-items"></div>

    </div>
</div>

<script>
(function () {
    'use strict'

    /* ── Live search ── */
    const searchInput = document.getElementById('search-input')
    const searchForm  = document.getElementById('search-form')
    let searchTimer   = null

    searchInput?.addEventListener('input', () => {
        clearTimeout(searchTimer)
        searchTimer = setTimeout(() => searchForm.submit(), 400)
    })
    searchInput?.addEventListener('keydown', e => {
        if (e.key === 'Enter') { clearTimeout(searchTimer); searchForm.submit() }
    })

    /* ── Inline status update ── */
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content

    document.querySelectorAll('.status-select').forEach(select => {
        let lastValue = select.value
        applyColor(select, lastValue)

        select.addEventListener('change', async () => {
            const wrap = select.closest('.inline-select-wrap')
            const row  = select.closest('tr')
            wrap.classList.add('saving')

            try {
                const res = await fetch(select.dataset.url, {
                    method: 'PATCH',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                    body: JSON.stringify({ status: select.value }),
                })
                if (!res.ok) throw new Error()

                lastValue = select.value
                applyColor(select, lastValue)
                row.classList.toggle('row-refused', lastValue === 'refused')
                wrap.classList.remove('saving')
                wrap.classList.add('saved')
                setTimeout(() => wrap.classList.remove('saved'), 1500)

            } catch {
                select.value = lastValue
                wrap.classList.remove('saving')
                wrap.classList.add('error')
                setTimeout(() => wrap.classList.remove('error'), 2000)
                alert('{{ __("Failed to update. Please try again.") }}')
            }
        })
    })

    function applyColor(select, value) {
        select.dataset.status = value
    }

    /* ── Order Details Modal ── */
    const modal     = document.getElementById('order-modal')
    const closeBtn  = document.getElementById('modal-close')

    const statusLabel = {
        in_progress: '{{ __("In Progress") }}',
        completed:   '{{ __("Completed") }}',
        refused:     '{{ __("Refused") }}',
    }

    const statusClass = {
        in_progress: 'status-progress',
        completed:   'status-completed',
        refused:     'status-refused',
    }

    document.querySelectorAll('.btn-details').forEach(btn => {
        btn.addEventListener('click', () => {
            const o = JSON.parse(btn.dataset.order)

            document.querySelector('.modal-order-id').textContent = `#${String(o.id).padStart(6,'0')}`
            document.getElementById('m-customer').textContent = o.customer
            document.getElementById('m-email').textContent    = o.email
            document.getElementById('m-date').textContent     = o.date
            document.getElementById('m-total').textContent    = `$${o.total}`

            const statusEl = document.getElementById('m-status')
            statusEl.textContent  = statusLabel[o.status] ?? o.status
            statusEl.className    = 'info-value ' + (statusClass[o.status] ?? '')

            const itemsEl = document.getElementById('m-items')
            itemsEl.innerHTML = o.items.map(item => `
                <div class="modal-item">
                    ${item.image
                        ? `<img src="${item.image}" alt="${item.name}" class="modal-item-img">`
                        : `<div class="modal-item-no-img"></div>`}
                    <div class="modal-item-info">
                        <span class="modal-item-name">${item.name}</span>
                        <span class="modal-item-meta">${item.edition}${item.platform ? ' · ' + item.platform : ''}</span>
                        <span class="modal-item-qty">
                            <span class="qty-badge">x${item.units}</span>
                            $${item.price} {{ __('each') }}
                        </span>
                    </div>
                    <span class="modal-item-subtotal">$${item.subtotal}</span>
                </div>
            `).join('')

            modal.removeAttribute('aria-hidden')
            modal.classList.add('visible')
        })
    })

    function closeModal() {
        modal.setAttribute('aria-hidden', 'true')
        modal.classList.remove('visible')
    }

    closeBtn.addEventListener('click', closeModal)
    modal.addEventListener('click', e => { if (e.target === modal) closeModal() })
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal() })
})()
</script>

</body>
</html>
