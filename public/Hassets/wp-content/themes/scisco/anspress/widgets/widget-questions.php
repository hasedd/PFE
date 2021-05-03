<?php
/**
 * AnsPress questions widget template.
 *
 * @link https://anspress.io/anspress
 * @since 2.0.1
 * @author Rahul Aryan <support@anspress.io>
 * @package AnsPress
 */

?>
<div class="widget_recent_entries clearfix">
	<?php if ( ap_have_questions() ) : ?>
		<ul>
		<?php
		while ( ap_have_questions() ) :
			ap_the_question();
		?>
			<li>
				<a class="ap-question-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span class="post-date"><?php printf( _n( '1 Answer', '%d Answers', ap_get_answers_count(), 'scisco' ), ap_get_answers_count() ); ?> - <?php printf( _n( '1 Vote', '%d Votes', ap_get_votes_net(), 'scisco' ), ap_get_votes_net() ); ?></span>
		</li>
		<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<?php esc_html_e( 'No questions found.', 'scisco' ); ?>
	<?php endif; ?>
</div>


