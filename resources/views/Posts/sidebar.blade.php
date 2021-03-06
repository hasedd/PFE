<div class="hide-main-inner"></div>
<div class="hide-sidebar sidebar-width">
    <div class="hide-sidebar-inner"></div>
</div>
<aside class="sidebar sidebar-width float_l fixed-sidebar">
    <h3 class="screen-reader-text">Sidebar</h3>
    <div class="inner-sidebar">
        <div class="widget widget_ask">
            <a target="_self" href="http://template.test/add-question/" class="button-default wpqa-question">Ask A Question</a>
        </div>
        <section id="stats-widget-7" class="widget-no-divider widget stats-widget"><h3 class='screen-reader-text'>Stats</h3>
            <div class="widget-wrap">
                <ul class="stats-inner">
                    <li class="stats-questions">
                        <div>
                            <span class="stats-text">Questions</span>
                            <span class="stats-value"><?php $nbr=\App\Models\Post::where('type','Question')->count(); echo $nbr;?></span>
                        </div>
                    </li>
                    <li class="stats-answers">
                        <div>
                            <span class="stats-text">Answers</span>
                            <span class="stats-value"><?php $nbr=0;  $posts=\App\Models\Post::where('type','Question')->get(); foreach ($posts as $post) $nbr+=$post->comments->count(); echo $nbr ;?></span>
                        </div>
                    </li>
                    <li class="stats-best_answers">
                        <div>
                            <span class="stats-text">Best Answers</span>
                            <span class="stats-value"><?php $nbr=\App\Models\Post::where('state','Close')->count(); echo $nbr;?></span>
                        </div>
                    </li>
                    <li class="stats-users">
                        <div>
                            <span class="stats-text">Users</span>
                            <span class="stats-value"><?php $nbr=\App\Models\User::count(); echo $nbr;?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <div class='widget tabs-wrap widget-tabs'>
            <div class="widget-title widget-title-tabs">
                <ul class="tabs tabstabs-widget-4">
                    <li class="tab"><a href="#">Popular</a></li>
                    <li class="tab current"><a href="#">Answers</a></li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="widget-wrap">
                <div class='widget-posts tab-inner-wrap tab-inner-wraptabs-widget-4'><div class="user-notifications user-profile-area">
                        <div>
                            <ul>

                                <?php

                                $posts = \App\Models\Post::where('type','Question')->orderBy('votes','desc')->take(3)->get();
                                foreach( $posts as $post  ) {
                                    $html = $post->title ;
                                    preg_match('<(.*)>', $html, $match);
                                    $allez=$match[0];
                                    if(strlen($allez) < 50 )
                                        $allez2=$allez;
                                    else
                                        $allez2=substr($allez,0,50)."...";
                                    $route=route('Show_Question',[$post->id]);
                                    $answers=$post->comments->count();

                                    echo "<li class='widget-posts-text widget-no-img'><span class='span-icon'><a href=$route><img class='avatar avatar-20 photo' alt='root' title='root' width='20' height='20' srcset='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 1x, http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 2x' src='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g'></a></span><div><h3><a href=$route  title='How to approach applying for a job at a company owned by a friend?' rel='bookmark'>$allez2</a></h3><ul class='widget-post-meta'><li><a class='post-meta-comment' href=$route ><i class='icon-comment'></i>$answers Answers</a></li></ul></div>";
                                }
                                ?>

                            </ul></div>
                    </div></div><div class='tab-inner-wrap tab-inner-wraptabs-widget-4'>		<div class="user-notifications user-profile-area">
                        <div>
                            <ul>
                                <li>
															<span class="span-icon">
									<img class='avatar avatar-25 photo' alt='Martin Hope' title='Martin Hope' width='25' height='25' srcset='http://0.gravatar.com/avatar/cd684380902071de157a7354f605e411?s=96&d=mm&r=g 1x, http://0.gravatar.com/avatar/cd684380902071de157a7354f605e411?s=96&d=mm&r=g 2x' src='http://0.gravatar.com/avatar/cd684380902071de157a7354f605e411?s=96&d=mm&r=g'>								</span>
                                    <div>
                                        Martin Hope added an answer <span class="question-title"><a href="http://template.test/question/why-are-the-british-confused-about-us-calling-bread-rolls-biscuits-when-they-call-bread-rolls-puddings/#comment-72">They might be as confused as to why you keep&hellip;</a></span>
                                        <span class="notifications-date">April 19, 2018 at 2:07 am</span>
                                    </div>
                                </li>
                                <li>
															<span class="span-icon">
									<img class='avatar avatar-25 photo' alt='Marko Smith' title='Marko Smith' width='25' height='25' srcset='http://1.gravatar.com/avatar/14d56909719579f79b7caf5588b506c3?s=96&d=mm&r=g 1x, http://1.gravatar.com/avatar/14d56909719579f79b7caf5588b506c3?s=96&d=mm&r=g 2x' src='http://1.gravatar.com/avatar/14d56909719579f79b7caf5588b506c3?s=96&d=mm&r=g'>								</span>
                                    <div>
                                        Marko Smith added an answer <span class="question-title"><a href="http://template.test/question/why-are-the-british-confused-about-us-calling-bread-rolls-biscuits-when-they-call-bread-rolls-puddings/#comment-71">I have never heard a British person EVER call a&hellip;</a></span>
                                        <span class="notifications-date">April 19, 2018 at 2:07 am</span>
                                    </div>
                                </li>
                                <li>
															<span class="span-icon">
									<img class='avatar avatar-25 photo' alt='Barry Carter' title='Barry Carter' width='25' height='25' srcset='http://0.gravatar.com/avatar/31e9281c4993509a092dfbf5fe843321?s=96&d=mm&r=g 1x, http://0.gravatar.com/avatar/31e9281c4993509a092dfbf5fe843321?s=96&d=mm&r=g 2x' src='http://0.gravatar.com/avatar/31e9281c4993509a092dfbf5fe843321?s=96&d=mm&r=g'>								</span>
                                    <div>
                                        Barry Carter added an answer <span class="question-title"><a href="http://template.test/question/why-are-the-british-confused-about-us-calling-bread-rolls-biscuits-when-they-call-bread-rolls-puddings/#comment-70">Calling a bread roll a ???biscuit??? really takes the biscuit.&hellip;</a></span>
                                        <span class="notifications-date">April 19, 2018 at 2:07 am</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>					<script type='text/javascript'>
                    jQuery(document).ready(function(){
                        jQuery("ul.tabstabs-widget-4").tabs(".tab-inner-wraptabs-widget-4",{tabs: "li",effect:"slide",fadeInSpeed:100});
                    });
                </script>
            </div>
        </div>
        <section id="users-widget-4" class="widget users-widget"><h2 class="widget-title"><i class="icon-folder mb-4"></i>Top Members</h2>
            <?php
                $users= App\Models\User::orderBy('points','desc')->limit(4)->get()
            ?>
            @foreach($users as $user)
            <div class="widget-wrap mb-3">
                <div class="user-section user-section-small row user-not-normal">
                    <div class="col col12">
                        <div class="post-section user-area user-area-small">
                            <div class="post-inner">
                                <div class="author-image author-image-42">
                                    <a href="{{ route('userprofile',$user->id) }}">
                                        <span class="author-image-span">
                                            <img class="" alt="{{$user->username}}" title="{{$user->username}}" src="{{ $user->profile_photo_url }}" width="42" height="42">
                                        </span>
                                    </a>
                                </div>
                                <div class="user-content">
                                    <div class="user-inner"><h4><a href="http://template.test/profile/marko/">{{$user->username}}</a></h4>
                                        <div class="user-data">
                                            <ul>
                                                <li class="user-questions">
                                                    <a href="">
                                                        {{ count($user->posts) }} Posts
                                                    </a>
                                                </li>
                                                <li class="user-points">
                                                    <a href="http://template.test/profile/marko/points/">
                                                        {{ $user->points }} Points
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- End user-data -->
                                    </div>
                                </div><!-- End user-content -->
                                <div class="clearfix"></div>
                            </div><!-- End post-inner -->
                        </div><!-- End post -->
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <section id="tag_cloud-4" class="widget widget_tag_cloud"><h2 class="widget-title"><i class="icon-folder"></i>Trending Tags</h2><div class="tagcloud">
            <?php

            use App\Models\Post;
            $posts=Post::select('tags')->where('type','Question')->groupBy('tags')->get();
            foreach ($posts as $post) {
                $tags =explode ( "," , $post->tags );
                foreach($tags as $tag)
                { $route="#";
                    echo " <a href=$route class='tag-cloud-link tag-link-4 tag-link-position-1' style='font-size: 22pt;' aria-label='analytics (3 items)'>$tag</a>" ;
                }}
            $nbQ=Post::where('type','Question')->count();
            ?>



            <!--
                <a href="http://template.test/question-tag/analytics/" class="tag-cloud-link tag-link-4 tag-link-position-1" style="font-size: 22pt;" aria-label="analytics (3 items)">analytics</a>
                <a href="http://template.test/question-tag/british/" class="tag-cloud-link tag-link-5 tag-link-position-2" style="font-size: 8pt;" aria-label="british (1 item)">british</a>
                <a href="http://template.test/question-tag/company/" class="tag-cloud-link tag-link-8 tag-link-position-3" style="font-size: 16.4pt;" aria-label="company (2 items)">company</a>
                <a href="http://template.test/question-tag/computer/" class="tag-cloud-link tag-link-9 tag-link-position-4" style="font-size: 8pt;" aria-label="computer (1 item)">computer</a>
                <a href="http://template.test/question-tag/developers/" class="tag-cloud-link tag-link-10 tag-link-position-5" style="font-size: 8pt;" aria-label="developers (1 item)">developers</a>
                <a href="http://template.test/question-tag/django/" class="tag-cloud-link tag-link-11 tag-link-position-6" style="font-size: 8pt;" aria-label="django (1 item)">django</a>
                <a href="http://template.test/question-tag/employee/" class="tag-cloud-link tag-link-12 tag-link-position-7" style="font-size: 8pt;" aria-label="employee (1 item)">employee</a>
                <a href="http://template.test/question-tag/employer/" class="tag-cloud-link tag-link-13 tag-link-position-8" style="font-size: 8pt;" aria-label="employer (1 item)">employer</a>
                <a href="http://template.test/question-tag/english/" class="tag-cloud-link tag-link-14 tag-link-position-9" style="font-size: 22pt;" aria-label="english (3 items)">english</a>
                <a href="http://template.test/question-tag/facebook/" class="tag-cloud-link tag-link-15 tag-link-position-10" style="font-size: 8pt;" aria-label="facebook (1 item)">facebook</a>
                <a href="http://template.test/question-tag/french/" class="tag-cloud-link tag-link-16 tag-link-position-11" style="font-size: 8pt;" aria-label="french (1 item)">french</a>
                <a href="http://template.test/question-tag/google/" class="tag-cloud-link tag-link-17 tag-link-position-12" style="font-size: 16.4pt;" aria-label="google (2 items)">google</a>
                <a href="http://template.test/question-tag/interview/" class="tag-cloud-link tag-link-18 tag-link-position-13" style="font-size: 8pt;" aria-label="interview (1 item)">interview</a>
                <a href="http://template.test/question-tag/javascript/" class="tag-cloud-link tag-link-19 tag-link-position-14" style="font-size: 8pt;" aria-label="javascript (1 item)">javascript</a>
                <a href="http://template.test/question-tag/language/" class="tag-cloud-link tag-link-21 tag-link-position-15" style="font-size: 22pt;" aria-label="language (3 items)">language</a>
                <a href="http://template.test/question-tag/life/" class="tag-cloud-link tag-link-22 tag-link-position-16" style="font-size: 8pt;" aria-label="life (1 item)">life</a>
                <a href="http://template.test/question-tag/php/" class="tag-cloud-link tag-link-24 tag-link-position-17" style="font-size: 8pt;" aria-label="php (1 item)">php</a>
                <a href="http://template.test/question-tag/programmer/" class="tag-cloud-link tag-link-25 tag-link-position-18" style="font-size: 8pt;" aria-label="programmer (1 item)">programmer</a>
                <a href="http://template.test/question-tag/programs/" class="tag-cloud-link tag-link-28 tag-link-position-19" style="font-size: 16.4pt;" aria-label="programs (2 items)">programs</a>
                <a href="http://template.test/question-tag/salary/" class="tag-cloud-link tag-link-29 tag-link-position-20" style="font-size: 8pt;" aria-label="salary (1 item)">salary</a>
                <a href="http://template.test/question-tag/university/" class="tag-cloud-link tag-link-31 tag-link-position-21" style="font-size: 8pt;" aria-label="university (1 item)">university</a> -->
            </div> </section>

    </div>
</aside><!-- End sidebar -->
