<?php
// app/Models/Job.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'job_title',
        'job_type',
        'job_category',
        'location',
        'email',
        'phone_number',
        'salary',
        'price_per_hour',
        'deadline',
        'job_details',
        'requirements',
    ];

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
