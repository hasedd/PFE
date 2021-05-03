<div class="">
    <ul class="question-vote">
        <li class="question-vote-up"><a wire:click.prevent="VoteUp" href="#" class="wpqa_vote question_vote_up vote_not_allow" title="Like"><i class="icon-up-dir"></i></a></li>
        <li class="vote_result" itemprop="upvoteCount">{{$Votes}}</li>
        <li class="li_loader"><span class="loader_3 fa-spin"></span></li>
        <li class="question-vote-down"><a wire:click.prevent="VoteDown" href="#"  class="wpqa_vote question_vote_down vote_not_allow" title="Dislike"><i class="icon-down-dir"></i></a></li>
    </ul>
</div><!-- End question-sticky -->
