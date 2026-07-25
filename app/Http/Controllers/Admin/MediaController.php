<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExcursionMedia;
use App\Models\PlaceMedia;
use App\Models\RestaurantMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Types de médias supportés par modèle.
     */
    private const MEDIA_MAP = [
        'place' => PlaceMedia::class,
        'excursion' => ExcursionMedia::class,
        'restaurant' => RestaurantMedia::class,
    ];

    /**
     * Télécharger un média (image ou lien vidéo) et l'associer à un modèle.
     * Utilisé via AJAX ou dans les formuliers de création/édition.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $validated = $request->validate([
            'type' => 'required|in:place,excursion,restaurant',
            'model_id' => 'required|integer',
            'media_type' => 'required|in:image,video',
            'image' => 'required_if:media_type,image|image|max:5120',
            'video_url' => 'required_if:media_type,video|url|max:500',
            'is_cover' => 'boolean',
            'position' => 'nullable|integer|min:0',
        ]);

        $mediaClass = self::MEDIA_MAP[$validated['type']] ?? null;

        if (! $mediaClass || ! class_exists($mediaClass)) {
            return back()->withErrors(['type' => 'Type de modèle invalide.']);
        }

        $foreign_key = $validated['type'] . '_id';

        if ($validated['media_type'] === 'image') {
            $path = $request->file('image')->store('media', 'public');

            $media = $mediaClass::create([
                $foreign_key => $validated['model_id'],
                'type' => 'image',
                'url' => $path,
                'is_cover' => $validated['is_cover'] ?? false,
                'position' => $validated['position'] ?? 0,
            ]);
        } else {
            $media = $mediaClass::create([
                $foreign_key => $validated['model_id'],
                'type' => 'video',
                'url' => $validated['video_url'],
                'is_cover' => $validated['is_cover'] ?? false,
                'position' => $validated['position'] ?? 0,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'media' => $media]);
        }

        return back()->with('success', 'Média ajouté avec succès.');
    }

    /**
     * Supprimer un média et le fichier associé si c'est une image.
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        // Chercher le média dans tous les types possibles
        $media = PlaceMedia::find($id)
            ?? ExcursionMedia::find($id)
            ?? RestaurantMedia::find($id);

        if (! $media) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Média non trouvé.'], 404);
            }
            return back()->withErrors(['error' => 'Média non trouvé.']);
        }

        // Supprimer le fichier physique si c'est une image stockée localement
        if ($media->type === 'image' && Storage::disk('public')->exists($media->url)) {
            Storage::disk('public')->delete($media->url);
        }

        $media->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Média supprimé avec succès.');
    }
}
