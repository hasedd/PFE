<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
$scisco_shop_layout = esc_attr(get_theme_mod('scisco_shop_layout', 'threecolumns'));
$scisco_selected_shop_layout = '';
$scisco_small_grid = '';

if ($scisco_shop_layout == 'fourcolumns') { 
    $scisco_selected_shop_layout = 'scisco-four-columns';
} elseif ($scisco_shop_layout == 'threecolumns') { 
    $scisco_selected_shop_layout = 'scisco-three-columns';
} else {
    $scisco_selected_shop_layout = 'scisco-two-columns';
}

if ((is_cart()) || (is_checkout())) {
    $scisco_selected_shop_layout = 'scisco-four-columns';
}

if ($scisco_selected_shop_layout == 'scisco-four-columns') {
    $scisco_small_grid = 'small-grid';
}

?>
<div class="clearfix"></div>
<div class="scisco-masonry-grid <?php echo esc_html($scisco_small_grid); ?>">
<div class="<?php echo esc_attr($scisco_selected_shop_layout); ?>" data-columns>