<?php get_header(); ?>
<?php $scisco_header_img = get_theme_mod('scisco_shop_cover_img'); ?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
            <h1>
            <?php
            if(is_product()) {
                the_title();
            } else {
                woocommerce_page_title();
            } ?>
            </h1>
        </div>
    </div>
    <?php 
    $scisco_breadcrumb = get_theme_mod('scisco_disable_breadcrumb'); 
    if (empty($scisco_breadcrumb)) {
    ?>
    <div class="scisco-header-breadcrumb">
        <div class="container-fluid">
            <?php 
            $breadcrumb_args = array(
                'delimiter' => '<span class="scisco-woo-delimiter">-</span>'
            );
            woocommerce_breadcrumb($breadcrumb_args); 
            ?>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>

<main id="scisco-main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 <?php if (( is_active_sidebar( 'scisco_woo_sidebar' ) ) && (!is_product())) { ?>col-xl-9<?php } ?>">
                <?php woocommerce_content(); ?>
                <div class="clearfix"></div>
            </div>
            <?php if (( is_active_sidebar( 'scisco_woo_sidebar' ) ) && (!is_product())) { ?>
            <aside class="col-12 col-xl-3 mt-5 mt-xl-0">
                <?php dynamic_sidebar( 'scisco_woo_sidebar' ); ?>
            </aside>
            <?php } ?>
        </div>
    </div>
</main>

<?php if (is_active_sidebar( 'scisco_before_footer' )) { ?>
<div class="container-fluid">
    <div class="scisco-footer-ads scisco-ads-wrapper">
        <?php dynamic_sidebar( 'scisco_before_footer' ); ?>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>