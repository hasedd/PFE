<?php
$author_id = get_the_author_meta( 'ID' );
$author_desc = get_the_author_meta( 'description' );
$author_profile_id = get_post_field( 'post_author', get_the_ID() );
?>

<div class="scisco-author-box">
    <div class="scisco-author-box-left">
        <a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>">
            <?php echo get_avatar( $author_id, 100 ); ?>
        </a>
    </div>
    <div class="scisco-author-box-right">
        <h3>
            <a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>"><?php the_author(); ?></a>
        </h3>
        <?php if ($author_desc) { ?>
        <div class="scisco-author-desc">
            <?php echo wp_kses_post($author_desc); ?>
        </div>
        <?php } ?>
        <?php if (function_exists( 'AnsPress' )) { 
            $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about')
        ?>
        <a class="btn btn-sm btn-primary" href="<?php echo esc_url(ap_get_profile_link($author_profile_id) . $scisco_page_slug); ?>">
            <?php esc_html_e( 'View Profile', 'scisco'); ?>
        </a>
        <?php } ?>
        <a class="btn btn-sm btn-primary" href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>">
            <?php esc_html_e( 'View All Posts', 'scisco'); ?>
        </a>
    </div>
</div>