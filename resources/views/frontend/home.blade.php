<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('Home') }}</title>
  @vite(['resources/css/app.css', 'resources/css/frontend/home.css', 'resources/js/app.js'])
  </head>
  <body>
    @include('components/header_client')

    @php
      $highlightVersion = $highlightGame?->versions?->where('active', true)->sortBy('final_price')->first();
      $highlightDiscount = 0;

      if ($highlightVersion && $highlightVersion->base_price > 0 && $highlightVersion->base_price > $highlightVersion->final_price) {
          $highlightDiscount = round((($highlightVersion->base_price - $highlightVersion->final_price) / $highlightVersion->base_price) * 100);
      }

      $highlightMedia = $highlightGame?->banner() ?? $highlightGame?->poster();
      $highlightCards = $onSaleGames->take(4);
    @endphp

    <main
      class="home-page"
      data-catalog-link="{{ route('games.index') }}"
      data-game-link="{{ $highlightGame ? route('games.show', $highlightGame) : route('games.index') }}"
    >
      <div class="top-banner">
        <p>
          @auth
            <span>{{ auth()->user()->name }}</span>
            <span>{{ __('Level') }} {{ auth()->user()->gamification?->level ?? 1 }}</span>
            <span>{{ auth()->user()->gamification?->coins ?? 0 }} {{ __('Coins') }} <img src="{{ asset('icons/coin-icon.svg') }}" alt="" /></span>
          @else
            <span>{{ __('Explore indie games before joining After') }}</span>
            <span><a href="{{ route('register') }}">{{ __('Create account') }}</a></span>
          @endauth
        </p>
      </div>
      <div class="highlights">
        <div class="highlights-main">
          <div class="highlights-main-content">
            <h2>
              @if($highlightGame)
                {{ $highlightGame->name }} {{ $highlightDiscount > 0 ? $highlightDiscount . '% OFF' : '' }}
              @else
                {{ __('Discover Indie Games') }}
              @endif
            </h2>
            <p>{{ $highlightGame?->category?->name ?? __('After marketplace') }}</p>
            <p>
              {{ $highlightGame?->summary ?? __('Browse the catalog and find your next indie adventure.') }}
            </p>
            <div class="highlights-main-buttons">
              <a class="highlight-buy-button" href="{{ $highlightGame ? route('games.show', $highlightGame) : route('games.index') }}">{{ __('Buy Now') }}</a>

              @if($highlightGame)
                @guest
                    <a class="highlight-wishlist-link" href="{{ route('login') }}">
                      <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="{{ __('Bookmark') }}" />
                    </a>
                @else
                    <form class="highlight-wishlist-form" action="{{ route('wishlist.store', $highlightGame) }}" method="POST">
                      @csrf
                      <button type="submit" aria-label="{{ __('Save to wishlist') }}">
                        <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="{{ __('Bookmark') }}" />
                      </button>
                    </form>
                @endguest
              @else
                  <a class="highlight-wishlist-link" href="{{ route('games.index') }}">
                    <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="{{ __('Bookmark') }}" />
                  </a>
              @endif
            </div>
          </div>
          <img src="{{ asset($highlightMedia?->path ?? 'imgs/replaced-banner.png') }}" alt="" class="bg-image" />
        </div>
        <div class="highlights-cards">
          @forelse($highlightCards as $game)
            @php
              $media = $game->banner() ?? $game->poster();
            @endphp

            <div
              class="highlights-card"
              role="button"
              data-highlight-index="{{ $loop->index }}"
              data-highlight-title="{{ $game->name }}"
              data-highlight-subtitle="{{ $game->category?->name ?? __('Indie') }}"
              data-highlight-description="{{ $game->summary }}"
              data-highlight-image="{{ asset($media?->path ?? 'imgs/replaced-banner.png') }}"
              data-highlight-link="{{ route('games.show', $game) }}"
              data-highlight-wishlist-link="{{ route('wishlist.store', $game) }}"
            >
              <img src="{{ asset($game->poster()?->path ?? 'imgs/replaced-poster.png') }}" alt="" />
              <p>{{ $game->name }}</p>
            </div>
          @empty
            <div class="highlights-card" role="button" data-highlight-index="0" data-highlight-title="{{ __('Discover Indie Games') }}" data-highlight-subtitle="{{ __('After marketplace') }}" data-highlight-description="{{ __('Browse the catalog and find your next indie adventure.') }}" data-highlight-image="{{ asset('imgs/replaced-banner.png') }}" data-highlight-link="{{ route('games.index') }}">
              <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
              <p>{{ __('After Store') }}</p>
            </div>
          @endforelse
        </div>
      </div>
    </main>
    <section>
      <div class="section-header">
          <h2>{{ __('Popular') }}</h2>
          <div class="section-arrows">
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-left.svg') }}" alt="{{ __('Previous') }}" />
            </button>
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-right.svg') }}" alt="{{ __('Next') }}" />
            </button>
          </div>
      </div>
      <div class="game-row">
          @foreach($popularGames as $game)
              <x-game-card :game="$game" />
          @endforeach
      </div>
    </section>
    <section>
      <div class="section-header">
          <h2>{{ __('Free Demos') }}</h2>
          <div class="section-arrows">
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-left.svg') }}" alt="{{ __('Previous') }}" />
            </button>
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-right.svg') }}" alt="{{ __('Next') }}" />
            </button>
          </div>
      </div>
      <div class="game-row">
          @foreach($freeGames as $game)
              <x-game-card :game="$game" />
          @endforeach
      </div>
    </section>

    <section>
      <div class="section-header">
          <h2>{{ __('On Sale') }}</h2>
          <div class="section-arrows">
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-left.svg') }}" alt="{{ __('Previous') }}" />
            </button>
            <button class="arrow-btn">
              <img src="{{ asset('icons/arrow-right.svg') }}" alt="{{ __('Next') }}" />
            </button>
          </div>
      </div>
      <div class="game-row">
          @foreach($onSaleGames as $game)
              <x-game-card :game="$game" />
          @endforeach
      </div>
      <a href="{{ route('games.index') }}" class="catalog-btn">{{ __('See Full Catalog') }}</a>
    </section>

    @include('components/footer')
  </body>
</html>
