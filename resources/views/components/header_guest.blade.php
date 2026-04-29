    <header>
      @vite(['resources/css/components/header.css'])
      <div class="container">
        <div class="logo">
          <img src="{{ asset('icons/after-logomarca-branco.svg') }}" alt="after-logo" />
        </div>
        <nav>
          <ul>
            <li><a href="#" class="active">About Us</a></li>
            <li><a href="#">Games</a></li>
            <li><a href="#">Guide</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Backstage</a></li>
          </ul>
        </nav>
        @if (Route::has('login'))
                <nav class="auth-buttons">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="btn-outline"
                        >
                            Dashboard
                        </a>
                    @else
                        <a class="btn btn-primary"  href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                        <a class="btn btn-outline" href="{{ route('register') }}">Sign Up</a>
                        @endif
                    @endauth
                </nav>
            @endif
      </div>
    </header>
