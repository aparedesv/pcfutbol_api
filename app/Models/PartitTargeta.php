<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartitTargeta extends Model
{
    protected $table = 'partit_targetes';

    protected $fillable = [
        'id_partit',
        'id_jugador',
        'minut',
        'groga',
        'doble_groga',
        'vermella',
    ];

    public function partit()
    {
        return $this->belongsTo(Partit::class, 'id_partit', 'id');
    }

    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'id_jugador', 'id');
    }
}
