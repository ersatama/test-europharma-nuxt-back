<?php

use Illuminate\Support\Facades\Route;

Route::get('/web/menu','App\Http\Controllers\MenuController@menu');
Route::get('/web/menu/all','App\Http\Controllers\MenuController@allMenu');
Route::get('/web/menu/slug/{slug}','App\Http\Controllers\MenuController@getNameBySlug');
Route::get('/web/menu/slug/{slug}/{product}','App\Http\Controllers\MenuController@getNameBySlugAndProduct');
Route::get('/web/menu/slug/{slug}/{product}/{item}','App\Http\Controllers\MenuController@getItems');

Route::get('/web/products/popular','App\Http\Controllers\ProductController@popular');
Route::get('/web/products/special','App\Http\Controllers\ProductController@special');
//Route::get('/web/products/slug/{slug}','App\Http\Controllers\ProductController@getProductsByMenu');
Route::get('/web/products/slug/{slug}/{product}','App\Http\Controllers\ProductController@getProductsByMenuAndProduct');

Route::get('/web/products/category/{category}','App\Http\Controllers\ProductController@getProductsByCategory');

Route::get('/web/stories','App\Http\Controllers\StoryController@all');

Route::get('/web/footer','App\Http\Controllers\MenuController@footer');

//Route::post('/characteristic-inline-create','App\Http\Controllers\ProductController@filterCreate')->name('characteristic-inline-create');
//Route::post('/characteristic-inline-create-save','App\Http\Controllers\ProductController@filterCreateSave')->name('characteristic-inline-create-save');
