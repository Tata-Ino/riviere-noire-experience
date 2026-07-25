<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * Statuts disponibles pour un restaurant.
     */
    public const STATUS_DRAFT = 'draft';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'place_id',
        'opening_hours',
        'status',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'opening_hours' => 'json',
        ];
    }

    /**
     * Scope : récupérer uniquement les restaurants actifs.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Le lieu associé à ce restaurant.
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Les traductions de ce restaurant.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(RestaurantTranslation::class);
    }

    /**
     * Les médias associés à ce restaurant.
     */
    public function media(): HasMany
    {
        return $this->hasMany(RestaurantMedia::class);
    }

    /**
     * Retourner l'URL de l'image de couverture.
     */
    public function getCoverImageAttribute(): ?string
    {
        if ($this->relationLoaded('media')) {
            $cover = $this->media->firstWhere('is_cover', true);
            return $cover?->url;
        }

        $cover = $this->media()->where('is_cover', true)->first();
        return $cover ? $cover->url : null;
    }

    /**
     * Retourner le nom traduit du restaurant.
     */
    public function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        $translation = $this->translate($locale);
        return $translation?->name ?? __('Restaurant');
    }

    /**
     * Retourner la description traduite.
     */
    public function getDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        $translation = $this->translate($locale);
        return $translation?->description;
    }

    /**
     * Retourner la traduction pour une langue donnée.
     *
     * @param string $locale Code de la langue (ex: 'fr', 'en')
     * @return RestaurantTranslation|null
     */
    public function translate(string $locale): ?RestaurantTranslation
    {
        if ($this->relationLoaded('translations')) {
            return $this->translations->first(function (RestaurantTranslation $t) use ($locale) {
                    return $t->language && $t->language->code === $locale;
                }) ?? $this->translations->first(function (RestaurantTranslation $t) {
                    return $t->language && $t->language->code === config('app.fallback_locale', 'fr');
                }) ?? $this->translations->first();
        }

        return $this->translations()
            ->whereHas('language', fn ($q) => $q->where('code', $locale))
            ->first() ?? $this->translations()
            ->whereHas('language', fn ($q) => $q->where('code', config('app.fallback_locale', 'fr')))
            ->first() ?? $this->translations()->first();
    }
}
