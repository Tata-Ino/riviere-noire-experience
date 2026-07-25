<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceTranslation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'place_id',
        'language_id',
        'name',
        'short_description',
        'description',
    ];

    /**
     * Le lieu associé à cette traduction.
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * La langue de cette traduction.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
