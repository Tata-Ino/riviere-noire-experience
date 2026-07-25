<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContact;
use Illuminate\Http\Request;

class SiteContactController extends Controller
{
    /**
     * Afficher le formulaire d'édition des contacts du site.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $settings = SiteContact::getSettings();

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Mettre à jour les contacts du site.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $validated = $request->validate([
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'maps_link' => 'nullable|url|max:500',
            'facebook_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
        ]);

        $settings = SiteContact::getSettings();
        $settings->update($validated);

        return back()->with('success', 'Contacts du site mis à jour avec succès.');
    }
}
