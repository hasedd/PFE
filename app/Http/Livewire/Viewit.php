<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\View;
use Livewire\Component;

class Viewit extends Component
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
        return route('Show_Question',['id'=>$this->post->id]);
    }

    public function increment()
    {
        $test = View::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->count();
        if($test == 0) {
            $vote = View::create(['post_id' => $this->post_id, 'user_id' => Auth()->user()->id, 'view' => 1]);
            $this->post->views++;
            $this->post->save();
        }
    }
}
