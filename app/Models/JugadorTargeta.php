<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadorTargeta extends Model
{
    protected $table = 'jugador_targetes';

    protected $fillable = [
        'id_jugador',
        'grogues',
        'vermella',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }
}
