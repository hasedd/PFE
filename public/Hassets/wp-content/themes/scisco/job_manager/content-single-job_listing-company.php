<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-company.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.14.0
 * @version     1.32.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! get_the_company_name() ) {
	return;
}
?>
<div class="scisco-company-wrapper">
	<div class="scisco-company">
		<div class="scisco-company-logo">
			<?php the_company_logo(); ?>
		</div>
		<div class="scisco-company-name">
			<?php the_company_name( '<h6>', '</h6>' ); ?>
			<?php the_company_tagline( '<p>', '</p>' ); ?>
		</div>
		<div class="scisco-company-links">
			<?php if ( $website = get_the_company_website() ) : ?>
				<a class="website" href="<?php echo esc_url( $website ); ?>" rel="nofollow"><?php esc_html_e( 'Website', 'scisco' ); ?></a>
			<?php endif; ?>
			<?php the_company_twitter(); ?>
		</div>
	</div>	
	<div class="scisco-company-video">
		<?php the_company_video(); ?>
	</div>
</div>

