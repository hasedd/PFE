<?php
/*---------------------------------------------------
Remove default layout
----------------------------------------------------*/

if ( ! function_exists( 'scisco_woo_dequeue_styles' ) ) {
    function scisco_woo_dequeue_styles( $enqueue_styles ) {
        unset( $enqueue_styles['woocommerce-layout'] );
        return $enqueue_styles;
    }
}
add_filter( 'woocommerce_enqueue_styles', 'scisco_woo_dequeue_styles' );

/*---------------------------------------------------
Breadcrumb
----------------------------------------------------*/

function scisco_woo_breadcrumb( $defaults ) {
    $defaults['before'] = '<span class="scisco-woo-crumb">';
    $defaults['after'] = '</span>';
    $defaults['home'] = ' ';
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'scisco_woo_breadcrumb' );

/*---------------------------------------------------
Shop account menu item
----------------------------------------------------*/

function scisco_woo_menu_item() {
    $myaccount_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
    if (!empty($myaccount_url)) {
        echo '<a href="' . esc_url($myaccount_url) . '" class="dropdown-item"><i class="fas fa-shopping-bag"></i>' . esc_html__( 'Shop Account', 'scisco') . '</a>';
    }
}
add_action( 'scisco_user_menu_items', 'scisco_woo_menu_item', 10 );

/*---------------------------------------------------
Mini Cart
----------------------------------------------------*/

function scisco_mini_cart_content( $fragments ) {
	global $woocommerce;
	ob_start();
    ?>
    <div id="scisco-mini-cart">
    <?php woocommerce_mini_cart(); ?>
    </div>
	<?php
	$fragments['#scisco-mini-cart'] = ob_get_clean();
	return $fragments;
}

function scisco_mini_cart_indicator( $fragments ) {
	global $woocommerce;
	ob_start();
    ?>
    <div id="scisco-cart-indicator">
    <?php if (! $woocommerce->cart->is_empty()) { ?>
        <span class="scisco-unread-icon"></span>
    <?php } ?>
    </div>
	<?php
	$fragments['#scisco-cart-indicator'] = ob_get_clean();
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'scisco_mini_cart_indicator' );
add_filter( 'woocommerce_add_to_cart_fragments', 'scisco_mini_cart_content' );

/*---------------------------------------------------
Before shop loop item
----------------------------------------------------*/
function scisco_before_shop_loop_item() {
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
       <div class="scisco-out-of-stock"> <?php esc_html_e('Out of Stock', 'scisco'); ?> </div>
    <?php
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'scisco_before_shop_loop_item', 10 );

/*---------------------------------------------------
Add divider before product button
----------------------------------------------------*/
function scisco_product_divider_start() { ?>
        </div>
<?php
}
add_action( 'woocommerce_after_shop_loop_item', 'scisco_product_divider_start', 4 );

function scisco_product_divider_end() { ?>
        <div class="card-footer product-footer">
<?php
}
add_action( 'woocommerce_after_shop_loop_item', 'scisco_product_divider_end', 6 );

/*---------------------------------------------------
Change default product thumbnail size
----------------------------------------------------*/

if ( ! function_exists( 'scisco_product_thumbnail_size' ) ) {
    function scisco_product_thumbnail_size($size) {	
        $size = get_theme_mod('scisco_product_thumbnail', 'large');
        return $size;
    }
}

add_filter( 'single_product_archive_thumbnail_size' , 'scisco_product_thumbnail_size' );
add_filter( 'subcategory_archive_thumbnail_size' , 'scisco_product_thumbnail_size' );

/*---------------------------------------------------
Custom placeholder
----------------------------------------------------*/

if ( ! function_exists( 'scisco_custom_woocommerce_placeholder' ) ) {
function scisco_custom_woocommerce_placeholder( $image_url ) {
    $scisco_woo_placeholder = esc_attr(get_theme_mod('scisco_woo_placeholder'));
    if (!empty($scisco_woo_placeholder)) {
        $image_url = esc_url($scisco_woo_placeholder);
    } else {
        $image_url = get_template_directory_uri() . '/images/woocommerce-placeholder.png';
    }
    return $image_url;
}
}

add_filter( 'woocommerce_placeholder_img_src', 'scisco_custom_woocommerce_placeholder', 10 );

/*---------------------------------------------------
Product per page
----------------------------------------------------*/

if ( ! function_exists( 'scisco_loop_shop_per_page' ) ) {
    function scisco_loop_shop_per_page( $cols ) {
        $cols = esc_attr(get_theme_mod('scisco_shop_at_most', 8));
        return $cols;
    }
}

add_filter( 'loop_shop_per_page', 'scisco_loop_shop_per_page', 20 );

/*---------------------------------------------------
Remove Related Products (Theme Settings)
----------------------------------------------------*/

$scisco_remove_related = esc_attr(get_theme_mod('scisco_remove_related', 1));

if ($scisco_remove_related == 0) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

/*---------------------------------------------------
Remove page titles and taxonomy description
----------------------------------------------------*/

if ( ! function_exists( 'scisco_woo_hide_page_title' ) ) {
    function scisco_woo_hide_page_title() {	
        return false;	
    }
}

add_filter( 'woocommerce_show_page_title' , 'scisco_woo_hide_page_title' );
remove_action( 'woocommerce_archive_description' , 'woocommerce_taxonomy_archive_description', 10 );

/*---------------------------------------------------
Pagination arrows
----------------------------------------------------*/

add_filter( 'woocommerce_pagination_args', 	'scisco_woo_pagination' );
function scisco_woo_pagination( $args ) {
	$args['prev_text'] = '<i class="fas fa-chevron-left"></i>';
	$args['next_text'] = '<i class="fas fa-chevron-right"></i>';
	return $args;
}

/*---------------------------------------------------
Custom styles
----------------------------------------------------*/

if ( ! function_exists( 'scisco_woo_print_styles' ) ) {
    function scisco_woo_print_styles()
    {        
        wp_enqueue_style('scisco-woo', get_template_directory_uri() . '/css/woocommerce.css', false, '1.0');
        
        if (is_rtl()) {
            wp_enqueue_style('scisco-woo-rtl', get_template_directory_uri() . '/css/woocommerce-rtl.css', false, '1.0');
        }
        
        $scisco_product_img_size = get_theme_mod('scisco_product_img_size', 50);
        
        $scisco_woo_inline_style = '';
        
        if ($scisco_product_img_size != 50) {
            $scisco_woo_inline_style .= '.scisco-single-product-left {width: ' . $scisco_product_img_size . '%;}.scisco-single-product-right {width: ' . (100 - $scisco_product_img_size) . '%;}';   
        }
        wp_add_inline_style( 'scisco-woo', $scisco_woo_inline_style );
    }
}
add_action('wp_enqueue_scripts', 'scisco_woo_print_styles', 99);
?>