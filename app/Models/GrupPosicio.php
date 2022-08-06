<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupPosicio extends Model
{
    protected $table = 'grup_posicions';

    protected $fillable = [
        'descripcio',
    ];

    public function grup()
    {
        return $this->hasMany(Posicio::class, 'id_grup', 'id');
    }
}
