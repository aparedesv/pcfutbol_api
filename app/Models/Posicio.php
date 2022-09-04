<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posicio extends Model
{
    protected $table = 'posicions';

    protected $fillable = [
        'nom',
        'descripcio',
        'id_grup'
    ];

    public function grup()
    {
        return $this->belongsTo(GrupPosicio::class, 'id_grup', 'id');
    }

    public function jugadors()
    {
        return $this->belongsToMany(Jugador::class, 'jugador_posicions', 'id_posicio', 'id_jugador');
    }
}
