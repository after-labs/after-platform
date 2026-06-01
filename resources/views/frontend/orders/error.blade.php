<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Checkout Error') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/orders/orders.css'])
</head>
<body>
    @include('components/header_client')

    <main class="orders-page">
        <section class="orders-hero">
            <span>{{ __('Checkout Error') }}</span>
            <h1>{{ __('Payment was not completed') }}</h1>
            <p>{{ session('payment_error') ?? __('You can return to your cart and try again.') }}</p>
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

            <div class="completed-actions">
                <a href="{{ route('cart.index') }}">{{ __('Back to cart') }}</a>
                <a href="{{ route('orders.checkout') }}">{{ __('Try again') }}</a>
            </div>
        </section>
    </main>

    @include('components/footer')
</body>
</html>
