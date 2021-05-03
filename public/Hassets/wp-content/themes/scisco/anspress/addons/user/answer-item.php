<?php
/**
 * BuddyPress answer item.
 *
 * Template used to render answer item in loop
 *
 * @link     https://anspress.io
 * @since    4.0.0
 * @license  GPL 3+
 * @package  WordPress/AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="scisco-question-wrapper answers">
		<div class="scisco-question-avatar">
			<?php $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about'); ?>
			<a href="<?php echo esc_url(ap_get_profile_link() . $scisco_page_slug); ?>/">
				<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>
		<div class="scisco-question-title">
			<h6 itemprop="name">
				<?php ap_answer_status(); ?>
				<a class="ap-bpsingle-hyperlink" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h6>
			<div class="scisco-question-meta">
				<a href="<?php the_permalink(); ?>" class="ap-bpsingle-published">
					<i class="fas fa-clock"></i> 
					<time itemprop="datePublished" datetime="<?php echo ap_get_time( get_the_ID(), 'c' ); ?>">
						<?php echo esc_html(ap_human_time( ap_get_time( get_the_ID(), 'U' ) )); ?>
					</time>
				</a>
			</div>
			<div class="scisco-question-content"><?php echo ap_truncate_chars( get_the_content(), 200 ); ?></div>
		</div>
		<div class="scisco-question-counts">
			<a class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>" class="ap-view-question"><?php esc_html_e( 'View Question', 'scisco' ); ?></a>
		</div>
	</div>
</div>

