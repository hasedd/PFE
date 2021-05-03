<?php
/**
 * Ask question page
 *
 * @link https://anspress.io
 * @since 0.1
 *
 * @package AnsPress
 */

?>
<div id="ap-ask-page" class="clearfix">
	<?php 
	if ( ap_user_can_ask() ) {
		ap_ask_form();
	} elseif ( is_user_logged_in() ) { ?>
	<div class="alert alert-danger">
		<?php esc_html_e( 'You do not have permission to ask a question.', 'scisco' ); ?>
	</div>
	<?php } ?>
	<?php ap_get_template_part( 'login-signup' ); ?>
</div>
