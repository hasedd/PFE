<?php

/*---------------------------------------------------
Ask Question Button
----------------------------------------------------*/

function scisco_ask_btn() {
    echo wp_kses_post(scisco_get_ask_btn());
}

function scisco_get_ask_btn() {
    $btn_style = get_theme_mod('scisco_ask_button_style', 'btn-success');
    $link = ap_get_link_to( 'ask' );
    $link = apply_filters( 'ap_ask_btn_link', $link );
 
    return '<a class="btn ' . $btn_style . ' btn-block" href="' . $link . '">' . esc_html__( 'Ask question', 'scisco' ) . '</a>';
}

/*---------------------------------------------------
Breadcrumbs
----------------------------------------------------*/

function scisco_get_anspress_breadcrumbs() {
    $current_page = ap_current_page();
    $title = ap_page_title();
    $users_page = get_theme_mod('scisco_users_page');
    $a = array();

    $a['base'] = array( 'title' => ap_opt( 'base_page_title' ), 'link' => ap_base_page_link(), 'order' => 0 );

    if(get_permalink() != ap_base_page_link()) {
        if ( is_question() ) {
            $a['page'] = array( 'title' => get_the_title(get_question_id()), 'link' => get_permalink( get_question_id() ), 'order' => 10 );
        } elseif (get_query_var( 'ap_page' ) != '' && get_query_var( 'ap_page' ) == 'user'){
            if ($users_page) {
                $a['users'] = array( 'title' => get_the_title($users_page), 'link' => get_permalink($users_page), 'order' => 10 );
            }
            $a['page'] = array( 'title' => ap_user_display_name(
                [
                    'user_id' => ap_current_user_id(),
                    'html'    => false,
                ]
            ), 'order' => 10 );
        } elseif (empty($title)) {
            $a['page'] = array( 'title' => get_the_title(), 'order' => 10 );
        } elseif ( 'base' != $current_page && '' != $current_page ) {
            $a['page'] = array( 'title' => $title, 'link' => ap_get_link_to( $current_page ), 'order' => 10 );
        }
    }

    $a = apply_filters( 'ap_breadcrumbs', $a );

    return ap_sort_array_by_order( $a );
}

/**
 * Output Breadcrumbs
 */

function scisco_anspress_breadcrumbs() {

    $navs = scisco_get_anspress_breadcrumbs();

    echo '<ol class="breadcrumb breadcrumb-links breadcrumb-dark">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '"><i class="fas fa-home"></i></a></li>';

    $i = 1;
    $total_nav = count( $navs );

    foreach ( $navs as $k => $nav ) {
        if ( ! empty( $nav ) ) {
            if ( $total_nav != $i ) {
                echo '<li class="breadcrumb-item">';
                echo '<a href="'.esc_url( $nav['link'] ).'">'. esc_html( $nav['title'] ).'</a>';
            } else {
                echo '<li class="breadcrumb-item active">';
                echo esc_html( $nav['title'] );
            }
            echo '</li>';
        }
        ++$i;
    }

    echo '</ol>';
}

/* ---------------------------------------------------------
Add required query vars
----------------------------------------------------------- */

function scisco_register_user_query_var( $vars ) {
    $vars[] = 'qa_user';
    $vars[] = 'qa_order';
    $vars[] = 'qa_orderby';
    $vars[] = 'ap_activity_page';
	return $vars;
}
add_filter( 'query_vars', 'scisco_register_user_query_var' );

/*---------------------------------------------------
About Page
----------------------------------------------------*/ 

function scisco_ap_about(){
    $page_slug = get_theme_mod('scisco_ap_about_slug', 'about');
	anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'About', 'scisco' ),
        'icon'  => 'apicon-user',
        'cb'    => 'scisco_user_about_page',
        'order' => 1,
        'private' => false
    );
}

function scisco_user_about_page() {
    include ap_get_theme_location( 'addons/user/about.php' );
}

add_filter('ap_user_pages', 'scisco_ap_about', 10);

/*---------------------------------------------------
Edit Profile Page
----------------------------------------------------*/ 

function scisco_ap_edit_user(){
    $page_slug = get_theme_mod('scisco_ap_edit_profile_slug', 'edit-profile');
	anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Edit Profile', 'scisco' ),
        'icon'  => 'apicon-gear',
        'cb'    => 'scisco_user_edit_page',
        'order' => 99,
        'private' => true
    );
}

function scisco_user_edit_page() {
    include ap_get_theme_location( 'addons/user/edit-profile.php' );
}

add_filter('ap_user_pages', 'scisco_ap_edit_user', 10);

/*---------------------------------------------------
Private Messages Page
----------------------------------------------------*/ 

if (class_exists('Front_End_Pm')) {
    function scisco_ap_messages_page(){
        $page_slug = get_theme_mod('scisco_ap_messages_slug', 'messages');
        anspress()->user_pages[] = array(
            'slug'  => $page_slug,
            'label' => esc_html__( 'Messages', 'scisco' ),
            'icon'  => 'apicon-messages',
            'cb'    => 'scisco_user_messages_page',
            'count'   => fep_get_new_message_number(),
            'order' => 10,
            'private' => true
        );
    }
    
    function scisco_user_messages_page() {
        include ap_get_theme_location( 'addons/user/messages.php' );
    }
    
    add_filter('ap_user_pages', 'scisco_ap_messages_page', 10);
}

/*---------------------------------------------------
User Blog
----------------------------------------------------*/ 

$scisco_enable_user_blog = get_theme_mod('scisco_enable_user_blog');

function scisco_ap_blog_page(){
    $page_slug = get_theme_mod('scisco_ap_blog_slug', 'blog');
    anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Blog', 'scisco' ),
        'icon'  => 'apicon-blog',
        'cb'    => 'scisco_user_blog_page',
        'count'   => count_user_posts(ap_current_user_id(), 'post'),
        'order' => 13
    );
}

function scisco_user_blog_page() {
    include ap_get_theme_location( 'addons/user/blog.php' );
}

function scisco_ap_submit_post_page(){
    $page_slug = get_theme_mod('scisco_ap_submit_post_slug', 'submit-post');
    anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Submit Post', 'scisco' ),
        'icon'  => 'apicon-submit',
        'cb'    => 'scisco_user_submit_post_page',
        'order' => 14,
        'private' => true
    );
}

function scisco_user_submit_post_page() {
    include ap_get_theme_location( 'addons/user/submit-post.php' );
}

if ($scisco_enable_user_blog) {
    add_filter('ap_user_pages', 'scisco_ap_blog_page', 10);
    add_filter('ap_user_pages', 'scisco_ap_submit_post_page', 10);
}

/*---------------------------------------------------
User Follow
----------------------------------------------------*/ 

$scisco_user_follow = get_theme_mod('scisco_user_follow');

/* Activities */ 

function scisco_ap_activities_page(){
    $page_slug = get_theme_mod('scisco_ap_activities_slug', 'activities');
    anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Activities', 'scisco' ),
        'icon'  => 'apicon-pulse',
        'cb'    => 'scisco_user_activities_page',
        'order' => 15,
        'private' => true
    );
}

function scisco_user_activities_page() {
    include ap_get_theme_location( 'addons/user/activities.php' );
}

/* Followers */ 

function scisco_ap_followers_count(){
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
    return $total_users;
}

function scisco_ap_followers_page(){
    $page_slug = get_theme_mod('scisco_ap_followers_slug', 'followers');
    anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Followers', 'scisco' ),
        'icon'  => 'apicon-followers',
        'cb'    => 'scisco_user_followers_page',
        'count'   => scisco_ap_followers_count(ap_current_user_id()),
        'order' => 16
    );
}

function scisco_user_followers_page() {
    include ap_get_theme_location( 'addons/user/followers.php' );
}

/* Following */ 

function scisco_ap_following_count(){
    $followers = get_user_meta( ap_current_user_id(), 'scisco_following', true);
    $total_users = 0;

    if (!empty($followers) || is_array($followers)) {
        $total_users = count($followers);
    }
    return $total_users;
}

function scisco_ap_following_page(){
    $page_slug = get_theme_mod('scisco_ap_following_slug', 'following');
    anspress()->user_pages[] = array(
        'slug'  => $page_slug,
        'label' => esc_html__( 'Following', 'scisco' ),
        'icon'  => 'apicon-following',
        'cb'    => 'scisco_user_following_page',
        'count'   => scisco_ap_following_count(ap_current_user_id()),
        'order' => 17
    );
}

function scisco_user_following_page() {
    include ap_get_theme_location( 'addons/user/following.php' );
}

/* Add filters if the feature is enabled */ 

if ($scisco_user_follow) {
    add_filter('ap_user_pages', 'scisco_ap_activities_page', 10);
    add_filter('ap_user_pages', 'scisco_ap_followers_page', 10);
    add_filter('ap_user_pages', 'scisco_ap_following_page', 10);
}
?>
