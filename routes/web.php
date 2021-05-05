<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtherController ;
use App\Http\Controllers\CommentController ;
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

Route::get('/contact', function () {
    return view('Contact_us');
})->name('contact');

Route::get('/about', function () {
    return view('About_us');
})->name('about');



Route::MATCH('POST','/register/next', function () {
    return view('auth.register2');
})->name('register2');

Route::middleware(['auth:sanctum', 'verified'])->group(function (){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/test', [PostController::class,'index']
    )->name('QuestionBody');

    Route::get('/test/{id}', [PostController::class,'show']
    )->name('Show_Question');

    Route::get('/test/{id}/edit', [PostController::class,'edit']
        )->name('edit');

    Route::POST('/addQuestion',[PostController::class,'store'])
        ->name('Add_Question');

    Route::POST('/addComment/{post_id}',[CommentController::class,'store']
    )->name('comments_form');

    Route::get('/DeletePost/{id}',[PostController::class,'destroy']
    )->name('delete_post');

    Route::get('/Answered', [PostController::class,'Answered']
    )->name('answered');
    Route::get('/NotAnswered', [PostController::class,'NAnswered']
    )->name('Not_answered');
    Route::get('/mostVisited', [PostController::class,'MostVisited']
    )->name('Most_visited');
    Route::get('/mostVoted', [PostController::class,'MVoted']
    )->name('Most_Voted');


});


Route::match(['POST','GET'],'/othercreate',[OtherController::class,'createOther'])
    ->name('createother');


