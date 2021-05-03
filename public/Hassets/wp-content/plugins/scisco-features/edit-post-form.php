<?php
function scisco_frontend_edit_form_register() {
	$cmb = new_cmb2_box( array(
		'id'           => 'front-end-post-edit-form',
		'object_types' => array( 'post' ),
		'hookup'       => false,
		'save_fields'  => true,
        'cmb_styles' => false
	) );
}
add_action( 'cmb2_init', 'scisco_frontend_edit_form_register' );


function scisco_add_edit_form_to_frontend( $content ) {
	if ( isset( $_GET['edit'] ) ) {
		if ( current_user_can( 'edit_posts' ) && wp_verify_nonce( $_GET['edit'], 'edit' ) ) {
			$content = cmb2_get_metabox_form( 'front-end-post-edit-form', get_the_ID() );
		} else {
			$content = '<div class="alert alert-danger">' . esc_html__( 'You do not have permission to edit this post.', 'scisco' ) . '</div>';
		}
    }

	return $content;
}
add_filter( 'the_content', 'scisco_add_edit_form_to_frontend' );


function scisco_modify_edit_link( $link ) {
	if ( ! is_admin() && is_singular('post') ) {
		$link =  esc_url_raw( wp_nonce_url( remove_query_arg( 'edit' ), 'edit', 'edit' ) );
	}
	return $link;
}
add_filter( 'get_edit_post_link', 'scisco_modify_edit_link' );


function scisco_edit_core_fields() {
    if ( ! is_admin() ) { // only if on front-end
        $title_length = get_theme_mod('scisco_title_length', 60);
        $excerpt_length = get_theme_mod('scisco_excerpt_length', 120);

        $cmb = cmb2_get_metabox( 'front-end-post-edit-form' );
        
        $cmb->add_field( array(
            'name'    => esc_html__( 'Post Title', 'scisco' ),
            'id'      => 'post_title',
            'type'    => 'text',
            'before' => 'scisco_edit_core_maybe_redirect',
            'attributes' => array(
                'class' => 'form-control',
                'maxlength' => $title_length
            ),
        ));

        $cmb->add_field( array(
            'name'    => esc_html__( 'Post Excerpt', 'scisco' ),
            'id'      => 'post_excerpt',
            'type'    => 'textarea_small',
            'attributes' => array(
                'class' => 'form-control',
                'maxlength' => $excerpt_length
            ),
        ) );
    
        $cmb->add_field( array(
            'name'       => esc_html__( 'Post Content', 'scisco' ),
            'id'         => 'post_content',
            'type'       => 'wysiwyg',
            'options'    => array(
                'teeny' => true,
                'quicktags' => true,
                'textarea_rows' => 12,
                'media_buttons' => false
            ),
        ));

        $cmb->add_field( array(
            'name'       => esc_html__( 'Categories', 'scisco' ),
            'id'         => 'categories',
            'type'       => 'taxonomy_multicheck',
            'taxonomy'   => 'category'
        ) );
        
        $cmb->add_field( array(
            'name'       => esc_html__( 'Tags', 'scisco' ),
            'id'         => 'tags',
            'type'       => 'taxonomy_multicheck',
            'taxonomy'   => 'post_tag'
        ) );
	}
}
add_action( 'cmb2_init', 'scisco_edit_core_fields', 99 );

function scisco_edit_core_maybe_redirect() {
	if ( isset( $_POST['post_content'] ) ) {
		$url = esc_url_raw( remove_query_arg( 'edit' ) );
		echo "<script type='text/javascript'>window.location.href = '$url';</script>";
	}
}

function scisco_cmb2_override_core_field_get( $val, $object_id, $a, $field ) {
	global $post;

	if ( in_array( $field->id(), array( 'post_title', 'post_content' ), true ) ) {
		if ( isset( $post->ID ) ) {
			$val = get_post_field( $field->id(), $post );
		} else {
			$val = '';
		}
	}

	return $val;
}
add_filter( 'cmb2_override_meta_value', 'scisco_cmb2_override_core_field_get', 10, 4 );

function scisco_cmb2_override_core_field_set( $status, $a, $args, $field ) {
	global $post;

	if ( in_array( $field->id(), array( 'post_title', 'post_content' ), true ) ) {
		if ( isset( $post->ID ) ) {
			$status = wp_update_post( array(
				$field->id() => $a['value'],
				'ID' => $post->ID,
			) );

		} else {
			$status = false;
		}
	}

	return $status;
}
add_filter( 'cmb2_override_meta_save', 'scisco_cmb2_override_core_field_set', 10, 4 );

function scisco_post_edit_links($postid) {
    $scisco_edit_url = get_edit_post_link($postid);
    $scisco_delete_url = get_delete_post_link($postid);

    if ( $scisco_edit_url ||  $scisco_delete_url) {
        echo '<div class="scisco-edit-post-link">';
        if ($scisco_edit_url) {
            echo '<a class="btn btn-sm btn-primary" href="' . esc_url( $scisco_edit_url ) . '"><i class="fas fa-edit"></i> ' . esc_html__( 'Edit Post', 'scisco') . '</a>';
        }
        if ($scisco_delete_url) {
            $nonce = wp_create_nonce('scisco_delete_post_nonce');
            echo '<a id="scisco-delete-post" class="btn btn-sm btn-danger scisco-delete-post" data-id="' . get_the_ID() . '" data-nonce="' . $nonce . '" href="#"><i class="fas fa-times"></i> ' . esc_html__( 'Delete Post', 'scisco') . '</a>';
            
        }
        echo '</div>';
    }
}

add_action( 'scisco_post_edit_links', 'scisco_post_edit_links' );


function scisco_delete_post(){

	$permission = check_ajax_referer( 'scisco_delete_post_nonce', 'nonce', false );
	if( $permission == false ) {
		echo 'error';
	}
	else {
		wp_delete_post( $_REQUEST['id'] );
		echo 'success';
	}

	die();
}
add_action( 'wp_ajax_scisco_delete_post', 'scisco_delete_post' );
