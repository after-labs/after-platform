<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Finished</title>
</head>
<body>
    <main class="confirmation-page">
        <h1 class="confirmation-page_title">{{ __('Order Created!') }}</h1>

        <nav class="stepper">
            <div class="stepper-completed">
                <span class="stepper-number">1</span>
                <span class="stepper-label">{{ __('Shopping cart') }}</span>
            </div>
            <div class="stepper-completed">
                <span class="stepper-number">2</span>
                <span class="stepper-label">{{ __('Checkout details') }}</span>
            </div>
            <div class="stepper-active">
                <span class="stepper-number">3</span>
                <span class="stepper-label">{{ __('Order complete') }}</span>
            </div>
        </nav>

        <section class="order-card">
            <header class="order-card-header">
                <p class="order-card-thanks">{{ __('Thank you! 🎉') }}</p>
                <h2 class="order-card-headline">{{ __('Your order has been received') }}</h2>
                <p class="order-card-instruction">
                    {{ __('In a few minutes, check the email sent for') }}
                <span class="order-card-email">&lt;emailName&gt;</span>
                     {{ __('for your access keys') }}
                </p>
            </header>

            <div class="order-card-items-preview">
                <div class="order-card-item-thumb">
                    <img src="/hollow_knight.png" alt="Hollow Knight">
                </div>
                <div class="order-card-item-thumb">
                    <img src="/hollow_knight.png" alt="Hollow Knight">
                </div>
                <div class="order-card-item-thumb">
                    <img src="/hollow_knight.png" alt="Hollow Knight">
                </div>
            </div>

            <div class="order-info">
                <div class="order-info-row">
                    <span class="order-info-label">{{ __('Order ID:') }}</span>
                    <span class="order-info-value">OR-0000-0001</span>
                </div>
                <div class="order-info-row">
                    <span class="order-info-label">{{ __('Date:') }}</span>
                    <span class="order-info-value">{{ __('October') }} 19, 2023</span>
                </div>
                <div class="order-info-row">
                    <span class="order-info-label">{{ __('Total Price:') }}</span>
                    <span class="order-info-value">$400.00</span>
                </div>
                <div class="order-info-row">
                    <span class="order-info-label">{{ __('Payment method:') }}</span>
                    <span class="order-info-value">{{ __('Credit Card') }}</span>
                </div>
            </div>

            <footer class="order-card-actions">
                <a href="#" class="btn btn-outline">{{ __('Back to Shop') }}</a>
                <a href="#" class="btn btn-primary">{{ __('My Orders') }}</a>
            </footer>
        </section>
    </main>
</body>
</html>