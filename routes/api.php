<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stats/github/repoCount', [
    'as' => 'github_stats',
    'uses' => 'App\Http\Controllers\API\GithubController@repoCount'
]);
Route::get('/stats/github/lang', [
    'as' => 'github_lang',
    'uses' => 'App\Http\Controllers\API\GithubController@lang'
]);
Route::get('/stats/github/commits', [
    'as' => 'github_commits',
    'uses' => 'App\Http\Controllers\API\GithubController@countCommits'
]);
Route::get('/stats/github/portfolio', [
    'as' => 'github_portfolio',
    'uses' => 'App\Http\Controllers\API\GithubController@portfolio'
]);
