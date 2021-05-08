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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('Posts.questions.Body', [
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
        if (isset($_FILES) && !empty($_FILES['file']['name'])) {
            $_FILES['file']['name']=str_replace(' ','_',$_FILES['file']['name']) ;
            $post->file()->create(['name' => $_FILES['file']['name'], 'type' => $_FILES['file']['type'], 'size' => $_FILES['file']['size']]);
            $filname = $post->id . $post->file->id. $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], base_path('/public/files/') . $filname);
        }

        Auth()->user()->points += 5;
        Auth()->user()->save();
        return redirect()->route('QuestionBody');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('Posts.questions.show', [
            'categories' => Category::all(), 'post' => $post,
            'comments' => $post->comments,'bestAnswer' => Comment::where('post_id',$id)->where('isBestAnswer',1)->first(),
        ]);
    }

    public function MostVisited(){
        $posts = Post::orderBy('views')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>3
        ]);
    }

    public function MVoted(){
        $posts = Post::orderBy('votes','desc')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>4
        ]);
    }
    public function Answered(){
        $posts = Post::where('state','Close')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>5
        ]);
    }

    public function NAnswered(){
        $posts = Post::where('state','Open')->get();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>6
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
        $categ=$request->input('category');

        $cat = Category::where('name', $categ)->firstOrFail();
        $post->category_id = $cat->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->tags = $request->input('tags');


        $post->save();
        if (isset($_FILES) && !empty($_FILES['file']['name']))  {
            $_FILES['file']['name']=str_replace(' ','_',$_FILES['file']['name']) ;
            $post->file()->create(['name' => $_FILES['file']['name'], 'type' => $_FILES['file']['type'], 'size' => $_FILES['file']['size']]);
            $filname = $post->id . $post->file->id. $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], base_path('/public/files/') . $filname);
        }

        return redirect()->route('QuestionBody');
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
        if($post->file != null )
            $post->file->delete();
        $post->delete();
        return  redirect()->route('QuestionBody');
    }

    public function addview($post_id){

        $post = Post::findOrFail($post_id);
        $test = View::where('post_id',$post_id)->where('user_id',Auth()->user()->id)->count();
        if($test == 0) {
            $vote = View::create(['post_id' => $post_id, 'user_id' => Auth()->user()->id, 'view' => 1]);
            $post->views++;
            $post->save();
        }
        return redirect()->route('Show_Question',['id'=>$post_id]);
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
