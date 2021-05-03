<?php 
$ap_user_id = ap_current_user_id();
$current_user_id = get_current_user_id();
$page_activity = get_query_var('ap_activity_page');
$active_page = '';
if ($page_activity) {
    $active_page = $page_activity;
} else {
    $active_page = 'questions';
}
if (is_user_logged_in() && $ap_user_id == $current_user_id) {
    if ($active_page == 'answers') {
        ap_get_template_part( 'addons/user/answers-activity' );
    } elseif ($active_page == 'posts') {
        ap_get_template_part( 'addons/user/blog-activity' );
    } else {
        ap_get_template_part( 'addons/user/questions-activity' );
    }
} else {
    echo '<div class="alert alert-danger">' . esc_html__( 'You do not have permission to view this page.', 'scisco' ) . '<div>';
} 
?>