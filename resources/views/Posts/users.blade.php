<x-app-layout>
<header class="bg-gray-light shadow">
    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
    </div>
</header>
@include('Posts.Question&report_form')

<div id="wrap" class="wrap-not-login">
    <div class="main-content">
        <div class="discy-inner-content menu_sidebar">
            <div class="the-main-container">
                <main class="all-main-wrap discy-site-content float_l">
                    <div class="the-main-inner float_l">
                        <div class="breadcrumbs breadcrumbs_1">
                            <div class="breadcrumbs-wrap">
                                <div class="breadcrumb-left">
											<span class="crumbs">
												<span itemscope itemtype="https://schema.org/BreadcrumbList">
													<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
														<meta itemprop="position" content="1">
															<a itemprop="item" href="{{route('homepage')}}" title="Home">
																<span itemprop="name"><i class="icon-home"></i>Home</span>
															</a>
													</span>
													<span class="crumbs-span">/</span>
													<span class="current">Users</span>
												</span>
											</span>
                                </div><!-- End breadcrumb-left -->
                                <div class="breadcrumb-right">
                                    <div class="search-form">
                                        <form method="get" action="{{route('display_users')}}" class="search-filter-form">
											<span class="styled-select user-filter">
                                                <select name="user_filter">
                                                    <option value="user_registered">Date Registered</option>
													<option value="display_name">Name</option>
													<option value="Expert" >Experts</option>
													<option value="Student" >Students</option>
													<option value="Teacher" >Teachers</option>
													<option value="Popular" >Populars</option>
												</select>
											</span>
                                        </form>
                                        <form method="get" action="{{route('finduser')}}" class="search-input-form main-search-form">
                                            <input class="search-input live-search live-search-icon" autocomplete='off' type="search" name="search" placeholder="Type to find...">
                                            <div class="loader_2 search_loader"></div>
                                            <div class="search-results results-empty"></div>
                                            <button type="submit" class="button-search"><i class="icon-search"></i></button>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- End breadcrumb-right -->
                            </div><!-- End breadcrumbs-wrap -->
                        </div><!-- End breadcrumbs -->
                        <div class="clearfix"></div>
                        <section>
                            <article id="post-62" class="article-post article-post-only clearfix post-62 page type-page status-publish hentry">
                                <div class="single-inner-content">
                                    <header class="article-header header-no-author header-no-meta">
                                        <figure class="featured-image post-img post-img-0"></figure>
                                    </header>

                                    <div class="post-wrap-content">
                                        <div class="post-content-text"></div>
                                        <div class='user-section user-section-small_grid row user-not-normal'>
                                            @forelse($users as $user)
                                            <div class='col col4'>
                                                <div class="post-section user-area user-area-small_grid" style="background-color:#f5f5dc;">
                                                    <div class="post-inner">

                                                        <div class="author-image author-image-84">
                                                            <a href="{{ route('userprofile',[$user->id]) }}">
                                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                                    <span class="mx-10 author-image-span"><img class="h-16 w-16 rounded-full object-cover avatar avatar-84 photo" src="{{ $user->profile_photo_url }}" alt="{{ $user->username }}" /></span>
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="user-content mb-5">
                                                            <div class="user-inner">
                                                                <h4 style="color: #1C3334"><a href="{{ route('userprofile',[$user->id]) }}"><b>{{$user->username}}</b><div style="color: #6b003e; font-size:12px;  ">{{"\" ".$user->type." \""}}</div></a></h4>
                                                            </div>
                                                        </div><!-- End user-content -->
                                                        <?php
                                                            if(App\Models\Follow::where('follows',Auth()->user()->id)->where('followed',$user->id)->count())
                                                               $follow = "UnFollow";
                                                            else $follow = "Follow"
                                                        ?>
                                                        @if( Auth()->user()->id != $user->id )
                                                            <a href="{{route('follow',['id'=>$user->id])}}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">{{$follow}}</a>
                                                        @else
                                                            <div class="pb-9"></div>
                                                        @endif
                                                            <div class="clearfix"></div>
                                                    </div><!-- End post-inner -->
                                                </div><!-- End post -->
                                            </div>
                                            @empty
                                                    <div>No Users</div>
                                            @endforelse
                                        </div>
                                    </div>

                                </div><!-- End single-inner-content -->
                            </article><!-- End article -->
                        </section><!-- End section -->

                    </div><!-- End the-main-inner -->
                    @include('Posts.sidebar')
                </main><!-- End discy-site-content -->
                @include(('Posts.navbar'))
            </div><!-- End the-main-container -->
        </div><!-- End discy-inner-content -->
    </div><!-- End main-content -->
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
<script type='text/javascript' id='jquery-ui-datepicker-js-after'>
    jQuery(document).ready(function(jQuery){jQuery.datepicker.setDefaults({"closeText":"Close","currentText":"Today","monthNames":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthNamesShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"nextText":"Next","prevText":"Previous","dayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"dayNamesShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"dayNamesMin":["S","M","T","W","T","F","S"],"dateFormat":"MM d, yy","firstDay":1,"isRTL":false});});
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/mouse.min.js?ver=1.12.1')}}" id='jquery-ui-mouse-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/jquery/ui/sortable.min.js?ver=1.12.1')}}" id='jquery-ui-sortable-js'></script>
<script type='text/javascript' id='wpqa-custom-js-js-extra'>
    /* <![CDATA[ */
    var wpqa_custom = {"admin_url":"http:\/\/template.test\/wp-admin\/admin-ajax.php","poll_image":"on","poll_image_title":"0","comment_limit":"0","comment_min_limit":"0","home_url":"http:\/\/template.test\/","wpqa_error_text":"Please fill the required field.","wpqa_error_min_limit":"Sorry, The minimum characters is","wpqa_error_limit":"Sorry, The maximum characters is","sure_delete_comment":"Are you sure you want to delete the comment?","sure_delete_answer":"Are you sure you want to delete the answer?","wpqa_remove_image":"Are you sure you want to delete the image?","wpqa_remove_attachment":"Are you sure you want to delete the attachment?","no_vote_question":"Sorry, you cannot vote your question.","no_vote_more":"Sorry, you cannot vote on the same question more than once.","no_vote_user":"Voting is available to members only.","no_vote_answer":"Sorry, you cannot vote your answer.","no_vote_more_answer":"Sorry, you cannot vote on the same answer more than once.","no_vote_comment":"Sorry, you cannot vote your comment.","no_vote_more_comment":"Sorry, you cannot vote on the same comment more than once.","follow_question_attr":"Follow the question","unfollow_question_attr":"Unfollow the question","follow":"Follow","unfollow":"Unfollow","select_file":"Select file","browse":"Browse","reported":"Thank you, your report will be reviewed shortly.","wpqa_error_comment":"Please type a comment.","click_continue":"Click here to continue.","click_not_finish":"Complete your following above to continue.","ban_user":"Ban user","unban_user":"Unban user","no_poll_more":"Sorry, you cannot poll on the same question more than once.","must_login":"Please login to vote and see the results."};
    /* ]]> */
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-content/plugins/WPQA/assets/js/custom.js?ver=4.4.4')}}" id='wpqa-custom-js-js'></script>
<script type='text/javascript' id='wpqa-single-js-js-extra'>
    /* <![CDATA[ */
    var wpqa_single = {"wpqa_dir":"{{asset("Dassets\/wp-content\/plugins\/WPQA\/")}}","wpqa_best_answer_nonce":"cff7efa1dc","require_name_email":"require_name_email","admin_url":"http:\/\/template.test\/wp-admin\/admin-ajax.php","comment_limit":"0","comment_min_limit":"0","captcha_answer":"Cairo","attachment_answer":"0","featured_image_answer":"on","terms_active_comment":"0","comment_editor":"on","activate_editor_reply":"0","is_logged":"logged","display_name":"root","profile_url":"http:\/\/template.test\/profile\/root\/","logout_url":"http:\/\/template.test\/wp-login.php?action=logout&redirect_to=http%3A%2F%2Ftemplate.test%2Fquestion%2Fis-this-statement-i-see-him-last-night-can-be-understood-as-i-saw-him-last-night%2F&_wpnonce=bfb8be52d6","popup_share_seconds":"60","comment_action":"http:\/\/template.test\/wp-comments-post.php","wpqa_error_name":"Please fill the required fields (name).","wpqa_error_email":"Please fill the required fields (email).","wpqa_valid_email":"Please enter a valid email address.","wpqa_error_comment":"Please type a comment.","wpqa_error_min_limit":"Sorry, The minimum characters is","wpqa_error_limit":"Sorry, The maximum characters is","wpqa_error_terms":"There are required fields (Agree of the terms).","cancel_reply":"Cancel reply.","logged_as":"Logged in as","logout_title":"Log out of this account","logout":"Log out","reply":"Reply","submit":"Submit","choose_best_answer":"Select as best answer","cancel_best_answer":"Cancel the best answer","best_answer":"Best answer","best_answer_selected":"There is another one select this a best answer","wpqa_error_captcha":"The captcha is incorrect, Please try again.","sure_delete":"Are you sure you want to delete the question?","sure_delete_post":"Are you sure you want to delete the post?","add_favorite":"Add this question to favorites","remove_favorite":"Remove this question of my favorites","get_points":"You have bumped your question."};
    /* ]]> */
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-content/plugins/WPQA/assets/js/single.js?ver=4.4.4')}}" id='wpqa-single-js-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=7.4.4')}}" id='wp-polyfill-js'></script>
<script type='text/javascript' id='wp-polyfill-js-after'>
    ( 'fetch' in window ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-fetch.min.js?ver=3.0.0"></scr' + 'ipt>' );( document.contains ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-node-contains.min.js?ver=3.42.0"></scr' + 'ipt>' );( window.DOMRect ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-dom-rect.min.js?ver=3.42.0"></scr' + 'ipt>' );( window.URL && window.URL.prototype && window.URLSearchParams ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-url.min.js?ver=3.6.4"></scr' + 'ipt>' );( window.FormData && window.FormData.prototype.keys ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-formdata.min.js?ver=3.0.12"></scr' + 'ipt>' );( Element.prototype.matches && Element.prototype.closest ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-element-closest.min.js?ver=2.0.2"></scr' + 'ipt>' );( 'objectFit' in document.documentElement.style ) || document.write( '<script src="http://template.test/wp-includes/js/dist/vendor/wp-polyfill-object-fit.min.js?ver=2.3.4"></scr' + 'ipt>' );
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/hooks.min.js?ver=50e23bed88bcb9e6e14023e9961698c1')}}" id='wp-hooks-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/i18n.min.js?ver=db9a9a37da262883343e941c3731bc67')}}" id='wp-i18n-js'></script>
<script type='text/javascript' id='wp-i18n-js-after'>
    wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/vendor/lodash.min.js?ver=4.17.19')}}" id='lodash-js'></script>
<script type='text/javascript' id='lodash-js-after'>
    window.lodash = _.noConflict();
</script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/url.min.js?ver=0ac7e0472c46121366e7ce07244be1ac')}}" id='wp-url-js'></script>

<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/dist/api-fetch.min.js?ver=a783d1f442d2abefc7d6dbd156a44561')}}" id='wp-api-fetch-js'></script>

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
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/comment-reply.min.js?ver=5.7')}}" id='comment-reply-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wp-embed.min.js?ver=5.7')}}" id='wp-embed-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/underscore.min.js?ver=1.8.3')}}" id='underscore-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/shortcode.min.js?ver=5.7')}}" id='shortcode-js'></script>
<script type='text/javascript' id='utils-js-extra'>
    /* <![CDATA[ */
    var userSettings = {"url":"\/","uid":"1","time":"1619743655","secure":""};
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
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/wp-backbone.min.js?ver=5.7')}}" id='wp-backbone-js'></script>
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
    var _wpPluploadSettings = {"defaults":{"file_data_name":"async-upload","url":"\/wp-admin\/async-upload.php","filters":{"max_file_size":"2147483648b","mime_types":[{"extensions":"jpg,jpeg,jpe,gif,png,bmp,tiff,tif,ico,heic,asf,asx,wmv,wmx,wm,avi,divx,flv,mov,qt,mpeg,mpg,mpe,mp4,m4v,ogv,webm,mkv,3gp,3gpp,3g2,3gp2,txt,asc,c,cc,h,srt,csv,tsv,ics,rtx,css,htm,html,vtt,dfxp,mp3,m4a,m4b,aac,ra,ram,wav,ogg,oga,flac,mid,midi,wma,wax,mka,rtf,js,pdf,class,tar,zip,gz,gzip,rar,7z,psd,xcf,doc,pot,pps,ppt,wri,xla,xls,xlt,xlw,mdb,mpp,docx,docm,dotx,dotm,xlsx,xlsm,xlsb,xltx,xltm,xlam,pptx,pptm,ppsx,ppsm,potx,potm,ppam,sldx,sldm,onetoc,onetoc2,onetmp,onepkg,oxps,xps,odt,odp,ods,odg,odc,odb,odf,wp,wpd,key,numbers,pages"}]},"heic_upload_error":true,"multipart_params":{"action":"upload-attachment","_wpnonce":"41ebe7596d"}},"browser":{"mobile":false,"supported":true},"limitExceeded":false};
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
    var wpApiSettings = {"root":"http:\/\/template.test\/wp-json\/","nonce":"f91dde5446","versionString":"wp\/v2\/"};
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
    var _wpMediaViewsL10n = {"mediaFrameDefaultTitle":"Media","url":"URL","addMedia":"Add media","search":"Search","select":"Select","cancel":"Cancel","update":"Update","replace":"Replace","remove":"Remove","back":"Back","selected":"%d selected","dragInfo":"Drag and drop to reorder media files.","uploadFilesTitle":"Upload files","uploadImagesTitle":"Upload images","mediaLibraryTitle":"Media Library","insertMediaTitle":"Add media","createNewGallery":"Create a new gallery","createNewPlaylist":"Create a new playlist","createNewVideoPlaylist":"Create a new video playlist","returnToLibrary":"\u2190 Go to library","allMediaItems":"All media items","allDates":"All dates","noItemsFound":"No items found.","insertIntoPost":"Insert into post","unattached":"Unattached","mine":"Mine","trash":"Trash","uploadedToThisPost":"Uploaded to this post","warnDelete":"You are about to permanently delete this item from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkDelete":"You are about to permanently delete these items from your site.\nThis action cannot be undone.\n 'Cancel' to stop, 'OK' to delete.","warnBulkTrash":"You are about to trash these items.\n  'Cancel' to stop, 'OK' to delete.","bulkSelect":"Bulk select","trashSelected":"Move to Trash","restoreSelected":"Restore from Trash","deletePermanently":"Delete permanently","apply":"Apply","filterByDate":"Filter by date","filterByType":"Filter by type","searchLabel":"Search","searchMediaLabel":"Search media","searchMediaPlaceholder":"Search media items...","mediaFound":"Number of media items found: %d","mediaFoundHasMoreResults":"Number of media items displayed: %d. Scroll the page for more results.","noMedia":"No media items found.","noMediaTryNewSearch":"No media items found. Try a different search.","attachmentDetails":"Attachment details","insertFromUrlTitle":"Insert from URL","setFeaturedImageTitle":"Featured image","setFeaturedImage":"Set featured image","createGalleryTitle":"Create gallery","editGalleryTitle":"Edit gallery","cancelGalleryTitle":"\u2190 Cancel gallery","insertGallery":"Insert gallery","updateGallery":"Update gallery","addToGallery":"Add to gallery","addToGalleryTitle":"Add to gallery","reverseOrder":"Reverse order","imageDetailsTitle":"Image details","imageReplaceTitle":"Replace image","imageDetailsCancel":"Cancel edit","editImage":"Edit image","chooseImage":"Choose image","selectAndCrop":"Select and crop","skipCropping":"Skip cropping","cropImage":"Crop image","cropYourImage":"Crop your image","cropping":"Cropping\u2026","suggestedDimensions":"Suggested image dimensions: %1$s by %2$s pixels.","cropError":"There has been an error cropping your image.","audioDetailsTitle":"Audio details","audioReplaceTitle":"Replace audio","audioAddSourceTitle":"Add audio source","audioDetailsCancel":"Cancel edit","videoDetailsTitle":"Video details","videoReplaceTitle":"Replace video","videoAddSourceTitle":"Add video source","videoDetailsCancel":"Cancel edit","videoSelectPosterImageTitle":"Select poster image","videoAddTrackTitle":"Add subtitles","playlistDragInfo":"Drag and drop to reorder tracks.","createPlaylistTitle":"Create audio playlist","editPlaylistTitle":"Edit audio playlist","cancelPlaylistTitle":"\u2190 Cancel audio playlist","insertPlaylist":"Insert audio playlist","updatePlaylist":"Update audio playlist","addToPlaylist":"Add to audio playlist","addToPlaylistTitle":"Add to Audio Playlist","videoPlaylistDragInfo":"Drag and drop to reorder videos.","createVideoPlaylistTitle":"Create video playlist","editVideoPlaylistTitle":"Edit video playlist","cancelVideoPlaylistTitle":"\u2190 Cancel video playlist","insertVideoPlaylist":"Insert video playlist","updateVideoPlaylist":"Update video playlist","addToVideoPlaylist":"Add to video playlist","addToVideoPlaylistTitle":"Add to video Playlist","filterAttachments":"Filter media","attachmentsList":"Media list","settings":{"tabs":[],"tabUrl":"http:\/\/template.test\/wp-admin\/media-upload.php?chromeless=1","mimeTypes":{"image":"Images","audio":"Audio","video":"Video","application\/msword,application\/vnd.openxmlformats-officedocument.wordprocessingml.document,application\/vnd.ms-word.document.macroEnabled.12,application\/vnd.ms-word.template.macroEnabled.12,application\/vnd.oasis.opendocument.text,application\/vnd.apple.pages,application\/pdf,application\/vnd.ms-xpsdocument,application\/oxps,application\/rtf,application\/wordperfect,application\/octet-stream":"Documents","application\/vnd.apple.numbers,application\/vnd.oasis.opendocument.spreadsheet,application\/vnd.ms-excel,application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application\/vnd.ms-excel.sheet.macroEnabled.12,application\/vnd.ms-excel.sheet.binary.macroEnabled.12":"Spreadsheets","application\/x-gzip,application\/rar,application\/x-tar,application\/zip,application\/x-7z-compressed":"Archives"},"captions":true,"nonce":{"sendToEditor":"fe521d77d4"},"post":{"id":118,"nonce":"8a2814f914","featuredImageId":-1},"defaultProps":{"link":"none","align":"","size":""},"attachmentCounts":{"audio":1,"video":1},"oEmbedProxyUrl":"http:\/\/template.test\/wp-json\/oembed\/1.0\/proxy","embedExts":["mp3","ogg","flac","m4a","wav","mp4","m4v","webm","ogv","flv","mov","avi","wmv"],"embedMimes":{"mp3":"audio\/mpeg","ogg":"audio\/ogg","flac":"audio\/flac","m4a":"audio\/mpeg","wav":"audio\/wav","mp4":"video\/mp4","m4v":"video\/mp4","webm":"video\/webm","ogv":"video\/ogg","flv":"video\/x-flv","mov":"video\/quicktime","avi":"video\/avi","wmv":"video\/x-ms-wmv"},"contentWidth":1170,"months":[{"year":"2021","month":"4","text":"April 2021"},{"year":"2019","month":"5","text":"May 2019"},{"year":"2019","month":"1","text":"January 2019"},{"year":"2018","month":"5","text":"May 2018"},{"year":"2018","month":"4","text":"April 2018"}],"mediaTrash":0}};
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
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/tinymce/tinymce.min.js?ver=49110-20201110')}}" id='wp-tinymce-root-js'></script>
<script type='text/javascript' src="{{asset('Dassets/wp-includes/js/tinymce/plugins/compat3x/plugin.min.js?ver=49110-20201110')}}" id='wp-tinymce-js'></script>
<script type='text/javascript'>
    tinymce.addI18n( 'en', {"Ok":"OK","Bullet list":"Bulleted list","Insert\/Edit code sample":"Insert\/edit code sample","Url":"URL","Spellcheck":"Check Spelling","Row properties":"Table row properties","Cell properties":"Table cell properties","Cols":"Columns","Paste row before":"Paste table row before","Paste row after":"Paste table row after","Cut row":"Cut table row","Copy row":"Copy table row","Merge cells":"Merge table cells","Split cell":"Split table cell","Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.":"Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.\n\nIf you\u2019re looking to paste rich content from Microsoft Word, try turning this option off. The editor will clean up text pasted from Word automatically.","Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help":"Rich Text Area. Press Alt-Shift-H for help.","You have unsaved changes are you sure you want to navigate away?":"The changes you made will be lost if you navigate away from this page.","Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X\/C\/V keyboard shortcuts instead.":"Your browser does not support direct access to the clipboard. Please use keyboard shortcuts or your browser\u2019s edit menu instead.","Edit|button":"Edit"});
    tinymce.ScriptLoader.markDone( "{{asset('Dassets/wp-includes/js/tinymce/langs/en.js')}}" );
</script>
<script type="text/javascript">
    tinyMCEPreInit = {
        baseURL: "http://template.test/wp-includes/js/tinymce",
        suffix: ".min",
        mceInit: {'question-details-add-66':{theme:"modern",skin:"lightgray",language:"en",formats:{alignleft: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}},{selector: "img,table,dl.wp-caption", classes: "alignleft"}],aligncenter: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},{selector: "img,table,dl.wp-caption", classes: "aligncenter"}],alignright: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},{selector: "img,table,dl.wp-caption", classes: "alignright"}],strikethrough: {inline: "del"}},relative_urls:false,remove_script_host:false,convert_urls:false,browser_spellcheck:true,fix_list_elements:true,entities:"38,amp,60,lt,62,gt",entity_encoding:"raw",keep_styles:false,cache_suffix:"wp-mce-49110-20201110",resize:"vertical",menubar:false,branding:false,preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",end_container_on_empty_block:true,wpeditimage_html5_captions:true,wp_lang_attr:"en-US",wp_keep_scroll_position:false,wp_shortcut_labels:{"Heading 1":"access1","Heading 2":"access2","Heading 3":"access3","Heading 4":"access4","Heading 5":"access5","Heading 6":"access6","Paragraph":"access7","Blockquote":"accessQ","Underline":"metaU","Strikethrough":"accessD","Bold":"metaB","Italic":"metaI","Code":"accessX","Align center":"accessC","Align right":"accessR","Align left":"accessL","Justify":"accessJ","Cut":"metaX","Copy":"metaC","Paste":"metaV","Select all":"metaA","Undo":"metaZ","Redo":"metaY","Bullet list":"accessU","Numbered list":"accessO","Insert\/edit image":"accessM","Insert\/edit link":"metaK","Remove link":"accessS","Toolbar Toggle":"accessZ","Insert Read More tag":"accessT","Insert Page Break tag":"accessP","Distraction-free writing mode":"accessW","Add Media":"accessM","Keyboard Shortcuts":"accessH"},content_css:"http://template.test/wp-includes/css/dashicons.min.css?ver=5.7,http://template.test/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=5.7",plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",selector:"#question-details-add-66",wpautop:true,indent:false,toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,spellchecker,wp_adv",toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",toolbar3:"",toolbar4:"",tabfocus_elements:":prev,:next",body_class:"question-details-add-66 post-type-question post-status-publish page-template-default locale-en-us"},'comment':{theme:"modern",skin:"lightgray",language:"en",formats:{alignleft: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}},{selector: "img,table,dl.wp-caption", classes: "alignleft"}],aligncenter: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},{selector: "img,table,dl.wp-caption", classes: "aligncenter"}],alignright: [{selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},{selector: "img,table,dl.wp-caption", classes: "alignright"}],strikethrough: {inline: "del"}},relative_urls:false,remove_script_host:false,convert_urls:false,browser_spellcheck:true,fix_list_elements:true,entities:"38,amp,60,lt,62,gt",entity_encoding:"raw",keep_styles:false,cache_suffix:"wp-mce-49110-20201110",resize:"vertical",menubar:false,branding:false,preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",end_container_on_empty_block:true,wpeditimage_html5_captions:true,wp_lang_attr:"en-US",wp_keep_scroll_position:false,wp_shortcut_labels:{"Heading 1":"access1","Heading 2":"access2","Heading 3":"access3","Heading 4":"access4","Heading 5":"access5","Heading 6":"access6","Paragraph":"access7","Blockquote":"accessQ","Underline":"metaU","Strikethrough":"accessD","Bold":"metaB","Italic":"metaI","Code":"accessX","Align center":"accessC","Align right":"accessR","Align left":"accessL","Justify":"accessJ","Cut":"metaX","Copy":"metaC","Paste":"metaV","Select all":"metaA","Undo":"metaZ","Redo":"metaY","Bullet list":"accessU","Numbered list":"accessO","Insert\/edit image":"accessM","Insert\/edit link":"metaK","Remove link":"accessS","Toolbar Toggle":"accessZ","Insert Read More tag":"accessT","Insert Page Break tag":"accessP","Distraction-free writing mode":"accessW","Add Media":"accessM","Keyboard Shortcuts":"accessH"},content_css:"http://template.test/wp-includes/css/dashicons.min.css?ver=5.7,http://template.test/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=5.7",plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview",selector:"#comment",wpautop:true,indent:false,toolbar1:"formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink,spellchecker,wp_adv",toolbar2:"strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",toolbar3:"",toolbar4:"",tabfocus_elements:":prev,:next",body_class:"comment post-type-question post-status-publish page-template-default locale-en-us"}},
        qtInit: {'question-details-add-66':{id:"question-details-add-66",buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close"},'comment':{id:"comment",buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close"}},
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
</x-app-layout>
