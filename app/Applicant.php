<?php

namespace App;

use App\Traits\FileUploader;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use FileUploader;

    protected $with = ['department'];
    protected $fillable = ['name', 'email', 'phone', 'linkedin_link'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
