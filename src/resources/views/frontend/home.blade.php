<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
  @vite(['resources/css/app.css', 'resources/css/frontend/home.css'])
  </head>
  <body>
    @include('components/header_client')
    <main>
      <div class="top-banner">
        <p>
          <span> [userName] </span>
          <span> {{ __('Level') }} 5</span>
          <span> {{ __('Next Level Reward') }}: 300 {{ __('Coins') }}  <img src="{{ asset('icons/coin-icon.svg') }}" alt="" /></span>
        </p>
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
              <button>{{ __('Buy Now') }}</button>
              <button>
                <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="bookmark-icon" />
              </button>
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
      <button class="catalog-btn">{{ __('See Full Catalog') }}</button>
    </section>
   @include('components/footer')
  </body>
</html>
