<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LoadMore extends Component
{
    public $nbr = 0;
    public function render()
    {
        dd('cc1');
        $posts = Post::take($this->nbr)->get();

        return view('Posts.questions.Body',[
            'categories'=>Category::all(),'posts' => $posts
        ]);
    }
    public function load(){
        dd('cc');
        $this->nbr+=1;
    }
}
