<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_hp'; // Set the primary key to 'id_hp'
    protected $table = 'data_hp'; // your table name

    protected $fillable = [
        'nama',
        'harga',
        'prosesor',
        'memori',
        'ram',
        'kamera',
        'resolusi',
        'baterai',
        'harga_n',
        'prosesor_n',
        'memori_n',
        'ram_n',
        'kamera_n',
        'resolusi_n',
        'baterai_n'
    ];
}