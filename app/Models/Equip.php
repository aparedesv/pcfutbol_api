<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    protected $fillable = [
        'nom',
        'id_club',
    ];

    /* public function plantilla()
    {
        return $this->hasMany(Plantilla::class, 'id_ciutat', 'id');
    } */

    public function club()
    {
        return $this->belongsTo(Club::class, 'id_club', 'id');
    }
}
