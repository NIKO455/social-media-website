<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::get('/profile/update', 'update')->name('profile.update');
        Route::get('/profile/delete', 'destroy')->name('profile.destroy');
    });

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

});

require __DIR__ . '/auth.php';
