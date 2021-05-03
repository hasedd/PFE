<?php
/**
 * Template for user notification loop.
 *
 * Render notifications in user's page.
 *
 * @author  Rahul Aryan <support@anspress.io>
 * @link    https://anspress.io/
 * @since   1.0.0
 * @package AnsPress-pro
 */

$user_id = get_query_var( 'ap_user_id' );
?>

<?php if ( ap_count_unseen_notifications() > 0 ) : ?>
<div class="scisco-noti-sub">
	<?php
		$btn_args = wp_json_encode(
			array(
				'ap_ajax_action' => 'mark_notifications_seen',
				'__nonce'        => wp_create_nonce( 'mark_notifications_seen' ),
			)
		);
	?>
	<a href="#" class="btn btn-primary btn-sm ap-btn-markall-read" apajaxbtn apquery="<?php echo esc_js( $btn_args ); ?>">
		<?php esc_html_e( 'Mark all as seen', 'scisco' ); ?>
	</a>
</div>
<?php endif; ?>

<?php if ( $notifications->have() ) { ?>
<div class="ap-noti">
	<?php
	while ( $notifications->have() ) {
		$notifications->the_notification();
		$notifications->item_template();
	}
	?>
</div>
<?php } else { ?>
<div class="alert alert-info"><?php esc_html_e( 'No notification.', 'scisco' ); ?></div>
<?php } ?>

<?php if ( $notifications->total_pages > 1 ) : ?>
	<a href="#" ap-loadmore="
	<?php
	echo esc_js(
		wp_json_encode(
			array(
				'ap_ajax_action' => 'load_more_notifications',
				'__nonce'        => wp_create_nonce( 'load_more_notifications' ),
				'current'        => 1,
				'user_id'        => $notifications->args['user_id'],
			)
		)
	);
?>
" class="ap-loadmore btn btn-primary btn-block" ><?php esc_html_e( 'Load More', 'scisco' ); ?></a>
<?php endif; ?>
