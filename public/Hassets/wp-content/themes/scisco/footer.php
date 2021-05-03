<div class="clearfix"></div>
<footer id="scisco-footer">
    <?php if ( is_active_sidebar( 'scisco_footer_widgets' ) || is_active_sidebar( 'scisco_footer2_widgets' ) || is_active_sidebar( 'scisco_footer3_widgets' ) ) { ?>
    <?php $scisco_footer_layout = get_theme_mod('scisco_footer_layout', '3'); ?>
    <div id="footer-widgets">
        <div class="container-fluid">
            <div class="row">
                <?php get_template_part( 'templates/footer/' . $scisco_footer_layout, 'template'); ?> 
            </div>
        </div>
    </div>
    <?php } ?>
    <?php 
    $scisco_icons = get_theme_mod( 'scisco_footer_icons' );
    $scisco_footermessage = get_theme_mod('scisco_footermessage'); 
    ?>
    <?php if ($scisco_footermessage || !empty($scisco_icons)) { ?>
    <div id="scisco-footer-bottom">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <?php if ($scisco_footermessage) { ?>
                    <?php echo wp_kses_post($scisco_footermessage); ?>
                    <?php } ?>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                <?php if (!empty($scisco_icons)) { ?>
                <ul class="scisco-icons">
                    <?php get_template_part( 'templates/footericons', 'template'); ?>
                </ul>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php } ?>
</footer>
</div>
<div id="scisco-gototop" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Go to Top', 'scisco'); ?>">
    <i class="fas fa-arrow-up"></i>
</div>
<?php wp_footer(); ?>
</body>
</html>