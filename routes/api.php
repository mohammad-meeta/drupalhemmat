<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/organ/list', 'OrganController@organsList')
    ->name('api.organ.list');

Route::get('/city/list', 'CityController@citiesList')
    ->name('api.city.list');
