<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\Application; // Import the Application model
use App\Models\SavedJob; // Import the SavedJob model
class JobDashboardController extends Controller
{
    
    public function jobDashboard()
    {
        // Retrieve statistics
        $jobSeeker = Auth::guard('job_seeker')->user();
        $totalAppliedJobs = Application::where('job_seeker_id', $jobSeeker->id)->count();
        $totalSavedJobs = SavedJob::where('job_seeker_id', $jobSeeker->id)->count();
        
        // Pass statistics to the view
        return view('job.jobdashboard', compact('totalAppliedJobs', 'totalSavedJobs'));
    }
}
