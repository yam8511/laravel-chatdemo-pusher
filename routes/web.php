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
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::get('/messages', function () {
	# Personal Message
	// return Auth::user()->messages()->with('user')->get();
	return App\Message::with('user')->orderBy('created_at', 'desc')->get();
})->middleware('auth');

Route::post('/messages', function () {
	
    $user = Auth::user();

    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);

	# Announce that a new message has been posted
    broadcast(new \App\Events\MessagePosted($message, $user))->toOthers();

	return response()->json([
		'result' => 'ok',
	]);

})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
