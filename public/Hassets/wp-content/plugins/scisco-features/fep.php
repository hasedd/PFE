<?php
function scisco_user_messages() {
    echo do_shortcode('[front-end-pm]');
}

function scisco_fep_view_message_action() {
    wp_enqueue_script( 'fep-view-message' );
}
add_action('scisco_fep_view_message','scisco_fep_view_message_action', 10);

function scisco_fep_check_uncheck_action() {
    wp_enqueue_script( 'fep-cb-check-uncheck-all' );
}
add_action('scisco_fep_check_uncheck','scisco_fep_check_uncheck_action', 10);

function scisco_fep_block_unblock_action() {
    if ( fep_get_option( 'block_other_users', 1 ) ) {
        wp_enqueue_script( 'fep-block-unblock-script' );
    }
}
add_action('scisco_fep_block_unblock','scisco_fep_block_unblock_action', 10);

if (class_exists( 'AnsPress' )) {
    function scisco_fep_page_filter($url, $args) {
        $scisco_page_slug = get_theme_mod('scisco_ap_messages_slug', 'messages');
        $user_url = ap_user_link(get_current_user_id()) . $scisco_page_slug;
        $url = add_query_arg( $args, $user_url );
        return $url;
    }
    add_filter('fep_query_url_without_esc_filter','scisco_fep_page_filter',2,99);
}
?>