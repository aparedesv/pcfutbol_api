<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table = 'temporades';

    protected $fillable = [
        'nom',
        'inici',
        'final',
    ];

    public function competicio()
    {
        return $this->hasMany(Competicio::class, 'id_temporada', 'id');
    }
}
