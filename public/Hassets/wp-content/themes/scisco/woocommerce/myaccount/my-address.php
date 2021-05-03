<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => esc_html__( 'Billing address', 'scisco' ),
		'shipping' => esc_html__( 'Shipping address', 'scisco' ),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => esc_html__( 'Billing address', 'scisco' ),
	), $customer_id );
}
?>

<div class="alert alert-info">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'scisco' ) ); ?>
</div>

<div class="woocommerce-Addresses addresses">
<?php foreach ( $get_addresses as $name => $title ) : ?>
	<div class="woocommerce-Address">
		<header class="woocommerce-Address-title title">
			<h3><?php echo esc_html($title); ?></h3>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="btn btn-sm btn-primary edit"><?php esc_html_e( 'Edit', 'scisco' ); ?></a>
		</header>
		<address><?php
			$address = wc_get_account_formatted_address( $name );
            if (!empty($address)) {
                echo wp_kses_post( $address );
            } else {
                esc_html_e( 'You have not set up this type of address yet.', 'scisco' );
            }
		?></address>
	</div>
<?php endforeach; ?>
</div>