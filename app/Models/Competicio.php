<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competicio extends Model
{
    protected $table = 'competicions';

    protected $fillable = [
        'nom',
        'id_temporada',
        'id_tipus',
    ];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'id_temporada', 'id');
    }

    public function tipus()
    {
        return $this->belongsTo(TipusCompeticio::class, 'id_tipus', 'id');
    }

    public function partits()
    {
        return $this->hasMany(Partit::class, 'id_competicio', 'id')->orderBy('jornada');
    }
}
