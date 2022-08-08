<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competicio extends Model
{
    protected $table = 'competicions';

    protected $fillable = [
        'nom',
        'id_temporada',
    ];

    public function temporada()
    {
        return $this->belongsTo(Tactica::class, 'id_temporada', 'id');
    }

    public function partits()
    {
        return $this->hasMany(Partit::class, 'id_competicio', 'id');
    }
}
