<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/organ/list', 'OrganController@organsList')
    ->name('api.organ.list');

Route::get('/city/list', 'CityController@citiesList')
    ->name('api.city.list');

Route::get('/article-type/list', 'ArticleTypeController@articleTypesList')
    ->name('api.article-type.list');

Route::get('/document-category/list', 'DocumentCategoryController@documentCategoriesList')
    ->name('api.document-category.list');

Route::get('/indicator-category/list', 'IndicatorCategoryController@indicatorCategoriesList')
    ->name('api.indicator-category.list');

Route::get('/indicator/list', 'IndicatorController@indicatorsList')
    ->name('api.indicator.list');

Route::get('/monitoring/list', 'MonitoringController@monitoringsList')
    ->name('api.monitoring.list');

Route::get('/province/list', 'ProvinceController@provincesList')
    ->name('api.province.list');

Route::get('/article/list', 'ArticleController@articlesList')
    ->name('api.article.list');

Route::get('/article/documents-center/list', 'ArticleController@articleDocumentsCenterList')
    ->name('api.article.documentsCenterList');

Route::get('/monitoring/indicators/list', 'IndicatorController@monitoringIndicatorsList')
    ->name('api.indicator.monitoringList');
