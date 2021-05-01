<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class Counter extends Component
{
    public$nbr=0;
    public function render()
    {
        $posts = Post::take($this->nbr)->get();
        return view('Posts.questions.Body',[
            'categories'=>Category::all(),'posts' => $posts,'nbr'=>$this->nbr
        ]);
    }
    public function load2()
    {
        $this->nbr++;
    }
}
