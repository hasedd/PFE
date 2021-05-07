<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Vote;

class Voteit extends Component
{
    public $Votes;
    public $post_id;
    public $var;

    public function mount($post_id,$var)
    {
        $this->post_id = $post_id;
        $this->var = $var;
    }

    public function render()
    {
            $this->Votes = Vote::where('post_id', $this->post_id)->where('vote', 1)->count() - Vote::where('post_id', $this->post_id)->where('vote', -1)->count();
            $post = Post::find($this->post_id);
            $post->votes = $this->Votes;
            $post->save();
        return view('livewire.voteit');
    }

    public function VoteUp()
    {
        if ($this->var == 0){
            $test = Vote::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->count();

            if($test == 0)
                $vote = Vote::create(['post_id'=>$this->post_id,'user_id'=>Auth()->user()->id,'vote'=> 0]);
            else
                $vote = Vote::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->first();
            if ($vote->vote < 1)
            {
                $vote->vote ++;
                $vote->save();
            }
        }
        else return;
    }

    public function VoteDown()
    {

        if ($this->var == 0)
        {
            $test = Vote::where('post_id', $this->post_id)->where('user_id', Auth()->user()->id)->count();
            if ($test == 0) {
                $vote = Vote::create(['post_id' => $this->post_id, 'user_id' => Auth()->user()->id, 'vote' => 0]);
            } else {
                $vote = Vote::where('post_id', $this->post_id)->where('user_id', Auth()->user()->id)->first();
            }

            if ($vote->vote > -1) {
                $vote->vote--;
                $vote->save();
            }
        }
        else return;
    }
}
