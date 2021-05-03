<?php get_header(); ?>
<?php $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', ''); ?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
            <h1>
            <?php
            if ( is_home() && ! is_front_page() ) {
                single_post_title();
            } else { 
                esc_html_e( 'Blog', 'scisco' ); 
            } 
            ?></h1>
            <?php 
            $scisco_subtitle = get_theme_mod('scisco_blog_subtitle');
            if (!empty($scisco_subtitle)) {
                echo '<p class="scisco-description">' . esc_html($scisco_subtitle) . '</p>';
            } ?> 
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
    <?php $scisco_page_layout = get_theme_mod('scisco_archive_page_layout', 'masonry-sidebar'); ?>
        <?php if ($scisco_page_layout == 'masonry-3') { ?>
            <div class="scisco-masonry-grid small-grid">
                <div class="scisco-three-columns" data-columns>
                <?php while(have_posts()) : the_post(); ?>
                <?php get_template_part( 'templates/post', 'template'); ?>
                <?php endwhile; ?>
                </div>
            </div>
        <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
        <div class="scisco-pager">
            <?php scisco_pagination(); ?>
        </div> 
        <div class="clearfix"></div>    
        <?php endif; ?> 
        <?php } else if ($scisco_page_layout == 'masonry-2') { ?>
        <div class="scisco-masonry-grid">
            <div class="scisco-two-columns" data-columns>
            <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part( 'templates/post', 'template'); ?>
            <?php endwhile; ?>
            </div>
        </div>
        <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
        <div class="scisco-pager">
            <?php scisco_pagination(); ?>
        </div> 
        <div class="clearfix"></div>    
        <?php endif; ?>
        <?php } else if ($scisco_page_layout == 'sidebar') { ?>
        <div class="row">
            <div class="col-12 <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>col-xl-9<?php } ?>">
                <div class="scisco-masonry-grid">
                    <div class="scisco-one-column" data-columns>
                    <?php while(have_posts()) : the_post(); ?>
                    <?php get_template_part( 'templates/post', 'template'); ?>
                    <?php endwhile; ?>
                    </div>
                </div>
                <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                <div class="scisco-pager">
                    <?php scisco_pagination(); ?>
                </div> 
                <div class="clearfix"></div>    
                <?php endif; ?> 
            </div>
            <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>
            <aside class="scisco-aside col-12 col-xl-3 mt-5 mt-xl-0">
                <?php dynamic_sidebar( 'scisco_main_sidebar' ); ?>
            </aside>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-12 <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>col-xl-9<?php } ?>">
                <div class="scisco-masonry-grid">
                    <div class="scisco-two-columns" data-columns>
                    <?php while(have_posts()) : the_post(); ?>
                    <?php get_template_part( 'templates/post', 'template'); ?>
                    <?php endwhile; ?>
                    </div>
                </div>
                <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                <div class="scisco-pager">
                    <?php scisco_pagination(); ?>
                </div> 
                <div class="clearfix"></div>    
                <?php endif; ?> 
            </div>
            <?php if ( is_active_sidebar( 'scisco_main_sidebar' ) ) { ?>
            <aside class="scisco-aside col-12 col-xl-3 mt-5 mt-xl-0">
                <?php dynamic_sidebar( 'scisco_main_sidebar' ); ?>
            </aside>
            <?php } ?>
        </div>
        <?php } ?>
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