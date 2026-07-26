<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Place;
use App\Models\Restaurant;
use App\Models\RestaurantMedia;
use App\Models\RestaurantTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Liste de tous les restaurants, paginée et recherchable.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $query = Restaurant::with(['place', 'translations.language', 'media'])
            ->withCount('media');

        if ($search = $request->input('search')) {
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $restaurants = $query->latest()->paginate(15)->withQueryString();

        return view('admin.restaurant.index', compact('restaurants'));
    }

    /**
     * Afficher le formulaire de création d'un restaurant.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $places = Place::active()->get();
        $languages = Language::active()->get();

        return view('admin.restaurant.create', compact('places', 'languages'));
    }

    /**
     * Enregistrer un nouveau restaurant avec ses traductions et médias.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
            'opening_hours' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $restaurant = Restaurant::create([
                'place_id' => $validated['place_id'],
                'opening_hours' => $validated['opening_hours'] ?? null,
                'status' => $validated['status'],
            ]);

            // Enregistrer les traductions
            foreach ($validated['translations'] as $locale => $data) {
                $language = Language::where('code', $locale)->first();
                if ($language) {
                    $restaurant->translations()->create([
                        'language_id' => $language->id,
                        'name' => $data['name'],
                        'description' => $data['description'] ?? null,
                    ]);
                }
            }

            // Upload de l'image de couverture
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('media', 'public');
                RestaurantMedia::create([
                    'restaurant_id' => $restaurant->id,
                    'type' => 'image',
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.restaurant.index')
                ->with('success', 'Restaurant created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création du restaurant : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher le formulaire d'édition d'un restaurant.
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $restaurant = Restaurant::with(['translations.language', 'media'])->findOrFail($id);
        $places = Place::active()->get();
        $languages = Language::active()->get();

        return view('admin.restaurant.edit', compact('restaurant', 'places', 'languages'));
    }

    /**
     * Mettre à jour un restaurant et ses traductions.
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $restaurant = Restaurant::findOrFail($id);

        $validated = $request->validate([
            'place_id' => 'required|exists:places,id',
            'opening_hours' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'translations' => 'nullable|array',
            'translations.*.name' => 'nullable|string|max:255',
            'translations.*.description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $restaurant->update([
                'place_id' => $validated['place_id'],
                'opening_hours' => $validated['opening_hours'] ?? null,
                'status' => $validated['status'],
            ]);

            // Mettre à jour ou créer les traductions
            if (!empty($validated['translations'])) {
                foreach ($validated['translations'] as $locale => $data) {
                    if (empty($data['name'])) continue;
                    $language = Language::where('code', $locale)->first();
                    if ($language) {
                        $restaurant->translations()->updateOrCreate(
                            ['language_id' => $language->id],
                            [
                                'name' => $data['name'],
                                'description' => $data['description'] ?? null,
                            ]
                        );
                    }
                }
            }

            // Remplacer l'image de couverture si nouvelle image envoyée
            if ($request->hasFile('image')) {
                $oldCover = $restaurant->media()->where('is_cover', true)->first();
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover->url);
                    $oldCover->delete();
                }

                $path = $request->file('image')->store('media', 'public');
                RestaurantMedia::create([
                    'restaurant_id' => $restaurant->id,
                    'type' => 'image',
                    'url' => $path,
                    'is_cover' => true,
                    'position' => 0,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.restaurant.index')
                ->with('success', 'Restaurant updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
        }
    }

    /**
     * Supprimer un restaurant (soft delete).
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('admin.restaurant.index')
            ->with('success', 'Restaurant supprimé avec succès.');
    }
}
