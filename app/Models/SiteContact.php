<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContact extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'phone',
        'whatsapp',
        'email',
        'maps_link',
        'facebook_url',
        'instagram_url',
    ];

    /**
     * Obtenir les paramètres de contact du site.
     * Retourne ou crée la seule ligne de configuration.
     */
    public static function getSettings(): self
    {
        $settings = static::first();

        if (! $settings) {
            $settings = static::create([
                'phone' => '',
                'whatsapp' => '',
                'email' => '',
                'maps_link' => '',
                'facebook_url' => '',
                'instagram_url' => '',
            ]);
        }

        return $settings;
    }
}
