<?php get_header(); ?>  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?> 
<?php 
$scisco_subtitle = get_post_meta( get_queried_object_id(), 'scisco_cmb2_subtitle', true ); 
$scisco_header_img = get_post_meta( get_queried_object_id(), 'scisco_cmb2_subheader_image', true );
if (empty($scisco_header_img)) {
    $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', '');
}
?>
<?php if (get_the_title()) { ?>
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
            <div class="row align-items-center">
                <div class="scisco-post-breadcrumb col-12 col-md-auto">
                    <nav id="scisco-breadcrumb-menu" aria-label="breadcrumb">
                        <?php scisco_bootstrap_breadcrumb(); ?>
                    </nav>
                </div>
                <div class="scisco-post-date col-12 col-md-auto mt-2 mt-md-0 ml-auto">
                    <i class="fas fa-calendar"></i><?php the_time(get_option('date_format')); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>
<?php } ?>
<main id="scisco-main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>col-xl-9<?php } ?>">
            <?php do_action('scisco_post_edit_links'); ?>
            <div class="scisco-content-wrapper">
                <?php $scisco_featured_img = get_theme_mod('scisco_remove_featured_img'); ?>
                <?php 
                if ((has_post_thumbnail()) && (empty($scisco_featured_img)) && (!has_post_format('gallery')) && (!has_post_format('video'))) {
                ?>
                <div class="scisco-featured-img">
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php } ?>
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
                <?php if (!post_password_required()){ ?>
                <div class="scisco-meta">
                    <div>
                    <?php 
                    if( has_category() ) {
                        foreach( get_the_category() as $category ) {
                            echo '<span class="badge badge-dark"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><i class="fas fa-folder"></i> ' . esc_html($category->name) . '</a></span>';
                        }
                    }
                    ?>
                    </div>
                    <div>
                    <?php
                    if( has_tag() ) {
                        the_tags('<span class="badge badge-dark"><i class="fas fa-tag"></i> ','</span><span class="badge badge-dark"><i class="fas fa-tag"></i> ', '</span>');
                    } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php if (!post_password_required()){ ?>
            <?php
            $scisco_author_box = get_theme_mod('scisco_author_box');
            if ( $scisco_author_box ) {                                      
                get_template_part( 'templates/authorbox', 'template');
            }
            ?>
            <?php comments_template(); ?>
            <?php } ?>  
            </div>
            <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>
            <aside class="col-12 col-xl-3 mt-5 mt-xl-0">
                <?php dynamic_sidebar( 'scisco_main_sidebar' ); ?>
            </aside>
            <?php } ?>
        </div>
    </div>
</main>
<?php endwhile; ?>
<?php if (is_active_sidebar( 'scisco_before_footer' )) { ?>
<div class="container-fluid">
    <div class="scisco-footer-ads scisco-ads-wrapper">
        <?php dynamic_sidebar( 'scisco_before_footer' ); ?>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>