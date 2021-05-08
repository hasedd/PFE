<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;
use App\Models\Comment;
class ReplyController extends Controller
{
    public function store(Request $request,$comment_id)
    {
        $reply = new Reply();

        $reply->comment_id=$comment_id;
        $reply->user_id= Auth::user()->id ;
        $reply->Content=$request->input('reply');
        $reply->save();
        $comment=Comment::find($comment_id);
        $id=$comment->post->id;
        return redirect()->route('Show_Question',[$id]);
    }
    public function destroy($id) {
        $reply=Reply::find($id);
        $id=$reply->comment->post->id;
        $reply->delete();
        return redirect()->route('Show_Question',[$id]);

    }

}
