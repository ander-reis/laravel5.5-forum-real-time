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
    return view('threads.index');
})->name('home');

Route::get('/threads/{id}', function($id){
    $result = \App\Thread::findOrFail($id);
    return view('threads.view', compact('result'));
});

Route::get('/locale/{locale}', function($locale){
    session(['locale' => $locale]);
    return back();
});

Route::get('/login/{provider}', 'SocialAuthController@redirect');
Route::get('/login/{provider}/callback', 'SocialAuthController@callback');

Route::get('/threads', 'ThreadsController@index')->name('threads.index');
Route::get('/replies/{id}', 'RepliesController@show')->name('replies.show');

Route::middleware(['auth'])->group(function(){
    Route::post('/threads', 'ThreadsController@store')->name('threads.store');
    Route::put('/threads/{thread}', 'ThreadsController@update')->name('threads.update');
    Route::get('/threads/{thread}/edit', function(\App\Thread $thread){
        return view('threads.edit', compact('thread'));
    })->name('threads.edit');

    Route::get('reply/highlight/{id}', 'RepliesController@highlight');
    Route::get('thread/pin/{thread}', 'ThreadsController@pin');
    Route::get('thread/close/{thread}', 'ThreadsController@close');

    Route::post('/replies', 'RepliesController@store')->name('replies.store');
});

Auth::routes();
