<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->name }}</title>
    @vite(['resources/css/app.css', 'resources/css/frontend/games/show.css'])
</head>
<body>
    @include('components/header_client')

    @php
        $video = $game->video();
        $banner = $game->banner();
        $gameplays = $game->gameplays();
        $versions = $game->versions->where('active', true);
        $selectedVersion = $versions->sortBy('final_price')->first();
        $genres = $game->genres->pluck('name')->join(', ');
        $firstGameplay = $gameplays->first();
    @endphp

    <div class="store-container">
        <div class="content-left">
            <div class="main-preview" id="game-main-preview">
                @if($video)
                    <iframe
                        src="{{ $video->path }}"
                        title="{{ $game->name }} {{ __('video preview') }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                @elseif($firstGameplay)
                    <img
                        src="{{ asset($firstGameplay->path) }}"
                        alt="{{ $game->name }}"
                        class="featured-image"
                    >
                @endif
            </div>

            @if($video || $gameplays->isNotEmpty())
                <div class="thumbnail-carousel">
                    <button class="preview-arrow preview-arrow-left" type="button" aria-label="{{ __('Previous previews') }}">
                        <img src="{{ asset('icons/simple-arrow-left.svg') }}" alt="">
                    </button>

                    <div class="thumbnail-list" id="preview-thumbnail-list">
                        @if($video)
                            <button
                                class="thumb video-thumb active"
                                type="button"
                                data-preview-type="video"
                                data-preview-src="{{ $video->path }}"
                                data-preview-alt="{{ $game->name }}"
                            >
                                <img src="{{ asset($banner->path) }}" alt="{{ $game->name }}">
                                <span class="play-icon"></span>
                            </button>
                        @endif

                        @foreach($gameplays as $media)
                            <button
                                class="thumb {{ ! $video && $loop->first ? 'active' : '' }}"
                                type="button"
                                data-preview-type="image"
                                data-preview-src="{{ asset($media->path) }}"
                                data-preview-alt="{{ $game->name }}"
                            >
                                <img src="{{ asset($media->path) }}" alt="{{ $game->name }}">
                            </button>
                        @endforeach
                    </div>

                    <button class="preview-arrow preview-arrow-right" type="button" aria-label="{{ __('Next previews') }}">
                        <img src="{{ asset('icons/simple-arrow-right.svg') }}" alt="">
                    </button>
                </div>
            @endif

            <div class="about-section">
                <h2>{{ __('About this game') }}</h2>

                <div class="description-text">
                    <p>{{ $game->description }}</p>

                    <h2>{{ __('System Requirements') }}</h2>
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
                        <button
                            class="platform-card {{ $loop->first ? 'active' : '' }}"
                            type="button"
                            data-cart-action="{{ route('cart.store', $version) }}"
                            data-final-price="${{ number_format($version->final_price, 2) }}"
                            data-base-price="{{ $version->base_price > $version->final_price ? '$' . number_format($version->base_price, 2) : '' }}"
                        >
                            <span>{{ $version->edition_name }}</span>
                            <img src="{{ asset($version->platform->icon) }}" alt="">
                            <span>{{ $version->platform?->name ?? __('Platform') }}</span>
                            <strong>${{ number_format($version->final_price, 2) }}</strong>
                        </button>
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
                            <form action="{{ route('cart.store', $selectedVersion) }}" method="POST" class="version-cart-form">
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
                        <form action="{{ route('cart.store', $selectedVersion) }}" method="POST" class="version-cart-form">
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

    <script>
        document.querySelectorAll('.thumb').forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const preview = document.getElementById('game-main-preview')
                const type = thumb.dataset.previewType
                const src = thumb.dataset.previewSrc
                const alt = thumb.dataset.previewAlt

                if (!preview || !src) {
                    return
                }

                const element = document.createElement(type === 'video' ? 'iframe' : 'img')

                element.src = src

                if (type === 'video') {
                    element.title = `${alt} video preview`
                    element.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                    element.allowFullscreen = true
                } else {
                    element.alt = alt
                    element.className = 'featured-image'
                }

                preview.replaceChildren(element)

                document.querySelectorAll('.thumb').forEach((item) => item.classList.remove('active'))
                thumb.classList.add('active')
            })
        })

        const thumbnailList = document.getElementById('preview-thumbnail-list')

        document.querySelectorAll('.preview-arrow').forEach((arrow) => {
            arrow.addEventListener('click', () => {
                const direction = arrow.classList.contains('preview-arrow-left') ? -1 : 1
                thumbnailList.scrollLeft += direction * 180
            })
        })

        const priceContainer = document.querySelector('.price-container')
        const currentPrice = priceContainer?.querySelector('.current-price')
        const originalPrice = priceContainer?.querySelector('.original-price')

        document.querySelectorAll('.platform-card').forEach((card) => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.platform-card').forEach((item) => item.classList.remove('active'))
                card.classList.add('active')

                document.querySelectorAll('.version-cart-form').forEach((form) => {
                    form.action = card.dataset.cartAction
                })

                if (currentPrice) {
                    currentPrice.textContent = card.dataset.finalPrice
                }

                if (originalPrice) {
                    originalPrice.textContent = card.dataset.basePrice
                    originalPrice.style.display = card.dataset.basePrice ? 'inline' : 'none'
                }
            })
        })
    </script>
</body>
</html>
