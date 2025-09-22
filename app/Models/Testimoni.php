<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimonies';

    protected $fillable = [
        'name',
        'role',
        'photo',
        'rating',
        'message',
    ];
}
