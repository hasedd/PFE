<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'scisco-iconbox';
	}

	public function get_title() {
		return esc_html__( 'Scisco Icon Box', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Icon Box', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'scisco' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-facebook',
					'library' => 'brand',
				],
			]
		);
		
		$this->add_control(
			'title_source',
			[
				'label' => esc_html__( 'Title Source', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
                    'text'  => esc_html__( 'Custom Title', 'scisco' ),
					'statistic'  => esc_html__( 'Statistic', 'scisco' )
				],
			]
		);

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Title here...', 'scisco' ),
				'condition' => ['title_source' => 'text']
			]
		);

		$this->add_control(
			'statistic',
			[
				'label' => esc_html__( 'Statistic', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'posts',
				'options' => [
                    'posts' => esc_html__( 'Posts', 'scisco' ),
                    'comments' => esc_html__( 'Comments', 'scisco' ),
					'users' => esc_html__( 'Registered Users', 'scisco' ),
					'questions' => esc_html__( 'Questions', 'scisco' ),
					'answers' => esc_html__( 'Answers', 'scisco' ),
					'solved' => esc_html__( 'Solved Questions', 'scisco' ),
				],
				'condition' => ['title_source' => 'statistic']
			]
		);
        
        $this->add_control(
			'info',
			[
				'label' => esc_html__( 'Info', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor...', 'scisco' )
			]
		);

		$this->end_controls_section();  

		$this->start_controls_section(
			'section_icon_box_style',
			[
				'label' => esc_html__( 'Icon Box', 'scisco' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0A48B3',
				'selectors' => [
					'{{WRAPPER}} .scisco-user-box' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__( 'Border', 'scisco' ),
				'selector' => '{{WRAPPER}} .scisco-user-box'
			]
		);
        
        $this->add_responsive_control(
			'box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'scisco' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .scisco-user-box' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-right-radius: {{BOTTOM}}{{UNIT}};border-bottom-left-radius: {{LEFT}}{{UNIT}};'
				]
			]
		);
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'scisco' ),
				'selector' => '{{WRAPPER}} .scisco-user-box'
			]
		);

		$this->add_control(
			'box_hr_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'heading_level',
			[
				'label' => esc_html__( 'Heading Level', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
                    'h1'  => esc_html__( 'Heading 1', 'scisco' ),
                    'h2'  => esc_html__( 'Heading 2', 'scisco' ),
                    'h3'  => esc_html__( 'Heading 3', 'scisco' ),
                    'h4'  => esc_html__( 'Heading 4', 'scisco' ),
                    'h5'  => esc_html__( 'Heading 5', 'scisco' ),
					'h6'  => esc_html__( 'Heading 6', 'scisco' ),
					'p'  => esc_html__( 'p', 'scisco' ),
					'span'  => esc_html__( 'span', 'scisco' )
				],
			]
        );

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-box-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'scisco' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
                    '{{WRAPPER}} .icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'box_hr_2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'info_level',
			[
				'label' => esc_html__( 'Info Level', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
                    'h1'  => esc_html__( 'Heading 1', 'scisco' ),
                    'h2'  => esc_html__( 'Heading 2', 'scisco' ),
                    'h3'  => esc_html__( 'Heading 3', 'scisco' ),
                    'h4'  => esc_html__( 'Heading 4', 'scisco' ),
                    'h5'  => esc_html__( 'Heading 5', 'scisco' ),
					'h6'  => esc_html__( 'Heading 6', 'scisco' ),
					'p'  => esc_html__( 'p', 'scisco' ),
					'span'  => esc_html__( 'span', 'scisco' )
				],
			]
        );

		$this->add_control(
			'info_color',
			[
				'label' => esc_html__( 'Info Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .icon-box-info' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .icon-box-info',
			]
		);

		$this->add_responsive_control(
			'info_padding',
			[
				'label' => esc_html__( 'Info Padding', 'scisco' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors' => [
                    '{{WRAPPER}} .scisco-user-box-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'box_hr_3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .scisco-user-box-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .scisco-user-box-icon svg' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => 24,
                'selectors' => [
					'{{WRAPPER}} .scisco-user-box-icon svg' => 'width: {{VALUE}}px;',
					'{{WRAPPER}} .scisco-user-box-icon' => 'font-size: {{VALUE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'icon_container_width',
			[
				'label' => esc_html__( 'Icon Container Width', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => 64,
                'selectors' => [
					'{{WRAPPER}} .scisco-user-box-icon' => 'min-width: {{VALUE}}px;'
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Icon Border Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.2)',
				'selectors' => [
					'{{WRAPPER}} .scisco-user-box-icon' => 'border-color: {{VALUE}};'
				]
			]
		);
       
		$this->end_controls_section();
	}
    
    protected function render() {
		$settings = $this->get_settings_for_display();
		if ($settings['title_source'] == 'text') {
			$title = $settings['title'];
		} else {
			$title = 0;
			if ($settings['statistic'] == 'posts') {
				$title = scisco_post_count();
			} elseif ($settings['statistic'] == 'comments') {
				$title = scisco_comment_count();
			} elseif ($settings['statistic'] == 'users') {
				$title = scisco_user_count();
			} elseif ($settings['statistic'] == 'questions') {
				$title = ap_total_published_questions();
			} elseif ($settings['statistic'] == 'answers') {
				$title = scisco_total_published_answers();
			} elseif ($settings['statistic'] == 'solved') {
				$title = ap_total_solved_questions();
			}
		}
        ?>
		<div class="scisco-user-box">
			<div class="scisco-user-box-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<div class="scisco-user-box-info">
			<<?php echo $settings['heading_level']; ?> class="icon-box-title"><?php echo esc_html($title); ?></<?php echo $settings['heading_level']; ?>>
				<<?php echo $settings['info_level']; ?> class="icon-box-info"><?php echo wp_kses_post($settings['info']); ?></<?php echo $settings['info_level']; ?>>
			</div>
		</div>
	<?php }

}
?>