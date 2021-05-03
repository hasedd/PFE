<?php
/**
 * Single job listing widget content.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-widget-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<li <?php job_listing_class(); ?>>
	
<div class="scisco-job-widget">


		<?php if ( isset( $show_logo ) && $show_logo ) { ?>
		<div class="scisco-job-widget-image">
		<a href="<?php the_job_permalink(); ?>"><?php the_company_logo(); ?></a>
		</div>
		<?php } ?>


		<div class="scisco-job-widget-content">
			<p><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?> - <?php the_job_location( false ); ?></a></p>
			<ul>
				<li><?php the_company_name(); ?></li>
				<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
					<?php $types = wpjm_get_the_job_types(); ?>
					<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
						<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
					<?php endforeach; endif; ?>
				<?php } ?>
			</ul>
			
		</div>
		</div>
</li>
