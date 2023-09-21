<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentureController;
use App\Http\Controllers\VenturePlotController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('ventures', VentureController::class);
    Route::delete('/venture-delete/{id}',[VentureController::class, 'selfDelete'])->name('delete.ventures');
    Route::get('ventures-search/{search}',[VentureController::class,'searchVentures'])->name('ventures.search');
    Route::post('ventures-update', [VentureController::class, 'update'])->name('ventures-update');
    Route::resource('venture-plots', VenturePlotController::class);
    Route::post('venture-plots-update', [VenturePlotController::class, 'update'])->name('venture-plots-update');
    Route::post('venture-plot-image-upload', [VenturePlotController::class, 'venturePlotImageUpload'])->name('venture-plot-image-upload');
    Route::resource('users', UserController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('social-links', SocialLinkController::class);
    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('migrate/{key}', function ($key) {
    if ($key == 'Rejohn@1234') {
        try {
            \Artisan::call('migrate');
            echo 'Migrated Successfully!';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'Not matched!';
    }
});

Route::get('seeder/{key}/{className}', function ($key, $className) {
    if ($key == 'Rejohn@1234') {
        try {
            \Artisan::call('db:seed --class=' . $className);
            echo 'Seeder Run Successfully!';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    } else {
        echo 'Not matched!';
    }
});

require __DIR__ . '/auth.php';
