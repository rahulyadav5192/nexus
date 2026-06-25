<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/robots.txt', 'RobotsController')->name('robots');

Route::group([
    'domain' => 'blog.' . config('multisite.host'),
    'as' => 'blog.',
    'middleware' => 'site:blog'
], function () {
    Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
});


Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\Frontend\HomeController::class, 'aboutUs'])->name('about');
Route::get('/companies', [App\Http\Controllers\Frontend\HomeController::class, 'companies'])->name('companies');
Route::get('/operations', [App\Http\Controllers\Frontend\HomeController::class, 'operations'])->name('operations');
Route::get('/expansion', [App\Http\Controllers\Frontend\HomeController::class, 'expansion'])->name('expansion');
Route::get('/investors', [App\Http\Controllers\Frontend\HomeController::class, 'investors'])->name('investors');
Route::get('/leadership', [App\Http\Controllers\Frontend\HomeController::class, 'leadership'])->name('leadership');
Route::get('/disclosures', [App\Http\Controllers\Frontend\HomeController::class, 'disclosures'])->name('disclosures');
Route::get('/associates', [App\Http\Controllers\Frontend\HomeController::class, 'associates'])->name('associates');
Route::get('/careers', [App\Http\Controllers\Frontend\HomeController::class, 'careers'])->name('careers');
Route::get('/services', [App\Http\Controllers\Frontend\HomeController::class, 'operations'])->name('services');
Route::get('/service-detail/{service}', [App\Http\Controllers\Frontend\HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms-and-conditions', [App\Http\Controllers\Frontend\HomeController::class, 'termsAndConditions'])->name('termsAndConditions');

Route::get('/contact-us', [App\Http\Controllers\Frontend\HomeController::class, 'contactus'])->name('contactus');
Route::post('/contact-us/submit', [App\Http\Controllers\Frontend\HomeController::class, 'submitContactUs'])->name('contactus.submit');
Route::post('/subscribers/submit', [App\Http\Controllers\Frontend\HomeController::class, 'submitSubscribers'])->name('subscribers.submit');
Route::post('/job-application/submit', [App\Http\Controllers\Frontend\JobApplicationController::class, 'store'])->name('job-application.submit');
Route::post('/api/track-shipment', [App\Http\Controllers\Frontend\HomeController::class, 'trackShipment'])->name('track.shipment');
Route::get('/blogs', [App\Http\Controllers\Frontend\BlogsController::class, 'index'])->name('blogs');
Route::get('/blog-details/{blog_id}', [App\Http\Controllers\Frontend\BlogsController::class, 'details'])->name('blogs.details');
Route::get('/blog-details/{slug}', [App\Http\Controllers\Frontend\BlogsController::class, 'details'])->name('blogs.details');
Route::get('blog/category/{category_id}', [App\Http\Controllers\Frontend\BlogsController::class, 'ShowCategoryWiseBlogs'])->name('blogs.category');
Route::get('blog/category/{slug}', [App\Http\Controllers\Frontend\BlogsController::class, 'ShowCategoryWiseBlogs'])->name('blogs.category');


Route::get('/page/{page_id}', [App\Http\Controllers\Frontend\HomeController::class, 'generalPage'])->name('generalPages');

Route::get('/product/{item_id}', [App\Http\Controllers\Frontend\ItemsController::class, 'index'])->name('itemDetails');
Route::get('/product/{slug}', [App\Http\Controllers\Frontend\ItemsController::class, 'index'])->name('itemDetails');

Route::get('/test-meta', [App\Http\Controllers\Frontend\HomeController::class, 'testMeta'])->name('test.meta');
Route::get('/delete-all-data', [App\Http\Controllers\Frontend\HomeController::class, 'deleteAllData'])->name('delete.all.data');
