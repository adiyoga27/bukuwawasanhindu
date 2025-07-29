<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table='website';
     protected $fillable = ['app_name', 'address', 'phone','email','facebook','tiktok','youtube','instagram'];
}
