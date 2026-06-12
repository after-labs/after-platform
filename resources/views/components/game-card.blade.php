
@props(['game', 'priceFilter' => null, 'platformIds' => []])

@php
    $poster = $game->poster();
    $versions = $game->versions->where('active', true);
    $platformIds = array_filter((array) $platformIds);

    if ($platformIds) {
        $versions = $versions->whereIn('platform_id', $platformIds);
    }

    $saleVersions = $versions
        ->where('final_price', '>', 0)
        ->filter(fn ($item) => $item->base_price > 0 && $item->final_price < $item->base_price);

    $filteredVersions = match ($priceFilter) {
        'free' => $versions->where('final_price', 0),
        'sale' => $saleVersions,
        'paid' => $versions
            ->where('final_price', '>', 0)
            ->filter(fn ($item) => $item->base_price <= 0 || $item->final_price >= $item->base_price),
        default => $saleVersions->isNotEmpty() ? $saleVersions : $versions,
    };

    if (($priceFilter === 'sale' || $priceFilter === null) && $saleVersions->isNotEmpty()) {
        $version = $saleVersions
            ->sortByDesc(fn ($item) => $item->base_price > 0 ? ($item->base_price - $item->final_price) / $item->base_price : 0)
            ->first();
    } else {
        $version = $filteredVersions->sortBy('final_price')->first()
            ?? $versions->sortBy('final_price')->first()
            ?? $game->versions->sortBy('final_price')->first();
    }

    $discount = 0;

    if ($version && $version->base_price > 0 && $version->base_price > $version->final_price) {
        $discount = round(
            (($version->base_price - $version->final_price) / $version->base_price) * 100
        );
    }
@endphp

<a href="{{ route('games.show', $game) }}" class="game-card-link">
    @once
        @vite(['resources/css/components/game-card.css'])
    @endonce

    <article class="game-card">
        <div class="game-card-image-wrapper">

            @if($discount > 0)
                <div class="game-card-discount">
                    -{{ $discount }}%
                </div>
            @endif

            <img
                src="{{ asset($poster?->path ?? 'imgs/replaced-poster.png') }}"
                alt="{{ $game->name }}"
                class="game-card-image"
            >

            <div class="game-card-overlay"></div>
        </div>

        <div class="game-card-content">
            <h3 class="game-card-title">
                {{ $game->name }}
            </h3>

            <div class="game-card-prices">

                @if($discount > 0)
                    <span class="game-card-old-price">
                        ${{ number_format($version->base_price, 2) }}
                    </span>
                @endif

                <span class="game-card-price">
                    @if($version)
                        ${{ number_format($version->final_price, 2) }}
                    @else
                        {{ __('Coming soon') }}
                    @endif
                </span>
            </div>

            <div class="game-card-footer">
                <span class="game-card-category">
                    {{ $game->category?->name ?? __('Indie') }}
                </span>

                <span class="game-card-hover-text">
                    {{ __('View Game') }}
                </span>
            </div>
        </div>
    </article>
</a>
