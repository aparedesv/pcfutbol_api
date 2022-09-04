<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompeticioEquip extends Model
{
    protected $table = 'competicio_equips';

    protected $fillable = [
        'id_competicio',
        'id_equip',
        'punts',
        'gols_favor',
        'gols_contra',
    ];

    public function competicio()
    {
        return $this->belongsTo(Competicio::class, 'id_competicio', 'id');
    }

    public function equip()
    {
        return $this->belongsTo(Equips::class, 'id_equip', 'id');
    }
}
