<?php get_header(); ?>
<?php $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', ''); ?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
            <h1><?php esc_html_e( '404 - Page not found!', 'scisco' ); ?></h1>
        </div>
    </div>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>

<main id="scisco-main-wrapper">
    <div class="container-fluid">
        <div class="scisco-404">
            <p><strong><?php esc_html_e( 'You can search for the page you were looking for or', 'scisco'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'return home', 'scisco' ); ?></a>.</strong></p>
            <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control autocomplete-posts" placeholder="<?php esc_attr_e('Enter a keyword...', 'scisco'); ?>" name="s" />
                    <div class="input-group-append"> 
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
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