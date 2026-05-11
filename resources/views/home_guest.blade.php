<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/home.css'])
  </head>
  <body>
    @include('components/header_guest')
    <main>
     <div class="top-banner">
        <p>{{ __('Welcome to After. Create an account & enjoy our games!') }}</p>
      </div>
      <div class="highlights">
        <div class="highlights-main">
          <div class="highlights-main-content">
            <h2>REPLACED 60% OFF</h2>
            <p>{{ __('Enjoy it until april 19') }}</p>
            <p>
              {{ __('Enjoy this 2.5D cinematic action platformer adventure set in an alternate 1980s America, Now Available with 60% OFF') }}
            </p>
            <div class="highlights-main-buttons">
              <a class="highlight-buy-button" href="{{ route('games.index') }}">{{ __('Buy Now') }}</a>
              <a class="highlight-wishlist-link" href="{{ route('login') }}" aria-label="{{ __('Login to save to wishlist') }}">
                <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="bookmark-icon" />
              </a>
            </div>
          </div>
          <img src="{{ asset('imgs/replaced-banner.png') }}" alt="" class="bg-image" />
        </div>
        <div class="highlights-cards">
          <div class="highlights-card">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>{{ __('Replaced 60% Off') }}</p>
          </div>
          <div class="highlights-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>{{ __('Offer Example') }}</p>
          </div>
          <div class="highlights-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>{{ __('New Game') }}</p>
          </div>
          <div class="highlights-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>{{ __('Announcement') }}</p>
          </div>
        </div>
      </div>
    </main>
    <section>
      <div class="section-header">
        <h2>{{ __('Popular') }}</h2>
        <div class="section-arrows">
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-left.svg') }}" alt="arrow-left-icon" />
          </button>
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-right.svg') }}" alt="arrow-right-icon" />
          </button>
        </div>
      </div>
      <div class="game-row">
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
      </div>
      <div class="section-header">
        <h2>{{ __('Free Demos') }}</h2>
        <div class="section-arrows">
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-left.svg') }}" alt="arrow-left-icon" />
          </button>
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-right.svg') }}" alt="arrow-right-icon" />
          </button>
        </div>
      </div>
      <div class="game-row">
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
      </div>
      <div class="section-header">
        <h2>{{ __('On Sale') }}</h2>
        <div class="section-arrows">
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-left.svg') }}" alt="arrow-left-icon" />
          </button>
          <button class="arrow-btn">
            <img src="{{ asset('icons/arrow-right.svg') }}" alt="arrow-right-icon" />
          </button>
        </div>
      </div>
      <div class="game-row">
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title"></p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
      </div>
      <a href="{{ route('games.index') }}" class="catalog-btn">{{ __('See Full Catalog') }}</a>
    </section>
   @include('components/footer')
  </body>
</html>
