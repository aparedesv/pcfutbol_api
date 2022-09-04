<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacticaEquip extends Model
{
    protected $table = 'tactica_equips';

    protected $fillable = [
        'id_tactica',
        'id_equip'
    ];

    public function tactica()
    {
        return $this->belongsTo(Tactica::class, 'id_tactica', 'id');
    }

    public function equip()
    {
        return $this->belongsTo(Equip::class, 'id_equip', 'id');
    }
}
