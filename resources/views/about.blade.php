<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ __('Welcome to After') }}</title>
     @vite(['resources/css/app.css', 'resources/css/about.css'])
  </head>
  <body>
   @include('components/header_client')
    <section class="main-bg">
      <main>
        <div>
          <h1><span>AFTER</span> {{ __('Indie Gaming Marketplace') }}</h1>
          <p>
            {{ __('From indie game developers and studios to players interested in support the community while having fun, explore a collaborative marketplace with dozens of games and opportunities for creators who want their games to get on the hands of people') }}
          </p>
          <a href="{{ route('games.index') }}" class="btn-cta">{{ __('Start & See Games') }}</a>
        </div>
        <img src="{{ asset('imgs/hollow-knight.png') }}" alt="" />
      </main>
    </section>
    <section class="steps-section">
      <h2>{{ __('How It Works?') }}</h2>
      <p>
        {{ __('Enjoy and support the unique world of indie games with fair prices and special discounts') }}
      </p>
      <div class="sequence-container">
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/cursor-click-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('1. Select your Game') }}</h3>
          <p>
            {{ __('Choose many titles from our catalog, considering the platform you want to play them!') }}
          </p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/cart-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('2. Purchase') }}</h3>
          <p>{{ __('Buy quickly and easily, enjoying frequent special discounts') }}</p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/access-key-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('3. Get Your Access Keys') }}</h3>
          <p>
            {{ __('Receive your access keys on email for the chosen games and start playing right away!') }}
          </p>
        </div>
      </div>
      <button class="btn-tutorial">{{ __('Doubts? See Our Tutorial') }}</button>
    </section>
    <section class="steps-section">
      <h2>{{ __('Our Gamified Approach') }}</h2>
      <p>
        {{ __('Enjoy and support the unique world of indie games with fair prices and special discounts') }}
      </p>
      <div class="sequence-container">
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/level-up-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('1. Earn Points & Level Up') }}</h3>
          <p>
            {{ __('As you buy new games (even free ones!), you level up and earn coins.') }}
          </p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/coin-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('2. Earn Discounts') }}</h3>
          <p>{{ __('Spend your coins as DISCOUNTS and enjoy frequent special discounts.') }}</p>
        </div>
        <div class="sequence-unit">
          <div class="sequence-square">
            <img src="{{ asset('icons/repeat-icon.svg') }}" alt="" />
          </div>
          <h3>{{ __('3. Repeat') }}</h3>
          <p>
            {{ __('Comeback often to explore After catalog and experience the indie gaming world.') }}
          </p>
        </div>
      </div>
      <div class="prints-row">
        <img src="{{ asset('imgs/after-print1.png') }}" alt="" />
        <img src="{{ asset('imgs/after-print2.png') }}" alt="" />
      </div>
    </section>
    <section>
      <h2>{{ __('Available Games') }}</h2>
      <div class="game-row about-game-row">
        @forelse($games as $game)
          <x-game-card :game="$game" />
        @empty
          <div class="empty-games">
            <p>{{ __('No games available yet. Check the catalog again soon.') }}</p>
          </div>
        @endforelse
      </div>
      <a href="{{ route('games.index') }}" class="btn-catalog">{{ __('See Catalog') }}</a>
    </section>
    <section>
      <div class="community-container">
        <h2>{{ __('Join Our Community') }}</h2>
        <p>{{ __('Be a part of the After Community Today, enjoying our games and making your way on the indie world.') }}</p>
        <div class="community-row">
          
          <div class="community-list">
            <div class="community-list-item">
              <h3>{{ __('Popularize Your Games') }}</h3>
              <p>
               {{ __('Contact After and start selling your game access keys. We only take 5% of the revenue.') }}
              </p>
            </div>
            <div class="community-list-item">
              <h3>{{ __('Best Prices') }}</h3>
              <p>
                {{ __('With affordable prices and various discounts, you’ll surely fill your cart with indie games.') }}
              </p>
            </div>
            <div class="community-list-item">
              <h3>{{ __('Support for the Indie Community') }}</h3>
              <p>
                  {{ __('While you buy games for yourself, you’re also supporting an entire community with your decision.') }}
              </p>
            </div>
          </div>
          <img src="{{ asset('imgs/after-logo-roxa.png') }}" alt="" />
        </div>

      </div>
      <a href="{{ route('games.index') }}" class="btn-cta btn-last">{{ __('Start & See Games') }}</a>
    </section>
      @include('components/footer')
  </body>
</html>
