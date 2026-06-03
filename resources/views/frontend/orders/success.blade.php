<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Checkout Success') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/orders/orders.css'])
</head>
<body>
    @include('components/header_client')

    <main class="orders-page">
        <section class="orders-hero">
            <span>{{ __('Checkout Success') }}</span>
            @if($order->status === 'completed')
                <h1>{{ __('Payment confirmed') }}</h1>
                <p>{{ __('Your access keys were sent to your email and are available below.') }}</p>
            @elseif($order->status === 'missing_keys')
                <h1>{{ __('Payment confirmed') }}</h1>
                <p>{{ __('Some access keys still need to be released for this order.') }}</p>
            @else
                <h1>{{ __('Your payment is being processed') }}</h1>
                <p>{{ __('When Stripe confirms the payment, your keys are sent to your email and appear here.') }}</p>
            @endif
        </section>

        <section class="orders-panel completed-order">
            <div class="completed-summary">
                <div>
                    <span>{{ __('Order ID') }}</span>
                    <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                </div>
                <div>
                    <span>{{ __('Status') }}</span>
                    <strong>{{ __($order->status) }}</strong>
                </div>
                <div>
                    <span>{{ __('Total') }}</span>
                    <strong>${{ number_format($order->total, 2) }}</strong>
                </div>
            </div>

            <div class="summary-box">
                <div class="summary-row">
                    <span>{{ __('Subtotal') }}</span>
                    <strong>${{ number_format($order->subtotal, 2) }}</strong>
                </div>
                <div class="summary-row">
                    <span>{{ __('Coupon discount') }}</span>
                    <strong>-${{ number_format($order->coupon_discount, 2) }}</strong>
                </div>
                <div class="summary-row">
                    <span>{{ __('Coin discount') }}</span>
                    <strong>-${{ number_format($order->coin_discount, 2) }}</strong>
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

            @if($order->accessKeys->isNotEmpty())
                <div class="access-keys-box">
                    <h2>{{ __('Access keys') }}</h2>
                    @foreach($order->accessKeys as $key)
                        <p>{{ $key->game->name }} · {{ $key->gameVersion->platform?->name ?? __('Platform') }}: <strong>{{ $key->key }}</strong></p>
                    @endforeach
                </div>
            @endif

            <div class="completed-actions">
                <a href="{{ route('games.index') }}">{{ __('Back to Shop') }}</a>
                <a href="{{ route('orders.index') }}">{{ __('My Orders') }}</a>
            </div>
        </section>
    </main>

    @include('components/footer')
</body>
</html>
