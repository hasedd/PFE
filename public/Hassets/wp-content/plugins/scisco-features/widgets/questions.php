<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Questions extends Widget_Base {

	public function get_name() {
		return 'scisco-questions';
	}

	public function get_title() {
		return esc_html__( 'Scisco Questions', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-commenting-o';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
    }
    
    public function get_widget_taxonomies() {
        $output_terms = array();
        if ( taxonomy_exists( 'question_category' ) ) {
            $args = array (
                'taxonomy' => array('question_category'),
                'hide_empty' => 1
            );
            $terms = get_terms($args);
            foreach($terms as $term) {
                $output_terms[$term->term_id] = $term->name;
            }
        }
        return $output_terms;
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
			'orderby',
			[
				'label' => esc_html__( 'Order by', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'active',
				'options' => [
                    'active'  => esc_html__( 'Active', 'scisco' ),
					'newest'  => esc_html__( 'Newest', 'scisco' ),
					'voted'  => esc_html__( 'Voted', 'scisco' ),
                    'answers'  => esc_html__( 'Answers', 'scisco' ),
                    'unanswered'  => esc_html__( 'Unanswered', 'scisco' )
				],
			]
        );
        
        $this->add_control(
			'taxonomy',
			[
				'label' => esc_html__( 'Category', 'scisco' ),
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
				'label' => esc_html__( 'Maximum number of questions', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 99,
				'step' => 1,
				'default' => 5,
			]
        );

        $this->add_control(
			'history',
			[
				'label' => esc_html__( 'Display history', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'scisco' ),
				'label_off' => esc_html__( 'OFF', 'scisco' ),
				'return_value' => 'yes',
				'default' => 'yes'
			]
		);
       
		$this->end_controls_section();
	}
    
    protected function render() {
        if (class_exists( 'AnsPress' )) {
            $widget_id = $this->get_id();
            $settings = $this->get_settings_for_display(); 
            $category_ids = $settings['taxonomy'];
            $limit = $settings['max'];
            $orderby = $settings['orderby'];
            
            $question_args = array(
                'showposts' 	 => $limit,
                'ap_order_by'  => $orderby,
                'paged'			   => 1,
            );

            if ( is_array( $category_ids ) && count( $category_ids ) > 0 ) {
                $question_args['tax_query'][] = array(
                    'taxonomy' => 'question_category',
                    'field'    => 'term_id',
                    'terms'    => $category_ids,
                );
            }

            if (!$settings['history']) {
                echo '<style>#questions-' . $widget_id . ' .ap-display-meta-item.history{display:none;}</style>';
            }
            
            anspress()->questions = ap_get_questions($question_args); ?>
            <div id="anspress">
            <?php if ( ap_have_questions() ) { ?>
        
                <div id="questions-<?php echo $widget_id; ?>" class="ap-questions">
                    <?php
                    while ( ap_have_questions() ) :
                        ap_the_question();
                        ap_get_template_part( 'question-list-item' );
                        endwhile;
                    ?>
                </div>
            
                <?php } else { ?>
            
                <div class="alert alert-danger">
                    <?php esc_attr_e( 'There are no questions matching your query or you do not have permission to read them.', 'scisco' ); ?>
                </div>
            
                <?php ap_get_template_part( 'login-signup' ); ?>
            <?php } ?>
            </div>

        <?php } else {
            echo '<div class="alert alert-danger">' . esc_html__( 'AnsPress plugin is required.', 'scisco') . '</div>';
        }
	}

}
?>