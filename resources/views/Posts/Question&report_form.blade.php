<div class="put-wrap-pop">
</div>
<div class="panel-pop panel-pop-login" id="wpqa-question" data-width="690">
    <i class="icon-cancel"></i>
    <div class="panel-pop-content">
        <form class="form-post wpqa_form" action="{{route('Add_Question')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-inputs clearfix">
                <p>
                    <label for="question-title-451">Question Title<span class="required">*</span></label>
                    <input name="title" id="question-title-451" class="the-title" type="text" value="">
                    <i class="icon-chat"></i>

                    <span class="form-description">Please choose an appropriate title for the question so it can be answered easily.</span>
                </p>
                <br>
                <div class="wpqa_category">
                    <label for="question-category-451">Category<span class="required">*</span></label>
                    <span class="styled-select">
                    <select  name='category' id='question-category-451' class='postform' >
	                    <option value='-1'>Select a Category</option>
	                    @foreach($categories as $category)
                            <option class="level-0" value={{$category->name}}>{{$category->name}}</option>
                        @endforeach
                    <!-- <option class="level-0" value="6">Communication</option>
	                    <option class="level-0" value="7">Company</option>
	                    <option class="level-0" value="20">Language</option>
                        <option class="level-0" value="23">Management</option>
                        <option class="level-0" value="26">Programmers</option>
                        <option class="level-0" value="27">Programs</option>
                        <option class="level-0" value="30">University</option> -->
                    </select>
                    </span><i class="icon-folder"></i>
                    <span class="form-description">Please choose the appropriate section so the question can be searched easily.</span>
                </div><p class="wpqa_tag">
                    <label for="question_tags-451">Tags</label>
                    <input type="text" class="input question_tags" name="tags" id="question_tags-451" value="" data-seperator=",">
                    <span class="form-description">Please choose suitable Keywords Ex: <span class="color">question, poll</span>.</span>
                </p>
                <br>
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
                    <label for="featured_image-451">Add files</label>
                    <div class="clearfix"></div>
                    <div class="fileinputs">
                        <input type="file" class="file" name="file[]" id="featured_image-451" multiple>
                        <i class="icon-camera"></i>
                        <div class="fakefile">
                            <button type="button">Select files</button>
                            <span>Browse</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div><div class="wpqa_textarea">
                    <label for="question-details-add-451">Details<span class="required">*</span></label><div class="the-details the-textarea"><div id="wp-question-details-add-451-wrap" class="wp-core-ui wp-editor-wrap tmce-active"><link rel='stylesheet' id='editor-buttons-css'  href='Dassets/wp-includes/css/editor.min.css?ver=5.7' type='text/css' media='all' />

                            <div id="wp-question-details-add-451-editor-container" class="wp-editor-container"><div id="qt_question-details-add-451_toolbar" class="quicktags-toolbar"></div><textarea class="wp-editor-area" rows="10" autocomplete="off" cols="40" name="content" id="question-details-add-451"></textarea></div>
                        </div>

                    </div>
                    <span class="form-description">Type the description thoroughly and in details.</span>
                </div>
                <!--<p class="wpqa_checkbox_p ask_remember_answer_p">
                    <label for="remember_answer-451">
                        <span class="wpqa_checkbox"><input type="checkbox" id="remember_answer-451" class="remember_answer" name="remember_answer" value="on" checked='checked'></span>
                        <span class="wpqa_checkbox_span">Get notified by email when someone answers this question.</span>
                    </label>-->
                </p><p class="wpqa_checkbox_p">
                    <label for="terms_active-451">
                        <span class="wpqa_checkbox"><input type="checkbox" id="terms_active-451" name="terms_active" value="on" ></span>
                        <span class="wpqa_checkbox_span">By asking your question, you agree to the <a target="_blank" href="http://template.test/faqs/"> Terms of Service </a>  and <a target="_blank" href="http://template.test/faqs/"> Privacy Policy </a>.<span class="required">*</span></span>
                    </label>
                </p>
                <br>
            </div>

            <p class="form-submit"><input type="hidden" name="question_popup" value="popup"><input type="hidden" name="form_type" value="add_question">
                <input type="hidden" name="wpqa_add_question_nonce" value="468aff96d4">
                <input type="submit" value="Publish Your Question" class="button-default button-hide-click">
                <span class="load_span"><span class="loader_2"></span></span>
            </p>

        </form>					</div><!-- End panel-pop-content -->
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
                <input type="hidden" id="wpqa_report_nonce" name="wpqa_report_nonce" value="52e42f9a8a" />								<input type="submit" value="Report" class="button-default button-hide-click">
            </p>
            <input type="hidden" name="form_type" value="wpqa-report">
            <input type="hidden" name="post_id" value="64">
        </form>
    </div><!-- End panel-pop-content -->
</div><!-- End wpqa-report -->
