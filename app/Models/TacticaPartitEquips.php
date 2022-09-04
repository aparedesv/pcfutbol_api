<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacticaPartitEquip extends Model
{
    protected $table = 'tactica_partit_equips';

    protected $fillable = [
        'id_partit',
        'id_tactica',
        'id_equip',
        'minut_inici_tactica',
        'minut_final_tactica',
    ];

    public function partit()
    {
        return $this->belongsTo(Partit::class, 'id_partit', 'id');
    }

    public function tactica()
    {
        return $this->belongsTo(Tactica::class, 'id_tactica', 'id');
    }

    public function equip()
    {
        return $this->belongsTo(Equip::class, 'id_equip', 'id');
    }
}
