<?php
/**
 * Display question archive
 *
 * Template for rendering base of AnsPress.
 *
 * @link https://anspress.io
 * @since 4.1.0
 *
 * @package AnsPress
 * @package Templates
 */
?>
<?php if (is_active_sidebar( 'ap-top' )) { ?>
	<div class="scisco-ads-wrapper">
		<?php dynamic_sidebar( 'ap-top' ); ?>
	</div>
<?php } ?>

<div class="row">
	<div id="ap-lists" class="col-12 <?php echo is_active_sidebar( 'ap-sidebar' ) && is_anspress() ? 'col-xl-9' : 'col-xl-12'; ?>">
		<?php ap_get_template_part( 'question-list' ); ?>
	</div>

	<?php if ( is_active_sidebar( 'ap-sidebar' ) && is_anspress() ) { ?>
		<aside class="col-12 col-xl-3 mt-5 mt-xl-0">
			<?php dynamic_sidebar( 'ap-sidebar' ); ?>
		</aside>
	<?php } ?>

</div>
