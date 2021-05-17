<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Badget;
use App\Models\Category;
use App\Models\Follow;
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
        $posts = Post::where('type','Question')->orderBy('created_at','desc')->simplePaginate(7);
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
        $badegts = Badget::all();
        foreach ($badegts as $badget){
            if(Auth()->user()->points >= $badget->min_points && Auth()->user()->points < $badget->max_points){
                Auth()->user()->badget_id = $badget->id;
                Auth()->user()->save();
            }
        }
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
        $posts = Post::where('type','Question')->orderBy('views','desc')->simplePaginate(7);
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }
    public function MVoted(){
        $posts = Post::where('type','Question')->orderBy('votes','desc')->simplePaginate(7);
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }
    public function Answered(){
        $posts = Post::where('type','Question')->where('state','Close')->simplePaginate(7);
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);
    }

    public function NAnswered(){
        $posts = Post::where('type','Question')->where('state','Open')->simplePaginate(7);
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
        ]);
    }
    /* ------------------------------------------------------------------------------------------------------------------------*/


    public function indexox()
    {
        $posts = Post::where('type','Experience')->orWhere('type','Service')->orderBy('created_at','desc')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>7
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

        $post->user->points += 5;
        $post->user->save();
        $badegts = Badget::all();
        foreach ($badegts as $badget){
            if(Auth()->user()->points >= $badget->min_points && Auth()->user()->points < $badget->max_points){
                Auth()->user()->badget_id = $badget->id;
                Auth()->user()->save();
            }
        }
        return redirect()->route('postsBody');
    }
        public function showPost($id)
    {
        $post = Post::findOrFail($id);
        if($post->type == 'Service')
        $next = Post::where('id','>',$id)->where('type','Service')->orderBy('id')->first();
        else
            $next = Post::where('id','>',$id)->where('type','Experience')->orderBy('id')->first();
        if($post->type == 'Service')
            $previous= Post::where('id','<',$id)->where('type','Service')->orderBy('id','desc')->first();
        else
            $previous = Post::where('id','<',$id)->where('type','Experience')->orderBy('id','desc')->first();
        $related_posts=Post::where('category_id',$post->category->id)->where('id','!=',$post->id)->where(function ($q)
        { $q->where('type','Experience')->orWhere('type','Service');  })->orderBy('votes','desc')->take(2)->get();
        return view('Posts.Experiences.show', [
            'categories' => Category::all(), 'post' => $post,
            'comments' => $post->comments,'bestAnswer' => Comment::where('post_id',$id)->where('isBestAnswer',1)->first(),
            'previous' => $previous , 'next'=>$next , 'related'=>$related_posts,
        ]);
    }

    public function MostVisited1(){
        $posts = Post::where('type','Service')->orWhere('type','Experience')->orderBy('views','desc')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>8
        ]);
    }
    public function MVoted1(){
        $posts = Post::where('type','Service')->orWhere('type','Experience')->orderBy('votes','desc')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>13
        ]);
    }

    public function Experiences(){
        $posts = Post::where('type','Experience')->orderBy('created_at','desc')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>14
        ]);

    }
    public function Services(){
        $posts = Post::where('type','Service')->orderBy('created_at','desc')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>15
        ]);
    }
    /*------------------------------------------------------------------------------------------*/

    public function indexProfessorQ()
    {
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('created_at','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>16
        ]);

    }
    public function indexProfessorP()
    {
        $posts = Post::where('space', 'Professors')->where(function ($q) {
            $q->where('type', 'Service')->orWhere('type', 'Experience');
        })->orderBy('created_at', 'desc')->simplePaginate(7);
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i' => 21
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
        $post->user->points += 5;
        $post->user->save();
        $badegts = Badget::all();
        foreach ($badegts as $badget){
            if($post->user->points >= $badget->min_points && $post->user->points < $badget->max_points){
                $post->user->badget_id = $badget->id;
                $post->user->save();
            }
        }
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

        $post->user->points += 5;
        $post->user->save();
        $badegts = Badget::all();
        foreach ($badegts as $badget){
            if($post->user->points >= $badget->min_points && $post->user->points < $badget->max_points){
                $post->user->badget_id = $badget->id;
                $post->user->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */








    public function MostVisitedPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('views','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>18
        ]);
    }
    public function MostVisited1Private(){
        $posts = Post::where('space','Professors')->where(function ($q){
            $q->where('type','Service')->orWhere('type','Experience');
        })->orderBy('views','desc')->simplePaginate(7);

        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>22
        ]);
    }

    public function MVotedPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->orderBy('votes','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>19
        ]);
    }
    public function MVoted1Private(){
        $posts = Post::where('space','Professors')->where(function ($q){
            $q->where('type','Service')->orWhere('type','Experience');
        })->orderBy('votes','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>23
        ]);
    }
    public function ExperiencesPrivate(){
        $posts = Post::where('space','Professors')->where('type','Experience')->orderBy('created_at','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>24
        ]);

    }
    public function ServicesPrivate(){
        $posts = Post::where('space','Professors')->where('type','Service')->orderBy('created_at','desc')->simplePaginate(7);
        return view('espace_enseignant.BodyPost', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>25
        ]);
    }
    public function AnsweredPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->where('state','Close')->simplePaginate(7);
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>17
        ]);
    }

    public function NAnsweredPrivate(){
        $posts = Post::where('space','Professors')->where('type','Question')->where('state','Open')->simplePaginate(7);
        return view('espace_enseignant.BodyQuestion', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>20
        ]);
    }

    public function  questions_categories($id){



        $posts = Post::where('category_id',$id)->where('type','Question')->simplePaginate(7);
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>10,'category_id'=>$id
        ]);
    }


    public function  services_categories($id){

        $posts = Post::where('category_id',$id)->where('type','Service')->simplePaginate(7);
        return view('Posts.Experiences.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>9,'category_id'=>$id
        ]);
    }

    public function  experiences_categories($id){

        $posts = Post::where('category_id',$id)->where('type','Experience')->simplePaginate(7);
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
        if(isset($_FILES['file'])) {
            $nbr_files = count($_FILES['file']['type']);
            if ($nbr_files > 0) {
                for ($i = 0; $i < $nbr_files; $i++) {
                    if (isset($_FILES) && !empty($_FILES['file']['name'][$i])) {
                        $_FILES['file']['name'][$i] = str_replace(' ', '_', $_FILES['file']['name'][$i]);
                        $post->files()->create(['name' => $_FILES['file']['name'][$i], 'type' => $_FILES['file']['type'][$i], 'size' => $_FILES['file']['size'][$i]]);
                        $filname = $post->id . $_FILES['file']['name'][$i];
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], base_path('/public/files/') . $filname);
                    }
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
        $post->user->points -= 5;
        $post->user->save();
        $badegts = Badget::all();
        foreach ($badegts as $badget){
            if($post->user->points >= $badget->min_points && $post->user->points < $badget->max_points){
                $post->user->badget_id = $badget->id;
                $post->user->save();
            }
        }
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
        $users = User::orderBy('name','desc')->simplePaginate(7);
        return view('Posts.users', [
            'categories' => Category::all(), 'users' => $users,
            'i'=>26
        ]);

    }
    public function userprofile($id){

        $user = User::findOrfail($id);
        $followers = Follow::where('followed',$id)->simplePaginate(30);
        $following = Follow::where('follows',$id)->simplePaginate(30);
        $nbr_questions = Post::where('user_id',$id)->where('type','Question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','Service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','Experience')->count();
        $questions = Post::where('user_id',$id)->where('type','Question')->simplePaginate(7);
        $services= Post::where('user_id',$id)->where('type','Service')->simplePaginate(7);
        $experiences = Post::where('user_id',$id)->where('type','Experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->simplePaginate(7);
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'services'=>$services,'experiences'=>$experiences,'i'=>0,'followers'=>$followers,'following'=>$following]);
    }
    public function userQuestions($id) {

        $user = User::findOrfail($id);
        $followers = Follow::where('followed',$id)->simplePaginate(30);
        $following = Follow::where('follows',$id)->simplePaginate(30);
        $nbr_questions = Post::where('user_id',$id)->where('type','Question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','Service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','Experience')->count();
        $questions = Post::where('user_id',$id)->where('type','Question')->simplePaginate(7);
        $services= Post::where('user_id',$id)->where('type','Service')->simplePaginate(7);
        $experiences = Post::where('user_id',$id)->where('type','Experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->simplePaginate(7);
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'i'=>34,'followers'=>$followers,'following'=>$following]);
    }
    public function userbAnswers($id) {

        $user = User::findOrfail($id);
        $followers = Follow::where('followed',$id)->simplePaginate(30);
        $following = Follow::where('follows',$id)->simplePaginate(30);
        $nbr_questions = Post::where('user_id',$id)->where('type','Question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','Service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','Experience')->count();
        $questions = Post::where('user_id',$id)->where('type','Question')->simplePaginate(7);
        $services= Post::where('user_id',$id)->where('type','Service')->simplePaginate(7);
        $experiences = Post::where('user_id',$id)->where('type','Experience')->get();

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->simplePaginate(7);
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$questions,'i'=>35,'followers'=>$followers,'following'=>$following]);
    }
    public function userServices($id) {

        $user = User::findOrfail($id);
        $followers = Follow::where('followed',$id)->get();
        $following = Follow::where('follows',$id)->get();
        $nbr_questions = Post::where('user_id',$id)->where('type','Question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','Service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','Experience')->count();

        $services= Post::where('user_id',$id)->where('type','Service')->simplePaginate(7);


        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->get();
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$services,'i'=>37,'followers'=>$followers,'following'=>$following]);
    }
    public function userExperiences($id) {

        $user = User::findOrfail($id);
        $followers = Follow::where('followed',$id)->simplePaginate(30);
        $following = Follow::where('follows',$id)->simplePaginate(30);
        $nbr_questions = Post::where('user_id',$id)->where('type','Question')->count();
        $nbr_services = Post::where('user_id',$id)->where('type','Service')->count();
        $nbr_experiences = Post::where('user_id',$id)->where('type','Experience')->count();

        $experiences = Post::where('user_id',$id)->where('type','Experience')->simplePaginate(7);

        $nbr_banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->count();
        $banswers = Comment::where('user_id',$id)->where('isBestAnswer',true)->simplePaginate(7);
        $answers = Comment::where('user_id',$id)->count();
        return view('Posts.userprofile',['categories' => Category::all(),'user'=>$user,
            'nbr_questions'=>$nbr_questions,'nbr_services'=>$nbr_services,'nbr_experiences'=>$nbr_experiences,
            'nbr_banswers'=>$nbr_banswers,'banswers'=>$banswers,'answers'=>$answers
            ,'posts'=>$experiences,'i'=>36,'followers'=>$followers,'following'=>$following]);
    }


    public function follow($id)
    {
        $test = Follow::where('follows',Auth()->user()->id)->where('followed',$id)->count();
        if ($test == 0) {
            Follow::create(['follows' => Auth()->user()->id, 'followed' => $id]);
            $user = User::find($id);
            $user->points -=5;
            $badegts = Badget::all();
            foreach ($badegts as $badget){
                if($user->points >= $badget->min_points && $user->points < $badget->max_points){
                    $user->badget_id = $badget->id;
                    $user->save();
                }
            }
            $user->save();
        }else
        {
            Follow::where('follows',Auth()->user()->id)->where('followed',$id)->first()->delete();
            $user = User::find($id);
            $user->points -=5;
            $user->save();
            $badegts = Badget::all();
            foreach ($badegts as $badget){
                if($user->points >= $badget->min_points && $user->points < $badget->max_points){
                    $user->badget_id = $badget->id;
                    $user->save();
                }
            }
        }
        return redirect()->back();
    }

    public function finduser(){
        $username = $_GET['search'];
        $users = User::Where('username', 'like', '%' . $username . '%')->simplePaginate(20);
        if ($users == null) return redirect()->route('users');

        else return view('Posts.users', [
            'categories' => Category::all(), 'users' => $users,
            'i'=>2
        ]);
    }

    public function display_users(){
        $userfilter = $_GET['user_filter'];
        dd($userfilter);
        if ($users == null) return redirect()->route('users');

        else return view('Posts.users', [
            'categories' => Category::all(), 'users' => $users,
            'i'=>2
        ]);

    }
}
