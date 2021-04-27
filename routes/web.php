<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtherController ;
use App\Http\Controllers\PostController ;
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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::match('POST','/addQuestion',[PostController::class,'store'])
    ->name('addq');

Route::MATCH('POST','/register/next', function () {
    return view('auth.register2');
})->name('register2');

Route::middleware(['auth:sanctum', 'verified'])->group(function (){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/test', [PostController::class,'index']

    )->name('QuestionBody');
});
Route::match(['POST','GET'],'/othercreate',[OtherController::class,'createOther'])
    ->name('createother');

