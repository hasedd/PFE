<?php
namespace Elementorscisco;

class sciscoLoadElementor {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function widget_styles() {
		wp_register_style('scisco-slick' , plugins_url( '/css/slick.css', __FILE__ ), false, '1.0' );
		wp_register_style('scisco-flip_box' , plugins_url( '/css/flip_box.css', __FILE__ ), false, '1.0' );
		wp_register_style('scisco-heading' , plugins_url( '/css/heading.css', __FILE__ ), false, '1.0' );
	}

	public function widget_scripts() {
		wp_register_script( 'scisco-elementor-masonry', plugins_url( '/js/masonry.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'scisco-slick', plugins_url( '/js/slick.min.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/heading.php' );
		require_once( __DIR__ . '/widgets/flip_box.php' );
		require_once( __DIR__ . '/widgets/questions.php' );
		require_once( __DIR__ . '/widgets/ask.php' );
        require_once( __DIR__ . '/widgets/masonry.php' );
		require_once( __DIR__ . '/widgets/carousel.php' );
		require_once( __DIR__ . '/widgets/usercarousel.php' );
		require_once( __DIR__ . '/widgets/iconbox.php' );
		require_once( __DIR__ . '/widgets/button.php' );
        require_once( __DIR__ . '/widgets/alert.php' );
	}

	public function register_widgets() {
		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Flip_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Questions() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Ask() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Masonry() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_User_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\scisco_Alert() );
		
	}

	public function include_controls() {
		require_once( 'fileselect-control.php' );
		\Elementor\Plugin::$instance->controls_manager->register_control( 'scisco-file-select', new \Scisco_FileSelect_Control() );
	}

	public function include() {
		include_once( 'shape_dividers.php' );
	}

	public function __construct() {
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( "elementor/frontend/after_enqueue_styles", [ $this, 'widget_styles' ], 10, 1 );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'include_controls' ] );
		add_action( 'elementor/init', [ $this, 'include' ] );
	}
}

sciscoLoadElementor::instance();
?>