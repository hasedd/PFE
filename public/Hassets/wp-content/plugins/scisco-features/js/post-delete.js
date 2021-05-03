(function( $ ) {
    var url = sciscoPostAjax.url + "?action=scisco_delete_post";
    
    $(document).on( 'click', '#scisco-delete-post', function() {
        var id = $(this).data('id');
        var nonce = $(this).data('nonce');
        var post = $(this).parent().parent();
        $.ajax({
            type: 'post',
            url: url,
            data: {
                action: 'scisco_delete_post',
                nonce: nonce,
                id: id
            },
            success: function( result ) {
                if( result == 'success' ) {
                    post.empty();
                    post.html('<div class="alert alert-danger">' + sciscoPostAjax.msg + '</div>');
                }
            }
        })
        return false;
    });
    
})( jQuery );