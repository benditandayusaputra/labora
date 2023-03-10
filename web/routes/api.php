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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('club', 'Api\ClubController');
Route::resource('tournament', 'Api\TournamentController');
Route::resource('register_tournament', 'Api\RegisterTournamentController');
Route::get('register_tournament/update/{orderId}', 'Api\RegisterTournamentController@updateStatus');