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

// niezalogowany
Route::get('/', function () {
    return view('login');
})->middleware('niezalogowany')->name('index');

// auth
Route::post('/uczestnik', 'UczestnikController@post')->name('uczestnik.post');
Route::get('/admin', 'LoginController@index')->name('admin');

// uczestnik
Route::get('/test', 'TestController@index')->name('test');
Route::get('/test_kontrolny', 'TestKontrolnyController@index')->name('test_kontrolny');
Route::get('/quiz', 'QuizController@getQuestions')->name('quiz.questions');
Route::post('/quiz/start', 'QuizController@start')->name('quiz.start');
Route::post('/quiz/finish', 'QuizController@finish')->name('quiz.finish');



Route::post('/user/tryLogin', 'UserController@tryLogin')->name('user.tryLogin');
Route::get('/user/logout', 'UserController@logout')->name('user.logout');






// core
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
