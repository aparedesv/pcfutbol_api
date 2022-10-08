<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    protected $table = 'partits';

    protected $fillable = [
        'nom',
        'id_competicio',
        'jornada',
        'id_equip_local',
        'id_equip_visitant',
        'id_camp',
        'inici',
    ];

    public function acta()
    {
        return $this->hasOne(PartitActa::class, 'id_partit', 'id');
    }

    public function equipLocal()
    {
        return $this->belongsTo(Equip::class, 'id_equip_local', 'id');
    }

    public function equipVisitant()
    {
        return $this->belongsTo(Equip::class, 'id_equip_visitant', 'id');
    }

    public function jugadors()
    {
        return $this->belongsToMany(Jugador::class, 'partit_jugadors', 'id_partit', 'id_jugador');
    }

    public function posicions()
    {
        return $this->belongsToMany(Posicio::class, 'partit_jugadors', 'id_partit', 'id_posicio');
    }

    public function tactiques()
    {
        return $this->belongsToMany(Tactica::class, 'tactica_partit_equips', 'id_partit', 'id_tactica');
    }

    public function gols()
    {
        return $this->hasMany(PartitGol::class, 'id_partit', 'id');
    }

    public function targetes()
    {
        return $this->hasMany(PartitTargeta::class, 'id_partit', 'id');
    }

    public function competicio()
    {
        return $this->belongsTo(Competicio::class, 'id_competicio', 'id');
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class, 'id_camp', 'id');
    }
}
