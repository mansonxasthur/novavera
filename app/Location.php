<?php

namespace App;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Translatable;

    public $timestamps = false;
    protected $fillable = ['name'];

    protected $translationAttributes = ['name'];

    protected $with = ['translation'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
