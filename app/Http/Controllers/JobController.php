<?php

namespace App\Http\Controllers;
use App\Models\JobSeekerMessage;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SavedJob;
use App\Models\JobSeeker;
use App\Models\Application;

class JobController extends Controller
{
    public function create()
    {
        return view('company.postjob');
    }
 

    public function store(Request $request)
    {
   // Validate the form data
   $request->validate([
    'jobTitle' => 'required|string|max:255',
    'jobType' => 'required|in:fullTime,partTime,contract,internship',
    'jobCategory' => 'required|string|max:255',
    'location' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'phonenumber' => 'required|string|max:20',
    'salary' => 'required|numeric|min:0',
    'pricePerHour' => 'required|numeric|min:0',
    'deadline' => 'required|date|after_or_equal:'.now()->addDays(3)->format('Y-m-d'),
    'jobDetails' => 'required|string',
    'requirements' => 'required|string',
]);

        // Assuming you are using the 'company' guard
        $company = auth('company')->user();

        // Create a new job
        $job = Job::create([
            'company_id' => $company->id,
            'job_title' => $request->input('jobTitle'),
            'job_type' => $request->input('jobType'),
            'job_category' => $request->input('jobCategory'),
            'location' => $request->input('location'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phonenumber'),
            'salary' => $request->input('salary'),
            'price_per_hour' => $request->input('pricePerHour'),
            'deadline' => $request->input('deadline'),
            'job_details' => $request->input('jobDetails'),
            'requirements' => $request->input('requirements'),
        ]);

        // Redirect to the company dashboard or wherever you want
        return redirect()->route('company.joblist')->with('success', 'Job posted successfully!');
    }
    public function showJobList(Request $request)
    {
        // Get the currently authenticated company user
        $company = Auth::guard('company')->user();
    
        // Fetch jobs only for the authenticated company user
        $query = Job::where('company_id', $company->id);
    
        // Apply search filters if provided in the request
        if ($request->filled('job_title')) {
            $query->where('job_title', 'like', '%' . $request->input('job_title') . '%');
        }
    
        // Check if a category is selected, if not, don't apply category filter
        if ($request->filled('job_category')) {
            $query->where('job_category', $request->input('job_category'));
        }
    
        $jobs = $query->paginate(2);
    
        return view('company.joblist', compact('jobs'));
    }
    
public function deleteJob($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return redirect()->back()->with('error', 'Job not found');
        }

        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully');
    }
    public function showUpdateForm($id)
{
    $job = Job::find($id);

    if (!$job) {
        return redirect()->back()->with('error', 'Job not found');
    }

    return view('company.updatejob', ['job' => $job]);
}

    public function updateJob(Request $request, $id)
{
    // Validate and update job details here
    $request->validate([
        'jobTitle' => 'required|string|max:255',
        'jobType' => 'required|string|in:fullTime,partTime,contract,internship',
        'jobCategory' => 'required|string|in:it,finance,healthcare,marketing,engineering,education,sales,customerService,hospitality,design,writing,humanResources,administration,manufacturing,logistics',
        'location' => 'required|string|max:255',
        'salary' => 'required|numeric',
        'pricePerHour' => 'required|numeric',
        'deadline' => 'required|date',
        'email' => 'required|email',
        'phonenumber' => 'required|string',
        'jobDetails' => 'required|string',
        'requirements' => 'required|string',
    ]);

    $job = Job::find($id);

    if (!$job) {
        return redirect()->back()->with('error', 'Job not found');
    }

    $job->update([
        'job_title' => $request->input('jobTitle'),
        'job_type' => $request->input('jobType'),
        'job_category' => $request->input('jobCategory'),
        'location' => $request->input('location'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phonenumber'),
        'salary' => $request->input('salary'),
        'price_per_hour' => $request->input('pricePerHour'),
        'deadline' => $request->input('deadline'),
        'job_details' => $request->input('jobDetails'),
        'requirements' => $request->input('requirements'),
    ]);

    return redirect()->route('company.joblist')->with('success', 'Job updated successfully.');
}
public function jobSearch(Request $request)
{
    // Fetch all jobs with pagination
    $jobsQuery = Job::query();

    // Apply search filters if provided in the request
    if ($request->filled('job_title')) {
        $jobsQuery->where('job_title', 'like', '%' . $request->input('job_title') . '%');
    }

    // Check if a category is selected, if not, don't apply category filter
    if ($request->filled('job_category')) {
        $jobsQuery->where('job_category', $request->input('job_category'));
    }

    // Paginate the filtered jobs
    $jobs = $jobsQuery->paginate(2);

    return view('job.jobsearch', compact('jobs'));
}
public function saveJob(Request $request)
{
    // Ensure the job seeker is authenticated
    if (!Auth::guard('job_seeker')->check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $jobId = $request->input('job_id');
    $jobSeekerId = Auth::guard('job_seeker')->user()->id;

    // Check if the job is already saved to prevent duplicates
    if (SavedJob::where('job_id', $jobId)->where('job_seeker_id', $jobSeekerId)->exists()) {
        return response()->json(['message' => 'Job already saved'], 422);
    }

    // Save the job
    SavedJob::create([
        'job_id' => $jobId,
        'job_seeker_id' => $jobSeekerId,
    ]);

    // Get the updated list of saved job IDs
    $jobSeeker = JobSeeker::with('savedJobs')->find($jobSeekerId);

    return response()->json([
        'message' => 'Job saved successfully.',
        'savedJobIds' => $savedJobIds,
    ]);
}
// Add the new method for showing saved jobs
public function showSavedJobs($id)
{
    // Get the authenticated job seeker
    $jobSeeker = Auth::guard('job_seeker')->user();

    // Fetch saved jobs for the authenticated job seeker
    $savedJobs = SavedJob::where('job_seeker_id', $jobSeeker->id)->paginate(2);

    // Retrieve details of saved jobs
    $jobs = $savedJobs->map(function ($savedJob) {
        return Job::find($savedJob->job_id);
    });

    return view('job.saved', compact('jobs', 'savedJobs'));
}

public function removeJob($id)
{
    $jobSeekerId = Auth::guard('job_seeker')->user()->id;

    // Find the saved job record
    $savedJob = SavedJob::where('job_id', $id)->where('job_seeker_id', $jobSeekerId)->first();

    if ($savedJob) {
        // Delete the saved job record
        $savedJob->delete();
        
        return redirect()->route('job.saved', ['id' => $id])->with('success', 'Job removed successfully');

    }

    return redirect()->route('job.saved',['id' => $id])->with('error', 'Job not found');
}
public function applyJobForm($jobId)
    {
        $job = Job::find($jobId);

        if (!$job) {
            return redirect()->back()->with('error', 'Job not found');
        }

        return view('job.apply', compact('job'));
    }

   
   
public function applyJob(Request $request, $jobId)
{
    // Validate the form data
    $request->validate([
        'resume' => 'required|mimes:pdf,doc,docx',
        'cover_letter' => 'required|mimes:pdf,doc,docx',
        'message' => 'nullable|string',
    ]);

    $jobSeeker = Auth::guard('job_seeker')->user();
    $job = Job::find($jobId);

    if (!$jobSeeker || !$job) {
        return redirect()->back()->with('error', 'Invalid job application');
    }

    // Check if the user has already applied for this job
    if (Application::where('job_seeker_id', $jobSeeker->id)->where('job_id', $job->id)->exists()) {
        return redirect()->back()->with('error', 'You have already applied for this job.');
    }

    // Get the public path for storing files
    $publicPath = public_path();

    // Generate random filenames
    $resumeFileName = Str::random(20) . '.' . $request->file('resume')->getClientOriginalExtension();
    $coverLetterFileName = Str::random(20) . '.' . $request->file('cover_letter')->getClientOriginalExtension();

    // Move the files to the specified folders within the public directory
    $resumePath = $request->file('resume')->move($publicPath . '/resume', $resumeFileName);
    $coverLetterPath = $request->file('cover_letter')->move($publicPath . '/coverletters', $coverLetterFileName);

    // Save the application
    Application::create([
        'job_seeker_id' => $jobSeeker->id,
        'job_id' => $job->id,
        'company_id' => $job->company_id,
        'resume_path' => '/resume/' . $resumeFileName,
        'cover_letter_path' => '/coverletters/' . $coverLetterFileName,
        'message' => $request->input('message'),
    ]);

    return redirect()->back()->with('success', 'Application submitted successfully.');
}
    
    
public function appliedJobs()
{
    // Get the currently authenticated job seeker
    $jobSeeker = Auth::guard('job_seeker')->user();

    // Retrieve applications only for the authenticated job seeker
    $applications = Application::where('job_seeker_id', $jobSeeker->id)
                                ->with(['jobSeeker', 'job', 'company'])
                                ->paginate(10);

    return view('job.appliedjob', ['applications' => $applications]);
}
public function removeAppliedJob($id)
{
    $application = Application::find($id);

    if (!$application) {
        return redirect()->back()->with('error', 'Invalid job application');
    }

    // Delete related messages first
    JobSeekerMessage::where('application_id', $application->id)->delete();

    // Then remove the applied job
    $application->delete();

    return redirect()->back()->with('success', 'Applied job removed successfully.');
}

public function showCandidateList()
{
    // Retrieve applications with related job seeker and job details for the current company
    $company_id = auth()->guard('company')->id(); // Get the ID of the logged-in company
    $applications = Application::where('company_id', $company_id)
                                ->with(['jobSeeker', 'job'])
                                ->get();

    return view('company.candidatelist', compact('applications'));
}
public function acceptApplication($id)
{
    $application = Application::findOrFail($id);
    $application->status = 'accepted';
    $application->save();

    return redirect()->back()->with('success', 'Application accepted successfully.');
}

public function rejectApplication($id)
{
    $application = Application::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->back()->with('success', 'Application rejected successfully.');
}
public function downloadCV($id)
{
    // Find the JobSeeker by ID
    $jobSeeker = JobSeeker::find($id);

    // Check if the JobSeeker is not found
    if (!$jobSeeker) {
        return redirect()->back()->with('error', 'Job Seeker not found');
    }

    // Adjust the path to the CV file based on your storage configuration
    $cvPath = Storage::disk('public')->path("resumes/{$jobSeeker->resume_path}");

    // Check if the CV file exists
    if (!file_exists($cvPath)) {
        return redirect()->back()->with('error', 'CV file not found');
    }

    // Return the CV file as a download response
    return response()->download($cvPath, $jobSeeker->name . '_CV', [], 'inline');
}

public function downloadCoverLetter($id)
{
    // Find the Application by ID
    $application = Application::find($id);

    // Check if the Application is not found
    if (!$application) {
        return redirect()->back()->with('error', 'Application not found');
    }

    // Adjust the path to the cover letter file based on your storage configuration
    $coverLetterPath = Storage::disk('public')->path("coverletters/{$application->cover_letter_path}");

    // Check if the cover letter file exists
    if (!file_exists($coverLetterPath)) {
        return redirect()->back()->with('error', 'Cover letter file not found');
    }

    // Return the cover letter file as a download response
    return response()->download($coverLetterPath, $application->jobSeeker->name . '_CoverLetter', [], 'inline');
}
public function viewMessages()
{
    // Get the currently authenticated company
    $company = Auth::guard('company')->user();

    // Retrieve applications only for the authenticated company
    $applications = Application::where('company_id', $company->id)
                                ->with(['jobSeeker', 'job'])
                                ->get();

    return view('company.viewmessages', compact('applications'));
}
public function index()
{
    return view('job.helpcenter');
}


}
