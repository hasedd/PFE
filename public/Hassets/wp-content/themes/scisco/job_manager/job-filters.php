<?php
/**
 * Filters in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.33.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wp_enqueue_script( 'wp-job-manager-ajax-filters' );

do_action( 'job_manager_job_filters_before', $atts );
?>

<form class="job_filters">
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>
	<div class="row">
		<div class="col-6 <?php if ( $categories || ($show_categories && ! is_tax( 'job_listing_category' ) && get_terms( [ 'taxonomy' => 'job_listing_category' ] )) ) {echo 'col-sm-4'; } ?>">
			<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'scisco' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
		</div>
		<div class="col-6 <?php if ( $categories || ($show_categories && ! is_tax( 'job_listing_category' ) && get_terms( [ 'taxonomy' => 'job_listing_category' ] )) ) {echo 'col-sm-4'; } ?>">
			<input type="text" class="form-control" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'scisco' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
		</div>
		<?php if ( $categories ) : ?>
			<div class="col-12 col-sm-4 mt-sm-0 mt-3">
			<?php foreach ( $categories as $category ) : ?>
				<input type="hidden" name="search_categories[]" value="<?php echo esc_attr( sanitize_title( $category ) ); ?>" />
			<?php endforeach; ?>
			</div>
			<?php elseif ( $show_categories && ! is_tax( 'job_listing_category' ) && get_terms( [ 'taxonomy' => 'job_listing_category' ] ) ) : ?>
				<div class="col-12 col-sm-4 mt-sm-0 mt-3">
				<div class="search_categories">
					<?php if ( $show_category_multiselect ) : ?>
						<?php job_manager_dropdown_categories( [ 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'hide_empty' => true ] ); ?>
					<?php else : ?>
						<?php job_manager_dropdown_categories( [ 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'Any category', 'scisco' ), 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'multiple' => false, 'hide_empty' => true ] ); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-auto">
		<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
		</div>
		<div class="col-auto scisco-job-filter-btn">
		<button class="btn btn-primary" type="submit"><?php esc_html_e( 'Search Jobs', 'scisco' ); ?></button>
		</div>
	</div>
	<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

</form>

<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'scisco' ); ?></noscript>
