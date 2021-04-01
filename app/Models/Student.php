<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['firstName','lastName','CINE','email','speciality','university','registered'];
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne(User::class,'useable');
    }
}
