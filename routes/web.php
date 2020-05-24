<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "HomeController@index");

Route::group(["prefix" => "content/{modelId}"], function() {
    Route::get("/", "ContentController@index");
    Route::post("/", "ContentController@store");
    
    Route::get("create/", "ContentController@create");
    
    Route::get("{id}/", "ContentController@show");
    Route::put("{id}/", "ContentController@update");
    Route::patch("{id}/", "ContentController@update");
    Route::delete("{id}/", "ContentController@destroy");
    
    Route::get("{id}/edit/", "ContentController@edit");
});

