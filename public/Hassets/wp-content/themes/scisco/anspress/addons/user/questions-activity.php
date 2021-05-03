<?php
if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
$followers = get_user_meta( get_current_user_id(), 'scisco_following', true);

if (!empty($followers) && is_array($followers)) {
    $followers = array_keys($followers);
    $question_query_args = array(
        'post_type' => 'question', 
        'post_status' => 'publish', 
        'posts_per_page' => ap_opt( 'question_per_page' ), 
        'paged' => $paged, 
        'author__in' => $followers,
        'ap_query' => true,
        'ap_order_by' => 'newest',
        'ap_question_query' => true
    );
    $question_query = new WP_Query($question_query_args);
    ap_get_template_part( 'addons/user/menu-activity' );
    if ( $question_query->have_posts() ) { ?>
        <div class="ap-questions">
            <?php
            while($question_query->have_posts()) : $question_query->the_post();
                ap_the_question();
                ap_get_template_part( 'question-list-item' );
            endwhile;
            ?>
        </div>
        <?php if ( $question_query->max_num_pages > 1 ) { ?>
        <div class="scisco-pager mt-4">
            <?php scisco_profile_pagination($question_query); ?>
        </div> 
        <div class="clearfix"></div>    
        <?php }
    } else {
        echo '<div class="alert alert-warning">' . esc_html__( 'There is no question from the users you are following.', 'scisco' ) . '<div>';
    }
} else {
    echo '<div class="alert alert-warning">' . esc_html__( 'You are not following anyone.', 'scisco' ) . '<div>';
}
?>