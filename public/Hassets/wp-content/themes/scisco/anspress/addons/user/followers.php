<?php
$scisco_query_var = get_query_var('qa_user');
$scisco_limit = get_theme_mod('scisco_users_limit', 10);
$scisco_orderby = get_theme_mod('scisco_users_orderby', 'alphabetical_asc');
$user_search_query = array();

if (get_query_var('qa_orderby')) {
    $scisco_orderby = get_query_var('qa_orderby');
}

if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
$offset = ($paged - 1) * $scisco_limit;
$get_users = get_users();
$users = array();
$i = 0;

foreach($get_users as $user){
    $user_following = get_user_meta( $user->ID, 'scisco_following', true);
    if (!empty($user_following) && is_array($user_following) && array_key_exists(ap_current_user_id(), $user_following) && $user_following[ap_current_user_id()]) {
        $users[] = $user->ID;
        $i ++;
    }
}

$total_users = count($users);
$total_pages = intval(ceil($total_users / $scisco_limit));

if ($i == 0) {
    $users = array(0);
}

if ($scisco_query_var) {
    $user_search_query = array(
        'search'         => '*' . esc_attr( $scisco_query_var ) . '*',
        'search_columns' => array(
            'user_login',
            'user_nicename',
            'first_name',
            'last_name'
        )
    );  
} 

switch ($scisco_orderby) {
    case 'registration_date_asc':
        $user_query = array(
            'orderby'	 => 'user_registered',
            'order'		 => 'ASC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
    case 'registration_date_desc':
        $user_query = array(
            'orderby'	 => 'user_registered',
            'order'		 => 'DESC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
    case 'alphabetical_asc':
        $user_query = array(
            'orderby'	 => 'title',
            'order'		 => 'ASC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
    case 'alphabetical_desc':
        $user_query = array(
            'orderby'	 => 'title',
            'order'		 => 'DESC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
    case 'reputation_asc':
        $user_query = array(
            'orderby'	 => 'meta_value_num',
            'meta_key'	 => 'ap_reputations',
            'order'		 => 'ASC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
    case 'reputation_desc':
        $user_query = array(
            'orderby'	 => 'meta_value_num',
            'meta_key'	 => 'ap_reputations',
            'order'		 => 'DESC',
            'number'	 => $scisco_limit,
            'offset'     => $offset,
            'include' => $users
        );
    break;
}

$final_query = new WP_User_Query($user_search_query + $user_query);
$total_query = count($final_query->get_results());
?>
<?php if ($final_query->get_results()) { ?>
<?php get_template_part( 'templates/usersearch', 'template'); ?>
<div class="scisco-users-wrapper">
<?php 
foreach ($final_query->get_results() as $user) {
?>
    <div class="scisco-question-wrapper">
		<div class="scisco-question-avatar">
			<a href="<?php echo esc_url(ap_user_link($user->ID)); ?>/">
                <?php echo get_avatar( $user->ID, ap_opt( 'avatar_size_list' ) ); ?>
			</a>
		</div>
		<div class="scisco-question-title">
			<h6>
                <a href="<?php echo esc_url(ap_user_link($user->ID)); ?>/">
                    <?php echo esc_html($user->display_name); ?>
                </a>
                <?php $reputation_count = ap_get_user_reputation_meta( $user->ID, true ); ?>
                <span class="ap-user-reputation"><?php echo esc_html($reputation_count); ?></span>
			</h6>
			<div class="scisco-question-meta">
                <?php esc_html_e( 'Member since:', 'scisco'); ?> <?php echo esc_html(date( get_option('date_format'), strtotime( $user->user_registered ))); ?>
			</div>
        </div>
        <div class="scisco-question-counts">
        <?php
            $user_answer = ap_total_posts_count( 'answer', false, $user->ID);
            $user_answer_count = $user_answer->publish;
            $user_question = ap_total_posts_count( 'question', false, $user->ID);
            $user_question_count = $user_question->publish;
            ?>
            <span class="ap-questions-count">
                <span><?php echo esc_html($user_question_count); ?></span>
                <?php esc_html_e( 'Que', 'scisco' ); ?>
            </span>
            <span class="ap-questions-count ap-questions-vcount">
                <span><?php echo esc_html($user_answer_count); ?></span>
                <?php esc_html_e( 'Ans', 'scisco' ); ?>
            </span>
		</div>
    </div>
    <?php } ?>
</div>
<?php
if (empty($scisco_query_var)) {
    if ($total_users > $total_query) {
        $pages = paginate_links( [
            'base' => @add_query_arg('page','%#%'),
            'format' => '',
            'current'      => max( 1, $paged ),
            'total'        => $total_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => '<i class="fas fa-angle-left"></i>',
            'next_text'    => '<i class="fas fa-angle-right"></i>'
        ]
    );
    $pagination = '<div class="scisco-users-pager"><ul class="pagination pagination-lg flex-wrap justify-content-center">';
    foreach ($pages as $page) {
        $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
    }
    $pagination .= '</ul></div>';
    echo wp_kses_post($pagination);  
    }
}
} else { ?>
<div class="alert alert-warning"><?php esc_html_e( 'This user has no follower.', 'scisco' ); ?></div>      
<?php } ?>