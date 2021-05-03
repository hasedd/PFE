( function ( exports, $ ) {
    "use strict";
    $(document).ready(function () {
        // Sub title toggles
        var $subtitle = $("#customize-controls").find(".customize-control-subtitle");
        $subtitle.nextUntil(".customize-control-subtitle").hide();
        $subtitle.prev().addClass('last-child');
        $subtitle.next().addClass('first-child');
        $subtitle.on("click", function (e) {
            $(this).find("h2.scisco-customizer-title").toggleClass('opened');
            $(this).nextUntil(".customize-control-subtitle").toggle();
        });
    });
} )( wp, jQuery );