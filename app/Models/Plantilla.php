<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $table = 'plantilles';

    protected $fillable = [
        'id_jugador',
        'id_equip',
        'ordre'
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class, 'id_equip', 'id');
    }
}
