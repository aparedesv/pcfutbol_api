<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadorPosicio extends Model
{
    protected $table = 'jugador_posicions';

    protected $fillable = [
        'id_jugador',
        'id_posicio'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }

    public function posicio()
    {
        return $this->belongsTo(Posicio::class, 'id_posicio', 'id');
    }
}
