<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRequest extends Model
{
    protected $with = ['project', 'propertyType'];
    protected $fillable = ['name', 'email', 'phone', 'message'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_id');
    }
}
