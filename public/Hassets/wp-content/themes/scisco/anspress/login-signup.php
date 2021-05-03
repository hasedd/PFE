<?php
/**
 * Display login signup form
 *
 * @package AnsPress
 * @author  Rahul Aryan <support@anspress.io>
 */

?>

<?php if ( ! is_user_logged_in() ) : ?>
	<?php
		// Load WSL buttons if available.
		do_action( 'wordpress_social_login' );

		$scisco_register_url = get_theme_mod('scisco_register_url');
		$scisco_register_text = get_theme_mod('scisco_register_text', esc_html__( 'Register', 'scisco'));

		if (empty($scisco_register_url)) {
		$scisco_register_url = wp_registration_url();
		}
	?>
	<div class="scisco-login-form">
		<?php wp_login_form(array('remember' => false)); ?>
		<ul class="scisco-login-form-links">
			<?php if (get_option( 'users_can_register' )) { ?>    
			<li>
				<a href="<?php echo esc_url($scisco_register_url); ?>"><?php echo esc_html($scisco_register_text); ?></a>
			</li>
			<?php } ?>    
			<li>
				<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e( 'Lost Password', 'scisco' ); ?></a>
			</li>
		</ul>
	</div>
<?php endif; ?>
