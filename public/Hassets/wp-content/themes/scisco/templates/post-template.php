<div <?php post_class(); ?>>
    <div class="card-masonry">
    <div class="card">
    <?php if (has_post_thumbnail()) { ?>
    <?php
    $scisco_thumb_size = get_theme_mod('scisco_masonry_thumbnail', 'large');
    $scisco_thumb_id = get_post_thumbnail_id();
    $scisco_thumb_url_array = wp_get_attachment_image_src($scisco_thumb_id, $scisco_thumb_size, true);
    $scisco_thumb_url = $scisco_thumb_url_array[0];
    ?>
    <a class="card-featured-img" href="<?php the_permalink(); ?>">
        <img class="card-img-top" src="<?php echo esc_url($scisco_thumb_url); ?>" alt="<?php the_title_attribute(); ?>" />   
    </a>    
    <?php } ?>
        <div class="card-body">
            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
        </div>
        <div class="card-footer">
            <div class="card-avatar">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?></a>
            </div>
            <div class="card-meta">
                <div class="card-meta-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></div>
                <div class="card-meta-date"><a href="<?php esc_url(the_permalink()); ?>"><?php the_time(get_option('date_format')); ?></a></div>
            </div>
            <div class="card-comments">
                <a href="<?php the_permalink(); ?>/#scisco-comments-wrapper"><i class="fas fa-comments"></i> <?php echo esc_html(get_comments_number()); ?></a>
            </div>
        </div>
    </div> 
</div>
</div>