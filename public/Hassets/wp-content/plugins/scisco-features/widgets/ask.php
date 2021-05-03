<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_Ask extends Widget_Base {

	public function get_name() {
		return 'scisco-ask';
	}

	public function get_title() {
		return esc_html__( 'Scisco Ask Question Form', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'scisco-widgets' ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Ask Question Form', 'scisco' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'important_note',
			[
				'label' => esc_html__( 'This widget has no setting.', 'scisco' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'your-class',
			]
		);
       
		$this->end_controls_section();
	}
    
    protected function render() {
        if (class_exists( 'AnsPress' )) {
            if ( ap_user_can_ask() ) {
                ap_ask_form();
            } elseif ( is_user_logged_in() ) { ?>
            <div class="alert alert-danger">
                <?php esc_html_e( 'You do not have permission to ask a question.', 'scisco' ); ?>
            </div>
            <?php } ?>
            <?php ap_get_template_part( 'login-signup' );
        } else {
            echo '<div class="alert alert-danger">' . esc_html__( 'AnsPress plugin is required.', 'scisco') . '</div>';
        }
    }

}
?>