<?php
/**
 * Display question list header
 * Shows sorting, search, tags, category filter form. Also shows a ask button.
 *
 * @package AnsPress
 * @author  Rahul Aryan <support@anspress.io>
 */

?>

<div class="ap-list-head">
	<div class="row">
		<div class="col-6 col-md-9">
		<?php ap_get_template_part( 'search-form' ); ?>
		</div>
		<div class="col-6 col-md-3"><?php scisco_ask_btn(); ?></div>
	</div>
	<div class="scisco-ap-filters">
		<?php ap_list_filters(); ?>
	</div>
</div>

<?php
/**
 * Display an alert showing count for unpublished questions.
 *
 * @since 4.1.13
 */

$questions_count = (int) get_user_meta( get_current_user_id(), '__ap_unpublished_questions', true );

if ( $questions_count > 0 ) {
	$text = sprintf( _n( '%d question is', '%d questions are', $questions_count, 'scisco' ), $questions_count );

	echo '<div class="alert alert-warning"><i class="apicon-pin"></i>';
	printf(
		// Translators: Placeholder contain link to unpublished questions.
		esc_html__( 'Your %s unpublished. ', 'scisco' ),
		'<a href="' . esc_url( ap_get_link_to( '/' ) ) . '?unpublished=true">' . esc_attr( $text ) . '</a>'
	);
	echo '</div>';
}
?>
