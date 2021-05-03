<?php
if ( !defined('ABSPATH')) exit;

if ( ! function_exists( 'scisco_theme_setup' ) ) {
    function scisco_theme_setup() {
        
        // Set the default content width.
        $GLOBALS['content_width'] = 1320;
        
        /* Translations */
        load_theme_textdomain( 'scisco', get_template_directory() .'/languages' );
        $scisco_locale = get_locale();
        $scisco_locale_file = get_template_directory() ."/languages/$scisco_locale.php";
        if ( is_readable($scisco_locale_file) ) {
	       require_once($scisco_locale_file);
        }
        
        /* Add theme support */
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-formats', array('gallery', 'video'));

        $bg_args = array(
            'default-color' => 'f5f5f5'
        );
        add_theme_support( 'custom-background', $bg_args );

        /* WooCommerce */
        add_theme_support( 'woocommerce', array(
            'gallery_thumbnail_image_width' => 200
        ) );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        
        /* Custom Image Size */
        add_image_size( 'scisco-thumbnail', 900, 600, true);
        
        /* Logo */
        $scisco_logo = array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true
        );
        add_theme_support( 'custom-logo', $scisco_logo );
        
        /* Register Menus */
        register_nav_menus(
            array(
                'scisco-main-menu' => esc_html__( 'Main Menu', 'scisco' )
            )
        );
        
    }
}
add_action( 'after_setup_theme', 'scisco_theme_setup' );

/*---------------------------------------------------
Add a body class
----------------------------------------------------*/

if ( ! function_exists( 'scisco_body_classes' ) ) {
    function scisco_body_classes( $classes ) {
        $classes[] = 'scisco'; 
        return $classes;    
    }
}
add_filter( 'body_class','scisco_body_classes' );

/*---------------------------------------------------
Change logo link class
----------------------------------------------------*/

if ( ! function_exists( 'scisco_change_logo_class' ) ) {
    function scisco_change_logo_class( $html ) {
        $html = str_replace( 'custom-logo-link', 'navbar-brand', $html );
        return $html;
    }
}

add_filter( 'get_custom_logo', 'scisco_change_logo_class' );

/*---------------------------------------------------
Add a pingback url auto-discovery header for single posts, pages, or attachments.
----------------------------------------------------*/

if ( ! function_exists( 'scisco_pingback_header' ) ) {
    function scisco_pingback_header() {
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
        }
    }
}
add_action( 'wp_head', 'scisco_pingback_header' );

/*---------------------------------------------------
Custom Thumbnail Sizes
----------------------------------------------------*/

if ( ! function_exists( 'scisco_image_sizes' ) ) {
    function scisco_image_sizes($sciscosizes) {
        $sciscoaddsizes = array(
            "scisco-thumbnail" => esc_html__( 'Scisco Thumbnail', 'scisco')
        );
        $scisconewsizes = array_merge($sciscosizes, $sciscoaddsizes);
        return $scisconewsizes;
    }
}
add_filter('image_size_names_choose', 'scisco_image_sizes');

/*---------------------------------------------------
Wrap category widget post count in a span
----------------------------------------------------*/

if ( ! function_exists( 'scisco_cat_count_span' ) ) {
function scisco_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="badge badge-pill badge-white">', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
}
add_filter('wp_list_categories', 'scisco_cat_count_span');

/*---------------------------------------------------
Add custom classes to navigation menu widget
----------------------------------------------------*/

if ( ! function_exists( 'scisco_nav_menu_widget' ) ) {
    function scisco_nav_menu_widget($nav_menu_args, $nav_menu, $args, $instance) {
        $rtl = '';
        if (is_rtl()) {
            $rtl = 'sm-rtl';
        }
        $nav_menu_args['menu_class'] = 'scisco-widget-menu sm scisco-widget-menu-skin animated sm-vertical ' . $rtl;
        return $nav_menu_args;
    }
}
add_filter('widget_nav_menu_args', 'scisco_nav_menu_widget', 10, 4);

/*---------------------------------------------------
Archive title filter
----------------------------------------------------*/

if ( ! function_exists( 'scisco_archive_title' ) ) {
    function scisco_archive_title($title) {
        if ( is_category() ) {
            $title = '<i class="fas fa-folder mr-3"></i>' . single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = '<i class="fas fa-tag mr-3"></i>' . single_tag_title( '', false );
        } elseif (is_author()) {
            $title = get_the_author();
        }
        return $title;
    }
}

add_filter('get_the_archive_title', 'scisco_archive_title');

/*---------------------------------------------------
Add class to next/previous post links
----------------------------------------------------*/

if ( ! function_exists( 'scisco_posts_link_attributes' ) ) {
    function scisco_posts_link_attributes($output) {
        $class = 'class="scisco-post-nav"';
        return str_replace('<a href=', '<a '.$class.' href=', $output);
    }
}

add_filter('next_post_link', 'scisco_posts_link_attributes');
add_filter('previous_post_link', 'scisco_posts_link_attributes');

/*---------------------------------------------------
Create a wrapper and add provider name to the class
----------------------------------------------------*/

if ( ! function_exists( 'scisco_oembed_wrapper' ) ) {
function scisco_oembed_wrapper($return, $data, $url) {
    
    /* HTML5 Validation */
    $return = str_replace( array('frameborder="0"', 'webkitallowfullscreen', 'mozallowfullscreen'),'', $return );
    $return = preg_replace('/(<[^>]+) allow=".*?"/i', '$1', $return);
    /* HTML5 Validation END */
    
    $type = '';
    if (isset($data->type)) {
        $type = $data->type;
    }
    if ($type) {
        return "<div class='scisco-iframe-wrapper'><div class='scisco-iframe-{$type}'>{$return}</div></div>";
    } else {
        return "<div class='scisco-iframe-wrapper'>{$return}</div>";
    }
}
}
add_filter('oembed_dataparse','scisco_oembed_wrapper',10,3);

/*---------------------------------------------------
Stylesheets
----------------------------------------------------*/

if ( ! function_exists( 'scisco_theme_styles' ) ) {
function scisco_theme_styles()  
{   
    $theme_version = wp_get_theme()->get('Version');
    $scisco_disable_external_script = get_theme_mod('scisco_disable_external_script');
    $scisco_lightbox = get_theme_mod('scisco_lightbox');
    
    // Default Font
    if (!$scisco_disable_external_script) {
        wp_enqueue_style('scisco-fonts', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap', false, '');
    }
    
    // Font Awesome
    wp_enqueue_style('font-awesome-all', get_template_directory_uri() . '/css/all.min.css', false, '5.11.2');

    // Smart Menu
    wp_enqueue_style('smart-menu', get_template_directory_uri() . '/css/smart-menu.css', false, $theme_version);
    
    // Bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '4.3.1');
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css', array( 'bootstrap' ), '4.3.1');
    }
    wp_enqueue_style('scisco-bootstrap', get_template_directory_uri() . '/css/bootstrap-overwrites.css', array( 'bootstrap' ), '4.3.1');

    // Lightbox
    if (is_singular() && $scisco_lightbox) {
        wp_enqueue_style('featherlight', get_template_directory_uri() . '/css/featherlight.css', false, '1.5.0');
    }

    // Job Manager
    if (class_exists( 'WP_Job_Manager' )) {
        wp_enqueue_style('scisco-job-manager', get_template_directory_uri() . '/css/job_manager.css', false, '1.0.0');
        if (is_rtl()) {
            wp_enqueue_style('scisco-job-manager-rtl', get_template_directory_uri() . '/css/job_manager_rtl.css', array( 'scisco-job-manager' ), '1.0.0');
        }
    }
    
    // Main Styles
    wp_enqueue_style('scisco-style', get_stylesheet_uri());
    
    // Theme Settings  
    $scisco_default_font_size = get_theme_mod('scisco_default_font_size', 16);
    $scisco_header_overlay = get_theme_mod('scisco_subheader_overlay');
    $scisco_anspress_tags = get_theme_mod('scisco_anspress_remove_tags', 1);
    
    $scisco_inline_style = '';

    if ( is_admin_bar_showing() ) {
        $scisco_inline_style .= '.navbar-vertical.navbar-expand-xs {margin-top: 32px;}@media screen and (max-width: 782px){.navbar-vertical.navbar-expand-xs {margin-top: 46px;}}';
    }

    if ($scisco_anspress_tags) {
        $scisco_inline_style .= '.ap-display-meta-item.tags {display:none;}';
    }
    
    if ((!empty($scisco_default_font_size) && ($scisco_default_font_size != 16))) {
        $scisco_inline_style .= 'html { font-size:' . $scisco_default_font_size . 'px }@media only screen and (max-width: 991px) { html {font-size:' . ($scisco_default_font_size - 1) . 'px}}@media only screen and (max-width: 575px) { html {font-size:' . ($scisco_default_font_size - 2) . 'px} }';
    }

    if (!empty($scisco_header_overlay)) {
        $scisco_inline_style .= '#scisco-header-overlay {background: linear-gradient(120deg, ' . $scisco_header_overlay['color1'] . ' 0, ' . $scisco_header_overlay['color2'] . ' 100%);}';
    }
    
    wp_add_inline_style( 'scisco-style', $scisco_inline_style );
}
}
add_action('wp_enqueue_scripts', 'scisco_theme_styles');

/*---------------------------------------------------
javascript files
----------------------------------------------------*/

if ( ! function_exists( 'scisco_script_register' ) ) {
function scisco_script_register() {

    $theme_version = wp_get_theme()->get('Version');
    $scisco_lightbox = get_theme_mod('scisco_lightbox');
    
    // Bootstrap
    wp_enqueue_script('popper', get_template_directory_uri() . '/js/popper.min.js', array( 'jquery' ), '4.3.1', true );
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );

    // Smart Menu
    wp_enqueue_script('smart-menu', get_template_directory_uri() . '/js/smart-menu.js', array( 'jquery' ), $theme_version, true );
    
    // Masonry Grid
    wp_enqueue_script('egemenerd-grid', get_template_directory_uri() . '/js/egemenerd-grid.js', array( 'jquery' ), '1.0.0', true );
    
    // Comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( "comment-reply" );
    }

    // Lightbox
    if (is_singular() && $scisco_lightbox) {
        wp_enqueue_script('featherlight', get_template_directory_uri() . '/js/featherlight.js', array( 'jquery' ), '1.5.0', true );
    }
    
    // Custom
    wp_enqueue_script('scisco-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), $theme_version, true );
}
}
add_action( 'wp_enqueue_scripts', 'scisco_script_register' );

/*---------------------------------------------------
Dashboard scripts
----------------------------------------------------*/

if ( ! function_exists( 'scisco_theme_admin_scripts' ) ) {
function scisco_theme_admin_scripts(){
    wp_enqueue_style('scisco-theme-admin-style', get_template_directory_uri() . '/includes/css/admin.css', false, '1.0');
}
}
add_action( 'admin_enqueue_scripts', 'scisco_theme_admin_scripts', 99 );

/*---------------------------------------------------
Register Sidebars
----------------------------------------------------*/

if ( ! function_exists( 'scisco_sidebars_widgets_init' ) ) {
function scisco_sidebars_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Main Sidebar', 'scisco'),
        'id' => 'scisco_main_sidebar',
        'description' => esc_html__( 'This sidebar is displayed on blog pages.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Page Sidebar', 'scisco'),
        'id' => 'scisco_page_sidebar',
        'description' => esc_html__( 'This sidebar is displayed on page-sidebar template.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'User Directory Sidebar', 'scisco'),
        'id' => 'scisco_users_sidebar',
        'description' => esc_html__( 'This sidebar is displayed on user directory.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget ap-widget-pos">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Jobs Sidebar', 'scisco'),
        'id' => 'scisco_jobs_sidebar',
        'description' => esc_html__( 'This sidebar is displayed on jobs page.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'WooCommerce Sidebar', 'scisco'),
        'id' => 'scisco_woo_sidebar',
        'description' => esc_html__( 'This sidebar is displayed on WooCommerce pages.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</span></h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Before Footer', 'scisco'),
        'id' => 'scisco_before_footer',
        'description' => esc_html__( 'This widget field is displayed before theme footer. It is suitable for single ads.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Footer 1', 'scisco'),
        'id' => 'scisco_footer_widgets',
        'description' => esc_html__( 'First Column.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Footer 2', 'scisco'),
        'id' => 'scisco_footer_2_widgets',
        'description' => esc_html__( 'Second Column.', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Footer 3', 'scisco'),
        'id' => 'scisco_footer_3_widgets',
        'description' => esc_html__( 'Third Column', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
    register_sidebar( array(
        'name' => esc_html__( 'Footer 4', 'scisco'),
        'id' => 'scisco_footer_4_widgets',
        'description' => esc_html__( 'Fourth Column', 'scisco' ),
        'before_widget' => '<div id="%1$s" class="%2$s scisco-widget">',
        'after_widget' => "</div>",
        'before_title' => '<h6 class="highlighted-title">',
        'after_title' => '</h6>',
    ));
}
}
add_action( 'widgets_init', 'scisco_sidebars_widgets_init' );

/*---------------------------------------------------
Custom excerpt dots
----------------------------------------------------*/

if ( ! function_exists( 'scisco_excerpt_read_more' ) ) {
function scisco_excerpt_read_more( $more ) {
	return '...';
}
}
add_filter('excerpt_more', 'scisco_excerpt_read_more');

/*---------------------------------------------------
Custom tag cloud
----------------------------------------------------*/
if ( ! function_exists( 'scisco_wp_generate_tag_cloud' ) ) {
function scisco_wp_generate_tag_cloud($content, $tags, $args)
{ 
    if ( ! is_admin() ) {        
        $output = str_replace(array( '(', ')' ), '', $content);
    } else {
        $output = $content;
    }
  return $output;    
}
}
add_filter('wp_generate_tag_cloud','scisco_wp_generate_tag_cloud', 10, 3);

if ( ! function_exists( 'scisco_tag_cloud_args' ) ) {
    function scisco_tag_cloud_args($args) {
        $scisco_args = array('smallest' => 0.85, 'largest' => 0.85, 'orderby' => 'count','unit' => 'rem','order' => 'DESC');
        $args = wp_parse_args( $args, $scisco_args );
        return $args;
    }
}
add_filter('widget_tag_cloud_args','scisco_tag_cloud_args');

/* ---------------------------------------------------------
Default Avatar
----------------------------------------------------------- */
if ( ! function_exists( 'scisco_default_avatar' ) ) {
    function scisco_default_avatar($avatar_defaults) {
        $default_avatar = get_theme_mod('scisco_default_avatar');
        if ($default_avatar) {
            $avatar_defaults[$default_avatar] = esc_html('Scisco Avatar', 'scisco');
        }
        return $avatar_defaults;
    }
}
add_filter( 'avatar_defaults', 'scisco_default_avatar' );

/*---------------------------------------------------
Custom comments
----------------------------------------------------*/
if ( ! function_exists( 'scisco_comment' ) ) {
function scisco_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">      
    <div id="comment-<?php comment_ID(); ?>" class="scisco_comments"> 
        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php echo esc_html('Your comment is awaiting moderation.', 'scisco'); ?></em>
        <br />
        <?php endif; ?> 
        <div class="scisco_comment">
            <div class="scisco_comment_inner">
                <?php $scisco_avatar = get_avatar( $comment, 60 ); ?>
                <?php if (!empty($scisco_avatar)) { ?>
                <div class="scisco_comment_left">
                    <?php echo get_avatar( $comment, 60 ); ?> 
                </div>
                <?php } ?>
                <div class="scisco_comment_right">
                    <div class="scisco_comment_right_inner <?php if (empty($scisco_avatar)) { ?>scisco_no_avatar<?php } ?>">
                    <cite class="scisco_fn"><?php printf(esc_attr('%s'), get_comment_author_link()) ?></cite>
                    <div class="scisco_comment_links">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><i class="fas fa-clock"></i> <?php printf(esc_html__('%1$s at %2$s', 'scisco'), get_comment_date(),  get_comment_time()) ?></a> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(esc_html__('(Edit)', 'scisco'),'  ','') ?>
                    </div>    
                    <div class="scisco_comment_text">
                        <?php comment_text(); ?>
                    </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}          
}

/*---------------------------------------------------
FontAwesome Arrays
----------------------------------------------------*/

if ( ! function_exists( 'scisco_fontawesome_icons' ) ) {
function scisco_fontawesome_icons() {
	$scisco_fa_array = array(
        'facebook' => esc_html__( 'Facebook', 'scisco' ),
        'twitter' => esc_html__( 'Twitter', 'scisco' ),
        'google' => esc_html__( 'Google', 'scisco' ),
        'linkedin-in' => esc_html__( 'Linkedin', 'scisco' ),
        'instagram' => esc_html__( 'Instagram', 'scisco' ),
        'vimeo-v' => esc_html__( 'Vimeo', 'scisco' ),
        'youtube' => esc_html__( 'You Tube', 'scisco' ),
        'apple' => esc_html__( 'Apple', 'scisco' ),
        'android' => esc_html__( 'Android', 'scisco' ),
        'amazon' => esc_html__( 'Amazon', 'scisco' ),
        'behance' => esc_html__( 'Behance', 'scisco' ),
        'blogger' => esc_html__( 'Blogger', 'scisco' ),
        'delicious' => esc_html__( 'Delicious', 'scisco' ),
        'deviantart' => esc_html__( 'Deviantart', 'scisco' ),
        'digg' => esc_html__( 'Digg', 'scisco' ),
        'discord' => esc_html__( 'Discord', 'scisco' ),
        'dribbble' => esc_html__( 'Dribbble', 'scisco' ),
        'etsy' => esc_html__( 'Etsy', 'scisco' ),
        'flickr' => esc_html__( 'Flickr', 'scisco' ),
        'github' => esc_html__( 'Github', 'scisco' ),
        'pinterest' => esc_html__( 'Pinterest', 'scisco' ),
        'vk' => esc_html__( 'VK', 'scisco' ),
        'snapchat-ghost' => esc_html__( 'Snapchat', 'scisco' ),
        'tumblr' => esc_html__( 'Tumblr', 'scisco' ),     
        'twitch' => esc_html__( 'Twitch', 'scisco' ),
        'vine' => esc_html__( 'Vine', 'scisco' ),
        'foursquare' => esc_html__( 'Foursquare', 'scisco' ),
        'soundcloud' => esc_html__( 'Soundcloud', 'scisco' ),
        'odnoklassniki' => esc_html__( 'Odnoklassniki', 'scisco' ),
        'xing' => esc_html__( 'Xing', 'scisco' ),
        'lastfm' => esc_html__( 'Lastfm', 'scisco' ),
        'medium' => esc_html__( 'Medium', 'scisco' ),
        'slack' => esc_html__( 'Slack', 'scisco' ),
        'whatsapp' => esc_html__( 'Whatsapp', 'scisco' ),
    );
    return $scisco_fa_array;
}
}

/* ---------------------------------------------------------
Add a class to Mailchimp form
----------------------------------------------------------- */
add_filter( 'mc4wp_form_css_classes', function( $classes ) { 
	$classes[] = 'scisco-mailchimp';
	return $classes;
});

/*---------------------------------------------------
Additional Logged In User Menu Items
----------------------------------------------------*/

function scisco_loggedin_user_menu_items() {
    $enable_menu_items = get_theme_mod( 'scisco_add_loggedin_menu_items');
    $menu_items = get_theme_mod( 'scisco_loggedin_menu_items');
    if ($enable_menu_items && !empty($menu_items) && is_array($menu_items)) {
        foreach( $menu_items as $entry ) {
            $title = $icon = $destination = '';
            if ( isset( $entry['title'] ) ) {            
                $title = $entry['title'];
            }
            if ( isset( $entry['icon'] ) ) {            
                $icon = $entry['icon'];
            }
            if ( isset( $entry['destination_url'] ) ) {            
                $destination = $entry['destination_url'];
            }
            echo '<a href="' . esc_url($destination) . '" class="dropdown-item"><i class="' . esc_attr($icon) . '"></i>' . esc_html($title) . '</a>';
        }  
    }
}
add_action( 'scisco_user_menu_items', 'scisco_loggedin_user_menu_items', 9 );

/*---------------------------------------------------
Additional Non-Logged In User Menu Items
----------------------------------------------------*/

function scisco_non_loggedin_user_menu_items() {
    $enable_menu_items = get_theme_mod( 'scisco_add_non_loggedin_menu_items');
    $menu_items = get_theme_mod( 'scisco_non_loggedin_menu_items');
    if ($enable_menu_items && !empty($menu_items) && is_array($menu_items)) {
        foreach( $menu_items as $entry ) {
            $title = $icon = $destination = '';
            if ( isset( $entry['title'] ) ) {            
                $title = $entry['title'];
            }
            if ( isset( $entry['icon'] ) ) {            
                $icon = $entry['icon'];
            }
            if ( isset( $entry['destination_url'] ) ) {            
                $destination = $entry['destination_url'];
            }
            echo '<a href="' . esc_url($destination) . '" class="dropdown-item"><i class="' . esc_attr($icon) . '"></i>' . esc_html($title) . '</a>';
        }  
    }
}
add_action( 'scisco_guest_menu_items', 'scisco_non_loggedin_user_menu_items', 9 );

/* ---------------------------------------------------------
TGM Activation Class
----------------------------------------------------------- */

require_once(get_template_directory() . '/includes/class-tgm-plugin-activation.php');

if ( ! function_exists( 'scisco_register_required_plugins' ) ) {
function scisco_register_required_plugins() {
	$scisco_plugins = array(
		array(
			'name'     				=> esc_html__( 'Scisco Features', 'scisco'),
			'slug'     				=> 'scisco-features',
			'source'   				=> get_template_directory_uri() . '/plugins/scisco-features.zip',
			'required' 				=> true,
            'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),
        array(
			'name'     				=> esc_html__( 'Kirki', 'scisco'),
			'slug'     				=> 'kirki',
			'required' 				=> true,
        ),
        array(
			'name'     				=> esc_html__( 'AnsPress Question Answer', 'scisco'),
			'slug'     				=> 'anspress-question-answer',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'Elementor', 'scisco'),
			'slug'     				=> 'elementor',
			'required' 				=> true,
		),
        array(
			'name'     				=> esc_html__( 'CMB2', 'scisco'),
			'slug'     				=> 'cmb2',
			'required' 				=> true,
        ),
        array(
			'name'     				=> esc_html__( 'WooCommerce', 'scisco'),
			'slug'     				=> 'woocommerce',
			'required' 				=> false,
        ),
        array(
			'name'     				=> esc_html__( 'WP Job Manager', 'scisco'),
			'slug'     				=> 'wp-job-manager',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'WP Menu Icons', 'scisco'),
			'slug'     				=> 'wp-menu-icons',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'Front End PM', 'scisco'),
			'slug'     				=> 'front-end-pm',
			'required' 				=> false,
        ),
        array(
			'name'     				=> esc_html__( 'Custom Login Page Customizer', 'scisco'),
			'slug'     				=> 'colorlib-login-customizer',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'Contact Form 7', 'scisco'),
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
		),
        array(
			'name'     				=> esc_html__( 'One Click Demo Import', 'scisco'),
			'slug'     				=> 'one-click-demo-import',
			'required' 				=> false,
		)
	);

	$scisco_config = array(
        'id'           => 'scisco',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $scisco_plugins, $scisco_config );

}
}
add_action( 'tgmpa_register', 'scisco_register_required_plugins' );
?>