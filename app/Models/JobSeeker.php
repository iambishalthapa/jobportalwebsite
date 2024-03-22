<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class JobSeeker extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email', 'contact_number', 'full_name', 'job_preference', 'gender', 'password', 'profile_picture', 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $guard = 'job_seeker';
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'job_seeker_id');
    }
    public function appliedJobs()
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    public function hasAppliedJob($jobId)
    {
        return $this->appliedJobs->contains('job_id', $jobId);
    }
}
