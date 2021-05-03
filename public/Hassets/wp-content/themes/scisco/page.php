<?php get_header(); ?>
<?php
$scisco_subtitle = get_post_meta( get_queried_object_id(), 'scisco_cmb2_subtitle', true ); 
$scisco_header_img = get_post_meta( get_queried_object_id(), 'scisco_cmb2_subheader_image', true );
if (empty($scisco_header_img)) {
    $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', '');
}
?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
            <?php the_title('<h1>','</h1>'); ?>
            <?php
            if (!empty($scisco_subtitle)) {
                echo '<p class="scisco-description">' . esc_html($scisco_subtitle) . '</p>';
            } 
            ?> 
        </div>
    </div>
    <?php 
    $scisco_breadcrumb = get_theme_mod('scisco_disable_breadcrumb'); 
    if (empty($scisco_breadcrumb)) {
    ?>
    <div class="scisco-header-breadcrumb">
        <div class="container-fluid">
            <nav id="scisco-breadcrumb-menu" aria-label="breadcrumb">
                <?php scisco_bootstrap_breadcrumb(); ?>
            </nav>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>

<main id="scisco-main-wrapper">
    <div class="container-fluid">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="scisco-content-wrapper">
                <?php the_content(); ?>
                <div class="clearfix"></div>
                <?php 
                wp_link_pages( array(
                    'before'      => '<div class="scisco-page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>'
                ));
                ?>
            </div>
            <?php comments_template(); ?>
        <?php endwhile; ?>
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