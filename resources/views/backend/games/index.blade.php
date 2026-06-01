<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Game Control') }}</title>
    @vite(['resources/css/app.css', 'resources/css/backend/games/index.css'])
</head>
<body>
@include('components/header_adm')

<main class="container">

    <h1>{{ __('Games') }}</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">

        {{-- SEARCH --}}
        <form class="search-row" method="GET" action="{{ route('admin.games.index') }}">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                   placeholder="{{ __('Search by name, ID or developer') }}">
            <span>{{ __('Total: :count game(s)', ['count' => $games->total()]) }}</span>
        </form>

        {{-- FILTER BAR --}}
        <div class="filters-bar">
            <a href="{{ route('admin.games.index') }}"
               class="btn {{ !request('search') ? 'active' : '' }}">
                {{ __('All Games') }}
            </a>
            <a href="{{ route('admin.games.create') }}" class="btn create">
                + {{ __('Create Game') }}
            </a>
        </div>

        {{-- GALLERY --}}
        <div class="gallery">
            @forelse($games as $game)
                @php
                    $poster  = $game->media->where('type', 'poster')->first()
                             ?? $game->media->where('type', 'banner')->first();
                    $version = $game->versions->where('active', true)->sortBy('final_price')->first()
                             ?? $game->versions->sortBy('final_price')->first();

                    $discount = 0;
                    if ($version && $version->base_price > 0 && $version->base_price > $version->final_price) {
                        $discount = round((($version->base_price - $version->final_price) / $version->base_price) * 100);
                    }
                @endphp

                <div class="game-card">

                    {{-- Edit --}}
                    <a href="{{ route('admin.games.edit', $game) }}" class="edit-btn">{{ __('Edit') }}</a>

                    {{-- Delete: abre modal de confirmação --}}
                    <button type="button"
                            class="delete-btn"
                            data-game-name="{{ $game->name }}"
                            data-delete-url="{{ route('admin.games.delete', $game) }}">{{ __('Delete') }}</button>

                    {{-- Image --}}
                    <div class="game-card-image-wrapper">
                        @if($discount > 0)
                            <div class="discount-badge">-{{ $discount }}%</div>
                        @endif

                        @if($poster)
                            <img src="{{ $poster->path }}" alt="{{ $game->name }}">
                        @else
                            <div class="no-image">{{ __('No image') }}</div>
                        @endif

                        <div class="game-card-overlay"></div>
                    </div>

                    {{-- Content --}}
                    <div class="game-card-content">
                        <h3 class="game-card-title">{{ $game->name }}</h3>

                        <div class="game-card-prices">
                            @if($version)
                                @if($version->final_price == 0)
                                    {{-- Gratuito: só o "Free", sem preço riscado --}}
                                    <span class="price-free">{{ __('Free') }}</span>
                                @else
                                    {{-- Pago: mostra original riscado só se houver desconto real --}}
                                    @if($discount > 0)
                                        <span class="price-old">${{ number_format($version->base_price, 2) }}</span>
                                    @endif
                                    <span class="price-current">${{ number_format($version->final_price, 2) }}</span>
                                @endif
                            @else
                                <span class="price-none">{{ __('No version') }}</span>
                            @endif
                        </div>

                        <div class="game-card-footer">
                            <span class="game-card-category">
                                {{ $game->category?->name ?? __('Indie') }}
                            </span>
                        </div>
                    </div>

                </div>
            @empty
                <p class="empty">{{ __('No games found.') }}</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $games->withQueryString()->links() }}
        </div>

    </div>
</main>

{{-- ══════════════════════════════
     MODAL DE CONFIRMAÇÃO DE DELETE
     ══════════════════════════════ --}}
<div id="delete-modal" class="modal-backdrop" aria-hidden="true">
    <div class="modal-box" role="dialog">
        <div class="modal-icon">⚠</div>
        <h4 id="modal-title">{{ __('Delete game?') }}</h4>
        <p>{{ __('This action cannot be undone.') }}</p>
        <div class="modal-actions">
            <button type="button" class="modal-cancel" id="modal-cancel">{{ __('Cancel') }}</button>
            <form id="delete-form" method="GET" action="">
                @csrf
                <button type="submit" class="modal-confirm">{{ __('Yes, delete') }}</button>
            </form>
        </div>
    </div>
</div>

<script>
const modal      = document.getElementById('delete-modal')
const deleteForm = document.getElementById('delete-form')
const modalTitle = document.getElementById('modal-title')
const cancelBtn  = document.getElementById('modal-cancel')

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        modalTitle.textContent = `{{ __("Delete") }} "${btn.dataset.gameName}"?`
        deleteForm.action = btn.dataset.deleteUrl
        modal.removeAttribute('aria-hidden')
        modal.classList.add('visible')
    })
})

function closeModal() {
    modal.setAttribute('aria-hidden', 'true')
    modal.classList.remove('visible')
}

cancelBtn.addEventListener('click', closeModal)
modal.addEventListener('click', e => { if (e.target === modal) closeModal() })
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal() })
</script>

</body>
</html>