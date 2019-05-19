<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitizenshipTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['country_name', 'title', 'description', 'snippet'];
}
