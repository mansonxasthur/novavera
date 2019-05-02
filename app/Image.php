<?php

namespace App;

use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use ImageUploader;

    protected $fillable = ['path'];
    protected $appends = ['image_url'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getImageUrlAttribute()
    {
        return $this->getImageUrl($this->path);
    }
}
