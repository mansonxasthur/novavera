<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRequest extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'message'];
}
