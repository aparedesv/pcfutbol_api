<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    protected $table = 'equips';

    protected $fillable = [
        'nom',
        'id_club',
    ];

    public function plantilla()
    {
        return $this->belongsToMany(Jugador::class, 'plantilles', 'id_equip', 'id_jugador')->orderBy('ordre', 'ASC');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'id_club', 'id');
    }
}
