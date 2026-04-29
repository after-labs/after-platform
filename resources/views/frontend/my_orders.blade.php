<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
</head>
<body>
    <main class="orders-container">
    <section class="orders-hero">
        <h1 class="orders-title">{{ __('Track your Orders') }}</h1>
        <p class="orders-description">
            {{ __('See all your orders and their currently status. Click on them to see the details of respective your order, such as the game and their game launcher editions') }}
        </p>
    </section>

    <section class="filters-container">
        <div class="filters-wrapper">
            <div class="filter-icon">
                <i class="icon-funnel"></i>
            </div>
            
            <span class="filter-label">{{ __('Filter By') }}</span>

            <div class="filter-dropdown">
                <button class="dropdown-btn">{{ __('Date') }} <i class="icon-chevron-down"></i></button>
            </div>

            <div class="filter-dropdown">
                <button class="dropdown-btn">{{ __('Total Price') }} <i class="icon-chevron-down"></i></button>
            </div>

            <div class="filter-dropdown">
                <button class="dropdown-btn">{{ __('Order Status') }} <i class="icon-chevron-down"></i></button>
            </div>

            <button class="btn-reset-filter">
                <i class="icon-reset"></i> {{ __('Reset Filter') }}
            </button>
        </div>
    </section>

    <section class="orders-table-wrapper">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('GAME UNITS') }}</th>
                    <th>{{ __('TOTAL PRICE') }}</th>
                    <th>{{ __('DATE') }}</th>
                    <th>{{ __('STATUS') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="order-row">
                    <td class="order-id">OR-0000-0001</td>
                    <td class="order-units">3</td>
                    <td class="order-price">R$400.00</td>
                    <td class="order-date">2026/03/13</td>
                    <td class="order-completed">{{ __('COMPLETED') }}</td>
                </tr>
                
                <tr class="order-row">
                    <td class="order-id">OR-0000-0002</td>
                    <td class="order-units">3</td>
                    <td class="order-price">R$400.00</td>
                    <td class="order-date">2026/03/13</td>
                    <td class="order-in-progress">{{ __('ON PROGRESS') }}</td>
                </tr>

                <tr class="order-row">
                    <td class="order-id">OR-0000-0007</td>
                    <td class="order-units">3</td>
                    <td class="order-price">R$400.00</td>
                    <td class="order-date">2026/03/13</td>
                    <td class="order-refused">{{ __('REFUSED') }}</td>
                </tr>

                </tbody>
        </table>
    </section>
</main>
</body>
</html>