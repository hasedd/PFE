<?php
function scisco_follow_init() {
    if(isset($_REQUEST['action'])) {
        if(in_array($_REQUEST['action'], scisco_follow_valid_actions())) {
            do_action( 'wp_ajax_' . $_REQUEST['action'] );
        }
    }
}

function scisco_follow_is_following($user_id, $current_user) {
    $followers = get_user_meta( $current_user, 'scisco_following', true);
    if (!empty($followers) && is_array($followers) && array_key_exists($user_id, $followers) && $followers[$user_id]) {
        return true;
    }
    return false;
}

function scisco_follow_helper_check_data() {
    if(!wp_verify_nonce( $_POST['_ajax_nonce'], 'sciscoFollowUser' )) {
        die(-1);
    }
    if (!array_key_exists('user_id', $_POST)) {
        die(-1);
    }
    $user_id = absint($_POST['user_id']);
    if ($user_id < 1) {
        die(-1);
    }
    return $user_id;
}

function scisco_follow() {
    $user_id = scisco_follow_helper_check_data();
    $current_user = wp_get_current_user();
    $followers = get_user_meta( $current_user->ID, 'scisco_following', true);
    if (!is_array($followers)){
        $followers = array();
    }
    $followers[$user_id] = 1;
    update_user_meta( $current_user->ID, 'scisco_following', $followers );
    echo scisco_follow_button($user_id, false);
    exit;
}

function scisco_unfollow() {
    $user_id = scisco_follow_helper_check_data();
    $current_user = wp_get_current_user();
    $followers = get_user_meta( $current_user->ID, 'scisco_following', true);
    if (is_array($followers) && !empty($followers)){
        unset($followers[$user_id]);
    } else {
        $followers = array();
    }
    update_user_meta( $current_user->ID, 'scisco_following', $followers );
    echo scisco_follow_button($user_id, true);
    exit;
}

function scisco_follow_button($user_id, $follow=true) {
    $btn_style = get_theme_mod('scisco_ap_messages_btn_style', 'btn-info');
    $class = 'scisco-unfollow';
    $label = esc_html__('Unfollow','scisco');
    if (true === $follow) {
        $class = 'scisco-follow';
        $label = esc_html__('Follow','scisco');
    }
    return '<a href="#scisco-follow" class="btn ' . $btn_style . ' btn-sm ' . $class . '" data-user_id="' . $user_id . '">' . $label . '</a>';
}

function scisco_follow_valid_actions() {
    return array(
        'scisco_follow',
        'scisco_unfollow',
    );
}

function scisco_follow_enqueue_scripts() {
    if (is_user_logged_in()) {
        wp_localize_script('jquery', 'admin_ajax', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('sciscoFollowUser'),
        ));
        wp_enqueue_script( 'scisco-follow', plugin_dir_url( __FILE__ ) . 'js/follow.js', array( 'jquery'), '1.0', false );
    }
}

function scisco_follow_output($ap_user_id, $current_user_id) {
    if (get_query_var( 'ap_page' ) != '' && get_query_var( 'ap_page' ) == 'user'){
        $follow = scisco_follow_is_following($ap_user_id, $current_user_id);
        echo '<div id="scisco-follow-btns">' . scisco_follow_button($ap_user_id, !$follow) . '</div>';
    }
}

if (is_admin()){
    foreach (scisco_follow_valid_actions() as $action) {
        add_action('wp_ajax_'.$action, $action);
    }
}

add_action( 'init', 'scisco_follow_init');
add_action( 'wp_enqueue_scripts', 'scisco_follow_enqueue_scripts');

