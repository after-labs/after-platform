<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->name }} — {{ __('Edit Game') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/games/edit.css'])
</head>
<body>
@include('components/header_adm')

<div class="wrapper">
<div class="game-card">

    <a class="close-btn" href="{{ route('admin.games.index') }}">✕</a>

    <h2>{{ $game->name }}: <span>{{ __('Details') }}</span></h2>

    @if($errors->any())
        <div class="alert-error">
            <strong>{{ __('Please fix the errors below:') }}</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form id="game-form" class="form-grid"
          action="{{ route('admin.games.update', $game) }}" method="POST">
    @csrf

        {{-- Name --}}
        <div class="field-group">
            <label for="name">{{ __('Name') }} <span class="req">*</span></label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $game->name) }}"
                   class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Category --}}
        <div class="field-group">
            <label for="category_id">{{ __('Category') }} <span class="req">*</span></label>
            <select id="category_id" name="category_id"
                    class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $game->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Developer --}}
        <div class="field-group">
            <label for="developer">{{ __('Developer') }} <span class="req">*</span></label>
            <input id="developer" name="developer" type="text"
                   value="{{ old('developer', $game->developer) }}"
                   class="{{ $errors->has('developer') ? 'is-invalid' : '' }}">
            @error('developer')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Release Year --}}
        <div class="field-group">
            <label for="release_date">{{ __('Release Year') }} <span class="req">*</span></label>
            <input id="release_date" name="release_date" type="number"
                   value="{{ old('release_date', $game->release_date) }}"
                   min="1970" max="2099"
                   class="{{ $errors->has('release_date') ? 'is-invalid' : '' }}">
            @error('release_date')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Age --}}
        <div class="field-group">
            <label for="age">{{ __('Age Rating') }} <span class="req">*</span></label>
            <select id="age" name="age" class="{{ $errors->has('age') ? 'is-invalid' : '' }}">
                @foreach([0 => 'Free (0+)', 10 => '10+', 12 => '12+', 14 => '14+', 16 => '16+', 18 => '18+'] as $val => $label)
                    <option value="{{ $val }}" {{ old('age', $game->age) == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('age')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Featured --}}
        <div class="field-group">
            <label for="featured">{{ __('Featured') }}</label>
            <select id="featured" name="featured">
                <option value="0" {{ old('featured', $game->featured ? '1' : '0') == '0' ? 'selected' : '' }}>{{ __('No') }}</option>
                <option value="1" {{ old('featured', $game->featured ? '1' : '0') == '1' ? 'selected' : '' }}>{{ __('Yes') }}</option>
            </select>
        </div>

        {{-- Game ID (read-only) --}}
        <div class="field-group">
            <label>{{ __('Game ID') }}</label>
            <input type="text" value="{{ $game->id }}" disabled>
        </div>

        {{-- Genres --}}
        <div class="field-group span-3">
            <label>{{ __('Genre(s)') }}</label>
            <div class="checkbox-inline">
                @php $selectedGenres = old('genre_ids', $game->genres->pluck('id')->toArray()); @endphp
                @foreach($genres as $genre)
                    <label class="check-label">
                        <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                               {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }}>
                        {{ $genre->name }}
                    </label>
                @endforeach
            </div>
        </div>

    </form>

    {{-- Textareas --}}
    <div class="textarea-group">
        <label for="summary">{{ __('Summary') }} <span class="req">*</span></label>
        <textarea id="summary" name="summary" form="game-form"
                  class="{{ $errors->has('summary') ? 'is-invalid' : '' }}">{{ old('summary', $game->summary) }}</textarea>
        @error('summary')<span class="field-error">{{ $message }}</span>@enderror
    </div>

    <div class="textarea-group">
        <label for="description">{{ __('Description') }} <span class="req">*</span></label>
        <textarea id="description" name="description" form="game-form"
                  class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $game->description) }}</textarea>
        @error('description')<span class="field-error">{{ $message }}</span>@enderror
    </div>

    <div class="textarea-group">
        <label for="system_requirements">{{ __('System Requirements') }}</label>
        <textarea id="system_requirements" name="system_requirements" form="game-form">{{ old('system_requirements', $game->system_requirements) }}</textarea>
    </div>

    {{-- ── MEDIA ── --}}
    <div class="section-title">{{ __('Media (image links)') }}</div>

    @php
        $mediaPoster   = $game->media->where('type', 'poster')->first();
        $mediaBanner   = $game->media->where('type', 'banner')->first();
        $mediaVideo    = $game->media->where('type', 'video')->first();
        $mediaGameplay = $game->media->where('type', 'gameplay');
    @endphp

    <div class="media-grid">

        {{-- Poster --}}
        <div class="field-group media-field">
            <label>{{ __('Poster URL') }}</label>
            @if($mediaPoster)
                <div class="media-preview">
                    <img src="{{ $mediaPoster->path }}" alt="{{ __('Poster') }}">
                    <form method="POST" action="{{ route('admin.games.media.destroy', [$game, $mediaPoster]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="remove-media" title="{{ __('Remove') }}">✕</button>
                    </form>
                </div>
            @endif
            <input type="url" name="media_poster" form="game-form"
                   value="{{ old('media_poster', $mediaPoster?->path) }}"
                   placeholder="https://...">
            @error('media_poster')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Banner --}}
        <div class="field-group media-field">
            <label>{{ __('Banner URL') }}</label>
            @if($mediaBanner)
                <div class="media-preview">
                    <img src="{{ $mediaBanner->path }}" alt="{{ __('Banner') }}">
                    <form method="POST" action="{{ route('admin.games.media.destroy', [$game, $mediaBanner]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="remove-media" title="{{ __('Remove') }}">✕</button>
                    </form>
                </div>
            @endif
            <input type="url" name="media_banner" form="game-form"
                   value="{{ old('media_banner', $mediaBanner?->path) }}"
                   placeholder="https://...">
            @error('media_banner')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        {{-- Video YouTube --}}
        <div class="field-group media-field">
            <label>{{ __('YouTube Video URL') }}</label>
            @if($mediaVideo)
                <div class="media-preview video-preview">
                    <span class="video-icon">▶</span>
                    <a href="{{ $mediaVideo->path }}" target="_blank" class="video-link">
                        {{ Str::limit($mediaVideo->path, 40) }}
                    </a>
                    <form method="POST" action="{{ route('admin.games.media.destroy', [$game, $mediaVideo]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="remove-media" title="{{ __('Remove') }}">✕</button>
                    </form>
                </div>
            @endif
            <input type="url" name="media_video" form="game-form"
                   value="{{ old('media_video', $mediaVideo?->path) }}"
                   placeholder="https://www.youtube.com/watch?v=...">
            @error('media_video')<span class="field-error">{{ $message }}</span>@enderror
        </div>

    </div>

    {{-- Gameplay screenshots --}}
    <div class="images-header">
        <span>{{ __('Gameplay Screenshots') }}</span>
        <button type="button" class="add-btn" id="add-gameplay">+ {{ __('Add Image') }}</button>
    </div>

    {{-- Existing gameplay images --}}
    @if($mediaGameplay->count())
        <div class="existing-gameplay">
            @foreach($mediaGameplay as $gp)
                <div class="gameplay-existing-item">
                    <img src="{{ $gp->path }}" alt="{{ __('Gameplay') }}">
                    <form method="POST" action="{{ route('admin.games.media.destroy', [$game, $gp]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="remove-media-sm">✕</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <div id="gameplay-list" class="gameplay-list">
        @if(old('media_gameplay'))
            @foreach(old('media_gameplay') as $gpUrl)
                <div class="gameplay-item">
                    <input type="url" name="media_gameplay[]" form="game-form"
                           value="{{ $gpUrl }}" placeholder="https://...">
                    <button type="button" class="remove-gameplay">✕</button>
                </div>
            @endforeach
        @else
            <div class="gameplay-item">
                <input type="url" name="media_gameplay[]" form="game-form" placeholder="{{ __('Add new screenshot URL…') }}">
                <button type="button" class="remove-gameplay">✕</button>
            </div>
        @endif
    </div>

    {{-- ── VERSIONS ── --}}
    <div class="section-title">{{ __('Game Versions / Editions') }}</div>

    <div id="versions-list">
        @foreach($game->versions as $i => $version)
            <div class="version-row" data-index="{{ $i }}">
                <input type="hidden" name="versions[{{ $i }}][id]" value="{{ $version->id }}" form="game-form">
                <div class="version-grid">
                    <div class="field-group">
                        <label>{{ __('Edition Name') }} <span class="req">*</span></label>
                        <input type="text" name="versions[{{ $i }}][edition_name]" form="game-form"
                               value="{{ old("versions.$i.edition_name", $version->edition_name) }}">
                    </div>
                    <div class="field-group">
                        <label>{{ __('Platform') }} <span class="req">*</span></label>
                        <select name="versions[{{ $i }}][platform_id]" form="game-form">
                            @foreach($platforms as $p)
                                <option value="{{ $p->id }}"
                                    {{ old("versions.$i.platform_id", $version->platform_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field-group">
                        <label>{{ __('Base Price') }} <span class="req">*</span></label>
                        <input type="number" step="0.01" name="versions[{{ $i }}][base_price]" form="game-form"
                               value="{{ old("versions.$i.base_price", $version->base_price) }}">
                    </div>
                    <div class="field-group">
                        <label>{{ __('Final Price') }} <span class="req">*</span></label>
                        <input type="number" step="0.01" name="versions[{{ $i }}][final_price]" form="game-form"
                               value="{{ old("versions.$i.final_price", $version->final_price) }}">
                    </div>
                    <div class="field-group">
                        <label>{{ __('Stock') }} <span class="req">*</span></label>
                        <input type="number" name="versions[{{ $i }}][stock]" form="game-form"
                               value="{{ old("versions.$i.stock", $version->stock) }}">
                    </div>
                    <div class="field-group">
                        <label>{{ __('Active') }}</label>
                        <select name="versions[{{ $i }}][active]" form="game-form">
                            <option value="1" {{ old("versions.$i.active", $version->active) ? 'selected' : '' }}>{{ __('Yes') }}</option>
                            <option value="0" {{ !old("versions.$i.active", $version->active) ? 'selected' : '' }}>{{ __('No') }}</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="remove-version">✕ {{ __('Remove') }}</button>
            </div>
        @endforeach
    </div>

    <button type="button" class="add-btn" id="add-version">+ {{ __('Add Version') }}</button>

    {{-- ── ACTIONS ── --}}
    <div class="actions">
        <form method="GET" action="{{ route('admin.games.delete', $game) }}"
              onsubmit="return confirm('{{ __('Delete :name permanently?', ['name' => $game->name]) }}')">
            @csrf
            <button type="submit" class="delete">{{ __('Delete Game') }}</button>
        </form>
        <button class="save" type="submit" form="game-form">{{ __('Save Changes') }}</button>
    </div>

</div>
</div>

<script>
    /* ── Gameplay screenshots ── */
    document.getElementById('add-gameplay').addEventListener('click', function () {
        const list = document.getElementById('gameplay-list')
        const div  = document.createElement('div')
        div.className = 'gameplay-item'
        div.innerHTML = `<input type="url" name="media_gameplay[]" form="game-form" placeholder="https://...">
                         <button type="button" class="remove-gameplay">✕</button>`
        list.appendChild(div)
        div.querySelector('.remove-gameplay').addEventListener('click', () => div.remove())
    })
    document.querySelectorAll('.remove-gameplay').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.gameplay-item').remove())
    })

    /* ── Versions ── */
    let versionIndex = {{ $game->versions->count() }}
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
