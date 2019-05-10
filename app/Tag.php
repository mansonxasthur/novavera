<?php

namespace App;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;

    public $timestamps = false;
    protected $fillable = ['name'];
    /* @todo tag translation */


    public function posts()
    {
        return $this->belongsToMany(Post::class , 'post_tag');
    }
}
