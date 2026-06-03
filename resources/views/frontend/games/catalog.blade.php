<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Game catalog') }}</title>
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

        @php
            $removeFilterUrl = function ($key, $value = null) {
                $query = request()->query();
                unset($query['page']);

                if ($value === null) {
                    unset($query[$key]);
                } else {
                    $values = array_values(array_filter((array) ($query[$key] ?? []), fn($item) => (string) $item !== (string) $value));

                    if ($values) {
                        $query[$key] = $values;
                    } else {
                        unset($query[$key]);
                    }
                }

                return route('games.index', $query);
            };

            $priceLabels = [
                'free' => __('Free'),
                'sale' => __('On Sale'),
                'paid' => __('Paid'),
            ];
        @endphp

        @if($search || $categoryIds || $genreIds || $platformIds || $priceFilter)
            <div class="filter-pills">
                @if($search)
                    <a href="{{ $removeFilterUrl('search') }}" class="filter-pill">
                        <span>{{ __('Search') }}: {{ $search }}</span>
                        <span class="filter-pill-x">&times;</span>
                    </a>
                @endif

                @foreach($categories->whereIn('id', $categoryIds) as $category)
                    <a href="{{ $removeFilterUrl('category_id', $category->id) }}" class="filter-pill">
                        <span>{{ $category->name }}</span>
                        <span class="filter-pill-x">&times;</span>
                    </a>
                @endforeach

                @foreach($genres->whereIn('id', $genreIds) as $genre)
                    <a href="{{ $removeFilterUrl('genre_id', $genre->id) }}" class="filter-pill">
                        <span>{{ $genre->name }}</span>
                        <span class="filter-pill-x">&times;</span>
                    </a>
                @endforeach

                @foreach($platforms->whereIn('id', $platformIds) as $platform)
                    <a href="{{ $removeFilterUrl('platform_id', $platform->id) }}" class="filter-pill">
                        <span>{{ $platform->name }}</span>
                        <span class="filter-pill-x">&times;</span>
                    </a>
                @endforeach

                @if($priceFilter && isset($priceLabels[$priceFilter]))
                    <a href="{{ $removeFilterUrl('price') }}" class="filter-pill">
                        <span>{{ $priceLabels[$priceFilter] }}</span>
                        <span class="filter-pill-x">&times;</span>
                    </a>
                @endif
            </div>
        @endif
        <div class="catalog-layout">
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

            <aside>
                <form method="GET" action="{{ route('games.index') }}" class="filter-form">
                    @if($search)
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif

                    <div class="filter-top">
                        <h3>{{ __('Filters') }}</h3>
                        <a class="reset" href="{{ route('games.index') }}">{{ __('Reset') }}</a>
                    </div>

                    <details class="filter-item" open>
                        <summary>{{ __('Price') }}</summary>
                        <div class="filter-options">
                            @foreach($priceLabels as $value => $label)
                                <label>
                                    <input type="radio" name="price" value="{{ $value }}" @checked($priceFilter === $value)>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>

                    <details class="filter-item" open>
                        <summary>{{ __('Category') }}</summary>
                        <div class="filter-options">
                            @foreach($categories as $category)
                                <label>
                                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}" @checked(in_array($category->id, $categoryIds))>
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>

                    <details class="filter-item" open>
                        <summary>{{ __('Game Genre') }}</summary>
                        <div class="filter-options">
                            @foreach($genres as $genre)
                                <label>
                                    <input type="checkbox" name="genre_id[]" value="{{ $genre->id }}" @checked(in_array($genre->id, $genreIds))>
                                    <span>{{ $genre->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>

                    <details class="filter-item" open>
                        <summary>{{ __('Platform') }}</summary>
                        <div class="filter-options">
                            @foreach($platforms as $platform)
                                <label>
                                    <input type="checkbox" name="platform_id[]" value="{{ $platform->id }}" @checked(in_array($platform->id, $platformIds))>
                                    <span>{{ $platform->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>

                    <button class="filter-submit" type="submit">{{ __('Apply Filters') }}</button>
                </form>
            </aside>
        </div>
</main>
@include('components/footer')
</body>
</html>
