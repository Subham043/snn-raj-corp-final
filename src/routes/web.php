<?php

use App\Http\Middleware\AuthenticateChannelPartner;
use App\Http\Middleware\AuthenticateSiteEnquiry;
use App\Modules\Campaigns\Controllers\Main\CampaignEnquiryMainController;
use App\Modules\Campaigns\Controllers\Main\CampaignViewMainController;
use App\Modules\Main\AboutPage\AboutPageController;
use App\Modules\Main\AwardPage\AwardPageController;
use App\Modules\Main\BlogPage\BlogDetailPageController;
use App\Modules\Main\BlogPage\BlogPageController;
use App\Modules\Main\CampaignFormPage\CampaignFormPageController;
use App\Modules\Main\CareerPage\CareerPageController;
use App\Modules\Main\ChannelPartnerFormPage\ChannelPartnerFormPageController;
use App\Modules\Main\ChannelPartnerPage\ChannelPartnerPageController;
use App\Modules\Main\ContactPage\ContactPageController;
use App\Modules\Main\CsrPage\CsrPageController;
use App\Modules\Main\FreeAdFormPage\FreeAdFormPageController;
use App\Modules\Main\HomePage\HomePageController;
use App\Modules\Main\LandOwnerPage\LandOwnerPageController;
use App\Modules\Main\LegalPage\LegalPageController;
use App\Modules\Main\PopupPage\PopupPageController;
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
Route::get('/site-enquiry-form', [FreeAdFormPageController::class, 'get', 'as' => 'free_ad_form.get'])->name('free_ad_form.get');
Route::post('/site-enquiry-form-post', [FreeAdFormPageController::class, 'post', 'as' => 'free_ad_form.post'])->name('free_ad_form.post');
Route::middleware(['guest:site_enquiry'])->group(function () {
    Route::get('/site-enquiry-form-login', [FreeAdFormPageController::class, 'login', 'as' => 'free_ad_form.login'])->name('free_ad_form.login');
    Route::post('/site-enquiry-form-login-post', [FreeAdFormPageController::class, 'loginPost', 'as' => 'free_ad_form.login_post'])->name('free_ad_form.login_post');
});
Route::middleware([AuthenticateSiteEnquiry::class])->prefix('/site-enquiry-form')->group(function () {
    Route::get('/data', [FreeAdFormPageController::class, 'data', 'as' => 'free_ad_form.data'])->name('free_ad_form.data');
    Route::get('/excel', [FreeAdFormPageController::class, 'excel', 'as' => 'free_ad_form.excel'])->name('free_ad_form.excel');
    Route::get('/logout', [FreeAdFormPageController::class, 'logout', 'as' => 'free_ad_form.logout'])->name('free_ad_form.logout');
});
Route::get('/channel-partner-form', [ChannelPartnerFormPageController::class, 'get', 'as' => 'channel_partner_form.get'])->name('channel_partner_form.get');
Route::post('/channel-partner-form-post', [ChannelPartnerFormPageController::class, 'post', 'as' => 'channel_partner_form.post'])->name('channel_partner_form.post');
Route::middleware(['guest:channel_partner'])->group(function () {
    Route::get('/channel-partner-form-login', [ChannelPartnerFormPageController::class, 'login', 'as' => 'channel_partner_form.login'])->name('channel_partner_form.login');
    Route::post('/channel-partner-form-login-post', [ChannelPartnerFormPageController::class, 'loginPost', 'as' => 'channel_partner_form.login_post'])->name('channel_partner_form.login_post');
    Route::post('/channel-partner-form-verify', [ChannelPartnerFormPageController::class, 'verifyOtp', 'as' => 'channel_partner_form.verify_post'])->name('channel_partner_form.verify_post');
    Route::post('/channel-partner-form-resend-otp', [ChannelPartnerFormPageController::class, 'resendOtp', 'as' => 'channel_partner_form.resend_post'])->name('channel_partner_form.resend_post');
});
Route::middleware([AuthenticateChannelPartner::class])->prefix('/channel-partner-form')->group(function () {
    Route::get('/data', [ChannelPartnerFormPageController::class, 'data', 'as' => 'channel_partner_form.data'])->name('channel_partner_form.data');
    Route::get('/excel', [ChannelPartnerFormPageController::class, 'excel', 'as' => 'channel_partner_form.excel'])->name('channel_partner_form.excel');
    Route::get('/logout', [ChannelPartnerFormPageController::class, 'logout', 'as' => 'channel_partner_form.logout'])->name('channel_partner_form.logout');
});
Route::post('/contact-us-post', [ContactPageController::class, 'post', 'as' => 'contact_page.post'])->name('contact_page.post');
Route::post('/popup-us-post', [PopupPageController::class, 'post', 'as' => 'popup_page.post'])->name('popup_page.post');
Route::post('/career-post', [CareerPageController::class, 'post', 'as' => 'career_page.post'])->name('career_page.post');
Route::post('/become-a-channel-partner-post', [ChannelPartnerPageController::class, 'post', 'as' => 'channel_partner.post'])->name('channel_partner.post');
Route::post('/otp/resend', [ContactPageController::class, 'resendOtp', 'as' => 'contact_page.resendOtp'])->name('contact_page.resendOtp');
Route::post('/otp/{uuid}', [ContactPageController::class, 'verifyOtp', 'as' => 'contact_page.verifyOtp'])->name('contact_page.verifyOtp');
Route::post('/popup/otp/resend', [PopupPageController::class, 'resendOtp', 'as' => 'popup_page.resendOtp'])->name('popup_page.resendOtp');
Route::post('/popup/otp/{uuid}', [PopupPageController::class, 'verifyOtp', 'as' => 'popup_page.verifyOtp'])->name('popup_page.verifyOtp');
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