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
  @include('components/header_adm')

    <div class="wrapper">

  <div class="game-card">

    <button class="close-btn">✕</button>

    <h2>{{ __('<GAMENAME>:') }} <span>{{ __('Details') }}</span></h2>

    <!-- GRID 3 COLUNAS -->
    <form class="form-grid">

      <input placeholder="{{ __('Name') }}">
      <input placeholder="{{ __('Offer Price') }}">
      <input placeholder="{{ __('Developer') }}">

      <input placeholder="{{ __('Base Price') }}">
      <input placeholder="{{ __('Related Offer') }}">
      <input placeholder="{{ __('Release Year') }}">

      <select><option>{{ __('Genre(s)') }}</option></select>
      <input placeholder="{{ __('Offer Date-time Expiration') }}">
      <input placeholder="{{ __('Input placeholder') }}">

      <select><option>{{ __('Category') }}</option></select>
      <input placeholder="{{ __('Related Offer Game Launchers') }}">
      <select><option>{{ __('Available Game Launchers') }}</option></select>

      <select><option>{{ __('Active Status') }}</option></select>
      <input placeholder="{{ __('Input placeholder') }}">
      <input placeholder="{{ __('Game ID') }}">

    </form>

    <!-- TEXTAREAS -->
    <div class="textarea-group">
      <label>{{ __('Description') }}</label>
      <textarea placeholder="{{ __('Input placeholder') }}"></textarea>
    </div>

    <div class="textarea-group">
      <label>{{ __('About This Game') }}</label>
      <textarea placeholder="{{ __('Input placeholder') }}"></textarea>
    </div>

    <!-- IMAGES -->
    <div class="images-header">
      <span>{{ __('Images') }} 2/12</span>
      <button class="add-btn">{{ __('Add Image') }}</button>
    </div>

    <div class="images-grid">

      <div class="image-card video">
       {{ __('Video') }}
        <span class="edit">✎</span>
      </div>

       <div class="image-card">
    {{ __('Image') }}
        <span class="close">✕</span>
      </div>

       <div class="image-card">
    {{ __('Image') }}
        <span class="close">✕</span>
      </div>

    </div>

    <!-- ACTIONS -->
    <div class="actions">
      <button class="delete">{{ __('Delete') }}</button>
  <button class="save">{{ __('Save Game') }}</button>
    </div>

  </div>

</div>
    
</body>
</html>