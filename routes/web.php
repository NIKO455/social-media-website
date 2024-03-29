<?php

use App\Http\Controllers\GroupController;
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

Route::controller(GroupController::class)->group(function () {
    Route::get('/g/{group}', 'index')->name('index.group');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

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
        //post
        Route::post('/store/post', 'store')->name('store.post');
        Route::delete('/delete/assets/{id}', 'deleteAssets')->name('delete.assets');
        Route::post('/update/post/{slug}', 'update')->name('update.post');
        Route::delete('/delete/post/{slug}', 'delete')->name('delete.post');

        //like
        Route::post('/like/post/{slug}', 'likePost')->name('like.post');

        //comment
        Route::post('/comment/post/{slug}', 'commentPost')->name('comment.post');
        Route::delete('/delete/comment/{id}', 'deleteComment')->name('comment.post');
        Route::put('/update/comment', 'updateComment')->name('update.comment');
    });

    Route::controller(GroupController::class)->group(function () {
        Route::post('/create/group', 'store')->name('group.store');
        Route::get('/group/edit/{id}', 'edit')->name('group.edit');
        Route::patch('/group/info/update/{id}', 'update')->name('group.info.update');
        Route::post('/group/cover/update/{id}', 'groupCover')->name('group.cover');
        Route::post('/group/profile/update/{id}', 'groupProfile')->name('group.profile');
        Route::delete('/group/profile/remove/{id}', 'removeGroupProfile')->name('group.profile.remove');

        Route::post('/group/join/{id}', 'joinGroup')->name('group.join');
        Route::post('/group/accept/{id}', 'acceptGroup')->name('group.accept');
        Route::post('/group/reject/{id}', 'rejectGroup')->name('group.reject');
    });


});


require __DIR__ . '/auth.php';
