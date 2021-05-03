<?php
/*---------------------------------------------------
Set Default Elementor Settings
----------------------------------------------------*/

if ( ! function_exists( 'scisco_elementor_settings' ) ) {
    function scisco_elementor_settings() {
        update_option('elementor_disable_color_schemes', 'yes');
        update_option('elementor_disable_typography_schemes', 'yes');
        update_option('elementor_container_width', 1240);
        update_option('elementor_space_between_widgets', 60);
        update_option('elementor_page_title_selector', '#scisco-page-title');
        update_option('elementor_viewport_lg', 1199);
        update_option('elementor_viewport_md', 768);
    }
}

add_action( 'after_switch_theme', 'scisco_elementor_settings' );
add_action( 'elementor/loaded', 'scisco_elementor_settings' );
?>