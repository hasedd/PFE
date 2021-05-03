(function ($) {
    "use strict";
    $(document).ready(function() {
        $('body').on('click', '#scisco-follow-btns .scisco-follow,#scisco-follow-btns .scisco-unfollow', function(e) {
            e.preventDefault();
            var $me = $(this),
                action = 'scisco_follow';
            if ($me.hasClass('scisco-unfollow')) action = 'scisco_unfollow';
            var data = $.extend(true, $me.data(), {
                action: action,
                _ajax_nonce: admin_ajax.nonce
            });
            $.post(admin_ajax.url, data, function(response) {
                if(response == '0' || response == '-1'){
                } else {
                    $($me).parent().empty().html(response);
                }
            });
        });
    });
})(jQuery);