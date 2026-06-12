<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\GameMedia;
use App\Models\GameVersion;
use App\Models\Genre;
use App\Models\Platform;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /* FRONTEND */

    public function home()
    {
        $baseQuery = Game::with(['media', 'versions.offer', 'category']);

        $popularGames = (clone $baseQuery)->where('featured', true)->latest()->limit(6)->get();
        if ($popularGames->isEmpty()) {
            $popularGames = (clone $baseQuery)->latest()->limit(6)->get();
        }

        $freeGames = (clone $baseQuery)
            ->whereHas('versions', fn($q) => $q->where('active', true)->where('final_price', 0))
            ->limit(6)->get();
        if ($freeGames->isEmpty()) {
            $freeGames = (clone $baseQuery)->latest()->limit(6)->get();
        }

        $onSaleGames = (clone $baseQuery)
            ->whereHas('versions', fn($q) => $q->whereColumn('final_price', '<', 'base_price'))
            ->limit(6)->get();
        if ($onSaleGames->isEmpty()) {
            $onSaleGames = (clone $baseQuery)->latest()->limit(6)->get();
        }

        $highlightGame = $onSaleGames->first() ?? $popularGames->first() ?? $freeGames->first();

        return view('frontend.home', compact('popularGames', 'freeGames', 'onSaleGames', 'highlightGame'));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryIds = array_filter((array) $request->query('category_id', []));
        $genreIds = array_filter((array) $request->query('genre_id', []));
        $platformIds = array_filter((array) $request->query('platform_id', []));
        $priceFilter = $request->query('price');

        $games = Game::with(['media', 'versions.offer', 'versions.platform', 'category', 'genres'])
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categoryIds, fn($q) => $q->whereIn('category_id', $categoryIds))
            ->when($genreIds, fn($q) => $q->whereHas('genres', fn($g) => $g->whereIn('genres.id', $genreIds)))
            ->when($platformIds, fn($q) => $q->whereHas('versions', fn($v) => $v->whereIn('platform_id', $platformIds)))
            ->when($priceFilter === 'free',
                fn($q) => $q->whereHas('versions', fn($v) => $v->where('active', true)->where('final_price', 0)))
            ->when($priceFilter === 'sale',
                fn($q) => $q->whereHas('versions', fn($v) => $v->where('active', true)->whereColumn('final_price', '<', 'base_price')))
            ->when($priceFilter === 'paid',
                fn($q) => $q->whereHas('versions', fn($v) => $v->where('active', true)->where('final_price', '>', 0)))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $platforms = Platform::orderBy('name')->get();

        return view('frontend.games.catalog', compact(
            'games',
            'search',
            'categories',
            'genres',
            'platforms',
            'categoryIds',
            'genreIds',
            'platformIds',
            'priceFilter'
        ));
    }

    public function about()
    {
        $games = Game::with(['media', 'versions.offer', 'category'])
            ->where('featured', true)->latest()->limit(8)->get();

        if ($games->isEmpty()) {
            $games = Game::with(['media', 'versions.offer', 'category'])->latest()->limit(8)->get();
        }

        return view('about', compact('games'));
    }

    public function category(Category $category)
    {
        $games = Game::with(['media', 'versions.offer', 'category'])
            ->where('category_id', $category->id)
            ->paginate(12)->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('frontend.games.catalog_type', compact('games', 'category', 'categories'));
    }

    public function show(Game $game)
    {
        $game->load(['media', 'versions.platform', 'versions.offer', 'genres', 'category']);

        $relatedGames = Game::with(['media', 'versions.offer'])
            ->where('category_id', $game->category_id)
            ->where('id', '!=', $game->id)
            ->limit(6)->get();

        return view('frontend.games.show', compact('game', 'relatedGames'));
    }

    /*  ADMIN: INDEX */

    public function adminIndex(Request $request)
    {
        $search      = $request->query('search');
        $categoryId  = $request->query('category_id');
        $releaseYear = $request->query('release_date');
        $featured    = $request->query('featured');   // '1', '0' ou null
        $priceFilter = $request->query('price');      // 'free', 'sale', 'paid'

        $games = Game::with(['media', 'versions.offer', 'category'])
            ->when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('developer', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            }))
            ->when($categoryId,  fn($q) => $q->where('category_id', $categoryId))
            ->when($releaseYear, fn($q) => $q->where('release_date', $releaseYear))
            ->when($featured !== null && $featured !== '',
                fn($q) => $q->where('featured', (bool) $featured))
            ->when($priceFilter === 'free',
                fn($q) => $q->whereHas('versions', fn($v) => $v->where('final_price', 0)))
            ->when($priceFilter === 'sale',
                fn($q) => $q->whereHas('versions', fn($v) => $v->whereColumn('final_price', '<', 'base_price')))
            ->when($priceFilter === 'paid',
                fn($q) => $q->whereHas('versions', fn($v) => $v->where('final_price', '>', 0)))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $categories  = Category::orderBy('name')->get();
        $releaseYears = Game::selectRaw('DISTINCT release_date')
            ->orderByDesc('release_date')
            ->pluck('release_date');

        return view('backend.games.index', compact(
            'games', 'search', 'categories', 'releaseYears',
            'categoryId', 'releaseYear', 'featured', 'priceFilter'
        ));
    }

    /* ADMIN: CREATE */

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $genres     = Genre::orderBy('name')->get();
        $platforms  = Platform::orderBy('name')->get();

        return view('backend.games.create', compact('categories', 'genres', 'platforms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'developer'           => 'required|string|max:255',
            'category_id'         => 'required|exists:categories,id',
            'release_date'        => 'required|digits:4|integer|min:1970|max:2099',
            'age'                 => 'required|integer|min:0',
            'summary'             => 'required|string|max:500',
            'description'         => 'required|string',
            'system_requirements' => 'nullable|string',
            'featured'            => 'nullable|boolean',

            // Mídias (links)
            'media_poster'        => 'nullable|string|max:2048',
            'media_banner'        => 'nullable|string|max:2048',
            'media_video'         => 'nullable|string|max:2048', // link YouTube
            'media_gameplay.*'    => 'nullable|string|max:2048',

            // Versões
            'versions'                      => 'nullable|array',
            'versions.*.edition_name'       => 'required_with:versions|string|max:255',
            'versions.*.platform_id'        => 'required_with:versions|exists:platforms,id',
            'versions.*.base_price'         => 'required_with:versions|numeric|min:0',
            'versions.*.final_price'        => 'required_with:versions|numeric|min:0',
            'versions.*.stock'              => 'required_with:versions|integer|min:0',
            'versions.*.active'             => 'nullable|boolean',
        ]);

        $game = Game::create([
            'name'                => $request->name,
            'developer'           => $request->developer,
            'category_id'         => $request->category_id,
            'release_date'        => $request->release_date,
            'age'                 => $request->age,
            'summary'             => $request->summary,
            'description'         => $request->description,
            'system_requirements' => $request->system_requirements,
            'featured'            => $request->boolean('featured'),
        ]);

        // Géneros
        if ($request->filled('genre_ids')) {
            $game->genres()->sync($request->genre_ids);
        }

        // Mídias
        $this->syncMedia($game, $request);

        // Versões
        if ($request->has('versions')) {
            foreach ($request->versions as $v) {
                $game->versions()->create([
                    'edition_name' => $v['edition_name'],
                    'platform_id'  => $v['platform_id'],
                    'base_price'   => $v['base_price'],
                    'final_price'  => $v['final_price'],
                    'stock'        => $v['stock'],
                    'active'       => isset($v['active']) ? (bool) $v['active'] : true,
                ]);
            }
        }

        return redirect()->route('admin.games.index')
            ->with('success', __('Game created successfully.'));
    }

    /*  ADMIN: EDIT  */

    public function edit(Game $game)
    {
        $game->load(['media', 'versions.platform', 'genres', 'category']);
        $categories = Category::orderBy('name')->get();
        $genres     = Genre::orderBy('name')->get();
        $platforms  = Platform::orderBy('name')->get();

        return view('backend.games.edit', compact('game', 'categories', 'genres', 'platforms'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'developer'           => 'required|string|max:255',
            'category_id'         => 'required|exists:categories,id',
            'release_date'        => 'required|digits:4|integer|min:1970|max:2099',
            'age'                 => 'required|integer|min:0',
            'summary'             => 'required|string|max:500',
            'description'         => 'required|string',
            'system_requirements' => 'nullable|string',
            'featured'            => 'nullable|boolean',

            'media_poster'        => 'nullable|string|max:2048',
            'media_banner'        => 'nullable|string|max:2048',
            'media_video'         => 'nullable|string|max:2048',
            'media_gameplay.*'    => 'nullable|string|max:2048',

            'versions'                      => 'nullable|array',
            'versions.*.id'                 => 'nullable|exists:game_versions,id',
            'versions.*.edition_name'       => 'required_with:versions|string|max:255',
            'versions.*.platform_id'        => 'required_with:versions|exists:platforms,id',
            'versions.*.base_price'         => 'required_with:versions|numeric|min:0',
            'versions.*.final_price'        => 'required_with:versions|numeric|min:0',
            'versions.*.stock'              => 'required_with:versions|integer|min:0',
            'versions.*.active'             => 'nullable|boolean',
        ]);

        $game->update([
            'name'                => $request->name,
            'developer'           => $request->developer,
            'category_id'         => $request->category_id,
            'release_date'        => $request->release_date,
            'age'                 => $request->age,
            'summary'             => $request->summary,
            'description'         => $request->description,
            'system_requirements' => $request->system_requirements,
            'featured'            => $request->boolean('featured'),
        ]);

        // Géneros
        $game->genres()->sync($request->genre_ids ?? []);

        // Mídias
        $this->syncMedia($game, $request);

        // Versões: upsert
        $keptIds = [];
        foreach ($request->versions ?? [] as $v) {
            if (!empty($v['id'])) {
                $version = GameVersion::find($v['id']);
                if ($version && $version->game_id === $game->id) {
                    $version->update([
                        'edition_name' => $v['edition_name'],
                        'platform_id'  => $v['platform_id'],
                        'base_price'   => $v['base_price'],
                        'final_price'  => $v['final_price'],
                        'stock'        => $v['stock'],
                        'active'       => isset($v['active']) ? (bool) $v['active'] : true,
                    ]);
                    $keptIds[] = $version->id;
                }
            } else {
                $newVersion = $game->versions()->create([
                    'edition_name' => $v['edition_name'],
                    'platform_id'  => $v['platform_id'],
                    'base_price'   => $v['base_price'],
                    'final_price'  => $v['final_price'],
                    'stock'        => $v['stock'],
                    'active'       => isset($v['active']) ? (bool) $v['active'] : true,
                ]);
                $keptIds[] = $newVersion->id;
            }
        }
        // Remove versões não enviadas
        $game->versions()->whereNotIn('id', $keptIds)->delete();

        return redirect()->route('admin.games.index')
            ->with('success', __('Game updated successfully.'));
    }

    /*  ADMIN: DELETE  */

    public function delete(Game $game)
    {
        $game->genres()->detach();
        $game->media()->delete();
        $game->versions()->delete();
        $game->delete();

        return redirect()->route('admin.games.index')
            ->with('success', __('Game deleted successfully.'));
    }

    /*  ADMIN: DELETE MÍDIA  */

    public function deleteMedia(Game $game, GameMedia $media)
    {
        abort_if($media->game_id !== $game->id, 403);
        $media->delete();

        return back()->with('success', __('Media removed.'));
    }

    /*  ADMIN: DELETE VERSÃO  */

    public function destroyVersion(Game $game, GameVersion $version)
    {
        abort_if($version->game_id !== $game->id, 403);
        $version->delete();

        return back()->with('success', __('Version removed.'));
    }

    /*  HELPER PRIVADO  */

    /**
     * Sincroniza as mídias do jogo a partir dos campos de link do request.
     * Poster, banner e vídeo são únicos (replace). Gameplays são aditivos
     * (remove as antigas e recria com as novas).
     */
    private function syncMedia(Game $game, Request $request): void
    {
        foreach (['poster', 'banner', 'video'] as $type) {
            $field = "media_{$type}";
            if ($request->filled($field)) {
                $raw = $request->input($field);
                $game->media()->where('type', $type)->delete();
                $game->media()->create([
                    'type' => $type,
                    'path' => $type === 'video'
                        ? $this->resolveYoutubeUrl($raw)
                        : $this->resolveImageUrl($raw),
                ]);
            }
        }

        // Gameplays: array de links
        if ($request->has('media_gameplay')) {
            $game->media()->where('type', 'gameplay')->delete();
            foreach (array_filter((array) $request->media_gameplay) as $url) {
                if ($url) {
                    $game->media()->create([
                        'type' => 'gameplay',
                        'path' => $this->resolveImageUrl($url),
                    ]);
                }
            }
        }
    }

    /**
     * Converte qualquer formato de URL do YouTube para o link embed.
     *
     * Aceita:
     *   https://www.youtube.com/watch?v=dQw4w9WgXcQ
     *   https://youtu.be/dQw4w9WgXcQ
     *   https://www.youtube.com/embed/dQw4w9WgXcQ  (já correto)
     */
    private function resolveYoutubeUrl(string $url): string
    {
        // Já é embed — retorna como está
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // youtu.be/ID
        if (preg_match('#youtu\.be/([A-Za-z0-9_-]{11})#', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // youtube.com/watch?v=ID  (ou shorts, live, etc.)
        if (preg_match('#[?&]v=([A-Za-z0-9_-]{11})#', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // youtube.com/shorts/ID
        if (preg_match('#youtube\.com/shorts/([A-Za-z0-9_-]{11})#', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Não reconheceu — devolve como está
        return $url;
    }

    /**
     * Converte URLs de páginas de hospedagem para links diretos de imagem.
     *
     * ImgBB:  https://ibb.co/JRCf1Mp2
     *      → busca o link direto via API e retorna https://i.ibb.co/.../img.jpg
     *        Se a API falhar, tenta o padrão de URL direto.
     */
    private function resolveImageUrl(string $url): string
    {
        // Só processa URLs do ImgBB (página de visualização)
        if (!preg_match('#^https?://ibb\.co/([A-Za-z0-9]+)$#', $url, $m)) {
            return $url; // já é link direto ou outro host — usa como está
        }

        $albumId = $m[1];

        try {
            // Tenta buscar o link direto via endpoint embed do ImgBB
            $apiUrl = "https://ibb.co/json?type=album&action=data&albumid={$albumId}";
            $ctx    = stream_context_create(['http' => [
                'timeout' => 5,
                'header'  => "User-Agent: Mozilla/5.0\r\n",
            ]]);
            $json = @file_get_contents($apiUrl, false, $ctx);

            if ($json) {
                $data = json_decode($json, true);
                $direct = $data['image']['image']['url']
                       ?? $data['image']['url']
                       ?? null;
                if ($direct) return $direct;
            }
        } catch (\Throwable) {}

        // Fallback: tenta scraping leve da página para encontrar og:image
        try {
            $ctx  = stream_context_create(['http' => ['timeout' => 5,
                'header' => "User-Agent: Mozilla/5.0\r\n"]]);
            $html = @file_get_contents("https://ibb.co/{$albumId}", false, $ctx);
            if ($html && preg_match('/<meta property="og:image"\s+content="([^"]+)"/i', $html, $og)) {
                return $og[1];
            }
        } catch (\Throwable) {}

        // Último recurso: devolve a URL original
        return $url;
    }
}
