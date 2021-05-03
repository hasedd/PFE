<?php
/**
* Plugin Name: Scisco Features
* Plugin URI: https://1.envato.market/1k3gD
* Description: Custom post types, widgets and shortcodes
* Version: 1.0
* Author: Egemenerd
* License: http://themeforest.net/licenses
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Register Scripts and Styles */

function scisco_cpt_scripts() {
    $scisco_enable_user_blog = get_theme_mod('scisco_enable_user_blog');

    if (class_exists('Front_End_Pm')) {
        wp_dequeue_style('fep-style');
        wp_dequeue_style('fep-common-style');
        wp_enqueue_style('scisco-fep-styles', plugin_dir_url( __FILE__ ) . 'css/fep.css', true, '1.0');
    }

    wp_enqueue_style('scisco-cpt-styles', plugin_dir_url( __FILE__ ) . 'css/style.css', true, '1.0');
    if (is_rtl()) {
        wp_enqueue_style('scisco-cpt-rtl-styles', plugin_dir_url( __FILE__ ) . 'css/rtl.css', array( 'scisco-cpt-styles' ), '1.0');
    }

    // Ajax Search
    $scisco_live_search = get_theme_mod('scisco_live_search');
    
    if ($scisco_live_search) {
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'scisco-autocomplete', plugin_dir_url( __FILE__ ) . 'js/autocomplete.js', array( 'jquery', 'jquery-ui-autocomplete' ), '1.0', false );
        wp_localize_script( 'scisco-autocomplete', 'sciscoAutocomplete', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
    }

    if ($scisco_enable_user_blog) {
        wp_enqueue_script( 'scisco-post-delete', plugin_dir_url( __FILE__ ) . 'js/post-delete.js', array('jquery'), '1.0', false );
        wp_localize_script( 'scisco-post-delete', 'sciscoPostAjax', array( 'url' => admin_url( 'admin-ajax.php' ),'msg' => esc_attr__( 'Post is deleted.', 'scisco' ) ) );
    }

    wp_enqueue_script( 'scisco-shape-dividers', plugin_dir_url( __FILE__ ) . 'js/shape-divider.js', array('jquery'), '1.0', false );
    wp_localize_script(
        'scisco-shape-dividers',
        'SciscoDividerParams',
        [
            'sciscoPluginURL' => plugin_dir_url( __FILE__ )
        ]
    );
}
add_action('wp_enqueue_scripts','scisco_cpt_scripts', 90);

/* Register Admin Scripts */

function scisco_features_admin_scripts() {
    $scisco_js_script_ajax_nonce = wp_create_nonce( "scisco_js_script_ajax_nonce" );
    wp_enqueue_script('scisco_features_admin_script', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'scisco_features_admin_script', 'scisco_vars', array( 'scisco_ajax_url'   => admin_url( 'admin-ajax.php' ),'scisco_plugin_dir'   => plugins_url('',__FILE__) ,'scisco_js_script_ajax_nonce'=>$scisco_js_script_ajax_nonce)); 
}

add_action('admin_enqueue_scripts', 'scisco_features_admin_scripts');

/*---------------------------------------------------
PROFILE FIELDS
----------------------------------------------------*/

if ( defined( 'CMB2_LOADED' ) ) {
    include_once('profile-fields.php');
}

/*---------------------------------------------------
USER BLOG
----------------------------------------------------*/

$scisco_enable_user_blog = get_theme_mod('scisco_enable_user_blog');

if ($scisco_enable_user_blog && defined( 'CMB2_LOADED' )) {
    include_once('post-form.php');
    include_once('edit-post-form.php');

    function scisco_add_new_post_form() {
        echo do_shortcode('[scisco_frontend_form]');
    }

    function scisco_post_submit_page() {
        include_once('submit-form-page.php');
    }

    add_filter('pre_option_default_role', function(){
        return 'author';
    }, 10);
}

/* ---------------------------------------------------------
FRONT END PM
----------------------------------------------------------- */

function scisco_FEP () {
    if( class_exists('Front_End_Pm')) {
        include_once('fep.php');
    }
}

add_action ('plugins_loaded', 'scisco_FEP');

/*---------------------------------------------------
WP JOB MANAGER
----------------------------------------------------*/

function scisco_WP_Job_Manager () {
    if( class_exists('WP_Job_Manager')) {
        include_once('job-manager.php');
    }
}

add_action ('plugins_loaded', 'scisco_WP_Job_Manager');

/*---------------------------------------------------
FOLLOW USER
----------------------------------------------------*/

$scisco_user_follow = get_theme_mod('scisco_user_follow');

if ($scisco_user_follow) {
    include_once('user-follow.php');
}

/*---------------------------------------------------
AJAX SEARCH
----------------------------------------------------*/

$scisco_live_search = get_theme_mod('scisco_live_search');

function scisco_post_title_filter($where, &$wp_query) {
    global $wpdb;
    if ( $search_term = $wp_query->get( 'scisco_search_post_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like( $search_term ) . '%\'';
    }
    return $where;
}

function scisco_ajax_post_search() {
    $scisco_live_search_at_most = get_theme_mod('scisco_live_search_at_most', 5);
    $term = strtolower( $_GET['term'] );
    $suggestions = array();
    
    add_filter( 'posts_where', 'scisco_post_title_filter', 10, 2 );
    $loop = new WP_Query( 
        array(
            'post_type' => 'post', 
            'post_status' => 'publish',
            'posts_per_page' => $scisco_live_search_at_most, 
            'scisco_search_post_title' => $term
        )
    );
    remove_filter( 'posts_where', 'scisco_post_title_filter', 10 );
		
    if ($loop->have_posts()) {
    while( $loop->have_posts() ) {
        $loop->the_post();
        $suggestion = array();
        $suggestion['label'] = html_entity_decode(get_the_title());
        $suggestion['value'] = get_permalink();
        $suggestions[] = $suggestion;
    }
    } else {
        $suggestion = array();
        $suggestion['label'] = '';
        $suggestion['value'] = '';
        $suggestions[] = $suggestion;
    }
		
    wp_reset_postdata();
    	
    $response = wp_json_encode( $suggestions );
    print $response;
    exit();
}

if ($scisco_live_search) {
    add_action( 'wp_ajax_scisco_ajax_post_search', 'scisco_ajax_post_search' );
    add_action( 'wp_ajax_nopriv_scisco_ajax_post_search', 'scisco_ajax_post_search' );
}

/* ---------------------------------------------------------
ANSPRESS AJAX SEARCH
----------------------------------------------------------- */

function scisco_anspress_title_filter($where, &$wp_query) {
    global $wpdb;
    if ( $search_term = $wp_query->get( 'scisco_search_anspress_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like( $search_term ) . '%\'';
    }
    return $where;
}

function scisco_ajax_search() {
    $scisco_live_search_at_most = get_theme_mod('scisco_live_search_at_most', 5);
    $term = strtolower( $_GET['term'] );
    $suggestions = array();
    
    add_filter( 'posts_where', 'scisco_anspress_title_filter', 10, 2 );
    $loop = new WP_Query( 
        array(
            'post_type' => array('question'), 
            'post_status' => 'publish',
            'posts_per_page' => $scisco_live_search_at_most, 
            'scisco_search_anspress_title' => $term
        )
    );
    remove_filter( 'posts_where', 'scisco_anspress_title_filter', 10 );
		
    if ($loop->have_posts()) {
        while( $loop->have_posts() ) {
            $loop->the_post();
            $suggestion = array();
            $suggestion['label'] = html_entity_decode(get_the_title());
            $suggestion['value'] = get_permalink();
            $suggestions[] = $suggestion;
        }
        } else {
            $suggestion = array();
            $suggestion['label'] = '';
            $suggestion['value'] = '';
            $suggestions[] = $suggestion;
        }
		
		wp_reset_postdata();

    	$response = wp_json_encode( $suggestions );
    	print $response;
    	exit();
}
if ($scisco_live_search) {
    add_action( 'wp_ajax_scisco_ajax_search', 'scisco_ajax_search' );
    add_action( 'wp_ajax_nopriv_scisco_ajax_search', 'scisco_ajax_search' );
}

/* ---------------------------------------------------------
Ajax WooCommerce Search
----------------------------------------------------------- */

function scisco_woo_title_filter($where, &$wp_query) {
    global $wpdb;
    if ( $search_term = $wp_query->get( 'scisco_search_woo_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like( $search_term ) . '%\'';
    }
    return $where;
}

function scisco_ajax_woo_search() {
    $scisco_live_search_at_most = get_theme_mod('scisco_live_search_at_most', 5);
    $term = strtolower( $_GET['term'] );
    
    $suggestions = array();
    
    add_filter( 'posts_where', 'scisco_woo_title_filter', 10, 2 );
    $loop = new WP_Query( 
        array(
            'post_type' => array('product'), 
            'post_status' => 'publish',
            'posts_per_page' => $scisco_live_search_at_most, 
            'scisco_search_woo_title' => $term
        )
    );
    remove_filter( 'posts_where', 'scisco_woo_title_filter', 10 );
		
    if ($loop->have_posts()) {
    while( $loop->have_posts() ) {
        $loop->the_post();
        $suggestion = array();
        $suggestion['label'] = html_entity_decode(get_the_title());
        $suggestion['value'] = get_permalink();
        $suggestions[] = $suggestion;
    }
    } else {
        $suggestion = array();
        $suggestion['label'] = '';
        $suggestion['value'] = '';
        $suggestions[] = $suggestion;
    }
    
    wp_reset_postdata();
    	
    $response = wp_json_encode( $suggestions );
    print $response;
    exit();
}
if ($scisco_live_search) {
    add_action( 'wp_ajax_scisco_ajax_woo_search', 'scisco_ajax_woo_search' );
    add_action( 'wp_ajax_nopriv_scisco_ajax_woo_search', 'scisco_ajax_woo_search' );
}

/* ---------------------------------------------------------
HELPERS
----------------------------------------------------------- */

include_once('helpers.php');

/* ---------------------------------------------------------
VERIFIED USERS
----------------------------------------------------------- */

include_once('verified-users.php');

/* ---------------------------------------------------------
User Profile Buttons
----------------------------------------------------------- */

function scisco_user_buttons_action() {
    if (is_user_logged_in()) {
        $ap_user_id = ap_current_user_id();
        $current_user_id = get_current_user_id();
        if (class_exists('Front_End_Pm')) {
            if ($ap_user_id != $current_user_id) {
                $scisco_page_slug = get_theme_mod('scisco_ap_messages_slug', 'messages');
                $btn_style = get_theme_mod('scisco_ap_messages_btn_style', 'btn-info');
                $user_data = get_userdata($ap_user_id);
                $user_nicename = $user_data->user_nicename; 

                echo '<a href="' . esc_url(ap_user_link($current_user_id) . $scisco_page_slug . '?fepaction=newmessage&fep_to=' . $user_nicename . '&message_title=' . esc_html__( 'Hello', 'scisco')) . '" class="btn btn-sm ' . $btn_style . '"><i class="fas fa-envelope"></i>' . esc_html__( 'Send Message', 'scisco') . '</a>';
            }
        }

        $scisco_user_follow = get_theme_mod('scisco_user_follow');

        if ($scisco_user_follow && ($ap_user_id != $current_user_id)) {
            scisco_follow_output($ap_user_id, $current_user_id);
        }
    }
}
add_action('scisco_user_buttons','scisco_user_buttons_action', 10);

/* ---------------------------------------------------------
Limit WordPress dashboard access and remove admin bar for non-admins.
----------------------------------------------------------- */

$scisco_limit_dashboard = get_theme_mod('scisco_limit_dashboard');

function scisco_limit_dashboard_access() { 
    $scisco_limit_dashboard_url = get_theme_mod('scisco_limit_dashboard_url');
    if (empty($scisco_limit_dashboard_url)) {
        $scisco_limit_dashboard_url = home_url( '/' );
    }
    if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) { 
        wp_redirect($scisco_limit_dashboard_url);
        exit; 
    }
}

function scisco_hide_admin_bar( $show ) {
    if (! current_user_can( 'administrator' )) {
        $show = false;
    }
    return $show;
}
  
if ($scisco_limit_dashboard) {
    add_action( 'init', 'scisco_limit_dashboard_access' );  
    add_filter( 'show_admin_bar', 'scisco_hide_admin_bar' );
}

/* ---------------------------------------------------------
Custom Avatar
----------------------------------------------------------- */

$scisco_user_img = get_theme_mod('scisco_ap_user_img');
$scisco_user_avatar = get_theme_mod('scisco_ap_user_avatar');

function scisco_gravatar_filter($avatar, $id_or_email, $size, $default, $alt) {
    $email = is_object( $id_or_email ) ? $id_or_email->comment_author_email : $id_or_email;
	if( is_email( $email ) && ! email_exists( $email ) ) {
		return $avatar;
    }
	
	$custom_avatar = get_user_meta($id_or_email, 'scisco_cmb2_user_avatar' );
    $custom_avatar_img = wp_get_attachment_image_src( get_user_meta( $id_or_email, 'scisco_cmb2_user_avatar_id', 1 ), 'thumbnail' );
    
	if ($custom_avatar) {
        $return = '<img class="avatar" src="' . $custom_avatar_img[0] . '" width="' . $size . '" height="' . $size . '" alt="' . $alt . '" />';
    } elseif ($avatar) {
		$return = $avatar;
    } else {
		$return = '<img class="avatar" src="' . $default . '" width="' . $size . '" height="' . $size . '" alt="' . $alt . '" />';
    }
	return $return;
}

if ($scisco_user_avatar) {
    add_filter('get_avatar', 'scisco_gravatar_filter', 10, 5);
}

/* ---------------------------------------------------------
Allow user uploads (Optional)
(Required for custom avatar and cover image uploads)
----------------------------------------------------------- */	

function scisco_allow_user_uploads() {
    if ( current_user_can('subscriber') && !current_user_can('upload_files') ){
        $subscriber = get_role('subscriber');
        $subscriber->add_cap('upload_files');
    }
}

function scisco_show_current_user_attachments( $query = array() ) {
    $user_id = get_current_user_id();
    if (!user_can( $user_id, 'edit_others_posts' )) {
        if($user_id) {
            $query['author'] = $user_id;
        }
        return $query;
    } else {
        return $query;
    }
}

if ($scisco_user_img || $scisco_user_avatar) {
    add_filter( 'ajax_query_attachments_args', 'scisco_show_current_user_attachments', 10, 1 );
    add_action('init', 'scisco_allow_user_uploads');
}

/**
 * 
 * Add required mime types
 * 
 */

function scisco_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'scisco_mime_types' );

/* ---------------------------------------------------------
ELEMENTOR
----------------------------------------------------------- */

include_once('elementor.php');

/* Create a new category */

function scisco_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'scisco-widgets',
		[
			'title' => esc_html__( 'Scisco', 'scisco' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'scisco_add_elementor_widget_categories' );

/* ---------------------------------------------------------
DEMO IMPORT
----------------------------------------------------------- */

function scisco_import_files() {
    return array(
        array(
            'import_file_name'           => 'Demo Import',
            'import_file_url'            => 'https://www.thememasters.club/demos/scisco/demo.xml',
            'import_widget_file_url'     => 'https://www.thememasters.club/demos/scisco/widgets.wie',
            'import_customizer_file_url' => 'https://www.thememasters.club/demos/scisco/customizer.dat'
        )
    );
}
add_filter( 'pt-ocdi/import_files', 'scisco_import_files' );

function scisco_before_content_import() {
    if (class_exists( 'AnsPress' )) {
	    ap_activate_addon( 'category.php' );
        ap_activate_addon( 'reputation.php' );
        ap_activate_addon( 'notifications.php' );
        ap_activate_addon( 'profile.php' );
        ap_activate_addon( 'syntaxhighlighter.php' );
    }
    update_option('job_manager_enable_categories', '1');
}
add_action( 'pt-ocdi/before_content_import', 'scisco_before_content_import' );


function scisco_after_import_setup() {
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'scisco-main-menu' => $main_menu->term_id,
        )
    );
    $front_page_id = get_page_by_title( 'Homepage' );
    $blog_page_id  = get_page_by_title( 'Blog' );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
    update_option( 'elementor_active_kit', 9999 );
}
add_action( 'pt-ocdi/after_import', 'scisco_after_import_setup' );
?>