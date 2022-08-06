<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadors';

    protected $fillable = [
        'nom',
        'cognoms',
        'data_naixement',
    ];

    public function equip()
    {
        return $this->belongsToMany(Equip::class, 'plantilles', 'id_jugador', 'id_equip');
    }

    public function posicions()
    {
        return $this->belongsToMany(Posicio::class, 'jugador_posicions', 'id_jugador', 'id_posicio');
    }

    public function atributs()
    {
        return $this->belongsToMany(Atribut::class, 'jugador_atributs', 'id_jugador', 'id_atribut')->withPivot('valor');
    }
}
