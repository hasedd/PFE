<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<div <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_lat ); ?>">
	<a href="<?php the_job_permalink(); ?>">
		<div class="scisco-job-listing-logo">
			<?php the_company_logo(); ?>
		</div>	
		<div class="scisco-job-listing-position">
			<h6><?php wpjm_the_job_title(); ?> - <span><?php the_job_location( false ); ?></span></h6>
			<p class="company">
				<?php the_company_name( '<strong>', '</strong> ' ); ?>
				<?php the_company_tagline( '<span class="tagline">', '</span>' ); ?>
			</p>
		</div>
		<div class="scisco-job-listing-meta">
			<ul>
				<?php do_action( 'job_listing_meta_start' ); ?>

				<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
					<?php $types = wpjm_get_the_job_types(); ?>
					<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
						<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
					<?php endforeach; endif; ?>
				<?php } ?>

				<?php do_action( 'job_listing_meta_end' ); ?>
			</ul>
			<div class="date"><?php the_job_publish_date(); ?></div>
		</div>
	</a>
</div>
