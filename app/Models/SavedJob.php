<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{ use HasFactory;

    protected $fillable = ['job_seeker_id', 'job_id'];

    // Assuming you have relationships defined in your model
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }
}
