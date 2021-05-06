<?php

namespace App\Http\Livewire;

use App\Models\Like;
use Livewire\Component;

class Likeit extends Component
{
    public $Likes;
    public $post_id;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
    }

    public function render()
    {
        $this->Likes = Like::where('comment_id',$this->post_id)->where('like',1)->count() - Like::where('comment_id',$this->post_id)->where('like',-1)->count();
        return view('livewire.likeit');
    }

    public function VoteUp()
    {
           $test = Like::where('comment_id',$this->post_id)->where('user_id',Auth()->user()->id)->count();

            if($test == 0)
                $vote = Like::create(['comment_id'=>$this->post_id,'user_id'=>Auth()->user()->id,'like'=> 0]);
            else
                $vote = Like::where('comment_id',$this->post_id)->where('user_id',Auth()->user()->id)->first();
            if ($vote->like < 1)
            {
                $vote->like ++;
                $vote->save();
            }
    }

    public function VoteDown()
    {
            $test = Like::where('comment_id', $this->post_id)->where('user_id', Auth()->user()->id)->count();
            if ($test == 0) {
                $vote = Like::create(['comment_id' => $this->post_id, 'user_id' => Auth()->user()->id, 'like' => 0]);
            } else {
                $vote = Like::where('comment_id', $this->post_id)->where('user_id', Auth()->user()->id)->first();
            }

            if ($vote->like > -1) {
                $vote->like--;
                $vote->save();
            }

    }
}
