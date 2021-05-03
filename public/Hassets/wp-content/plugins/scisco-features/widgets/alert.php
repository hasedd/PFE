<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Alert extends Widget_Base {

	public function get_name() {
		return 'scisco-alert';
	}

	public function get_title() {
		return esc_html__( 'Scisco Alert', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Settings', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
				'default' => esc_html__( 'Well done! You successfully read this important alert message.', 'scisco' )
			]
		);
        
        $this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => [
					'primary'  => esc_html__( 'Primary', 'scisco' ),
                    'success'  => esc_html__( 'Success', 'scisco' ),
                    'info'  => esc_html__( 'Info', 'scisco' ),
                    'warning'  => esc_html__( 'Warning', 'scisco' ),
                    'danger'  => esc_html__( 'Danger', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'dismiss', [
				'label' => esc_html__( 'Dismissible', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'scisco' ),
				'label_off' => esc_html__( 'No', 'scisco' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'show_label' => true,
			]
		);
       
		$this->end_controls_section();
	}
    
    protected function render() {
		$settings = $this->get_settings_for_display();
        
        if ($settings['dismiss']) {
            echo '<div class="alert alert-dismissible alert-' . $settings['style'] . '"><div class="close" data-dismiss="alert">&times;</div>' . $settings['text'] . '</div>';
        } else {
            echo '<div class="alert alert-' . $settings['style'] . '">' . $settings['text'] . '</div>';
        }
	}

	protected function _content_template() {
		?>
		<# if ( settings.dismiss ) { #>
        <div class="alert alert-dismissible alert-{{{ settings.style }}}"><div class="close" data-dismiss="alert">&times;</div>{{{ settings.text }}}</div>              
		<# } else { #>
        <div class="alert alert-{{{ settings.style }}}">{{{ settings.text }}}</div>     
        <# } #>    
		<?php
	}
}
?>