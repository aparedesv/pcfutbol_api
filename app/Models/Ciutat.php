<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciutat extends Model
{
    protected $fillable = [
        'nom',
        'latitud',
        'longitud',
    ];

    public function club()
    {
        return $this->hasMany(Club::class, 'id', 'id_ciutat');
    }
}
