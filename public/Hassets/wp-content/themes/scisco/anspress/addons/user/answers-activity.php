<?php
if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
$followers = get_user_meta( get_current_user_id(), 'scisco_following', true);

if (!empty($followers) && is_array($followers)) {
    $followers = array_keys($followers);
    $answer_query_args = array(
        'post_type' => 'answer', 
        'post_status' => 'publish', 
        'posts_per_page' => ap_opt( 'answers_per_page' ), 
        'paged' => $paged, 
        'author__in' => $followers,
        'ap_query' => true,
        'ap_order_by' => 'newest',
        'only_best_answer' => false,
	    'ignore_selected_answer' => false,
        'ap_answers_query' => true
    );
    $answer_query = new WP_Query($answer_query_args);
    ap_get_template_part( 'addons/user/menu-activity' );
    if ( $answer_query->have_posts() ) { ?>
        <div class="ap-questions">
            <?php
            while($answer_query->have_posts()) : $answer_query->the_post();
                ap_the_answer();
                ap_get_template_part( 'addons/user/answer-item' );
            endwhile;
            ?>
        </div>
        <?php if ( $answer_query->max_num_pages > 1 ) { ?>
        <div class="scisco-pager mt-4">
            <?php scisco_profile_pagination($answer_query); ?>
        </div> 
        <div class="clearfix"></div>    
        <?php }
    } else {
        echo '<div class="alert alert-warning">' . esc_html__( 'There is no answer from the users you are following.', 'scisco' ) . '<div>';
    }
} else {
    echo '<div class="alert alert-warning">' . esc_html__( 'You are not following anyone.', 'scisco' ) . '<div>';
}
?>