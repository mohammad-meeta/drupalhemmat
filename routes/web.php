<?php

use App\ArticleType;
use App\Http\Controllers\ArticleTypeController;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/article/documents-center', 'ArticleController@documentsCenter')
    ->name('article.documents-center');

Route::get('/monitoring/indicators', 'IndicatorController@monitoringIndicators')
    ->name('indicator.monitoring-indicators');

Route::resource('article-type', 'ArticleTypeController');

Route::resource('document-category', 'DocumentCategoryController');

Route::resource('monitoring', 'MonitoringController');
Route::resource('indicator', 'IndicatorController');
Route::resource('indicator-category', 'IndicatorCategoryController');

Route::resource('province', 'ProvinceController');

Route::resource('article', 'ArticleController');


Route::post('article/file-upload/{article}', 'ArticleController@addAttachment')
    ->name('article.file-upload');

Route::resource('city', 'CityController');

Route::resource('user', 'UserController');
Route::resource('role', 'RoleController');

Route::resource('organ', 'OrganController');


Route::get('ckeditor', 'CkeditorController@index');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
