<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\HeroController;
use App\Http\Controllers\backend\ServicesController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/homepage', [FrontendController::class, 'homepage'])->name('homepage');


Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
    return view('admin.pages.index');
    })->middleware(['verified'])->name('dashboard');

    Route::get('admin-logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin-edit-profile', [AdminController::class, 'AdminEditProfile'])->name('admin.edit.profile');
    Route::post('admin-update-profile', [AdminController::class, 'AdminUpdateProfile'])->name('admin.update.profile');
    Route::get('admin-change-profile', [AdminController::class, 'AdminChangeProfile'])->name('admin.change.password');
    Route::post('admin-update-password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    // Hero Section All Routes

    Route::controller(HeroController::class)->group(function(){
        Route::get('hero-section', 'HeroSection')->name('hero.section');
        Route::post('update-hero-section', 'UpdateHeroSection')->name('update.hero.section');

    });

     // Services Section All Routes

    Route::controller(ServicesController::class)->group(function(){
        Route::get('all-services', 'AllServices')->name('all.services');
        

    });
 
});
























Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
