(function ($) {
    "use strict";

    /* DROPDOWNS */

    $('.navbar-main .dropdown').on('hide.bs.dropdown', function () {
        var $this = $(this).find('.dropdown-menu');

        $this.addClass('close');

        setTimeout(function () {
            $this.removeClass('close');
        }, 200);

    });

    $('.dropdown-submenu > .dropdown-toggle').click(function (e) {
        e.preventDefault();
        $(this).parent('.dropdown-submenu').toggleClass('show');
    });

    $('.dropdown').hover(function() {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
        $(this).find('.dropdown-toggle').attr('aria-expanded', 'true');
    }, function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
        $(this).find('.dropdown-toggle').attr('aria-expanded', 'false');
    });

    $('.dropdown').click(function() {
        if ($(this).hasClass('show')) {
            $(this).removeClass('show');
            $(this).find('.dropdown-menu').removeClass('show');
            $(this).find('.dropdown-toggle').attr('aria-expanded', 'false');
        } else {
            $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
        $(this).find('.dropdown-toggle').attr('aria-expanded', 'true');
        }
    });

    /* SIDENAV TOGGLER */

    function pinSidenav() {
        $('.sidenav-toggler').addClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-unpin');
        $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
        $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target='+$('#sidenav-main').data('target')+' />');
    }

    function unpinSidenav() {
        $('.sidenav-toggler').removeClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-pin');
        $('body').removeClass('g-sidenav-pinned').addClass('g-sidenav-hidden');
        $('body').find('.backdrop').remove();
    }

    if($(window).width() > 1200) {
        $(window).resize(function() {
            if( $('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    if($(window).width() < 1200){
        $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
        $('body').removeClass('g-sidenav-show');
        $(window).resize(function() {
            if( $('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    $("body").on("click", "[data-action]", function(e) {
        e.preventDefault();
        var $this = $(this);
        var action = $this.data('action');
        var target = $this.data('target');

        switch (action) {
            case 'sidenav-pin':
                pinSidenav();
            break;
            case 'sidenav-unpin':
                unpinSidenav();
            break;

            case 'search-show':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-showing');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-showing').addClass('g-navbar-search-show');
                }, 150);

                setTimeout(function() {
                    $('body').addClass('g-navbar-search-shown');
                }, 300);
            break;

            case 'search-close':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-shown');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-hiding');
                }, 150);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hiding').addClass('g-navbar-search-hidden');
                }, 300);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hidden');
                }, 500);
            break;
        }
    });

    /* MAIN MENU */
    var sciscoMenu = function () {
        $("body").find('.scisco-smart-menu').smartmenus({
            collapsibleBehavior: $("body").find('.scisco-smart-menu-container').data('collapsiblebehavior')
        });
    };

    /* NAVIGATION MENU WIDGET */
    var sciscoWidgetMenu = function () {
        $("body").find('.scisco-widget-menu').smartmenus({
            collapsibleBehavior: 'link'
        });
    };

    /* BACKGROUND IMAGES */
    var sciscoBgImages = function () {
        var scisco_img = $('#scisco-header').data('img'); 
        if(scisco_img) {
            $('#scisco-header').css('background-image', 'url("' + scisco_img + '")');
        }
    };

    /* CONTACT FORM 7 */
    $("body").find("div.wpcf7-response-output").on('click', function () {
        $(this).fadeOut();
    });

    /* MARK ALL READ BUTTON */
    $("#anspress").find(".ap-btn-markall-read").on('click', function () {
        $("#anspress").find('.ap-noti-item').removeClass('not-seen');
        $("#ap-user-nav").find('.ap-menu-notifications a span').remove();
        $("#scisco-notification-dropdown").find('a span.scisco-unread-icon').remove();
        $("#scisco-notification-dropdown").find('.scisco-dark-dropdown').remove();
    });

    /* FRONT END PM MENU TOGGLE */
    $("#fep-menu-toggle-button").on('click', function () {
        $('#fep-menu').toggleClass('fep-menu-toggle');
    });

    /* USER SEARCH FORM */
    $('#scisco-user-search-form #qa_orderby').on('change', function() {
        $(this).closest("form").submit();
    });

    /* GO TO TOP */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 400) {
            $("#scisco-gototop").addClass('visible');
        } else {
            $("#scisco-gototop").removeClass('visible');
        }
    });

    $("#scisco-gototop").on('click', function (e) {
        e.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    /* PROFILE MENU */
    $("#scisco-user-menu-toggler").on('click', function (e) {
        e.preventDefault();
        $("#ap-user-nav").find('.ap-tab-nav').toggle();
        $(this).toggleClass('opened');
    });

    /* WOOCOMMERCE USER MENU */
    $("#scisco-woo-menu-toggler").on('click', function (e) {
        e.preventDefault();
        $("#scisco-woo-user-menu").toggle();
        $(this).toggleClass('opened');
    });
    
    /* DOCUMENT READY */  
    $(document).ready(function () {
        sciscoMenu();
        sciscoWidgetMenu();
        sciscoBgImages();
        $('body').find('select').addClass('custom-select');
        $('body').find('.scisco-masonry-grid').egemenerdMasonry();
        $('body').find('[data-toggle="tooltip"]').tooltip();
    });
})(jQuery);