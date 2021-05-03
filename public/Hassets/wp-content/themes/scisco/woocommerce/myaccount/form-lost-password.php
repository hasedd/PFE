<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="scisco-add-border">
<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<div class="alert alert-info"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'scisco' ) ); ?></div>

	<label for="user_login"><?php esc_html_e( 'Username or email', 'scisco' ); ?></label>

	<div class="input-group">
    	<input class="form-control woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
		<?php do_action( 'woocommerce_lostpassword_form' ); ?>
        <div class="input-group-append"> 
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="btn btn-primary" value="<?php esc_attr_e( 'Reset password', 'scisco' ); ?>" />
        </div>
    </div>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
</div>