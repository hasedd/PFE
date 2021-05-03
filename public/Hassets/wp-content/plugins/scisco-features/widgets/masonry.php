<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Masonry extends Widget_Base {

	public function get_name() {
		return 'scisco-masonry';
	}

	public function get_title() {
		return esc_html__( 'Scisco Masonry', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-gallery-masonry';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
	}
    
    public function get_script_depends() {
		return [ 'scisco-elementor-masonry' ];
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
				'default' => 'three-columns',
				'options' => [
                    'one-column'  => esc_html__( '1 Column', 'scisco' ),
					'two-columns'  => esc_html__( '2 Columns', 'scisco' ),
					'three-columns'  => esc_html__( '3 Columns', 'scisco' ),
                    'four-columns'  => esc_html__( '4 Columns', 'scisco' ),
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
				'label_block' => true,
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
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'scisco' ),
				'label_off' => esc_html__( 'OFF', 'scisco' ),
				'return_value' => 'yes',
				'default' => ''
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
		$settings = $this->get_settings_for_display(); 
		if ( get_query_var( 'paged' ) ) { $scisco_paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page' ) ) { $scisco_paged = get_query_var( 'page' ); } else { $scisco_paged = 1; }   
        $taxonomy = 'category';
        
        $max = $settings['max'];
        $order = $settings['order'];
        $orderby = $settings['orderby'];
        $terms = $settings['taxonomy'];
        
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
				'paged' => $scisco_paged,
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
				'paged' => $scisco_paged,
                'order' => $order,
                'orderby' => $orderby,
                'post__not_in' => $exclude
            ));
        }
        if ($custom_query->have_posts()) {
        ?>
        <?php if ($settings['heading']) { ?>
        <<?php echo $settings['heading_level']; ?> class="<?php echo $settings['title_border']; ?>">
            <span><?php echo $settings['heading']; ?></span>
        </<?php echo $settings['heading_level']; ?>>
        <?php } ?>
        <div class="scisco-masonry-grid2 <?php if ($settings['columns'] == 'four-columns') { echo 'small-grid'; } ?>">
        <div class="scisco-<?php echo $settings['columns']; ?>" data-columns>
            <?php
			if ($settings['columns'] != 'four-columns') {
				while($custom_query->have_posts()) : $custom_query->the_post();
					get_template_part( 'templates/post', 'template');
				endwhile;
			} else {
				while($custom_query->have_posts()) : $custom_query->the_post();
					get_template_part( 'templates/postsm', 'template');
				endwhile;
			}
            ?>
            </div>
		</div>
		<?php if ($settings['pagination']) { ?>
		<?php if ( $custom_query->max_num_pages > 1 ) : ?>
        <div class="scisco-pager">
            <?php scisco_custom_pagination($custom_query); ?>
        </div> 
        <div class="clearfix"></div>    
		<?php endif; ?>
		<?php } ?>
        <?php wp_reset_postdata(); ?>
	<?php } else { ?>
    <div class="alert alert-danger"><?php esc_html_e( 'Nothing was found!', 'scisco' ); ?></div>         
<?php } ?>
<?php }
}
?>