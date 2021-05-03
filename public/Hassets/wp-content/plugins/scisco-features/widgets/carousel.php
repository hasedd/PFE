<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Carousel extends Widget_Base {

	public function get_name() {
		return 'scisco-carousel';
	}

	public function get_title() {
		return esc_html__( 'Scisco Post Carousel', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
    }
    
    public function get_style_depends(){
		return [ 'scisco-slick' ];
	}
    
    public function get_script_depends() {
		return [ 'scisco-slick' ];
	}
    
    public function get_widget_taxonomies() {
        $output_terms = array();
        $args = array (
            'taxonomy' => array('category'),
            'hide_empty' => 1
        );
        $terms = get_terms($args);
        foreach($terms as $term) {
            $output_terms[$term->term_id] = $term->name;
        }
        return $output_terms;
    } 

	protected function _register_controls() {
		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'three',
				'options' => [
                    'one'  => esc_html__( '1 Column', 'scisco' ),
					'two'  => esc_html__( '2 Columns', 'scisco' ),
					'three'  => esc_html__( '3 Columns', 'scisco' ),
                    'four'  => esc_html__( '4 Columns', 'scisco' ),
                    'five'  => esc_html__( '5 Columns', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
                    'DESC'  => esc_html__( 'Descending', 'scisco' ),
					'ASC'  => esc_html__( 'Ascending', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
                    'post_date'  => esc_html__( 'Date', 'scisco' ),
					'title'  => esc_html__( 'Title', 'scisco' ),
                    'menu_order'  => esc_html__( 'Menu Order', 'scisco' ),
					'rand'  => esc_html__( 'Random', 'scisco' ),
                    'comment_count'  => esc_html__( 'Comment Count', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'taxonomy',
			[
				'label' => esc_html__( 'Taxonomy', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'default' => '',
                'options' => $this->get_widget_taxonomies(),
                'label_block' => true
			]
		);
        
        $this->add_control(
			'max',
			[
				'label' => esc_html__( 'Maximum number of posts', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 99,
				'step' => 1,
				'default' => 6,
			]
		);
        
        $this->add_control(
			'exclude', [
				'label' => esc_html__( 'Exclude posts by ID', 'scisco' ),
                'description' => esc_html__( 'To exclude multiple posts, add comma between IDs.', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);

		$this->end_controls_section();
        
        $this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Widget Title', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'heading', [
				'label' => esc_html__( 'Heading', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
		);
        
        $this->add_control(
			'heading_level',
			[
				'label' => esc_html__( 'Heading Level', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
                    'h1'  => esc_html__( 'Heading 1', 'scisco' ),
                    'h2'  => esc_html__( 'Heading 2', 'scisco' ),
                    'h3'  => esc_html__( 'Heading 3', 'scisco' ),
                    'h4'  => esc_html__( 'Heading 4', 'scisco' ),
                    'h5'  => esc_html__( 'Heading 5', 'scisco' ),
                    'h6'  => esc_html__( 'Heading 6', 'scisco' )
				],
			]
        );
        
        $this->add_control(
			'title_border', [
				'label' => esc_html__( 'Add Border', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'scisco' ),
				'label_off' => esc_html__( 'No', 'scisco' ),
				'return_value' => 'highlighted-title',
				'default' => '',
				'show_label' => true,
			]
		);
        
        $this->end_controls_section();

	}
    
    protected function render() {
        $widget_id = $this->get_id();
		$settings = $this->get_settings_for_display();
        
        $max = $settings['max'];
        $order = $settings['order'];
        $orderby = $settings['orderby'];
        $terms = $settings['taxonomy'];
        $taxonomy = 'category';
        
        if ($settings['exclude']) {
            $exclude = explode( ',', $settings['exclude'] );
        } else {
            $exclude = array();
        }
        
        if ($terms) {
            $custom_query = new WP_Query( 
            array(
                'post_type' => 'post', 
                'post_status' => 'publish',
                'posts_per_page' => $max,
                'order' => $order,
                'orderby' => $orderby,
                'post__not_in' => $exclude,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $terms,
                    )
                ),
            ));
        } else {
            $custom_query = new WP_Query( 
            array(
                'post_type' => 'post', 
                'post_status' => 'publish',
                'posts_per_page' => $max,
                'order' => $order,
                'orderby' => $orderby,
                'post__not_in' => $exclude
            ));
        }
        if ($custom_query->have_posts()) {
        ?>
        <?php if ($settings['heading']) { ?>
        <<?php echo $settings['heading_level']; ?> class="scisco-carousel-title <?php echo $settings['title_border']; ?>">
            <span><?php echo $settings['heading']; ?></span>
        </<?php echo $settings['heading_level']; ?>>
        <?php } ?>
        <div class="scisco-carousel-container">  
            <div id="scisco-post-carousel-<?php echo esc_attr($widget_id) ?>" class="scisco-carousel">
                <?php
                while($custom_query->have_posts()) : $custom_query->the_post();
                    get_template_part( 'templates/postsm', 'template');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
<div class="clearfix"></div>
<script type="text/javascript">
(function ($) {
"use strict";    
$(document).ready(function () {
    $('#scisco-post-carousel-<?php echo esc_js($widget_id) ?>').slick({
        infinite: false,
        slidesToScroll: 1,
        <?php if ( is_rtl() ) { ?>
        rtl: true,
        <?php } ?>
        arrows: true,
        dots : false,
        <?php if ($settings['columns'] == 'one') { ?>
        adaptiveHeight: true,
        slidesToShow: 1
        <?php } else if ($settings['columns'] == 'two') { ?>
        slidesToShow: 2,
        responsive: [{breakpoint: 576,settings: {slidesToShow: 1}}]
        <?php } else if ($settings['columns'] == 'three') { ?>
        slidesToShow: 3,
        responsive: [{breakpoint: 1200,settings: {slidesToShow: 2}},{breakpoint: 768,settings: {slidesToShow: 1}}]
        <?php } else if ($settings['columns'] == 'four') { ?>
        slidesToShow: 4,
        responsive: [{breakpoint: 1200,settings: {slidesToShow: 3}},{breakpoint: 992,settings: {slidesToShow: 2}},{breakpoint: 768,settings: {slidesToShow: 1}}]        
        <?php } else { ?>
        slidesToShow: 5,
        responsive: [{breakpoint: 1440,settings: {slidesToShow: 4}},{breakpoint: 1200,settings: {slidesToShow: 3}},{breakpoint: 992,settings: {slidesToShow: 2}},{breakpoint: 768,settings: {slidesToShow: 1}}]
        <?php } ?>                                                                      
    });
    $('#scisco-post-carousel-<?php echo esc_js($widget_id ) ?>').css('opacity', '1');
});
})(jQuery);        
</script>


	<?php } else { ?>
    <div class="alert alert-danger"><?php esc_html_e( 'Nothing was found!', 'scisco' ); ?></div>         
<?php } ?>
<?php }
}
?>