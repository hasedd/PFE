<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
do_action('scisco_fep_view_message');
do_action('scisco_fep_block_unblock');
?>
<div id="fep-content-single">
	<div id="fep-content-single-main">
		<div class="fep-loader"></div>
		<div id="fep-content-single-content">
			<?php require fep_locate_template( 'view-message-content.php' ); ?>
		</div>
		<div id="fep-content-single-reply-form-error">
			<?php
			if ( ! fep_current_user_can( 'send_reply', $parent_id ) ) {
				echo '<div class="fep-error">' . esc_html__( 'You do not have permission to send reply to this message!', 'scisco' ) . '</div>';
			} elseif ( fep_success()->get_error_messages() ) {
				echo fep_info_output();
			}
			?>
		</div>
		<div id="fep-content-single-reply-form"<?php if ( ! fep_current_user_can( 'send_reply', $parent_id ) ) echo ' style="display:none;"';?>>
			<?php
			if ( isset( $_POST['fep_action'] ) && 'reply' == $_POST['fep_action'] && ! fep_errors()->get_error_messages() ) {
				unset( $_REQUEST['message_content'] ); //hack to empty message content
			}
			echo Fep_Form::init()->form_field_output( 'reply', '', array( 'fep_parent_id' => $parent_id ) );
			?>
		</div>
	</div>
</div>

<?php
