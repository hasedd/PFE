<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\File;
use App\Models\User;
use App\Models\View;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    /* -----------------------------------------------------------------------------------------------------*/

    public function index()
    {
        $posts = Post::where('type','Question')->orderBy('created_at','desc')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>2
        ]);
    }
    public function store(Request $request)
    {

        $post = new Post();
        $post->type = "Question";
        $post->space = "Public";
        $post->state = "Open";
        $post->user_id = Auth::user()->id;
        $cat = Category::where('name', $request->input('category'))->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->save();
        $nbr_files=count($_FILES['file']['type']);

        if($nbr_files > 0) {
            for($i=0;$i<$nbr_files;$i++) {
                if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                    $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                    $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                    $filname = $post->id . $_FILES['file']['name'][$i];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                }
            }
        }
        Auth()->user()->points += 5;
        Auth()->user()->save();
        return redirect()->route('QuestionBody');
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('Posts.questions.show', [
            'categories' => Category::all(), 'post' => $post,
            'comments' => $post->comments,'bestAnswer' => Comment::where('post_id',$id)->where('isBestAnswer',1)->first(),
        ]);
    }
    public function MostVisited(){
        $posts = Post::where('type','Question')->orderBy('views','desc')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }
    public function MVoted(){
        $posts = Post::where('type','Question')->orderBy('votes','desc')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }
    public function Answered(){
        $posts = Post::where('type','Question')->where('state','Close')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);
    }

    public function NAnswered(){
        $posts = Post::where('type','Question')->where('state','Open')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
        ]);
    }
    /* ------------------------------------------------------------------------------------------------------------------------*/


    public function indexox()
    {
        $posts = Post::where('type','Experience')->orWhere('type','Service')->orderBy('created_at','desc')->get();
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>2
        ]);

    }
    public function storePost(Request $request)
    {

        $post = new Post();
        $post->type = $request->input('type');

        $post->space = "Public";
        $post->state = "Open";
        $post->user_id = Auth::user()->id;
        $cat = Category::where('name', $request->input('category'))->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->save();
        $nbr_files=count($_FILES['file']['type']);
        if($nbr_files > 0) {
            for($i=0;$i<$nbr_files;$i++) {
                if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                    $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                    $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                    $filname = $post->id . $_FILES['file']['name'][$i];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                }
            }
        }

        Auth()->user()->points += 5;
        Auth()->user()->save();
        return redirect()->route('postsBody');
    }
        public function showPost($id)
    {
        $post = Post::findOrFail($id);
        return view('Posts.Experiences.show', [
            'categories' => Category::all(), 'post' => $post,
            'comments' => $post->comments,'bestAnswer' => Comment::where('post_id',$id)->where('isBestAnswer',1)->first(),
        ]);
    }

    public function MostVisited1(){
        $posts = Post::where('type','Service')->orWhere('type','Experience')->orderBy('views','desc')->get();
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }
    public function MVoted1(){
        $posts = Post::where('type','Service')->orWhere('type','Experience')->orderBy('votes','desc')->get();
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }

    public function Experiences(){
        $posts = Post::where('type','Experience')->orderBy('created_at','desc')->get();
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);

    }
    public function Services(){
        $posts = Post::where('type','Service')->orderBy('created_at','desc')->get();
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
        ]);
    }
    /*------------------------------------------------------------------------------------------*/

    public function indexProfessorQ()
    {
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('created_at','desc')->get();
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>2
        ]);

    }
    public function indexProfessorP()
    {
        $posts = Post::where('space','Professors')->where(function ($q){
            $q->where('type','Service')->orWhere('type','Experience');
        })->orderBy('created_at','desc')->get();
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>2
        ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */




    public function storeinprivate(Request $request)
    {

        $post = new Post();
        $post->type = "Question";
        $post->space = "Professors";
        $post->state = "Open";
        $post->user_id = Auth::user()->id;
        $cat = Category::where('name', $request->input('category'))->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->save();
        $nbr_files=count($_FILES['file']['type']);
        if($nbr_files > 0) {
            for($i=0;$i<$nbr_files;$i++) {
                if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                    $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                    $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                    $filname = $post->id . $_FILES['file']['name'][$i];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                }
            }
        }
        Auth()->user()->points += 5;
        Auth()->user()->save();
        return redirect()->back();
    }

    public function storePostinprivate(Request $request)
    {

        $post = new Post();
        $post->type = $request->input('type');

        $post->space = "Professors";
        $post->state = "Open";
        $post->user_id = Auth::user()->id;
        $cat = Category::where('name', $request->input('category'))->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->save();
        $nbr_files=count($_FILES['file']['type']);

        if($nbr_files > 0) {
            for($i=0;$i<$nbr_files;$i++) {
                if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                    $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                    $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                    $filname = $post->id . $_FILES['file']['name'][$i];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                }
            }
        }

        Auth()->user()->points += 5;
        Auth()->user()->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */








    public function MostVisitedPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('views','desc')->get();
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }
    public function MostVisited1Private(){
        $posts = Post::where('space','Professors')->where(function ($q){
            $q->where('type','Service')->orWhere('type','Experience');
        })->orderBy('views','desc')->get();

        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }

    public function MVotedPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('votes','desc')->get();
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }
    public function MVoted1Private(){
        $posts = Post::where('space','Professors')->where(function ($q){
            $q->where('type','Service')->orWhere('type','Experience');
        })->orderBy('votes','desc')->get();
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }
    public function ExperiencesPrivate(){
        $posts = Post::where('space','Professors')->where('type','Experience')->orderBy('created_at','desc')->get();
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);

    }
    public function ServicesPrivate(){
        $posts = Post::where('space','Professors')->where('type','Service')->orderBy('created_at','desc')->get();
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
        ]);
    }
    public function AnsweredPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->where('state','Close')->get();
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);
    }

    public function NAnsweredPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->where('state','Open')->get();
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
        ]);
    }

    public function  questions_categories($id){


        $category= Category::find($id);
        $posts = $category->posts->where('type','Question');
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>10,'category_id'=>$id
        ]);
    }


    public function  services_categories($id){

     $category= Category::find($id);
     $posts = $category->posts->where('type','Service');
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>9,'category_id'=>$id
        ]);
    }

    public function  experiences_categories($id){

        $category= Category::find($id);
        $posts = $category->posts->where('type','Experience');
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>11,'category_id'=>$id
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $post = Post::find($id);
        return view('Posts.questions.edit',['categories'=>Category::all(),'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        if($post->type!='Question')
        $post->type=$request->input('type');
        else $post->type='Question';
        $categ=$request->input('category');

        $cat = Category::where('name', $categ)->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->tags = $request->input('tags');


        $post->save();
        $nbr_files=count($_FILES['file']['type']);
        if($nbr_files > 0) {
            for($i=0;$i<$nbr_files;$i++) {
                if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                    $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                    $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                    $filname = $post->id . $_FILES['file']['name'][$i];
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                }
            }
        }
       if($post->type=="Question")
        return redirect()->route('QuestionBody');
       else return redirect()->route('postsBody');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $type=$post->type;
        if($post->file != null )
            $post->file->delete();
        $post->delete();
        if($type=='Question')
        return  redirect()->route('QuestionBody');
        else return redirect()->route('postsBody');
    }

    public function addview($post_id){

        $post = Post::findOrFail($post_id);
        $test = View::where('post_id',$post_id)->where('user_id',Auth()->user()->id)->count();
        if($test == 0) {
            $vote = View::create(['post_id' => $post_id, 'user_id' => Auth()->user()->id, 'view' => 1]);
            $post->views++;
            $post->save();
        }
        if($post->type=='Question')
        return redirect()->route('Show_Question',['id'=>$post_id]);
        else return redirect()->route('Show_Post',['id'=>$post_id]);
    }

    public function users()
    {
        $users = User::orderBy('name','desc')->get();
        return view('Posts.users', [
            'categories' => Category::all(), 'users' => $users,
            'i'=>2
        ]);

    }
    public function userprofile($id){

        $user = User::findOrfail($id);
        $nbr_questions = Post::where('user_id',$id)->where('type','question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','experience')->count();
        $questions = Post::where('user_id',$id)->where('type','question')->get();
        $services= Post::where('user_id',$id)->where('type','service')->get();
        $experiences = Post::where('user_id',$id)->where('type','experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>0]);
    }
    public function userQuestions($id) {

        $user = User::findOrfail($id);
        $nbr_questions = Post::where('user_id',$id)->where('type','question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','experience')->count();
        $questions = Post::where('user_id',$id)->where('type','question')->get();
        $services= Post::where('user_id',$id)->where('type','service')->get();
        $experiences = Post::where('user_id',$id)->where('type','experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>1]);
    }
    public function userbAnswers($id) {

        $user = User::findOrfail($id);
        $nbr_questions = Post::where('user_id',$id)->where('type','question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','experience')->count();
        $questions = Post::where('user_id',$id)->where('type','question')->get();
        $services= Post::where('user_id',$id)->where('type','service')->get();
        $experiences = Post::where('user_id',$id)->where('type','experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>2]);
    }
    public function userServices($id) {

        $user = User::findOrfail($id);
        $nbr_questions = Post::where('user_id',$id)->where('type','question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','experience')->count();
        $questions = Post::where('user_id',$id)->where('type','question')->get();
        $services= Post::where('user_id',$id)->where('type','service')->get();
        $experiences = Post::where('user_id',$id)->where('type','experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>3]);
    }
    public function userExperiences($id) {

        $user = User::findOrfail($id);
        $nbr_questions = Post::where('user_id',$id)->where('type','question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','experience')->count();
        $questions = Post::where('user_id',$id)->where('type','question')->get();
        $services= Post::where('user_id',$id)->where('type','service')->get();
        $experiences = Post::where('user_id',$id)->where('type','experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>4]);
    }
}
