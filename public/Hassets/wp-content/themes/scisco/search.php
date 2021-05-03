
<?php get_header(); ?>
<?php $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', ''); ?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
        <h1>
        <?php
        $scisco_search_query = get_search_query(); 
        if ( have_posts() ) {
            global $wp_query;
            $scisco_post_count = $wp_query->found_posts;
            echo esc_html($scisco_post_count) . ' ';
            if ($scisco_post_count > 1) {
                echo esc_html__( 'Results Found', 'scisco' );
            }
            else {
                echo esc_html__( 'Result Found', 'scisco' );
            }
        }
         else {
            echo esc_html__( 'No Results Found!', 'scisco' );
        }
        ?>
        </h1>    
        <?php if (!empty($scisco_search_query)) { ?>
        <p class="scisco-description">
            <?php echo esc_html__( 'Search Results for:', 'scisco' ); ?> <?php echo esc_html($scisco_search_query); ?>
        </p>
        <?php } ?>
        </div>
    </div>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>

<main id="scisco-main-wrapper">
    <div class="container-fluid">
    <?php if ( have_posts() ) { ?>    
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
        <?php } else { ?>
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