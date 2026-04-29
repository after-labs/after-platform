<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <main class="cart-page">
        <h1 class="cart-page_title">{{ __('Cart') }}</h1>

        <nav class="stepper">
            <div class="cart-stepper">
                <div class="stepper-active">
                    <span class="stepper-number">1</span>
                    <span class="stepper-text">{{ __('Shopping cart') }}</span>
                </div>
                <div class="stepper-item">
                    <span class="stepper-number">2</span>
                    <span class="stepper-text">{{ __('Checkout details') }}</span>
                </div>
                <div class="stepper-item">
                    <span class="stepper-number">3</span>
                    <span class="stepper-text">{{ __('Order complete') }}</span>
                </div>
            </div>
        </nav>

        <div class="cart-container">
            <section class="cart-items">
                <h2 class="cart-items-heading">{{ __('Games on the Cart') }}</h2>
                
                <div class="cart-items-list">
                    <article class="cart-item">
                        <div class="cart-item-image-placeholder"></div>
                        <div class="cart-item-details">
                             <h3 class="cart-item-name">Hollow Knight (STEAM)</h3>
                            <div class="cart-item-prices">
                                <span class="cart-item-price-original">$99.99</span>
                                <span class="cart-item-price-discount">$99.99</span>
                            </div>
                        </div>
                        <div class="cart-item-actions">
                            <button class="cart-item-remove-btn">{{ __('Remove') }}</button>
                            <span class="cart-item-total">$25.98</span>
                        </div>
                    </article>
                    </div>
            </section>

            <aside class="order-summary">
                <h2 class="order-summary-title">{{ __('Order Summary') }}</h2>
                
                <div class="order-summary-row">
                    <span>{{ __('Items total') }}</span>
                    <span>$128.78</span>
                </div>
                <div class="order-summary-row">
                    <span>{{ __('Items quantity') }}</span>
                    <span>$128.78</span>
                </div>
                
                <hr class="order-summary-divider">

                <div class="order-summary-total-row">
                    <span>{{ __('Subtotal') }}</span>
                    <span>$134.56</span>
                </div>

                <button class="checkout-button">
                    <span class="checkout-button-icon">💳</span>
                    <span class="checkout-button-text">{{ __('Checkout') }}</span>
                    <span class="checkout-button-amount">$134.56</span>
                </button>
            </aside>
        </div>

        <section class="you-may-like">
        <h2>{{ __('You may like') }}</h2>
        <div class="game-card">
            <img src="#game-IMG" alt="" class="game-img">
            <div class="game-info">
                <h4 class="game-title">Replaced</h4>
                <span class="discount">-40%</span>
                <span class="old-price">R$40.00</span>
                <span class="new-price">R$24.00</span>
            </div>
        </div>
        <div class="game-card">
            <img src="#game-IMG" alt="" class="game-img">
            <div class="game-info">
                <h4 class="game-title">Replaced</h4>
                <span class="discount">-40%</span>
                <span class="old-price">R$40.00</span>
                <span class="new-price">R$24.00</span>
            </div>
        </div>
        <div class="game-card">
            <img src="#game-IMG" alt="" class="game-img">
            <div class="game-info">
                <h4 class="game-title">Replaced</h4>
                <span class="discount">-40%</span>
                <span class="old-price">R$40.00</span>
                <span class="new-price">R$24.00</span>
            </div>
        </div>
    </section>
    </main>
</body>
</html>