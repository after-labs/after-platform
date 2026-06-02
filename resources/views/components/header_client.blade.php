    @auth
      @php
        $notifications = auth()->user()->notifications()->latest()->limit(6)->get();
        $unreadNotifications = auth()->user()->notifications()->whereNull('read_at')->count();
      @endphp
    @endauth

    <header>
      @vite(['resources/css/components/header.css'])
      <div class="container">
        <div class="logo">
            <a href="{{ route('home') }}">
              <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="after-logo" />
            </a>
        </div>

        <form action="{{ route('games.index') }}" method="GET" class="search-container">
            <img src="{{ asset('icons/search-icon.svg') }}" alt="" class="search-icon" />
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('Search...') }}"
            >
        </form>
        <nav>
          <ul>
            <li><a href="{{ route('games.index') }}">{{ __('Store') }}</a></li>

            @auth
              <li><a href="{{ route('orders.index') }}">{{ __('My Orders') }}</a></li>
              <li>
                <button type="button" class="points-trigger nav-action-button" onclick="togglePoints()">
                  {{ auth()->user()->gamification?->coins ?? 0 }}
                  <img src="{{ asset('icons/coin-icon.svg') }}" alt="" />
                </button>
              </li>

            @else
              <li>
                <a href="{{ route('about') }}">{{ __('About') }}</a>
              </li>
            @endauth

            <li>
               <form method="GET" action="">
                  <select onchange="window.location.href=this.value" class="language-select">
                      <option value="{{ route('lang.switch', 'pt') }}" {{ session('locale', 'pt') === 'pt' ? 'selected' : '' }}>Português</option>
                      <option value="{{ route('lang.switch', 'en') }}" {{ session('locale', 'en') === 'en' ? 'selected' : '' }}>English</option>
                  </select>
                </form>
            </li>
            <ul class="icon-group">
              @auth
                <li>
                  <a href="{{ route('cart.index') }}"><img src="{{ asset('icons/cart-icon.svg') }}" alt="{{ __('Cart') }}" /></a>
                </li>
                <li>
                  <button type="button" class="notif-trigger nav-action-button" onclick="toggleNotif()">
                    <img src="{{ asset('icons/bell-icon.svg') }}" alt="{{ __('Notifications') }}" />
                    @if($unreadNotifications > 0)
                      <span class="notif-count">{{ $unreadNotifications }}</span>
                    @endif
                  </button>
                </li>
                <li>
                  <a href="{{ route('account') }}"><img src="{{ asset('icons/user-icon.svg') }}" alt="{{ __('Account') }}" /></a>
                </li>
              @else
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
              @endauth
            </ul>
          </ul>
        </nav>
      </div>
    </header>

    @auth
    <div class="points-container hidden">
      <button onclick="togglePoints()" class="btn-close-points">
        <img src="{{ asset('icons/close-icon.svg') }}" alt="close-button" />
      </button>
      <h4 class="points-title">{{ __('Pontuation System') }}</h4>
      <p class="points-description">
        {{ __('As you buy games, receive xp points, level up and earn coins to spend as discounts on our indie games!') }}
      </p>
      <div class="points-progress">
        <div class="level-row">
          <div class="level-unit">
            <span>{{ __('Your Level') }}</span>
            <span>{{ __('Level') }} {{ auth()->user()->gamification?->level ?? 1 }}</span>
          </div>
          <div class="level-unit">
            <span>{{ __('Next Level') }}</span>
            <span>{{ __('Level') }} {{ (auth()->user()->gamification?->level ?? 1) + 1 }}</span>
          </div>
        </div>
        <div class="points-progress">
          <div class="progress-labels">
            <span>{{ __('Level Progress') }}</span>
            <span><strong>{{ auth()->user()->gamification?->points ?? 0 }}</strong> {{ __('Points') }}</span>
          </div>
          <div class="progress-container">
            <div class="progress-fill" style="width: 70%">70%</div>
          </div>
           <div class="progress-labels">
            <span>{{ __('Your Total Points') }}</span>
            <span><strong>{{ auth()->user()->gamification?->points ?? 0 }}</strong> {{ __('Points') }}</span>
          </div>
        </div>
        <div class="reward-unit">
          <span>{{ __('Next Level Reward') }}</span>
          <span>250<img src="{{ asset('icons/coin-icon.svg') }}" alt="" /></span>
        </div>
      </div>
    </div>

    <div id="notif-box" class="notif-box hidden">
      <div class="notif-header">
        <span>{{ __('Notifications') }}</span>
        <button onclick="toggleNotif()">
          <img src="{{ asset('icons/close-icon.svg') }}" alt="close-button" />
        </button>
      </div>
      <div id="notif-list" class="notif-list">
        @forelse($notifications as $notification)
          <div class="notif-item">
            <div class="notif-title">{{ __($notification->title) }}</div>
            <div class="notif-desc">{{ __($notification->description) }}</div>
            <div class="notif-time">{{ $notification->created_at->diffForHumans() }}</div>
          </div>
        @empty
          <div class="notif-item">
            <div class="notif-title">{{ __('No notifications yet') }}</div>
            <div class="notif-desc">{{ __('Your updates will appear here.') }}</div>
          </div>
        @endforelse
      </div>
    </div>

    <script>
      function togglePoints() {
        const box = document.querySelector('.points-container')
        box.classList.toggle('hidden')
      }

      function toggleNotif() {
        const box = document.getElementById('notif-box')
        box.classList.toggle('hidden')
      }
    </script>
    @endauth
