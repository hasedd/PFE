jQuery(document).ready(function(a){var b=scisco_vars.scisco_plugin_dir,c=scisco_vars.scisco_js_script_ajax_nonce;jQuery(".scisco_verified_user").on("click",'img',function(a){"no"==jQuery(this).attr("verified")?jQuery(this).attr({src:b+"/images/active_user.png",verified:"yes"}):jQuery(this).attr({src:b+"/images/inactive_user.png",verified:"no"});var d=jQuery(this).attr("verified"),e=jQuery(this).attr("user-id");jQuery.post(scisco_vars.scisco_ajax_url,{action:"scisco_toggle_verified_user_status",verified:d,user_id:e,scisco_js_script_ajax_nonce:c},function(a){console.log(a)})})});