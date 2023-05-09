<?php

use App\Modules\About\AdditionalContent\Controllers\AdditionalContentCreateController;
use App\Modules\About\AdditionalContent\Controllers\AdditionalContentDeleteController;
use App\Modules\About\AdditionalContent\Controllers\AdditionalContentPaginateController;
use App\Modules\About\AdditionalContent\Controllers\AdditionalContentUpdateController;
use App\Modules\About\Banner\Controllers\BannerController;
use App\Modules\About\Main\Controllers\AboutMainController;
use App\Modules\Authentication\Controllers\PasswordUpdateController;
use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Awards\Controllers\AwardCreateController;
use App\Modules\Awards\Controllers\AwardDeleteController;
use App\Modules\Awards\Controllers\AwardHeadingController;
use App\Modules\Awards\Controllers\AwardPaginateController;
use App\Modules\Awards\Controllers\AwardUpdateController;
use App\Modules\Blog\Controllers\BlogCreateController;
use App\Modules\Blog\Controllers\BlogDeleteController;
use App\Modules\Blog\Controllers\BlogPaginateController;
use App\Modules\Blog\Controllers\BlogUpdateController;
use App\Modules\Counter\Controllers\CounterCreateController;
use App\Modules\Counter\Controllers\CounterDeleteController;
use App\Modules\Counter\Controllers\CounterHeadingController;
use App\Modules\Counter\Controllers\CounterPaginateController;
use App\Modules\Counter\Controllers\CounterUpdateController;
use App\Modules\Csr\Controllers\CsrBannerController;
use App\Modules\Csr\Controllers\CsrCreateController;
use App\Modules\Csr\Controllers\CsrDeleteController;
use App\Modules\Csr\Controllers\CsrPaginateController;
use App\Modules\Csr\Controllers\CsrUpdateController;
use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Enquiry\ContactForm\Controllers\ContactFormDeleteController;
use App\Modules\Enquiry\ContactForm\Controllers\ContactFormExcelController;
use App\Modules\Enquiry\ContactForm\Controllers\ContactFormPaginateController;
use App\Modules\HomePage\About\Controllers\AboutController;
use App\Modules\HomePage\Banner\Controllers\BannerCreateController;
use App\Modules\HomePage\Banner\Controllers\BannerDeleteController;
use App\Modules\HomePage\Banner\Controllers\BannerPaginateController;
use App\Modules\HomePage\Banner\Controllers\BannerUpdateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialCreateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialDeleteController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialHeadingController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialPaginateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialUpdateController;
use App\Modules\Legal\Controllers\LegalPaginateController;
use App\Modules\Legal\Controllers\LegalUpdateController;
use App\Modules\Partner\Controllers\PartnerCreateController;
use App\Modules\Partner\Controllers\PartnerDeleteController;
use App\Modules\Partner\Controllers\PartnerHeadingController;
use App\Modules\Partner\Controllers\PartnerPaginateController;
use App\Modules\Partner\Controllers\PartnerUpdateController;
use App\Modules\Project\Accomodations\Controllers\AccomodationCreateController;
use App\Modules\Project\Accomodations\Controllers\AccomodationDeleteController;
use App\Modules\Project\Accomodations\Controllers\AccomodationPaginateController;
use App\Modules\Project\Accomodations\Controllers\AccomodationUpdateController;
use App\Modules\Project\Banners\Controllers\BannerCreateController as ProjectBannerCreateController;
use App\Modules\Project\Banners\Controllers\BannerDeleteController as ProjectBannerDeleteController;
use App\Modules\Project\Banners\Controllers\BannerPaginateController as ProjectBannerPaginateController;
use App\Modules\Project\Banners\Controllers\BannerUpdateController as ProjectBannerUpdateController;
use App\Modules\Project\AdditionalContents\Controllers\AdditionalContentCreateController as ProjectAdditionalContentCreateController;
use App\Modules\Project\AdditionalContents\Controllers\AdditionalContentDeleteController as ProjectAdditionalContentDeleteController;
use App\Modules\Project\AdditionalContents\Controllers\AdditionalContentPaginateController as ProjectAdditionalContentPaginateController;
use App\Modules\Project\AdditionalContents\Controllers\AdditionalContentUpdateController as ProjectAdditionalContentUpdateController;
use App\Modules\Project\CommonAmenitys\Controllers\CommonAmenityCreateController;
use App\Modules\Project\CommonAmenitys\Controllers\CommonAmenityDeleteController;
use App\Modules\Project\CommonAmenitys\Controllers\CommonAmenityPaginateController;
use App\Modules\Project\CommonAmenitys\Controllers\CommonAmenityUpdateController;
use App\Modules\Project\GalleryImages\Controllers\GalleryImageCreateController;
use App\Modules\Project\GalleryImages\Controllers\GalleryImageDeleteController;
use App\Modules\Project\GalleryImages\Controllers\GalleryImagePaginateController;
use App\Modules\Project\GalleryImages\Controllers\GalleryImageUpdateController;
use App\Modules\Project\GalleryVideos\Controllers\GalleryVideoCreateController;
use App\Modules\Project\GalleryVideos\Controllers\GalleryVideoDeleteController;
use App\Modules\Project\GalleryVideos\Controllers\GalleryVideoPaginateController;
use App\Modules\Project\GalleryVideos\Controllers\GalleryVideoUpdateController;
use App\Modules\Project\Plans\Controllers\PlanCreateController;
use App\Modules\Project\Plans\Controllers\PlanDeleteController;
use App\Modules\Project\Plans\Controllers\PlanPaginateController;
use App\Modules\Project\Plans\Controllers\PlanUpdateController;
use App\Modules\Project\Projects\Controllers\ProjectCreateController;
use App\Modules\Project\Projects\Controllers\ProjectDeleteController;
use App\Modules\Project\Projects\Controllers\ProjectHeadingController;
use App\Modules\Project\Projects\Controllers\ProjectPaginateController;
use App\Modules\Project\Projects\Controllers\ProjectUpdateController;
use App\Modules\Role\Controllers\RoleCreateController;
use App\Modules\Role\Controllers\RoleDeleteController;
use App\Modules\Role\Controllers\RolePaginateController;
use App\Modules\Role\Controllers\RoleUpdateController;
use App\Modules\Seo\Controllers\SeoPaginateController;
use App\Modules\Seo\Controllers\SeoUpdateController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogDetailController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogPaginateController;
use App\Modules\Settings\Controllers\Chatbot\ChatbotController;
use App\Modules\Settings\Controllers\ErrorLogController;
use App\Modules\Settings\Controllers\General\GeneralController;
use App\Modules\Settings\Controllers\SitemapController;
use App\Modules\Settings\Controllers\Theme\ThemeController;
use App\Modules\TeamMember\Management\Controllers\ManagementCreateController;
use App\Modules\TeamMember\Management\Controllers\ManagementDeleteController;
use App\Modules\TeamMember\Management\Controllers\ManagementHeadingController;
use App\Modules\TeamMember\Management\Controllers\ManagementPaginateController;
use App\Modules\TeamMember\Management\Controllers\ManagementUpdateController;
use App\Modules\TeamMember\Staff\Controllers\StaffCreateController;
use App\Modules\TeamMember\Staff\Controllers\StaffDeleteController;
use App\Modules\TeamMember\Staff\Controllers\StaffHeadingController;
use App\Modules\TeamMember\Staff\Controllers\StaffPaginateController;
use App\Modules\TeamMember\Staff\Controllers\StaffUpdateController;
use App\Modules\User\Controllers\UserCreateController;
use App\Modules\User\Controllers\UserDeleteController;
use App\Modules\User\Controllers\UserPaginateController;
use App\Modules\User\Controllers\UserUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'get', 'as' => 'login.get'])->name('login.get');
    Route::post('/authenticate', [LoginController::class, 'post', 'as' => 'login.post'])->name('login.post');
    Route::get('/forgot-password', [ForgotPasswordController::class, 'get', 'as' => 'forgot_password.get'])->name('forgot_password.get');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'post', 'as' => 'forgot_password.post'])->name('forgot_password.post');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'get', 'as' => 'reset_password.get'])->name('reset_password.get')->middleware('signed');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'post', 'as' => 'reset_password.post'])->name('reset_password.post')->middleware('signed');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'get', 'as' => 'dashboard.get'])->name('dashboard.get');

    Route::prefix('/setting')->group(function () {
        Route::get('/general', [GeneralController::class, 'get', 'as' => 'general.settings.get'])->name('general.settings.get');
        Route::post('/general-post', [GeneralController::class, 'post', 'as' => 'general.settings.post'])->name('general.settings.post');
        Route::get('/theme', [ThemeController::class, 'get', 'as' => 'theme.settings.get'])->name('theme.settings.get');
        Route::post('/theme-post', [ThemeController::class, 'post', 'as' => 'theme.settings.post'])->name('theme.settings.post');
        Route::get('/chatbot', [ChatbotController::class, 'get', 'as' => 'chatbot.settings.get'])->name('chatbot.settings.get');
        Route::post('/chatbot-post', [ChatbotController::class, 'post', 'as' => 'chatbot.settings.post'])->name('chatbot.settings.post');
        Route::get('/sitemap', [SitemapController::class, 'get', 'as' => 'sitemap.get'])->name('sitemap.get');
        Route::get('/sitemap-generate', [SitemapController::class, 'generate', 'as' => 'sitemap.generate'])->name('sitemap.generate');
    });

    Route::prefix('/logs')->group(function () {
        Route::get('/error', [ErrorLogController::class, 'get', 'as' => 'error_log.get'])->name('error_log.get');
        Route::prefix('/activity')->group(function () {
            Route::get('/', [ActivityLogPaginateController::class, 'get', 'as' => 'activity_log.paginate.get'])->name('activity_log.paginate.get');
            Route::get('/{id}', [ActivityLogDetailController::class, 'get', 'as' => 'activity_log.detail.get'])->name('activity_log.detail.get');

        });
    });

    Route::prefix('/enquiry')->group(function () {
        Route::prefix('/contact-form')->group(function () {
            Route::get('/', [ContactFormPaginateController::class, 'get', 'as' => 'enquiry.contact_form.paginate.get'])->name('enquiry.contact_form.paginate.get');
            Route::get('/excel', [ContactFormExcelController::class, 'get', 'as' => 'enquiry.contact_form.excel.get'])->name('enquiry.contact_form.excel.get');
            Route::get('/delete/{id}', [ContactFormDeleteController::class, 'get', 'as' => 'enquiry.contact_form.delete.get'])->name('enquiry.contact_form.delete.get');

        });
    });

    Route::prefix('/home-page')->group(function () {
        Route::prefix('/banner')->group(function () {
            Route::get('/', [BannerPaginateController::class, 'get', 'as' => 'home_page.banner.paginate.get'])->name('home_page.banner.paginate.get');
            Route::get('/create', [BannerCreateController::class, 'get', 'as' => 'home_page.banner.create.get'])->name('home_page.banner.create.get');
            Route::post('/create', [BannerCreateController::class, 'post', 'as' => 'home_page.banner.create.post'])->name('home_page.banner.create.post');
            Route::get('/update/{id}', [BannerUpdateController::class, 'get', 'as' => 'home_page.banner.update.get'])->name('home_page.banner.update.get');
            Route::post('/update/{id}', [BannerUpdateController::class, 'post', 'as' => 'home_page.banner.update.post'])->name('home_page.banner.update.post');
            Route::get('/delete/{id}', [BannerDeleteController::class, 'get', 'as' => 'home_page.banner.delete.get'])->name('home_page.banner.delete.get');

        });

        Route::prefix('/testimonial')->group(function () {
            Route::get('/', [TestimonialPaginateController::class, 'get', 'as' => 'home_page.testimonial.paginate.get'])->name('home_page.testimonial.paginate.get');
            Route::get('/create', [TestimonialCreateController::class, 'get', 'as' => 'home_page.testimonial.create.get'])->name('home_page.testimonial.create.get');
            Route::post('/create', [TestimonialCreateController::class, 'post', 'as' => 'home_page.testimonial.create.post'])->name('home_page.testimonial.create.post');
            Route::get('/update/{id}', [TestimonialUpdateController::class, 'get', 'as' => 'home_page.testimonial.update.get'])->name('home_page.testimonial.update.get');
            Route::post('/update/{id}', [TestimonialUpdateController::class, 'post', 'as' => 'home_page.testimonial.update.post'])->name('home_page.testimonial.update.post');
            Route::get('/delete/{id}', [TestimonialDeleteController::class, 'get', 'as' => 'home_page.testimonial.delete.get'])->name('home_page.testimonial.delete.get');
            Route::post('/heading', [TestimonialHeadingController::class, 'post', 'as' => 'testimonial.heading.post'])->name('testimonial.heading.post');

        });

        Route::prefix('/about-section')->group(function () {
            Route::get('/', [AboutController::class, 'get', 'as' => 'home_page.about.get'])->name('home_page.about.get');
            Route::post('/', [AboutController::class, 'post', 'as' => 'home_page.about.post'])->name('home_page.about.post');
        });
    });

    Route::prefix('/about')->group(function () {
        Route::prefix('/main')->group(function () {
            Route::get('/', [AboutMainController::class, 'get', 'as' => 'about.main.get'])->name('about.main.get');
            Route::post('/', [AboutMainController::class, 'post', 'as' => 'about.main.post'])->name('about.main.post');
        });
        Route::prefix('/banner')->group(function () {
            Route::get('/', [BannerController::class, 'get', 'as' => 'about.banner.get'])->name('about.banner.get');
            Route::post('/', [BannerController::class, 'post', 'as' => 'about.banner.post'])->name('about.banner.post');
        });
        Route::prefix('/additional-content')->group(function () {
            Route::get('/', [AdditionalContentPaginateController::class, 'get', 'as' => 'about.additional_content.paginate.get'])->name('about.additional_content.paginate.get');
            Route::get('/create', [AdditionalContentCreateController::class, 'get', 'as' => 'about.additional_content.create.get'])->name('about.additional_content.create.get');
            Route::post('/create', [AdditionalContentCreateController::class, 'post', 'as' => 'about.additional_content.create.post'])->name('about.additional_content.create.post');
            Route::get('/update/{id}', [AdditionalContentUpdateController::class, 'get', 'as' => 'about.additional_content.update.get'])->name('about.additional_content.update.get');
            Route::post('/update/{id}', [AdditionalContentUpdateController::class, 'post', 'as' => 'about.additional_content.update.post'])->name('about.additional_content.update.post');
            Route::get('/delete/{id}', [AdditionalContentDeleteController::class, 'get', 'as' => 'about.additional_content.delete.get'])->name('about.additional_content.delete.get');

        });
    });

    Route::prefix('/csr')->group(function () {
        Route::prefix('/banner')->group(function () {
            Route::get('/', [CsrBannerController::class, 'get', 'as' => 'csr.banner.get'])->name('csr.banner.get');
            Route::post('/', [CsrBannerController::class, 'post', 'as' => 'csr.banner.post'])->name('csr.banner.post');
        });
        Route::prefix('/content-section')->group(function () {
            Route::get('/', [CsrPaginateController::class, 'get', 'as' => 'csr.paginate.get'])->name('csr.paginate.get');
            Route::get('/create', [CsrCreateController::class, 'get', 'as' => 'csr.create.get'])->name('csr.create.get');
            Route::post('/create', [CsrCreateController::class, 'post', 'as' => 'csr.create.post'])->name('csr.create.post');
            Route::get('/update/{id}', [CsrUpdateController::class, 'get', 'as' => 'csr.update.get'])->name('csr.update.get');
            Route::post('/update/{id}', [CsrUpdateController::class, 'post', 'as' => 'csr.update.post'])->name('csr.update.post');
            Route::get('/delete/{id}', [CsrDeleteController::class, 'get', 'as' => 'csr.delete.get'])->name('csr.delete.get');
        });

    });

    Route::prefix('/blog')->group(function () {
        Route::get('/', [BlogPaginateController::class, 'get', 'as' => 'blog.paginate.get'])->name('blog.paginate.get');
        Route::get('/create', [BlogCreateController::class, 'get', 'as' => 'blog.create.get'])->name('blog.create.get');
        Route::post('/create', [BlogCreateController::class, 'post', 'as' => 'blog.create.post'])->name('blog.create.post');
        Route::get('/update/{id}', [BlogUpdateController::class, 'get', 'as' => 'blog.update.get'])->name('blog.update.get');
        Route::post('/update/{id}', [BlogUpdateController::class, 'post', 'as' => 'blog.update.post'])->name('blog.update.post');
        Route::get('/delete/{id}', [BlogDeleteController::class, 'get', 'as' => 'blog.delete.get'])->name('blog.delete.get');

    });

    Route::prefix('/project')->group(function () {
        Route::get('/', [ProjectPaginateController::class, 'get', 'as' => 'project.paginate.get'])->name('project.paginate.get');
        Route::get('/create', [ProjectCreateController::class, 'get', 'as' => 'project.create.get'])->name('project.create.get');
        Route::post('/create', [ProjectCreateController::class, 'post', 'as' => 'project.create.post'])->name('project.create.post');
        Route::get('/update/{id}', [ProjectUpdateController::class, 'get', 'as' => 'project.update.get'])->name('project.update.get');
        Route::post('/update/{id}', [ProjectUpdateController::class, 'post', 'as' => 'project.update.post'])->name('project.update.post');
        Route::get('/delete/{id}', [ProjectDeleteController::class, 'get', 'as' => 'project.delete.get'])->name('project.delete.get');
        Route::post('/heading', [ProjectHeadingController::class, 'post', 'as' => 'project.heading.post'])->name('project.heading.post');

        Route::prefix('/common-amenity')->group(function () {
            Route::get('/', [CommonAmenityPaginateController::class, 'get', 'as' => 'project.common_amenity.paginate.get'])->name('project.common_amenity.paginate.get');
            Route::get('/create', [CommonAmenityCreateController::class, 'get', 'as' => 'project.common_amenity.create.get'])->name('project.common_amenity.create.get');
            Route::post('/create', [CommonAmenityCreateController::class, 'post', 'as' => 'project.common_amenity.create.post'])->name('project.common_amenity.create.post');
            Route::get('/update/{id}', [CommonAmenityUpdateController::class, 'get', 'as' => 'project.common_amenity.update.get'])->name('project.common_amenity.update.get');
            Route::post('/update/{id}', [CommonAmenityUpdateController::class, 'post', 'as' => 'project.common_amenity.update.post'])->name('project.common_amenity.update.post');
            Route::get('/delete/{id}', [CommonAmenityDeleteController::class, 'get', 'as' => 'project.common_amenity.delete.get'])->name('project.common_amenity.delete.get');
        });

        Route::prefix('/{project_id}/accomodation')->group(function () {
            Route::get('/', [AccomodationPaginateController::class, 'get', 'as' => 'project.accomodation.paginate.get'])->name('project.accomodation.paginate.get');
            Route::get('/create', [AccomodationCreateController::class, 'get', 'as' => 'project.accomodation.create.get'])->name('project.accomodation.create.get');
            Route::post('/create', [AccomodationCreateController::class, 'post', 'as' => 'project.accomodation.create.post'])->name('project.accomodation.create.post');
            Route::get('/update/{id}', [AccomodationUpdateController::class, 'get', 'as' => 'project.accomodation.update.get'])->name('project.accomodation.update.get');
            Route::post('/update/{id}', [AccomodationUpdateController::class, 'post', 'as' => 'project.accomodation.update.post'])->name('project.accomodation.update.post');
            Route::get('/delete/{id}', [AccomodationDeleteController::class, 'get', 'as' => 'project.accomodation.delete.get'])->name('project.accomodation.delete.get');
        });

        Route::prefix('/{project_id}/banner')->group(function () {
            Route::get('/', [ProjectBannerPaginateController::class, 'get', 'as' => 'project.banner.paginate.get'])->name('project.banner.paginate.get');
            Route::get('/create', [ProjectBannerCreateController::class, 'get', 'as' => 'project.banner.create.get'])->name('project.banner.create.get');
            Route::post('/create', [ProjectBannerCreateController::class, 'post', 'as' => 'project.banner.create.post'])->name('project.banner.create.post');
            Route::get('/update/{id}', [ProjectBannerUpdateController::class, 'get', 'as' => 'project.banner.update.get'])->name('project.banner.update.get');
            Route::post('/update/{id}', [ProjectBannerUpdateController::class, 'post', 'as' => 'project.banner.update.post'])->name('project.banner.update.post');
            Route::get('/delete/{id}', [ProjectBannerDeleteController::class, 'get', 'as' => 'project.banner.delete.get'])->name('project.banner.delete.get');
        });

        Route::prefix('/{project_id}/plan')->group(function () {
            Route::get('/', [PlanPaginateController::class, 'get', 'as' => 'project.plan.paginate.get'])->name('project.plan.paginate.get');
            Route::get('/create', [PlanCreateController::class, 'get', 'as' => 'project.plan.create.get'])->name('project.plan.create.get');
            Route::post('/create', [PlanCreateController::class, 'post', 'as' => 'project.plan.create.post'])->name('project.plan.create.post');
            Route::get('/update/{id}', [PlanUpdateController::class, 'get', 'as' => 'project.plan.update.get'])->name('project.plan.update.get');
            Route::post('/update/{id}', [PlanUpdateController::class, 'post', 'as' => 'project.plan.update.post'])->name('project.plan.update.post');
            Route::get('/delete/{id}', [PlanDeleteController::class, 'get', 'as' => 'project.plan.delete.get'])->name('project.plan.delete.get');
        });

        Route::prefix('/{project_id}/gallery-image')->group(function () {
            Route::get('/', [GalleryImagePaginateController::class, 'get', 'as' => 'project.gallery_image.paginate.get'])->name('project.gallery_image.paginate.get');
            Route::get('/create', [GalleryImageCreateController::class, 'get', 'as' => 'project.gallery_image.create.get'])->name('project.gallery_image.create.get');
            Route::post('/create', [GalleryImageCreateController::class, 'post', 'as' => 'project.gallery_image.create.post'])->name('project.gallery_image.create.post');
            Route::get('/update/{id}', [GalleryImageUpdateController::class, 'get', 'as' => 'project.gallery_image.update.get'])->name('project.gallery_image.update.get');
            Route::post('/update/{id}', [GalleryImageUpdateController::class, 'post', 'as' => 'project.gallery_image.update.post'])->name('project.gallery_image.update.post');
            Route::get('/delete/{id}', [GalleryImageDeleteController::class, 'get', 'as' => 'project.gallery_image.delete.get'])->name('project.gallery_image.delete.get');
        });

        Route::prefix('/{project_id}/gallery-video')->group(function () {
            Route::get('/', [GalleryVideoPaginateController::class, 'get', 'as' => 'project.gallery_video.paginate.get'])->name('project.gallery_video.paginate.get');
            Route::get('/create', [GalleryVideoCreateController::class, 'get', 'as' => 'project.gallery_video.create.get'])->name('project.gallery_video.create.get');
            Route::post('/create', [GalleryVideoCreateController::class, 'post', 'as' => 'project.gallery_video.create.post'])->name('project.gallery_video.create.post');
            Route::get('/update/{id}', [GalleryVideoUpdateController::class, 'get', 'as' => 'project.gallery_video.update.get'])->name('project.gallery_video.update.get');
            Route::post('/update/{id}', [GalleryVideoUpdateController::class, 'post', 'as' => 'project.gallery_video.update.post'])->name('project.gallery_video.update.post');
            Route::get('/delete/{id}', [GalleryVideoDeleteController::class, 'get', 'as' => 'project.gallery_video.delete.get'])->name('project.gallery_video.delete.get');
        });

        Route::prefix('/{project_id}/additional-content')->group(function () {
            Route::get('/', [ProjectAdditionalContentPaginateController::class, 'get', 'as' => 'project.additional_content.paginate.get'])->name('project.additional_content.paginate.get');
            Route::get('/create', [ProjectAdditionalContentCreateController::class, 'get', 'as' => 'project.additional_content.create.get'])->name('project.additional_content.create.get');
            Route::post('/create', [ProjectAdditionalContentCreateController::class, 'post', 'as' => 'project.additional_content.create.post'])->name('project.additional_content.create.post');
            Route::get('/update/{id}', [ProjectAdditionalContentUpdateController::class, 'get', 'as' => 'project.additional_content.update.get'])->name('project.additional_content.update.get');
            Route::post('/update/{id}', [ProjectAdditionalContentUpdateController::class, 'post', 'as' => 'project.additional_content.update.post'])->name('project.additional_content.update.post');
            Route::get('/delete/{id}', [ProjectAdditionalContentDeleteController::class, 'get', 'as' => 'project.additional_content.delete.get'])->name('project.additional_content.delete.get');
        });

    });

    Route::prefix('/legal-pages')->group(function () {
        Route::get('/', [LegalPaginateController::class, 'get', 'as' => 'legal.paginate.get'])->name('legal.paginate.get');
        Route::get('/update/{slug}', [LegalUpdateController::class, 'get', 'as' => 'legal.update.get'])->name('legal.update.get');
        Route::post('/update/{slug}', [LegalUpdateController::class, 'post', 'as' => 'legal.update.post'])->name('legal.update.post');
    });

    Route::prefix('/seo')->group(function () {
        Route::get('/', [SeoPaginateController::class, 'get', 'as' => 'seo.paginate.get'])->name('seo.paginate.get');
        Route::get('/update/{slug}', [SeoUpdateController::class, 'get', 'as' => 'seo.update.get'])->name('seo.update.get');
        Route::post('/update/{slug}', [SeoUpdateController::class, 'post', 'as' => 'seo.update.post'])->name('seo.update.post');
    });

    Route::prefix('/team-member')->group(function () {

        Route::prefix('/management')->group(function () {
            Route::get('/', [ManagementPaginateController::class, 'get', 'as' => 'team_member.management.paginate.get'])->name('team_member.management.paginate.get');
            Route::get('/create', [ManagementCreateController::class, 'get', 'as' => 'team_member.management.create.get'])->name('team_member.management.create.get');
            Route::post('/create', [ManagementCreateController::class, 'post', 'as' => 'team_member.management.create.post'])->name('team_member.management.create.post');
            Route::get('/update/{id}', [ManagementUpdateController::class, 'get', 'as' => 'team_member.management.update.get'])->name('team_member.management.update.get');
            Route::post('/update/{id}', [ManagementUpdateController::class, 'post', 'as' => 'team_member.management.update.post'])->name('team_member.management.update.post');
            Route::get('/delete/{id}', [ManagementDeleteController::class, 'get', 'as' => 'team_member.management.delete.get'])->name('team_member.management.delete.get');
            Route::post('/heading', [ManagementHeadingController::class, 'post', 'as' => 'team_member.management.heading.post'])->name('team_member.management.heading.post');

        });

        Route::prefix('/staff')->group(function () {
            Route::get('/', [StaffPaginateController::class, 'get', 'as' => 'team_member.staff.paginate.get'])->name('team_member.staff.paginate.get');
            Route::get('/create', [StaffCreateController::class, 'get', 'as' => 'team_member.staff.create.get'])->name('team_member.staff.create.get');
            Route::post('/create', [StaffCreateController::class, 'post', 'as' => 'team_member.staff.create.post'])->name('team_member.staff.create.post');
            Route::get('/update/{id}', [StaffUpdateController::class, 'get', 'as' => 'team_member.staff.update.get'])->name('team_member.staff.update.get');
            Route::post('/update/{id}', [StaffUpdateController::class, 'post', 'as' => 'team_member.staff.update.post'])->name('team_member.staff.update.post');
            Route::get('/delete/{id}', [StaffDeleteController::class, 'get', 'as' => 'team_member.staff.delete.get'])->name('team_member.staff.delete.get');
            Route::post('/heading', [StaffHeadingController::class, 'post', 'as' => 'team_member.staff.heading.post'])->name('team_member.staff.heading.post');

        });

    });

    Route::prefix('/award')->group(function () {
        Route::get('/', [AwardPaginateController::class, 'get', 'as' => 'award.paginate.get'])->name('award.paginate.get');
        Route::get('/create', [AwardCreateController::class, 'get', 'as' => 'award.create.get'])->name('award.create.get');
        Route::post('/create', [AwardCreateController::class, 'post', 'as' => 'award.create.post'])->name('award.create.post');
        Route::get('/update/{id}', [AwardUpdateController::class, 'get', 'as' => 'award.update.get'])->name('award.update.get');
        Route::post('/update/{id}', [AwardUpdateController::class, 'post', 'as' => 'award.update.post'])->name('award.update.post');
        Route::get('/delete/{id}', [AwardDeleteController::class, 'get', 'as' => 'award.delete.get'])->name('award.delete.get');
        Route::post('/heading', [AwardHeadingController::class, 'post', 'as' => 'award.heading.post'])->name('award.heading.post');

    });

    Route::prefix('/partner')->group(function () {
        Route::get('/', [PartnerPaginateController::class, 'get', 'as' => 'partner.paginate.get'])->name('partner.paginate.get');
        Route::get('/create', [PartnerCreateController::class, 'get', 'as' => 'partner.create.get'])->name('partner.create.get');
        Route::post('/create', [PartnerCreateController::class, 'post', 'as' => 'partner.create.post'])->name('partner.create.post');
        Route::get('/update/{id}', [PartnerUpdateController::class, 'get', 'as' => 'partner.update.get'])->name('partner.update.get');
        Route::post('/update/{id}', [PartnerUpdateController::class, 'post', 'as' => 'partner.update.post'])->name('partner.update.post');
        Route::get('/delete/{id}', [PartnerDeleteController::class, 'get', 'as' => 'partner.delete.get'])->name('partner.delete.get');
        Route::post('/heading', [PartnerHeadingController::class, 'post', 'as' => 'partner.heading.post'])->name('partner.heading.post');

    });

    Route::prefix('/counter')->group(function () {
        Route::get('/', [CounterPaginateController::class, 'get', 'as' => 'counter.paginate.get'])->name('counter.paginate.get');
        Route::get('/create', [CounterCreateController::class, 'get', 'as' => 'counter.create.get'])->name('counter.create.get');
        Route::post('/create', [CounterCreateController::class, 'post', 'as' => 'counter.create.post'])->name('counter.create.post');
        Route::get('/update/{id}', [CounterUpdateController::class, 'get', 'as' => 'counter.update.get'])->name('counter.update.get');
        Route::post('/update/{id}', [CounterUpdateController::class, 'post', 'as' => 'counter.update.post'])->name('counter.update.post');
        Route::get('/delete/{id}', [CounterDeleteController::class, 'get', 'as' => 'counter.delete.get'])->name('counter.delete.get');
        Route::post('/heading', [CounterHeadingController::class, 'post', 'as' => 'counter.heading.post'])->name('counter.heading.post');

    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'get', 'as' => 'profile.get'])->name('profile.get');
        Route::post('/update', [ProfileController::class, 'post', 'as' => 'profile.post'])->name('profile.post');
        Route::post('/profile-password-update', [PasswordUpdateController::class, 'post', 'as' => 'password.post'])->name('password.post');
    });

    Route::prefix('/role')->group(function () {
        Route::get('/', [RolePaginateController::class, 'get', 'as' => 'role.paginate.get'])->name('role.paginate.get');
        Route::get('/create', [RoleCreateController::class, 'get', 'as' => 'role.create.get'])->name('role.create.get');
        Route::post('/create', [RoleCreateController::class, 'post', 'as' => 'role.create.get'])->name('role.create.post');
        Route::get('/update/{id}', [RoleUpdateController::class, 'get', 'as' => 'role.update.get'])->name('role.update.get');
        Route::post('/update/{id}', [RoleUpdateController::class, 'post', 'as' => 'role.update.get'])->name('role.update.post');
        Route::get('/delete/{id}', [RoleDeleteController::class, 'get', 'as' => 'role.delete.get'])->name('role.delete.get');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserPaginateController::class, 'get', 'as' => 'user.paginate.get'])->name('user.paginate.get');
        Route::get('/create', [UserCreateController::class, 'get', 'as' => 'user.create.get'])->name('user.create.get');
        Route::post('/create', [UserCreateController::class, 'post', 'as' => 'user.create.get'])->name('user.create.post');
        Route::get('/update/{id}', [UserUpdateController::class, 'get', 'as' => 'user.update.get'])->name('user.update.get');
        Route::post('/update/{id}', [UserUpdateController::class, 'post', 'as' => 'user.update.get'])->name('user.update.post');
        Route::get('/delete/{id}', [UserDeleteController::class, 'get', 'as' => 'user.delete.get'])->name('user.delete.get');
    });

    Route::get('/logout', [LogoutController::class, 'get', 'as' => 'logout.get'])->name('logout.get');

});
