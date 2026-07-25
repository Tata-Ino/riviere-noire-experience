<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantTranslation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'restaurant_id',
        'language_id',
        'name',
        'description',
    ];

    /**
     * Le restaurant associé à cette traduction.
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * La langue de cette traduction.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
