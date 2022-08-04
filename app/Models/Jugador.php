<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $fillable = [
        'nom',
        'cognoms',
        'data_naixement',
    ];

    public function equip()
    {
        return $this->belongsToMany(Equip::class, 'plantilles', 'id_jugador', 'id_equip');
    }
}
