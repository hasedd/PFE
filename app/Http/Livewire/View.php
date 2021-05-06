<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class View extends Component
{
    public $post;
    public $post_id;

    public function mount($post_id)
    {
        $this->post = Post::find($post_id)->firstOrFail();
        $this->post_id = $post_id;
    }
    public function render()
    {
        return view('livewire.view',['post',$this->post]);
    }

    public function increment()
    {
        $test = App\Models\View::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->count();
        if($test == 0) {
            $vote = App\Models\View::create(['post_id' => $this->post_id, 'user_id' => Auth()->user()->id, 'view' => 1]);
            $this->post->views++;
        }
    }
}
