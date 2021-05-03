<?php 
if ( function_exists( 'scisco_post_submit_page' )) { 
    $ap_user_id = ap_current_user_id();
    $current_user_id = get_current_user_id();
    $scisco_verified = get_theme_mod('scisco_user_blog_verified');

    if (is_user_logged_in() && $ap_user_id == $current_user_id ) {
        $scisco_verified_user = 'verified';
        if ($scisco_verified) {
            $scisco_verified_user = scisco_verified_check($current_user_id);
        }
		if ($scisco_verified_user == 'verified') {
            scisco_post_submit_page();
        } else {
            echo '<div class="alert alert-warning">' . esc_html__( 'Only verified users can submit blog post.', 'scisco' ) . '<div>';
        }
    } else {
        echo '<div class="alert alert-danger">' . esc_html__( 'You do not have permission to view this page.', 'scisco' ) . '<div>';
    }
} else {
    echo '<div class="alert alert-danger">' . esc_html('Scisco Features and CMB2 plugins are required.', 'scisco') . '</div>';
}
?>