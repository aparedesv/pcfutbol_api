<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipusCompeticio extends Model
{
    protected $table = 'tipus_competicio';

    protected $fillable = [
        'nom',
        'lliga',
        'copa',
        'anada_tornada',
        'numero_equips',
    ];

    public function competicio()
    {
        return $this->hasMany(Competicio::class, 'id_tipus', 'id');
    }
}
