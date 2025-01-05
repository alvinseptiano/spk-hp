<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'prosesor',
        'kamera',
        'ram',
        'baterai',
        'resolusi',
    ];
    public function smartphone()
    {
        return $this->belongsTo('App\Models\Smartphone');
    }
}
