<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtherController ;
use App\Http\Controllers\CommentController ;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReplyController;
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

    Route::get('/users', [PostController::class,'users']
    )->name('users');
    Route::get('/posts', [PostController::class,'indexox']
    )->name('postsBody');
    Route::get('/Questions', [PostController::class,'index']
    )->name('QuestionBody');
    Route::get('/Questions/{id}', [PostController::class,'show']
    )->name('Show_Question');

    Route::get('/Posts/{id}', [PostController::class,'showPost']
    )->name('Show_Post');

    Route::POST('/Questions/add',[PostController::class,'store'])
        ->name('Add_Question');
    Route::POST('/Post/add',[PostController::class,'storePost'])
        ->name('Add_Post');
    Route::get('/add_view/{post_id}', [PostController::class,'addview']
    )->name('addview');
    Route::get('/Questions$Posts/{id}/edit', [PostController::class,'edit']
    )->name('edit_post');
    Route::get('/DeletePost/{id}',[PostController::class,'destroy']
    )->name('delete_post');

    Route::get('/user/{id}/profile', [PostController::class,'userprofile']
    )->name('userprofile');
    Route::get('/user/{id}/question', [PostController::class,'userQuestions']
    )->name('user_questions');
    Route::get('/user/{id}/services', [PostController::class,'userServices']
    )->name('user_services');
    Route::get('/user/{id}/b_answers', [PostController::class,'userbAnswers']
    )->name('user_bAnswers');
    Route::get('/user/{id}/questions', [PostController::class,'userExperiences']
    )->name('user_experiences');




    Route::POST('/addComment/{post_id}',[CommentController::class,'store']
    )->name('comments_form');
    Route::get('/DeleteComment/{id}',[CommentController::class,'destroy']
    )->name('delete_comment');

    Route::get('/AnsweredQuestions', [PostController::class,'Answered']
    )->name('answered');

    Route::get('/NotAnsweredQuestions', [PostController::class,'NAnswered']
    )->name('Not_answered');

    Route::get('/mostVisitedQuestions', [PostController::class,'MostVisited']
    )->name('Most_visited');

    Route::get('/mostVisitedPosts', [PostController::class,'MostVisited1']
    )->name('VisitedPosts');

    Route::get('/mostVotedQuestions', [PostController::class,'MVoted']
    )->name('Most_Voted');

    Route::get('/mostVotedPosts', [PostController::class,'MVoted1']
    )->name('VotedPosts');

    Route::get('/Experiences', [PostController::class,'Experiences']
    )->name('experiences');

    Route::get('/Services', [PostController::class,'Services']
    )->name('services');


    Route::get('/best_answer_selected/{id}',[CommentController::class,'select_best_answer']
    )->name('select_b_a');

    Route::get('/best_answer_canceled/{id}',[CommentController::class,'cancel_best_answer']
    )->name('cancel_b_a');

    Route::POST('/addReply/{id}',[ReplyController::class,'store'])
        ->name('Add_Reply');
    Route::get('/DeleteReply/{id}',[ReplyController::class,'destroy']
    )->name('delete_reply');

    Route::POST('/updatePost/{id}',[PostController::class,'update'])
        ->name('update_question');
    Route::get('/DeleteFile/{id}',[FileController::class,'destroy']
    )->name('delete_file');
});


Route::match(['POST','GET'],'/othercreate',[OtherController::class,'createOther'])
    ->name('createother');


