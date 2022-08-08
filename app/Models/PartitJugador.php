<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartitJugador extends Model
{
    protected $table = 'partit_jugadors';

    protected $fillable = [
        'id_partit',
        'id_jugador',
        'id_posicio',
        'minut_inici_posicio',
        'minut_final_posicio'
    ];

    public function partit()
    {
        return $this->belongsTo(Partit::class, 'id_partit', 'id');
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }

    public function posicio()
    {
        return $this->belongsTo(Posicio::class, 'id_posicio', 'id');
    }
}
