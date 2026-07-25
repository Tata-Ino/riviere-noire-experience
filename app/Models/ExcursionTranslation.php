<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExcursionTranslation extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'excursion_id',
        'language_id',
        'name',
        'description',
    ];

    /**
     * L'excursion associée à cette traduction.
     */
    public function excursion(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }

    /**
     * La langue de cette traduction.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
