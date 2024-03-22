<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = null;

        // Check if the email belongs to a company
        $company = Company::where('email', $request->email)->first();
        if ($company) {
            // If the email belongs to a company, send password reset link for company
            $status = Password::broker('companies')->sendResetLink(
                $request->only('email')
            );
        } else {
            // Check if the email belongs to a job seeker
            $jobSeeker = JobSeeker::where('email', $request->email)->first();
            if ($jobSeeker) {
                // If the email belongs to a job seeker, send password reset link for job seeker
                $status = Password::broker('job_seekers')->sendResetLink(
                    $request->only('email')
                );
            } else {
                // Check if the email belongs to a regular user
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    // If the email belongs to a regular user, send password reset link for user
                    $status = Password::broker()->sendResetLink(
                        $request->only('email')
                    );
                } else {
                    // If no user found with the provided email, show error
                    throw ValidationException::withMessages([
                        'email' => [trans('passwords.user')],
                    ]);
                }
            }
        }

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
