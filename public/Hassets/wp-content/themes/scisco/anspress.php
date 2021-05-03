<?php get_header(); ?>
<?php
if (get_query_var( 'ap_page' ) != '' && get_query_var( 'ap_page' ) == 'user'){
    $scisco_user_id = ap_current_user_id();
    $scisco_header_img = get_user_meta( $scisco_user_id, 'scisco_cmb2_user_cover_image', true );
    if (empty($scisco_header_img)) {
        $scisco_header_img = get_theme_mod('scisco_ap_user_default_img', '');
    }
    $scisco_user_desc = get_user_meta( $scisco_user_id, 'scisco_cmb2_short_bio', true );
    $scisco_user_reputation = ap_get_user_reputation_meta( $scisco_user_id );
?>

<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title" class="scisco-profile-header">
            <div class="scisco-profile-thumbnail">
            <?php echo get_avatar( $scisco_user_id, 150 ); ?>
            </div>
            <div class="scisco-profile-info">
                <h1 class="scisco-ap-title">
                <?php
                echo ap_user_display_name(
                    [
                        'user_id' => $scisco_user_id,
                        'html'    => false,
                    ]
                );
                ?><span class="scisco-title-count scisco-title-rep"><?php echo esc_html($scisco_user_reputation); ?></span>
                </h1>
                <?php if ($scisco_user_desc) { ?>
                <div class="scisco-description">
                <?php echo wp_kses_post($scisco_user_desc); ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php 
    $scisco_breadcrumb = get_theme_mod('scisco_disable_breadcrumb'); 
    if (empty($scisco_breadcrumb)) {
    ?>
    <div class="scisco-header-breadcrumb">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="scisco-post-breadcrumb col-12 col-md-auto">
                    <nav id="scisco-breadcrumb-menu" aria-label="breadcrumb">
                        <?php scisco_anspress_breadcrumbs(); ?>
                    </nav>
                </div>
                <div class="scisco-post-date col-12 col-md-auto mt-2 mt-md-0 ml-auto"><?php do_action('scisco_user_buttons'); ?></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>    

<?php } else { ?>    
<?php
$scisco_subtitle = get_post_meta( get_queried_object_id(), 'scisco_cmb2_subtitle', true ); 
if (is_tax('question_category') || is_tax('question_tag')) { 
    $scisco_header_img = get_term_meta( get_queried_object_id(), 'scisco_cmb2_taxheader_image', true );
    if (empty($scisco_header_img)) {
        $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', '');
    } 
} else {
    $scisco_header_img = get_theme_mod('scisco_subheader_cover_img', '');
}
?>
<header id="scisco-header" data-img="<?php echo esc_url($scisco_header_img); ?>">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
    <div class="container-fluid">
        <div id="scisco-page-title">
        <?php if (is_tax('question_category') || is_tax('question_tag')) { 
            $term = get_queried_object();
            $term_desc = $term->description;
            $term_count = $term->count;
        ?>
        <h1 class="scisco-ap-title"><?php single_term_title(); ?><span class="scisco-title-count"><?php echo esc_html($term_count); ?></span></h1>
        <?php
            if ($term_desc) {
                echo '<p class="scisco-description">' . esc_html($term_desc) . '</p>';
            }
        ?>
        <?php } else { ?>
        <?php the_title('<h1>','</h1>'); ?>
        <?php
        if (is_search()) { ?>
            <p class="scisco-description">
                <?php echo esc_html__( 'Search Results for:', 'scisco' ); ?> <?php echo esc_html(get_search_query()); ?>
            </p>
        <?php } elseif (!empty($scisco_subtitle)) {
            echo '<p class="scisco-description">' . esc_html($scisco_subtitle) . '</p>';
        } 
        ?> 
        <?php } ?>
        </div>
    </div>
    <?php 
    $scisco_breadcrumb = get_theme_mod('scisco_disable_breadcrumb'); 
    if (empty($scisco_breadcrumb)) {
    ?>
    <div class="scisco-header-breadcrumb">
        <div class="container-fluid">
            <nav id="scisco-breadcrumb-menu" aria-label="breadcrumb">
                <?php scisco_anspress_breadcrumbs(); ?>
            </nav>
        </div>
    </div>
    <?php } ?>
    <?php if (!empty($scisco_header_img)) { ?>
    <div id="scisco-header-overlay"></div>
    <?php } ?>
</header>

<?php } ?>

<main id="scisco-main-wrapper">
    <div class="container-fluid">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <div class="clearfix"></div>
        <?php endwhile; ?>
    </div>
</main>

<?php if (is_active_sidebar( 'scisco_before_footer' )) { ?>
<div class="container-fluid">
    <div class="scisco-footer-ads scisco-ads-wrapper">
        <?php dynamic_sidebar( 'scisco_before_footer' ); ?>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>