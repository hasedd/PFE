<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vote;

class Voteit extends Component
{
    public $Votes;
    public $post_id;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
    }

    public function render()
    {
        $this->Votes = Vote::where('post_id',$this->post_id)->where('vote',1)->count()-Vote::where('post_id',$this->post_id)->where('vote',-1)->count();
        return view('livewire.voteit');
    }

    public function VoteUp()
    {
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

    public function VoteDown()
    {
        $test = Vote::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->count();
        if($test == 0)
        {
            $vote = Vote::create(['post_id'=>$this->post_id,'user_id'=>Auth()->user()->id,'vote'=> 0]);
        }
        else{
            $vote = Vote::where('post_id',$this->post_id)->where('user_id',Auth()->user()->id)->first();
        }

        if ($vote->vote > -1)
        {
            $vote->vote --;
            $vote->save();
        }
    }
}
