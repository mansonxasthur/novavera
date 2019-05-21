<?php

namespace App;

use App\Traits\FileUploader;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use FileUploader;

    protected $with = ['department'];
    protected $fillable = ['name', 'email', 'phone', 'linkedin_link', 'shortlist', 'rejected'];
    protected $casts = [
        'shortlist' => 'boolean',
        'rejected' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
