( function( $ ) {
	$( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/scisco-masonry.default', function($scope){
            $scope.find('.scisco-masonry-grid2').egemenerdMasonry();
        });
	} );
} )( jQuery );