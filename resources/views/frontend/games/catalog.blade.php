<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game catalog</title>
   @vite(['resources/css/app.css', 'resources/css/frontend/games/catalog.css'])
   <script src="https://fontawesome.com" crossorigin="anonymous"></script>
</head>
<body>
    @include('components/header_client')
    <main>
        <h2 class="page-title">
            @if($search)
                {{ __('Search results for') }} "{{ $search }}"
            @else
                {{ __('All Games Catalogue') }}
            @endif
        </h2>

        <div class="filter-pills">
            @foreach($categories as $category)
                <a href="{{ route('games.category', $category) }}" class="filter-pill">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
        <div class="catalog-layout">
            <!-- GRID ESQUERDA -->
            <section class="games">
                <div class="games-grid">
                    @forelse($games as $game)
                        <x-game-card :game="$game" />
                    @empty
                        <p class="empty-state">
                            {{ __('No games found.') }}
                        </p>
                    @endforelse
                </div>

                <div class="pagination">
                    {{ $games->links() }}
                </div>  
            </section>

        <!-- SIDEBAR DIREITA -->
            <aside>

                <div class="filter-top">
                    <h3>{{ __('Filters') }}</h3>
                    <button class="reset">{{ __('Reset') }}</button>
                </div>

                <details class="filter-item">
                    <summary>{{ __('Price') }}</summary>
                </details>

                <details class="filter-item">
                    <summary>{{ __('Category') }}</summary>
                </details>

                <details class="filter-item" open>
                    <summary>{{ __('Game Genre') }}</summary>

                    <div class="genre-list">
                        @foreach($categories as $category)
                            <a href="{{ route('games.category', $category) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    </details>
            </aside>
        </div>
</main>
@include('components/footer')
</body>
</html>
