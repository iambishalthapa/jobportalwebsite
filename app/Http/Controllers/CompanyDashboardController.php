<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    public function showDashboard()
    {
        // Get the currently authenticated company user
        $company = Auth::guard('company')->user();

        // Count the total number of jobs posted by the company
        $totalPostedJobs = Job::where('company_id', $company->id)->count();

        // Count the total number of candidate applications for the company's jobs
        $totalCandidateApplications = Application::whereHas('job', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->count();

        // Pass the statistics to the view
        return view('company.dashboard', compact('totalPostedJobs', 'totalCandidateApplications'));
    }
}
