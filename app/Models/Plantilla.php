<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $table = 'plantilles';

    protected $fillable = [
        'id_jugador',
        'id_equip'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }

    public function equip()
    {
        return $this->belongsTo(Equip::class, 'id_equip', 'id');
    }
}
