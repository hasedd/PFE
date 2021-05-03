<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo fep_info_output();
if( ! fep_get_user_message_count( 'total' ) ) {
	echo '<div class="alert alert-danger">' . apply_filters( 'fep_filter_messagebox_empty', esc_html__( 'No messages found.', 'scisco' ) ) . '</div>';
	return;
}

do_action('scisco_fep_view_message');
do_action( 'fep_display_before_messagebox' ); ?>
<div class="fep-messagebox-search-form-div">
	<form id="fep-messagebox-search-form" action="">
		<div class="input-group">
			<input type="hidden" name="fepaction" value="messagebox" />
			<input type="search" name="fep-search" class="form-control fep-messagebox-search-form-field" value="<?php echo isset( $_GET['fep-search'] ) ? esc_attr( stripslashes( $_GET['fep-search'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Search Messages...', 'scisco'); ?>" />
			<input type="hidden" name="feppage" value="1" />
			<div class="input-group-append"> 
				<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
<form class="fep-message-table form" method="post" action="">
	<div class="fep-table fep-action-table">
		<div class="row no-gutters">
			<div class="col">
				<div class="fep-filter">
					<select class="fep-filter fep-ajax-load custom-select">
						<?php foreach ( Fep_Messages::init()->get_table_filters() as $filter => $filter_display ) : ?>
							<option value="<?php echo esc_attr( $filter ); ?>" <?php selected( isset( $_GET['fep-filter'] ) ? $_GET['fep-filter'] : '', $filter );?>><?php echo esc_html( $filter_display ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="input-group fep-bulk-actions">
					<select name="fep-bulk-action" class="custom-select">
						<option value=""><?php esc_html_e( 'Bulk action', 'scisco' ); ?></option>
						<?php foreach ( Fep_Messages::init()->get_table_bulk_actions() as $bulk_action => $bulk_action_display ) : ?>
							<option value="<?php echo esc_attr( $bulk_action ); ?>"><?php echo esc_html( $bulk_action_display ); ?></option>
						<?php endforeach; ?>
					</select>
					<div class="input-group-append"> 
						<input type="hidden" name="token"  value="<?php echo fep_create_nonce( 'bulk_action' ); ?>"/>
						<button type="submit" class="btn btn-primary" name="fep_action" value="bulk_action"><?php esc_html_e( 'Apply', 'scisco' ); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="fep-box-content-main">
		<div class="fep-loader"></div>
		<div id="fep-box-content-content">
			<?php require fep_locate_template( 'box-content.php' ); ?>
		</div>
	</div>
</form>

