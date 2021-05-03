<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( $box_content->found_messages ) {
?>
	<div class="fep-cb-check-uncheck-all-div">
		<label>
			<input type="checkbox" class="fep-cb-check-uncheck-all" />
			<?php esc_html_e( 'Check/Uncheck all', 'scisco' ); ?>
		</label>
	</div>
	<div class="table-responsive">
		<table id="fep-table" class="table">
			<tbody>
			<?php
			while ( $box_content->have_messages() ) {
				$box_content->the_message();
				if ( 'announcement' === fep_get_message_field( 'mgs_type' ) ) :
					?>
					<tr id="fep-announcement-<?php echo fep_get_the_id(); ?>" class="fep-table-row">
					<?php foreach ( FEP_Announcements::init()->get_table_columns() as $column => $display ) : ?>
						<td class="fep-column fep-column-<?php echo esc_attr( $column ); ?>"><?php FEP_Announcements::init()->get_column_content( $column ); ?></td>
					<?php endforeach; ?>
					</tr>
				<?php elseif ( 'message' === fep_get_message_field( 'mgs_type' ) ) : ?>
					<tr id="fep-message-<?php echo fep_get_the_id(); ?>" class="fep-table-row">
						<?php foreach ( Fep_Messages::init()->get_table_columns() as $column => $display ) : ?>
							<td class="fep-column fep-column-<?php echo esc_attr( $column ); ?>"><?php Fep_Messages::init()->get_column_content( $column ); ?></td>
						<?php endforeach; ?>
					</tr>
				<?php endif; ?>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>

<?php
	echo fep_pagination_prev_next( $box_content->has_more_row );
} else {
	if ( empty( $_GET['fep-filter'] ) || 'show-all' == $_GET['fep-filter'] ) {
		?>
		<div class="alert alert-danger"><?php echo sprintf( esc_html__( 'No %s found.', 'scisco' ), ( isset( $_GET['fepaction'] ) && 'announcements' == $_GET['fepaction'] ) ? esc_html__('announcements', 'scisco') : esc_html__('messages', 'scisco') ); ?></div>
		<?php
	} else {
		?>
		<div class="alert alert-danger"><?php echo sprintf( esc_html__( 'No %s found. Try different filter.', 'scisco' ), ( isset( $_GET['fepaction'] ) && 'announcements' == $_GET['fepaction'] ) ? esc_html__('announcements', 'scisco') : esc_html__('messages', 'scisco') ); ?></div>
		<?php
	}
}
