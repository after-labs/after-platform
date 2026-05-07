<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blank page</title>
    @vite(['resources/css/app.css', 'resources/css/backend/games/create.css'])
</head>
<body>
  @include('components/header_adm')

    <div class="wrapper">

  <div class="game-card">

    <button class="close-btn">✕</button>

    <h2>{{ __('CREATE NEW GAME:') }} <span>{{ __('Details') }}</span></h2>

    <!-- GRID -->
    <form class="form-grid">

      <div>
        <label>{{ __('Name') }}</label>
        <input type="text" placeholder="{{ __('Input placeholder') }}">
      </div>

      <div>
        <label>{{ __('Category') }}</label>
        <select>
          <option>{{ __('Popular, Free Demo...') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('Developer') }}</label>
        <input type="text" placeholder="{{ __('Input placeholder') }}">
      </div>

      <div>
        <label>{{ __('Base Price') }}</label>
        <input type="text" placeholder="{{ __('Input placeholder') }}">
      </div>

      <div>
        <label>{{ __('Genre(s)') }}</label>
        <select>
          <option>{{ __('Input placeholder') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('Release Year') }}</label>
        <input type="text" placeholder="{{ __('Input placeholder') }}">
      </div>

      <div>
        <label>{{ __('Active Status') }}</label>
        <select>
          <option>{{ __('Inactive') }}</option>
        </select>
      </div>

      <div>
        <label>{{ __('Age Range') }}</label>
        <select>
          <option>{{ __('Input placeholder') }}</option>
        </select>
      </div>

    </form>

    <!-- DESCRIPTION -->
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
      <span>{{ __('Images') }} 0/12</span>
      <button class="add-btn">{{ __('Add Image') }}</button>
    </div>

    <div class="image-upload">
      div class="upload-card">
        {{ __('Image') }}
        <span class="edit-icon">✎</span>
      </div>
    </div>

    <!-- ACTIONS -->
    <div class="actions">
      <button class="cancel">{{ __('Cancel') }}</button>
      <button class="save">{{ __('Create Game') }}</button>
    </div>

  </div>

</div>

</body>
</html>