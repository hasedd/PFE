( function( $ ) {
	$( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/scisco-progressbar.default', function($scope){
            var progressBar = $scope.find(".progress-bar");
            progressBar.css("width", progressBar.attr("aria-valuenow") + "%");
            progressBar.css({
                animation: "animate-positive 3s",
                opacity: "1"
            });
        });
	} );
} )( jQuery );