<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartitActa extends Model
{
    protected $table = 'partit_actes';

    protected $fillable = [
        'id_partit',
        'partit_finalitzat',
        'equip_local_ok',
        'equip_visitant_ok',
        'assitencia',
        'gols_local_ok',
        'gols_visitant_ok',
    ];

    public function partit()
    {
        return $this->belongsTo(Partit::class, 'id_partit', 'id');
    }
}
