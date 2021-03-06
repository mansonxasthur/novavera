<?php

namespace App;

use App\Traits\ImageUploader;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Post extends Model
{
    use Translatable, ImageUploader;

    protected $fillable = ['title', 'body', 'slug', 'published'];
    protected $translationAttributes = ['title', 'body'];
    protected $with = ['tags', 'translation'];
    protected $appends = ['featured_image_url'];
    protected $casts = ['published' => 'boolean'];

    public static function installation(Request $request): Post
    {
        $post = new static();

        $post->slug = $post->title = $request->title;
        $post->body = $request->body;
        $post->meta = $request->meta;
        $post->keywords = $request->keywords;
        $post->style = $request->style;
        if ($request->hasFile('featured_image')) {
            $post->featured_image = $post->uploadImage($request->featured_image);
        }
        $post->save();

        return $post;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->getImageUrl($this->featured_image);
    }

    public function updateInstallation(Request $request):bool
    {
        $this->slug = $this->title = $request->title;
        $this->body = $request->body;
        $this->meta = $request->meta;
        $this->keywords = $request->keywords;
        $this->style = $request->style;

        if ($request->hasFile('featured_image')) {
            $this->featured_image = $this->updateImage($request->featured_image, $this->featured_image);
        }

        return $this->save();
    }
}
