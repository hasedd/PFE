<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;
class Comment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function replies(){
          return $this->hasMany(Reply::class);
    }

    public function files()
    {
        return $this->morphMany(File::class,'fileable');
    }

}
