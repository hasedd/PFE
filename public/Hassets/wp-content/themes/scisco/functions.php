<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

require_once ( get_template_directory() . '/includes/functions.php' );

/* BOOTSTRAP */
require_once ( get_template_directory() . '/includes/bs4pagination.php' );
require_once ( get_template_directory() . '/includes/bs4breadcrumb.php' );

/* ELEMENTOR */
require_once ( get_template_directory() . '/includes/elementor.php' );

/* KIRKI */
if (class_exists( 'Kirki' )) {
    require_once ( get_template_directory() . '/includes/kirki.php' );
}

/* META BOXES */
if ( defined( 'CMB2_LOADED' ) ) {
    require_once ( get_template_directory() . '/includes/meta-boxes.php' );
}

/* WOOCOMMERCE */
if ( class_exists( 'woocommerce' ) ) {
    require_once ( get_template_directory() . '/includes/woo-functions.php' );
}

/* ANSPRESS */
if (class_exists( 'AnsPress' )) {
    require_once ( get_template_directory() . '/includes/anspress.php' );
}