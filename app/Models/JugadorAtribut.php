<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JugadorAtribut extends Model
{
    protected $table = 'jugador_atributs';

    protected $fillable = [
        'id_jugador',
        'id_atribut',
        'valor'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }

    public function atribut()
    {
        return $this->belongsTo(Atribut::class, 'id_atribut', 'id');
    }
}
