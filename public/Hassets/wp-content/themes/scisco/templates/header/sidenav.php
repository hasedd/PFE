<?php $scisco_sidenav_position = get_theme_mod('scisco_sidenav_position', 'fixed-left');  ?>
<nav id="scisco-sidenav" class="sidenav navbar navbar-vertical <?php echo esc_attr($scisco_sidenav_position); ?> navbar-expand-xs navbar-dark">
    <div class="scrollbar-inner">
    <div class="navbar-block">
      <div class="sidenav-header" itemscope itemtype="http://schema.org/Brand">
        <?php 
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
        ?>
        <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>" />
        </a>
        <?php } ?>
      </div>
      <div class="sidenav-toggler close-sidenav" data-action="sidenav-pin" data-target="#sidenav-main">
          <i class="fas fa-times"></i>
      </div>
        <div class="navbar-inner">
        <?php if ( has_nav_menu( 'scisco-main-menu' ) ) { ?>
          <?php $scisco_collapsible = get_theme_mod('scisco_menu_collapsible_behavior', 'accordion-toggle'); ?>
            <div class="scisco-header-menu">
                <div class="scisco-smart-menu-container" data-collapsiblebehavior="<?php echo esc_attr($scisco_collapsible); ?>">
                    <?php
                    $rtl = '';
                    if (is_rtl()) {
                        $rtl = 'sm-rtl';
                    }
                    wp_nav_menu([
                        'menu'            => '',
                        'theme_location'  => 'scisco-main-menu',
                        'container'       => 'nav',
                        'container_id' => 'scisco-main-menu',
                        'container_class' => 'scisco-smart-menu-wrapper',
                        'menu_id'         => false,
                        'menu_class'      => 'scisco-smart-menu sm scisco-sm-skin animated sm-vertical ' . $rtl,
                        'depth'           => 99
                    ]); ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php 
        $scisco_btn_text = get_theme_mod('scisco_sidenav_button_text', esc_html__('ASK A QUESTION', 'scisco')); 
        $scisco_btn_url = get_theme_mod('scisco_sidenav_button_url'); 
        $scisco_btn_class = get_theme_mod('scisco_sidenav_button_style', 'btn-success'); 
        if ($scisco_btn_url) {
          echo '<a class="btn ' . esc_attr($scisco_btn_class) . ' btn-sidenav" href="' . esc_url($scisco_btn_url) . '" >' . esc_html($scisco_btn_text) . '</a>';
        }
        ?>
      </div>
    </div>
</nav>