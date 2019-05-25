<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Page extends Model
{
    use Translatable, ImageUploader;

    protected $fillable = ['title', 'body', 'published'];
    protected $translationAttributes = ['title', 'body'];
    protected $with = ['translation'];
    protected $appends = ['header_url', 'path'];
    protected $casts = ['published' => 'boolean'];

    public function getPathAttribute()
    {
        return $this->path();
    }

    /**
     * @param string $value
     */
    public function setSlugAttribute(string $value)
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * @param string $slug
     * @return string
     */
    private function incrementSlug(string $slug): string
    {
        $max = static::whereTitle($this->title)->latest('id')->first();

        if ($max->id !== $this->id) {
            $max = $max->slug;
            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($matches) {
                    return $matches[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }

    public function path()
    {
        $locale = App::getLocale();
        return "/{$locale}/p/{$this->slug}";
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getHeaderUrlAttribute()
    {
        return $this->getImageUrl($this->header);
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->where('published', true);
    }

    public static function installation(Request $request): Page
    {
        $page = new static();

        $page->slug = $page->title = $request->title;
        $page->body = $request->body;
        $page->meta = $request->meta;
        $page->keywords = $request->keywords;
        $page->style = $request->style;

        if ($request->hasFile('header')) {
            $page->header = $page->uploadImage($request->header);
        }
        $page->save();

        return $page;
    }

    public function updateInstallation(Request $request): bool
    {
        $this->slug = $this->title = $request->title;
        $this->body = $request->body;
        $this->meta = $request->meta;
        $this->keywords = $request->keywords;
        $this->style = $request->style;
        if ($request->hasFile('header')) {
            $this->header = $this->updateImage($request->header, $this->header);
        }

        return $this->save();
    }
}
