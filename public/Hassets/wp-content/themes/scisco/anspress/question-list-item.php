<?php
/**
 * Template for question list item.
 *
 * @link    https://anspress.io
 * @since   0.1
 * @license GPL 2+
 * @package AnsPress
 */

if ( ! ap_user_can_view_post( get_the_ID() ) ) {
	return;
}

?>
<div id="question-<?php the_ID(); ?>" itemtype="https://schema.org/Question" itemscope="">
	<div class="scisco-question-wrapper">
		<div class="scisco-question-avatar">
			<?php $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about'); ?>
			<a href="<?php echo esc_url(ap_get_profile_link() . $scisco_page_slug); ?>/">
				<?php ap_author_avatar( ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>
		<div class="scisco-question-title">
			<h6 itemprop="name">
				<?php ap_question_status(); ?>
				<a class="ap-questions-hyperlink" itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h6>
			<div class="scisco-question-meta">
				<?php echo ap_question_metas(); ?>
			</div>
		</div>
		<div class="scisco-question-counts">
			<?php if ( ! ap_opt( 'disable_voting_on_question' ) ) : ?>
				<span class="ap-questions-count ap-questions-vcount">
					<span itemprop="upvoteCount"><?php ap_votes_net(); ?></span>
					<?php esc_html_e( 'Votes', 'scisco' ); ?>
				</span>
			<?php endif; ?>
			<a class="ap-questions-count ap-questions-acount <?php if (ap_get_answers_count() == 0) { echo 'noanswer'; } ?>" href="<?php echo ap_answers_link(); ?>">
				<span itemprop="answerCount"><?php ap_answers_count(); ?></span>
				<?php esc_html_e( 'Ans', 'scisco' ); ?>
			</a>
		</div>
	</div>
</div>
