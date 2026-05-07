<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game control</title>
    @vite(['resources/css/app.css', 'resources/css/backend/games/index.css'])
</head>
<body>
  @include('components/header_adm')
    
    <main class="container">

  <h1>{{ __('Games') }}</h1>

  <div class="card">

    <!-- SEARCH -->
    <div class="search-row">
      <<input type="text" placeholder="{{ __('Search by name, ID or creator') }}">
      <span>{{ __('Total Games: :count', ['count' => 121]) }}</span>
    </div>

    <!-- BOTÕES -->
    <div class="filters-bar">
      <button class="btn active">{{ __('Gallery View') }}</button>
      <button class="btn">{{ __('Table View') }}</button>
      <button class="btn">{{ __('Order By') }} ▾</button>

      <!-- ABRIR FILTER -->
      <a href="#filters" class="btn">{{ __('Filters') }} ▾</a>


      <button class="btn create">{{ __('Create Game') }}</button>
    </div>

    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

    </div>


    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

    </div>


    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">{{ __('Edit') }}</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

    </div>


    <!-- PAGINAÇÃO -->
    <div class="pagination">
      « 1 2 3 4 ... 29 »
    </div>

  </div>

</main>

<!-- FILTERS (MESMA PÁGINA) -->
<div id="filters" class="filters-panel">

  <!-- clicar fora fecha -->
  <a href="#" class="overlay-close"></a>

  <div class="filters-box">

    <div class="filters-header">
      <h3>{{ __('Filters') }}</h3>
      <a href="#" class="reset">{{ __('Reset') }}</a>
    </div>

    <div class="filter-item">{{ __('Price') }} ▾</div>
    <div class="filter-item">{{ __('Category') }} ▾</div>
    <div class="filter-item">{{ __('Features') }} ▾</div>
    <div class="filter-item">{{ __('Release') }} ▾</div>
    <div class="filter-item">{{ __('Game Launcher') }} ▾</div>

    <div class="filter-item open">
      <div class="genre-title">
        {{ __('Game Genre') }} <span class="badge"></span> ▲
      </div>

      <div class="checkbox-list">
        <label><input type="checkbox"> {{ __('Adventure') }}</label>
        <label><input type="checkbox"> {{ __('Action') }}</label>
        <label><input type="checkbox"> {{ __('Metroidvania') }}</label>
        <label><input type="checkbox"> {{ __('Strategy') }}</label>
        <label><input type="checkbox"> {{ __('Platform') }}</label>
        <label><input type="checkbox"> {{ __('Shooter') }}</label>
        <label><input type="checkbox"> {{ __('First-person') }}</label>
        <label><input type="checkbox"> {{ __('MMO') }}</label>
        <label><input type="checkbox"> {{ __('Horror') }}</label>
        <label><input type="checkbox"> {{ __('Survival') }}</label>
      </div>
    </div>

  </div>

</div>
</main>


</body>
</html>