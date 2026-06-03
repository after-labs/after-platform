<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/games/catalog.css'])
</head>
<body>
    @include('components/header_client')

    <main>
        <h2 class="page-title">{{ $category->name }}</h2>

        <div class="filter-pills">
            <a href="{{ route('games.index') }}" class="filter-pill">
                {{ __('All Games') }}
            </a>

            @foreach($categories as $categoryItem)
                <a
                    href="{{ route('games.category', $categoryItem) }}"
                    class="filter-pill {{ $categoryItem->is($category) ? 'active' : '' }}"
                >
                    {{ $categoryItem->name }}
                </a>
            @endforeach
        </div>

        <div class="catalog-layout-center">
            <section class="games">
                <div class="games-grid">
                    @forelse($games as $game)
                        <x-game-card :game="$game" />
                    @empty
                        <p class="empty-state">
                            {{ __('No games found in this category.') }}
                        </p>
                    @endforelse
                </div>

                <div class="pagination">
                    {{ $games->links() }}
                </div>
            </section>
        </div>
    </main>

    @include('components/footer')
</body>
</html>
