<?php
/**
 * Template for user reputations item.
 *
 * Render reputation item in authors page.
 *
 * @author  Rahul Aryan <support@anspress.io>
 * @link    https://anspress.io/
 * @since   4.0.0
 * @package AnsPress
 */

?>
<div class="scisco-reputations">
	<?php
	while ( $reputations->have() ) :
		$reputations->the_reputation();
	?>
	<?php ap_get_template_part( 'addons/reputation/item', [ 'reputations' => $reputations ] ); ?>
	<?php endwhile; ?>
	<table class="ap-reputations"><tbody></tbody></table>
</div>	


<?php if ( $reputations->total_pages > 1 ) : ?>
	<a href="#" ap-loadmore="
	<?php
	echo esc_js(
		wp_json_encode(
			array(
				'ap_ajax_action' => 'load_more_reputation',
				'__nonce'        => wp_create_nonce( 'load_more_reputation' ),
				'current'        => 1,
				'user_id'        => $reputations->args['user_id'],
			)
		)
	);
	?>" class="ap-loadmore btn btn-primary btn-block"><?php esc_html_e( 'Load More', 'scisco' ); ?></a>
<?php endif; ?>