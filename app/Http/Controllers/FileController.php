<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->file != null )
            $post->file->delete();
        return redirect()->back();
    }
}
