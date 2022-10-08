<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadors';

    protected $fillable = [
        'nom',
        'cognoms',
        'data_naixement',
    ];

    protected $appends = ['mitja', 'ordre'];

    public function gols()
    {
        return $this->hasMany(PartitGol::class, 'id_jugador', 'id');
    }

    public function targetes()
    {
        return $this->hasOne(JugadorTargeta::class, 'id_jugador', 'id');
    }

    public function lesio()
    {
        return $this->hasOne(JugadorLesions::class, 'id_jugador', 'id');
    }

    public function targetesPartit()
    {
        return $this->hasMany(PartitTargeta::class, 'id_jugador', 'id');
    }

    public function equip()
    {
        return $this->belongsToMany(Equip::class, 'plantilles', 'id_jugador', 'id_equip');
    }

    public function posicions()
    {
        return $this->belongsToMany(Posicio::class, 'jugador_posicions', 'id_jugador', 'id_posicio');
    }

    public function atributs()
    {
        return $this->belongsToMany(Atribut::class, 'jugador_atributs', 'id_jugador', 'id_atribut')->withPivot('valor');
    }

    public function getMitjaAttribute()
    {
        $atributs = JugadorAtribut::where('id_jugador', $this->attributes['id'])->get();
        $valors = [];

        foreach ($atributs as $atribut)
        {
            array_push($valors, $atribut->valor);
        }

        return round(array_sum($valors)/count($valors));
    }

    public function getOrdreAttribute()
    {
        $ordre = Plantilla::where('id_jugador', $this->attributes['id'])->first()->ordre;

        if($ordre <> NULL)
        {
            return $ordre;
        }
        else
        {
            return NULL;
        }
    }
}
