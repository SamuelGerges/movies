<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {

    Route::name('admin.')->prefix('admin')->group(function () {


        // TODO :: home routes
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // TODO:: role routes
        Route::get('/roles/data', [RoleController::class, 'data'])->name('roles.data');
        Route::delete('/roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulk_delete');
        Route::resource('roles', 'RoleController')->except('show');

        // TODO:: admin routes
        Route::get('/admins/data', [AdminController::class, 'data'])->name('admins.data');
        Route::delete('/admins/bulk-delete', [AdminController::class, 'bulkDelete'])->name('admins.bulk_delete');
        Route::resource('admins', 'AdminController')->except('show');


        // TODO:: users routes
        Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
        Route::delete('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk_delete');
        Route::resource('users', 'UserController')->except('show');

        // TODO:: genres routes
        Route::get('/genres/data', [GenreController::class, 'data'])->name('genres.data');
        Route::delete('/genres/bulk-delete', [GenreController::class, 'bulkDelete'])->name('genres.bulk_delete');
        Route::resource('genres', 'GenreController')->only('index','destroy');


        //movie routes
        Route::get('/movies/data', 'MovieController@data')->name('movies.data');
        Route::delete('/movies/bulk_delete', 'MovieController@bulkDelete')->name('movies.bulk_delete');
        Route::resource('movies', 'MovieController')->only(['index', 'show', 'destroy']);

        //actor routes
        Route::get('/actors/data', 'ActorController@data')->name('actors.data');
        Route::delete('/actors/bulk_delete', 'ActorController@bulkDelete')->name('actors.bulk_delete');
        Route::resource('actors', 'ActorController')->only(['index', 'destroy']);

        // TODO:: settings routes
        Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
        Route::resource('settings', 'SettingController')->only('store');

        //profile routes
        Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

        Route::name('profile.')->namespace('Profile')->group(function () {

            //password routes
            Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
            Route::put('/password/update', 'PasswordController@update')->name('password.update');

        });
    });
});

//Route::name('admin.')->group(function () {
//    Route::get('/test', [HomeController::class, 'index'])->name('test');
//
//});

