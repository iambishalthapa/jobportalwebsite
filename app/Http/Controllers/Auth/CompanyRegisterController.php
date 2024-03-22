<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\JobSeekerMessage;
use App\Models\JobSeeker;


class CompanyRegisterController extends Controller
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'primaryPhoneNumber' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'companyIndustry' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'contactPersonName' => ['required', 'string', 'max:255'],
            'contactPersonMobile' => ['required', 'string', 'regex:/^[0-9]{10}$/'], // Regex pattern for exactly 10 digits
            'contactPersonEmail' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'uploadCompanyLogo' => ['nullable', 'image', 'max:2048'], // Optional logo validation
        ]);
       // Check if the email already exists in the job_seekers table
    if (JobSeeker::where('email', $request->email)->exists()) {
        throw ValidationException::withMessages([
            'email' => ['The email address is already registered as a job seeker.'],
        ]);
    }
        $logoPath = null;

if ($request->hasFile('uploadCompanyLogo')) {
    $logoFile = $request->file('uploadCompanyLogo');
    $randomFileName = uniqid() . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
    
    // Move the logo to the public directory
    $logoFile->move(public_path('companyphotos'), $randomFileName);

    // Set the logo path for database storage
    $logoPath = 'companyphotos/' . $randomFileName;
}


        $company = Company::create([
            'email' => $request->email,
            'primary_phone_number' => $request->primaryPhoneNumber,
            'company_name' => $request->companyName,
            'company_industry' => $request->companyIndustry,
            'city' => $request->city,
            'location' => $request->location,
            'contact_person_name' => $request->contactPersonName,
            'contact_person_mobile' => $request->contactPersonMobile,
            'contact_person_email' => $request->contactPersonEmail,
            'password' => Hash::make($request->password),
            'logo' => $logoPath ,
            'role' => 2,
        ]);

        event(new Registered($company));

        Auth::guard('company')->login($company);

        return redirect(RouteServiceProvider::COMPANYDASHBOARD);
    }
    // Update other fields as needed
    public function showUpdateForm($id)
    {
        $company = Company::find($id);
    
        if (!$company) {
            return redirect()->back()->with('error', 'company not found');
        }
    
        return view('company.updateaccount', ['company' => $company]);
    }
     /**
     * Handle an incoming account update request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAccount(Request $request): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'primaryphonenumber' => ['required', 'string', 'max:255'],
            'companyname' => ['required', 'string', 'max:255'],
            'companyindustry' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'contactpersonname' => ['required', 'string', 'max:255'],
            'contactpersonnumber' => ['required', 'string', 'max:255'],
            'contactpersonemail' => ['required', 'string', 'email', 'max:255'],
         
            'uploadCompanyLogo' => ['nullable', 'image', 'max:2048'], // Optional logo validation
        ]);
    
        $company = Auth::guard('company')->user();
    
        // Check if a new logo file is uploaded
        if ($request->hasFile('uploadCompanyLogo')) {
            // Delete the old logo file if it exists
            if ($company->logo) {
                $logoPath = public_path($company->logo);
    
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
    
            // Update the company details including the new logo
            $logoFile = $request->file('uploadCompanyLogo');
            $randomFileName = uniqid() . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
    
            // Move the new logo to the public directory
            $logoFile->move(public_path('companyphotos'), $randomFileName);
    
            // Set the logo path for database storage
            $logoPath = 'companyphotos/' . $randomFileName;
    
            $company->update([
                'logo' => $logoPath,
                'email' => $request->input('email'),
                'primary_phone_number' => $request->input('primaryphonenumber'),
                'company_name' => $request->input('companyname'),
                'company_industry' => $request->input('companyindustry'),
                'city' => $request->input('city'),
                'location' => $request->input('location'),
                'contact_person_name' => $request->input('contactpersonname'),
                'contact_person_mobile' => $request->input('contactpersonnumber'),
                'contact_person_email' => $request->input('contactpersonemail'),
                'password' => $request->input('password') ? Hash::make($request->input('password')) : $company->password,
            ]);
        } else {
            // Update the company details without changing the logo
            $company->update([
                'email' => $request->input('email'),
                'primary_phone_number' => $request->input('primaryphonenumber'),
                'company_name' => $request->input('companyname'),
                'company_industry' => $request->input('companyindustry'),
                'city' => $request->input('city'),
                'location' => $request->input('location'),
                'contact_person_name' => $request->input('contactpersonname'),
                'contact_person_mobile' => $request->input('contactpersonnumber'),
                'contact_person_email' => $request->input('contactpersonemail'),
                'password' => $request->input('password') ? Hash::make($request->input('password')) : $company->password,
            ]);
        }
    
        return redirect()->route('company.dashboard')->with('success', 'Account updated successfully!');
    }
    
    public function index()
    {
        return view('company.helpcenter');
    }
    public function sendMessage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'application_id' => ['required', 'exists:applications,id'],
            'message' => ['required', 'string'],
        ]);
    
        // Get the application based on the provided ID
        $application = Application::findOrFail($request->application_id);
    
        // Ensure the application belongs to the company
        if ($application->company_id !== auth()->guard('company')->id()) {
            return redirect()->back()->with('error', 'You are not authorized to send messages for this application.');
        }
    
        // Create a new message record for the job seeker
        JobSeekerMessage::create([
            'job_seeker_id' => $application->job_seeker_id,
            'company_id' => $application->company_id,
            'application_id' => $application->id,
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    
}
