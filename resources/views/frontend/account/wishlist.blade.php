<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Wishlist') }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/account/account.css', 'resources/css/frontend/account/wishlist.css'])
</head>
<body>
    @include('components/header_client')

    <main class="account-page">
        <nav class="account-tabs" aria-label="{{ __('Account navigation') }}">
            <a href="{{ route('account') }}" class="account-tab">{{ __('Account') }}</a>
            <a href="{{ route('wishlist.index') }}" class="account-tab active">{{ __('Wishlist') }}</a>
            <a href="{{ route('orders.index') }}" class="account-tab">{{ __('Orders') }}</a>
        </nav>

        <section class="account-hero">
            <div class="account-identity">
                <div>
                    <span class="account-kicker">{{ __('Saved Games') }}</span>
                    <h1>{{ __('Your wishlist') }}</h1>
                    <p>{{ __('Keep track of games you want to play later.') }}</p>
                </div>
            </div>
        </section>

        <section class="wishlist-grid">
            @forelse($items as $item)
                <article class="wishlist-item">
                    <x-game-card :game="$item->Game" />

                    <form action="{{ route('wishlist.delete', $item) }}" method="POST">
                        @csrf
                        <button type="submit">{{ __('Remove') }}</button>
                    </form>
                </article>
            @empty
                <div class="empty-state">
                    <h2>{{ __('Your wishlist is empty') }}</h2>
                    <p>{{ __('Save a game from its detail page and it will appear here.') }}</p>
                    <a href="{{ route('games.index') }}">{{ __('Browse store') }}</a>
                </div>
            @endforelse
        </section>
    </main>

    @include('components/footer')
</body>
</html>
