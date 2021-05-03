<?php	
/*
Template Name: User Directory
*/
?>
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
        <div class="row">
            <div class="col-12 <?php if ( is_active_sidebar( 'scisco_users_sidebar' ) ) { ?>col-xl-9<?php } ?>">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php 
                if (class_exists( 'AnsPress' )) {
                    get_template_part( 'templates/usersearch', 'template');
                    get_template_part( 'templates/userlist', 'template'); 
                }
                ?>
                <div class="clearfix"></div>
                <?php endwhile; ?>
            </div>
            <?php if ( is_active_sidebar( 'scisco_users_sidebar' ) ) { ?>
            <aside class="col-12 col-xl-3 mt-5 mt-xl-0">
                <?php dynamic_sidebar( 'scisco_users_sidebar' ); ?>
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