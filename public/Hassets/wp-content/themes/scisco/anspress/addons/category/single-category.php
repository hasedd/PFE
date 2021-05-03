<?php
/**
 * Display single question category page.
 *
 * Display category page.
 *
 * @link        http://anspress.io
 * @since       4.0
 * @package     AnsPress
 * @subpackage  Templates
 * @since       4.1.1 Renamed file from category.php to single-category.php.
 */

$icon = ap_get_category_icon( $question_category->term_id );
?>

<?php if (is_active_sidebar( 'ap-top' )) { ?>
	<div class="scisco-ads-wrapper">
		<?php dynamic_sidebar( 'ap-top' ); ?>
	</div>
<?php } ?>

<div class="row">
	<div id="ap-category" class="col-12 <?php echo is_active_sidebar( 'ap-category' ) && is_anspress() ? 'col-xl-9' : 'col-xl-12'; ?>">
		<div class="scisco-sub-category-tabs">
			<?php ap_sub_category_list( $question_category->term_id ); ?>
		</div>
		<?php ap_get_template_part( 'question-list' ); ?>
	</div>
	<?php if ( is_active_sidebar( 'ap-category' ) && is_anspress() ) { ?>
		<div class="ap-question-right col-12 col-xl-3 mt-5 mt-xl-0">
			<?php dynamic_sidebar( 'ap-category' ); ?>
		</div>
	<?php } ?>
</div>
