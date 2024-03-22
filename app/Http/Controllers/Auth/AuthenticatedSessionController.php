<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Check if the user exists in the users table
        $user = \App\Models\User::where('email', $credentials['email'])->first();
    
        // Check if the user exists in the companies table
        $company = \App\Models\Company::where('email', $credentials['email'])->first();
        $jobSeeker = \App\Models\JobSeeker::where('email', $credentials['email'])->first();
    
        if ($user) {
            // User found in the users table
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                // Redirect to the job person dashboard
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } elseif ($company) {
            // Company found in the companies table
            if (Auth::guard('company')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                // Redirect to the company dashboard
                return redirect(RouteServiceProvider::COMPANYDASHBOARD);
            }
        }elseif ($jobSeeker) {
            // Company found in the companies table
            if (Auth::guard('job_seeker')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                // Redirect to the company dashboard
                return redirect(RouteServiceProvider::JOBDASHBOARD);
            }
        }
        // If neither user nor company was found or authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
