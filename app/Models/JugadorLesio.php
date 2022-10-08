<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadorLesio extends Model
{
    protected $table = 'jugador_lesions';

    protected $fillable = [
        'id_jugador',
        'lesio',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }
}
