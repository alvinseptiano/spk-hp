<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlternativeScore extends Model
{
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'score'
    ];

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }
}
