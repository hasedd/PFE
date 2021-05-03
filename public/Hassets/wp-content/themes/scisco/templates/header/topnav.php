<?php 
$current_user = wp_get_current_user();
$current_user_id = get_current_user_id();
$dropdown_menu_align = 'dropdown-menu-right';
if (is_rtl()) {
  $dropdown_menu_align = 'dropdown-menu-left';
}
?>
<!-- Mobile Header -->
<div id="scisco-mobile-logo-wrapper">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-between">
      <div class="col-auto">
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
      <div class="col-auto">
        <div id="scisco-mobile-logo-toggler" class="sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Topnav -->
<nav id="scisco-topnav" class="navbar navbar-top navbar-expand navbar-dark border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form id="navbar-search-main" class="navbar-search navbar-search-dark form-inline mr-sm-3" role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
        <div class="form-group mb-0">
          <div class="input-group input-group-merge">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <?php if (class_exists( 'AnsPress' )) { ?>
            <input class="form-control autocomplete-questions" placeholder="<?php esc_attr_e('Search questions...', 'scisco'); ?>" type="text" name="s">
            <input type="hidden" name="post_type" value="question" />
            <?php } else { ?>
            <input class="form-control autocomplete-posts" placeholder="<?php esc_attr_e('Enter a keyword...', 'scisco'); ?>" type="text" name="s">  
            <?php } ?>
          </div>
        </div>
        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </form>
      <ul class="navbar-nav align-items-center ml-md-auto">
        <li class="nav-item d-sm-none">
          <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
          <i class="fas fa-search"></i>
          </a>
        </li>
        <?php if ( class_exists( 'woocommerce' ) ) { ?>
        <li id="scisco-woo-dropdown" class="nav-item dropdown woocommerce">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-shopping-cart"></i>
            <div id="scisco-cart-indicator">
            <?php if (! WC()->cart->is_empty()) { ?>
              <span class="scisco-unread-icon"></span>
            <?php } ?>
            </div>
          </a>
          <div class="scisco-dark-dropdown dropdown-menu dropdown-menu-xl py-0 overflow-hidden <?php echo esc_attr($dropdown_menu_align); ?>">
            <div id="scisco-mini-cart">
              <?php woocommerce_mini_cart(); ?>
            </div>
            <?php if (WC()->cart->is_empty()) { ?>
            <a href="<?php echo esc_url(wc_get_page_permalink( 'shop' )); ?>" class="scisco-dropdown-all dropdown-item text-center font-weight-bold py-3"><?php esc_html_e( 'Go to shop', 'scisco'); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
            <?php } ?>
          </div>
        </li>
        <?php } ?>
        <?php if (is_user_logged_in()) { ?>
        <?php if (function_exists( 'ap_count_unseen_notifications' )) { 
          $ap_opt = ap_opt();
          $notifications = new \AnsPress\Notifications( [ 'user_id' => $current_user_id ] );
          $notification_counter = 0;
          $max_notification = 5;
          $count_unseen = ap_count_unseen_notifications();
        ?>
        <li id="scisco-notification-dropdown" class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <?php if (0 < $count_unseen) { ?>
            <span class="scisco-unread-icon"></span>
          <?php } ?>
          </a>
          <div class="scisco-dark-dropdown dropdown-menu dropdown-menu-xl py-0 overflow-hidden <?php echo esc_attr($dropdown_menu_align); ?>">
            <?php
            if (0 < $count_unseen) {
                while ( ($notifications->have()) and ($notification_counter < $max_notification) ) {
                    $notifications->the_notification();
                    if ($notifications->object->noti_seen == 0) {
                        $notifications->item_template();
                        $notification_counter++;
                    }
                }
            } else {
                echo '<div class="scisco-dropdown-alert">' . esc_html__( 'You have no unseen notification.', 'scisco') . '</div>';
            }
            ?>
            <a href="<?php echo esc_url(ap_user_link($current_user_id) . $ap_opt['user_page_slug_notifications']); ?>" class="scisco-dropdown-all dropdown-item text-center font-weight-bold py-3"><?php esc_html_e( 'View All', 'scisco'); ?>  <i class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </li>
        <?php } ?>
        <?php if (class_exists('Front_End_Pm')) { ?>
        <li id="scisco-messages-dropdown" class="nav-item dropdown">
          <?php $scisco_messages_page_slug = get_theme_mod('scisco_ap_messages_slug', 'messages'); ?>
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope"></i>
          <?php $message_number = fep_get_new_message_number(); ?>
          <?php if ($message_number && 0 < $message_number) { ?>
            <span class="scisco-unread-icon"></span>
          <?php } ?>
          </a>
          <div class="scisco-dark-dropdown dropdown-menu dropdown-menu-xl py-0 overflow-hidden <?php echo esc_attr($dropdown_menu_align); ?>">
            <?php
            if ($message_number && 0 < $message_number) { 
              $box_content = Fep_Messages::init()->user_messages();
              if ($box_content->have_messages()) {
                  while ($box_content->have_messages()) {
                    $box_content->the_message();
                    if ( ! fep_is_read() ) {
                    if ( 'announcement' === fep_get_message_field( 'mgs_type' ) ) :
                      ?>
                      <div id="fep-announcement-<?php echo fep_get_the_id(); ?>" class="fep-dropdown-item">
                        <div class="fep-dropdown-avatar">
                          <?php Fep_Messages::init()->get_column_content( 'avatar' ); ?>
                        </div>
                        <div class="fep-dropdown-info">
                          <div class="fep-dropdown-author">
                            <?php Fep_Messages::init()->get_column_content( 'author' ); ?>
                          </div>
                          <div class="fep-dropdown-title">
                            <?php Fep_Messages::init()->get_column_content( 'title' ); ?>
                          </div>
                        </div>
                      </div>
                    <?php elseif ( 'message' === fep_get_message_field( 'mgs_type' ) ) : ?>
                      <div id="fep-message-<?php echo fep_get_the_id(); ?>" class="fep-dropdown-item">
                          <div class="fep-dropdown-avatar">
                            <?php Fep_Messages::init()->get_column_content( 'avatar' ); ?>
                          </div>
                          <div class="fep-dropdown-info">
                            <div class="fep-dropdown-author">
                              <?php Fep_Messages::init()->get_column_content( 'author' ); ?>
                            </div>
                            <div class="fep-dropdown-title">
                              <?php Fep_Messages::init()->get_column_content( 'title' ); ?>
                            </div>
                          </div>
                      </div>
                    <?php endif; ?>
                    <?php
                    }
                  }
              } else {
                  echo '<div class="scisco-dropdown-alert">' . esc_html__( 'You have no message.', 'scisco') . '</div>';
              }
            } else {
              echo '<div class="scisco-dropdown-alert">' . esc_html__( 'You have no unread message.', 'scisco') . '</div>';
            }
            ?>
            <?php if (function_exists('ap_user_link')) { ?>
            <a href="<?php echo esc_url(ap_user_link($current_user_id) . $scisco_messages_page_slug); ?>" class="scisco-dropdown-all dropdown-item text-center font-weight-bold py-3"><?php esc_html_e( 'View All', 'scisco'); ?>  <i class="fas fa-long-arrow-alt-right"></i></a>
            <?php } ?>
          </div>
        </li>
        <?php } ?>
        <?php } ?>
      </ul>
      <?php if (is_user_logged_in()) { ?>
      <ul id="scisco-navbar-user-icon" class="navbar-nav align-items-center ml-auto ml-md-0">
        <?php if (function_exists('ap_user_link')) { ?>
        <li id="scisco-profile-dropdown" class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <?php echo get_avatar( $current_user_id, 80 ); ?>
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 font-weight-bold"><?php echo esc_html($current_user->display_name); ?></span>
              </div>
            </div>
          </a>
          <div class="scisco-dark-dropdown dropdown-menu py-0 overflow-hidden <?php echo esc_attr($dropdown_menu_align); ?>">
            <a href="<?php echo esc_url(ap_user_link($current_user_id)); ?>" class="dropdown-item"><i class="fas fa-user-alt"></i><?php esc_html_e( 'Profile', 'scisco'); ?></a>
            <?php do_action('scisco_user_menu_items'); ?>
            <a href="<?php echo esc_url(wp_logout_url()); ?>" class="dropdown-item"><i class="fas fa-sign-out-alt"></i><?php esc_html_e( 'Logout', 'scisco'); ?></a>
          </div>
        </li>
        <?php } else { ?>
        <li id="scisco-profile-dropdown" class="nav-item">
          <a class="nav-link pr-0" href="<?php echo esc_url(get_edit_profile_url($current_user_id)); ?>" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <?php echo get_avatar( $current_user_id, 80 ); ?>
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 font-weight-bold"><?php echo esc_html($current_user->display_name); ?></span>
              </div>
            </div>
          </a>
        </li>
        <?php } ?>
      </ul>
      <?php } else { 
      $guest_text = get_theme_mod('scisco_guest_text', esc_html__( 'Welcome, guest', 'scisco')); 
      $enable_login = get_theme_mod('scisco_enable_login', 1); 
      $login_text = get_theme_mod('scisco_login_text', esc_html__( 'Login', 'scisco'));
      $login_url = get_theme_mod('scisco_login_url');
      if (empty($login_url)) {
        $login_url = wp_login_url();
      }
      $enable_register = get_theme_mod('scisco_enable_register', 1); 
      $register_text = get_theme_mod('scisco_register_text', esc_html__( 'Register', 'scisco'));
      $register_url = get_theme_mod('scisco_register_url');
      if (empty($register_url)) {
        $register_url = wp_registration_url();
      }
      $enable_lost = get_theme_mod('scisco_enable_lost', 1); 
      $lost_text = get_theme_mod('scisco_lost_text', esc_html__( 'Lost Password?', 'scisco'));
      $lost_url = get_theme_mod('scisco_lost_url');
      if (empty($lost_url)) {
        $lost_url = wp_lostpassword_url();
      }
      ?>
      <ul id="scisco-navbar-user-icon" class="navbar-nav align-items-center ml-auto ml-md-0">
        <li id="scisco-profile-dropdown" class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
              <?php 
              $default_avatar = get_theme_mod('scisco_default_avatar'); 
              if (empty($default_avatar)) {
                $default_avatar = get_template_directory_uri() . '/images/avatar.png';
              }
              ?>
              <img class="avatar" src="<?php echo esc_url($default_avatar); ?>" alt="<?php echo esc_attr($guest_text); ?>" />
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 font-weight-bold"><?php echo esc_html($guest_text); ?></span>
              </div>
            </div>
          </a>
          <?php if ($enable_login || $enable_register || $enable_lost) { ?>
          <div class="scisco-dark-dropdown dropdown-menu py-0 overflow-hidden <?php echo esc_attr($dropdown_menu_align); ?>">
            <?php if ($enable_login) { ?>
            <a class="dropdown-item" href="<?php echo esc_url($login_url); ?>"><i class="fas fa-sign-in-alt"></i><?php echo esc_html($login_text); ?></a>
            <?php } ?>
            <?php if (get_option( 'users_can_register' ) && $enable_register) { ?>
            <a class="dropdown-item" href="<?php echo esc_url($register_url); ?>"><i class="fas fa-user-plus"></i><?php echo esc_html($register_text); ?></a>
            <?php } ?>
            <?php if ($enable_lost) { ?>
            <a class="dropdown-item" href="<?php echo esc_url($lost_url); ?>"><i class="fas fa-lock"></i><?php echo esc_html($lost_text); ?></a>
            <?php } ?>
            <?php do_action('scisco_guest_menu_items'); ?>
          </div>
          <?php } ?>
        </li>
      </ul>
      <?php } ?>
    </div>
  </div>
</nav>