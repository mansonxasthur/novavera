<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SliderImage extends Model
{
    use Translatable, ImageUploader;

    public $timestamps = false;
    protected $fillable = ['title', 'subtitle', 'btn_label', 'btn_link', 'order', 'path'];
    protected $translationAttributes = ['title', 'subtitle', 'btn_label'];
    protected $with = ['translation'];
    protected $appends = ['path_url'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function getPathUrlAttribute()
    {
        return $this->getImageUrl($this->path);
    }
}
