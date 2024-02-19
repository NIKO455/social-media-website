<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
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


Route::controller(ProfileController::class)->group(function () {
    Route::get('/u/{user}', 'profile')->name('profile');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile/info/update', 'update')->name('profile.info.update');
        Route::get('/profile/delete', 'destroy')->name('profile.destroy');
        Route::post('/cover/update/{id}', 'coverPhoto')->name('cover.update');
        Route::post('/profile/update/{id}', 'profilePhoto')->name('profile.update');
        Route::delete('/profile/remove/{id}', 'removeProfile')->name('profile.remove');
        Route::delete('/cover/remove/{id}', 'removeCover')->name('cover.remove');
    });

    Route::controller(PostController::class)->group(function () {
        Route::post('/store/post', 'store')->name('store.post');
        Route::delete('/delete/post', 'delete')->name('delete.post');
    });

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

});


require __DIR__ . '/auth.php';
