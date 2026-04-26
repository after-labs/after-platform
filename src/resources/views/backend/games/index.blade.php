<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game control</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/games_control_adm.css">
</head>
<body>

     <iframe src="header_adm.html" style="border:none; width:100%; height:100px;"></iframe>
    
    <main class="container">

  <h1>Games</h1>

  <div class="card">

    <!-- SEARCH -->
    <div class="search-row">
      <input type="text" placeholder="Search by name, ID or creator">
      <span>Total Games: 121</span>
    </div>

    <!-- BOTÕES -->
    <div class="filters-bar">
      <button class="btn active">Gallery View</button>
      <button class="btn">Table View</button>
      <button class="btn">Order By ▾</button>

      <!-- ABRIR FILTER -->
      <a href="#filters" class="btn">Filters ▾</a>

      <button class="btn create">Create Game</button>
    </div>

    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

    </div>


    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

    </div>


    <!-- GALERIA -->
    <div class="gallery">

      <!-- repetir -->
      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
        <img src="/img/replaced-banner.png">
        <h3>REPLACED</h3>
        <p>$24.00</p>
      </div>

      <div class="game-card">
        <button class="edit">EDIT</button>
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
      <h3>Filters</h3>
      <a href="#" class="reset">Reset</a>
    </div>

    <div class="filter-item">Price ▾</div>
    <div class="filter-item">Category ▾</div>
    <div class="filter-item">Features ▾</div>
    <div class="filter-item">Release ▾</div>
    <div class="filter-item">Game Launcher ▾</div>

    <div class="filter-item open">
      <div class="genre-title">
        Game Genre <span class="badge"></span> ▲
      </div>

      <div class="checkbox-list">
        <label><input type="checkbox"> Adventure</label>
        <label><input type="checkbox"> Action</label>
        <label><input type="checkbox"> Metroidvania</label>
        <label><input type="checkbox"> Strategy</label>
        <label><input type="checkbox"> Platform</label>
        <label><input type="checkbox"> Shooter</label>
        <label><input type="checkbox"> First-person</label>
        <label><input type="checkbox"> MMO</label>
        <label><input type="checkbox"> Horror</label>
        <label><input type="checkbox"> Survival</label>
      </div>
    </div>

  </div>

</div>
</main>


</body>
</html>