<?php

use Illuminate\Support\Facades\Route;

Route::get('/web/menu','App\Http\Controllers\MenuController@menu');
Route::get('/web/menu/all','App\Http\Controllers\MenuController@allMenu');
Route::get('/web/menu/slug/{slug}','App\Http\Controllers\MenuController@getNameBySlug');

Route::get('/web/products/popular','App\Http\Controllers\ProductController@popular');
Route::get('/web/products/special','App\Http\Controllers\ProductController@special');

Route::get('/web/stories','App\Http\Controllers\StoryController@all');
