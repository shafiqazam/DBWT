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

Route::get('/', [\App\Http\Controllers\HauptseiteController::class,'show']);

Route::get('/m4_6a_queryparameter', [\App\Http\Controllers\ExampleController::class,'m4_6a_queryparameter']);

Route::get('/m4_6b_kategorie', [\App\Http\Controllers\ExampleController::class,'m4_6b_kategorie']);

Route::get('/m4_6c_gerichte', [\App\Http\Controllers\ExampleController::class,'m4_6c_gerichte']);

Route::get('/no1', function () {
    return view('examples.pages.m4_6d_page_1');
});

Route::get('/no2', function () {
    return view('examples.pages.m4_6d_page_2');
});
