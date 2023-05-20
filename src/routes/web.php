<?php

use App\Modules\Main\AboutPage\AboutPageController;
use App\Modules\Main\AwardPage\AwardPageController;
use App\Modules\Main\BlogPage\BlogDetailPageController;
use App\Modules\Main\BlogPage\BlogPageController;
use App\Modules\Main\ContactPage\ContactPageController;
use App\Modules\Main\CsrPage\CsrPageController;
use App\Modules\Main\HomePage\HomePageController;
use App\Modules\Main\LegalPage\LegalPageController;
use App\Modules\Main\ProjectPage\CompletedProjectPageController;
use App\Modules\Main\ProjectPage\OngoingProjectPageController;
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
Route::get('/refer-now', [ReferalPageController::class, 'get', 'as' => 'referal_page.get'])->name('referal_page.get');
Route::post('/contact-us-post', [ContactPageController::class, 'post', 'as' => 'contact_page.post'])->name('contact_page.post');
Route::post('/refer-now-post', [ReferalPageController::class, 'post', 'as' => 'referal_page.post'])->name('referal_page.post');
Route::get('/completed-projects', [CompletedProjectPageController::class, 'get', 'as' => 'completed_projects.get'])->name('completed_projects.get');
Route::get('/completed-projects/{slug}', [ProjectDetailPageController::class, 'get', 'as' => 'completed_projects_detail.get'])->name('completed_projects_detail.get');
Route::get('/ongoing-projects', [OngoingProjectPageController::class, 'get', 'as' => 'ongoing_projects.get'])->name('ongoing_projects.get');
Route::get('/blogs', [BlogPageController::class, 'get', 'as' => 'blogs.get'])->name('blogs.get');
Route::get('/blogs/{slug}', [BlogDetailPageController::class, 'get', 'as' => 'blogs_detail.get'])->name('blogs_detail.get');
Route::get('/{legal_slug}', [LegalPageController::class, 'get', 'as' => 'legal.get'])->name('legal.get');
