<?php

function cmb2_render_callback_for_scisco_password( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'password','data-lpignore' => true,'autocomplete' => 'off','minlength' => 8 ) );
}
add_action( 'cmb2_render_scisco_password', 'cmb2_render_callback_for_scisco_password', 10, 5 );

/* ---------------------------------------------------------
Drop down for selecting the user's language
----------------------------------------------------------- */

function scisco_user_locale_array() {
    $languages = array();
    $available_languages = get_available_languages();

    include_once('locale-convertion.php');

    $languages[''] = esc_html__( 'English (United States)', 'scisco');

    foreach ($available_languages as $id) {
        $languages[$id] = $wp_locale_conversion[$id];
    }

    return $languages;
}

/* ---------------------------------------------------------
Drop down for selecting the user's display name
----------------------------------------------------------- */

function scisco_user_display_name_array() {
    $display_names = array();
    $current_user = wp_get_current_user();
    $user_login = $current_user->user_login;
    $user_nickname = $current_user->nickname;
    $user_first_name = $current_user->first_name;
    $user_last_name = $current_user->last_name;

    $display_names[$user_login] = $user_login;

    if (!empty($user_nickname)) {
        $display_names[$user_nickname] = $user_nickname;
    }

    if (!empty($user_first_name)) {
        $display_names[$user_first_name] = $user_first_name;
    }

    if (!empty($user_last_name)) {
        $display_names[$user_last_name] = $user_last_name;
    }

    if ( !empty($user_first_name) && !empty($user_last_name) ) {
        $display_names[$user_first_name . ' ' . $user_last_name] = $user_first_name . ' ' . $user_last_name;
        $display_names[$user_last_name . ' ' . $user_first_name] = $user_last_name . ' ' . $user_first_name;
	}

    return $display_names;
}

/* ---------------------------------------------------------
User Profile Fields
----------------------------------------------------------- */

function scisco_user_fields_cmb2() {
    $scisco_user_img = get_theme_mod('scisco_ap_user_img');
    $scisco_user_avatar = get_theme_mod('scisco_ap_user_avatar');
    $scisco_social_icons = get_theme_mod('scisco_ap_social_icons');

    $prefix = 'scisco_cmb2'; // Prefix for all fields
    $scisco_cmb2 = new_cmb2_box( array(
        'id' => 'scisco_user_fields',
        'title' => esc_html__( 'Edit Profile', 'scisco'),
        'object_types' => array( 'user' ),
        'show_names' => true, // Show field names on the left
        'cmb_styles' => true,
        'hookup' => false
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'First Name', 'scisco'),
        'id'      => 'first_name',
        'type'    => 'text',
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Last Name', 'scisco'),
        'id'      => 'last_name',
        'type'    => 'text'
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Nickname', 'scisco'),
        'id'      => 'nickname',
        'type'    => 'text'
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Display name publicly as', 'scisco'),
        'id'      => $prefix . '_display_name',
        'type'    => 'select',
        'show_option_none' => false,
        'options_cb' => 'scisco_user_display_name_array',
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Email', 'scisco'),
        'id'      => $prefix . '_user_email',
        'type'    => 'text_email',
        'attributes'  => array(
            'required'    => 'required'
        ),
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Language', 'scisco'),
        'id'      =>  'locale',
        'type'    => 'select',
        'show_option_none' => false,
        'options_cb' => 'scisco_user_locale_array',
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'New Password', 'scisco'),
        'id'      => $prefix . '_user_pass',
        'desc'  => esc_html__( 'Password must be at least 8 characters in length and must include at least one upper case letter, one number, and one special character.', 'scisco' ),
        'type'    => 'scisco_password'
    ));
    $scisco_cmb2->add_field( array(
        'name' => esc_html__( 'Date of Birth', 'scisco'),
        'id'   => $prefix . '_date_of_birth',
        'type' => 'text_date',
        'attributes' => array(
            'data-datepicker' => json_encode( array(
			'yearRange' => '1950:'. date( 'Y' )
            ))
        ),
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Gender', 'scisco'),
        'desc'    => '',
        'id'      => $prefix . '_gender',
        'type'    => 'radio_inline',
        'options' => array(
            'male' => esc_html__( 'Male', 'scisco' ),
            'female'   => esc_html__( 'Female', 'scisco' ),
        ),
        'default' => ''
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Location', 'scisco'),
        'desc'    => '',
        'id'      => $prefix . '_location',
        'type'    => 'text'
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Tagline', 'scisco'),
        'id'      => $prefix . '_short_bio',
        'type'    => 'text'
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Biographical Info', 'scisco'),
        'id'      => 'description',
        'type'    => 'textarea'
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Resume', 'scisco'),
        'id'      => $prefix . '_resume',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
            'teeny' => false,
            'tinymce' => true,
            'quicktags' => false
        ),
    ));
    $scisco_cmb2->add_field( array(
        'name'    => esc_html__( 'Website URL', 'scisco'),
        'desc'    => '',
        'id'      => $prefix . '_user_url',
        'type'    => 'text_url'
    ));
    if ($scisco_user_avatar) {
    $scisco_cmb2->add_field( array(
        'name' => esc_html__( 'Avatar', 'scisco'),
        'desc' => esc_html__( 'Recommended avatar size is 150x150 px.', 'scisco'),
        'id' => $prefix . '_user_avatar',
        'type' => 'file',
        'options' => array(
            'url' => false
        ),
        'text'    => array(
            'add_upload_file_text' => esc_html__( 'Upload Image', 'scisco')
        ),
        'preview_size' => 'thumbnail',
        'query_args' => array(
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png'
                ) 
            ),
        )
    );
    }
    if ($scisco_user_img) {
    $scisco_cmb2->add_field( array(
        'name' => esc_html__( 'Cover Image', 'scisco'),
        'desc' => '',
        'id' => $prefix . '_user_cover_image',
        'type' => 'file',
        'options' => array(
            'url' => false
        ),
        'text'    => array(
            'add_upload_file_text' => esc_html__( 'Upload Image', 'scisco')
        ),
        'preview_size' => 'medium',
        'query_args' => array(
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png'
                ) 
            ),
        )
    );
    }
    if ($scisco_social_icons) {
    $scisco_cmb2->add_field( array(
		'name'     => esc_html__( 'Social Media Icons', 'scisco'),
		'id'       => $prefix . 'social_title',
		'type'     => 'title',
		'on_front' => true,
	) );
    $scisco_cmb2->add_field(
            array(
            'id' => $prefix . 'user_icons',
            'type' => 'group',
            'options' => array(
                'group_title'   => esc_html__( 'Icon {#}', 'scisco' ),
                'add_button' => esc_html__( 'Add Another Icon', 'scisco' ),
                'remove_button' => esc_html__( 'Remove Icon', 'scisco' ),
                'sortable' => true,
                'closed'     => true,
            ),
            'fields' => array(
				array(
                    'name' => esc_html__( 'Select Icon:', 'scisco'),
                    'id' => $prefix . 'iconimg',
                    'desc' => '',
                    'type' => 'select',
                    'options' => array(
                        '' => esc_html__( 'Select Icon', 'scisco' ),
                        'facebook' => esc_html__( 'Facebook', 'scisco' ),
                        'twitter' => esc_html__( 'Twitter', 'scisco' ),
                        'google' => esc_html__( 'Google', 'scisco' ),
                        'linkedin-in' => esc_html__( 'Linkedin', 'scisco' ),
                        'instagram' => esc_html__( 'Instagram', 'scisco' ),
                        'vimeo-v' => esc_html__( 'Vimeo', 'scisco' ),
                        'youtube' => esc_html__( 'You Tube', 'scisco' ),
                        'apple' => esc_html__( 'Apple', 'scisco' ),
                        'android' => esc_html__( 'Android', 'scisco' ),
                        'amazon' => esc_html__( 'Amazon', 'scisco' ),
                        'behance' => esc_html__( 'Behance', 'scisco' ),
                        'blogger' => esc_html__( 'Blogger', 'scisco' ),
                        'delicious' => esc_html__( 'Delicious', 'scisco' ),
                        'deviantart' => esc_html__( 'Deviantart', 'scisco' ),
                        'digg' => esc_html__( 'Digg', 'scisco' ),
                        'discord' => esc_html__( 'Discord', 'scisco' ),
                        'dribbble' => esc_html__( 'Dribbble', 'scisco' ),
                        'etsy' => esc_html__( 'Etsy', 'scisco' ),
                        'flickr' => esc_html__( 'Flickr', 'scisco' ),
                        'github' => esc_html__( 'Github', 'scisco' ),
                        'pinterest' => esc_html__( 'Pinterest', 'scisco' ),
                        'vk' => esc_html__( 'VK', 'scisco' ),
                        'snapchat-ghost' => esc_html__( 'Snapchat', 'scisco' ),
                        'tumblr' => esc_html__( 'Tumblr', 'scisco' ),     
                        'twitch' => esc_html__( 'Twitch', 'scisco' ),
                        'vine' => esc_html__( 'Vine', 'scisco' ),
                        'foursquare' => esc_html__( 'Foursquare', 'scisco' ),
                        'soundcloud' => esc_html__( 'Soundcloud', 'scisco' ),
                        'odnoklassniki' => esc_html__( 'Odnoklassniki', 'scisco' ),
                        'xing' => esc_html__( 'Xing', 'scisco' ),
                        'lastfm' => esc_html__( 'Lastfm', 'scisco' ),
                        'medium' => esc_html__( 'Medium', 'scisco' ),
                        'slack' => esc_html__( 'Slack', 'scisco' ),
                        'whatsapp' => esc_html__( 'Whatsapp', 'scisco' )
                    ),
                ),
                array(
                    'name' => esc_html__( 'Link:', 'scisco'),
                    'desc' => esc_html__( 'Example; http://www.facebook.com', 'scisco'),
                    'id' => $prefix . 'iconlink',
                    'type' => 'text_url'
                ),
                array(
                    'name' => esc_html__( 'Tooltip:', 'scisco'),
                    'desc' => esc_html__( 'Example; Follow me on Facebook', 'scisco'),
                    'id' => $prefix . 'icontooltip',
                    'type' => 'text'
                ),
            ),
        ));
    }
}

add_action( 'cmb2_init', 'scisco_user_fields_cmb2' );

/* Display name filter  */

add_filter( 'cmb2_override_scisco_cmb2_display_name_meta_value', 'scisco_cmb2_display_name_override_meta_value', 10, 4 );
function scisco_cmb2_display_name_override_meta_value( $data, $object_id, $args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $user_info = get_userdata($user_ID);
    $display_name = $user_info->display_name;
	return $display_name;
}

add_filter( 'cmb2_override_scisco_cmb2_display_name_meta_save', 'scisco_cmb2_display_name_override_meta_save', 10, 4 );
function scisco_cmb2_display_name_override_meta_save( $override, $args, $field_args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $updated = wp_update_user( array( 'ID' => $user_ID, 'display_name' => $args['value'] ) );
	return !! $updated;
}

/* Email filter  */

add_filter( 'cmb2_override_scisco_cmb2_user_email_meta_value', 'scisco_cmb2_user_email_override_meta_value', 10, 4 );
function scisco_cmb2_user_email_override_meta_value( $data, $object_id, $args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $user_info = get_userdata($user_ID);
    $user_email = $user_info->user_email;
	return $user_email;
}

add_filter( 'cmb2_override_scisco_cmb2_user_email_meta_save', 'scisco_cmb2_user_email_override_meta_save', 10, 4 );
function scisco_cmb2_user_email_override_meta_save( $override, $args, $field_args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $updated = wp_update_user( array( 'ID' => $user_ID, 'user_email' => $args['value'] ) );
	return !! $updated;
}

/* Password filter  */

add_filter( 'cmb2_override_scisco_cmb2_user_pass_meta_value', 'scisco_cmb2_user_pass_override_meta_value', 10, 4 );
function scisco_cmb2_user_pass_override_meta_value( $data, $object_id, $args, $field ) {
	return '';
}

add_filter( 'cmb2_override_scisco_cmb2_user_pass_meta_save', 'scisco_cmb2_user_pass_override_meta_save', 10, 4 );
function scisco_cmb2_user_pass_override_meta_save( $override, $args, $field_args, $field ) {
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $args['value']);
    $lowercase = preg_match('@[a-z]@', $args['value']);
    $number    = preg_match('@[0-9]@', $args['value']);
    $specialChars = preg_match('@[^\w]@', $args['value']);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($args['value']) < 8) {
        echo '<div class="alert alert-danger">' . esc_html__( 'Password must be at least 8 characters in length and must include at least one upper case letter, one number, and one special character.', 'scisco' ) . '</div>';
    } else{
        $current_user = wp_get_current_user();
        $user_ID = $current_user->ID;
        $updated = wp_update_user( array( 'ID' => $user_ID, 'user_pass' => $args['value'] ) );
        return !! $updated;
    }

}

/* Website URL  */

add_filter( 'cmb2_override_scisco_cmb2_user_url_meta_value', 'scisco_cmb2_user_url_override_meta_value', 10, 4 );
function scisco_cmb2_user_url_override_meta_value( $data, $object_id, $args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $user_info = get_userdata($user_ID);
    $user_url = $user_info->user_url;
	return $user_url;
}

add_filter( 'cmb2_override_scisco_cmb2_user_url_meta_save', 'scisco_cmb2_user_url_override_meta_save', 10, 4 );
function scisco_cmb2_user_url_override_meta_save( $override, $args, $field_args, $field ) {
    $current_user = wp_get_current_user();
    $user_ID = $current_user->ID;
    $updated = wp_update_user( array( 'ID' => $user_ID, 'user_url' => $args['value'] ) );
	return !! $updated;
}
?>