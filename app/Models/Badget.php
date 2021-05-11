<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badget extends Model
{
    use HasFactory;

    protected $fillable = ['title','min_points','max_points'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
