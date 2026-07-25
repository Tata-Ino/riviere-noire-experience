<?php

namespace App\Http\Controllers;

use App\Models\SiteContact;

class ContactController extends Controller
{
    /**
     * Afficher la page de contact.
     */
    public function index()
    {
        $contacts = SiteContact::getSettings();

        return view('contact.index', compact('contacts'));
    }
}
