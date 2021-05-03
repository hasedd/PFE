<?php
/**
 * Categories page.
 *
 * Display categories page
 *
 * @link        http://anspress.io
 * @since       4.0
 * @package     AnsPress
 * @subpackage  Templates
 */

global $question_categories;
?>

<?php if (is_active_sidebar( 'ap-top' )) { ?>
	<div class="scisco-ads-wrapper">
		<?php dynamic_sidebar( 'ap-top' ); ?>
	</div>
<?php } ?>

<div class="row">
	<div class="<?php echo is_active_sidebar( 'ap-category' ) && is_anspress() ? 'col-xl-9' : 'col-xl-12'; ?>">
		<div id="ap-categories" class="clearfix">
		<?php $scisco_cat_layout = get_theme_mod('scisco_anspress_cat_layout', 'scisco-three-columns'); ?>
			<div class="scisco-masonry-grid">
				<div class="<?php echo esc_attr($scisco_cat_layout); ?>" data-columns>
				<?php foreach ( (array) $question_categories as $key => $category ) : ?>
					<div class="card-masonry">
						<div class="ap-category-item">
							<div class="ap-cat-img-c">
							<?php ap_category_icon( $category->term_id ); ?>
								<div class="ap-category-item-badges">
									<span class="ap-term-count">
										<?php
											printf(
												_n( '%d Question', '%d Questions', $category->count, 'scisco' ),
												(int) $category->count
											);
										?>
									</span>
									<?php $sub_cat_count = count( get_term_children( $category->term_id, 'question_category' ) ); ?>

									<?php if ( $sub_cat_count > 0 ) : ?>
										<span class="ap-sub-category">
											<i class="fas fa-folder"></i> <?php echo esc_html($sub_cat_count); ?>
										</span>
									<?php endif; ?>
								</div>
								<a class="ap-categories-feat" style="height:<?php echo ap_opt( 'categories_image_height' ); ?>px" href="<?php echo get_category_link( $category ); ?>">
									<?php echo ap_get_category_image( $category->term_id, ap_opt( 'categories_image_height' ) ); ?>
								</a>
							</div>
							<div class="ap-term-title">
								<a class="term-title" href="<?php echo esc_url( get_category_link( $category ) ); ?>">
									<?php echo esc_html( $category->name ); ?>
								</a>
							</div>
							<?php if ( $category->description != '' ) : ?>
								<div class="ap-taxo-description">
									<?php echo ap_truncate_chars( $category->description, 120 ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php ap_pagination(); ?>
	</div>

	<?php if ( is_active_sidebar( 'ap-category' ) && is_anspress() ) : ?>
		<div class="col-12 col-xl-3 mt-5 mt-xl-0">
			<?php dynamic_sidebar( 'ap-category' ); ?>
		</div>
	<?php endif; ?>
</div>
