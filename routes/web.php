<?php

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

Route::get('/', function () {
    return view('crud');
});

Route::get('/', 'ParkTicketController@index')->name('home');
Route::post('create',['as' =>'create','uses' =>'ParkTicketController@createTicket']);
Route::post('add',['as' =>'add','uses' =>'ParkTicketController@addParkingLocation']);
Route::post('approve',['as' =>'approve','uses' =>'ParkTicketController@approveTicket']);
Route::post('delete',['as' =>'delete','uses' =>'ParkTicketController@deleteTicket']);
