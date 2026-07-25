<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Language extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'name',
        'is_active',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope : récupérer uniquement les langues actives.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Les traductions de lieux pour cette langue.
     */
    public function placeTranslations()
    {
        return $this->hasMany(PlaceTranslation::class);
    }

    /**
     * Les traductions d'excursions pour cette langue.
     */
    public function excursionTranslations()
    {
        return $this->hasMany(ExcursionTranslation::class);
    }

    /**
     * Les traductions de restaurants pour cette langue.
     */
    public function restaurantTranslations()
    {
        return $this->hasMany(RestaurantTranslation::class);
    }

    /**
     * Les lieux accessibles via les traductions.
     */
    public function places(): HasManyThrough
    {
        return $this->hasManyThrough(\App\Models\Place::class, \App\Models\PlaceTranslation::class);
    }

    /**
     * Les excursions accessibles via les traductions.
     */
    public function excursions(): HasManyThrough
    {
        return $this->hasManyThrough(\App\Models\Excursion::class, \App\Models\ExcursionTranslation::class);
    }
}
