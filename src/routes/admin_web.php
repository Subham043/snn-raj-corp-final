<?php
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

use App\Modules\Authentication\Controllers\PasswordUpdateController;
use App\Modules\Authentication\Controllers\ForgotPasswordController;
use App\Modules\Authentication\Controllers\LoginController;
use App\Modules\Authentication\Controllers\LogoutController;
use App\Modules\Authentication\Controllers\ProfileController;
use App\Modules\Authentication\Controllers\ResetPasswordController;
use App\Modules\Awards\Controllers\AwardCreateController;
use App\Modules\Awards\Controllers\AwardDeleteController;
use App\Modules\Awards\Controllers\AwardPaginateController;
use App\Modules\Awards\Controllers\AwardUpdateController;
use App\Modules\Dashboard\Controllers\DashboardController;
use App\Modules\Enquiries\Controllers\EnquiryDeleteController;
use App\Modules\Enquiries\Controllers\EnquiryPaginateController;
use App\Modules\HomePage\Banner\Controllers\BannerCreateController;
use App\Modules\HomePage\Banner\Controllers\BannerDeleteController;
use App\Modules\HomePage\Banner\Controllers\BannerPaginateController;
use App\Modules\HomePage\Banner\Controllers\BannerUpdateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialCreateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialDeleteController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialPaginateController;
use App\Modules\HomePage\Testimonial\Controllers\TestimonialUpdateController;
use App\Modules\Role\Controllers\RoleCreateController;
use App\Modules\Role\Controllers\RoleDeleteController;
use App\Modules\Role\Controllers\RolePaginateController;
use App\Modules\Role\Controllers\RoleUpdateController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogDetailController;
use App\Modules\Settings\Controllers\ActivityLog\ActivityLogPaginateController;
use App\Modules\Settings\Controllers\ApplicationBackupController;
use App\Modules\Settings\Controllers\ErrorLogController;
use App\Modules\TeamMember\Management\Controllers\ManagementCreateController;
use App\Modules\TeamMember\Management\Controllers\ManagementDeleteController;
use App\Modules\TeamMember\Management\Controllers\ManagementPaginateController;
use App\Modules\TeamMember\Management\Controllers\ManagementUpdateController;
use App\Modules\TeamMember\Staff\Controllers\StaffCreateController;
use App\Modules\TeamMember\Staff\Controllers\StaffDeleteController;
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
        Route::get('/back-up', [ApplicationBackupController::class, 'get', 'as' => 'back_up.get'])->name('back_up.get');
        Route::get('/error-log', [ErrorLogController::class, 'get', 'as' => 'error_log.get'])->name('error_log.get');
        Route::prefix('/activity-log')->group(function () {
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

        });
    });

    Route::prefix('/team-member')->group(function () {

        Route::prefix('/management')->group(function () {
            Route::get('/', [ManagementPaginateController::class, 'get', 'as' => 'team_member.management.paginate.get'])->name('team_member.management.paginate.get');
            Route::get('/create', [ManagementCreateController::class, 'get', 'as' => 'team_member.management.create.get'])->name('team_member.management.create.get');
            Route::post('/create', [ManagementCreateController::class, 'post', 'as' => 'team_member.management.create.post'])->name('team_member.management.create.post');
            Route::get('/update/{id}', [ManagementUpdateController::class, 'get', 'as' => 'team_member.management.update.get'])->name('team_member.management.update.get');
            Route::post('/update/{id}', [ManagementUpdateController::class, 'post', 'as' => 'team_member.management.update.post'])->name('team_member.management.update.post');
            Route::get('/delete/{id}', [ManagementDeleteController::class, 'get', 'as' => 'team_member.management.delete.get'])->name('team_member.management.delete.get');

        });

        Route::prefix('/staff')->group(function () {
            Route::get('/', [StaffPaginateController::class, 'get', 'as' => 'team_member.staff.paginate.get'])->name('team_member.staff.paginate.get');
            Route::get('/create', [StaffCreateController::class, 'get', 'as' => 'team_member.staff.create.get'])->name('team_member.staff.create.get');
            Route::post('/create', [StaffCreateController::class, 'post', 'as' => 'team_member.staff.create.post'])->name('team_member.staff.create.post');
            Route::get('/update/{id}', [StaffUpdateController::class, 'get', 'as' => 'team_member.staff.update.get'])->name('team_member.staff.update.get');
            Route::post('/update/{id}', [StaffUpdateController::class, 'post', 'as' => 'team_member.staff.update.post'])->name('team_member.staff.update.post');
            Route::get('/delete/{id}', [StaffDeleteController::class, 'get', 'as' => 'team_member.staff.delete.get'])->name('team_member.staff.delete.get');

        });

    });

    Route::prefix('/award')->group(function () {
        Route::get('/', [AwardPaginateController::class, 'get', 'as' => 'award.paginate.get'])->name('award.paginate.get');
        Route::get('/create', [AwardCreateController::class, 'get', 'as' => 'award.create.get'])->name('award.create.get');
        Route::post('/create', [AwardCreateController::class, 'post', 'as' => 'award.create.post'])->name('award.create.post');
        Route::get('/update/{id}', [AwardUpdateController::class, 'get', 'as' => 'award.update.get'])->name('award.update.get');
        Route::post('/update/{id}', [AwardUpdateController::class, 'post', 'as' => 'award.update.post'])->name('award.update.post');
        Route::get('/delete/{id}', [AwardDeleteController::class, 'get', 'as' => 'award.delete.get'])->name('award.delete.get');

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
