<?php
/* ---------------------------------------------------------
Subtitle
----------------------------------------------------------- */

function scisco_subtitle_cmb2 ( $meta_boxes ) {
    $prefix = 'scisco_cmb2'; // Prefix for all fields
    $meta_boxes['scisco_subtitle'] = array(
        'id' => 'scisco_subtitle',
        'title' => esc_html__( 'Subtitle', 'scisco'),
        'object_types' => array('page','post','product'), // post type
        'context' => 'side', // normal or side
        'priority' => 'high', // default or high
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name'    => esc_html__( 'Subtitle (Optional)', 'scisco'),
                'desc'    => '',
                'id'      => $prefix . '_subtitle',
                'type'    => 'text'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'scisco_subtitle_cmb2' );

/* ---------------------------------------------------------
Header Image
----------------------------------------------------------- */

function scisco_bg_image_cmb2 ( $meta_boxes ) {
    $prefix = 'scisco_cmb2'; // Prefix for all fields
    $meta_boxes['scisco_bg_image'] = array(
        'id' => 'scisco_bg_image',
        'title' => esc_html__( 'Header Cover Image', 'scisco'),
        'object_types' => array('post','page'), // post type
        'context' => 'side', // normal or side
        'priority' => 'high', // default or high
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__( 'Header Cover Image', 'scisco'),
                'desc' => esc_html__( 'You can change default cover image from theme settings.', 'scisco'),
                'id' => $prefix . '_subheader_image',
                'type' => 'file'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'scisco_bg_image_cmb2' );

/* ---------------------------------------------------------
Taxonomy Header Image
----------------------------------------------------------- */

function scisco_tax_bg_image_cmb2 ( $meta_boxes ) {
    $prefix = 'scisco_cmb2'; // Prefix for all fields
    $meta_boxes['scisco_tax_bg_image'] = array(
        'id' => 'scisco_tax_bg_image',
        'title' => esc_html__( 'Header Cover Image', 'scisco'),
        'object_types' => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
        'taxonomies' => array( 'category', 'post_tag', 'question_category', 'question_tag' ), // Tells CMB2 which taxonomies should have these fields
        'fields' => array(
            array(
                'name' => esc_html__( 'Header Cover Image', 'scisco'),
                'desc' => esc_html__( 'You can change default cover image from theme settings.', 'scisco'),
                'id' => $prefix . '_taxheader_image',
                'type' => 'file'
            )
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'scisco_tax_bg_image_cmb2' );
?>