<?php
/**
 * This file is responsible for displaying question page
 * This file can be overridden by creating a anspress directory in active theme folder.
 *
 * @package    AnsPress
 * @subpackage Templates
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GNU Public License
 * @author     Rahul Aryan <support@anspress.io>
 *
 * @since      0.0.1
 * @since      4.1.0 Renamed file from question.php.
 * @since      4.1.2 Removed @see ap_recent_post_activity().
 * @since      4.1.5 Fixed date grammar when post is not published.
 */

?>
<div id="ap-single" class="ap-q clearfix" itemscope itemtype="https://schema.org/QAPage">

	<div class="ap-question-lr row" itemprop="mainEntity" itemtype="https://schema.org/Question" itemscope="">
		<div class="ap-q-left col-12 <?php echo ( is_active_sidebar( 'ap-qsidebar' ) ) ? 'col-xl-9' : 'col-xl-12'; ?>">
			<?php do_action( 'ap_before_question_meta' ); ?>
			<div class="scisco-question-meta">
				<?php ap_question_metas(); ?>
			</div>
			<?php do_action( 'ap_after_question_meta' ); ?>
			<div ap="question" apid="<?php the_ID(); ?>">
				<div id="question" role="main" class="ap-content">
					<div class="scisco-sq">
						<div class="scisco-sq-avatar">
							<?php do_action( 'ap_before_question_title' ); ?>
							<?php $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about'); ?>
							<a href="<?php echo esc_url(ap_get_profile_link() . $scisco_page_slug); ?>/">
								<?php ap_author_avatar( ap_opt( 'avatar_size_qquestion' ) ); ?>
							</a>
						</div>
						<div class="scisco-sq-content-wrapper">
							<div class="scisco-sq-metas">
								<div class="scisco-sq-metas-left">
									<span class="ap-author" itemprop="author" itemscope itemtype="http://schema.org/Person">
										<?php echo ap_user_display_name( [ 'html' => true ] ); ?>
									</span>
									<a href="<?php the_permalink(); ?>" class="ap-posted">
										<?php
										$posted = 'future' === get_post_status() ? esc_html__( 'Scheduled for', 'scisco' ) : esc_html__( 'Published', 'scisco' );

										$time = ap_get_time( get_the_ID(), 'U' );

										if ( 'future' !== get_post_status() ) {
											$time = ap_human_time( $time );
										}

										printf( '<i class="fas fa-clock"></i><time itemprop="datePublished" datetime="%1$s">%2$s</time>', ap_get_time( get_the_ID(), 'c' ), $time );
										?>
									</a>
									<div class="scisco-sq-metas-comment-count">
										<?php $comment_count = get_comments_number(); ?>
										<?php printf( _n( '%s Comment', '%s Comments', $comment_count, 'scisco' ), '<i class="fas fa-comment"></i><span itemprop="commentCount">' . (int) $comment_count . '</span>' ); ?>
									</div>
								</div>
								<div class="scisco-sq-metas-right">
									<?php ap_post_actions_buttons(); ?>
									<?php do_action( 'ap_post_footer' ); ?>
								</div>
							</div>
							<div class="scisco-sq-content" itemprop="text">
								<?php do_action( 'ap_before_question_content' ); ?>
								<h1 class="d-none" itemprop="name"><?php the_title(); ?></h1>
								<?php the_content(); ?>
								<?php do_action( 'ap_after_question_content' ); ?>
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
				/**
				 * Action triggered before answers.
				 *
				 * @since   4.1.8
				 */
				do_action( 'ap_before_answers' );
			?>

			<?php
				// Get answers.
				ap_answers();

				// Get answer form.
				ap_get_template_part( 'answer-form' );
			?>
		</div>
		<?php if ( is_active_sidebar( 'ap-qsidebar' ) ) { ?>
		<aside class="col-12 col-xl-3 mt-5 mt-xl-0">
			<div class="ap-question-info">
				<?php dynamic_sidebar( 'ap-qsidebar' ); ?>
			</div>
		</aside>
		<?php } ?>

	</div>
</div>
