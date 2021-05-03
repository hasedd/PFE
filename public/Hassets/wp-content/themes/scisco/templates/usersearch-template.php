<?php
$scisco_query_var = get_query_var('qa_user');
$scisco_orderby = get_theme_mod('scisco_users_orderby', 'alphabetical_asc');

if (get_query_var('qa_orderby')) {
    $scisco_orderby = get_query_var('qa_orderby');
}
?>
<form role="search" method="get" id="scisco-user-search-form">
    <div class="form-row">
        <div class="col-8">
            <div class="input-group">
            <input type="text" class="form-control" minlength="3" placeholder="<?php esc_attr_e('Search by name...', 'scisco'); ?>" name="qa_user" value="<?php if ($scisco_query_var) { echo esc_attr($scisco_query_var); } ?>" />
            <div class="input-group-append"> 
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
            </div>
        </div>
        </div>
        <div class="col-4">
            <select name="qa_orderby" id="qa_orderby" class="custom-select w-100">
                <option value="alphabetical_asc" <?php if ($scisco_orderby == 'alphabetical_asc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Alphabetical ASC', 'scisco' ); ?></option>
                <option value="alphabetical_desc" <?php if ($scisco_orderby == 'alphabetical_desc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Alphabetical DESC', 'scisco' ); ?></option>
                <option value="registration_date_asc" <?php if ($scisco_orderby == 'registration_date_asc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Registration Date ASC', 'scisco' ); ?></option>
                <option value="registration_date_desc" <?php if ($scisco_orderby == 'registration_date_desc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Registration Date DESC', 'scisco' ); ?></option>
                <?php if ( ap_is_addon_active('reputation.php')) { ?>
                <option value="reputation_asc" <?php if ($scisco_orderby == 'reputation_asc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Reputation ASC', 'scisco' ); ?></option>
                <option value="reputation_desc" <?php if ($scisco_orderby == 'reputation_desc') { ?>selected<?php } ?>><?php esc_html_e( 'Sort by:', 'scisco' ); ?> <?php esc_html_e( 'Reputation DESC', 'scisco' ); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</form>