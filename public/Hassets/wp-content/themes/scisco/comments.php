<?php if (post_password_required()) { return; } ?>
<?php if ((have_comments()) || (comments_open())) { ?>
<div id="scisco-comments-wrapper">
<?php if (have_comments()) { ?>
<?php $scisco_num_comments = get_comments_number(); ?>
<div id="scisco_comments_block" class="scisco_comments_block">
    <h3>
        <?php esc_html_e("Comments", 'scisco'); ?>
    </h3>
    <div class="scisco_commentlist">
        <?php wp_list_comments( array('callback' => 'scisco_comment','style' => 'div') ); ?>
    </div>
    <div class="scisco_comments_rss">
        <?php post_comments_feed_link('<i class="fas fa-rss-square"></i>' . esc_html__( 'Subscribe', 'scisco' )); ?>
    </div>  
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
    <div class="scisco-pager comments-pager">    
            <div class="scisco-pager-left">
                <?php previous_comments_link( '<i class="fas fa-chevron-left"></i> ' . esc_html__( 'Older comments', 'scisco' ) ); ?>
            </div>
            <div class="scisco-pager-right">
                <?php next_comments_link( esc_html__( 'Newer comments', 'scisco' ) .  ' <i class="fas fa-chevron-right"></i>'); ?>
            </div>
        <div class="clearfix"></div>
        </div>
    <?php } ?>

<?php
if (!empty($comments_by_type['pings'])) {
    $scisco_count = count($comments_by_type['pings']);
    ($scisco_count !== 1) ? $scisco_txt = esc_html__('Pings&#47;Trackbacks', 'scisco') : $scisco_txt = esc_html__('Pings&#47;Trackbacks', 'scisco');
?>

    <h6 id="pings"><?php printf( esc_html__( '%1$d %2$s for "%3$s"', 'scisco'), $scisco_count, $scisco_txt, get_the_title() )?></h6>

    <ol class="scisco_commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>

<?php } ?>
</div>     
<?php } ?>     
<?php if (comments_open()) { ?>  
<div id="scisco_comment_form" class="scisco_comment_form">   
    <?php
    $comments_args = array(
        'title_reply_before'=>'<h3>',
        'title_reply_after'=>'</h3>',
        'cancel_reply_before' => '<span class="scisco_cancel">',
        'cancel_reply_after' => '</span>',
        'class_submit' => 'btn btn-primary'
    );
    ?>
    <?php comment_form($comments_args); ?>
</div>    
<?php } ?>
</div>    
<?php } ?>