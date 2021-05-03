<?php
/**
 * Tag page
 * Display list of question of a tag
 *
 * @package AnsPress
 * @subpackage Templates
 */
?>

<?php if (is_active_sidebar( 'ap-top' )) { ?>
	<div class="scisco-ads-wrapper">
		<?php dynamic_sidebar( 'ap-top' ); ?>
	</div>
<?php } ?>

<div class="row">
	<div id="ap-lists" class="col-12 <?php echo is_active_sidebar( 'ap-tag' ) ? 'col-xl-9' : 'col-xl-12'; ?>">
		<?php ap_get_template_part( 'question-list' ); ?>
	</div>
	<?php if ( is_active_sidebar( 'ap-tag' ) && is_anspress() ) : ?>
		<div class="ap-question-right col-12 col-xl-3 mt-5 mt-xl-0">
			<?php dynamic_sidebar( 'ap-tag' ); ?>
		</div>
	<?php endif; ?>
</div>
