<?php
/* ---------------------------------------------------------
Custom Controls
----------------------------------------------------------- */

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Subtitle_Control extends Kirki_Control_Base {
        public $type = 'subtitle';
        public function render_content() { 
			echo '<h2 class="scisco-customizer-title">' . $this->setting->default . '</h2>';
		}
    }
    // Register our custom control with Kirki
    add_filter( 'kirki_control_types', function( $controls ) {
        $controls['subtitle'] = 'Kirki_Controls_Subtitle_Control';
        return $controls;
    } );

} );

/* ---------------------------------------------------------
Custom Customizer Styles & Scripts
----------------------------------------------------------- */

function scisco_customizer_script() {
	wp_enqueue_script( 'scisco-customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'jquery','customize-preview' ),'',true);
}

add_action( 'customize_controls_print_scripts', 'scisco_customizer_script');

function scisco_customizer_style() {
	wp_enqueue_style( 'scisco-customizer', get_template_directory_uri() . '/includes/css/customizer.css', NULL, NULL, 'all' );
}

add_action( 'customize_controls_print_styles', 'scisco_customizer_style' );

/* ---------------------------------------------------------
Config
----------------------------------------------------------- */

$kirki_prefix = "scisco_";

Kirki::add_config( $kirki_prefix . 'theme_config_id', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod'
));

/* ---------------------------------------------------------
Panel & Sections
----------------------------------------------------------- */

Kirki::add_panel( $kirki_prefix . 'theme_settings', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Theme Settings', 'scisco' )
));

Kirki::add_section( $kirki_prefix . 'general', array(
    'title'     => esc_html__( 'General', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 1
));

Kirki::add_section( $kirki_prefix . 'colors', array(
    'title'     => esc_html__( 'Colors', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 2
));

Kirki::add_section( $kirki_prefix . 'topnav', array(
    'title'     => esc_html__( 'Top Navigation', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 3
));

Kirki::add_section( $kirki_prefix . 'subheader', array(
    'title'     => esc_html__( 'Header', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 4
));

Kirki::add_section( $kirki_prefix . 'sidenav', array(
    'title'     => esc_html__( 'Side Navigation', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 5
));

Kirki::add_section( $kirki_prefix . 'anspress', array(
    'title'     => esc_html__( 'AnsPress', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 6
));

Kirki::add_section( $kirki_prefix . 'blog', array(
    'title'     => esc_html__( 'Blog', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 7
));

Kirki::add_section( $kirki_prefix . 'woocommerce', array(
    'title'     => esc_html__( 'WooCommerce', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 8,
));

Kirki::add_section( $kirki_prefix . 'job', array(
    'title'     => esc_html__( 'WP Job Manager', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 9,
));

Kirki::add_section( $kirki_prefix . 'footer', array(
    'title'     => esc_html__( 'Footer', 'scisco'),
    'panel'     => $kirki_prefix . 'theme_settings',
    'priority'  => 10
));

/* ---------------------------------------------------------
Fields
----------------------------------------------------------- */

/* Site Identity */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'logo_width',
	'label'       => esc_html__( 'Logo Max. Width (%)', 'scisco'),
	'section'     => 'title_tagline',
	'default'     => 100,
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'transport' => 'auto',
    'output' => array(
        array(
            'element'  => '.navbar-vertical .navbar-brand img',
            'property' => 'max-width',
            'units' => '%',
            'exclude' => array('100')
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'logo_padding',
	'label'       => esc_html__( 'Logo Top-Bottom Spacing (rem)', 'scisco'),
	'section'     => 'title_tagline',
	'default'     => 3,
	'choices'     => array(
		'min'  => 0,
		'max'  => 10,
		'step' => 0.1,
	),
	'transport' => 'auto',
    'output' => array(
        array(
            'element'  => '.sidenav .navbar-brand',
            'property' => 'padding-top',
            'units' => 'rem',
            'exclude' => array('3')
		),
		array(
            'element'  => '.sidenav .navbar-brand',
            'property' => 'padding-bottom',
            'units' => 'rem',
            'exclude' => array('3')
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'logo_width_mobile',
	'label'       => esc_html__( 'Logo Width (Mobile Phones (px))', 'scisco'),
	'section'     => 'title_tagline',
	'default'     => 150,
	'choices'     => array(
		'min'  => 40,
		'max'  => 500,
		'step' => 5,
	),
	'transport' => 'auto',
    'output' => array(
        array(
            'element'  => '#scisco-mobile-logo-wrapper .navbar-brand img',
            'property' => 'max-width',
            'units' => 'px',
            'exclude' => array('150')
        )
    )
));

/* General */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . 'content_width',
	'label'       => esc_html__( 'Content Width', 'scisco' ),
	'section'     => $kirki_prefix . 'general',
	'default'     => 1320,
	'choices'     => [
		'min'  => 1000,
		'max'  => 2000,
		'step' => 10,
	],
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.container-fluid',
			'property' => 'max-width',
			'units' => 'px',
			'exclude' => array('1320')
		)
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'limit_dashboard',
	'label'       => esc_html__( 'Dashboard access', 'scisco'),
    'description' => esc_html__( 'Limit WordPress dashboard access and remove admin bar for non-admins.', 'scisco'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'link',
	'settings'    => $kirki_prefix . 'limit_dashboard_url',
	'label'       => esc_html__( 'Redirection URL', 'scisco'),
	'description'       => esc_html__( 'As default, users are redirected to the front page after login. You can enter a custom URL here.', 'scisco'),
	'section'     => $kirki_prefix . 'general'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'live_search',
	'label'       => esc_html__( 'Enable Live Search', 'scisco'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'lightbox',
	'label'       => esc_html__( 'Enable Lightbox', 'scisco'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_typography',
	'section'     => $kirki_prefix . 'general',
	'default'     => esc_html__( 'Typography', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'disable_external_script',
	'label'       => esc_html__( 'Stop Using Google CDN', 'scisco'),
    'description' => esc_html__( 'The default font family of the theme is loaded via Google CDN.', 'scisco'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'default_font_size',
	'label'       => esc_html__( 'Default Browser Font Size (px)', 'scisco'),
    'description' => esc_html__( 'All font-sizes in the theme will scaled according to this value.', 'scisco'),
	'section'     => $kirki_prefix . 'general',
	'default'     => 16,
	'choices'     => array(
		'min'  => 1,
		'max'  => 99,
		'step' => 1
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => $kirki_prefix . 'body_fonts',
	'label'       => esc_html__( 'Body', 'scisco' ),
	'section'     => $kirki_prefix . 'general',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
        'subsets'        => array( 'latin-ext' ),
		'line-height'    => '1.7'
	),
	'output' => array(
		array(
			'element' => 'body, p,.anspress',
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => $kirki_prefix . 'heading_fonts',
	'label'       => esc_html__( 'Headings', 'scisco' ),
	'section'     => $kirki_prefix . 'general',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '700',
        'subsets'        => array( 'latin-ext' ),
		'line-height'    => '1.4'
	),
	'output' => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6',
		)
	)
));

/* Colors */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Primary Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'primary_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#0A48B3',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.progress-label span,.ap-vote a:hover,#ap-answers-c .ap-answers-tab>li a:hover,#ap-answers-c .ap-answers-tab li.active a,.nav-tabs .nav-link:hover,.nav-tabs .nav-link.active,#ap-user-nav .ap-tab-nav li > a:hover,#ap-user-nav .ap-tab-nav li > a > i,.scisco-profile-submenu-item:hover,.scisco-profile-submenu-item i',
            'property' => 'color',
            'exclude' => array('#0A48B3')
		),
		array(
			'element' => '#anspress .ap-questions .ap-post-status,#anspress .ap-questions .featured-question,.ap-activity-item>.ap-activity-icon i,.ap-activity-when,.ap-modal-header,#ap-user-nav .ap-tab-nav li.active,.scisco-rep-item-icon i,#anspress .ap-noti-icon,#scisco-notification-dropdown .ap-noti-icon,.scisco-profile-submenu-item.active:hover,.scisco-profile-submenu-item.active,#scisco-gototop i,.featherlight-close-icon,.featherlight-next,.featherlight-previous,body.scisco.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-MyAccount-navigation,body.scisco .job-manager-message,.scisco-carousel .slick-prev,.scisco-carousel .slick-next',
            'property' => 'background',
            'exclude' => array('#0A48B3')
		),
        array(
			'element' => '.page-item.active .page-link,.badge-primary,.badge-primary[href]:hover, .badge-primary[href]:focus,.progress-bar,.list-group-item.active,body.scisco .scisco-page-links>span,body.scisco .scisco-page-links>a>span:hover,.ap-notice,.ap-pagination span,.ap-btn,.ap-btn:hover,.ap-btn.active,#cmb2-metabox-scisco_user_fields button.button-secondary,#cmb2-metabox-scisco_user_fields button.button-secondary:hover,.fep-button.fep-message-toggle-all,.fep-pagination-li.active .fep-pagination-span,.fep-pagination-li .fep-pagination-a:hover',
            'property' => 'background-color',
            'exclude' => array('#0A48B3')
		),
        array(
			'element' => 'blockquote,textarea:focus,input[type=text]:focus,input[type=password]:focus,input[type=email]:focus,input[type=number]:focus,input[type=tel]:focus,input[type=date]:focus,input[type=search]:focus,.form-control:focus,.page-item.active .page-link,.list-group-item.active,.custom-select:focus,.ap-pagination span,.ap-btn,.ap-btn:hover,.ap-btn.active,.scisco-login-form,.selectize-input.focus,#cmb2-metabox-scisco_user_fields button.button-secondary,#cmb2-metabox-scisco_user_fields button.button-secondary:hover,#ap-single .scisco-question-meta,.fep-button.fep-message-toggle-all,.fep-pagination-li.active .fep-pagination-span,.fep-pagination-li .fep-pagination-a:hover,.scisco-author-box,body.scisco.woocommerce nav.woocommerce-pagination ul li span.current,#scisco-footer .form-control:focus,#scisco-comments-wrapper',
            'property' => 'border-color',
            'exclude' => array('#0A48B3')
		),
		array(
			'element' => '.featherlight-loading .featherlight-content',
            'property' => 'border-left-color',
            'exclude' => array('#0A48B3')
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'text_color',
	'label'       => esc_html__( 'Text Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#525f7f',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body, p,.anspress,.scisco-rep-item .ap-reputation-ref,#anspress .ap-noti-date',
			'property' => 'color',
			'exclude' => array('#525f7f')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'heading_color',
	'label'       => esc_html__( 'Heading & Label Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#101E36',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,#anspress .ap-filter-toggle,#anspress filter-items div.active label,#anspress filter-items div:hover label,#anspress .ap-questions-title a,#anspress .ap-questions .ap-display-meta-item i:before,.ap-pagination span,.ap-pagination a,.ap-form-label,#cmb2-metabox-scisco_user_fields label,#cmb2-metabox-scisco_user_fields .cmb2-metabox-title,.scisco-user-table-left,.scisco-rep-item-activity-title,#anspress .ap-noti-inner,.ap-vote a,.ap-vote .net-vote-count,#ap-answers-c .ap-answers-tab>li a,#front-end-post-form .cmb-th,#front-end-post-edit-form .cmb-th,.nav-tabs .nav-link,#ap-user-nav .ap-tab-nav li > a,.scisco-profile-submenu-item,.ap-activity-item .ap-activity-header,.scisco-login-form label,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce form .form-row label,body.scisco div.product .card p.price,body.scisco div.product .card span.price,.job-manager-form fieldset label,table.job-manager-jobs th,.scisco-form-check-title',
			'property' => 'color',
			'exclude' => array('#101E36')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'box_bg_color',
	'label'       => esc_html__( 'Box Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-content-wrapper,.scisco-author-box,#scisco-comments-wrapper,.card,.card-header,.card-footer,.page-link,#anspress .ap-list-head,#anspress .ap-dropdown-menu,#anspress .ap-category-item,body.ap-page-activities #anspress,#ap-ask-page,#anspress .ap-questions,#anspress .ap-questions-count,.scisco-ap-login-buttons,#anspress .ap-category-subitems li a,.ap-modal-body,#ap-user-nav .ap-tab-nav,.scisco-user-table-wrapper,.scisco-reputations,#anspress .ap-noti,#ap-single .scisco-question-meta,.scisco-sq-content-wrapper,.ap-vote a,.ap-all-answers,#ap-form-main,#scisco-user-search-form,.nav-tabs .nav-link.active,.tab-content,table.job-manager-jobs,.job_filters,.scisco-job-listings.job_listings,body.scisco .scisco-single-job-wrapper,.woocommerce div.product div.summary,.woocommerce div.product div.images .flex-control-thumbs',
			'property' => 'background-color',
			'exclude' => array('#ffffff')
		),
		array(
			'element' => '.card-profile .card-profile-image img',
			'property' => 'border-color',
			'exclude' => array('#ffffff')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#0A48B3',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'a',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#062b6b',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'a:hover,.scisco-widget a:not([class]):hover,.tagcloud a:hover,a[class^="tag"]:hover,.ap-widget-pos a:hover,.ap-widget-inner a:hover,.card-meta div a:hover,.card-comments a:hover,.job_listings > div > a:hover h6',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Widget Title Border Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'title_border_color',
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#2dce89',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#anspress .ap-widget-title:before,.highlighted-title:before',
            'property' => 'background'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_btn_colors',
	'section'     => $kirki_prefix . 'colors',
	'default'     => esc_html__( 'Buttons', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'primary_btn_color',
	'label'       => esc_html__( 'Primary Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'input[type="submit"]:not(.slick-arrow),input[type="button"]:not(.slick-arrow),button[type="submit"],.button,.btn-primary,input[type="submit"]:not(.slick-arrow):hover,input[type="button"]:not(.slick-arrow):hover,button[type="submit"]:hover,.button:hover,.btn-primary:hover,input[type="submit"]:not(.slick-arrow):focus,input[type="button"]:not(.slick-arrow):focus,button[type="submit"]:focus,.button:hover,.btn-primary:focus,.btn-primary:disabled,.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled):not(.disabled).active,.show>.btn-primary.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'primary_btn_bg_color',
	'label'       => esc_html__( 'Primary Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#0A48B3',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'input[type="submit"]:not(.slick-arrow),input[type="button"]:not(.slick-arrow),button[type="submit"],.button,.btn-primary,input[type="submit"]:not(.slick-arrow):hover,input[type="button"]:not(.slick-arrow):hover,button[type="submit"]:hover,.button:hover,.btn-primary:hover,input[type="submit"]:not(.slick-arrow):focus,input[type="button"]:not(.slick-arrow):focus,button[type="submit"]:focus,.button:hover,.btn-primary:focus,.btn-primary:disabled,.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled):not(.disabled).active,.show>.btn-primary.dropdown-toggle,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.added_to_cart,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover',
            'property' => 'background-color'
		),
		array(
			'element' => 'input[type="submit"]:not(.slick-arrow),input[type="button"]:not(.slick-arrow),button[type="submit"],.button,.btn-primary,input[type="submit"]:not(.slick-arrow):hover,input[type="button"]:not(.slick-arrow):hover,button[type="submit"]:hover,.button:hover,.btn-primary:hover,input[type="submit"]:not(.slick-arrow):focus,input[type="button"]:not(.slick-arrow):focus,button[type="submit"]:focus,.button:hover,.btn-primary:focus,.btn-primary:disabled,.btn-primary:not(:disabled):not(.disabled):active,.btn-primary:not(:disabled):not(.disabled).active,.show>.btn-primary.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'default_btn_color',
	'label'       => esc_html__( 'Default Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-default,.btn-default:hover,.btn-default:focus,.btn-default:disabled,.btn-default:active,.btn-default:not(:disabled):not(.disabled):active,.btn-default:not(:disabled):not(.disabled).active,.show>.btn-default.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'default_btn_bg_color',
	'label'       => esc_html__( 'Default Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#172b4d',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-default,.btn-default:hover,.btn-default:focus,.btn-default:disabled,.btn-default:active,.btn-default:not(:disabled):not(.disabled):active,.btn-default:not(:disabled):not(.disabled).active,.show>.btn-default.dropdown-toggle',
            'property' => 'background-color'
		),
		array(
			'element' => '.btn-default,.btn-default:hover,.btn-default:focus,.btn-default:disabled,.btn-default:active,.btn-default:not(:disabled):not(.disabled):active,.btn-default:not(:disabled):not(.disabled).active,.show>.btn-default.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'success_btn_color',
	'label'       => esc_html__( 'Success Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-success,.btn-success:hover,.btn-success:focus,.btn-success:disabled,.btn-success:active,.btn-success:not(:disabled):not(.disabled):active,.btn-success:not(:disabled):not(.disabled).active,.show>.btn-success.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'success_btn_bg_color',
	'label'       => esc_html__( 'Success Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#2dce89',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-success,.btn-success:hover,.btn-success:focus,.btn-success:disabled,.btn-success:active,.btn-success:not(:disabled):not(.disabled):active,.btn-success:not(:disabled):not(.disabled).active,.show>.btn-success.dropdown-toggle',
            'property' => 'background-color'
		),
		array(
			'element' => '.btn-success,.btn-success:hover,.btn-success:focus,.btn-success:disabled,.btn-success:active,.btn-success:not(:disabled):not(.disabled):active,.btn-success:not(:disabled):not(.disabled).active,.show>.btn-success.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'info_btn_color',
	'label'       => esc_html__( 'Info Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-info,.btn-info:hover,.btn-info:focus,.btn-info:disabled,.btn-info:active,.btn-info:not(:disabled):not(.disabled):active,.btn-info:not(:disabled):not(.disabled).active,.show>.btn-info.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'info_btn_bg_color',
	'label'       => esc_html__( 'Info Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#11cdef',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-info,.btn-info:hover,.btn-info:focus,.btn-info:disabled,.btn-info:active,.btn-info:not(:disabled):not(.disabled):active,.btn-info:not(:disabled):not(.disabled).active,.show>.btn-info.dropdown-toggle',
            'property' => 'background-color'
		),
		array(
			'element' => '.btn-info,.btn-info:hover,.btn-info:focus,.btn-info:disabled,.btn-info:active,.btn-info:not(:disabled):not(.disabled):active,.btn-info:not(:disabled):not(.disabled).active,.show>.btn-info.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'warning_btn_color',
	'label'       => esc_html__( 'Warning Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-warning,.btn-warning:hover,.btn-warning:focus,.btn-warning:disabled,.btn-warning:active,.btn-warning:not(:disabled):not(.disabled):active,.btn-warning:not(:disabled):not(.disabled).active,.show>.btn-warning.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'warning_btn_bg_color',
	'label'       => esc_html__( 'Warning Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#F28900',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-warning,.btn-warning:hover,.btn-warning:focus,.btn-warning:disabled,.btn-warning:active,.btn-warning:not(:disabled):not(.disabled):active,.btn-warning:not(:disabled):not(.disabled).active,.show>.btn-warning.dropdown-toggle',
            'property' => 'background-color'
		),
		array(
			'element' => '.btn-warning,.btn-warning:hover,.btn-warning:focus,.btn-warning:disabled,.btn-warning:active,.btn-warning:not(:disabled):not(.disabled):active,.btn-warning:not(:disabled):not(.disabled).active,.show>.btn-warning.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'danger_btn_color',
	'label'       => esc_html__( 'Danger Button Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-danger,.btn-danger:hover,.btn-danger:focus,.btn-danger:disabled,.btn-danger:active,.btn-danger:not(:disabled):not(.disabled):active,.btn-danger:not(:disabled):not(.disabled).active,.show>.btn-danger.dropdown-toggle',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'danger_btn_bg_color',
	'label'       => esc_html__( 'Danger Button Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'colors',
	'default'     => '#D62828',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.btn-danger,.btn-danger:hover,.btn-danger:focus,.btn-danger:disabled,.btn-danger:active,.btn-danger:not(:disabled):not(.disabled):active,.btn-danger:not(:disabled):not(.disabled).active,.show>.btn-danger.dropdown-toggle',
            'property' => 'background-color'
		),
		array(
			'element' => '.btn-danger,.btn-danger:hover,.btn-danger:focus,.btn-danger:disabled,.btn-danger:active,.btn-danger:not(:disabled):not(.disabled):active,.btn-danger:not(:disabled):not(.disabled).active,.show>.btn-danger.dropdown-toggle',
            'property' => 'border-color'
		)
	)
));

/* Top Navigation */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_bg_color',
	'label'       => esc_html__( 'Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => '',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#scisco-topnav',
            'property' => 'background-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_link_color',
	'label'       => esc_html__( 'Link Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => '#ffffff',
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
    'output' => array(
		array(
			'element' => '#scisco-topnav.navbar-dark .navbar-nav .nav-link',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 'rgba(255, 255, 255, 0.7)',
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
    'output' => array(
		array(
			'element' => '#scisco-topnav.navbar-dark .navbar-nav .nav-link:hover',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_topnav_dropdown',
	'section'     => $kirki_prefix . 'topnav',
	'default'     => esc_html__( 'Dropdown Menu', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_dropdown_bg_color',
	'label'       => esc_html__( 'Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 'rgba(23,43,77,0.95)',
	'choices'     => [
		'alpha' => true,
	],
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-dark-dropdown.dropdown-menu,.ui-menu',
            'property' => 'background'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_dropdown_text_color',
	'label'       => esc_html__( 'Text Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => '#9AADC2',
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
    'output' => array(
		array(
			'element' => '#scisco-notification-dropdown .ap-noti-date',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'topnav_dropdown_link_color',
	'label'       => esc_html__( 'Link Hover Color', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => '#ffffff',
	'transport' => 'auto',
	'choices'     => [
		'alpha' => true,
	],
    'output' => array(
		array(
			'element' => '.scisco-dark-dropdown.dropdown-menu a,.scisco-dark-dropdown.dropdown-menu a:hover,.ui-menu .ui-menu-item,.ui-menu .ui-menu-item:hover',
            'property' => 'color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_topnav_loggedin',
	'section'     => $kirki_prefix . 'topnav',
	'default'     => esc_html__( 'Logged In User Menu', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'add_loggedin_menu_items',
	'label'       => esc_html__( 'Enable Additional Menu Items', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'repeater',
	'settings'    => $kirki_prefix . 'loggedin_menu_items',
	'label'       => esc_html__( 'Additional Menu Items', 'scisco' ),
	'description' => esc_html__( 'Each row is a new menu item.', 'scisco' ),
	'section'     => $kirki_prefix . 'topnav',
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_html__( 'Menu Item', 'scisco' ),
		'field' => 'title',
	),
	'default'      => array(
		array(
			'title' => esc_html__( 'Menu item...', 'scisco' ),
			'destination_url'  => '#',
			'icon' => 'fas fa-link'
		),
	),
	'fields'      => array(
		'title'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Title', 'scisco' ),
			'default'     => ''
		),
		'icon'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'scisco' ),
			'default'     => 'fas fa-link'
		),
		'destination_url'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Destination URL', 'scisco' ),
			'default'     => ''
		),
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_topnav_login',
	'section'     => $kirki_prefix . 'topnav',
	'default'     => esc_html__( 'Non-logged In User Menu', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'guest_text',
	'label'       => esc_html__( 'Guest User Text', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => esc_html__( 'Welcome, guest', 'scisco'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'enable_login',
	'label'       => esc_html__( 'Login Link', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 1
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'login_text',
	'label'       => esc_html__( 'Login Text', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => esc_html__( 'Login', 'scisco'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'link',
    'settings'     => $kirki_prefix . 'login_url',
	'label'       => esc_html__( 'Custom Login URL', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'enable_register',
	'label'       => esc_html__( 'Register Link', 'scisco'),
	'description' => esc_html__( 'You should enable "Membership" from WordPress Settings -> General.', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 1
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'register_text',
	'label'       => esc_html__( 'Register Text', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => esc_html__( 'Register', 'scisco'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'link',
    'settings'     => $kirki_prefix . 'register_url',
	'label'       => esc_html__( 'Custom Register URL', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'enable_lost',
	'label'       => esc_html__( 'Lost Password Link', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 1
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'lost_text',
	'label'       => esc_html__( 'Lost Password Text', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => esc_html__( 'Lost Your Password?', 'scisco'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'link',
    'settings'     => $kirki_prefix . 'lost_url',
	'label'       => esc_html__( 'Lost Password URL', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
    'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'add_non_loggedin_menu_items',
	'label'       => esc_html__( 'Enable Additional Menu Items', 'scisco'),
	'section'     => $kirki_prefix . 'topnav',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'repeater',
	'settings'    => $kirki_prefix . 'non_loggedin_menu_items',
	'label'       => esc_html__( 'Additional Menu Items', 'scisco' ),
	'description' => esc_html__( 'Each row is a new menu item.', 'scisco' ),
	'section'     => $kirki_prefix . 'topnav',
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_html__( 'Menu Item', 'scisco' ),
		'field' => 'title',
	),
	'default'      => array(
		array(
			'title' => esc_html__( 'Menu item...', 'scisco' ),
			'destination_url'  => '#',
			'icon' => 'fas fa-link'
		),
	),
	'fields'      => array(
		'title'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Title', 'scisco' ),
			'default'     => ''
		),
		'icon'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'scisco' ),
			'default'     => 'fas fa-link'
		),
		'destination_url'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Destination URL', 'scisco' ),
			'default'     => ''
		),
	),
));

/* Sub Header */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . 'subheader_cover_img',
	'label'       => esc_html__( 'Default Cover Image', 'scisco'),
	'section'     => $kirki_prefix . 'subheader',
	'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Background Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'subheader_bg_color',
	'section'     => $kirki_prefix . 'subheader',
	'default'     => '#0A48B3',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#scisco-header',
            'property' => 'background-color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Font Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'subheader_font_color',
	'section'     => $kirki_prefix . 'subheader',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#scisco-page-title h1, #scisco-page-title p,#scisco-page-title a, #scisco-page-title .scisco-description, .breadcrumb-dark .breadcrumb-item a,.breadcrumb-dark .breadcrumb-item a:hover,.breadcrumb-dark .breadcrumb-item + .breadcrumb-item::before,.breadcrumb-dark .breadcrumb-item.active,.woocommerce .woocommerce-breadcrumb a',
            'property' => 'color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'multicolor',
	'settings'    => $kirki_prefix . 'subheader_overlay',
	'label'       => esc_html__( 'Image Overlay', 'scisco'),
	'section'     => $kirki_prefix . 'subheader',
    'choices'  => array(
        'color1'   => esc_html__( 'Color 1', 'scisco' ),
        'color2'  => esc_html__( 'Color 2', 'scisco' )
    ),
    'alpha'    => true,
    'default'  => array(
        'color1'   => 'rgba(10,72,179,0.7)',
        'color2'  => 'rgba(7,50,125,0.9)'
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . 'subheader_height',
	'label'       => esc_html__( 'Top-Bottom Spacing', 'scisco' ),
	'section'     => $kirki_prefix . 'subheader',
	'default'     => 4,
	'choices'     => [
		'min'  => 0,
		'max'  => 10,
		'step' => 0.1,
	],
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '#scisco-page-title',
			'property' => 'padding-top',
			'units' => 'rem',
			'exclude' => array('4')
		),
		array(
			'element' => '#scisco-page-title',
			'property' => 'padding-bottom',
			'units' => 'rem',
			'exclude' => array('4')
		),
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'disable_breadcrumb',
	'label'       => esc_html__( 'Disable Breadcrumb Menu', 'scisco'),
	'section'     => $kirki_prefix . 'subheader',
	'default'     => 0
));

/* Side Navigation */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => $kirki_prefix . 'sidenav_position',
	'label'       => esc_html__( 'Position', 'scisco' ),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => 'fixed-left',
	'choices'     => array(
		'fixed-left'   => esc_html__( 'Left', 'scisco' ),
		'fixed-right' => esc_html__( 'Right', 'scisco' )
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . 'sidenav_width',
	'label'       => esc_html__( 'Width', 'scisco' ),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => 250,
	'choices'     => [
		'min'  => 200,
		'max'  => 1000,
		'step' => 10,
	],
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.navbar-vertical.navbar-expand-xs',
			'property' => 'max-width',
			'units' => 'px',
			'exclude' => array('250')
		),
		array(
            'element'  => '.sidenav.fixed-left + .main-content,.g-sidenav-pinned .sidenav.fixed-left + .main-content',
            'property' => 'margin-left',
            'media_query' => '@media screen and (min-width: 1200px)',
            'units' => 'px',
            'exclude' => array('250')
		),
		array(
            'element'  => '.sidenav.fixed-right + .main-content,.g-sidenav-pinned .sidenav.fixed-right + .main-content',
            'property' => 'margin-right',
            'media_query' => '@media screen and (min-width: 1200px)',
            'units' => 'px',
            'exclude' => array('250')
		),
		array(
            'element'  => '.sidenav.fixed-left',
            'property' => 'transform',
            'media_query' => '@media screen and (max-width: 1199.98px)',
            'value_pattern' => 'translateX(-$px)',
            'exclude' => array('250')
		),
		array(
            'element'  => '.sidenav.fixed-right',
            'property' => 'transform',
            'media_query' => '@media screen and (max-width: 1199.98px)',
            'value_pattern' => 'translateX($px)',
            'exclude' => array('250')
        ),
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'sidenav_bg_color',
	'label'       => esc_html__( 'Background Color', 'scisco'),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => '#172b4d',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.sidenav.navbar, #scisco-mobile-logo-wrapper',
            'property' => 'background-color'
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_sidenav_menu',
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => esc_html__( 'Menu', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'menu_collapsible_behavior',
	'label'       => esc_html__( 'Menu Collapsible Behavior', 'scisco'),
	'description'       => esc_html__( 'For the information, please read the help documentation.', 'scisco'),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => 'accordion-toggle',
    'choices'     => array(
		'accordion' => esc_html__( 'Default', 'scisco' ),
		'accordion-toggle' => esc_html__( 'Toggle', 'scisco' ),
		'accordion-link' => esc_html__( 'Link', 'scisco' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Menu Item Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'menu_item_color',
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => '#9AADC2',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-sm-skin a',
            'property' => 'color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Menu Item Hover Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'menu_item_hover_color',
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => '#ffffff',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-sm-skin .current-menu-item a,.scisco-sm-skin a:hover,.scisco-sm-skin a:focus,.scisco-sm-skin a:active',
            'property' => 'color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_sidenav_button',
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => esc_html__( 'Button', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'sidenav_button_style',
	'label'       => esc_html__( 'Button Style', 'scisco'),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => 'btn-success',
    'choices'     => array(
		'btn-primary' => esc_html__( 'Primary', 'scisco'),
		'btn-default' => esc_html__( 'Default', 'scisco'),
        'btn-light' => esc_html__( 'Light', 'scisco'),
		'btn-dark' => esc_html__( 'Dark', 'scisco'),
		'btn-darker' => esc_html__( 'Darker', 'scisco'),
		'btn-white' => esc_html__( 'White', 'scisco'),
        'btn-info' => esc_html__( 'Info', 'scisco'),
		'btn-warning' => esc_html__( 'Warning', 'scisco'),
		'btn-success' => esc_html__( 'Success', 'scisco'),
		'btn-danger' => esc_html__( 'Danger', 'scisco'),
		'btn-neutral' => esc_html__( 'Neutral', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => $kirki_prefix . 'sidenav_button_text',
	'label'       => esc_html__( 'Button Text', 'scisco'),
	'section'     => $kirki_prefix . 'sidenav',
	'default'     => esc_html__('ASK A QUESTION', 'scisco'),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'link',
	'settings'    => $kirki_prefix . 'sidenav_button_url',
	'label'       => esc_html__( 'Button URL', 'scisco'),
	'section'     => $kirki_prefix . 'sidenav'
));

/* AnsPress */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Reputation Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'reputation_color',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '#F28900',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-rep-item-points span,span.scisco-title-rep,#scisco-notification-dropdown .ap-noti-rep,.scisco-user-box.box-warning,#anspress .ap-noti-rep,.ap-user-reputation,.ap-activity-item .ap-user-reputation',
            'property' => 'background'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'user_follow',
	'label'       => esc_html__( 'User Follow', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'ap_messages_btn_style',
	'label'       => esc_html__( 'Sub Header Button Style', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 'btn-info',
    'choices'     => array(
		'btn-primary' => esc_html__( 'Default', 'scisco'),
        'btn-light' => esc_html__( 'Light', 'scisco'),
		'btn-dark' => esc_html__( 'Dark', 'scisco'),
		'btn-darker' => esc_html__( 'Darker', 'scisco'),
		'btn-white' => esc_html__( 'White', 'scisco'),
        'btn-info' => esc_html__( 'Info', 'scisco'),
		'btn-warning' => esc_html__( 'Warning', 'scisco'),
		'btn-success' => esc_html__( 'Success', 'scisco'),
		'btn-danger' => esc_html__( 'Danger', 'scisco'),
		'btn-neutral' => esc_html__( 'Neutral', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'ask_button_style',
	'label'       => esc_html__( 'Ask Button Style', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 'btn-success',
    'choices'     => array(
		'btn-primary' => esc_html__( 'Default', 'scisco'),
        'btn-light' => esc_html__( 'Light', 'scisco'),
		'btn-dark' => esc_html__( 'Dark', 'scisco'),
		'btn-darker' => esc_html__( 'Darker', 'scisco'),
		'btn-white' => esc_html__( 'White', 'scisco'),
        'btn-info' => esc_html__( 'Info', 'scisco'),
		'btn-warning' => esc_html__( 'Warning', 'scisco'),
		'btn-success' => esc_html__( 'Success', 'scisco'),
		'btn-danger' => esc_html__( 'Danger', 'scisco'),
		'btn-neutral' => esc_html__( 'Neutral', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_user_directory',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => esc_html__( 'User Directory', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'dropdown-pages',
	'settings'    => $kirki_prefix . 'users_page',
	'placeholder' => esc_html__( 'Select a page', 'scisco' ),
	'label'       => esc_html__( 'Users Page', 'scisco' ),
	'description'       => esc_html__( 'Select the page which you have created using user directory page template.', 'scisco' ),
	'section'     => $kirki_prefix . 'anspress'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'users_orderby',
	'label'       => esc_html__( 'Order by', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 'alphabetical_asc',
    'choices'     => array(
		'alphabetical_asc' => esc_html__( 'Alphabetical ASC', 'scisco' ),
		'alphabetical_desc' => esc_html__( 'Alphabetical DESC', 'scisco' ),
		'registration_date_asc' => esc_html__( 'Registration Date ASC', 'scisco' ),
		'registration_date_desc' => esc_html__( 'Registration Date DESC', 'scisco' ),
		'reputation_asc' => esc_html__( 'Reputation ASC', 'scisco' ),
		'reputation_desc' => esc_html__( 'Reputation DESC', 'scisco' )
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'users_limit',
	'label'       => esc_html__( 'Limit', 'scisco'),
	'description'  => esc_html__( 'Maximum number of users per page', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 10,
	'choices'     => array(
		'min'  => 1,
		'max'  => 99,
		'step' => 1
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'users_exclude',
	'label'       => esc_html__( 'Exclude users by ID', 'scisco'),
    'description' => esc_html__( 'You can find user IDs at the users page. To exclude multiple users, add comma between IDs.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'users_only_verified',
	'label'       => esc_html__( 'Show only verified users', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_anspress_profile',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => esc_html__( 'User Profile', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'ap_user_avatar',
	'label'       => esc_html__( 'Enable Custom Avatar', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . 'default_avatar',
	'label'       => esc_html__( 'Default avatar', 'scisco'),
    'description' => esc_html__( 'Default avatar must be selected as "Scisco Avatar" (Go to Settings -> Discussion -> Default Avatar)', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => get_template_directory_uri() . '/images/avatar.png',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'ap_user_img',
	'label'       => esc_html__( 'Enable Custom Cover Image', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . 'ap_user_default_img',
	'label'       => esc_html__( 'Default Cover Image', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'ap_social_icons',
	'label'       => esc_html__( 'Enable Social Icons', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'menu_badge_color',
	'label'       => esc_html__( 'Menu Badge Color', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '#2dce89',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#ap-user-nav .ap-tab-nav li > a > span',
			'property' => 'background-color',
			'exclude' => array('#0A48B3')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'answers_box_color',
	'label'       => esc_html__( 'Answers Box Color', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '#2dce89',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-user-box.box-success',
			'property' => 'background-color',
			'exclude' => array('#2dce89')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'questions_box_color',
	'label'       => esc_html__( 'Questions Box Color', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '#D62828',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-user-box.box-danger',
			'property' => 'background-color',
			'exclude' => array('#D62828')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => $kirki_prefix . 'reputation_box_color',
	'label'       => esc_html__( 'Reputation Box Color', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => '#F28900',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '.scisco-user-box.box-warning',
			'property' => 'background-color',
			'exclude' => array('#F28900')
		)
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_about_slug',
	'label'       => esc_html__( 'About Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'about'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_edit_profile_slug',
	'label'       => esc_html__( 'Edit Profile Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'edit-profile'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_messages_slug',
	'label'       => esc_html__( 'Messages Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'messages'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_activities_slug',
	'label'       => esc_html__( 'Activities Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'activities'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_anspress_blog',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => esc_html__( 'User Blog', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => $kirki_prefix . 'enable_user_blog',
    'label'       => esc_html__( 'Front-End Post Submission', 'scisco'),
	'description' => esc_html__( 'New user default role will be author. If you have existing users, you should change their role to author manually.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0,
    'choices'     => array(
		'on'  => esc_html__( 'Enable', 'scisco' ),
		'off' => esc_html__( 'Disable', 'scisco' ),
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => $kirki_prefix . 'user_post_status',
    'label'       => esc_html__( 'Default User Post Status', 'scisco'),
	'description' => esc_html__( 'To allow everyone to publish post without admin approval, select "published".', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0,
    'choices'     => array(
		'on'  => esc_html__( 'Published', 'scisco' ),
		'off' => esc_html__( 'Pending', 'scisco' ),
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'user_blog_verified',
	'label'       => esc_html__( 'Only Verified Users', 'scisco'),
    'description' => esc_html__( 'Allow only verified users the ability to submit post.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'user_blog_layout',
	'label'       => esc_html__( 'User Blog Layout', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 'scisco-two-columns',
    'choices'     => array(
        'scisco-three-columns' => esc_html__( '3 Column', 'scisco' ),
        'scisco-two-columns' => esc_html__( '2 Column', 'scisco' ),
		'scisco-one-column' => esc_html__( '1 Column', 'scisco' )
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'title_length',
	'label'       => esc_html__( 'Maximum title length', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 60,
	'choices'     => array(
		'min'  => 1,
		'max'  => 120,
		'step' => 1,
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'excerpt_length',
	'label'       => esc_html__( 'Maximum excerpt length', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 120,
	'choices'     => array(
		'min'  => 1,
		'max'  => 300,
		'step' => 1,
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'max_user_blog_post',
	'label'       => esc_html__( 'Maximum number of posts', 'scisco'),
	'description' => esc_html__( 'The maximum number of the posts which are displayed on user blog page.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 10,
	'choices'     => array(
		'min'  => 1,
		'max'  => 999,
		'step' => 1,
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_blog_slug',
	'label'       => esc_html__( 'Blog Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'blog'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_submit_post_slug',
	'label'       => esc_html__( 'Submit Post Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
    'default'     => 'submit-post'
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_anspress_categories',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => esc_html__( 'Categories', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'anspress_cat_layout',
	'label'       => esc_html__( 'Category Page Layout', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 'scisco-three-columns',
    'choices'     => array(
		'scisco-five-columns' => esc_html__( '5 Column', 'scisco' ),
		'scisco-four-columns' => esc_html__( '4 Column', 'scisco' ),
        'scisco-three-columns' => esc_html__( '3 Column', 'scisco' ),
        'scisco-two-columns' => esc_html__( '2 Column', 'scisco' ),
		'scisco-one-column' => esc_html__( '1 Column', 'scisco' )
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'anspress_cat_icon_size',
	'label'       => esc_html__( 'Icon Size', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 50,
	'choices'     => array(
		'min'  => 1,
		'max'  => 999,
		'step' => 1
	),
	'transport' => 'auto',
    'output' => array(
        array(
            'element'  => '#anspress .ap-category-item .ap-cat-img-c .ap-category-icon',
            'property' => 'font-size',
            'units' => 'px',
            'exclude' => array('50')
		),
		array(
            'element'  => '#anspress .ap-category-item .ap-cat-img-c .ap-category-icon',
            'property' => 'width',
            'units' => 'px',
            'exclude' => array('50')
		),
		array(
            'element'  => '#anspress .ap-category-item .ap-cat-img-c .ap-category-icon',
            'property' => 'height',
            'units' => 'px',
            'exclude' => array('50')
        )
    )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'subtitle',
	'settings'    => $kirki_prefix . 'title_anspress_tags',
	'section'     => $kirki_prefix . 'anspress',
	'default'     => esc_html__( 'Tags', 'scisco' )
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'anspress_remove_tags',
	'label'       => esc_html__( 'Remove tags from question lists', 'scisco'),
	'section'     => $kirki_prefix . 'anspress',
	'default'     => 1
));

/* Blog */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'remove_featured_img',
	'label'       => esc_html__( 'Use featured images for only post thumbnails', 'scisco'),
	'section'     => $kirki_prefix . 'blog',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'author_box',
	'label'       => esc_html__( 'Author Box', 'scisco'),
	'section'     => $kirki_prefix . 'blog',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'archive_page_layout',
	'label'       => esc_html__( 'Layout', 'scisco'),
	'section'     => $kirki_prefix . 'blog',
	'default'     => 'masonry-sidebar',
    'choices'     => array(
		'sidebar' => esc_html__( 'One Column + Sidebar', 'scisco' ),
        'masonry-sidebar' => esc_html__( 'Two Columns + Sidebar', 'scisco' ),
        'masonry-2' => esc_html__( 'Two Columns', 'scisco' ),
		'masonry-3' => esc_html__( 'Three Columns', 'scisco' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'masonry_thumbnail',
	'label'       => esc_html__( 'Masonry Thumbnail Size', 'scisco'),
    'description' => esc_html__( 'Default Thumbnail Size for Masonry Layout', 'scisco'),
	'section'     => $kirki_prefix . 'blog',
	'default'     => 'large',
    'choices'     => array(
        'scisco-thumbnail' => esc_html__( '900x600 px', 'scisco' ),
        'full' => esc_html__( 'Full', 'scisco' ),
        'large' => esc_html__( 'Large', 'scisco' ),
        'medium' => esc_html__( 'Medium', 'scisco' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'blog_subtitle',
	'label'       => esc_html__( 'Blog Subtitle', 'scisco'),
    'description' => '',
	'section'     => $kirki_prefix . 'blog',
    'default'     => ''
));

/* Woocommerce */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . 'shop_cover_img',
	'label'       => esc_html__( 'Default Shop Cover Image', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'shop_layout',
	'label'       => esc_html__( 'Product layout', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 'threecolumns',
    'choices'     => array(
		'twocolumns' => esc_html__( 'Two Column', 'scisco'),
		'threecolumns' => esc_html__( 'Three Column', 'scisco'),
        'fourcolumns' => esc_html__( 'Four Column', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'product_thumbnail',
	'label'       => esc_html__( 'Product Thumbnail Size', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 'large',
    'choices'     => array(
		'large' => esc_html__( 'Large', 'scisco'),
		'full' => esc_html__( 'Full', 'scisco'),
        'medium' => esc_html__( 'Medium', 'scisco'),
        'shop_thumbnail' => esc_html__( 'Default', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => $kirki_prefix . 'product_image',
	'label'       => esc_html__( 'Single Product Image Size', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 'full',
    'choices'     => array(
		'large' => esc_html__( 'Large', 'scisco'),
		'full' => esc_html__( 'Full', 'scisco'),
        'medium' => esc_html__( 'Medium', 'scisco'),
        'shop_single' => esc_html__( 'Default', 'scisco')
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => $kirki_prefix . 'product_img_size',
	'label'       => esc_html__( 'Single Product Image Column Size in Percents', 'scisco' ),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 50,
	'choices'     => array(
		'min'  => '30',
		'max'  => '70',
		'step' => '1',
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => $kirki_prefix . 'woo_placeholder',
	'label'       => esc_html__( 'Placeholder Image', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => get_template_directory_uri() . '/images/woocommerce-placeholder.png',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'remove_related',
	'label'       => esc_html__( 'Related Products', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 1
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'toggle',
	'settings'    => $kirki_prefix . 'enable_product_sharing',
	'label'       => esc_html__( 'Social Media Sharing Buttons', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 0
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => $kirki_prefix . 'shop_at_most',
	'label'       => esc_html__( 'Shop page show at most', 'scisco'),
    'description' => esc_html__( 'Maximum number of the products.', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
	'default'     => 8,
	'choices'     => array(
		'min'  => 1,
		'max'  => 99,
		'step' => 1,
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'text',
    'settings'     => $kirki_prefix . 'ap_woo_profile_slug',
	'label'       => esc_html__( 'Shop Account Page Slug', 'scisco'),
    'description' => esc_html__( 'This page is added by the theme. To change other user page slugs, go to the plugin settings.', 'scisco'),
	'section'     => $kirki_prefix . 'woocommerce',
    'default'     => 'shop-account'
));

/* WP Job Manager */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Full Time Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'full_time_color',
	'section'     => $kirki_prefix . 'job',
	'default'     => '#2dce89',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body.scisco .single_job_listing .meta .full-time',
			'property' => 'background-color',
			'exclude' => '#2dce89'
		),
		array(
			'element' => '.job-manager .full-time,.job-types .full-time,.job_listing .full-time',
			'property' => 'color',
			'exclude' => '#2dce89'
		),
		array(
			'element' => 'body.scisco .scisco-single-job-wrapper.full-time',
			'property' => 'border-color',
			'exclude' => '#2dce89'
		),
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Part Time Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'part_time_color',
	'section'     => $kirki_prefix . 'job',
	'default'     => '#F28900',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body.scisco .single_job_listing .meta .part-time',
			'property' => 'background-color',
			'exclude' => '#F28900'
		),
		array(
			'element' => '.job-manager .part-time,.job-types .part-time,.job_listing .part-time',
			'property' => 'color',
			'exclude' => '#F28900'
		),
		array(
			'element' => 'body.scisco .scisco-single-job-wrapper.part-time',
			'property' => 'border-color',
			'exclude' => '#F28900'
		),
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Temporary Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'temporary_color',
	'section'     => $kirki_prefix . 'job',
	'default'     => '#D62828',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body.scisco .single_job_listing .meta .temporary',
			'property' => 'background-color',
			'exclude' => '#D62828'
		),
		array(
			'element' => '.job-manager .temporary,.job-types .temporary,.job_listing .temporary',
			'property' => 'color',
			'exclude' => '#D62828'
		),
		array(
			'element' => 'body.scisco .scisco-single-job-wrapper.temporary',
			'property' => 'border-color',
			'exclude' => '#D62828'
		),
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Freelance Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'freelance_color',
	'section'     => $kirki_prefix . 'job',
	'default'     => '#11cdef',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body.scisco .single_job_listing .meta .freelance',
			'property' => 'background-color',
			'exclude' => '#11cdef'
		),
		array(
			'element' => '.job-manager .freelance,.job-types .freelance,.job_listing .freelance',
			'property' => 'color',
			'exclude' => '#11cdef'
		),
		array(
			'element' => 'body.scisco .scisco-single-job-wrapper.freelance',
			'property' => 'border-color',
			'exclude' => '#11cdef'
		),
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Internship Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'internship_color',
	'section'     => $kirki_prefix . 'job',
	'default'     => '#0A48B3',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => 'body.scisco .single_job_listing .meta .internship',
			'property' => 'background-color',
			'exclude' => '#0A48B3'
		),
		array(
			'element' => '.job-manager .internship,.job-types .internship,.job_listing .internship',
			'property' => 'color',
			'exclude' => '#0A48B3'
		),
		array(
			'element' => 'body.scisco .scisco-single-job-wrapper.internship',
			'property' => 'border-color',
			'exclude' => '#0A48B3'
		),
	)
) );

/* Footer */

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'background',
	'settings'    => $kirki_prefix . 'footer_bg',
	'label'       => esc_html__( 'Background', 'scisco' ),
	'section'     => $kirki_prefix . 'footer',
	'default'     => array(
		'background-color'      => '#101e36',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '#scisco-footer',
		),
	),
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Primary Font Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'footer_primary_color',
	'section'     => $kirki_prefix . 'footer',
	'default'     => '#9AADC2',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#scisco-footer,#scisco-footer p,#scisco-footer a,#scisco-footer .tagcloud a,#scisco-footer a[class^="tag"]',
            'property' => 'color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'color',
    'label'       => esc_html__( 'Secondary Font Color', 'scisco' ),
	'settings'    => $kirki_prefix . 'footer_secondary_color',
	'section'     => $kirki_prefix . 'footer',
	'default'     => '#FFFFFF',
	'transport' => 'auto',
    'output' => array(
		array(
			'element' => '#scisco-footer h1,#scisco-footer h2,#scisco-footer h3,#scisco-footer h4,#scisco-footer h5,#scisco-footer h6,#scisco-footer a:hover,#scisco-footer .tagcloud a:hover,#scisco-footer a[class^="tag"]:hover',
            'property' => 'color'
		)
	)
) );

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'editor',
    'settings'     => $kirki_prefix . 'footermessage',
	'label'       => esc_html__( 'Credits', 'scisco'),
	'section'     => $kirki_prefix . 'footer',
    'default'     => '',
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
    'type'        => 'radio',
    'settings'     => $kirki_prefix . 'footer_layout',
	'label'       => esc_html__( 'Footer Layout', 'scisco'),
	'section'     => $kirki_prefix . 'footer',
    'default'     => '3',
    'choices'     => array(
        '3' => esc_html__( '3 Column', 'scisco' ),
        '2' => esc_html__( '2 Column', 'scisco' ),
        '3v2' => esc_html__( '3 Column (v2)', 'scisco' ),
        '4' => esc_html__( '4 Column', 'scisco' )
	)
));

Kirki::add_field( $kirki_prefix . 'theme_config_id', array(
	'type'        => 'repeater',
	'settings'    => $kirki_prefix . 'footer_icons',
	'label'       => esc_html__( 'Social Media Icons', 'scisco' ),
	'description' => esc_html__( 'Each row is a new icon.', 'scisco' ),
	'section'     => $kirki_prefix . 'footer',
	'default'     => array(),
	'fields'      => array(
		'icon'   => array(
			'type'        => 'select',
			'label'       => esc_html__( 'FontAwesome Icon', 'scisco' ),
			'choices'     => scisco_fontawesome_icons(),
			'default'     => 'facebook'
		),
		'desc'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'scisco' ),
			'default'     => ''
		),
		'destination_url'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Destination URL', 'scisco' ),
			'default'     => ''
		),
		'link_target' => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Link Target', 'scisco' ),
			'description' => esc_html__( 'This will be the link target', 'scisco' ),
			'default'     => '_self',
			'choices'     => array(
				'_blank' => esc_html__( 'New Window', 'scisco' ),
				'_self'  => esc_html__( 'Same Frame', 'scisco' )
			),
		),
	),
));
?>