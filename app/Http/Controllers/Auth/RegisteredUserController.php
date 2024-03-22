<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\JobSeeker;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.companyregister');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' =>2,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function editProfile()
{
    $user = Auth::user();
    return view('admin.adminaccount', compact('user'));
}

public function updateProfile(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully');
}
    // Method to display the list of registered companies
    public function showCompanyList()
    {
        // Retrieve all registered companies
        $companies = Company::all();
        
        // Return the view with the list of companies
        return view('admin.companylist', compact('companies'));
    }

    public function deleteCompany(Request $request, $id)
{
    // Find the company by ID
    $company = Company::find($id);

    if (!$company) {
        return redirect()->back()->with('error', 'Company not found');
    }

    // Delete associated jobs first
    Job::where('company_id', $company->id)->delete();

    // Delete the company's logo from public storage if it exists
    if ($company->logo) {
        $logoPath = 'public/' . $company->logo; // Adjust the path to the public storage folder
        if (Storage::exists($logoPath)) {
            Storage::delete($logoPath);
        }
    }

    // Delete the company record
    $company->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Company deleted successfully');
}
// Method to show all registered job seekers
public function showJobSeekerList()
{
    // Retrieve all registered job seekers
    $jobSeekers = JobSeeker::all();

    // Return the view with the list of job seekers
    return view('admin.jobseekerlist', compact('jobSeekers'));
}

// Method to delete a job seeker
public function deleteJobSeeker($id)
{
    // Find the job seeker by ID
    $jobSeeker = JobSeeker::find($id);

    if (!$jobSeeker) {
        return redirect()->back()->with('error', 'Job seeker not found');
    }

    // Delete the job seeker record
    $jobSeeker->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Job seeker deleted successfully');
}
// Method to display the admin dashboard


public function showDashboard()
{
    // Retrieve statistics
    $totalCompanies = Company::count();
    $totalJobSeekers = JobSeeker::count();
    
    // Return the view with statistics
    return view('admin.admindashboard', compact('totalCompanies', 'totalJobSeekers'));
}

}
