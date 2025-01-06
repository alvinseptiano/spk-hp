<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternative extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(AlternativeScore::class);
    }

    public function criteria()
    {
        return $this->belongsToMany(Criteria::class, 'alternative_scores')
            ->withPivot('score');
    }
}