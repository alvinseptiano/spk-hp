<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $fillable = [
        'name',
        'description',
        'weight',
        'type'
    ];

    public function alternativeScores(): HasMany
    {
        return $this->hasMany(AlternativeScore::class);
    }

    public function alternatives()
    {
        return $this->belongsToMany(Alternative::class, 'alternative_scores')
            ->withPivot('score');
    }
}