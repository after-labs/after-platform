    <header>
      @vite(['resources/css/components/header.css'])
      <div class="container">
        <div class="logo">
          <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="after-logo" />
        </div>
        <nav>
          <ul>
            <li><a href="#" class="active">{{ __('About Us') }}</a></li>
            <li><a href="#">{{ __('Games') }}</a></li>
            <li><a href="#">{{ __('Guide') }}</a></li>
            <li><a href="#">{{ __('News') }}</a></li>
            <li><a href="#">{{ __('Backstage') }}</a></li>
          </ul>
        </nav>
        @if (Route::has('login'))
                <nav class="auth-buttons">
                    <form method="GET" action="">
                      <select onchange="window.location.href=this.value" class="language-select">
                          <option value="{{ route('lang.switch', 'pt') }}" {{ session('locale', 'pt') === 'pt' ? 'selected' : '' }}>Português</option>
                          <option value="{{ route('lang.switch', 'en') }}" {{ session('locale', 'en') === 'en' ? 'selected' : '' }}>English</option>
                      </select>
                    </form>
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="btn-outline"
                        >
                            Dashboard
                        </a>
                    @else
                        <a class="btn btn-primary"  href="{{ route('login') }}">{{ __('Login') }}</a>

                        <a class="btn btn-outline" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                    @endauth
                </nav>
            @endif
      </div>
    </header>
