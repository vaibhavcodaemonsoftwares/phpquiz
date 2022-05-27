<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\quiz;
use App\Http\Controllers\user;

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
    return view('login');
});
route::view('/loginq','login');
route::post('/quizz',[App\Http\Controllers\quiz::class,'quizz']);
route::get('/next/{question_id}',[App\Http\Controllers\quiz::class,'quizz']);
route::get('/save',[App\Http\Controllers\quiz::class,'save']);
route::post('quiz',[App\Http\Controllers\user::class,'mail']);
route::get('/test_result',[App\Http\Controllers\user::class,'result'])->name('test_result2');
