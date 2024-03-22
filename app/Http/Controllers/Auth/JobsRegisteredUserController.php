<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\JobSeekerMessage;
use App\Models\Job;


class JobsRegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.jobsregister');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:job_seekers'],
            'contactNumber' => ['required', 'string', 'regex:/^[0-9]{10}$/'], // Regex pattern for exactly 10 digits
            'fullName' => ['required', 'string', 'max:255'],
            'jobPreference' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'uploadProfilePicture' => ['nullable', 'image', 'max:2048'], // Optional profile picture validation
        ]);
    // Check if the email already exists in the companies table
    if (Company::where('email', $request->email)->exists()) {
        throw ValidationException::withMessages([
            'email' => ['The email address is already registered as a company.'],
        ]);
    }
        if ($request->hasFile('uploadProfilePicture')) {
            $profilePictureFile = $request->file('uploadProfilePicture');
            $randomFileName = uniqid() . '_' . time() . '.' . $profilePictureFile->getClientOriginalExtension();
            
            // Move the profile picture to the public directory
            $profilePictureFile->move(public_path('jobphotos'), $randomFileName);
        
            // Set the profile picture path for database storage
            $profilePicturePath = $randomFileName;

        }
    
        $jobSeeker = JobSeeker::create([
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'full_name' => $request->fullName,
            'job_preference' => $request->jobPreference,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath ? 'jobphotos/' . $profilePicturePath : null, // Adjust the path as needed
            'role' => 3,
        ]);
    
        event(new Registered($jobSeeker));
    
        Auth::guard('job_seeker')->login($jobSeeker);
    
        return redirect(RouteServiceProvider::JOBDASHBOARD);;
    }
    // Your existing methods...

    /**
     * Display the update account form.
     *
     * @return \Illuminate\View\View
     */
    public function showUpdateForm($id)
    {
        $jobSeeker = JobSeeker::find($id);
        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'Job seeker not found');
        }
    
        return view('job.updatejobaccount', ['jobSeeker' => $jobSeeker]);
    }
    
     /**
     * Handle an incoming account update request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $jobSeeker = JobSeeker::find($id);
    
        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'Job seeker not found');
        }
    
        $request->validate([
            'uploadProfilePicture' => ['nullable', 'image', 'max:2048'], // Optional profile picture validation
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:job_seekers,email,' . $id],
            'contactNumber' => ['required', 'string', 'max:255'],
            // Add other fields for validation as needed
        ]);
    
        // Update profile picture if a new one is provided
        if ($request->hasFile('uploadProfilePicture')) {
            $profilePictureFile = $request->file('uploadProfilePicture');
            $randomFileName = uniqid() . '_' . time() . '.' . $profilePictureFile->getClientOriginalExtension();
    
           // Delete old profile picture if exists
        if ($jobSeeker->profile_picture) {
            $oldProfilePicturePath = public_path($jobSeeker->profile_picture);
            if (file_exists($oldProfilePicturePath)) {
                unlink($oldProfilePicturePath);
            }
        }
    
            // Move the new profile picture to the public directory
            $profilePictureFile->move(public_path('jobphotos'), $randomFileName);
    
            // Set the profile picture path for database storage
            $profilePicturePath = 'jobphotos/' . $randomFileName;
            $jobSeeker->profile_picture = $profilePicturePath;
        }
    
        // Update other fields
        $jobSeeker->email = $request->email;
        $jobSeeker->contact_number = $request->contactNumber;
        $jobSeeker->full_name = $request->fullName;
        $jobSeeker->job_preference = $request->jobPreference;
        $jobSeeker->gender = $request->gender;
    
        // Update password if provided
        if ($request->filled('password')) {
            $jobSeeker->password = Hash::make($request->password);
        }
    
        // Save changes
        $jobSeeker->save();
    
        return redirect()->route('job.dashboard')->with('success', 'Account updated successfully');
    }
    public function showMessages()
{
    $jobSeeker = auth()->guard('job_seeker')->user(); // Get the authenticated job seeker

    // Fetch messages for the current job seeker
    $messages = JobSeekerMessage::where('job_seeker_id', $jobSeeker->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Mark messages as read once they are viewed
    foreach ($messages as $message) {
        $message->update(['read_at' => now()]);
    }

    return view('job.messages', compact('messages'));
}
public function jobSearch(Request $request)
{
    // Fetch jobs with pagination
    $jobs = Job::paginate(10); // Change the number based on your requirement

    return view('job.jobsearch', compact('jobs'));
}
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
