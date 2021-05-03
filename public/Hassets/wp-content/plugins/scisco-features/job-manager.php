<?php
function scisco_job_menu_items() {
    $job_dashboard_url = get_permalink(get_option('job_manager_job_dashboard_page_id'));
    $job_form_url = get_permalink(get_option('job_manager_submit_job_form_page_id'));
    if (get_option('job_manager_job_dashboard_page_id')) {
        echo '<a href="' . esc_url($job_dashboard_url) . '" class="dropdown-item"><i class="fas fa-briefcase"></i>' . esc_html(get_the_title(get_option('job_manager_job_dashboard_page_id'))) . '</a>';
    }
    if (get_option('job_manager_submit_job_form_page_id')) {
        echo '<a href="' . esc_url($job_form_url) . '" class="dropdown-item"><i class="fas fa-plus-circle"></i>' . esc_html(get_the_title(get_option('job_manager_submit_job_form_page_id'))) . '</a>';
    }
}
add_action( 'scisco_user_menu_items', 'scisco_job_menu_items', 11 );
?>