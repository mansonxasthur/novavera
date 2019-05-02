<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderImageTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['locale','title', 'subtitle', 'btn_label'];
}
