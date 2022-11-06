<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'nom',
        'cognoms',
        'email',
        'email_verified_at',
        'token'
    ];
}
