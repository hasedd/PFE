<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Button extends Widget_Base {

	public function get_name() {
		return 'scisco-button';
	}

	public function get_title() {
		return esc_html__( 'Scisco Button', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-button';
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
			'text', [
				'label' => esc_html__( 'Text', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'VIEW MORE', 'scisco' )
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
					'default'  => esc_html__( 'Default', 'scisco' ),
					'dark'  => esc_html__( 'Dark', 'scisco' ),
                    'white'  => esc_html__( 'White', 'scisco' ),
                    'success'  => esc_html__( 'Success', 'scisco' ),
                    'info'  => esc_html__( 'Info', 'scisco' ),
                    'warning'  => esc_html__( 'Warning', 'scisco' ),
					'danger'  => esc_html__( 'Danger', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => [
					'btn-md'  => esc_html__( 'Normal', 'scisco' ),
					'btn-lg'  => esc_html__( 'Large', 'scisco' ),
                    'btn-sm'  => esc_html__( 'Small', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link to', 'scisco' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'scisco' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        
        $this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'scisco' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'scisco' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'scisco' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'scisco' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scisco-btn-wrapper' => 'text-align: {{VALUE}};'
				],
				'toggle' => true,
			]
		);
        
       
		$this->end_controls_section();
	}
    
    protected function render() {
		$settings = $this->get_settings_for_display();
		$target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
        
        echo '<div class="scisco-btn-wrapper"><a class="btn ' . $settings['size'] . ' btn-'. $settings['style'] . '" href="' . $settings['website_link']['url'] . '"' . $target . $nofollow . '>' . $settings['text'] . '</a></div>';
	}
}
?>