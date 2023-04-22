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
use App\Modules\Enquiries\Controllers\EnquiryDeleteController;
use App\Modules\Enquiries\Controllers\EnquiryPaginateController;
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
use App\Modules\Legal\Controllers\LegalCreateController;
use App\Modules\Legal\Controllers\LegalDeleteController;
use App\Modules\Legal\Controllers\LegalPaginateController;
use App\Modules\Legal\Controllers\LegalUpdateController;
use App\Modules\Partner\Controllers\PartnerCreateController;
use App\Modules\Partner\Controllers\PartnerDeleteController;
use App\Modules\Partner\Controllers\PartnerHeadingController;
use App\Modules\Partner\Controllers\PartnerPaginateController;
use App\Modules\Partner\Controllers\PartnerUpdateController;
use App\Modules\Role\Controllers\RoleCreateController;
use App\Modules\Role\Controllers\RoleDeleteController;
use App\Modules\Role\Controllers\RolePaginateController;
use App\Modules\Role\Controllers\RoleUpdateController;
use App\Modules\Seo\Controllers\SeoPaginateController;
use App\Modules\Seo\Controllers\SeoUpdateController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogDetailController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogPaginateController;
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

    Route::prefix('/legal-pages')->group(function () {
        Route::get('/', [LegalPaginateController::class, 'get', 'as' => 'legal.paginate.get'])->name('legal.paginate.get');
        Route::get('/create', [LegalCreateController::class, 'get', 'as' => 'legal.create.get'])->name('legal.create.get');
        Route::post('/create', [LegalCreateController::class, 'post', 'as' => 'legal.create.post'])->name('legal.create.post');
        Route::get('/update/{id}', [LegalUpdateController::class, 'get', 'as' => 'legal.update.get'])->name('legal.update.get');
        Route::post('/update/{id}', [LegalUpdateController::class, 'post', 'as' => 'legal.update.post'])->name('legal.update.post');
        Route::get('/delete/{id}', [LegalDeleteController::class, 'get', 'as' => 'legal.delete.get'])->name('legal.delete.get');
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

    // Route::prefix('/enquiry')->group(function () {
    //     Route::get('/', [EnquiryPaginateController::class, 'get', 'as' => 'enquiry_list.get'])->name('enquiry_list.get');
    //     Route::get('/delete/{id}', [EnquiryDeleteController::class, 'get', 'as' => 'enquiry_delete.get'])->name('enquiry_delete.get');

    // });

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
