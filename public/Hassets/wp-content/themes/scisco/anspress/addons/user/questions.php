<?php
/**
 * User question template
 * Display user profile questions.
 *
 * @link https://anspress.io
 * @since 4.0.0
 * @package AnsPress
 *
 * @since 4.1.13 Fixed pagination issue when in main user page.
 */

global $wp;

?>

<?php if ( ap_have_questions() ) { ?>
	<div class="ap-questions">
		<?php
		while ( ap_have_questions() ) :
			ap_the_question();
			ap_get_template_part( 'question-list-item' );
		endwhile;
		?>
	</div>
	<?php
	if ( get_query_var( 'ap_paged' ) ) { $paged = get_query_var( 'ap_paged' ); } elseif ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); } else { $paged = 1; }
	$questions_query = anspress()->questions;
	if ( $questions_query->max_num_pages > 1 )  {
		$pages = paginate_links( [
			'base' => @add_query_arg('paged','%#%'),
			'format' => '',
			'current'      => max( 1, $paged ),
			'total'        => $questions_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => '<i class="fas fa-chevron-left"></i>',
			'next_text'    => '<i class="fas fa-chevron-right"></i>',
			'add_args'     => false,
			'add_fragment' => ''
		]);
		if ( is_array( $pages ) ) {
			$pagination = '<div class="scisco-pager mt-4"><ul class="pagination pagination-lg flex-wrap justify-content-center">';
			foreach ($pages as $page) {
				$pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
			}
			$pagination .= '</ul></div>';
			echo wp_kses_post($pagination);
		}
	}
	
} else {
	ap_get_template_part( 'content-none' );
}
?>
