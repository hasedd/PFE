<?php
	/**
	 * Tags page layout
	 *
	 * @link http://anspress.io
	 * @since 1.0
	 *
	 * @package AnsPress
	 */

	global $question_tags;
?>
<?php if (is_active_sidebar( 'ap-top' )) { ?>
	<div class="scisco-ads-wrapper">
		<?php dynamic_sidebar( 'ap-top' ); ?>
	</div>
<?php } ?>

<div id="ap-tags" class="row">
	<div class="col-12 <?php echo is_active_sidebar( 'ap-tags' ) && is_anspress() ? 'col-xl-9' : 'col-xl-12'; ?>">
		<div class="ap-list-head">
			<form id="ap-search-form" class="ap-search-form">
				<div class="input-group">
				<input type="text" class="form-control" placeholder="<?php esc_attr_e('Search tags...', 'scisco'); ?>" name="ap_s" value="<?php echo sanitize_text_field( get_query_var( 'ap_s' ) ); ?>" />
					<div class="input-group-append"> 
						<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</form>
			<?php ap_list_filters(); ?>
		</div>
		<ul class="scisco-term-tag-box">
			<?php foreach ( $question_tags as $key => $tag ) : ?>
				<li>
					<a class="badge badge-primary" href="<?php echo get_tag_link( $tag ); ?>">
						<?php echo esc_html( $tag->name ); ?>
						<span class="scisco-tag-count">
							<?php echo esc_html($tag->count); ?>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php ap_pagination(); ?>
	</div>
	<?php if ( is_active_sidebar( 'ap-tags' ) && is_anspress() ) { ?>
		<div class="col-12 col-xl-3 mt-5 mt-xl-0">
			<?php dynamic_sidebar( 'ap-tags' ); ?>
		</div>
	<?php } ?>
</div>

