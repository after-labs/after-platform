<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Cart') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/cart/cart.css'])
</head>
<body>
    @include('components/header_client')

    <main class="cart-page">
        <section class="cart-hero">
            <span>{{ __('Shopping Cart') }}</span>
            <h1>{{ __('Your cart') }}</h1>
            <p>{{ __('Review your selected game editions before checkout.') }}</p>
        </section>

        @if(session('status') === 'empty-cart')
            <p class="cart-alert">{{ __('Your cart is empty. Add a game before checkout.') }}</p>
        @endif

        <div class="cart-layout">
            <section class="cart-panel">
                <h2>{{ __('Games on the Cart') }}</h2>

                <div class="cart-items-list">
                    @forelse($items as $item)
                        @php
                            $version = $item->gameVersion;
                            $game = $version->game;
                            $poster = $game->poster();
                            $subtotal = $item->units * $version->final_price;
                        @endphp

                        <article class="cart-item">
                            <a href="{{ route('games.show', $game) }}" class="cart-cover">
                                <img src="{{ asset($poster?->path ?? 'imgs/replaced-poster.png') }}" alt="{{ $game->name }}">
                            </a>

                            <div class="cart-item-details">
                                <h3>{{ $game->name }}</h3>
                                <p>{{ $version->edition_name }} · {{ $version->platform?->name ?? __('Platform') }}</p>
                                <div class="cart-quantity-control" aria-label="{{ __('Quantity') }}">
                                    <form action="{{ route('cart.decrease', $item) }}" method="POST">
                                        @csrf
                                        <button type="submit" aria-label="{{ __('Decrease quantity') }}">-</button>
                                    </form>

                                    <span>{{ $item->units }}</span>

                                    <form action="{{ route('cart.increase', $item) }}" method="POST">
                                        @csrf
                                        <button type="submit" aria-label="{{ __('Increase quantity') }}">+</button>
                                    </form>
                                </div>
                            </div>

                            <div class="cart-item-price">
                                <span>${{ number_format($version->final_price, 2) }}</span>
                                <strong>${{ number_format($subtotal, 2) }}</strong>
                            </div>

                            <form action="{{ route('cart.delete', $item) }}" method="POST" class="cart-remove-form">
                                @csrf
                                <button type="submit">{{ __('Remove') }}</button>
                            </form>
                        </article>
                    @empty
                        <div class="empty-state">
                            <h3>{{ __('Your cart is empty') }}</h3>
                            <p>{{ __('Browse the store and add an indie game to continue.') }}</p>
                            <a href="{{ route('games.index') }}">{{ __('Browse store') }}</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <aside class="cart-summary">
                <h2>{{ __('Order Summary') }}</h2>

                <div class="summary-row">
                    <span>{{ __('Items') }}</span>
                    <strong>{{ $items->sum('units') }}</strong>
                </div>

                <div class="summary-row total">
                    <span>{{ __('Total') }}</span>
                    <strong>${{ number_format($total, 2) }}</strong>
                </div>

                @if($items->isNotEmpty())
                    <a href="{{ route('orders.checkout') }}" class="checkout-button">
                        {{ __('Checkout') }}
                    </a>
                @else
                    <a href="{{ route('games.index') }}" class="checkout-button secondary">
                        {{ __('Go to Store') }}
                    </a>
                @endif
            </aside>
        </div>
    </main>

    @include('components/footer')
</body>
</html>
