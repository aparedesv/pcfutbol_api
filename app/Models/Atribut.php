<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    protected $table = 'atributs';

    protected $fillable = [
        'nom',
    ];

    public function jugadors()
    {
        return $this->belongsToMany(Jugador::class, 'jugador_atributs', 'id_atribut', 'id_jugador');
    }
}
