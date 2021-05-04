<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;

use App\Models\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        //dd("Welcome  in CommentController ");
        $comment=new Comment();
        $comment->post_id=$post_id;
        $comment->user_id= Auth::user()->id ;
        $comment->Content=$request->input('comment');
        $comment->save();

        if (isset($_FILES)  && !empty($_FILES['file']['name'])
        )  {

            $comment->file()->create(['name' => $_FILES['file']['name'], 'type' => $_FILES['file']['type'], 'size' => $_FILES['file']['size']]);
            $infosfichier = pathinfo($_FILES['file']['name']);
            $extension_upload = $infosfichier['extension'];
            $filname = $comment->id . $comment->title . "." . $extension_upload;
            move_uploaded_file($_FILES['file']['tmp_name'], base_path('/public/files/') . $filname);
        }
        $comment->post->state="Close";
        $comment->post->save();

        return redirect()->route('Show_Question',[$comment->post->id]);




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('Posts.questions.show',[
            'categories'=>Category::all(),'post'=>$post,
            'comments'=>$post->comments(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//
    }
}
