<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="scisco-add-border" id="customer_login">
    <div class="scisco-woo-login-wrapper">
		<h2><?php esc_html_e( 'Login', 'scisco' ); ?></h2>

		<form method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p>
				<label for="username"><?php esc_html_e( 'Username or email address', 'scisco' ); ?> <span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p>
				<label for="password"><?php esc_html_e( 'Password', 'scisco' ); ?> <span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'scisco' ); ?>" />
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline float-right">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'scisco' ); ?></span>
				</label>
			</p>
			<p>
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="btn btn-danger"><?php esc_html_e( 'Lost your password?', 'scisco' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
    </div>
    
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
    <div class="scisco-woo-register-wrapper">
		<h2><?php esc_html_e( 'Register', 'scisco' ); ?></h2>

		<form method="post">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p>
					<label for="reg_username"><?php esc_html_e( 'Username', 'scisco' ); ?> <span class="required">*</span></label>         
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p>
				<label for="reg_email"><?php esc_html_e( 'Email address', 'scisco' ); ?> <span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p>
					<label for="reg_password"><?php esc_html_e( 'Password', 'scisco' ); ?> <span class="required">*</span></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p>
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'scisco' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
    </div>
<?php endif; ?>
</div>    

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
