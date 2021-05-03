<div class="scisco-user-blog-wrapper">   
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="addNewPost-tab" data-toggle="tab" href="#addNewPost" aria-controls="addNewPost" aria-selected="true"><?php esc_html_e( 'Add New Post', 'scisco' ); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pendingPosts-tab" data-toggle="tab" href="#pendingPosts" aria-controls="pendingPosts" aria-selected="false"><?php esc_html_e( 'Pending Posts', 'scisco' ); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="addNewPost" role="tabpanel" aria-labelledby="addNewPost-tab">
                <?php scisco_add_new_post_form(); ?>
            </div>
            <div class="tab-pane fade" id="pendingPosts" role="tabpanel" aria-labelledby="pendingPosts-tab">
                <?php
                $scisco_query = new WP_Query( 
                    array('author' => get_current_user_id(),'post_type' => 'post', 'posts_per_page' => 99,'post_status' => 'pending') 
                );
                if ( $scisco_query->have_posts() ) {
                while($scisco_query->have_posts()) : $scisco_query->the_post(); ?>
                <div class="scisco-pending-outer">
                    <div class="scisco-pending-inner">
                        <?php 
                        if (has_post_thumbnail()) { 
                            $scisco_thumb_id = get_post_thumbnail_id();
                            $scisco_thumb_url_array = wp_get_attachment_image_src($scisco_thumb_id, 'thumbnail', true);
                            $scisco_thumb_url = $scisco_thumb_url_array[0]; 
                        ?>
                        <div class="scisco-pending-img">
                            <img src="<?php echo esc_url($scisco_thumb_url); ?>" alt="<?php the_title(); ?>" />
                        </div>
                        <?php } ?>
                        <div class="scisco-pending">
                            <div class="scisco-pending-title">
                                <?php the_title(); ?>
                            </div>
                            <div class="scisco-pending-meta">
                                <i class="fa fa-clock-o"></i> <?php echo the_time(get_option('date_format')); ?>
                            </div>
                            <div class="scisco-pending-desc">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php } else { ?>
                <div class="alert alert-info">
                    <p><?php esc_html_e('There were no posts found.', 'scisco'); ?></p>
                </div>
                <?php } wp_reset_postdata(); ?>
            </div>
        </div>   
    </div>