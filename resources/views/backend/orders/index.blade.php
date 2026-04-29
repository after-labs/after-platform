<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders control</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/orders_control_adm.css">
</head>
<body>

     <iframe src="header_adm.html" style="border:none; width:100%; height:100px;"></iframe>
    
    <main class="container">

  <h1>{{ __('Orders') }}</h1>

  <div class="card">

    <!-- SEARCH -->
    <div class="search-row">
      <input type="text" placeholder="{{ __('Search by Order ID, User ID and games names') }}">
      <span>{{ __('Total Orders: :count', ['count' => 140]) }}</span>
    </div>

    <!-- BOTÕES -->
    <div class="filters">
      <button class="btn active">{{ __('All Orders') }}</button>
      <button class="btn">{{ __('Order By') }} ▾</button>
      <button class="btn">{{ __('Filters') }} ▾</button>
    </div>

    <!-- TABELA -->
    <table>
      <thead>
        <tr>
          <th>{{ __('ID') }}</th>
        <th>{{ __('Game Units') }}</th>
        <th>{{ __('Total Price') }}</th>
        <th>{{ __('Date') }}</th>
        <th>{{ __('Status') }}</th>
        </tr>
      </thead>

      <tbody>

        <!-- CLICK abre painel -->
        <tr onclick="location.href='#order1'">
          <td>OR-0000-0001</td>
          <td>3</td>
          <td>R$400.00</td>
          <td>2026/03/13</td>
          <td>{{ __('Completed') }}</td>
        </tr>

        <tr onclick="location.href='#order1'">
          <td>OR-0000-0002</td>
          <td>3</td>
          <td>R$400.00</td>
          <td>2026/03/13</td>
           <td>{{ __('On Progress') }}</td>
        </tr>

      </tbody>
    </table>

    <div class="pagination">
      « 1 2 3 4 ... 29 »
    </div>

  </div>

</main>


<!-- PAINEL DETAILS -->

<div id="order1" class="details-panel">

  <a href="#" class="overlay-close"></a>

  <div class="details-box">

    <button class="close-btn" onclick="location.href='#'">✕</button>

    <<h2>{{ __('Order Details') }}</h2>

    <div class="details">
      <p><strong>{{ __('Order ID:') }}</strong> OR-0000-0001</p>
      <p><strong>{{ __('Date:') }}</strong> October 13, 2025</p>
      <p><strong>{{ __('Game units:') }}</strong> 6</p>
      <p><strong>{{ __('Total Price:') }}</strong> $60.00</p>
      <p><strong>{{ __('Payment method:') }}</strong> {{ __('Credit Card') }}</p>
      <p><strong>{{ __('Coupons Used:') }}</strong> AFTER25</p>
      <p><strong>{{ __('Coins Used:') }}</strong> 50 {{ __('coins') }}</p>
      <p><strong>{{ __('Status:') }}</strong> {{ __('Completed') }} ▾</p>
      <p><strong>{{ __('User ID:') }}</strong> U-0000-0001</p>
    </div>

    <!-- GAMES -->
    <div class="games">
      <div class="game">
        <img src="/img/replaced-banner.png">
        <span>REPLACED</span>
        <small>$24.00</small>
      </div>

      <div class="game">
        <img src="/img/replaced-banner.png">
        <span>REPLACED</span>
        <small>$24.00</small>
      </div>

      <div class="game">
        <img src="/img/replaced-banner.png">
        <span>REPLACED</span>
        <small>$24.00</small>
      </div>
    </div>

  </div>

</div>
</main>

</body>
</html>