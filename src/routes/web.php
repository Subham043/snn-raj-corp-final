<?php

use App\Modules\Main\AboutPage\AboutPageController;
use App\Modules\Main\AwardPage\AwardPageController;
use App\Modules\Main\ContactPage\ContactPageController;
use App\Modules\Main\CsrPage\CsrPageController;
use App\Modules\Main\HomePage\HomePageController;
use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::get('/test-sitemap', function () {
    // SitemapGenerator::create('https://example.com')
    // ->getSitemap()
    Sitemap::create()
    ->add(Url::create('/')
        ->setLastModificationDate(Carbon::yesterday())
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.1))
    ->writeToFile(base_path().'/public/sitemap.xml');
    return view('welcome');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
