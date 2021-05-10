<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function destroy($id)
    {

        $file = File::find($id);

            $file->delete();
        return redirect()->back();
    }
}
