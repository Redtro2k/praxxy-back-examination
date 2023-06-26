<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{ProductController, UploadController, VideoController, CategoryController, Invokes\GetVideo};

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//invokes
Route::get('/get-video/{video}', GetVideo::class)->name('get-video');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('/product', ProductController::class);
    Route::get('category/{id?}', [CategoryController::class,  'index'])->name('category.index');
    Route::resource('category', CategoryController::class, ['only' => ['update']]);
    Route::resource('/upload', UploadController::class, ['only' => ['store', 'destroy']]);
    Route::get('/videos',[ VideoController::class, 'index'])->name('video.index');
});
