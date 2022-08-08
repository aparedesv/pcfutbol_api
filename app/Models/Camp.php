<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $table = 'camps';

    protected $fillable = [
        'nom',
        'id_club',
        'capacitat',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'id_club', 'id');
    }
}
