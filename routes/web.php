<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('terme-et-conditions',function(){
    return view('termes_et_conditions');
});
Route::get('politique-de-confidentalité',function(){
    return view('politique_de_confientalite');
});
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('job_seeker/index','App\Http\Controllers\job_seeker\home_job_seeker@show_index')->name('show.index');

Route::prefix('job_seeker')->group(function(){
        //
    // ─── REGISTER JOB_SEEKER ROUTES ─────────────────────────────────────────────────
    //
    Route::get('/register','App\Http\Controllers\job_seeker\Job_Seeker_Controller@show_register_form')
    ->name('register/job_seeker');
    Route::post('register','App\Http\Controllers\job_seeker\Job_Seeker_Controller@register')
    ->name('job_seeker.register');
    Route::post('/listing','App\Http\Controllers\job_seeker\Job_Seeker_Controller@register_news_letter')->name('job_seeker_news_letter.register');
    Route::post('/education/{id}','App\Http\Controllers\job_seeker\education_info@register_education')->name('job_seeker/resume_info');
    Route::post('/experience/{id}','App\Http\Controllers\job_seeker\job_seeker_experience@register_experience')->name('job_seeker/experience');
    Route::post('/skills/{id}','App\Http\Controllers\job_seeker\job_seeker_skills@fill_skills')->name('job_seeker/skills');
    Route::get('/{id}/{username}/resumé','App\Http\Controllers\job_seeker\my_resumé@show_resume')->name('job_seeker/show_resumé');

    //
    // ─── LOGIN JOB_SEEKER ROUTES ─────────────────────────────────────────────────────
    //
    Route::get('/login','App\Http\Controllers\job_seeker\Login_Job_Seeker_Controller@showloginform')->name('job_seeker/login');
    Route::post('login','App\Http\Controllers\job_seeker\Login_Job_Seeker_Controller@login')->name('job_seeker.login');

    Route::get('/login/facebook', 'App\Http\Controllers\job_seeker\Login_Job_Seeker_Controller@redirectToProvider');
    Route::get('/login/facebook/callback', 'App\Http\Controllers\job_seeker\Login_Job_Seeker_Controller@handleProviderCallback');

    Route::post('/index','App\Http\Controllers\job_seeker\Login_Job_Seeker_Controller@logout')->name('job_seeker/logout');

    //
    // ─── RESET PASSWORD JOB SEEKER ROUTES ───────────────────────────────────────────
    //
    Route::get('/change_password/{id}','App\Http\Controllers\job_seeker\Job_Seeker_Forgot_Password@show_form')->name('job_seeker/change_password');
    Route::post('/update_password/{id}','App\Http\Controllers\job_seeker\Job_Seeker_ResetPassword@update_password')->name('job_seeker/update_password');

    Route::get('/password/reset','App\Http\Controllers\job_seeker\Job_Seeker_Forgot_Password@show_reset_form')->name('job_seeker/request');
    Route::post('/password/email','App\Http\Controllers\job_seeker\Job_Seeker_Forgot_Password@sendResetLinkEmail')->name('job_seeker.email');
    Route::post('/password/reset', 'App\Http\Controllers\job_seeker\Job_Seeker_ResetPassword@reset')->name('job_seeker.reset');
    Route::get('/password/reset/{token}','App\Http\Controllers\job_seeker\Job_Seeker_ResetPassword@showResetForm')->name('job_seeker.password.reset');
    //
    // ─── EMAIL VERIFICATION JOB SEEKER ──────────────────────────────────────────────
    //

    Route::get('/email/verify','App\Http\Controllers\job_seeker\Job_Seeker_Verification@show')->name('job_seeker/verify/notice');
    Route::get('/email/verify/{id}','App\Http\Controllers\job_seeker\Job_Seeker_Verification@verify')->name('job_seeker.verification.verify');

    //
    // ─── JOB SEEKER DASHBOARD ───────────────────────────────────────────────────────
    //


    Route::get('{id}/job_listings','App\Http\Controllers\job_seeker\Job_offers@show_offers')->name('job_seeker/jobs');
    Route::post('{id}/show_offers','App\Http\Controllers\job_seeker\Job_offers@show_offer_by_ajax')->name('job_seeker/show_offers');

    // Route::get('{id}/searched_data','App\Http\Controllers\job_seeker\Job_offers@searched_category')->name('job_seeker/categories');

    Route::get('/dashboard/{id}','App\Http\Controllers\job_seeker\myjobs@show_dashboard')->name('job_seeker/dashboard');

    Route::get('/applied_jobs/{id}','App\Http\Controllers\job_seeker\myjobs@show_applied_jobs')->name('job_seeker/applied_jobs');
    // Route::get('/{id}/job_listing','job_seeker\Job_offers@offer_by_ajax')->name('search_ajax');
    Route::get('/{job_seeker_id}/job_listing','App\Http\Controllers\job_seeker\Job_offers@show_offer_by_categorie')->name('search');
    Route::post('/profile/{id}/update','App\Http\Controllers\job_seeker\Job_Seeker_Profile@update')->name('job_seeker/profile.update');
     Route::get('/my_profile/{id}','App\Http\Controllers\job_seeker\Job_Seeker_Profile@show_profile')->name('job_seeker/profile');
    Route::get('/resume/{id}','App\Http\Controllers\job_seeker\Job_Seeker_Profile@show_resume')->name('job_seeker/resume');
    // Route::post('/{job_seeker_id}/submit_demand/{id}','job_seeker\Job_offers@send_demand_offer')->name('job_seeker/demand_job');
    Route::post('{id}/job_offer/{employer_id}/{offer_id}','App\Http\Controllers\job_seeker\Job_offers@send_offer')->name('send/offer');
    Route::get('/{id}/single_offer/{offer_id}','App\Http\Controllers\job_seeker\Job_offers@show_single_offer')->name('show/single_offer');
    Route::get('/single_offer/{offer_id}','App\Http\Controllers\job_seeker\Job_offers@submit_single_offer')->name('submit/single_offer');
    Route::get('/applied_jobs/{id}','App\Http\Controllers\job_seeker\myjobs@applied_jobs')->name('job_seeker/applied_jobs');
    Route::post('/{job_seeker_id}/{job_offer_id}\supprimer','App\Http\Controllers\job_seeker\myjobs@delete_applied_jobs')->name('delete/applied_jobs');
    Route::get('/{id}/{username}/dowload-cv','App\Http\Controllers\job_seeker\my_resumé@download_resume')->name('download/cv');
    Route::get('/profile/{id}','App\Http\Controllers\job_seeker\my_resumé@show_resume')->name('job_seeker/detail');
    Route::post('/delete_job_seeker/{id}','App\Http\Controllers\job_seeker\Job_Seeker_Profile@delete_profile')->name('delete/job_seeker');
    Route::get('/pagination/fetch_data','App\Http\Controllers\job_seeker\Job_offers@fetch_data');

});


Route::prefix('employer')->group(function(){
    //
    // ─── REGISTER EMPLOYER ROUTES ───────────────────────────────────────────────────
    //
    Route::post('/delete_applicant/{job_seeker_id}/{offer_id}','App\Http\Controllers\Employer\Candidate_Listing@delete_application')->name('delete/application');
    Route::get('/register','App\Http\Controllers\Employer\Register_Employer_Controller@show_register_form')->name('employer/register');
    Route::get('/login','App\Http\Controllers\Employer\Login_Employer_Controller@showLoginForm')->name('employer/login');
    Route::post('/register','App\Http\Controllers\Employer\Register_Employer_Controller@store')->name('employer.register');
    Route::post('/register_job_offer','App\Http\Controllers\Employer\JobOfferController@store')->name('register.job_offer');
    Route::get('/profile/{id}','App\Http\Controllers\Employer\Profile_Controller@show_profile')->name('employer/profile');
    Route::post('/profile/{id}/update','App\Http\Controllers\Employer\Profile_Controller@update')->name('profile.update');
    Route::get('/{id}/my_jobs','App\Http\Controllers\Employer\Dashboard_Controller@show_jobs')->name('employer/my_jobs');
    Route::get('/{id}/details','App\Http\Controllers\Employer\Dashboard_Controller@show_details')->name('employer/details');
    Route::get('/register_job_offer/{id}','App\Http\Controllers\Employer\JobOfferController@register_job_offer')->name('register/job_offer');
    Route::get('/{id}/{username}/dowload-cv','App\Http\Controllers\Employer\Dashboard_Controller@download_fiche')->name('download/fiche');
    Route::get('/{id}/job_offer/{offer_id}','App\Http\Controllers\Employer\My_Jobs@show_offer')->name('show/offer');
    Route::get('/{id}/applicants/{offer_id}','App\Http\Controllers\Employer\Candidate_Listing@show_candidates')->name('show/applicant');
    Route::post('/{id}/job_offer/{job_offer_id}','App\Http\Controllers\Employer\My_Jobs@send_random_offer')->name('send/random_offer');
    Route::post('/{id}/single_offer/{offer_id}','App\Http\Controllers\Employer\My_Jobs@delete_single_offer')->name('delete/job');
    Route::post('/{id}/job_offers/{offer_id}','App\Http\Controllers\Employer\My_Jobs@update_single_offer')->name('update/job');
    Route::post('/delete/employer/{id}','App\Http\Controllers\Employer\Profile_Controller@delete_profile')->name('delete/employer');
    Route::get('/{id}/candidates','App\Http\Controllers\Employer\Dashboard_Controller@show_candidates')->name('show/candidates');





    //
    // ─── LOGIN EMPLOYER ROUTES ──────────────────────────────────────────────────────
    //
     Route::get('/login','App\Http\Controllers\Employer\Login_Employer_Controller@showLoginForm')->name('employer/login');
    Route::post('/login','App\Http\Controllers\Employer\Login_Employer_Controller@login')->name('employer.login');
    // Route::get('/candidate_listing','Employer\Candidate_Listing@show_candidates')->name('employer/candidates');
    Route::get('/dashboard/{id}','App\Http\Controllers\Employer\Dashboard_Controller@show_dashboard')->name('employer/dashboard');

    Route::post('/logout','App\Http\Controllers\Employer\Login_Employer_Controller@logout')->name('employer/logout');
    //
    // ─── RESET PASSWORD EMPLOYER ROUTES ─────────────────────────────────────────────
    //
    Route::get('/change_password/{id}','App\Http\Controllers\Employer\Employer_Forgot_Password@show_form')->name('employer/change_password');
    Route::post('/update_password/{id}','App\Http\Controllers\Employer\Employer_Reset_Password@update_password')->name('employer/update_password');

     Route::get('/reset','App\Http\Controllers\Employer\Employer_Forgot_Password@show_link_request_form')->name('employer/request');
     Route::post('/reset/email','App\Http\Controllers\Employer\Employer_Forgot_Password@sendResetLinkEmail')->name('employer.reset.email');
     Route::post('/reset','App\Http\Controllers\Employer\Employer_Reset_Password@reset')->name('employer.reset');
     Route::get('/reset/email/{token}','App\Http\Controllers\Employer\Employer_Reset_Password@show_reset_form')->name('employer.password.reset');

});
// Route::group(['namespace' => 'Admin'], function() {

//     Route::post('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');
//     Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
//     Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('admin.verification.verify');

//     Route::get('/', 'HomeController@index')->middleware('admin.verified')->name('admin.dashboard');

// });
