<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->name }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/games/show.css'])
</head>
<body>
    @include('components/header_client')

    @php
        $banner = $game->banner() ?? $game->media->first();
        $poster = $game->poster() ?? $game->media->first();
        $gameplays = $game->gameplays()->take(4);
        $versions = $game->versions->where('active', true);
        $selectedVersion = $versions->sortBy('final_price')->first();
        $genres = $game->genres->pluck('name')->join(', ');
    @endphp

    <div class="store-container">
        <div class="content-left">
            <div class="main-preview">
                <img
                    src="{{ asset($banner?->path ?? $poster?->path ?? 'imgs/replaced-banner.png') }}"
                    alt="{{ $game->name }}"
                    class="featured-image"
                >
            </div>

            @if($gameplays->isNotEmpty())
                <div class="thumbnail-list">
                    @foreach($gameplays as $media)
                        <div class="thumb {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ asset($media->path) }}" alt="{{ $game->name }}">
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="about-section">
                <h2>{{ __('About this game') }}</h2>

                <div class="description-text">
                    <p>{{ $game->description }}</p>
                    <p>{{ $game->system_requirements }}</p>
                </div>
            </div>
        </div>

        <div class="sidebar-right">
            <div class="game-header">
                @if($game->featured)
                    <span class="badge-popular">{{ __('Popular') }}</span>
                @endif

                <h1>{{ $game->name }}</h1>
                <p class="game-subtitle">{{ $game->summary }}</p>
            </div>

            @if($selectedVersion)
                <div class="price-container">
                    <span class="current-price">${{ number_format($selectedVersion->final_price, 2) }}</span>

                    @if($selectedVersion->base_price > $selectedVersion->final_price)
                        <span class="original-price">${{ number_format($selectedVersion->base_price, 2) }}</span>
                    @endif
                </div>
            @else
                <div class="price-container">
                    <span class="current-price">{{ __('Coming soon') }}</span>
                </div>
            @endif

            <div class="game-meta">
                <div><strong>{{ __('Developer:') }}</strong> {{ $game->developer }}</div>
                <div><strong>{{ __('Release:') }}</strong> {{ $game->release_date }}</div>
                <div><strong>{{ __('Category:') }}</strong> {{ $game->category?->name ?? __('Indie') }}</div>
                <div><strong>{{ __('Genre:') }}</strong> {{ $genres ?: __('Not informed') }}</div>
                <div><strong>{{ __('Age rating:') }}</strong> {{ $game->age }}+</div>
            </div>

            <div class="platform-section">
                <span class="platform-title">{{ __('Available Versions') }}</span>

                <div class="platform-options">
                    @forelse($versions as $version)
                        <div class="platform-card {{ $loop->first ? 'active' : '' }}">
                            <span>{{ $version->edition_name }}</span>
                            <span>{{ $version->platform?->name ?? __('Platform') }}</span>
                            <strong>${{ number_format($version->final_price, 2) }}</strong>
                        </div>
                    @empty
                        <p class="empty-state">{{ __('No purchasable version is available yet.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="purchase-actions">
                <div class="action-row-top">
                    @guest
                        <a class="btn btn-wishlist" href="{{ route('login') }}">{{ __('Wishlist') }}</a>
                    @else
                        <form action="{{ route('wishlist.store', $game) }}" method="POST">
                            @csrf
                            <button class="btn btn-wishlist" type="submit">{{ __('Wishlist') }}</button>
                        </form>
                    @endguest

                    @if($selectedVersion)
                        @auth
                            <form action="{{ route('cart.store', $selectedVersion) }}" method="POST">
                                @csrf
                                <button class="btn btn-cart" type="submit">{{ __('Add to Cart') }}</button>
                            </form>
                        @else
                            <a class="btn btn-cart" href="{{ route('login') }}">{{ __('Add to Cart') }}</a>
                        @endauth
                    @else
                        <button class="btn btn-cart" type="button" disabled>{{ __('Unavailable') }}</button>
                    @endif
                </div>

                @if($selectedVersion)
                    @auth
                        <form action="{{ route('cart.store', $selectedVersion) }}" method="POST">
                            @csrf
                            <button class="btn btn-buy-now" type="submit">{{ __('Buy It Now') }}</button>
                        </form>
                    @else
                        <a class="btn btn-buy-now" href="{{ route('login') }}">{{ __('Buy It Now') }}</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    @if($relatedGames->isNotEmpty())
        <div class="you-may-like-wrapper">
            <h2>{{ __('You may like') }}</h2>

            <div class="you-may-like-grid">
                @foreach($relatedGames as $relatedGame)
                    <x-game-card :game="$relatedGame" />
                @endforeach
            </div>
        </div>
    @endif

    @include('components/footer')
</body>
</html>
