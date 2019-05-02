<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeveloperTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['locale', 'description'];
}
