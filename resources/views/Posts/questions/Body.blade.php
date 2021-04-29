
<x-app-layout>

                <div class="put-wrap-pop"></div>
                <div class="panel-pop panel-pop-login" id="wpqa-question" data-width="690">
                    <i class="icon-cancel"></i>
                    <div class="panel-pop-content">
                        <form class="form-post wpqa_form" action="{{route('Add_Question')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-inputs clearfix">
                                <p>
                                    <label for="question-title-451">Question Title<span class="required">*</span></label>
                                    <input name="title" id="question-title-451" class="the-title" type="text" value="" required>
                                    <i class="icon-chat"></i>
                                    <span class="form-description">Please choose an appropriate title for the question so it can be answered easily.</span>
                                </p>
                                <div class="wpqa_category">
                                    <label for="question-category-451">Category<span class="required">*</span></label>
                                    <span class="styled-select">
                    <select  name='category' id='question-category-451' class='postform' required>
	                    <option value='-1'>Select a Category</option>
	                    @foreach($categories as $category)
                            <option class="level-0" value={{$category->name}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    </span>
                                    <i class="icon-folder"></i>
                                    <span class="form-description">Please choose the appropriate section so the question can be searched easily.</span>
                                </div>
                                <p class="wpqa_tag">
                                    <label for="question_tags-451">Tags</label>
                                    <input type="text" class="input question_tags" name="tags" id="question_tags-451" value="" data-seperator="," required>
                                    <span class="form-description">Please choose suitable Keywords Ex: <span class="color">question, poll</span>.</span>
                                </p>
                                <!--<p class="wpqa_checkbox_p wpqa_checkbox_poll">
                                    <label for="question_poll-451">
                                        <span class="wpqa_checkbox"><input type="checkbox" id="question_poll-451" class="question_poll" value="on" name="question_poll"></span>
                                        <span class="wpqa_checkbox_span">Is this question is a poll? If you want to be doing a poll click here.</span>
                                    </label>
                                </p>

                                <div class="clearfix"></div>
                                <div class="poll_options wpqa_hide"><p class="wpqa_checkbox_p">
                                        <label for="question_image_poll-451">
                                            <span class="wpqa_checkbox"><input type="checkbox" id="question_image_poll-451" class="question_image_poll" value="on" name="question_image_poll"></span>
                                            <span class="wpqa_checkbox_span">Image poll?</span>
                                        </label>
                                    </p>
                                    <div class="clearfix"></div><ul class="question_items question_polls_item"><li id="poll_li_1"><div class="poll-li">
                                                <p class="poll_title_p">
                                                    <input class="ask" name="ask[1][title]" value="" type="text">
                                                    <i class="icon-comment"></i>
                                                </p>
                                                <input name="ask[1][id]" value="1" type="hidden">
                                                <div class="del-item-li"><i class="icon-cancel"></i></div>
                                                <div class="move-poll-li"><i class="icon-menu"></i></div>
                                            </div>
                                        </li>
                                        <li id="poll_li_2"><div class="poll-li">
                                                <p class="poll_title_p">
                                                    <input class="ask" name="ask[2][title]" value="" type="text">
                                                    <i class="icon-comment"></i>
                                                </p>
                                                <input name="ask[2][id]" value="2" type="hidden">
                                                <div class="del-item-li"><i class="icon-cancel"></i></div>
                                                <div class="move-poll-li"><i class="icon-menu"></i></div>
                                            </div>
                                        </li></ul>
                                    <button type="button" class="button-default-3 add_poll_button_js">Add More Answers</button>
                                    <div class="clearfix"></div>
                                </div>-->
                                <div class="question-multiple-upload question-upload-featured">
                                    <label for="featured_image-451">Add file</label>
                                    <div class="clearfix"></div>
                                    <div class="fileinputs">
                                        <input type="file" class="file" name="file" id="featured_image-451">
                                        <i class="icon-camera"></i>
                                        <div class="fakefile">
                                            <button type="button">Select file</button> <span>Browse</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="wpqa_textarea">
                                    <label for="question-details-add-451">Details<span class="required">*</span></label>
                                    <div class="the-details the-textarea">
                                        <div id="wp-question-details-add-451-wrap" class="wp-core-ui wp-editor-wrap tmce-active"><link rel='stylesheet' id='editor-buttons-css'  href='Dassets/wp-includes/css/editor.min.css?ver=5.7' type='text/css' media='all' />
                                            <div id="wp-question-details-add-451-editor-container" class="wp-editor-container">
                                                <div id="qt_question-details-add-451_toolbar" class="quicktags-toolbar"></div>
                                                <textarea class="wp-editor-area" rows="10" autocomplete="off" cols="40" name="content" id="question-details-add-451" required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <span class="form-description">Type the description thoroughly and in details.</span>
                                </div>
                                <!--<p class="wpqa_checkbox_p ask_remember_answer_p">
                                    <label for="remember_answer-451">
                                        <span class="wpqa_checkbox"><input type="checkbox" id="remember_answer-451" class="remember_answer" name="remember_answer" value="on" checked='checked'></span>
                                        <span class="wpqa_checkbox_span">Get notified by email when someone answers this question.</span>
                                    </label>
                                    </p>-->
                                <p class="wpqa_checkbox_p">
                                    <label for="terms_active-451">
                                        <span class="wpqa_checkbox"><input type="checkbox" id="terms_active-451" name="terms_active" value="on" ></span>
                                        <span class="wpqa_checkbox_span">By asking your question, you agree to the
						<a target="_blank" href="http://template.test/faqs/"> Terms of Service </a>  and <a target="_blank" href="http://template.test/faqs/"> Privacy Policy </a>.<span class="required">*</span></span>
                                    </label>
                                </p>
                            </div>

                            <p class="form-submit"><input type="hidden" name="question_popup" value="popup"><input type="hidden" name="form_type" value="add_question">
                                <input type="hidden" name="wpqa_add_question_nonce" value="468aff96d4">
                                <input type="submit" value="Publish Your Question" class="button-default button-hide-click">
                                <span class="load_span"><span class="loader_2"></span></span>
                            </p>

                        </form>
                    </div><!-- End panel-pop-content -->
                </div><!-- End wpqa-question -->

                <div class="panel-pop panel-pop-login" id="wpqa-report">
                    <i class="icon-cancel"></i>
                    <div class="panel-pop-content">
                        <p>Please briefly explain why you feel this answer should be reported.</p>
                        <form class="wpqa_form submit-report" method="post">
                            <div class="wpqa_error"></div>
                            <div class="wpqa_success"></div>
                            <div class="form-inputs clearfix">
                                <p class="login-text">
                                    <label for="explain-reported">Explain<span class="required">*</span></label>
                                    <textarea id="explain-reported" name="explain"></textarea>
                                    <i class="icon-pencil"></i>
                                </p>
                            </div>
                            <p class="form-submit">
                                <span class="load_span"><span class="loader_2"></span></span>
                                <input type="hidden" id="wpqa_report_nonce" name="wpqa_report_nonce" value="52e42f9a8a" />
                                <input type="submit" value="Report" class="button-default button-hide-click">
                            </p>
                            <input type="hidden" name="form_type" value="wpqa-report">
                            <input type="hidden" name="post_id" value="64">
                        </form>
                    </div><!-- End panel-pop-content -->
                </div><!-- End wpqa-report -->

                <div id="wrap" class="wrap-login">
                    <div class="main-content">
                        <div class="discy-inner-content menu_sidebar">
                            <div class="the-main-container">
                                <main class="all-main-wrap discy-site-content float_l">
                                    <div class="the-main-inner float_l">
                                        <div class="clearfix"></div><div id="row-tabs-home" class="row row-tabs">
                                            <div class="col col12">
                                                <div class="wrap-tabs">
                                                    <div class="menu-tabs">
                                                        <ul class="menu flex menu-tabs-desktop">
                                                            <li class='active-tab'>
                                                                <a href="http://template.test/?show=recent-questions">
                                                                    Recent Questions						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=most-answered">
                                                                    Most Answered						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=question-bump">
                                                                    Bump Question						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=answers">
                                                                    Answers						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=most-visited">
                                                                    Most Visited						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=most-voted">
                                                                    Most Voted						</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://template.test/?show=no-answers">
                                                                    No Answers						</a>
                                                            </li>
                                                        </ul>
                                                        <div class="discy_hide mobile-tabs"><span class="styled-select"><select class="home_categories">					<option selected='selected' value="http://template.test/?show=recent-questions">
				Recent Questions					</option>
									<option value="http://template.test/?show=most-answered">
				Most Answered					</option>
									<option value="http://template.test/?show=question-bump">
				Bump Question					</option>
									<option value="http://template.test/?show=answers">
				Answers					</option>
									<option value="http://template.test/?show=most-visited">
				Most Visited					</option>
									<option value="http://template.test/?show=most-voted">
				Most Voted					</option>
									<option value="http://template.test/?show=no-answers">
				No Answers					</option>
				</select></span></div>
                                                    </div><!-- End menu-tabs -->
                                                </div><!-- End wrap-tabs -->
                                            </div><!-- End col9 -->
                                        </div><!-- End row -->

                                        <section>
                                            <h2 class="screen-reader-text">Discy Latest Questions</h2>
                                            <div class="post-articles question-articles">
                                                @foreach($posts as $post)
                                                    <article id="post-118" class="article-question article-post clearfix question-answer-before question-with-comments answer-question-not-jquery question-vote-image discoura-not-credential question-type-normal post-118 question type-question status-publish hentry question-category-language question_tags-english question_tags-language">
                                                        <div class="question-sticky-ribbon">
                                                            <div>{{$post->state}}</div>
                                                        </div>
                                                        <div class="single-inner-content">
                                                            <div class="question-inner">
                                                                <div class="question-image-vote">
                                                                    <div class="author-image author-image-42">
                                                                        <a href="http://template.test/profile/root/">
                                                                            <span class="author-image-span"><img class='avatar avatar-42 photo' alt='root' title='root' width='42' height='42' srcset='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 1x, http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 2x' src='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g'></span></a><div class="author-image-pop-2">
                                                                            <div class="post-section user-area user-area-columns_pop">
                                                                                <div class="post-inner"><div class="author-image author-image-70">
                                                                                        <a href="http://template.test/profile/root/"><span class="author-image-span"><img class='avatar avatar-70 photo' alt='root' title='root' width='70' height='70' srcset='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 1x, http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g 2x' src='http://2.gravatar.com/avatar/eec3a616e54e25bb4c28e3f7d9380092?s=96&d=mm&r=g'></span></a></div>
                                                                                    <div class="user-content">
                                                                                        <div class="user-inner">
                                                                                            <div class="user-data-columns">
                                                                                                <h4><a href="http://template.test/profile/root/">{{$post->user->username}}</a></h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- End user-content -->
                                                                                    <div class="user-columns-data">
                                                                                        <ul>
                                                                                            <li class="user-columns-questions">
                                                                                                <a href="http://template.test/profile/root/questions/">
                                                                                                    <i class="icon-book-open"></i>{{ count($post->user->posts) }} Posts
                                                                                                </a>
                                                                                            </li>
                                                                                            <li class="user-columns-answers">
                                                                                                <a href="http://template.test/profile/root/answers/">
                                                                                                    <i class="icon-comment"></i>{{ count($post->user->comments) }} Answers
                                                                                                </a>
                                                                                            </li>
                                                                                            <li class="user-columns-best-answers">
                                                                                                <a href="http://template.test/profile/root/best-answers/">
                                                                                                    <i class="icon-graduation-cap"></i>{{ count($post->user->comments) }} Best Answers
                                                                                                </a>
                                                                                            </li>
                                                                                            <li class="user-columns-points">
                                                                                                <a href="http://template.test/profile/root/points/">
                                                                                                    <i class="icon-bucket"></i>0 Points
                                                                                                </a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div><!-- End user-columns-data --><div class="user-follow-profile"><a href="http://template.test/profile/root/">View Profile</a></div><!-- End user-follow-profile --><div class="clearfix"></div>
                                                                                </div><!-- End post-inner -->
                                                                            </div><!-- End post -->
                                                                        </div>
                                                                    </div>
                                                                    <ul class="question-vote question-mobile">
                                                                        <li class="question-vote-up"><a href="#" data-type="question" data-vote-type="up" class="wpqa_vote question_vote_up vote_not_allow" title="Like"><i class="icon-up-dir"></i></a></li>
                                                                        <li class="vote_result" itemprop="upvoteCount">2</li>
                                                                        <li class="li_loader"><span class="loader_3 fa-spin"></span></li>
                                                                        <li class="question-vote-down"><a href="#" data-type="question" data-vote-type="down" class="wpqa_vote question_vote_down vote_not_allow" title="Dislike"><i class="icon-down-dir"></i></a></li>
                                                                    </ul>
                                                                </div><!-- End question-image-vote -->
                                                                <div class="question-content question-content-first">
                                                                    <header class="article-header">
                                                                        <div class="question-header">
                                                                            <a class="post-author" itemprop="url" href="http://template.test/profile/root/">{{$post->user->useable->firstName}}</a>
                                                                            <div class="post-meta">
                                                            <span class="post-date">Asked:
																<span class="date-separator"></span>
																<a href="http://template.test/question/is-this-statement-i-see-him-last-night-can-be-understood-as-i-saw-him-last-night/" itemprop="url"><time class="entry-date published">{{date($post->created_at)}}</time></a>
															</span>
                                                                                <span class="byline">
																<span class="post-cat">In: <a href="http://template.test/question-category/language/" rel="tag">{{$post->category->name}}</a></span>
															</span>
                                                                            </div>
                                                                        </div>
                                                                    </header>
                                                                    <div>
                                                                        <h2 class="post-title"><a class="post-title" href="http://template.test/question/is-this-statement-i-see-him-last-night-can-be-understood-as-i-saw-him-last-night/" rel="bookmark">{{$post->title}}</a></h2>	</div>
                                                                </div><!-- End question-content-first -->
                                                                <div class="question-not-mobile question-image-vote question-vote-sticky">
                                                                    <div class="">
                                                                        <ul class="question-vote">
                                                                            <li class="question-vote-up"><a href="#" data-type="question" data-vote-type="up" class="wpqa_vote question_vote_up vote_not_allow" title="Like"><i class="icon-up-dir"></i></a></li>
                                                                            <li class="vote_result" itemprop="upvoteCount">2</li>
                                                                            <li class="li_loader"><span class="loader_3 fa-spin"></span></li>
                                                                            <li class="question-vote-down"><a href="#" data-type="question" data-vote-type="down" class="wpqa_vote question_vote_down vote_not_allow" title="Dislike"><i class="icon-down-dir"></i></a></li>
                                                                        </ul>
                                                                    </div><!-- End question-sticky -->
                                                                </div><!-- End question-image-vote -->
                                                                <div class="question-content question-content-second">
                                                                    <div class="post-wrap-content">
                                                                        <div class="question-content-text">
                                                                            <div class='all_not_signle_post_content'>
                                                                                <?php
                                                                                $html = $post->content ;
                                                                                preg_match('<(.*)>', $html, $match);
                                                                                $allez=$match[0];
                                                                                if(strlen($allez)<213)
                                                                                    echo "<p class=\"excerpt-question\"> $allez </p>";
                                                                                else { $allez2=substr($allez,0,213)."...";
                                                                                    echo "<p class=\"excerpt-question\"> $allez2</p>";}
                                                                                ?>
                                                                            </div><!-- End all_not_signle_post_content -->
                                                                        </div>
                                                                        <div class="tagcloud">
                                                                            <div class="question-tags"><i class="icon-tags"></i>
                                                                                <?php
                                                                                $tags =explode ( "," , $post->tags );
                                                                                foreach($tags as $tag)
                                                                                    echo "<a href=\"#\">$tag</a>"
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="wpqa_error"></div>
                                                                    <div class="wpqa_success"></div>
                                                                    <footer class="question-footer">
                                                                        <ul class="footer-meta">
                                                                            <li class="best-answer-meta"><a href="http://template.test/question/is-this-statement-i-see-him-last-night-can-be-understood-as-i-saw-him-last-night/#comments"><i class="icon-comment"></i><span class='number discy_hide'></span> <span class='question-span'>{{count($post->comments)}} Answers</span></a></li>
                                                                            <li class="view-stats-meta"><i class="icon-eye"></i>{{$post->views}} <span class='question-span'>Views</span></li>
                                                                        </ul>
                                                                        <a class="meta-answer meta-answer-a" href="http://template.test/question/is-this-statement-i-see-him-last-night-can-be-understood-as-i-saw-him-last-night/#respond">Answer</a>
                                                                    </footer>
                                                                </div><!-- End question-content-second -->
                                                                <div class="clearfix"></div>
                                                            </div><!-- End question-inner -->
                                                        </div><!-- End single-inner-content -->
                                                    </article><!-- End article -->
                                                @endforeach
                                            </div><!-- End post-articles -->
                                            <script type="text/javascript">
                                                (function($) {
                                                    jQuery(document).ready(function() {
                                                        /* Load more */
                                                        function wpqa_load_more(load_type,j_this,ajax_new_count) {
                                                            var main_content = ".the-main-inner";
                                                            if (load_type == "infinite-scroll") {
                                                                var $link = jQuery('.posts-infinite-scroll a');
                                                            }else {
                                                                var $link = j_this;
                                                            }
                                                            var page_url = $link.attr("href");
                                                            if (page_url != undefined) {
                                                                if (load_type == "infinite-scroll") {
                                                                    $link.parent().parent().animate({ opacity: 1}, 300).css('padding', '10px');
                                                                }else {
                                                                    $link.closest(main_content).find(".posts-"+load_type+" a").hide();
                                                                }
                                                                $link.closest(main_content).find(".posts-"+load_type+" .load_span").show();
                                                                jQuery("<div>").load(page_url, function() {
                                                                    var n = ajax_new_count.toString();
                                                                    var $wrap = $link.closest(main_content).find('.post-articles.question-articles');
                                                                    var $new = jQuery(this).find('.post-articles article.question').addClass('post-section-new-'+n);
                                                                    var $this_div = jQuery(this);
                                                                    $new.imagesLoaded( function() {
                                                                        $new.hide().appendTo($wrap).fadeIn(400);
                                                                        /* Lightbox */
                                                                        var lightboxArgs = {
                                                                            animation_speed: "fast",
                                                                            overlay_gallery: true,
                                                                            autoplay_slideshow: false,
                                                                            slideshow: 5000,
                                                                            theme: "pp_default",
                                                                            opacity: 0.8,
                                                                            show_title: false,
                                                                            social_tools: "",
                                                                            deeplinking: false,
                                                                            allow_resize: true,
                                                                            counter_separator_label: "/",
                                                                            default_width: 940,
                                                                            default_height: 529
                                                                        };
                                                                        jQuery("a[href$=jpg],a[href$=JPG],a[href$=jpeg],a[href$=JPEG],a[href$=png],a[href$=gif],a[href$=bmp]:has(img)").prettyPhoto(lightboxArgs);
                                                                        jQuery("a[class^='prettyPhoto'],a[rel^='prettyPhoto']").prettyPhoto(lightboxArgs);
                                                                        /* Facebook */
                                                                        jQuery(".facebook-remove").remove();
                                                                        /* Owl */
                                                                        jQuery(".post-section-new-"+n+" .slider-owl").each(function () {
                                                                            var $slider = jQuery(this);
                                                                            var $slider_item = $slider.find('.slider-item').length;
                                                                            $slider.find('.slider-item').css({"height":"auto"});
                                                                            if ($slider.find('img').length) {
                                                                                var $slider = jQuery(this).imagesLoaded(function() {
                                                                                    $slider.owlCarousel({
                                                                                        autoPlay: 5000,
                                                                                        margin: 10,
                                                                                        responsive: {
                                                                                            0: {
                                                                                                items: 1
                                                                                            }
                                                                                        },
                                                                                        stopOnHover: true,
                                                                                        navText : ["", ""],
                                                                                        nav: ($slider_item > 1)?true:false,
                                                                                        rtl: jQuery('body.rtl').length?true:false,
                                                                                        loop: ($slider_item > 1)?true:false,
                                                                                    });
                                                                                });
                                                                            }else {
                                                                                $slider.owlCarousel({
                                                                                    autoPlay: 5000,
                                                                                    margin: 10,
                                                                                    responsive: {
                                                                                        0: {
                                                                                            items: 1
                                                                                        }
                                                                                    },
                                                                                    stopOnHover: true,
                                                                                    navText : ["", ""],
                                                                                    nav: ($slider_item > 1)?true:false,
                                                                                    rtl: jQuery('body.rtl').length?true:false,
                                                                                    loop: ($slider_item > 1)?true:false,
                                                                                });
                                                                            }
                                                                        });
                                                                        /* Question masonry */
                                                                        if (jQuery(".post-section-new-"+n+".post-with-columns").length) {
                                                                            if ($new.eq(0).is('.question-masonry')) {
                                                                                var newItems = jQuery('.post-section-new-'+n);
                                                                                jQuery('.question-articles').isotope( 'insert', newItems );
                                                                                jQuery('.question-articles').isotope({
                                                                                    filter: "*",
                                                                                    animationOptions: {
                                                                                        duration: 750,
                                                                                        itemSelector: '.question-masonry',
                                                                                        easing: "linear",
                                                                                        queue: false,
                                                                                    }
                                                                                });
                                                                                setTimeout(function() {
                                                                                    if ($new.eq(0).is('.post-masonry')) {
                                                                                        jQuery('.question-articles').isotope({
                                                                                            filter: "*",
                                                                                            animationOptions: {
                                                                                                duration: 750,
                                                                                                itemSelector: '.question-masonry',
                                                                                                easing: "linear",
                                                                                                queue: false,
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                }, 1000);
                                                                            }else {
                                                                                jQuery(".post-section-new-"+n+".post-with-columns").matchHeight();
                                                                                jQuery(".post-section-new-"+n+".post-with-columns > .article-question").matchHeight();
                                                                            }
                                                                        }
                                                                        /* Poll */
                                                                        if (jQuery(".post-section-new-"+n+" .progressbar-percent").length) {
                                                                            jQuery(".post-section-new-"+n+" .progressbar-percent").each(function(){
                                                                                var $this = jQuery(this);
                                                                                var percent = $this.attr("attr-percent");
                                                                                $this.bind("inview", function(event, isInView, visiblePartX, visiblePartY) {
                                                                                    if (isInView) {
                                                                                        $this.animate({ "width" : percent + "%"}, 700);
                                                                                    }
                                                                                });
                                                                            });
                                                                        }
                                                                        /* Audio */
                                                                        if ($new.eq(0).find('.wp-audio-shortcode')) {
                                                                            mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
                                                                            mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');
                                                                            jQuery(function () {
                                                                                var settings = {};
                                                                                if ( typeof _wpmejsSettings !== 'undefined' ) {
                                                                                    settings = _wpmejsSettings;
                                                                                }
                                                                                settings.success = settings.success || function (mejs) {
                                                                                    var autoplay, loop;
                                                                                    if ( 'flash' === mejs.pluginType ) {
                                                                                        autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
                                                                                        loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
                                                                                        autoplay && mejs.addEventListener( 'canplay', function () {
                                                                                            mejs.play();
                                                                                        }, false );
                                                                                        loop && mejs.addEventListener( 'ended', function () {
                                                                                            mejs.play();
                                                                                        }, false );
                                                                                    }
                                                                                };
                                                                                jQuery('.post-section-new-'+n+' .wp-audio-shortcode').mediaelementplayer( settings );
                                                                            });
                                                                        }
                                                                        $link.closest(main_content).find(".posts-"+load_type+" .load_span").hide();
                                                                        if (load_type == "load-more") {
                                                                            $link.closest(main_content).find(".posts-"+load_type+" a").show();
                                                                        }
                                                                        /* Content */
                                                                        jQuery(".all-main-wrap,.fixed-sidebar,.fixed_nav_menu").css({"height":"auto"});
                                                                        /* load more */
                                                                        if ($this_div.find(".posts-"+load_type).length) {
                                                                            if (load_type == "infinite-scroll") {
                                                                                $link.closest(main_content).find(".posts-infinite-scroll").html($this_div.find(".posts-infinite-scroll").html()).animate({opacity: 0}, 300).css("padding","0");
                                                                            }else {
                                                                                $link.closest(main_content).find(".posts-"+load_type).html($this_div.find(".posts-"+load_type).html());
                                                                            }
                                                                        }else {
                                                                            $link.closest(main_content).find(".pagination-wrap").html('<p class="no-comments">No more questions</p>');
                                                                            $link.closest(main_content).find(".posts-"+load_type).fadeOut("fast").remove();
                                                                        }
                                                                        jQuery("post-section-new-"+n).removeClass("post-section-new-"+n);
                                                                        return false;
                                                                    });
                                                                });
                                                            }
                                                        }
                                                        var ajax_new_count = 0;
                                                        /* infinite scroll */
                                                        jQuery(".posts-infinite-scroll").each (function () {
                                                            jQuery(this).bind("inview",function(event,isInView,visiblePartX,visiblePartY) {
                                                                if  (jQuery(".posts-infinite-scroll").length && isInView) {
                                                                    /* wpqa_load_more */
                                                                    ajax_new_count++;
                                                                    wpqa_load_more("infinite-scroll","",ajax_new_count);
                                                                }
                                                            });
                                                        });
                                                        /* load more */
                                                        jQuery("body").on("click",".posts-load-more a",function(e) {
                                                            e.preventDefault();
                                                            /* wpqa_load_more */
                                                            ajax_new_count++;
                                                            wpqa_load_more("load-more",jQuery(this),ajax_new_count);
                                                        });
                                                    });
                                                })(jQuery);
                                            </script>

                                            <div class="clearfix"></div>
                                            <div class="pagination-wrap pagination-question">
                                                <div class="pagination-nav posts-load-more">
                                                    <span class="load_span"><span class="loader_2"></span></span>
                                                    <div class="load-more"><a href="http://template.test/page/2/" >Load More Questions</a></div>
                                                </div><!-- End pagination-nav -->
                                            </div>
                                        </section><!-- End section -->

                                    </div><!-- End the-main-inner -->

                                    <!--  --------------------------   Side bar    --------------------------- -->
                                        @include('Posts.sidebar')

                                </main><!-- End discy-site-content -->

                                <!--  --------------------------   Nav bar    --------------------------- -->
                                @include('Posts.navbar')

                            </div><!-- End the-main-container -->
                        </div><!-- End discy-inner-content -->
                    </div><!-- End main-content -->

                    <!--       ---------------------              FOOTER              --------------------------         -->

                </div><!-- End wrap -->
</x-app-layout>
