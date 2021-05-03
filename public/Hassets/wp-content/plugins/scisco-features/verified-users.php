<?php
/* Add column to Users Table called "verified" */
function scisco_add_users_column( $column ) {
    $column['user_id'] =  esc_html__( 'User ID', 'scisco');
    $column['scisco_verified_user'] = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/verified.png" title="' . esc_attr__( 'Verified', 'scisco') . '" />';
    return apply_filters('scisco_verified_col_name',$column);
}
add_filter( 'manage_users_columns', 'scisco_add_users_column', 99 );

/* Add the row value for verified column */
function scisco_add_verified_user_row( $val, $column_name, $user_id ) {    
    $user = get_userdata( $user_id );
	if ( 'user_id' == $column_name ) {
		return $user_id;
    }
    switch ( $column_name ) {
        case 'scisco_verified_user' :
            $is_verified_user = sanitize_text_field(get_user_meta( $user_id , 'scisco_verified_user' ,true ));

            if( $is_verified_user ) {
            	return '<img src="'. apply_filters('scisco_verified_user_img',
            		plugins_url( 'images/active_user.png', __FILE__ )) .'" class="scisco_verified_user" verified="yes" user-id="'. $user_id .'" >';
            }
            else {
            	return '<img src="'. apply_filters('scisco_not_verified_user_img',
            		plugins_url( 'images/inactive_user.png', __FILE__ )).'" class="scisco_verified_user" verified="no" user-id="'. $user_id .'" >';
            }            
            break;
        default:
    }
    
    return; 
}
add_action('manage_users_custom_column',  'scisco_add_verified_user_row', 10, 3);

/* user status description */
function scisco_toggle_verified_user_status() {
    if ( !current_user_can( 'edit_user', $user_id ) ) return false;

    check_ajax_referer( 'scisco_js_script_ajax_nonce', 'scisco_js_script_ajax_nonce' );

	$is_verified_user = sanitize_text_field($_POST["verified"]);
	$user_id = intval($_POST["user_id"]);

	if( $is_verified_user == 'yes' )
    {
		update_user_meta( $user_id, 'scisco_verified_user' , 'yes' );
	} 
	else {
		delete_user_meta( $user_id, 'scisco_verified_user' );
	}

	echo esc_attr__( 'User verified Status Is Changed', 'scisco');
   
}
add_action( 'wp_ajax_scisco_toggle_verified_user_status', 'scisco_toggle_verified_user_status' );

/* Add checkbox option user edit page */
function scisco_add_verified_checkBox_userEditPage( $user ){    
    $user_id = $user->ID;               
    $is_verified_user  = sanitize_text_field(get_user_meta( $user_id, "scisco_verified_user", true ));               
    ?> 
    <table class="form-table">
	    <tr class="user-admin-bar-front-wrap">
			<th scope="row"><?php esc_html_e( 'Verified User', 'scisco'); ?></th>
			<td><fieldset><legend class="screen-reader-text"><span><?php esc_attr_e( 'Verified User', 'scisco'); ?></span></legend>
				<label for="scisco_verified_user">
				<input name="scisco_verified_user" type="checkbox" id="scisco_verified_user" value="yes" <?php if ( $is_verified_user == 'yes' ){ ?> checked="checked"<?php } ?> >
				<?php esc_attr_e( 'Verify this user', 'scisco'); ?></label><br>
				</fieldset>
			</td>
		</tr>		
	</table>   
    <?php    
} 
add_action( 'edit_user_profile', 'scisco_add_verified_checkBox_userEditPage',999 );

/* Save the verified option in the user edit page */
function scisco_save_verified_checkBox_userEditPage( $user_id ){ 	        
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;

	// update this users meta
	if ( isset( $_POST['scisco_verified_user'] ) && sanitize_text_field($_POST['scisco_verified_user']) == "yes" )
    {                     
    	update_user_meta( $user_id, 'scisco_verified_user' , 'yes' );
    }
	else {
	    delete_user_meta( $user_id, 'scisco_verified_user' );
	}                           
} 
add_action( 'edit_user_profile_update', 'scisco_save_verified_checkBox_userEditPage');

/* ---------------------------------------------------------
Check verified user
----------------------------------------------------------- */

function scisco_verified_check($scisco_user_id) {
    global $wpdb;   
    $query = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}usermeta 
					WHERE meta_key = 'scisco_verified_user'
					AND meta_value = 'yes' AND user_id = '%s'", $scisco_user_id ) );	
    if ($query) {
        $return = 'verified';
    }
    else {
        $return = 'no-verified'; 
    }
    return $return;
}

/* ---------------------------------------------------------
Add verified badge
----------------------------------------------------------- */

function scisco_verified_avatar_filter($avatar, $id_or_email, $size, $default, $alt) {
	$email = is_object( $id_or_email ) ? $id_or_email->comment_author_email : $id_or_email;
	if( is_email( $email ) && ! email_exists( $email ) ) {
		return $avatar;
    }
	$verified_user = scisco_verified_check($id_or_email);
	if ($verified_user == 'verified') {
		$avatar = '<div class="scisco-verified"><i class="fas fa-check" title="' . esc_html__( 'Verified user', 'scisco' ) . '"></i>' . $avatar . '</div>';
	}
	return $avatar;
}
if (!is_admin()) {
	add_filter('get_avatar', 'scisco_verified_avatar_filter', 11, 5);
}
add_action( 'admin_bar_menu', function(){
	remove_filter('get_avatar','scisco_verified_avatar_filter');
},99); 
?>