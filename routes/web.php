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

Route::get('/home', 'ViewController@home');//using controller which contains the business logic

Route::get('/about', function () {//using closure function(function without a name), for usecase where not much work needs to be done.
    return view('about');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::group(['middleware' => ['web']], function (){
    Route::get('/ticket_form', 'TicketsController@create');
    Route::post('/ticket_form', 'TicketsController@store');
});

Route::get('/all_tickets', 'TicketsController@index');

Route::get('/ticket/{slug?}', 'TicketsController@show');

Route::group(['middleware' => ['web']], function(){
    Route::get('/ticket/{slug}/edit', 'TicketsController@edit');
    Route::post('/ticket/{slug}/edit', 'TicketsController@editCompleted');
});

Route::get('/ticket/{slug}/delete', 'TicketsController@delete');

Route::get('/send_email', function (){

    $data = array(
        "name" => "My name is Urmila.",
    );

    \Illuminate\Support\Facades\Mail::send('email_successful', $data, function ($message){
        $message->from('urmi.mhrz@gmail.com', 'Learning Laravel');
        $message->to('urmi.mhrz@gmail.com')->subject('Learning Laravel test message');
    });
    return "Your email has been sent successfully.";
});

Route::post('/comment', 'CommentsController@newComment');

