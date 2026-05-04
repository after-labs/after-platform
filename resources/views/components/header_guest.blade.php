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
        <div class="auth-buttons">
          <form method="GET" action="">
            <select onchange="window.location.href=this.value" class="language-select">
                <option value="{{ route('lang.switch', 'pt') }}" {{ session('locale', 'pt') === 'pt' ? 'selected' : '' }}>Português</option>
                <option value="{{ route('lang.switch', 'en') }}" {{ session('locale', 'en') === 'en' ? 'selected' : '' }}>English</option>
            </select>
          </form>
          <button class="btn btn-outline">{{ __('Sign Up') }}</button>
          <button class="btn btn-primary">{{ __('Login') }}</button>
        </div>
      </div>
    </header>
