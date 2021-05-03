<div class="scisco-content-wrapper">
<?php 
if ( function_exists( 'scisco_user_messages' )) {
    $ap_user_id = ap_current_user_id();
    $current_user_id = get_current_user_id();
    if (is_user_logged_in() && $ap_user_id == $current_user_id) {
        scisco_user_messages();
    } else {
        echo '<div class="alert alert-danger">' . esc_html__( 'You do not have permission to view this page.', 'scisco' ) . '<div>';
    } 
} else {
    echo '<div class="alert alert-danger">' . esc_html('Scisco Features and Fronte End PM plugins are required.', 'scisco') . '</div>';
}
?>
</div>