<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Order Finished') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/orders/orders.css'])
</head>
<body>
    @include('components/header_client')

    <main class="orders-page">
        <section class="orders-hero">
            <span>{{ __('Order Created') }}</span>
            <h1>{{ __('Your order has been received') }}</h1>
            <p>{{ __('Thanks for supporting indie games on After.') }}</p>
        </section>

        <section class="orders-panel completed-order">
            <div class="completed-summary">
                <div>
                    <span>{{ __('Order ID') }}</span>
                    <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                </div>
                <div>
                    <span>{{ __('Date') }}</span>
                    <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                </div>
                <div>
                    <span>{{ __('Total') }}</span>
                    <strong>${{ number_format($order->total, 2) }}</strong>
                </div>
            </div>

            <div class="checkout-items">
                @foreach($order->items as $item)
                    @php
                        $version = $item->gameVersion;
                        $game = $version->game;
                        $poster = $game->poster();
                    @endphp

                    <article class="checkout-item">
                        <img src="{{ asset($poster?->path ?? 'imgs/replaced-poster.png') }}" alt="{{ $game->name }}">
                        <div>
                            <h3>{{ $game->name }}</h3>
                            <p>{{ $version->edition_name }} · {{ $version->platform?->name ?? __('Platform') }}</p>
                            <span>{{ $item->units }} × ${{ number_format($item->price, 2) }}</span>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="completed-actions">
                <a href="{{ route('games.index') }}">{{ __('Back to Shop') }}</a>
                <a href="{{ route('orders.index') }}">{{ __('My Orders') }}</a>
            </div>
        </section>
    </main>

    @include('components/footer')
</body>
</html>
