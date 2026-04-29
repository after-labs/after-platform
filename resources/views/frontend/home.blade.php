<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
  @vite(['resources/css/app.css', 'resources/css/frontend/home.css', 'resources/js/app.js'])
  </head>
  <body>
    @include('components/header_client')
    <main class="home-page" data-catalog-link="{{ route('games.catalog') }}" data-game-link="{{ route('games.show', 'replaced') }}">
      <div class="top-banner">
        <p>
          <span> [userName] </span>
          <span> Level 5</span>
          <span> Next Level Reward: 300 coins  <img src="{{ asset('icons/coin-icon.svg') }}" alt="" /></span>
        </p>
      </div>
      <div class="highlights">
        <div class="highlights-main">
          <div class="highlights-main-content">
            <h2>REPLACED 60% OFF</h2>
            <p>Enjoy it until april 19</p>
            <p>
              Enjoy this 2.5D cinematic action platformer adventure set in an
              alternate 1980s America, Now Available with 60% OFF
            </p>
            <div class="highlights-main-buttons">
              <button>Buy Now</button>
              <button>
                <img src="{{ asset('icons/bookmark-icon.svg') }}" alt="bookmark-icon" />
              </button>
            </div>
          </div>
          <img src="{{ asset('imgs/replaced-banner.png') }}" alt="" class="bg-image" />
        </div>
        <div class="highlights-cards">
          <div class="highlights-card" role="button" data-highlight-index="0" data-highlight-title="REPLACED 60% OFF" data-highlight-subtitle="Enjoy it until april 19" data-highlight-description="Enjoy this 2.5D cinematic action platformer adventure set in an alternate 1980s America, now available with 60% OFF" data-highlight-image="{{ asset('imgs/replaced-banner.png') }}" data-highlight-link="{{ route('games.show', 'replaced') }}">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>Replaced 60% Off</p>
          </div>
          <div class="highlights-card" role="button" data-highlight-index="1" data-highlight-title="SPRING SALE EVENT" data-highlight-subtitle="Limited time only" data-highlight-description="Enjoy bonus coins and fresh indie titles with our spring discounts, available for a short window." data-highlight-image="{{ asset('imgs/replaced-banner.png') }}" data-highlight-link="{{ route('games.show', 'replaced') }}">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>Offer Example</p>
          </div>
          <div class="highlights-card" role="button" data-highlight-index="2" data-highlight-title="NEW GAME LAUNCH" data-highlight-subtitle="Discover our latest indie release" data-highlight-description="Explore a new adventure with a fresh storyline, unique art direction, and launch discounts." data-highlight-image="{{ asset('imgs/replaced-banner.png') }}" data-highlight-link="{{ route('games.show', 'replaced') }}">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>New Game</p>
          </div>
          <div class="highlights-card" role="button" data-highlight-index="3" data-highlight-title="ANNOUNCEMENT" data-highlight-subtitle="New features incoming" data-highlight-description="Our marketplace is growing with new tools, rewards, and curated indie drops for players like you." data-highlight-image="{{ asset('imgs/replaced-banner.png') }}" data-highlight-link="{{ route('games.show', 'replaced') }}">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>Announcement</p>
          </div>
        </div>
      </div>
    </main>
    <section>
      <div class="section-header">
        <h2>Popular</h2>
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
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="Replaced" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/hk-poster.jpg') }}" alt="Hollow Knight" />
          <p class="game-title">Hollow Knight</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$19.99</span>
          <span class="game-price">$12.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/valheim-poster.jpg') }}" alt="Valheim" />
          <p class="game-title">Valheim</p>
          <span class="game-discount">35%</span>
          <span class="game-old-price">$29.99</span>
          <span class="game-price">$19.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/bighops-poster.jpg') }}" alt="Big Hops" />
          <p class="game-title">Big Hops</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$14.99</span>
          <span class="game-price">$9.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/dropshot-poster.jpg') }}" alt="Drop Shot" />
          <p class="game-title">Drop Shot</p>
          <span class="game-discount">45%</span>
          <span class="game-old-price">$22.99</span>
          <span class="game-price">$14.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="Replaced" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
      </div>
    </section>
    <section>
      <div class="section-header">
        <h2>Free Demos</h2>
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
          <img src="{{ asset('imgs/hk-poster.jpg') }}" alt="Hollow Knight" />
          <p class="game-title">Hollow Knight</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$19.99</span>
          <span class="game-price">$12.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/bighops-poster.jpg') }}" alt="Big Hops" />
          <p class="game-title">Big Hops</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$14.99</span>
          <span class="game-price">$9.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/dropshot-poster.jpg') }}" alt="Drop Shot" />
          <p class="game-title">Drop Shot</p>
          <span class="game-discount">45%</span>
          <span class="game-old-price">$22.99</span>
          <span class="game-price">$14.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/valheim-poster.jpg') }}" alt="Valheim" />
          <p class="game-title">Valheim</p>
          <span class="game-discount">35%</span>
          <span class="game-old-price">$29.99</span>
          <span class="game-price">$19.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="Replaced" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/hk-poster.jpg') }}" alt="Hollow Knight" />
          <p class="game-title">Hollow Knight</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$19.99</span>
          <span class="game-price">$12.99</span>
        </div>
      </div>
    </section>
    <section>
      <div class="section-header">
        <h2>On Sale</h2>
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
          <img src="{{ asset('imgs/dropshot-poster.jpg') }}" alt="Drop Shot" />
          <p class="game-title">Drop Shot</p>
          <span class="game-discount">45%</span>
          <span class="game-old-price">$22.99</span>
          <span class="game-price">$14.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/valheim-poster.jpg') }}" alt="Valheim" />
          <p class="game-title">Valheim</p>
          <span class="game-discount">35%</span>
          <span class="game-old-price">$29.99</span>
          <span class="game-price">$19.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/bighops-poster.jpg') }}" alt="Big Hops" />
          <p class="game-title">Big Hops</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$14.99</span>
          <span class="game-price">$9.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="Replaced" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/hk-poster.jpg') }}" alt="Hollow Knight" />
          <p class="game-title">Hollow Knight</p>
          <span class="game-discount">50%</span>
          <span class="game-old-price">$19.99</span>
          <span class="game-price">$12.99</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/valheim-poster.jpg') }}" alt="Valheim" />
          <p class="game-title">Valheim</p>
          <span class="game-discount">35%</span>
          <span class="game-old-price">$29.99</span>
          <span class="game-price">$19.99</span>
        </div>
      </div>
    </section>  
      <button class="catalog-btn">See Full Catalog</button>
    </section>
   @include('components/footer')
  </body>
</html>
