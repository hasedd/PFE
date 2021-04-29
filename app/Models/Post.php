<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);

    }
    public function file()
    {
        return $this->morphOne(File::class,'fileable');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);

    }
}
