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

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('do_login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('club', 'ClubController');
    Route::resource('tournament', 'TournamentController');
    Route::resource('register_tournament', 'RegisterTournamentController');
    Route::resource('payment', 'PaymentController');
    Route::resource('master_payment', 'MasterPaymentController');
    Route::get('/payment_confirm', 'PaymentController@confirm')->name('payment_confirm');
    Route::get('/publish_tournament/{id}/{publish}', 'TournamentController@publish')->name('publish');
    Route::get('/logout', 'LoginController@logout')->name('do_logout');
});