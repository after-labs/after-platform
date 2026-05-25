<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Orders') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/orders/index.css'])
</head>
<body>
@include('components/header_adm')

<main class="orders-main">

    <h1>{{ __('Orders') }}</h1>

    {{-- ── Search + total ── --}}
    <section class="card">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="search-row">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('Search by customer name, email or order ID…') }}"
                autocomplete="off"
                id="orders-search"
            >
            <span class="total">{{ __('Total Orders:') }} <strong>{{ $totalOrders }}</strong></span>
        </form>

        <div class="filters">
            @php $f = request('filter', 'all'); @endphp
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'all',   'page' => 1]) }}" class="btn {{ $f === 'all'   ? 'active' : '' }}">{{ __('All') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'today', 'page' => 1]) }}" class="btn {{ $f === 'today' ? 'active' : '' }}">{{ __('Today') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'week',  'page' => 1]) }}" class="btn {{ $f === 'week'  ? 'active' : '' }}">{{ __('This Week') }}</a>
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'month', 'page' => 1]) }}" class="btn {{ $f === 'month' ? 'active' : '' }}">{{ __('This Month') }}</a>
        </div>
    </section>

    <br>

    {{-- ── Table ── --}}
    <section class="card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('CUSTOMER') }}</th>
                    <th>{{ __('EMAIL') }}</th>
                    <th>{{ __('ITEMS') }}</th>
                    <th>{{ __('TOTAL') }}</th>
                    <th>{{ __('DATE') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="td-id">{{ $order->id }}</td>

                        <td class="td-name">{{ $order->user?->name ?? '—' }}</td>

                        <td class="td-email">{{ $order->user?->email ?? '—' }}</td>

                        <td class="td-items">
                            @foreach($order->items as $item)
                                <div class="order-item-row">
                                    <span class="order-item-name">
                                        {{ $item->gameVersion?->game?->name ?? '—' }}
                                    </span>
                                    <span class="order-item-meta">
                                        {{ $item->gameVersion?->edition_name }}
                                        · {{ $item->gameVersion?->platform?->name }}
                                        · ×{{ $item->units }}
                                    </span>
                                </div>
                            @endforeach
                        </td>

                        <td class="td-total">${{ number_format($order->total, 2) }}</td>

                        <td class="td-date">
                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">{{ __('No orders found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
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

<script>
    // live search debounce
    const si = document.getElementById('orders-search')
    let t
    si?.addEventListener('input', () => {
        clearTimeout(t)
        t = setTimeout(() => si.closest('form').submit(), 400)
    })
</script>

</body>
</html>