<?php
$followers = get_user_meta( get_current_user_id(), 'scisco_following', true);

if (!empty($followers) && is_array($followers)) {
    $followers = array_keys($followers);
    $scisco_user_blog_layout = get_theme_mod( 'scisco_user_blog_layout', 'scisco-two-columns' );
    if ( get_query_var( 'paged' ) ) { $scisco_paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $scisco_paged = get_query_var( 'page' ); } else { $scisco_paged = 1; }
    $scisco_post_per_page = get_theme_mod( 'scisco_max_user_blog_post', 10 );
    $blog_query_args = array(
        'post_type' => 'post', 
        'post_status' => 'publish', 
        'posts_per_page' => $scisco_post_per_page, 
        'paged' => $scisco_paged, 
        'author__in' => $followers
    );
    $blog_query = new WP_Query($blog_query_args);
    ap_get_template_part( 'addons/user/menu-activity' );
    if ( $blog_query->have_posts() ) {
        if ( $scisco_user_blog_layout == 'scisco-three-columns' ) { ?>
        <div class="scisco-masonry-grid small-grid">
            <div class="scisco-three-columns" data-columns>
            <?php while($blog_query->have_posts()) : $blog_query->the_post(); ?>
            <?php get_template_part( 'templates/postsm', 'template'); ?>
            <?php endwhile; ?>
            </div>
        </div>
        <?php } elseif ($scisco_user_blog_layout == 'scisco-one-column' ) { ?>
            <div class="scisco-masonry-grid">
                <div class="scisco-one-column" data-columns>
                <?php while($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <?php get_template_part( 'templates/post', 'template'); ?>
                <?php endwhile; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="scisco-masonry-grid">
                <div class="scisco-two-columns" data-columns>
                <?php while($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <?php get_template_part( 'templates/post', 'template'); ?>
                <?php endwhile; ?>
                </div>
            </div>
        <?php } ?>
        <?php if ( $blog_query->max_num_pages > 1 ) : ?>
        <div class="scisco-pager">
            <?php scisco_profile_pagination($blog_query); ?>
        </div> 
        <div class="clearfix"></div>    
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    <?php } else { 
        echo '<div class="alert alert-warning">' . esc_html__( 'There is no blog post from the users you are following.', 'scisco' ) . '<div>';
    }
} else {
    echo '<div class="alert alert-warning">' . esc_html__( 'You are not following anyone.', 'scisco' ) . '<div>';
}
?>