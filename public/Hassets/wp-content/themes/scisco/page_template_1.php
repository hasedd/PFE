<?php	
/*
Template Name: Page Builder
*/
?>
<?php get_header(); ?>
<header id="scisco-header">
<?php get_template_part( 'templates/header/' . 'topnav', 'template'); ?>
</header>
<main id="scisco-main-wrapper" class="no-padding">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <div class="clearfix"></div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>