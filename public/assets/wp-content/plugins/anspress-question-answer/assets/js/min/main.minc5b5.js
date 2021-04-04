window.AnsPress=_.extend({models:{},views:{},collections:{},modals:{},loadTemplate:function(e){0==jQuery("#apTemplate").length&&jQuery('<script id="apTemplate" type="text/html"><\/script>').appendTo("body"),jQuery.get(apTemplateUrl+"/"+e+".html",function(e){var t=jQuery("#apTemplate");t.text(e+t.text()),AnsPress.trigger("templateLoaded")})},getTemplate:function(t){return function(){if(0==jQuery("#apTemplate").length)return"";var e=new RegExp("#START BLOCK "+t+" #([\\S\\s]*?)#END BLOCK "+t+" #","g").exec(jQuery("#apTemplate").text());return null==e?"":e[1]||void 0}},isJSONString:function(e){try{return jQuery.parseJSON(e)}catch(e){return!1}},ajaxResponse:function(e){if(void 0===(e=jQuery(e)).filter("#ap-response"))return console.log("Not a valid AnsPress ajax response."),{};e=this.isJSONString(e.filter("#ap-response").html());return e&&"undefined"!==e&&_.isObject(e)?e:{}},ajax:function(n){var i=this;n=_.defaults(n,{url:ajaxurl,method:"POST"}),_.isString(n.data)&&(n.data=jQuery.apParseParams(n.data)),void 0===n.data.action&&(n.data.action="ap_ajax");var o=n.success;return delete n.success,n.success=function(e){var t=n.context||null,s=i.ajaxResponse(e);s.snackbar&&AnsPress.trigger("snackbar",s),"function"==typeof o&&(e=jQuery.isEmptyObject(s)?e:s,o(e,t))},jQuery.ajax(n)},uniqueId:function(){return jQuery(".ap-uid").length},showLoading:function(e){AnsPress.hideLoading(e);var t=jQuery(e).data("loadclass")||"",s=jQuery(e).is('input[type="text"]'),n=this.uniqueId();if(!jQuery(e).is("button")&&!jQuery(e).is(".ap-btn")){var i=jQuery('<div class="ap-loading-icon ap-uid '+t+(s?" is-text":"")+'" id="apuid-'+n+'"><i></i></div>');jQuery("body").append(i);var o=jQuery(e).offset(),a=jQuery(e).outerHeight(),t=s?40:jQuery(e).outerWidth();return i.css({top:o.top,left:s?o.left+jQuery(e).outerWidth()-40:o.left,height:a,width:t}),jQuery(e).data("loading","#apuid-"+n),"#apuid-"+n}jQuery(e).addClass("show-loading"),$loading=jQuery('<span class="ap-loading-span"></span>'),$loading.height(jQuery(e).height()),$loading.width(jQuery(e).height()),jQuery(e).append($loading)},hideLoading:function(e){jQuery(e).is("button")||jQuery(e).is(".ap-btn")?(jQuery(e).removeClass("show-loading"),jQuery(e).find(".ap-loading-span").remove(),jQuery(e).prop("disabled",!1)):("all"==e?jQuery(".ap-loading-icon"):jQuery(jQuery(e).data("loading"))).hide()},getUrlParam:function(e){var t=jQuery.apParseParams(window.location.href);return void 0!==e?void 0!==t[e]?t[e]:null:t},modal:function(e,t){return t=t||{},void 0!==this.modals[e]||(this.modals[e]=new AnsPress.views.Modal(_.extend({id:"ap-modal-"+e,title:aplang.loading,content:"",size:"medium"},t)),jQuery("body").append(this.modals[e].render().$el)),this.modals[e]},hideModal:function(e,t){void 0===t&&(t=!0),void 0!==this.modals[e]&&(this.modals[e].hide(t),delete this.modals[e])},removeHash:function(){var e=window.location,t=document.body.scrollTop,s=document.body.scrollLeft;"pushState"in history?(history.pushState("",document.title,e.pathname+e.search),Backbone.history.navigate("/")):e.hash="",document.body.scrollTop=t,document.body.scrollLeft=s},loadCSS:function(e){var t=document.createElement("link");t.rel="stylesheet",t.href=e;e=document.getElementsByTagName("head")[0];e.parentNode.insertBefore(t,e)}},Backbone.Events),_.templateSettings={evaluate:/<#([\s\S]+?)#>/g,interpolate:/\{\{\{([\s\S]+?)\}\}\}/g,escape:/\{\{([^\}]+?)\}\}(?!\})/g},function(r){r.fn.autogrow=function(a){var e=r(this).css({overflow:"hidden",resize:"none"}),t=e.selector,s={context:r(document),animate:!0,speed:50,fixMinHeight:!0,cloneClass:"autogrowclone",onInitialize:!1};function i(e){var t,s=r(this),n=s.innerHeight(),i=this.scrollHeight,o=s.data("autogrow-start-height")||0;if(n<i)this.scrollTop=0,a.animate?s.stop().animate({height:i},a.speed):s.innerHeight(i);else if(!e||8==e.which||46==e.which||e.ctrlKey&&88==e.which)if(o<n){for(t=s.clone().addClass(a.cloneClass).css({position:"absolute",zIndex:-10,height:""}).val(s.val()),s.after(t);i=t[0].scrollHeight-1,t.innerHeight(i),i===t[0].scrollHeight;);i++,t.remove(),s.focus(),i<o&&(i=o),i<n&&a.animate?s.stop().animate({height:i},a.speed):s.innerHeight(i)}else s.innerHeight(o)}return a=r.isPlainObject(a)?a:{context:a||r(document)},a=r.extend({},s,a),e.each(function(e,t){var s,n;(t=r(t)).is(":visible")||0<parseInt(t.css("height"),10)?s=parseInt(t.css("height"),10)||t.innerHeight():(n=t.clone().addClass(a.cloneClass).val(t.val()).css({position:"absolute",visibility:"hidden",display:"block"}),r("body").append(n),s=n.innerHeight(),n.remove()),a.fixMinHeight&&t.data("autogrow-start-height",s),t.css("height",s),a.onInitialize&&t.length&&i.call(t[0])}),a.context.on("keyup paste focus",t,i),e},jQuery.fn.apScrollTo=function(e,t,s){t=t||!1;var n=r(this).scrollTop()-r(this).offset().top,t=t?r(this).offset().top+r(this).height():r(this).offset().top;return r("html, body").stop(),r("html, body").animate({scrollTop:t},null==s?1e3:s),null!=e&&r(this).animate({scrollTop:n+r(e).offset().top},null==s?1e3:s),this},AnsPress.views.Snackbar=Backbone.View.extend({id:"ap-snackbar",template:'<div class="ap-snackbar<# if(success){ #> success<# } #>">{{message}}</div>',hover:!1,initialize:function(){AnsPress.on("snackbar",this.show,this)},events:{mouseover:"toggleHover",mouseout:"toggleHover"},show:function(e){var t=this;this.data=e.snackbar,this.data.success=e.success,this.$el.removeClass("snackbar-show"),this.render(),setTimeout(function(){t.$el.addClass("snackbar-show")},0),this.hide()},toggleHover:function(){clearTimeout(this.hoveTimeOut),this.hover=!this.hover,this.hover||this.hide()},hide:function(){var e=this;e.hover||(this.hoveTimeOut=setTimeout(function(){e.$el.removeClass("snackbar-show")},5e3))},render:function(){var e;return this.data&&(e=_.template(this.template),this.$el.html(e(this.data))),this}}),AnsPress.views.Modal=Backbone.View.extend({className:"ap-modal",template:'<div class="ap-modal-body<# if(typeof size !== \'undefined\'){ #> ap-modal-{{size}}<# } #>"><div class="ap-modal-header"><# if(typeof title !== \'undefined\' ){ #><strong>{{title}}</strong><# } #><a href="#" ap="close-modal" class="ap-modal-close"><i class="apicon-x"></i></a></div><div class="ap-modal-content"><# if(typeof content !== \'undefined\'){ #>{{{content}}}<# } #></div><div class="ap-modal-footer"><# if(typeof buttons !== \'undefined\'){ #><# _.each(buttons, function(btn){ #><a class="ap-modal-btn <# if(typeof btn.class !== \'undefined\') { #>{{btn.class}}<# } #>" href="#" <# if(typeof btn.cb !== \'undefined\') { #>ap="{{btn.cb}}" apquery="{{btn.query}}"<# } #>>{{btn.label}}</a><# }); #><# } #></div></div><div class="ap-modal-backdrop"></div>',events:{'click [ap="close-modal"]':"clickHide",'click [ap="modal-click"]':"clickAction"},initialize:function(e){e.title=e.title||aplang.loading,this.data=e},render:function(){r("html").css("overflow","hidden");var e=_.template(this.template);return this.$el.html(e(this.data)),this},clickHide:function(e){e.preventDefault(),this.hide()},hide:function(e){void 0===e&&(e=!0),this.remove(),r("html").css("overflow",""),this.data.hideCb&&e&&this.data.hideCb(this);e=this.data.id.replace("ap-modal-","");void 0!==AnsPress.modals[e]&&delete AnsPress.modals[e]},setContent:function(e){this.$el.find(".ap-modal-content").html(e)},setTitle:function(e){this.$el.find(".ap-modal-header strong").text(e)},setFooter:function(e){this.$el.find(".ap-modal-footer").html(e)},clickAction:function(e){e.preventDefault();e=r(e.target);q=e.data("apquery"),q.cb&&(q.element=e,AnsPress.trigger(q.cb,q))}});function n(e){return decodeURIComponent(e.replace(/\+/g," "))}var i=/([^&=]+)=?([^&]*)/g;r.apParseParams=function(e){""===(e+="")&&(e=window.location+"");var t,s={};if(e){if(-1!==e.indexOf("#")&&(e=e.substr(0,e.indexOf("#"))),-1===e.indexOf("?"))return{};if(""==(e=e.substr(e.indexOf("?")+1,e.length)))return{};for(;t=i.exec(e);)!function e(t,s,n){var i,o;-1!==(s+="").indexOf(".")?(o=s.split("."),i=s.split(/\.(.+)?/)[1],t[o[0]]||(t[o[0]]={}),""!==i?e(t[o[0]],i,n):console.warn('parseParams :: empty property in key "'+s+'"')):-1!==s.indexOf("[")?(s=(o=s.split("["))[0],""==(o=(o=o[1].split("]"))[0])?((t=t||{})[s]&&r.isArray(t[s])||(t[s]=[]),t[s].push(n)):((t=t||{})[s]&&r.isArray(t[s])||(t[s]=[]),t[s][parseInt(o)]=n)):(t=t||{})[s]=n}(s,n(t[1]),n(t[2]))}return s}}(jQuery),function(s){AnsPress.Common={init:function(){AnsPress.on("showImgPreview",this.showImgPreview),AnsPress.on("formPosted",this.imageUploaded),AnsPress.on("ajaxBtnDone",this.uploadModal),AnsPress.on("ajaxBtnDone",this.commentModal),AnsPress.on("showModal",this.showModal)},readUrl:function(e,t){var s;e.files&&e.files[0]&&((s=new FileReader).onload=function(e){AnsPress.trigger("showImgPreview",e.target.result,t.find(".ap-upload-list"))},s.readAsDataURL(e.files[0]))},uploadModal:function(e){"ap_upload_modal"==e.action&&e.html&&($modal=AnsPress.modal("imageUpload",{title:e.title,content:e.html,size:"small"}),$modal.$el.find('input[type="file"]').on("change",function(){$modal.$el.find(".ap-img-preview").remove(),AnsPress.Common.readUrl(this,$modal.$el)}))},showImgPreview:function(e,t){s('<img class="ap-img-preview" src="'+e+'" />').appendTo(t)},imageUploaded:function(e){"ap_image_upload"===e.action&&"undefined"!=typeof tinymce&&(e.files&&s.each(e.files,function(e,t){tinymce.activeEditor.insertContent('<img src="'+t+'" />')}),AnsPress.hideModal("imageUpload"))},showModal:function(e){e.size=e.size||"medium",AnsPress.modal(e.name,{title:e.title,content:e.content,size:e.size})}}}(jQuery),jQuery(document).ready(function(i){AnsPress.Common.init();var e=new AnsPress.views.Snackbar;i("body").append(e.render().$el),i(document).click(function(e){e.stopPropagation(),i(e.target).is(".ap-dropdown-toggle")||i(e.target).closest(".open").is(".open")||i(e.target).closest("form").is("form")||i(".ap-dropdown").removeClass("open")}),i("body").on("click",".ap-dropdown-toggle, .ap-dropdown-menu > a",function(e){e.preventDefault(),i(".ap-dropdown").not(i(this).closest(".ap-dropdown")).removeClass("open"),i(this).closest(".ap-dropdown").toggleClass("open")}),i("[apsubscribe]").click(function(e){e.preventDefault();var t=i(this),e=JSON.parse(t.attr("apquery"));e.ap_ajax_action="subscribe",AnsPress.ajax({data:e,success:function(e){e.count&&t.next().text(e.count),e.label&&t.text(e.label)}})}),i("body").on("click",".ap-droptogg",function(e){e.preventDefault(),i(this).closest(".ap-dropdown").removeClass("open"),i(this).closest("#noti-dp").hide()}),i("body").on("click","[apajaxbtn]",function(t){var e,s=this;t.preventDefault(),"false"!=i(this).attr("aponce")&&i(this).is(".loaded")||(s=i(this),e=JSON.parse(s.attr("apquery")),AnsPress.showLoading(s),AnsPress.ajax({data:e,success:function(e){"false"!=i(this).attr("aponce")&&i(s).addClass("loaded"),AnsPress.hideLoading(t.target),AnsPress.trigger("ajaxBtnDone",e),void 0!==e.btn&&e.btn.hide&&s.hide(),void 0!==e.cb&&AnsPress.trigger(e.cb,e,t.target),e.modal&&AnsPress.trigger("showModal",e.modal)}}))}),i('[data-role="ap-repeatable"]').each(function(){i(this).find(".ap-repeatable-add").on("click",function(t){t.preventDefault();var s=i(this),e=JSON.parse(s.attr("apquery"));AnsPress.showLoading(s),$count=i('[name="'+e.id+'-groups"]'),e.current_groups=$count.val(),$count.val(parseInt(e.current_groups)+1),$nonce=i('[name="'+e.id+'-nonce"]'),e.current_nonce=$nonce.val(),AnsPress.ajax({data:e,success:function(e){AnsPress.hideLoading(t.target),i(e.html).insertBefore(s),$nonce.val(e.nonce)}})}),i(this).on("click",".ap-repeatable-delete",function(e){e.preventDefault(),i(this).closest(".ap-form-group").remove()})}),i("body").on("click",".ap-form-group",function(){i(this).removeClass("ap-have-errors")}),i("body").on("click","button.show-loading",function(e){e.preventDefault()}),i("body").on("submit","[apform]",function(e){e.preventDefault();var t=i(this),s=i(this).find('button[type="submit"]');0<s.length&&AnsPress.showLoading(s),i(this).ajaxSubmit({url:ajaxurl,beforeSerialize:function(){"undefined"!=typeof tinymce&&tinymce.triggerSave(),i(".ap-form-errors, .ap-field-errors").remove(),i(".ap-have-errors").removeClass("ap-have-errors")},success:function(e){0<s.length&&AnsPress.hideLoading(s),(e=AnsPress.ajaxResponse(e)).snackbar&&AnsPress.trigger("snackbar",e),"undefined"!=typeof grecaptcha&&"undefined"!=typeof widgetId1&&grecaptcha.reset(widgetId1),AnsPress.trigger("formPosted",e),void 0!==e.form_errors?($formError=i('<div class="ap-form-errors"></div>').prependTo(t),i.each(e.form_errors,function(e,t){$formError.append('<span class="ap-form-error ecode-'+e+'">'+t+"</div>")}),i.each(e.fields_errors,function(s,e){i(".ap-field-"+s).addClass("ap-have-errors"),i(".ap-field-"+s).find(".ap-field-errorsc").html('<div class="ap-field-errors"></div>'),i.each(e.error,function(e,t){i(".ap-field-"+s).find(".ap-field-errors").append('<span class="ap-field-error ecode-'+e+'">'+t+"</span>")})}),t.apScrollTo()):(e.hide_modal,AnsPress.hideModal(e.hide_modal)),void 0!==e.redirect&&(window.location=e.redirect)}})}),i(document).keyup(function(e){27==e.keyCode&&($lastModal=i(".ap-modal").last(),0<$lastModal.length&&($name=$lastModal.attr("id").replace("ap-modal-",""),AnsPress.hideModal($name)))}),AnsPress.on("loadedMoreActivities",function(e,t){i(e.html).insertAfter(i(".ap-activities:last-child")),i(t).closest(".ap-activity-item").remove()}),AnsPress.tagsPreset={tags:{delimiter:",",valueField:"term_id",labelField:"name",searchField:"name",persist:!1,render:{option:function(e,t){return'<div class="ap-tag-sugitem"><span class="name">'+t(e.name)+'</span><span class="count">'+t(e.count)+'</span><span class="description">'+t(e.description)+"</span></div>"}},create:!1,maxItems:4}},AnsPress.tagElements=function(e){var t=e.data("type"),s=e.data("options"),n=0<i("#"+s.id+"-options").length?JSON.parse(i("#"+s.id+"-options").html()):{},t=AnsPress.tagsPreset[t];t.options=n,t.maxItems=s.maxItems,!1!==s.create&&(t.create=function(e){return{term_id:e,name:e,description:"",count:0}}),t.load=function(e,t){if(!e.length)return t();jQuery.ajax({url:ajaxurl,type:"GET",dataType:"json",data:{action:"ap_search_tags",q:e,__nonce:s.nonce,form:s.form,field:s.field},error:function(){t()},success:function(e){t(e)}})},t.render={option_create:function(e,t){return'<div class="create">'+s.labelAdd+" <strong>"+t(e.input)+"</strong>&hellip;</div>"}},e.selectize(t)},i("[aptagfield]").each(function(){AnsPress.tagElements(i(this))}),i("#anspress").on("click",".ap-remove-parent",function(e){e.preventDefault(),i(this).parent().remove()})}),window.AnsPress.Helper={toggleNextClass:function(e){jQuery(e).closest(".ap-field-type-group").find(".ap-fieldgroup-c").toggleClass("show")}},function(i){AnsPress.models.Action=Backbone.Model.extend({defaults:{cb:"",post_id:"",title:"",label:"",query:"",active:!1,header:!1,href:"#",count:"",prefix:"",checkbox:"",multiple:!1}}),AnsPress.collections.Actions=Backbone.Collection.extend({model:AnsPress.models.Action}),AnsPress.views.Action=Backbone.View.extend({id:function(){return this.postID},className:function(){var e="";return this.model.get("header")&&(e+=" ap-dropdown-header"),this.model.get("active")&&(e+=" active"),e},tagName:"li",template:'<# if(!header){ #><a href="{{href}}" title="{{title}}">{{{prefix}}}{{label}}<# if(count){ #><b>{{count}}</b><# } #></a><# } else { #>{{label}}<# } #>',initialize:function(e){this.model=e.model,this.postID=e.postID,this.model.on("change",this.render,this),this.listenTo(this.model,"remove",this.removed)},events:{"click a":"triggerAction"},render:function(){var e=_.template(this.template);return this.$el.html(e(this.model.toJSON())),this.$el.attr("class",this.className()),this},triggerAction:function(t){var s,n,e=this.model.get("query");_.isEmpty(e)||(t.preventDefault(),s=this,AnsPress.showLoading(t.target),n=this.model.get("cb"),e.ap_ajax_action="action_"+n,AnsPress.ajax({data:e,success:function(e){AnsPress.hideLoading(t.target),e.redirect&&(window.location=e.redirect),!e.success||"status"!=n&&"toggle_delete_post"!=n||AnsPress.trigger("changedPostStatus",{postID:s.postID,data:e,action:s.model}),e.action&&s.model.set(e.action),s.renderPostMessage(e),e.deletePost&&AnsPress.trigger("deletePost",e.deletePost),e.answersCount&&AnsPress.trigger("answerCountUpdated",e.answersCount)}}))},renderPostMessage:function(e){_.isEmpty(e.postmessage)?i('[apid="'+this.postID+'"]').find("postmessage").html(""):i('[apid="'+this.postID+'"]').find("postmessage").html(e.postmessage)},removed:function(){this.remove()}}),AnsPress.views.Actions=Backbone.View.extend({id:function(){return this.postID},searchTemplate:'<div class="ap-filter-search"><input type="text" search-filter placeholder="'+aplang.search+'" /></div>',tagName:"ul",className:"ap-actions",events:{"keyup [search-filter]":"searchInput"},initialize:function(e){this.model=e.model,this.postID=e.postID,this.multiple=e.multiple,this.action=e.action,this.nonce=e.nonce,AnsPress.on("changedPostStatus",this.postStatusChanged,this),this.listenTo(this.model,"add",this.added)},renderItem:function(e){e=new AnsPress.views.Action({model:e,postID:this.postID});this.$el.append(e.render().$el)},render:function(){var t=this;return this.multiple&&this.$el.append(this.searchTemplate),this.model.each(function(e){t.renderItem(e)}),this},postStatusChanged:function(e){e.postID===this.postID&&(i("#post-"+this.postID).removeClass(function(){return this.className.split(" ").filter(function(e){return e.match(/status-/)}).join(" ")}),i("#post-"+this.postID).addClass("status-"+e.data.newStatus),this.model.where({cb:"status",active:!0}).forEach(function(e){e.set({active:!1})}))},searchInput:function(e){var t=this;clearTimeout(this.searchTO),this.searchTO=setTimeout(function(){t.search(i(e.target).val(),e.target)},600)},search:function(e,t){var s=this,e={nonce:this.nonce,ap_ajax_action:this.action,search:e,filter:this.filter,post_id:this.postID};AnsPress.showLoading(t),AnsPress.ajax({data:e,success:function(e){if(console.log(e),AnsPress.hideLoading(t),e.success){for(s.nonce=e.nonce;m=s.model.first();)s.model.remove(m);s.model.add(e.actions)}}})},added:function(e){this.renderItem(e)}}),AnsPress.models.Post=Backbone.Model.extend({idAttribute:"ID",defaults:{actionsLoaded:!1,hideSelect:""}}),AnsPress.views.Post=Backbone.View.extend({idAttribute:"ID",templateId:"answer",tagName:"div",actions:{view:{},model:{}},id:function(){return"post-"+this.model.get("ID")},initialize:function(e){this.listenTo(this.model,"change:vote",this.voteUpdate),this.listenTo(this.model,"change:hideSelect",this.selectToggle)},events:{"click [ap-vote] > a":"voteClicked",'click [ap="actiontoggle"]:not(.loaded)':"postActions",'click [ap="select_answer"]':"selectAnswer"},voteClicked:function(e){var t,s,n;e.preventDefault(),i(e.target).is(".disable")||(self=this,t=i(e.target).is(".vote-up")?"vote_up":"vote_down",s=_.clone(self.model.get("vote")),(n=_.clone(s)).net="vote_up"==t?"vote_up"===n.active?n.net-1:n.net+1:"vote_down"===n.active?n.net+1:n.net-1,self.model.set("vote",n),(e=i.parseJSON(i(e.target).parent().attr("ap-vote"))).ap_ajax_action="vote",e.type=t,AnsPress.ajax({data:e,success:function(e){e.success&&_.isObject(e.voteData)?self.model.set("vote",e.voteData):self.model.set("vote",s)}}))},voteUpdate:function(e){var t=this;this.$el.find('[ap="votes_net"]').text(this.model.get("vote").net),_.each(["up","down"],function(e){t.$el.find(".vote-"+e).removeClass("voted disable").addClass(t.voteClass("vote_"+e))})},voteClass:function(e){e=e||"vote_up";var t=this.model.get("vote").active,s="vote_down"===t&&"vote_down"===e?"active":"vote_up"===t&&"vote_up"===e?"active":"";return e!==t&&""!==t&&(s+=" disable"),s+" prist"},render:function(){var e=this.$el.find("[ap-vote]").attr("ap-vote");try{this.model.set("vote",i.parseJSON(e),{silent:!0})}catch(e){console.warn("Vote data empty",e)}return this},postActions:function(t){var s=this,e=i.parseJSON(i(t.target).attr("apquery"));void 0===e.ap_ajax_action&&(e.ap_ajax_action="post_actions"),AnsPress.ajax({data:e,success:function(e){AnsPress.hideLoading(t.target),i(t.target).addClass("loaded"),s.actions.model=new AnsPress.collections.Actions(e.actions),s.actions.view=new AnsPress.views.Actions({model:s.actions.model,postID:s.model.get("ID")}),s.$el.find("postActions .ap-actions").html(s.actions.view.render().$el)}})},selectAnswer:function(t){t.preventDefault();var s=this,e=i.parseJSON(i(t.target).attr("apquery"));e.action="ap_toggle_best_answer",AnsPress.showLoading(t.target),AnsPress.ajax({data:e,success:function(e){AnsPress.hideLoading(t.target),e.success&&(e.selected?(s.$el.addClass("best-answer"),i(t.target).addClass("active").text(e.label),AnsPress.trigger("answerToggle",[s.model,!0])):(s.$el.removeClass("best-answer"),i(t.target).removeClass("active").text(e.label),AnsPress.trigger("answerToggle",[s.model,!1])))}})},selectToggle:function(){this.model.get("hideSelect")?this.$el.find('[ap="select_answer"]').addClass("hide"):this.$el.find('[ap="select_answer"]').removeClass("hide")}}),AnsPress.collections.Posts=Backbone.Collection.extend({model:AnsPress.models.Post,initialize:function(){var t=[];i('[ap="question"],[ap="answer"]').each(function(e){t.push({ID:i(this).attr("apId")})}),this.add(t)}}),AnsPress.views.SingleQuestion=Backbone.View.extend({initialize:function(){this.listenTo(this.model,"add",this.renderItem),AnsPress.on("answerToggle",this.answerToggle,this),AnsPress.on("deletePost",this.deletePost,this),AnsPress.on("answerCountUpdated",this.answerCountUpdated,this),AnsPress.on("formPosted",this.formPosted,this),this.listenTo(AnsPress,"commentApproved",this.commentApproved),this.listenTo(AnsPress,"commentDeleted",this.commentDeleted),this.listenTo(AnsPress,"commentCount",this.commentCount),this.listenTo(AnsPress,"formPosted",this.submitComment)},events:{'click [ap="loadEditor"]':"loadEditor"},renderItem:function(e){new AnsPress.views.Post({model:e,el:'[apId="'+e.get("ID")+'"]'}).render()},render:function(){var t=this;return this.model.each(function(e){t.renderItem(e)}),t},loadEditor:function(t){AnsPress.showLoading(t.target),AnsPress.ajax({data:i(t.target).data("apquery"),success:function(e){AnsPress.hideLoading(t.target),i("#ap-form-main").html(e),i(t.target).closest(".ap-minimal-editor").removeClass("ap-minimal-editor")}})},formPosted:function(e){e.success&&"answer"===e.form&&(AnsPress.trigger("answerFormPosted",e),i("apanswersw").show(),tinymce.remove(),i("#ap-form-main").html(""),i("#answer-form-c").addClass("ap-minimal-editor"),i("apanswers").append(i(e.html).hide()),i(e.div_id).slideDown(300),i(e.div_id).apScrollTo(null,!0),this.model.add({ID:e.ID}),AnsPress.trigger("answerCountUpdated",e.answersCount))},answerToggle:function(s){this.model.forEach(function(e,t){s[0]!==e&&e.set("hideSelect",s[1])})},deletePost:function(e){this.model.remove(e),i("#post-"+e).slideUp(400,function(){i(this).remove()})},answerCountUpdated:function(e){i('[ap="answers_count_t"]').text(e.text)},commentApproved:function(e,t){i("#comment-"+e.comment_ID).removeClass("unapproved"),i(t).remove(),e.commentsCount&&AnsPress.trigger("commentCount",{count:e.commentsCount,postID:e.post_ID})},commentDeleted:function(e,t){i(t).closest("apcomment").css("background","red"),setTimeout(function(){i(t).closest("apcomment").remove()},1e3),e.commentsCount&&AnsPress.trigger("commentCount",{count:e.commentsCount,postID:e.post_ID})},commentCount:function(e){var t=i('[apid="'+e.postID+'"]');t.find("[ap-commentscount-text]").text(e.count.text),0<e.count.unapproved?t.find("[ap-un-commentscount]").addClass("have"):t.find("[ap-un-commentscount]").removeClass("have"),t.find("[ap-un-commentscount]").text(e.count.unapproved)},submitComment:function(e){"new-comment"===e.action&&"edit-comment"===e.action||e.success&&(AnsPress.hideModal("commentForm"),"new-comment"===e.action&&i("#comments-"+e.post_id).html(e.html),"edit-comment"===e.action&&($old=i("#comment-"+e.comment_id),i(e.html).insertAfter($old),$old.remove(),i("#comment-"+e.comment_id).css("backgroundColor","rgba(255, 235, 59, 1)"),setTimeout(function(){i("#comment-"+e.comment_id).removeAttr("style")},500)),e.commentsCount&&AnsPress.trigger("commentCount",{count:e.commentsCount,postID:e.post_id}))}});var t=Backbone.Router.extend({routes:{"comment/:commentID":"commentRoute","comments/:postID/all":"commentsRoute","comments/:postID":"commentsRoute"},commentRoute:function(e){self=this,AnsPress.hideModal("comment",!1),$modal=AnsPress.modal("comment",{content:"",size:"medium",hideCb:function(){AnsPress.removeHash()}}),$modal.$el.addClass("single-comment"),AnsPress.showLoading($modal.$el.find(".ap-modal-content")),AnsPress.ajax({data:{comment_id:e,ap_ajax_action:"load_comments"},success:function(e){e.success&&($modal.setTitle(e.modal_title),$modal.setContent(e.html),AnsPress.hideLoading($modal.$el.find(".ap-modal-content")))}})},commentsRoute:function(t,e){self=this,AnsPress.ajax({data:{post_id:t,ap_ajax_action:"load_comments"},success:function(e){i("#comments-"+t).html(e.html)}})},editCommentsRoute:function(e){self=this,AnsPress.hideModal("commentForm",!1),AnsPress.modal("commentForm",{hideCb:function(){AnsPress.removeHash()}}),AnsPress.showLoading(AnsPress.modal("commentForm").$el.find(".ap-modal-content")),AnsPress.ajax({data:{comment:e,ap_ajax_action:"comment_form"},success:function(e){AnsPress.hideLoading(AnsPress.modal("commentForm").$el.find(".ap-modal-content")),AnsPress.modal("commentForm").setTitle(e.modal_title),AnsPress.modal("commentForm").setContent(e.html)}})}});i('[ap="actiontoggle"]').click(function(){i(this).is(".loaded")||AnsPress.showLoading(this)}),i(document).ready(function(){var e=new AnsPress.collections.Posts;new AnsPress.views.SingleQuestion({model:e,el:"#anspress"}).render();new t;Backbone.History.started||Backbone.history.start()})}(jQuery),function(n){AnsPress.views.AskView=Backbone.View.extend({initialize:function(){},events:{'keyup [data-action="suggest_similar_questions"]':"questionSuggestion"},suggestTimeout:null,questionSuggestion:function(t){var e,s=this;disable_q_suggestion||0!=(e=n(t.target).val()).length&&(null!=s.suggestTimeout&&clearTimeout(s.suggestTimeout),s.suggestTimeout=setTimeout(function(){s.suggestTimeout=null,AnsPress.ajax({data:{ap_ajax_action:"suggest_similar_questions",__nonce:ap_nonce,value:e},success:function(e){n("#similar_suggestions").remove(),e.html&&0===n("#similar_suggestions").length&&n(t.target).parent().append('<div id="similar_suggestions"></div>'),n("#similar_suggestions").html(e.html)}})},800))}});new AnsPress.views.AskView({el:"#ap-ask-page"})}(jQuery),function(i){AnsPress.models.Filter=Backbone.Model.extend({defaults:{active:!1,label:"",value:""}}),AnsPress.collections.Filters=Backbone.Collection.extend({model:AnsPress.models.Filter}),AnsPress.activeListFilters=0<i("#ap_current_filters").length?JSON.parse(i("#ap_current_filters").html()):{},AnsPress.views.Filter=Backbone.View.extend({id:function(){return this.model.id},nameAttr:function(){return this.multiple?this.model.get("key")+"[]":this.model.get("key")},isActive:function(){if(this.model.get("active"))return this.model.get("active");if(this.active)return this.active;var e=AnsPress.getUrlParam(this.model.get("key"));if(!_.isEmpty(e)){var t=this.model.get("value");if(!_.isArray(e)&&e===t)return!0;if(_.contains(e,t))return this.active=!0}return this.active=!1},className:function(){return this.isActive()?"active":""},inputType:function(){return this.multiple?"checkbox":"radio"},initialize:function(e){this.model=e.model,this.multiple=e.multiple,this.listenTo(this.model,"remove",this.removed)},template:'<label><input type="{{inputType}}" name="{{name}}" value="{{value}}"<# if(active){ #> checked="checked"<# } #>/><i class="apicon-check"></i>{{label}}<# if(typeof color !== "undefined"){ #> <span class="ap-label-color" style="background: {{color}}"></span><# } #></label>',events:{"change input":"clickFilter"},render:function(){var e=_.template(this.template),t=this.model.toJSON();return t.name=this.nameAttr(),t.active=this.isActive(),t.inputType=this.inputType(),this.removeHiddenField(),this.$el.html(e(t)),this},removeHiddenField:function(){i('input[name="'+this.nameAttr()+'"][value="'+this.model.get("value")+'"]').remove()},clickFilter:function(e){e.preventDefault(),i(e.target).closest("form").submit()},removed:function(){this.remove()}}),AnsPress.views.Filters=Backbone.View.extend({className:"ap-dropdown-menu",searchTemplate:'<div class="ap-filter-search"><input type="text" search-filter placeholder="'+aplang.search+'" /></div>',template:'<button class="ap-droptogg apicon-x"></button><filter-items></filter-items>',initialize:function(e){this.model=e.model,this.multiple=e.multiple,this.filter=e.filter,this.nonce=e.nonce,this.listenTo(this.model,"add",this.added),this.listenTo(this.model,"reset",this.destroy)},events:{"keypress [search-filter]":"searchInput"},renderItem:function(e){e=new AnsPress.views.Filter({model:e,multiple:this.multiple});this.$el.find("filter-items").append(e.render().$el)},render:function(){var t=this;return this.multiple&&this.$el.append(this.searchTemplate),this.$el.append(this.template),this.model.each(function(e){t.renderItem(e)}),this},search:function(e,t){var s=this,e={__nonce:this.nonce,ap_ajax_action:"load_filter_"+this.filter,search:e,filter:this.filter};AnsPress.showLoading(t),AnsPress.ajax({data:e,success:function(e){if(AnsPress.hideLoading(t),e.success){for(s.nonce=e.nonce;model=s.model.first();)model.destroy();s.model.add(e.items)}}})},searchInput:function(e){var t=this;clearTimeout(this.searchTO),this.searchTO=setTimeout(function(){t.search(i(e.target).val(),e.target)},600)},added:function(e){this.renderItem(e)},destroy:function(){console.log("deleted"),this.undelegateEvents(),this.$el.removeData().unbind(),this.remove(),Backbone.View.prototype.remove.call(this)}}),AnsPress.views.List=Backbone.View.extend({el:"#ap-filters",initialize:function(){},events:{"click [ap-filter]":"loadFilter","click #ap-filter-reset":"resetFilter"},loadFilter:function(s){s.preventDefault();AnsPress.showLoading(s.currentTarget);var n=i.parseJSON(i(s.currentTarget).attr("apquery"));n.ap_ajax_action="load_filter_"+n.filter,AnsPress.ajax({data:n,success:function(e){AnsPress.hideLoading(s.currentTarget),i(s.currentTarget).addClass("loaded");var t=new AnsPress.collections.Filters(e.items),e=new AnsPress.views.Filters({model:t,multiple:e.multiple,filter:n.filter,nonce:e.nonce});i(s.currentTarget).parent().find(".ap-dropdown-menu").remove(),i(s.currentTarget).after(e.render().$el)}})},resetFilter:function(e){i('#ap-filters input[type="hidden"]').remove(),i('#ap-filters input[type="checkbox"]').prop("checked",!1)}}),i(document).ready(function(){new AnsPress.views.List})}(jQuery),function(e){AnsPress.models.Notification=Backbone.Model.extend({idAttribute:"ID",defaults:{ID:"",verb:"",verb_label:"",icon:"",avatar:"",hide_actor:"",actor:"",ref_title:"",ref_type:"",points:"",date:"",permalink:"",seen:""}}),AnsPress.collections.Notifications=Backbone.Collection.extend({model:AnsPress.models.Notification}),AnsPress.views.Notification=Backbone.View.extend({id:function(){return"noti-"+this.model.id},template:'<div class="noti-item clearfix {{seen==1 ? \'seen\' : \'unseen\'}}"><# if(ref_type === \'reputation\') { #>  <div class="ap-noti-rep<# if(points < 1) { #> negative<# } #>">{{points}}</div><# } else if(hide_actor) { #><div class="ap-noti-icon {{icon}}"></div><# } else { #><div class="ap-noti-avatar">{{{avatar}}}</div><# } #><a class="ap-noti-inner" href="{{permalink}}"><# if(ref_type !== \'reputation\'){ #><strong class="ap-not-actor">{{actor}}</strong><# } #> {{verb_label}} <strong class="ap-not-ref">{{ref_title}}</strong><time class="ap-noti-date">{{date}}</time></a></div>',initialize:function(e){this.model=e.model},render:function(){var e=_.template(this.template);return this.$el.html(e(this.model.toJSON())),this}}),AnsPress.views.Notifications=Backbone.View.extend({template:'<button class="ap-droptogg apicon-x"></button><div class="ap-noti-head">{{aplang.notifications}}<# if(total > 0) { #><i class="ap-noti-unseen">{{total}}</i><a href="#" class="ap-btn ap-btn-markall-read ap-btn-small" apajaxbtn apquery="{{JSON.stringify(mark_args)}}">{{aplang.mark_all_seen}}</a><# } #></div><div class="scroll-wrap"></div>',initialize:function(e){this.model=e.model,this.mark_args=e.mark_args,this.total=e.total,this.listenTo(this.model,"add",this.newNoti),this.listenTo(AnsPress,"notificationAllRead",this.allRead)},renderItem:function(e){e=new AnsPress.views.Notification({model:e});return this.$el.find(".scroll-wrap").append(e.render().$el),e},render:function(){var t=this,e=_.template(this.template);return this.$el.html(e({mark_args:this.mark_args,total:this.total})),0<this.model.length&&this.model.each(function(e){t.renderItem(e)}),this},newNoti:function(e){this.renderItem(e)},allRead:function(){this.total=0,this.model.each(function(e){e.set("seen",1)}),this.render()}}),AnsPress.views.NotiDropdown=Backbone.View.extend({id:"noti-dp",initialize:function(e){this.anchor=e.anchor,this.fetched=!1},dpPos:function(){var e=this.anchor.offset();e.top=e.top+this.anchor.height(),e.left=e.left-this.$el.width()+this.anchor.width(),this.$el.css(e)},fetchNoti:function(e,t){var s;this.fetched?this.dpPos():(s=this,AnsPress.ajax({data:ajaxurl+"?action=ap_ajax&ap_ajax_action=get_notifications",success:function(e){var t;s.fetched=!0,e.success&&(t=new AnsPress.collections.Notifications(e.notifications),e=new AnsPress.views.Notifications({model:t,mark_args:e.mark_args,total:e.total}),s.$el.html(e.render().$el),s.dpPos(),s.$el.show())}}))},render:function(){return this.$el.hide(),this}}),e(document).ready(function(){var t=e('a[href="#apNotifications"]'),s=new AnsPress.views.NotiDropdown({anchor:t});e("body").append(s.render().$el),t.click(function(e){e.preventDefault(),s.fetchNoti(),s.fetched&&s.$el.toggle()}),e(document).mouseup(function(e){t.is(e.target)||s.$el.is(e.target)||0!==s.$el.has(e.target).length||s.$el.hide()})})}(jQuery);
//# sourceMappingURL=main.min.js.map