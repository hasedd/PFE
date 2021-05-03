<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
<div class="scisco-woo-tabs">
<ul class="nav nav-tabs">
    <?php $i = 0; ?>
    <?php foreach ( $tabs as $key => $tab ) : ?>
    <?php if ($i == 0) {
            $tabs_active = 'active';
            $tabs_expanded = 'true';
        } else {
            $tabs_active = '';
            $tabs_expanded = 'false';
        }
    ?>
    <li class="nav-item" id="tab-title-<?php echo esc_attr( $key ); ?>">
        <a href="#tab-<?php echo esc_attr( $key ); ?>" class="nav-link <?php echo esc_attr($tabs_active); ?>" aria-expanded="<?php echo esc_attr($tabs_expanded); ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
    </li>
    <?php $i++; ?>
    <?php endforeach; ?>
</ul>

    <div class="tab-content">
    <?php $count = 0; ?>
    <?php foreach ( $tabs as $key => $tab ) : ?>
        <?php
        if ($count == 0) {
            $tabs_active = 'active show';
            $tabs_expanded = 'true';
        } else {
            $tabs_active = '';
            $tabs_expanded = 'false';
        }
        ?>
        <div class="tab-pane fade <?php echo esc_attr($tabs_active); ?>" id="tab-<?php echo esc_attr( $key ); ?>" aria-expanded="<?php echo esc_attr($tabs_expanded); ?>">
            <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
        </div>
        <?php $count++; ?>
		<?php endforeach; ?>
    </div>
</div>
<?php endif; ?>