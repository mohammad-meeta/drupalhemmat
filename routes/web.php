<?php

use App\ArticleType;
use App\Http\Controllers\ArticleTypeController;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('article-type', 'ArticleTypeController');
Route::resource('article', 'ArticleController');

Route::resource('city', 'CityController');

Route::resource('user', 'UserController');
Route::resource('role', 'RoleController');

Route::resource('organ', 'OrganController');

/*Route::get('ckeditor', 'CkeditorController@index');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');*/
