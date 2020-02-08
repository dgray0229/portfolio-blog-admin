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

Auth::routes();
Route::get('/posts/{post}', 'PostController@single');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@all');
Route::get('/admin/{any}', 'AdminController@index')->where('any', '.*');
Route::get('/{post}/comments', 'CommentController@index');
Route::post('/{post}/comments', 'CommentController@store');

/**
 * We wrote /admin/{any} here because we intend to serve every page of the admin dashboard using the Vue router. 
 * When we stert building the admin dashboard in the next article, we will let Vue handle all the routes of the /admin pages.
 */