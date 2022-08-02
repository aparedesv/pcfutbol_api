<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'nom',
        'id_ciutat',
    ];

    public function ciutat()
    {
        return $this->belongsTo(Ciutat::class, 'id_ciutat', 'id');
    }
}
