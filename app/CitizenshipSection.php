<?php

namespace App;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class CitizenshipSection extends Model
{
    use Translatable;

    protected $fillable = ['section_id', 'content', 'after'];
    protected $translationAttributes = ['content'];
    protected $with = ['translation'];
    public $timestamps = false;

    public function getContentAttribute()
    {
        return $this->getTranslation('content');
    }
}
