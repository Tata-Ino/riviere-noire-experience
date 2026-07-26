<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Place;
use App\Models\PlaceMedia;
use App\Models\PlaceTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    /**
     * Liste de tous les lieux avec traductions, paginée et recherchable.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $query = Place::with(['translations.language', 'media'])
            ->withCount('reservations');

        if ($search = $request->input('search')) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $places = $query->latest()->paginate(15)->withQueryString();

        return view('admin.places.index', compact('places'));
    }

    /**
     * Afficher le formulaire de création d'un lieu.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $languages = Language::active()->get();

        return view('admin.places.create', compact('languages'));
    }

    /**
     * Enregistrer un nouveau lieu avec ses traductions et médias.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:places,slug',
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.short_description' => 'nullable|string|max:500',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

        DB::beginTransaction();

        try {
            $place = Place::create([
                'slug' => Str::slug($validated['slug']),
                'price' => $validated['price'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
                'status' => $validated['status'],
                'created_by' => $user->id,
            ]);

            // Enregistrer les traductions
            foreach ($validated['translations'] as $locale => $data) {
                $language = Language::where('code', $locale)->first();
                if ($language) {
                    $place->translations()->create([
                        'language_id' => $language->id,
                        'name' => $data['name'],
                        'short_description' => $data['short_description'] ?? null,
                        'description' => $data['description'] ?? null,
                    ]);
                }
            }

            // Upload de l'image de couverture
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('media', 'public');
                PlaceMedia::create([
                    'place_id' => $place->id,
                    'type' => PlaceMedia::TYPE_IMAGE,
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            // Lien vidéo optionnel
            if (! empty($validated['video_url'])) {
                PlaceMedia::create([
                    'place_id' => $place->id,
                    'type' => PlaceMedia::TYPE_VIDEO,
                    'url' => $validated['video_url'],
                    'is_cover' => false,
                    'position' => 1,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.places.index')
                ->with('success', 'Lieu créé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création du lieu : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher le formulaire d'édition d'un lieu.
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $place = Place::with(['translations.language', 'media'])->findOrFail($id);
        $languages = Language::active()->get();

        return view('admin.places.edit', compact('place', 'languages'));
    }

    /**
     * Mettre à jour un lieu et ses traductions.
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $place = Place::findOrFail($id);

        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:places,slug,' . $place->id,
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'translations' => 'nullable|array',
            'translations.*.name' => 'nullable|string|max:255',
            'translations.*.short_description' => 'nullable|string|max:500',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

        DB::beginTransaction();

        try {
            $place->update([
                'slug' => Str::slug($validated['slug']),
                'price' => $validated['price'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
                'status' => $validated['status'],
            ]);

            // Mettre à jour ou créer les traductions
            if (!empty($validated['translations'])) {
                foreach ($validated['translations'] as $locale => $data) {
                    if (empty($data['name'])) continue;
                    $language = Language::where('code', $locale)->first();
                    if ($language) {
                        $place->translations()->updateOrCreate(
                            ['language_id' => $language->id],
                            [
                                'name' => $data['name'],
                                'short_description' => $data['short_description'] ?? null,
                                'description' => $data['description'] ?? null,
                            ]
                        );
                    }
                }
            }

            // Remplacer l'image de couverture si nouvelle image envoyée
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image de couverture
                $oldCover = $place->media()->where('is_cover', true)->first();
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover->url);
                    $oldCover->delete();
                }

                $path = $request->file('image')->store('media', 'public');
                PlaceMedia::create([
                    'place_id' => $place->id,
                    'type' => PlaceMedia::TYPE_IMAGE,
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            // Mettre à jour le lien vidéo
            if (! empty($validated['video_url'])) {
                $existingVideo = $place->media()->where('type', PlaceMedia::TYPE_VIDEO)->first();
                if ($existingVideo) {
                    $existingVideo->update(['url' => $validated['video_url']]);
                } else {
                    PlaceMedia::create([
                        'place_id' => $place->id,
                        'type' => PlaceMedia::TYPE_VIDEO,
                        'url' => $validated['video_url'],
                        'is_cover' => false,
                        'position' => 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.places.index')
                ->with('success', 'Lieu mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
        }
    }

    /**
     * Supprimer un lieu (soft delete).
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $place = Place::findOrFail($id);
        $place->delete();

        return redirect()->route('admin.places.index')
            ->with('success', 'Lieu supprimé avec succès.');
    }
}
