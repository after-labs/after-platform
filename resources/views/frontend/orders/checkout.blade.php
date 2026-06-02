<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Checkout') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/orders/orders.css'])
</head>
<body>
    @include('components/header_client')

    <main class="orders-page">
        <section class="orders-hero">
            <span>{{ __('Checkout') }}</span>
            <h1>{{ __('Confirm your order') }}</h1>
            <p>{{ __('Review your order, apply discounts and continue to payment.') }}</p>
        </section>

        <div class="checkout-layout">
            <section class="orders-panel">
                <h2>{{ __('Order items') }}</h2>

                <div class="checkout-items">
                    @foreach($items as $item)
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
                                <span>{{ $item->units }} × ${{ number_format($version->final_price, 2) }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <aside class="order-summary-panel">
                <h2>{{ __('Summary') }}</h2>

                <div class="summary-row">
                    <span>{{ __('Items') }}</span>
                    <strong>{{ $items->sum('units') }}</strong>
                </div>

                <div class="summary-row total">
                    <span>{{ __('Subtotal') }}</span>
                    <strong>${{ number_format($subtotal, 2) }}</strong>
                </div>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <label class="checkout-field">
                        <span>{{ __('Coupon') }}</span>
                        <input type="text" name="coupon_code" value="{{ old('coupon_code') }}" placeholder="{{ __('Enter coupon code') }}">
                        <x-input-error :messages="$errors->get('coupon_code')" />
                    </label>

                    <label class="checkout-field">
                        <span>{{ __('Use coins') }}</span>
                        <input type="number" name="coins_used" value="{{ old('coins_used', 0) }}" min="0" max="{{ $availableCoins }}">
                        <small>{{ __('Available coins:') }} {{ $availableCoins }} · {{ __('100 coins = $1') }}</small>
                        <x-input-error :messages="$errors->get('coins_used')" />
                    </label>

                    <button type="submit" class="place-order-button">
                        {{ __('Pay with Stripe') }}
                    </button>
                </form>
            </aside>
        </div>
    </main>

    @include('components/footer')
</body>
</html>
