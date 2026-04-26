<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game details</title>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/game_details_adm.css">
</head>
<body>

     <iframe src="header_adm.html" style="border:none; width:100%; height:100px;"></iframe>

    <div class="wrapper">

  <div class="game-card">

    <button class="close-btn">✕</button>

    <h2>&lt;GAMENAME&gt;: <span>Details</span></h2>

    <!-- GRID 3 COLUNAS -->
    <form class="form-grid">

      <input placeholder="Name">
      <input placeholder="Offer Price">
      <input placeholder="Developer">

      <input placeholder="Base Price">
      <input placeholder="Related Offer">
      <input placeholder="Release Year">

      <select><option>Genre(s)</option></select>
      <input placeholder="Offer Date-time Expiration">
      <input placeholder="Input placeholder">

      <select><option>Category</option></select>
      <input placeholder="Related Offer Game Launchers">
      <select><option>Available Game Launchers</option></select>

      <select><option>Active Status</option></select>
      <input placeholder="Input placeholder">
      <input placeholder="Game ID">

    </form>

    <!-- TEXTAREAS -->
    <div class="textarea-group">
      <label>Description</label>
      <textarea placeholder="Input placeholder"></textarea>
    </div>

    <div class="textarea-group">
      <label>About This Game</label>
      <textarea placeholder="Input placeholder"></textarea>
    </div>

    <!-- IMAGES -->
    <div class="images-header">
      <span>Images 2/12</span>
      <button class="add-btn">Add Image</button>
    </div>

    <div class="images-grid">

      <div class="image-card video">
        video
        <span class="edit">✎</span>
      </div>

      <div class="image-card">
        image
        <span class="close">✕</span>
      </div>

      <div class="image-card">
        image
        <span class="close">✕</span>
      </div>

    </div>

    <!-- ACTIONS -->
    <div class="actions">
      <button class="delete">Delete</button>
      <button class="save">Save Game</button>
    </div>

  </div>

</div>
    
</body>
</html>