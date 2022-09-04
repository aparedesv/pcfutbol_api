<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tactica extends Model
{
    protected $table = 'tactiques';

    protected $fillable = [
        'nom',
        'defenses',
        'mitjos',
        'davanters',
        'entrelinies_defensa',
        'entrelinies_atac',
    ];

    public function equips()
    {
        return $this->belongsToMany(Equip::class, 'tactica_equips', 'id_tactica', 'id_equip');
    }
}
