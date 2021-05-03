<?php
/**
 * 
 * Get Post count
 * 
 */
function scisco_post_count() {
    return wp_count_posts()->publish;
}

/**
 * 
 * Get Comment Count
 * 
 */
function scisco_comment_count() {
    return wp_count_comments()->approved;
}

/**
 * 
 * Get Registered User count
 * 
 */
function scisco_user_count() {
    $usercount = count_users();
    $result = $usercount['total_users']; 
    return $result; 
}


function scisco_total_published_answers() {
	$posts = ap_total_posts_count('answer');
	return $posts->publish;
}
?>