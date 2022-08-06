<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciutat extends Model
{
    protected $table = 'ciutats';

    protected $fillable = [
        'nom',
        'latitud',
        'longitud',
    ];

    public function clubs()
    {
        return $this->hasMany(Club::class, 'id_ciutat', 'id');
    }
}
