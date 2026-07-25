<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Statuts disponibles pour une réservation.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_CANCELLED,
        self::STATUS_COMPLETED,
    ];

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'place_id',
        'excursion_id',
        'full_name',
        'email',
        'phone',
        'country',
        'language_id',
        'nb_persons',
        'visit_date',
        'total_amount',
        'status',
        'notes',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nb_persons' => 'integer',
            'total_amount' => 'decimal:2',
            'visit_date' => 'date',
        ];
    }

    /**
     * Scope : récupérer les réservations en attente.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope : récupérer les réservations confirmées.
     */
    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * Scope : récupérer les réservations par mois et année.
     */
    public function scopeByMonth(Builder $query, int $month, int $year): Builder
    {
        return $query->whereMonth('visit_date', $month)
            ->whereYear('visit_date', $year);
    }

    /**
     * Le lieu associé à cette réservation.
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * L'excursion associée à cette réservation.
     */
    public function excursion(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }

    /**
     * La langue de cette réservation.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Le paiement associé à cette réservation.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
