<ul class="question-vote answer-vote answer-vote-dislike">
    <li><a wire:click="VoteUp" href="#" id="comment_vote_up-64" data-type="comment" data-vote-type="up" class="wpqa_vote comment_vote_up vote_allow" title="Like"><i class="icon-up-dir"></i></a></li>
    <li class="vote_result" itemprop="upvoteCount">{{$Likes}}</li>
    <li class="li_loader"><span class="loader_3 fa-spin"></span></li>
    <li class="dislike_answers"><a wire:click="VoteDown" href="#" id="comment_vote_down-64" data-type="comment" data-vote-type="down" class="wpqa_vote comment_vote_down vote_allow" title="Dislike"><i class="icon-down-dir"></i></a></li>
</ul>
