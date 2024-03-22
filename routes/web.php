<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\JobDashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\CompanyRegisterController;
use App\Http\Controllers\Auth\JobsRegisteredUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\RegisteredUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/admin/edit-profile', [RegisteredUserController::class, 'editProfile'])->name('admin.editProfile');
Route::post('/admin/update-profile', [RegisteredUserController::class, 'updateProfile'])->name('admin.updateProfile');

Route::get('/admin/company-list', [RegisteredUserController::class, 'showCompanyList'])
    ->name('admin.companyList');
Route::delete('/admin/delete-company/{id}', [RegisteredUserController::class, 'deleteCompany'])
    ->name('admin.deleteCompany');
    Route::get('/admin/jobseekers', [RegisteredUserController::class, 'showJobSeekerList'])->name('admin.jobseekers');
    Route::delete('/admin/jobseekers/{id}', [RegisteredUserController::class, 'deleteJobSeeker'])->name('admin.deleteJobSeeker');
    
Route::prefix('company')->group(function () {
    Route::get('/companydashboard', [CompanyDashboardController::class, 'showDashboard'])
        ->name('company.dashboard')
        ->middleware('company');

    // Add the following routes for job creation
    Route::get('/postjob', [JobController::class, 'create'])->name('company.postjob.create');
    Route::post('/postjob', [JobController::class, 'store'])->name('company.postjob.store');
});

Route::prefix('job')->group(function () {
    Route::get('/jobdashboard', [JobDashboardController::class, 'jobDashboard'])->name('job.dashboard');
    // Route for displaying the update account form for job seekers
    Route::get('/job_seeker/update-account/{id}', [JobsRegisteredUserController::class, 'showUpdateForm'])->name('job_seeker.update-account');
    Route::put('/job_seeker/update-account/{id}', [JobsRegisteredUserController::class, 'update'])->name('job_seeker.update-account');
});
Route::get('/jobseeker/messages', [JobsRegisteredUserController::class, 'showMessages'])->name('jobseeker.messages');
Route::get('/company/dashboard', function () {
    return view('company.postjob');
})->name('company.postjob');
Route::get('/company/job/list', [JobController::class, 'showJobList'])->name('company.joblist');
Route::delete('/delete-job/{id}', [JobController::class, 'deleteJob'])->name('delete.job');

// Existing route
Route::get('/company/candidate/list', [JobController::class, 'showCandidateList'])->name('company.candidatelist');
   // Accept job application
   Route::post('/accept-application/{id}', [JobController::class, 'acceptApplication'])
   ->name('job.acceptApplication');

// Reject job application
Route::post('/reject-application/{id}', [JobController::class, 'rejectApplication'])
   ->name('job.rejectApplication');
// Add this route to your web.php file
Route::get('/view-cv/{id}', [JobController::class, 'downloadviewCV'])->name('view.cv');
Route::get('/view-cover-letter/{id}', [JobController::class, 'downloadCoverLetter'])->name('view.coverLetter');
Route::get('/company/messages', [JobController::class, 'viewMessages'])->name('company.messages');
Route::get('/job-help-center', [JobController::class, 'index'])->name('job-help-center');
Route::get('/company-help-center', [CompanyRegisterController::class, 'index'])->name('company-help-center');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/message',function(){
    return view('company.sendmessage');
});
Route::post('/company/send-message-to-jobseeker', [CompanyRegisterController::class, 'sendMessage'])->name('send.message');
Route::get('/dashboard', [RegisteredUserController::class, 'showDashboard']) // Call the showDashboard method from AdminController
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/company/job/{id}/edit', [JobController::class, 'showUpdateForm'])->name('company.editjob');
Route::put('/company/job/{id}/update', [JobController::class, 'updateJob'])->name('company.updatejob');

Route::get('/company/update/{id}account', [CompanyRegisterController::class, 'showUpdateForm'])->name('company.updateaccount');
Route::put('/company/update/{id}/account', [CompanyRegisterController::class, 'updateAccount'])->name('company.update');
Route::get('/job/search', [JobController::class, 'jobSearch'])->name('job.search');
// routes/web.php
Route::post('/save-job', [JobController::class, 'saveJob'])->name('job.save');

// Add the route for removing a saved job
Route::delete('/job/remove/{id}', [JobController::class, 'removeJob'])->name('job.remove');


Route::get('/job/saved/{id}', [JobController::class, 'showSavedJobs'])->name('job.saved');

Route::get('/job/apply/{jobId}', [JobController::class, 'applyJobForm'])->name('job.apply.form');
Route::post('/job/apply/{jobId}', [JobController::class, 'applyJob'])->name('job.apply');
Route::get('/job/show/{id}', [JobController::class, 'showJob'])->name('job.show');

Route::get('/applied-jobs', [JobController::class, 'appliedJobs'])->name('job.appliedjobs');
Route::delete('/job/remove-applied/{id}',  [JobController::class,'removeAppliedJob'])->name('job.removeApplied');




Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('message.send');
Route::get('/messages', [MessageController::class, 'viewMessages'])->name('messages');
require __DIR__.'/auth.php';

