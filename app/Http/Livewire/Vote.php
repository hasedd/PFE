<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Vote extends Component
{
    public $Votes ;
    public $post_id;

    public function mount($post_id,$votes){

        $this->post_id = $post_id;
        $this->Votes = $votes;
    }
    public function render()
    {
        return view('livewire.vote');
    }
    public function VoteUp()
    {
        $post = Post::find($this->post_id);
        $post->votes_up = $post->votes_up + 1;
        $this->Votes = $post->votes_up - $post->votes_down;
        $post->save();
    }
    public function VoteDown()
    {
        $post = Post::find($this->post_id);
        $post->votes_down++;
        $this->Votes = $post->votes_up - $post->votes_down;
        $post->save();
    }
}
