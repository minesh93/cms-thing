<?php

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


//- MENTAL NOTE ABOUT MAKING A CHANGE TO CONFIG
//- SO THAT THE PROVIDER I WANT WILL BE THERE
//- OH AND MIDDLEWARE


Route::group(['prefix'=>'admin','middleware' => 'web'], function () {

    Route::get('/login', '\Claws\Http\Controllers\Auth\AdminLoginController@getLoginForm');
    Route::post('/login', '\Claws\Http\Controllers\Auth\AdminLoginController@login');

    Route::group(['middleware' => ['claws_admin_check']],function (){

        Route::get('/dashboard', function() {
            return view('claws::admin.dashboard');
        });

        Route::get('/content/{type}','\Claws\Http\Controllers\Backend\PostController@getPosts');

        Route::get('/content/{type}/{id}','\Claws\Http\Controllers\Backend\PostController@create');
        Route::get('/content/{type}/add','\Claws\Http\Controllers\Backend\PostController@create');

        Route::post('/slug','\Claws\Http\Controllers\Backend\PostController@slugGen');

        Route::post('/content/{type}/{id}','\Claws\Http\Controllers\Backend\PostController@update');
        Route::post('/content/{type}/add','\Claws\Http\Controllers\Backend\PostController@update');

        Route::get('/users', '\Claws\Http\Controllers\Backend\AdminController@getAdmins');
        Route::get('/users/{id}','\Claws\Http\Controllers\Backend\AdminController@createAdmin');
        Route::get('/users/add', '\Claws\Http\Controllers\Backend\AdminController@createAdmin');

        Route::post('/users/{id}','\Claws\Http\Controllers\Backend\AdminController@updateAdmin');
        Route::post('/users/add', '\Claws\Http\Controllers\Backend\AdminController@updateAdmin');

        Route::get('/roles', '\Claws\Http\Controllers\Backend\AdminController@getRoles');
        Route::get('/roles/{id}','\Claws\Http\Controllers\Backend\AdminController@createRole');
        Route::get('/roles/add', '\Claws\Http\Controllers\Backend\AdminController@createRole');

        Route::post('/roles/{id}','\Claws\Http\Controllers\Backend\AdminController@updateRole');
        Route::post('/roles/add', '\Claws\Http\Controllers\Backend\AdminController@updateRole');

        Route::get('/media', '\Claws\Http\Controllers\Backend\MediaController@getMedia');
        Route::post('/media', '\Claws\Http\Controllers\Backend\MediaController@uploadMedia');
        Route::post('/update-media/{id}', '\Claws\Http\Controllers\Backend\MediaController@updateMedia');


        Route::get('/settings/{section}','\Claws\Http\Controllers\Backend\SettingsController@getSettings');
        Route::post('/settings/{section}','\Claws\Http\Controllers\Backend\SettingsController@updateSettings');


    });
});

Route::get('/{slug?}', '\Claws\Http\Controllers\Frontend\SiteController@getPost')->where('slug', '.*');