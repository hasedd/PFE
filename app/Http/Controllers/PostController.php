<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\File;
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
        $posts = Post::all();
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts , 'i'=>2
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

            $post->file()->create(['name' => $_FILES['file']['name'], 'type' => $_FILES['file']['type'], 'size' => $_FILES['file']['size']]);
            $infosfichier = pathinfo($_FILES['file']['name']);
            $extension_upload = $infosfichier['extension'];
            $filname = $post->id . $post->title . "." . $extension_upload;
            move_uploaded_file($_FILES['file']['tmp_name'], base_path('/public/files/') . $filname);
        }
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
            'comments' => $post->comments,
        ]);
    }
    public function MostRecent(){
        $posts = Post::orderBy('created_at')->get() ;
        return view('Posts.questions.Body', [
            'categories' => Category::all(), 'posts' => $posts,
            'i'=>2
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
        $posts = Post::join('votes','posts.id','=','votes.post_id')->select('posts.*')->orderBy('votes.vote','desc')->get();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return  redirect()->route('QuestionBody');
    }
}
