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
        <p>Welcome to After. Create an account & enjoy our games!</p>
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
          <div class="highlights-card">
            <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>Replaced 60% Off</p>
          </div>
          <div class="highlights-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>Offer Example</p>
          </div>
          <div class="highlights-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
            <p>New Game</p>
          </div>
          <div class="highlights-card">
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
      <button class="catalog-btn">See Full Catalog</button>
    </section>
   @include('components/footer')
  </body>
</html>
