<?php
/**
 * User profile template.
 * User profile index template.
 *
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GNU Public License
 * @author     Rahul Aryan <support@anspress.io>
 *
 * @link       https://anspress.io
 * @since      4.0.0
 * @package    AnsPress
 * @subpackage Templates
 */

$user_id     = ap_current_user_id();
$current_tab = ap_sanitize_unslash( 'tab', 'r', 'questions' );
?>
<div class="row">
	<div id="ap-user-nav" class="col-12 col-lg-3">
		<div id="scisco-user-menu-wrapper">
			<a id="scisco-user-menu-toggler" href="#" class="btn btn-primary float-right">
				<?php esc_html_e( 'Menu', 'scisco'); ?><i class="fas fa-chevron-down"></i>
			</a>
			<div class="clearfix"></div>
			<?php self::user_menu(); ?>
		</div>
		<?php dynamic_sidebar( 'ap-author' ); ?>
	</div>
	<div class="col-12 col-lg-9">

		<?php if ( '0' == $user_id && ! is_user_logged_in() ) : ?>

			<div class="alert alert-warning"><?php esc_html_e( 'Please login to view your profile', 'scisco' ); ?></div>

		<?php else : ?>

			<?php self::sub_page_template(); ?>

		<?php endif; ?>

	</div>
</div>
