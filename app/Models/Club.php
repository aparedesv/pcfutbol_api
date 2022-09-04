<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'clubs';

    protected $fillable = [
        'nom',
        'id_ciutat',
    ];

    public function camps()
    {
        return $this->hasMany(Camp::class, 'id_club', 'id');
    }

    public function ciutat()
    {
        return $this->belongsTo(Ciutat::class, 'id_ciutat', 'id');
    }
}
