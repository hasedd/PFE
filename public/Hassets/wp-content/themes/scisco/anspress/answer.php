<?php
/**
 * Template used for generating single answer item.
 *
 * @author Rahul Aryan <support@anspress.io>
 * @link https://anspress.io/anspress
 * @package AnsPress
 * @subpackage Templates
 * @since 0.1
 * @since 4.1.2 Removed @see ap_recent_post_activity().
 */

if ( ap_user_can_read_answer() ) :
?>

<div id="post-<?php the_ID(); ?>" class="answer<?php echo ap_is_selected() ? ' best-answer' : ''; ?>" apid="<?php the_ID(); ?>" ap="answer">
	<div class="ap-content" itemprop="suggestedAnswer<?php echo ap_is_selected() ? ' acceptedAnswer' : ''; ?>" itemscope itemtype="https://schema.org/Answer">
		<div class="scisco-sq">
			<div class="scisco-sq-avatar">
				<?php $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about'); ?>
				<a href="<?php echo esc_url(ap_get_profile_link() . $scisco_page_slug); ?>/">
					<?php ap_author_avatar( ap_opt( 'avatar_size_qanswer' ) ); ?>
				</a>
			</div>
			<div class="scisco-sq-content-wrapper">
				<div class="scisco-sq-metas">
					<div class="scisco-sq-metas-left">
						<span class="ap-author" itemprop="author" itemscope itemtype="http://schema.org/Person">
							<?php echo ap_user_display_name( [ 'html' => true ] ); ?>
						</span>
						<a href="<?php the_permalink(); ?>" class="ap-posted">
							<time itemprop="datePublished" datetime="<?php echo ap_get_time( get_the_ID(), 'c' ); ?>">
								<?php
								printf(
									esc_html__( 'Posted %s', 'scisco' ),
									ap_human_time( ap_get_time( get_the_ID(), 'U' ) )
								);
								?>
							</time>
						</a>
						<div class="scisco-sq-metas-comment-count">
							<?php $comment_count = get_comments_number(); ?>
							<?php printf( _n( '%s Comment', '%s Comments', $comment_count, 'scisco' ), '<i class="fas fa-comment"></i><span itemprop="commentCount">' . (int) $comment_count . '</span>' ); ?>
						</div>
					</div>
					<div class="scisco-sq-metas-right">
					<?php echo ap_select_answer_btn_html(); ?>
					<?php ap_post_actions_buttons(); ?>
					<?php do_action( 'ap_answer_footer' ); ?></div>
				</div>
				<div class="scisco-sq-content" itemprop="text" ap-content>
					<?php do_action( 'ap_before_answer_content' ); ?>
					<?php the_content(); ?>
					<?php do_action( 'ap_after_answer_content' ); ?>
				</div>
				<div class="scisco-sq-comments">
					<?php ap_post_comments(); ?>
				</div>
			</div>
			<div class="scisco-sq-vote"><?php ap_vote_btn(); ?></div>
		</div>
	</div>
</div>

<?php
endif;
