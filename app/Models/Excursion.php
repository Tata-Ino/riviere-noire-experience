<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Excursion extends Model
{
    use HasFactory;

    /**
     * Statuts disponibles pour une excursion.
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
        'slug',
        'price',
        'duration_minutes',
        'status',
        'position',
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
            'duration_minutes' => 'integer',
            'position' => 'integer',
        ];
    }

    /**
     * Scope : récupérer uniquement les excursions actives.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Le lieu associé à cette excursion.
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Les traductions de cette excursion.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ExcursionTranslation::class);
    }

    /**
     * Les médias associés à cette excursion.
     */
    public function media(): HasMany
    {
        return $this->hasMany(ExcursionMedia::class);
    }

    /**
     * Les réservations pour cette excursion.
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
     * Retourner l'URL de la vidéo.
     */
    public function getVideoUrlAttribute(): ?string
    {
        if ($this->relationLoaded('media')) {
            $video = $this->media->firstWhere('type', 'video');
            return $video?->url;
        }

        $video = $this->media()->where('type', 'video')->first();
        return $video ? $video->url : null;
    }

    /**
     * Retourner le nom traduit de l'excursion.
     */
    public function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        $translation = $this->translate($locale);
        return $translation?->name ?? $this->slug;
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
     * Retourner la durée formatée.
     */
    public function getDurationFormattedAttribute(): ?string
    {
        if (!$this->duration_minutes) {
            return null;
        }
        $hours = intdiv($this->duration_minutes, 60);
        $minutes = $this->duration_minutes % 60;
        return $hours > 0 ? "{$hours}h " . str_pad($minutes, 2, '0', STR_PAD_LEFT) . "min" : "{$minutes}min";
    }

    /**
     * Retourner la traduction pour une langue donnée.
     *
     * @param string $locale Code de la langue (ex: 'fr', 'en')
     * @return ExcursionTranslation|null
     */
    public function translate(string $locale): ?ExcursionTranslation
    {
        if ($this->relationLoaded('translations')) {
            return $this->translations->first(function (ExcursionTranslation $t) use ($locale) {
                    return $t->language && $t->language->code === $locale;
                }) ?? $this->translations->first(function (ExcursionTranslation $t) {
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
