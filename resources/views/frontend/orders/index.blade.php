<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('My Orders') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/orders/orders.css'])
</head>
<body>
    @include('components/header_client')

    <main class="orders-page">
        <section class="orders-hero">
            <span>{{ __('Orders') }}</span>
            <h1>{{ __('Track your Orders') }}</h1>
            <p>{{ __('See your completed purchases and the selected game editions.') }}</p>
        </section>

        <section class="orders-panel">
            @forelse($orders as $order)
                <article class="order-card">
                    <div>
                        <span class="order-id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        <h2>{{ __('Order from') }} {{ $order->created_at->format('M d, Y') }}</h2>
                        <p>{{ $order->items->sum('units') }} {{ __('game units') }} · {{ __($order->status) }}</p>
                    </div>

                    <div class="order-card-meta">
                        <strong>${{ number_format($order->total, 2) }}</strong>
                        <a href="{{ route('orders.completed', $order) }}">{{ __('View details') }}</a>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <h2>{{ __('No orders yet') }}</h2>
                    <p>{{ __('Your purchases will appear here after checkout.') }}</p>
                    <a href="{{ route('games.index') }}">{{ __('Browse store') }}</a>
                </div>
            @endforelse
        </section>
    </main>

    @include('components/footer')
</body>
</html>
