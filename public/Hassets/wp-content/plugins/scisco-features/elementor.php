<?php
if ( ! defined( 'ABSPATH' ) ) exit;

final class Scisco_Elementor_Class {

	const VERSION = '1.2.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.4';

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function init() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		require_once( 'load-elementor.php' );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'scisco' ),
			'<strong>' . esc_html__( 'Scisco Features', 'scisco' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'scisco' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'scisco' ),
			'<strong>' . esc_html__( 'Scisco Features', 'scisco' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'scisco' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'scisco' ),
			'<strong>' . esc_html__( 'Scisco Features', 'scisco' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'scisco' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

new Scisco_Elementor_Class();
?>