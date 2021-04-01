<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['firstName','lastName','age','address','domain','email','diplom','university'];

    public function user()
    {
        return $this->morphOne(User::class,'useable');
    }
}
