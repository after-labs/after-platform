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
                            class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal"
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
