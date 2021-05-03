<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Section_scisco_shape_divider {

    protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
    }
    
    public function __construct() {
		$this->init_hooks();
	}

    public static function init_hooks() {
        add_action( 'elementor/element/section/section_layout/after_section_end', [__CLASS__, 'add_section'] );
    }
    
    public static function add_section( Element_Base $element ) {

        $element->start_controls_section(
            '_section_shape_divider',
            [
                'label' => esc_html__( 'Scisco Shape Divider', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $element->start_controls_tabs( 'tabs_divider_style' );
        
        $element->start_controls_tab(
			'tab_divider_top',
			[
				'label' => esc_html__( 'TOP', 'scisco'),
			]
        );
        
        $element->add_control(
			'scisco_shape_divider_top',
			[
                'label' => esc_html__( 'Type', 'scisco' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    'none' => esc_html__( 'None', 'scisco' ),
                    'basic-triangle' => esc_html__( 'Basic Triangle', 'scisco' ),
                    'big-round' => esc_html__( 'Big Round', 'scisco' ),
                    'book' => esc_html__( 'Book', 'scisco' ),
                    'bubbles' => esc_html__( 'Bubbles', 'scisco' ), 
                    'christmas-trees' => esc_html__( 'Christmas Trees', 'scisco' ),
                    'clouds' => esc_html__( 'Clouds', 'scisco' ),
                    'faded-clouds' => esc_html__( 'Faded Clouds', 'scisco' ),
                    'faded-loops' => esc_html__( 'Faded Loops', 'scisco' ),
                    'faded-slant' => esc_html__( 'Faded Slant', 'scisco' ),
                    'faded-triangle' => esc_html__( 'Faded Triangle', 'scisco' ),
                    'fall-leaves' => esc_html__( 'Fall Leaves', 'scisco' ),
                    'fire' => esc_html__( 'Fire', 'scisco' ),
                    'half-sphere' => esc_html__( 'Half Sphere', 'scisco' ),
                    'iceberg' => esc_html__( 'Iceberg', 'scisco' ),
                    'mountain' => esc_html__( 'Mountain', 'scisco' ),
                    'paint-brush' => esc_html__( 'Paint Brush', 'scisco' ),
                    'paint-drip' => esc_html__( 'Paint Drip', 'scisco' ),
                    'pyramid' => esc_html__( 'Pyramid', 'scisco' ),
                    'rough-edges' => esc_html__( 'Rough Edges', 'scisco' ),
                    'sharp-paper' => esc_html__( 'Sharp Paper', 'scisco' ),
                    'sharp-slants' => esc_html__( 'Sharp Slants', 'scisco' ),
                    'shredded-paper' => esc_html__( 'Shredded Paper', 'scisco' ),
                    'side-triangle' => esc_html__( 'Side Triangle', 'scisco' ),
                    'slant' => esc_html__( 'Slant', 'scisco' ),
                    'slant-down' => esc_html__( 'Slant Down', 'scisco' ),
                    'slant-up' => esc_html__( 'Slant Up', 'scisco' ),
                    'small-triangles' => esc_html__( 'Small Triangles', 'scisco' ),
                    'snowflakes' => esc_html__( 'Snowflakes', 'scisco' ),
                    'three-triangles' => esc_html__( 'Three Triangles', 'scisco' ),
                    'tri-triangle' => esc_html__( 'Tri Triangle', 'scisco' ),
                    'triangle-dent' => esc_html__( 'Triangle Dent', 'scisco' ),
                    'triangle-uneven' => esc_html__( 'Triangle Uneven', 'scisco' ),
                    'wavy-dashed' => esc_html__( 'Wavy Dashed', 'scisco' ),
                    'wavy-loops' => esc_html__( 'Wavy Loops', 'scisco' ),
                    'wavy-motion' => esc_html__( 'Wavy Motion', 'scisco' ),
                    'custom' => esc_html__( 'Custom', 'scisco' )
				],
                'default' => 'none',
                'frontend_available' => true
			]
        );

        $element->add_control(
			'scisco_shape_divider_top_custom',
			[
				'label' => esc_html__( 'Select File', 'scisco' ),
				'type'	=> 'scisco-file-select',
				'placeholder' => esc_html__( 'URL to File', 'scisco' ),
                'default' => plugin_dir_url( __FILE__ ) . 'dividers/big-round-top.svg',
                'condition' => [
                    'scisco_shape_divider_top' => 'custom'
                ],
                'frontend_available' => true
			]
        );
        
        $element->add_control(
			'scisco_shape_divider_top_color',
			[
				'label' => esc_html__( 'Color', 'scisco' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'frontend_available' => true,
                'condition' => [
                    'scisco_shape_divider_top!' => 'none'
                ]
			]
        );

        $element->add_control(
            'scisco_shape_divider_top_width',
            [
                'label' => esc_html__( 'Width (%)', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                        'step' => 1
                    ]
                ],
                'condition' => [
                    'scisco_shape_divider_top!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_top_height',
            [
                'label' => esc_html__( 'Height (px)', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1
                    ]
                ],
                'condition' => [
                    'scisco_shape_divider_top!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_top_flip',
            [
                'label' => esc_html__( 'Flip', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'scisco_shape_divider_top!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_top_zindex',
            [
                'label' => esc_html__( 'Z-index', 'scisco' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => -1,
                'condition' => [
                    'scisco_shape_divider_top!' => 'none'
                ],
                'frontend_available' => true
            ]
        );
        
        $element->end_controls_tab();

		$element->start_controls_tab(
			'tab_divider_bottom',
			[
				'label' => esc_html__( 'BOTTOM', 'scisco'),
			]
		);

        $element->add_control(
			'scisco_shape_divider_bottom',
			[
                'label' => esc_html__( 'Type', 'scisco' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'scisco' ),
                    'basic-triangle' => esc_html__( 'Basic Triangle', 'scisco' ),
                    'big-round' => esc_html__( 'Big Round', 'scisco' ),
                    'book' => esc_html__( 'Book', 'scisco' ),
                    'bubbles' => esc_html__( 'Bubbles', 'scisco' ), 
                    'christmas-trees' => esc_html__( 'Christmas Trees', 'scisco' ),
                    'city-skyline' => esc_html__( 'City Skyline', 'scisco' ),
                    'clouds' => esc_html__( 'Clouds', 'scisco' ),
                    'faded-clouds' => esc_html__( 'Faded Clouds', 'scisco' ),
                    'faded-loops' => esc_html__( 'Faded Loops', 'scisco' ),
                    'faded-slant' => esc_html__( 'Faded Slant', 'scisco' ),
                    'faded-triangle' => esc_html__( 'Faded Triangle', 'scisco' ),
                    'fall-leaves' => esc_html__( 'Fall Leaves', 'scisco' ),
                    'fire' => esc_html__( 'Fire', 'scisco' ),
                    'half-sphere' => esc_html__( 'Half Sphere', 'scisco' ),
                    'iceberg' => esc_html__( 'Iceberg', 'scisco' ),
                    'mountain' => esc_html__( 'Mountain', 'scisco' ),
                    'music-notes' => esc_html__( 'Music Notes', 'scisco' ),
                    'paint-brush' => esc_html__( 'Paint Brush', 'scisco' ),
                    'paint-drip' => esc_html__( 'Paint Drip', 'scisco' ),
                    'pyramid' => esc_html__( 'Pyramid', 'scisco' ),
                    'rough-edges' => esc_html__( 'Rough Edges', 'scisco' ),
                    'sharp-paper' => esc_html__( 'Sharp Paper', 'scisco' ),
                    'sharp-slants' => esc_html__( 'Sharp Slants', 'scisco' ),
                    'shredded-paper' => esc_html__( 'Shredded Paper', 'scisco' ),
                    'side-triangle' => esc_html__( 'Side Triangle', 'scisco' ),
                    'slant' => esc_html__( 'Slant', 'scisco' ),
                    'slant-down' => esc_html__( 'Slant Down', 'scisco' ),
                    'slant-up' => esc_html__( 'Slant Up', 'scisco' ),
                    'small-triangles' => esc_html__( 'Small Triangles', 'scisco' ),
                    'snowflakes' => esc_html__( 'Snowflakes', 'scisco' ),
                    'three-triangles' => esc_html__( 'Three Triangles', 'scisco' ),
                    'tri-triangle' => esc_html__( 'Tri Triangle', 'scisco' ),
                    'triangle-dent' => esc_html__( 'Triangle Dent', 'scisco' ),
                    'triangle-uneven' => esc_html__( 'Triangle Uneven', 'scisco' ),
                    'wavy-dashed' => esc_html__( 'Wavy Dashed', 'scisco' ),
                    'wavy-loops' => esc_html__( 'Wavy Loops', 'scisco' ),
                    'wavy-motion' => esc_html__( 'Wavy Motion', 'scisco' ),
                    'custom' => esc_html__( 'Custom', 'scisco' )
				],
                'default' => 'none',
                'frontend_available' => true
			]
        );

        $element->add_control(
			'scisco_shape_divider_bottom_custom',
			[
				'label' => esc_html__( 'Select File', 'scisco' ),
				'type'	=> 'scisco-file-select',
				'placeholder' => esc_html__( 'URL to File', 'scisco' ),
                'default' => plugin_dir_url( __FILE__ ) . 'dividers/big-round-bottom.svg',
                'condition' => [
                    'scisco_shape_divider_bottom' => 'custom'
                ],
                'frontend_available' => true
			]
        );

        $element->add_control(
			'scisco_shape_divider_bottom_color',
			[
				'label' => esc_html__( 'Color', 'scisco' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'frontend_available' => true,
                'condition' => [
                    'scisco_shape_divider_bottom!' => 'none'
                ]
			]
        );

        $element->add_control(
            'scisco_shape_divider_bottom_width',
            [
                'label' => esc_html__( 'Width (%)', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 100
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                        'step' => 1
                    ]
                ],
                'condition' => [
                    'scisco_shape_divider_bottom!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_bottom_height',
            [
                'label' => esc_html__( 'Height (px)', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1
                    ]
                ],
                'condition' => [
                    'scisco_shape_divider_bottom!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_bottom_flip',
            [
                'label' => esc_html__( 'Flip', 'scisco' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'scisco_shape_divider_bottom!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->add_control(
            'scisco_shape_divider_bottom_zindex',
            [
                'label' => esc_html__( 'Z-index', 'scisco' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => -1,
                'condition' => [
                    'scisco_shape_divider_bottom!' => 'none'
                ],
                'frontend_available' => true
            ]
        );

        $element->end_controls_tab();
        $element->end_controls_tabs();

        $element->end_controls_section();
        
    }
}

Section_scisco_shape_divider::instance();