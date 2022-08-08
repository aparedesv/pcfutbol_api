<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartitGol extends Model
{
    protected $table = 'partit_gols';

    protected $fillable = [
        'id_partit',
        'id_jugador',
        'minut'
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
