<?php

use App\Modules\Campaigns\Controllers\Main\CampaignEnquiryMainController;
use App\Modules\Campaigns\Controllers\Main\CampaignViewMainController;
use App\Modules\Main\AboutPage\AboutPageController;
use App\Modules\Main\AwardPage\AwardPageController;
use App\Modules\Main\BlogPage\BlogDetailPageController;
use App\Modules\Main\BlogPage\BlogPageController;
use App\Modules\Main\CampaignFormPage\CampaignFormPageController;
use App\Modules\Main\CareerPage\CareerPageController;
use App\Modules\Main\ChannelPartnerPage\ChannelPartnerPageController;
use App\Modules\Main\ContactPage\ContactPageController;
use App\Modules\Main\CsrPage\CsrPageController;
use App\Modules\Main\FreeAdFormPage\FreeAdFormPageController;
use App\Modules\Main\HomePage\HomePageController;
use App\Modules\Main\LandOwnerPage\LandOwnerPageController;
use App\Modules\Main\LegalPage\LegalPageController;
use App\Modules\Main\ProjectPage\CompletedProjectPageController;
use App\Modules\Main\ProjectPage\OngoingProjectPageController;
use App\Modules\Main\ProjectPage\ProjectPageController;
use App\Modules\Main\ProjectPage\ProjectDetailPageController;
use App\Modules\Main\ReferalPage\ReferalPageController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomePageController::class, 'get', 'as' => 'home_page.get'])->name('home_page.get');
Route::get('/about-us', [AboutPageController::class, 'get', 'as' => 'about_page.get'])->name('about_page.get');
Route::get('/csr', [CsrPageController::class, 'get', 'as' => 'csr_page.get'])->name('csr_page.get');
Route::get('/awards', [AwardPageController::class, 'get', 'as' => 'awards_page.get'])->name('awards_page.get');
Route::get('/contact-us', [ContactPageController::class, 'get', 'as' => 'contact_page.get'])->name('contact_page.get');
Route::get('/career', [CareerPageController::class, 'get', 'as' => 'career_page.get'])->name('career_page.get');
Route::get('/refer-now', [ReferalPageController::class, 'get', 'as' => 'referal_page.get'])->name('referal_page.get');
Route::get('/become-a-channel-partner', [ChannelPartnerPageController::class, 'get', 'as' => 'channel_partner.get'])->name('channel_partner.get');
Route::get('/land-owner', [LandOwnerPageController::class, 'get', 'as' => 'land_owner.get'])->name('land_owner.get');
Route::post('/land-owner-post', [LandOwnerPageController::class, 'post', 'as' => 'land_owner.post'])->name('land_owner.post');
Route::get('/free-ad-form', [CampaignFormPageController::class, 'get', 'as' => 'campaign_form.get'])->name('campaign_form.get');
Route::post('/free-ad-form-post', [CampaignFormPageController::class, 'post', 'as' => 'campaign_form.post'])->name('campaign_form.post');
Route::get('/campaign-form', [FreeAdFormPageController::class, 'get', 'as' => 'free_ad_form.get'])->name('free_ad_form.get');
Route::post('/campaign-form-post', [FreeAdFormPageController::class, 'post', 'as' => 'free_ad_form.post'])->name('free_ad_form.post');
Route::post('/campaign-form-verify', [FreeAdFormPageController::class, 'verify', 'as' => 'free_ad_form.verify'])->name('free_ad_form.verify');
Route::post('/contact-us-post', [ContactPageController::class, 'post', 'as' => 'contact_page.post'])->name('contact_page.post');
Route::post('/career-post', [CareerPageController::class, 'post', 'as' => 'career_page.post'])->name('career_page.post');
Route::post('/become-a-channel-partner-post', [ChannelPartnerPageController::class, 'post', 'as' => 'channel_partner.post'])->name('channel_partner.post');
Route::post('/otp/resend', [ContactPageController::class, 'resendOtp', 'as' => 'contact_page.resendOtp'])->name('contact_page.resendOtp');
Route::post('/otp/{uuid}', [ContactPageController::class, 'verifyOtp', 'as' => 'contact_page.verifyOtp'])->name('contact_page.verifyOtp');
Route::post('/refer-now-post', [ReferalPageController::class, 'post', 'as' => 'referal_page.post'])->name('referal_page.post');
Route::get('/projects', [ProjectPageController::class, 'get', 'as' => 'projects.get'])->name('projects.get');
Route::get('/completed-projects', [CompletedProjectPageController::class, 'get', 'as' => 'completed_projects.get'])->name('completed_projects.get');
Route::get('/completed-projects/{slug}', [ProjectDetailPageController::class, 'get', 'as' => 'completed_projects_detail.get'])->name('completed_projects_detail.get');
Route::get('/ongoing-projects', [OngoingProjectPageController::class, 'get', 'as' => 'ongoing_projects.get'])->name('ongoing_projects.get');
Route::get('/ongoing-projects/{slug}', [ProjectDetailPageController::class, 'get', 'as' => 'ongoing_projects_detail.get'])->name('ongoing_projects_detail.get');
Route::get('/blogs', [BlogPageController::class, 'get', 'as' => 'blogs.get'])->name('blogs.get');
Route::get('/blogs/{slug}', [BlogDetailPageController::class, 'get', 'as' => 'blogs_detail.get'])->name('blogs_detail.get');
Route::group(['middleware' => 'throttle:3,1'], function () {
    Route::post('/campaign/enquiry/create', [CampaignEnquiryMainController::class, 'post', 'as' => 'enquiry_create.post'])->name('enquiry_create.post');
    Route::post('/campaign/otp/resend', [CampaignEnquiryMainController::class, 'resendOtp', 'as' => 'enquiry.resendOtp'])->name('enquiry.resendOtp');
    Route::post('/campaign/otp/{uuid}', [CampaignEnquiryMainController::class, 'verifyOtp', 'as' => 'enquiry.verifyOtp'])->name('enquiry.verifyOtp');
});
Route::get('/campaign/{slug}', [CampaignViewMainController::class, 'get', 'as' => 'campaign_view_main.get'])->name('campaign_view_main.get');
Route::get('/campaign/{slug}/thank-you', [CampaignViewMainController::class, 'thank', 'as' => 'campaign_view_thank.get'])->name('campaign_view_thank.get');
Route::get('/{legal_slug}', [LegalPageController::class, 'get', 'as' => 'legal.get'])->name('legal.get');
