<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends Model
{
    use HasFactory;

    /**
     * Statuts disponibles pour un lieu.
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
        'slug',
        'price',
        'is_featured',
        'status',
        'created_by',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Scope : récupérer uniquement les lieux en vedette.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope : récupérer uniquement les lieux actifs.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Scope : récupérer un lieu par son slug.
     */
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * L'utilisateur qui a créé ce lieu.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Les traductions de ce lieu.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(PlaceTranslation::class);
    }

    /**
     * Les médias associés à ce lieu.
     */
    public function media(): HasMany
    {
        return $this->hasMany(PlaceMedia::class);
    }

    /**
     * Les excursions liées à ce lieu.
     */
    public function excursions(): HasMany
    {
        return $this->hasMany(Excursion::class);
    }

    /**
     * Le restaurant associé à ce lieu.
     */
    public function restaurant(): HasOne
    {
        return $this->hasOne(Restaurant::class);
    }

    /**
     * Les réservations pour ce lieu.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
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
     * Retourner le nom traduit du lieu.
     */
    public function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        $translation = $this->translate($locale);
        return $translation?->name ?? $this->slug;
    }

    /**
     * Retourner la description courte traduite.
     */
    public function getShortDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        $translation = $this->translate($locale);
        return $translation?->short_description;
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
     * @return PlaceTranslation|null
     */
    public function translate(string $locale): ?PlaceTranslation
    {
        if ($this->relationLoaded('translations')) {
            return $this->translations->first(function (PlaceTranslation $t) use ($locale) {
                    return $t->language && $t->language->code === $locale;
                }) ?? $this->translations->first(function (PlaceTranslation $t) {
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
