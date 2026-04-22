<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to After</title>
     @vite(['resources/css/app.css', 'resources/css/index.css'])
  </head>
  <body>
   @include('components/header_guest')
    <section class="main-bg">
      <main>
        <div>
          <h1><span>AFTER</span> Indie Gaming Marketplace</h1>
          <p>
            From indie game developers and studios to players interested in
            support the community while having fun, explore a collaborative
            marketplace with dozens of games and opportunities for creators who
            want their games to get on the hands of people
          </p>
          <button class="btn-cta">Start & See Games</button>
        </div>
        <img src="{{ asset('imgs/hollow-knight.png') }}" alt="" />
      </main>
    </section>
    <section>
      <h2>How It Works?</h2>
      <p>
        Enjoy support the unique world of indie games with fair prices and
        special discounts
      </p>
      <div class="sequence-container">
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/cursor-click-icon.svg') }}" alt="" />
          </div>
          <p>1. Select your Game</p>
          <p>
            Choose many titles from our catalog, considering the platform you
            want to play them!
          </p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/cart-icon.svg') }}" alt="" />
          </div>
          <p>2. Purchase</p>
          <p>Buy quickly and easily, enjoying frequent special discounts</p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/access-key-icon.svg') }}" alt="" />
          </div>
          <p>3. Get Your Access Keys</p>
          <p>
            Receive your access keys on email for the chosen games and start
            playing right away!
          </p>
        </div>
      </div>
      <button class="btn-tutorial">Doubts? See Our Tutorial</button>
    </section>
    <section>
      <h2>Our Gamified Approach</h2>
      <p>
        Enjoy ! support the unique world of indie games with fair prices and
        special discounts
      </p>
      <div class="sequence-container">
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/level-up-icon.svg') }}" alt="" />
          </div>
          <p>1. Earn Points and Level Up</p>
          <p>
            Choose many titles from our catalog, considering the platform you
            want to play them!
          </p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/coin-icon.svg') }}" alt="" />
          </div>
          <p>2. Earn Discounts</p>
          <p>Spend your coins as DISCOUNTS and enjoy frequent special discounts</p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/repeat-icon.svg') }}" alt="" />
          </div>
          <p>3. Repeat</p>
          <p>
            Receive your access keys on email for the chosen games and start
            playing right away!
          </p>
        </div>
      </div>
      <div class="prints-row">
        <img src="{{ asset('imgs/after-print1.png') }}" alt="" />
        <img src="{{ asset('imgs/after-print2.png') }}" alt="" />
      </div>
    </section>
    <section>
      <h2>Available Games</h2>
      <div class="game-row">
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
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
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
         <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
        <div class="game-card">
          <img src="{{ asset('imgs/replaced-poster.png') }}" alt="" />
          <p class="game-title">Replaced</p>
          <span class="game-discount">60%</span>
          <span class="game-old-price">$40.00</span>
          <span class="game-price">$24.00</span>
        </div>
      </div>
      <button class="btn-catalog">See Catalog</button>
    </section>
    <section>
      <div class="community-container">
        <h2>Join Our Community</h2>
        <p>Be a part of the After Community Today, enjoying our games and making your way on the indie world.</p>
        <div class="community-row">
          
          <div class="community-list">
            <div class="community-list-item">
              <h3>Popularize Your Games</h3>
              <p>
                Aliquam erat volutpat. Integer malesuada turpis id fringilla
                suscipit. Maecenas ultrices.
              </p>
            </div>
            <div class="community-list-item">
              <h3>Best Prices</h3>
              <p>
                Aliquam erat volutpat. Integer malesuada turpis id fringilla
                suscipit. Maecenas ultrices.
              </p>
            </div>
            <div class="community-list-item">
              <h3>Support for the Indie Community</h3>
              <p>
                Aliquam erat volutpat. Integer malesuada turpis id fringilla
                suscipit. Maecenas ultrices.
              </p>
            </div>
          </div>
          <img src="{{ asset('imgs/after-logo-roxa.png') }}" alt="" />
        </div>

      </div>
      <button class="btn-cta btn-last">Start & See Games</button>
    </section>
      @include('components/footer')
  </body>
</html>
