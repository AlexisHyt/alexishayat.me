<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

Route::get('/', ['as' => 'home', 'uses' => 'App\Http\Controllers\HomeController@index']);

Route::prefix('demo')->group(function () {
    Route::get('/saberunderline', [
        'as' => 'demo.saberunderline',
        'App\Http\Controllers\Demo\SaberUnderlineController@index'
    ]);
});
