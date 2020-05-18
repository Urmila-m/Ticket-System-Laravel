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

Route::group(['middleware' => ['web']], function (){
    Route::get('/ticket_form', 'TicketsController@create');
    Route::post('/ticket_form', 'TicketsController@store');
});

Route::get('/all_tickets', 'TicketsController@index')->name('allTickets');
Route::get('/my_tickets', 'TicketsController@myTickets')->name('myTickets');

Route::get('/ticket/{slug?}', 'TicketsController@show');

Route::group(['middleware' => ['web']], function(){
    Route::get('/ticket/{slug}/edit', 'TicketsController@edit');
    Route::post('/ticket/{slug}/edit', 'TicketsController@editCompleted');
});

Route::get('/ticket/{slug}/delete', 'TicketsController@delete');

//middleware('auth') can be added here to allow only authorized user or it can be added in the controller
Route::post('/comment', 'CommentsController@newComment')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', 'Controller@welcome')->name('welcome');

Route::get('/', 'Controller@welcome');

