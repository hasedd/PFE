<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Views extends Component
{
    public $post_id;
    public $post;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
        $this->post = Post::find($post_id)->firstOrFail();

    }
    public function render()
    {
        return view('livewire.views',['post_id',$this->post]);
    }

    public function increment()
    {
        $this->post->views ++;
    }
}
