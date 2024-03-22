<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_seeker_id',
        'company_id',
        'application_id',
        'message',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }

    // Add relationships here if necessary
}
