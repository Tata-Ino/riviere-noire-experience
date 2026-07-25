<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Excursion;
use App\Models\ExcursionMedia;
use App\Models\ExcursionTranslation;
use App\Models\Language;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExcursionController extends Controller
{
    /**
     * Liste de toutes les excursions avec la relation lieu, paginée et recherchable.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $query = Excursion::with(['place', 'translations.language', 'media'])
            ->withCount('reservations');

        if ($search = $request->input('search')) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($placeId = $request->input('place_id')) {
            $query->where('place_id', $placeId);
        }

        $excursions = $query->latest()->paginate(15)->withQueryString();

        $places = Place::active()->get();

        return view('admin.excursions.index', compact('excursions', 'places'));
    }

    /**
     * Afficher le formulaire de création d'une excursion.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $places = Place::active()->get();
        $languages = Language::active()->get();

        return view('admin.excursions.create', compact('places', 'languages'));
    }

    /**
     * Enregistrer une nouvelle excursion avec ses traductions et médias.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
            'slug' => 'required|string|max:255|unique:excursions,slug',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'position' => 'nullable|integer|min:0',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

        DB::beginTransaction();

        try {
            $excursion = Excursion::create([
                'place_id' => $validated['place_id'],
                'slug' => Str::slug($validated['slug']),
                'price' => $validated['price'] ?? null,
                'duration_minutes' => $validated['duration_minutes'] ?? null,
                'status' => $validated['status'],
                'position' => $validated['position'] ?? 0,
            ]);

            // Enregistrer les traductions
            foreach ($validated['translations'] as $locale => $data) {
                $language = Language::where('code', $locale)->first();
                if ($language) {
                    $excursion->translations()->create([
                        'language_id' => $language->id,
                        'name' => $data['name'],
                        'description' => $data['description'] ?? null,
                    ]);
                }
            }

            // Upload de l'image de couverture
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('media', 'public');
                ExcursionMedia::create([
                    'excursion_id' => $excursion->id,
                    'type' => 'image',
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            // Lien vidéo optionnel
            if (! empty($validated['video_url'])) {
                ExcursionMedia::create([
                    'excursion_id' => $excursion->id,
                    'type' => 'video',
                    'url' => $validated['video_url'],
                    'is_cover' => false,
                    'position' => 1,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.excursions.index')
                ->with('success', 'Excursion créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création de l\'excursion : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher le formulaire d'édition d'une excursion.
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $excursion = Excursion::with(['translations.language', 'media'])->findOrFail($id);
        $places = Place::active()->get();
        $languages = Language::active()->get();

        return view('admin.excursions.edit', compact('excursion', 'places', 'languages'));
    }

    /**
     * Mettre à jour une excursion et ses traductions.
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $excursion = Excursion::findOrFail($id);

        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
            'slug' => 'required|string|max:255|unique:excursions,slug,' . $excursion->id,
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'position' => 'nullable|integer|min:0',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

        DB::beginTransaction();

        try {
            $excursion->update([
                'place_id' => $validated['place_id'],
                'slug' => Str::slug($validated['slug']),
                'price' => $validated['price'] ?? null,
                'duration_minutes' => $validated['duration_minutes'] ?? null,
                'status' => $validated['status'],
                'position' => $validated['position'] ?? 0,
            ]);

            // Mettre à jour ou créer les traductions
            foreach ($validated['translations'] as $locale => $data) {
                $language = Language::where('code', $locale)->first();
                if ($language) {
                    $excursion->translations()->updateOrCreate(
                        ['language_id' => $language->id],
                        [
                            'name' => $data['name'],
                            'description' => $data['description'] ?? null,
                        ]
                    );
                }
            }

            // Remplacer l'image de couverture si nouvelle image envoyée
            if ($request->hasFile('image')) {
                $oldCover = $excursion->media()->where('is_cover', true)->first();
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover->url);
                    $oldCover->delete();
                }

                $path = $request->file('image')->store('media', 'public');
                ExcursionMedia::create([
                    'excursion_id' => $excursion->id,
                    'type' => 'image',
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            // Mettre à jour le lien vidéo
            if (! empty($validated['video_url'])) {
                $existingVideo = $excursion->media()->where('type', 'video')->first();
                if ($existingVideo) {
                    $existingVideo->update(['url' => $validated['video_url']]);
                } else {
                    ExcursionMedia::create([
                        'excursion_id' => $excursion->id,
                        'type' => 'video',
                        'url' => $validated['video_url'],
                        'is_cover' => false,
                        'position' => 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.excursions.index')
                ->with('success', 'Excursion mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
        }
    }

    /**
     * Supprimer une excursion (soft delete).
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $excursion = Excursion::findOrFail($id);
        $excursion->delete();

        return redirect()->route('admin.excursions.index')
            ->with('success', 'Excursion supprimée avec succès.');
    }
}
