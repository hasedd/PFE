<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\File;
class Reply extends Model
{
    use HasFactory;
    public function  comment(){
        return $this->belongsTo(Comment::class);
    }

    public function file()
    {
        return $this->morphOne(File::class,'fileable');
    }
}
