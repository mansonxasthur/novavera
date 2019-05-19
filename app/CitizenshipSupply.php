<?php

namespace App;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class CitizenshipSupply extends Model
{
    use Translatable;

    public $timestamps = false;
    protected $fillable = ['detail'];
    protected $translationAttributes = ['detail'];
    protected $with = ['translation'];
}
