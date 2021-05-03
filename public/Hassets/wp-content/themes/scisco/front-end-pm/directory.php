<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo fep_info_output();
do_action( 'fep_display_before_directory' );
?>

<div class="fep-directory-search-form-div">
	<form id="fep-directory-search-form" action="">
		<div class="input-group">
			<input type="hidden" name="fepaction" value="directory" />
			<input type="search" name="fep-search" class="form-control fep-directory-search-form-field" value="<?php echo isset( $_GET['fep-search'] ) ? esc_attr( stripslashes( $_GET['fep-search'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Search Users', 'scisco' ); ?>" />
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
					<select class="custom-select" onchange="if ( this.value ) window.location.href=this.value">
					<?php foreach( Fep_Directory::init()->get_table_filters() as $filter => $filter_display ) : ?>
						<option value="<?php echo esc_url( add_query_arg( array( 'fep-filter' => $filter, 'feppage' => false ) ) ); ?>" <?php selected( $g_filter, $filter );?>><?php echo esc_html( $filter_display ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="input-group fep-bulk-actions">
					<select name="fep-bulk-action" class="custom-select">
						<option value=""><?php esc_html_e( 'Bulk action', 'scisco' ); ?></option>
						<?php foreach( Fep_Directory::init()->get_table_bulk_actions() as $bulk_action => $bulk_action_display ) : ?>
							<option value="<?php echo esc_attr( $bulk_action ); ?>"><?php echo esc_html( $bulk_action_display ); ?></option>
						<?php endforeach; ?>
					</select>
					<div class="input-group-append">
						<input type="hidden" name="token" value="<?php echo fep_create_nonce( 'directory_bulk_action' ); ?>"/>
						<button type="submit" class="btn btn-primary" name="fep_action" value="directory_bulk_action"><?php esc_html_e( 'Apply', 'scisco' ); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ( $user_query->get_results() ) {
		do_action('scisco_fep_check_uncheck');
		?>
		<div class="fep-cb-check-uncheck-all-div">
			<label>
				<input type="checkbox" class="fep-cb-check-uncheck-all" />
				<?php esc_html_e( 'Check/Uncheck all', 'scisco' ); ?>
			</label>
		</div>
		<div class="table-responsive">
			<table id="fep-table" class="table user-directory">
				<tbody>
					<?php foreach( $user_query->get_results() as $user ) : ?>
						<tr id="fep-directory-<?php echo esc_attr($user->ID); ?>" class="fep-table-row"><?php
							foreach ( Fep_Directory::init()->get_table_columns() as $column => $display ) : ?>
								<td class="fep-column fep-column-<?php echo esc_attr( $column ); ?>"><?php Fep_Directory::init()->get_column_content( $column, $user ); ?></td>
							<?php endforeach ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php
		echo fep_pagination( $total, fep_get_option( 'user_page', 50 ) );
	} else {
		?><div class="alert alert-danger"><?php esc_html_e( 'No users found. Try different filter.', 'scisco' ); ?></div><?php 
	}
	?>
</form>