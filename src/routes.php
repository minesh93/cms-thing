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

PostRegister::register([
    'name' => 'page',
    'urlBase' => '/',
]);

PostRegister::register([
    'name' => 'post',
    'urlBase' => '/',
]);

Route::group(['prefix'=>'admin','middleware' => 'web'], function () {

    Route::get('/login', '\Claws\Http\Controllers\Auth\AdminLoginController@getLoginForm');
    Route::post('/login', '\Claws\Http\Controllers\Auth\AdminLoginController@login');

    Route::group(['middleware' => ['claws_admin_check']],function (){

        Route::get('/dashboard', function(){
            return view('claws::admin.dashboard');
        });

        Route::get('/content/{type}', function(){
            return view('claws::admin.post-list');
        });
        Route::get('/content/{type}/{id}', function(){
            return view('claws::admin.post-list');
        });
        Route::get('/contents/{type}/add', function(){
            return view('claws::admin.post-list');
        });
    });
});
