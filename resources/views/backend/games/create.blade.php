<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Create Game') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/games/create.css'])
</head>
<body>
@include('components/header_adm')

<div class="wrapper">
<div class="game-card">

    <a class="close-btn" href="{{ route('admin.games.index') }}">✕</a>

    <h2>{{ __('CREATE NEW GAME:') }} <span>{{ __('Details') }}</span></h2>

    @if($errors->any())
        <div class="alert-error">
            <strong>{{ __('Please fix the errors below:') }}</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form id="game-form" class="form-grid" action="{{ route('admin.games.store') }}" method="POST">
    @csrf

        <div class="field-group">
            <label for="name">{{ __('Name') }} <span class="req">*</span></label>
            <input id="name" name="name" type="text"
                   value="{{ old('name') }}"
                   placeholder="{{ __('Game title') }}"
                   class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="category_id">{{ __('Category') }} <span class="req">*</span></label>
            <select id="category_id" name="category_id"
                    class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>{{ __('Select category') }}</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="developer">{{ __('Developer') }} <span class="req">*</span></label>
            <input id="developer" name="developer" type="text"
                   value="{{ old('developer') }}"
                   placeholder="{{ __('Studio name') }}"
                   class="{{ $errors->has('developer') ? 'is-invalid' : '' }}">
            @error('developer')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="release_date">{{ __('Release Year') }} <span class="req">*</span></label>
            <input id="release_date" name="release_date" type="number"
                   value="{{ old('release_date') }}"
                   placeholder="{{ date('Y') }}" min="1970" max="2099"
                   class="{{ $errors->has('release_date') ? 'is-invalid' : '' }}">
            @error('release_date')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="age">{{ __('Age Rating') }} <span class="req">*</span></label>
            <select id="age" name="age" class="{{ $errors->has('age') ? 'is-invalid' : '' }}">
                <option value="" disabled {{ old('age') === null ? 'selected' : '' }}>{{ __('Select rating') }}</option>
                @foreach([0 => 'Free (0+)', 10 => '10+', 12 => '12+', 14 => '14+', 16 => '16+', 18 => '18+'] as $val => $label)
                    <option value="{{ $val }}" {{ old('age') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('age')<span class="field-error">{{ $message }}</span>@enderror
        </div>


        <div class="field-group">
            <label for="featured">{{ __('Featured') }}</label>
            <select id="featured" name="featured">
                <option value="0" {{ old('featured', '0') == '0' ? 'selected' : '' }}>{{ __('No') }}</option>
                <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
            </select>
        </div>

        <div class="field-group span-3">
            <label>{{ __('Genre(s)') }}</label>
            <div class="checkbox-inline">
                @foreach($genres as $genre)
                    <label class="check-label">
                        <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                               {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                        {{ $genre->name }}
                    </label>
                @endforeach
            </div>
        </div>

    </form>

    
    <div class="textarea-group">
        <label for="summary">{{ __('Summary') }} <span class="req">*</span></label>
        <textarea id="summary" name="summary" form="game-form"
                  placeholder="{{ __('Short description (max 500 chars)') }}"
                  class="{{ $errors->has('summary') ? 'is-invalid' : '' }}">{{ old('summary') }}</textarea>
        @error('summary')<span class="field-error">{{ $message }}</span>@enderror
    </div>

    <div class="textarea-group">
        <label for="description">{{ __('Description') }} <span class="req">*</span></label>
        <textarea id="description" name="description" form="game-form"
                  placeholder="{{ __('Full description about this game') }}"
                  class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
        @error('description')<span class="field-error">{{ $message }}</span>@enderror
    </div>

    <div class="textarea-group">
        <label for="system_requirements">{{ __('System Requirements') }}</label>
        <textarea id="system_requirements" name="system_requirements" form="game-form"
                  placeholder="{{ __('Minimum and recommended specs') }}">{{ old('system_requirements') }}</textarea>
    </div>

    
    <div class="section-title">{{ __('Media (image links)') }}</div>

    <div class="media-grid">

        <div class="field-group">
            <label for="media_poster">{{ __('Poster URL') }}</label>
            <input id="media_poster" name="media_poster" type="url" form="game-form"
                   value="{{ old('media_poster') }}"
                   placeholder="https://...">
            @error('media_poster')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="media_banner">{{ __('Banner URL') }}</label>
            <input id="media_banner" name="media_banner" type="url" form="game-form"
                   value="{{ old('media_banner') }}"
                   placeholder="https://...">
            @error('media_banner')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field-group">
            <label for="media_video">{{ __('YouTube Video URL') }}</label>
            <input id="media_video" name="media_video" type="url" form="game-form"
                   value="{{ old('media_video') }}"
                   placeholder="https://www.youtube.com/watch?v=...">
            @error('media_video')<span class="field-error">{{ $message }}</span>@enderror
        </div>

    </div>

    <!--Gameplay images-->
    <div class="images-header">
        <span>{{ __('Gameplay Screenshots') }}</span>
        <button type="button" class="add-btn" id="add-gameplay">+ {{ __('Add Image') }}</button>
    </div>

    <div id="gameplay-list" class="gameplay-list">
        @if(old('media_gameplay'))
            @foreach(old('media_gameplay') as $i => $gpUrl)
                <div class="gameplay-item">
                    <input type="url" name="media_gameplay[]" form="game-form"
                           value="{{ $gpUrl }}" placeholder="https://...">
                    <button type="button" class="remove-gameplay">✕</button>
                </div>
            @endforeach
        @else
            <div class="gameplay-item">
                <input type="url" name="media_gameplay[]" form="game-form" placeholder="https://...">
                <button type="button" class="remove-gameplay">✕</button>
            </div>
        @endif
    </div>


    <div class="section-title">{{ __('Game Versions / Editions') }}</div>

    <div id="versions-list">
        <div class="version-row" data-index="0">
            <div class="version-grid">
                <div class="field-group">
                    <label>{{ __('Edition Name') }} <span class="req">*</span></label>
                    <input type="text" name="versions[0][edition_name]" form="game-form"
                           placeholder="{{ __('Standard, Deluxe…') }}">
                </div>
                <div class="field-group">
                    <label>{{ __('Platform') }} <span class="req">*</span></label>
                    <select name="versions[0][platform_id]" form="game-form">
                        <option value="" disabled selected>{{ __('Select') }}</option>
                        @foreach($platforms as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label>{{ __('Base Price') }} <span class="req">*</span></label>
                    <input type="number" step="0.01" name="versions[0][base_price]" form="game-form" placeholder="0.00">
                </div>
                <div class="field-group">
                    <label>{{ __('Final Price') }} <span class="req">*</span></label>
                    <input type="number" step="0.01" name="versions[0][final_price]" form="game-form" placeholder="0.00">
                </div>
                <div class="field-group">
                    <label>{{ __('Stock') }} <span class="req">*</span></label>
                    <input type="number" name="versions[0][stock]" form="game-form" placeholder="0">
                </div>
                <div class="field-group">
                    <label>{{ __('Active') }}</label>
                    <select name="versions[0][active]" form="game-form">
                        <option value="1">{{ __('Yes') }}</option>
                        <option value="0">{{ __('No') }}</option>
                    </select>
                </div>
            </div>
            <button type="button" class="remove-version">✕ {{ __('Remove') }}</button>
        </div>
    </div>

    <button type="button" class="add-btn" id="add-version">+ {{ __('Add Version') }}</button>


    <div class="actions">
        <a class="cancel" href="{{ route('admin.games.index') }}">{{ __('Cancel') }}</a>
        <button class="save" type="submit" form="game-form">{{ __('Create Game') }}</button>
    </div>

</div>
</div>

<script>
   
    document.getElementById('add-gameplay').addEventListener('click', function () {
        const list = document.getElementById('gameplay-list')
        const div  = document.createElement('div')
        div.className = 'gameplay-item'
        div.innerHTML = `<input type="url" name="media_gameplay[]" form="game-form" placeholder="https://...">
                         <button type="button" class="remove-gameplay">✕</button>`
        list.appendChild(div)
        bindRemoveGameplay(div.querySelector('.remove-gameplay'))
    })

    function bindRemoveGameplay(btn) {
        btn.addEventListener('click', () => btn.closest('.gameplay-item').remove())
    }
    document.querySelectorAll('.remove-gameplay').forEach(bindRemoveGameplay)

    /* ── Versions ── */
    let versionIndex = 1
    const platformOptions = `@foreach($platforms as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach`

    document.getElementById('add-version').addEventListener('click', function () {
        const i    = versionIndex++
        const list = document.getElementById('versions-list')
        const div  = document.createElement('div')
        div.className   = 'version-row'
        div.dataset.index = i
        div.innerHTML = `
            <div class="version-grid">
                <div class="field-group">
                    <label>{{ __('Edition Name') }} <span class="req">*</span></label>
                    <input type="text" name="versions[${i}][edition_name]" form="game-form" placeholder="{{ __('Standard, Deluxe…') }}">
                </div>
                <div class="field-group">
                    <label>{{ __('Platform') }} <span class="req">*</span></label>
                    <select name="versions[${i}][platform_id]" form="game-form">
                        <option value="" disabled selected>{{ __('Select') }}</option>
                        ${platformOptions}
                    </select>
                </div>
                <div class="field-group">
                    <label>{{ __('Base Price') }} <span class="req">*</span></label>
                    <input type="number" step="0.01" name="versions[${i}][base_price]" form="game-form" placeholder="0.00">
                </div>
                <div class="field-group">
                    <label>{{ __('Final Price') }} <span class="req">*</span></label>
                    <input type="number" step="0.01" name="versions[${i}][final_price]" form="game-form" placeholder="0.00">
                </div>
                <div class="field-group">
                    <label>{{ __('Stock') }} <span class="req">*</span></label>
                    <input type="number" name="versions[${i}][stock]" form="game-form" placeholder="0">
                </div>
                <div class="field-group">
                    <label>{{ __('Active') }}</label>
                    <select name="versions[${i}][active]" form="game-form">
                        <option value="1">{{ __('Yes') }}</option>
                        <option value="0">{{ __('No') }}</option>
                    </select>
                </div>
            </div>
            <button type="button" class="remove-version">✕ {{ __('Remove') }}</button>`
        list.appendChild(div)
        div.querySelector('.remove-version').addEventListener('click', () => div.remove())
    })

    document.querySelectorAll('.remove-version').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.version-row').remove())
    })
</script>

</body>
</html>