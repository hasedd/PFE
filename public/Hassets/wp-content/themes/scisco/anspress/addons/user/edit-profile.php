<div class="scisco-content-wrapper">
<?php 
$ap_user_id = ap_current_user_id();
$current_user_id = get_current_user_id();
if (function_exists('cmb2_metabox_form') && is_user_logged_in() && $ap_user_id == $current_user_id) {
    cmb2_metabox_form( 'scisco_user_fields', $current_user_id, array('save_button' => esc_html__( 'Save Changes', 'scisco' )) );
} else {
    echo '<div class="alert alert-danger">' . esc_html__( 'You do not have permission to view this page.', 'scisco' ) . '<div>';
} 
?>
</div>