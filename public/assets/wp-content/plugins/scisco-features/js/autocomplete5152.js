(function( $ ) {
	$(function() {
		var url = sciscoAutocomplete.url + "?action=scisco_ajax_search";
        var url2 = sciscoAutocomplete.url + "?action=scisco_ajax_post_search";
        var url3 = sciscoAutocomplete.url + "?action=scisco_ajax_woo_search";
        
        // Questions
		$( "body" ).find('.autocomplete-questions').autocomplete({
            source: url,
            search: function(){
                $(this).addClass('scisco_ajax_search_loading');
            },
            open : function(){
                $(this).removeClass('scisco_ajax_search_loading');
            },
            select: function( event, ui ) { 
                event.preventDefault();
                window.location.href = ui.item.value;
            },
			delay: 500,
			minLength: 3
		});	
        
        // Blog
        $("body").find('.autocomplete-posts').autocomplete({
            source: url2,
            search: function () {
                $(this).addClass('scisco_ajax_search_loading');
            },
            open: function () {
                $(this).removeClass('scisco_ajax_search_loading');
            },
            select: function (event, ui) {
                event.preventDefault();
                window.location.href = ui.item.value;
            },
            delay: 500,
            minLength: 3
        });

        // WooCommerce
        $("body").find('.autocomplete-products').autocomplete({
            source: url3,
            search: function () {
                $(this).addClass('scisco_ajax_search_loading');
            },
            open: function () {
                $(this).removeClass('scisco_ajax_search_loading');
            },
            select: function (event, ui) {
                event.preventDefault();
                window.location.href = ui.item.value;
            },
            delay: 500,
            minLength: 3
        });
    });
    
})( jQuery );