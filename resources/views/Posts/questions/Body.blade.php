
<x-app-layout>
                <header class="bg-gray-light shadow">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    </div>
                </header>
                @include('Posts.Question&report_form')
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
                                                            <li class="ml-9 <?php if($i==2) echo "ml-2 active-tab" ?>" >
                                                                <a href="{{route('QuestionBody')}}">
                                                                    Recent Questions						</a>
                                                            </li>


                                                            <li class="ml-5 <?php if($i==5) echo "ml-3 active-tab" ?>" >
                                                                <a href="{{route('answered')}}">
                                                                    Answered						</a>
                                                            </li>
                                                            <li  class="ml-5 <?php if($i==3) echo "ml-3 active-tab" ?>" >
                                                                <a href="{{route('Most_visited')}}">
                                                                    Most Visited						</a>
                                                            </li>
                                                            <li class="ml-5 <?php if($i==4) echo "ml-3 active-tab" ?> ">
                                                                <a href="{{route('Most_Voted')}}">
                                                                    Most Voted						</a>
                                                            </li>
                                                            <li class="ml-5 <?php if($i==6) echo "ml-3 active-tab" ?>" >
                                                                <a href="{{route('Not_answered')}}">
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
                                                                        <a href="{{ route('userprofile',$post->user->id) }}">
                                                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->username }}" />
                                                                            </button>
                                                                        </a>
                                                                        <div class="author-image-pop-2">
                                                                            <div class="post-section user-area user-area-columns_pop">
                                                                                    <div class="post-inner">
                                                                                        <div class="author-image author-image-70">
                                                                                             <a href="http://template.test/profile/root/"><span><img  alt='root' title='root'  src="{{ $post->user->profile_photo_url }}"></span></a>
                                                                                        </div>
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
                                                                        <li class="vote_result" itemprop="upvoteCount">
                                                                            {{$post->votes}}</li>
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
                                                                        <h2 class="post-title"><a class="post-title" href="{{route('addview',['post_id'=>$post->id])}}" rel="bookmark">{{$post->title}}</a></h2>
                                                                    </div>
                                                                </div>
                                                                <div class="question-not-mobile question-image-vote question-vote-sticky">
                                                                    @livewire('voteit',['post_id'=>$post->id,'var'=>0])
                                                                </div><!-- End question-image-vote -->
                                                                <div class="question-content question-content-second">
                                                                    <div class="post-wrap-content">
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
                                                                                    @if($post->file != null)
                                                                                        <h5 style="text-decoration: blink;"> This question is supported by a file. <a class='question-delete' href="{{route('addview',['post_id'=>$post->id])}}" style="color: #0072fd; "><u><b>Check it</b></u></a> </h5>
                                                                                    @endif
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
                                                                        <a class="meta-answer meta-answer-a" href="{{route('addview',['post_id'=>$post->id])}}">Answer</a>
                                                                    </footer>
                                                                </div><!-- End question-content-second -->
                                                                <div class="clearfix"></div>
                                                            </div><!-- End question-inner -->
															</div>
                                                        </div><!-- End single-inner-content -->
                                                    </article><!-- End article -->
                                                @endforeach
                                            </div><!-- End post-articles -->
											<a wire:click="load" class="btn btn-dark" href="#"  >Load More Questions</a>
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
    <link rel='stylesheet' id='buttons-css'  href="{{asset('Dassets/wp-includes/css/buttons.min.css?ver=5.7')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='mediaelement-css'  href="{{asset('Dassets/wp-includes/js/mediaelement/mediaelementplayer-legacy.min.css?ver=4.2.16')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='wp-mediaelement-css'  href="{{asset('Dassets/wp-includes/js/mediaelement/wp-mediaelement.min.css?ver=5.7')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='media-views-css'  href="{{asset('Dassets/wp-includes/css/media-views.min.css?ver=5.7')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='imgareaselect-css'  href="{{asset('Dassets/wp-includes/js/imgareaselect/imgareaselect.css?ver=0.9.8')}}" type='text/css' media='all' />
    <link rel='stylesheet' id='thickbox-css'  href="{{asset('Dassets/wp-includes/js/thickbox/thickbox.css?ver=5.7')}}" type='text/css' media='all' />
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/hoverintent-js.min.js?ver=2.2.1')}}" id='hoverintent-js-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/admin-bar.min.js?ver=5.7')}}" id='admin-bar-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/plugins/WPQA/assets/js/scripts.js?ver=4.4.4')}}" id='wpqa-scripts-js-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/core.min.js?ver=1.12.1')}}" id='jquery-ui-core-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.12.1')}}" id='jquery-ui-datepicker-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/mouse.min.js?ver=1.12.1')}}" id='jquery-ui-mouse-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/sortable.min.js?ver=1.12.1')}}" id='jquery-ui-sortable-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/plugins/WPQA/assets/js/custom.js?ver=4.4.4')}}" id='wpqa-custom-js-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=7.4.4')}}" id='wp-polyfill-js'></script>

    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/hooks.min.js?ver=50e23bed88bcb9e6e14023e9961698c1')}}" id='wp-hooks-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/i18n.min.js?ver=db9a9a37da262883343e941c3731bc67')}}" id='wp-i18n-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/vendor/lodash.min.js?ver=4.17.19')}}" id='lodash-js'></script>
    <script type='text/javascript' id='lodash-js-after'>
        window.lodash = _.noConflict();
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/url.min.js?ver=0ac7e0472c46121366e7ce07244be1ac')}}" id='wp-url-js'></script>
    <script type='text/javascript' id='contact-form-7-js-extra'>
        <script type='text/javascript' src="{{asset('Dassets/wp-content/plugins/contact-form-7/includes/js/index.js?ver=5.4')}}" id='contact-form-7-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/html5.js?ver=1.0.0')}}" id='html5-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/modernizr.js?ver=1.0.0')}}" id='modernizr-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/flexMenu.js?ver=1.0.0')}}" id='discy-flex-menu-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/scrollbar.js?ver=1.0.0')}}" id='discy-scrollbar-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/imagesloaded.js?ver=1.0.0')}}" id='discy-imagesloaded-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/theia.js?ver=1.0.0')}}" id='discy-theia-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/owl.js?ver=1.0.0')}}" id='discy-owl-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/mCustomScrollbar.js?ver=1.0.0')}}" id='discy-custom-scrollbar-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/matchHeight.js?ver=1.0.0')}}" id='discy-match-height-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/prettyPhoto.js?ver=1.0.0')}}" id='discy-pretty-photo-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/tabs.js?ver=1.0.0')}}" id='discy-tabs-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/tipsy.js?ver=1.0.0')}}" id='discy-tipsy-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/isotope.js?ver=1.0.0')}}" id='discy-isotope-js'></script>
    <script type='text/javascript' src='https://www.google.com/recaptcha/api.js?ver=1.0.0' id='discy-recaptcha-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-content/themes/discy/js/custom.js?ver=4.4.4')}}" id='discy-custom-js-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wp-embed.min.js?ver=5.7')}}" id='wp-embed-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/underscore.min.js?ver=1.8.3')}}" id='underscore-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/shortcode.min.js?ver=5.7')}}" id='shortcode-js'></script>
    <script type='text/javascript' id='utils-js-extra'>
        /* <![CDATA[ */
        var userSettings = {"url":"\/","uid":"1","time":"1619304739","secure":""};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/utils.min.js?ver=5.7')}}" id='utils-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/backbone.min.js?ver=1.4.0')}}" id='backbone-js'></script>
    <script type='text/javascript' id='wp-util-js-extra'>
        /* <![CDATA[ */
        var _wpUtilSettings = {"ajax":{"url":"\/wp-admin\/admin-ajax.php"}};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wp-util.min.js?ver=5.7')}}" id='wp-util-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wp-backbone.min.js?ver=5.7' )}}"id='wp-backbone-js'></script>
    <script type='text/javascript' id='media-models-js-extra'>
        /* <![CDATA[ */
        var _wpMediaModelsL10n = {"settings":{"ajaxurl":"\/wp-admin\/admin-ajax.php","post":{"id":0}}};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/media-models.min.js?ver=5.7')}}" id='media-models-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/plupload/moxie.min.js?ver=1.3.5')}}" id='moxiejs-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/plupload/plupload.min.js?ver=2.1.9')}}" id='plupload-js'></script>
<!--[if lt IE 8]>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/json2.min.js?ver=2015-05-03')}}" id='json2-js'></script>
<![endif]-->
    <script type='text/javascript' id='wp-plupload-js-extra'>
        /* <![CDATA[ */
        var pluploadL10n = {"queue_limit_exceeded":"You have attempted to queue too many files.","file_exceeds_size_limit":"%s exceeds the maximum upload size for this site.","zero_byte_file":"This file is empty. Please try another.","invalid_filetype":"Sorry, this file type is not permitted for security reasons.","not_an_image":"This file is not an image. Please try another.","image_memory_exceeded":"Memory exceeded. Please try another smaller file.","image_dimensions_exceeded":"This is larger than the maximum size. Please try another.","default_error":"An error occurred in the upload. Please try again later.","missing_upload_url":"There was a configuration error. Please contact the server administrator.","upload_limit_exceeded":"You may only upload 1 file.","http_error":"Unexpected response from the server. The file may have been uploaded successfully. Check in the Media Library or reload the page.","http_error_image":"Post-processing of the image failed likely because the server is busy or does not have enough resources. Uploading a smaller image may help. Suggested maximum size is 2500 pixels.","upload_failed":"Upload failed.","big_upload_failed":"Please try uploading this file with the %1$sbrowser uploader%2$s.","big_upload_queued":"%s exceeds the maximum upload size for the multi-file uploader when used in your browser.","io_error":"IO error.","security_error":"Security error.","file_cancelled":"File canceled.","upload_stopped":"Upload stopped.","dismiss":"Dismiss","crunching":"Crunching\u2026","deleted":"moved to the Trash.","error_uploading":"\u201c%s\u201d has failed to upload.","unsupported_image":"This image cannot be displayed in a web browser. For best results convert it to JPEG before uploading."};
        var _wpPluploadSettings = {"defaults":{"file_data_name":"async-upload","url":"\/wp-admin\/async-upload.php","filters":{"max_file_size":"2147483648b","mime_types":[{"extensions":"jpg,jpeg,jpe,gif,png,bmp,tiff,tif,ico,heic,asf,asx,wmv,wmx,wm,avi,divx,flv,mov,qt,mpeg,mpg,mpe,mp4,m4v,ogv,webm,mkv,3gp,3gpp,3g2,3gp2,txt,asc,c,cc,h,srt,csv,tsv,ics,rtx,css,htm,html,vtt,dfxp,mp3,m4a,m4b,aac,ra,ram,wav,ogg,oga,flac,mid,midi,wma,wax,mka,rtf,js,pdf,class,tar,zip,gz,gzip,rar,7z,psd,xcf,doc,pot,pps,ppt,wri,xla,xls,xlt,xlw,mdb,mpp,docx,docm,dotx,dotm,xlsx,xlsm,xlsb,xltx,xltm,xlam,pptx,pptm,ppsx,ppsm,potx,potm,ppam,sldx,sldm,onetoc,onetoc2,onetmp,onepkg,oxps,xps,odt,odp,ods,odg,odc,odb,odf,wp,wpd,key,numbers,pages"}]},"heic_upload_error":true,"multipart_params":{"action":"upload-attachment","_wpnonce":"2c878a614d"}},"browser":{"mobile":false,"supported":true},"limitExceeded":false};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/plupload/wp-plupload.min.js?ver=5.7')}}" id='wp-plupload-js'></script>
    <script type='text/javascript' id='mediaelement-core-js-before'>
        var mejsL10n = {"language":"en","strings":{"mejs.download-file":"Download File","mejs.install-flash":"You are using a browser that does not have Flash player enabled or installed. Please turn on your Flash player plugin or download the latest version from https:\/\/get.adobe.com\/flashplayer\/","mejs.fullscreen":"Fullscreen","mejs.play":"Play","mejs.pause":"Pause","mejs.time-slider":"Time Slider","mejs.time-help-text":"Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.","mejs.live-broadcast":"Live Broadcast","mejs.volume-help-text":"Use Up\/Down Arrow keys to increase or decrease volume.","mejs.unmute":"Unmute","mejs.mute":"Mute","mejs.volume-slider":"Volume Slider","mejs.video-player":"Video Player","mejs.audio-player":"Audio Player","mejs.captions-subtitles":"Captions\/Subtitles","mejs.captions-chapters":"Chapters","mejs.none":"None","mejs.afrikaans":"Afrikaans","mejs.albanian":"Albanian","mejs.arabic":"Arabic","mejs.belarusian":"Belarusian","mejs.bulgarian":"Bulgarian","mejs.catalan":"Catalan","mejs.chinese":"Chinese","mejs.chinese-simplified":"Chinese (Simplified)","mejs.chinese-traditional":"Chinese (Traditional)","mejs.croatian":"Croatian","mejs.czech":"Czech","mejs.danish":"Danish","mejs.dutch":"Dutch","mejs.english":"English","mejs.estonian":"Estonian","mejs.filipino":"Filipino","mejs.finnish":"Finnish","mejs.french":"French","mejs.galician":"Galician","mejs.german":"German","mejs.greek":"Greek","mejs.haitian-creole":"Haitian Creole","mejs.hebrew":"Hebrew","mejs.hindi":"Hindi","mejs.hungarian":"Hungarian","mejs.icelandic":"Icelandic","mejs.indonesian":"Indonesian","mejs.irish":"Irish","mejs.italian":"Italian","mejs.japanese":"Japanese","mejs.korean":"Korean","mejs.latvian":"Latvian","mejs.lithuanian":"Lithuanian","mejs.macedonian":"Macedonian","mejs.malay":"Malay","mejs.maltese":"Maltese","mejs.norwegian":"Norwegian","mejs.persian":"Persian","mejs.polish":"Polish","mejs.portuguese":"Portuguese","mejs.romanian":"Romanian","mejs.russian":"Russian","mejs.serbian":"Serbian","mejs.slovak":"Slovak","mejs.slovenian":"Slovenian","mejs.spanish":"Spanish","mejs.swahili":"Swahili","mejs.swedish":"Swedish","mejs.tagalog":"Tagalog","mejs.thai":"Thai","mejs.turkish":"Turkish","mejs.ukrainian":"Ukrainian","mejs.vietnamese":"Vietnamese","mejs.welsh":"Welsh","mejs.yiddish":"Yiddish"}};
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=4.2.16')}}" id='mediaelement-core-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/mediaelement/mediaelement-migrate.min.js?ver=5.7')}}" id='mediaelement-migrate-js'></script>
    <script type='text/javascript' id='mediaelement-js-extra'>
        /* <![CDATA[ */
        var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/","classPrefix":"mejs-","stretching":"responsive"};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=5.7')}}" id='wp-mediaelement-js'></script>
    <script type='text/javascript' id='wp-api-request-js-extra'>
        /* <![CDATA[ */
        var wpApiSettings = {"root":"http:\/\/template.test\/wp-json\/","nonce":"67d7eeec5b","versionString":"wp\/v2\/"};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/api-request.min.js?ver=5.7')}}" id='wp-api-request-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/dom-ready.min.js?ver=eb19f7980f0268577acb5c2da5457de3')}}" id='wp-dom-ready-js'></script>
    <script type='text/javascript' id='wp-a11y-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", { "locale_data": { "messages": { "": {} } } } );
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/a11y.min.js?ver=5e00de7a43b31bbb9eaf685f089a3903')}}" id='wp-a11y-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/clipboard.min.js?ver=5.7')}}" id='clipboard-js'></script>
    <script type='text/javascript' id='media-views-js-extra'>
        /* <![CDATA[ */
        var _wpMediaViewsL10n = {"mediaFrameDefaultTitle":"Media","url":"URL","addMedia":"Add media","search":"Search","select":"Select","cancel":"Cancel","update":"Update","replace":"Replace","remove":"Remove","back":"Back","selected":"%d selected","dragInfo":"Drag and drop to reorder media files.","uploadFilesTitle":"Upload files","uploadImagesTitle":"Upload images","mediaLibraryTitle":"Media Library","insertMediaTitle":"Add media","createNewGallery":"Create a new gallery","createNewPlaylist":"Create a new playlist","createNewVideoPlaylist":"Create a new video playlist","returnToLibrary":"\u2190 Go to library","allMediaItems":"All media items","allDates":"All dates","noItemsFound":"No items found.","insertIntoPost":"Insert into page","unattached":"Unattached","mine":"Mine","trash":"Trash","uploadedToThisPost":"Uploaded to this page","warnDelete":"You are about to permanently delete this item from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkDelete":"You are about to permanently delete these items from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkTrash":"You are about to trash these items.\n  'Cancel' to stop, 'OK' to delete.","bulkSelect":"Bulk select","trashSelected":"Move to Trash","restoreSelected":"Restore from Trash","deletePermanently":"Delete permanently","apply":"Apply","filterByDate":"Filter by date","filterByType":"Filter by type","searchLabel":"Search","searchMediaLabel":"Search media","searchMediaPlaceholder":"Search media items...","mediaFound":"Number of media items found: %d","mediaFoundHasMoreResults":"Number of media items displayed: %d. Scroll the page for more results.","noMedia":"No media items found.","noMediaTryNewSearch":"No media items found. Try a different search.","attachmentDetails":"Attachment details","insertFromUrlTitle":"Insert from URL","setFeaturedImageTitle":"Featured image","setFeaturedImage":"Set featured image","createGalleryTitle":"Create gallery","editGalleryTitle":"Edit gallery","cancelGalleryTitle":"\u2190 Cancel gallery","insertGallery":"Insert gallery","updateGallery":"Update gallery","addToGallery":"Add to gallery","addToGalleryTitle":"Add to gallery","reverseOrder":"Reverse order","imageDetailsTitle":"Image details","imageReplaceTitle":"Replace image","imageDetailsCancel":"Cancel edit","editImage":"Edit image","chooseImage":"Choose image","selectAndCrop":"Select and crop","skipCropping":"Skip cropping","cropImage":"Crop image","cropYourImage":"Crop your image","cropping":"Cropping\u2026","suggestedDimensions":"Suggested image dimensions: %1$s by %2$s pixels.","cropError":"There has been an error cropping your image.","audioDetailsTitle":"Audio details","audioReplaceTitle":"Replace audio","audioAddSourceTitle":"Add audio source","audioDetailsCancel":"Cancel edit","videoDetailsTitle":"Video details","videoReplaceTitle":"Replace video","videoAddSourceTitle":"Add video source","videoDetailsCancel":"Cancel edit","videoSelectPosterImageTitle":"Select poster image","videoAddTrackTitle":"Add subtitles","playlistDragInfo":"Drag and drop to reorder tracks.","createPlaylistTitle":"Create audio playlist","editPlaylistTitle":"Edit audio playlist","cancelPlaylistTitle":"\u2190 Cancel audio playlist","insertPlaylist":"Insert audio playlist","updatePlaylist":"Update audio playlist","addToPlaylist":"Add to audio playlist","addToPlaylistTitle":"Add to Audio Playlist","videoPlaylistDragInfo":"Drag and drop to reorder videos.","createVideoPlaylistTitle":"Create video playlist","editVideoPlaylistTitle":"Edit video playlist","cancelVideoPlaylistTitle":"\u2190 Cancel video playlist","insertVideoPlaylist":"Insert video playlist","updateVideoPlaylist":"Update video playlist","addToVideoPlaylist":"Add to video playlist","addToVideoPlaylistTitle":"Add to video Playlist","filterAttachments":"Filter media","attachmentsList":"Media list","settings":{"tabs":[],"tabUrl":"http:\/\/template.test\/wp-admin\/media-upload.php?chromeless=1","mimeTypes":{"image":"Images","audio":"Audio","video":"Video","application\/msword,application\/vnd.openxmlformats-officedocument.wordprocessingml.document,application\/vnd.ms-word.document.macroEnabled.12,application\/vnd.ms-word.template.macroEnabled.12,application\/vnd.oasis.opendocument.text,application\/vnd.apple.pages,application\/pdf,application\/vnd.ms-xpsdocument,application\/oxps,application\/rtf,application\/wordperfect,application\/octet-stream":"Documents","application\/vnd.apple.numbers,application\/vnd.oasis.opendocument.spreadsheet,application\/vnd.ms-excel,application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application\/vnd.ms-excel.sheet.macroEnabled.12,application\/vnd.ms-excel.sheet.binary.macroEnabled.12":"Spreadsheets","application\/x-gzip,application\/rar,application\/x-tar,application\/zip,application\/x-7z-compressed":"Archives"},"captions":true,"nonce":{"sendToEditor":"3b5d43e8eb"},"post":{"id":64,"nonce":"fe149e2edf","featuredImageId":-1},"defaultProps":{"link":"none","align":"","size":""},"attachmentCounts":{"audio":1,"video":1},"oEmbedProxyUrl":"http:\/\/template.test\/wp-json\/oembed\/1.0\/proxy","embedExts":["mp3","ogg","flac","m4a","wav","mp4","m4v","webm","ogv","flv","mov","avi","wmv"],"embedMimes":{"mp3":"audio\/mpeg","ogg":"audio\/ogg","flac":"audio\/flac","m4a":"audio\/mpeg","wav":"audio\/wav","mp4":"video\/mp4","m4v":"video\/mp4","webm":"video\/webm","ogv":"video\/ogg","flv":"video\/x-flv","mov":"video\/quicktime","avi":"video\/avi","wmv":"video\/x-ms-wmv"},"contentWidth":1170,"months":[{"year":"2021","month":"4","text":"April 2021"},{"year":"2019","month":"5","text":"May 2019"},{"year":"2019","month":"1","text":"January 2019"},{"year":"2018","month":"5","text":"May 2018"},{"year":"2018","month":"4","text":"April 2018"}],"mediaTrash":0}};
        /* ]]> */
    </script>
    <script type='text/javascript' id='media-views-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", { "locale_data": { "messages": { "": {} } } } );
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/media-views.min.js?ver=5.7')}}" id='media-views-js'></script>
    <script type='text/javascript' id='media-editor-js-translations'>
        ( function( domain, translations ) {
            var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
            localeData[""].domain = domain;
            wp.i18n.setLocaleData( localeData, domain );
        } )( "default", { "locale_data": { "messages": { "": {} } } } );
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/media-editor.min.js?ver=5.7')}}" id='media-editor-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/media-audiovideo.min.js?ver=5.7')}}" id='media-audiovideo-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/mediaelement/wp-playlist.min.js?ver=5.7')}}" id='wp-playlist-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-admin/js/editor.min.js?ver=5.7')}}" id='editor-js'></script>
    <script type='text/javascript' id='editor-js-after'>
        window.wp.oldEditor = window.wp.editor;
    </script>
    <script type='text/javascript' id='quicktags-js-extra'>
        /* <![CDATA[ */
        var quicktagsL10n = {"closeAllOpenTags":"Close all open tags","closeTags":"close tags","enterURL":"Enter the URL","enterImageURL":"Enter the URL of the image","enterImageDescription":"Enter a description of the image","textdirection":"text direction","toggleTextdirection":"Toggle Editor Text Direction","dfw":"Distraction-free writing mode","strong":"Bold","strongClose":"Close bold tag","em":"Italic","emClose":"Close italic tag","link":"Insert link","blockquote":"Blockquote","blockquoteClose":"Close blockquote tag","del":"Deleted text (strikethrough)","delClose":"Close deleted text tag","ins":"Inserted text","insClose":"Close inserted text tag","image":"Insert image","ul":"Bulleted list","ulClose":"Close bulleted list tag","ol":"Numbered list","olClose":"Close numbered list tag","li":"List item","liClose":"Close list item tag","code":"Code","codeClose":"Close code tag","more":"Insert Read More tag"};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/quicktags.min.js?ver=5.7')}}" id='quicktags-js'></script>
    <script type='text/javascript' id='wplink-js-extra'>
        /* <![CDATA[ */
        var wpLinkL10n = {"title":"Insert\/edit link","update":"Update","save":"Add Link","noTitle":"(no title)","noMatchesFound":"No results found.","linkSelected":"Link selected.","linkInserted":"Link inserted.","minInputLength":"3"};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wplink.min.js?ver=5.7')}}" id='wplink-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/menu.min.js?ver=1.12.1')}}" id='jquery-ui-menu-js'></script>
    <script type='text/javascript' id='jquery-ui-autocomplete-js-extra'>
        /* <![CDATA[ */
        var uiAutocompleteL10n = {"noResults":"No results found.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate.","itemSelected":"Item selected."};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/autocomplete.min.js?ver=1.12.1')}}" id='jquery-ui-autocomplete-js'></script>
    <script type='text/javascript' id='thickbox-js-extra'>
        /* <![CDATA[ */
        var thickboxL10n = {"next":"Next >","prev":"< Prev","image":"Image","of":"of","close":"Close","noiframes":"This feature requires inline frames. You have iframes disabled or your browser does not support them.","loadingAnimation":"http:\/\/template.test\/wp-includes\/js\/thickbox\/loadingAnimation.gif"};
        /* ]]> */
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/thickbox/thickbox.js?ver=3.1-20121105')}}" id='thickbox-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-admin/js/media-upload.min.js?ver=5.7')}}" id='media-upload-js'></script>

    <script type="text/javascript">
        tinyMCEPreInit = {
            baseURL: "Dassets/wp-includes/js/tinymce",
            suffix: ".min",
            mceInit: {'question-details-add-451':{theme:"modern",skin:"lightgray",language:"en",formats:{alignleft: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}},{selector: "img,table,dl.wp-caption", classes: "alignleft"}],aligncenter: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},{selector: "img,table,dl.wp-caption", classes: "aligncenter"}],alignright: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},{selector: "img,table,dl.wp-caption", classes: "alignright"}],strikethrough: {inline: "del"}},relative_urls:false,remove_script_host:false,convert_urls:false,browser_spellcheck:true,fix_list_elements:true,entities:"38,amp,60,lt,62,gt",entity_encoding:"raw",keep_styles:false,cache_suffix:"wp-mce-49110-20201110",resize:"vertical",menubar:false,branding:false,preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",end_container_on_empty_block:true,wpeditimage_html5_captions:true,wp_lang_attr:"en-US",wp_keep_scroll_position:false,wp_shortcut_labels:{"Heading 1":"access1","Heading 2":"access2","Heading 3":"access3","Heading 4":"access4","Heading 5":"access5","Heading 6":"access6","Paragraph":"access7","Blockquote":"accessQ","Underline":"metaU","Strikethrough":"accessD","Bold":"metaB","Italic":"metaI","Code":"accessX","Align center":"accessC","Align right":"accessR","Align left":"accessL","Justify":"accessJ","Cut":"metaX","Copy":"metaC","Paste":"metaV","Select all":"metaA","Undo":"metaZ","Redo":"metaY","Bullet list":"accessU","Numbered list":"accessO","Insert\/edit image":"accessM","Insert\/edit link":"metaK","Remove link":"accessS","Toolbar Toggle":"accessZ","Insert Read More tag":"accessT","Insert Page Break tag":"accessP","Distraction-free writing mode":"accessW","Add Media":"accessM","Keyboard Shortcuts":"accessH"},content_css:"Dassets/wp-includes/css/dashicons.min.css?ver=5.7,Dassets/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=5.7",plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",selector:"#question-details-add-451",wpautop:true,indent:false,toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,spellchecker,wp_adv",toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",toolbar3:"",toolbar4:"",tabfocus_elements:":prev,:next",body_class:"question-details-add-451 post-type-page post-status-publish page-template-template-home locale-en-us"}},
            qtInit: {'question-details-add-451':{id:"question-details-add-451",buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close"}},
            ref: {plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",theme:"modern",language:"en"},
            load_ext: function(url,lang){var sl=tinymce.ScriptLoader;sl.markDone(url+'/langs/'+lang+'.js');sl.markDone(url+'/langs/'+lang+'_dlg.js');}
        };
    </script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/tinymce/tinymce.min.js?ver=49110-20201110')}}" id='wp-tinymce-root-js'></script>
    <script type='text/javascript' src="{{asset('Dassets/wp-includes/js/tinymce/plugins/compat3x/plugin.min.js?ver=49110-20201110')}}" id='wp-tinymce-js'></script>
    <script type='text/javascript'>
        tinymce.addI18n( 'en', {"Ok":"OK","Bullet list":"Bulleted list","Insert\/Edit code sample":"Insert\/edit code sample","Url":"URL","Spellcheck":"Check Spelling","Row properties":"Table row properties","Cell properties":"Table cell properties","Cols":"Columns","Paste row before":"Paste table row before","Paste row after":"Paste table row after","Cut row":"Cut table row","Copy row":"Copy table row","Merge cells":"Merge table cells","Split cell":"Split table cell","Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.":"Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.\n\nIf you\u2019re looking to paste rich content from Microsoft Word, try turning this option off. The editor will clean up text pasted from Word automatically.","Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help":"Rich Text Area. Press Alt-Shift-H for help.","You have unsaved changes are you sure you want to navigate away?":"The changes you made will be lost if you navigate away from this page.","Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X\/C\/V keyboard shortcuts instead.":"Your browser does not support direct access to the clipboard. Please use keyboard shortcuts or your browser\u2019s edit menu instead.","Edit|button":"Edit"});
        tinymce.ScriptLoader.markDone( "{{asset('Dassets/wp-includes/js/tinymce/langs/en.js')}}" );
    </script>
    <script type="text/javascript">
        var ajaxurl = "/wp-admin/admin-ajax.php";
        ( function() {
            var init, id, $wrap;

            if ( typeof tinymce !== 'undefined' ) {
                if ( tinymce.Env.ie && tinymce.Env.ie < 11 ) {
                    tinymce.$( '.wp-editor-wrap ' ).removeClass( 'tmce-active' ).addClass( 'html-active' );
                    return;
                }

                for ( id in tinyMCEPreInit.mceInit ) {
                    init = tinyMCEPreInit.mceInit[id];
                    $wrap = tinymce.$( '#wp-' + id + '-wrap' );

                    if ( ( $wrap.hasClass( 'tmce-active' ) || ! tinyMCEPreInit.qtInit.hasOwnProperty( id ) ) && ! init.wp_skip_init ) {
                        tinymce.init( init );

                        if ( ! window.wpActiveEditor ) {
                            window.wpActiveEditor = id;
                        }
                    }
                }
            }

            if ( typeof quicktags !== 'undefined' ) {
                for ( id in tinyMCEPreInit.qtInit ) {
                    quicktags( tinyMCEPreInit.qtInit[id] );

                    if ( ! window.wpActiveEditor ) {
                        window.wpActiveEditor = id;
                    }
                }
            }
        }());
    </script>
    <div id="wp-link-backdrop" style="display: none"></div>
    <div id="wp-link-wrap" class="wp-core-ui" style="display: none" role="dialog" aria-labelledby="link-modal-title">
        <form id="wp-link" tabindex="-1">
            <input type="hidden" id="_ajax_linking_nonce" name="_ajax_linking_nonce" value="9b83e288d3" />		<h1 id="link-modal-title">Insert/edit link</h1>
            <button type="button" id="wp-link-close"><span class="screen-reader-text">Close</span></button>
            <div id="link-selector">
                <div id="link-options">
                    <p class="howto" id="wplink-enter-url">Enter the destination URL</p>
                    <div>
                        <label><span>URL</span>
                            <input id="wp-link-url" type="text" aria-describedby="wplink-enter-url" /></label>
                    </div>
                    <div class="wp-link-text-field">
                        <label><span>Link Text</span>
                            <input id="wp-link-text" type="text" /></label>
                    </div>
                    <div class="link-target">
                        <label><span></span>
                            <input type="checkbox" id="wp-link-target" /> Open link in a new tab</label>
                    </div>
                </div>
                <p class="howto" id="wplink-link-existing-content">Or link to existing content</p>
                <div id="search-panel">
                    <div class="link-search-wrapper">
                        <label>
                            <span class="search-label">Search</span>
                            <input type="search" id="wp-link-search" class="link-search-field" autocomplete="off" aria-describedby="wplink-link-existing-content" />
                            <span class="spinner"></span>
                        </label>
                    </div>
                    <div id="search-results" class="query-results" tabindex="0">
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                    <div id="most-recent-results" class="query-results" tabindex="0">
                        <div class="query-notice" id="query-notice-message">
                            <em class="query-notice-default">No search term specified. Showing recent items.</em>
                            <em class="query-notice-hint screen-reader-text">Search or use up and down arrow keys to select an item.</em>
                        </div>
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submitbox">
                <div id="wp-link-cancel">
                    <button type="button" class="button">Cancel</button>
                </div>
                <div id="wp-link-update">
                    <input type="submit" value="Add Link" class="button button-primary" id="wp-link-submit" name="wp-link-submit">
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        (function() {
            var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

            request = true;

            b[c] = b[c].replace( rcs, ' ' );
            // The customizer requires postMessage and CORS (if the site is cross domain).
            b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
        }());
    </script>
</x-app-layout>
