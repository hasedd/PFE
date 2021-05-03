<div class="scisco-profile-submenu">
    <div class="scisco-profile-submenu-inner">
    <?php 
    $page_activity = get_query_var('ap_activity_page');
    $active_page = '';
    if ($page_activity) {
        $active_page = $page_activity;
    } else {
        $active_page = 'questions';
    }
    $page_slug = get_theme_mod('scisco_ap_activities_slug', 'activities'); 
    $page_url = ap_user_link(get_current_user_id()) . $page_slug . '/';
    $questions_url = add_query_arg( 'ap_activity_page', 'questions', $page_url );
    $answers_url = add_query_arg( 'ap_activity_page', 'answers', $page_url );
    $posts_url = add_query_arg( 'ap_activity_page', 'posts', $page_url );
    ?>
    <a href="<?php echo esc_url($questions_url); ?>" class="scisco-profile-submenu-item <?php if ($active_page == 'questions') { echo 'active'; } ?>">
        <i class="apicon-question"></i><?php esc_html_e( 'Questions', 'scisco' ); ?>
    </a>
    <a href="<?php echo esc_url($answers_url); ?>" class="scisco-profile-submenu-item <?php if ($active_page == 'answers') { echo 'active'; } ?>">
        <i class="apicon-answer"></i><?php esc_html_e( 'Answers', 'scisco' ); ?>
    </a>
    <a href="<?php echo esc_url($posts_url); ?>" class="scisco-profile-submenu-item <?php if ($active_page == 'posts') { echo 'active'; } ?>">
        <i class="apicon-blog"></i><?php esc_html_e( 'Blog Posts', 'scisco' ); ?>
    </a>
    </div>
</div>