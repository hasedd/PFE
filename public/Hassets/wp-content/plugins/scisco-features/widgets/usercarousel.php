<?php
namespace Elementorscisco\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_User_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class scisco_User_Carousel extends Widget_Base {

	public function get_name() {
		return 'scisco-user-carousel';
	}

	public function get_title() {
		return esc_html__( 'Scisco User Carousel', 'scisco' );
	}

	public function get_icon() {
		return 'eicon-person';
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
				'default' => 'ASC',
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
				'default' => 'alphabetical',
				'options' => [
                    'alphabetical' => esc_html__( 'Alphabetical', 'scisco' ),
                    'registration_date' => esc_html__( 'Registration Date', 'scisco' ),
                    'reputation' => esc_html__( 'Reputation', 'scisco' )
				],
			]
		);
        
        $this->add_control(
			'max',
			[
				'label' => esc_html__( 'Maximum number of users', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 99,
				'step' => 1,
				'default' => 6,
			]
		);
        
        $this->add_control(
			'exclude', [
				'label' => esc_html__( 'Exclude users by ID', 'scisco' ),
                'description' => esc_html__( 'You can find user IDs at the users page. To exclude multiple users, add comma between IDs.', 'scisco' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => ''
			]
        );
        
        $this->add_control(
			'verified', [
				'label' => esc_html__( 'Show only verified users', 'scisco' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'scisco' ),
				'label_off' => esc_html__( 'No', 'scisco' ),
				'return_value' => 'highlighted-title',
				'default' => '',
				'show_label' => true,
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

		$this->start_controls_section(
			'section_carousel_style',
			[
				'label' => esc_html__( 'Cover Image', 'scisco' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        
        $this->add_control(
			'cover_bg_color',
			[
				'label' => esc_html__( 'Overlay Color', 'scisco' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .card-profile-cover a' => 'background-color: {{VALUE}};'
				]
			]
        );
        
        $this->add_responsive_control(
			'cover_bg_height',
			[
				'label' => esc_html__( 'Height (rem)', 'scisco' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 12,
                'selectors' => [
					'{{WRAPPER}} .card-profile-cover' => 'height: {{VALUE}}rem;'
				],
			]
		);

        $this->end_controls_section();

	}
    
    protected function render() {
        $widget_id = $this->get_id();
        $settings = $this->get_settings_for_display();
        
        $scisco_verified = $settings['verified'];
        $scisco_exclude = $settings['exclude'];
        $scisco_limit = $settings['max'];
        $scisco_order = $settings['order'];
        $scisco_orderby = $settings['orderby'];

        $verified_filter = array();
        if ($scisco_verified) {
            $verified_filter = array(
                'meta_query' => array(
                    array(
                        'key' => 'scisco_verified_user',
                        'value' => 'yes'
                    )
                )
            );
        }

        if ($scisco_exclude) {
            $exclude = explode( ',', $scisco_exclude );
        } else {
            $exclude = array();
        }

        if ($scisco_verified) {
            $users = get_users(array(
                'meta_key'     => 'scisco_verified_user',
                'meta_value'   => 'yes'
            ));
        } else {
            $users = get_users();
        }

        $total_users = count($users);
        $total_pages = intval($total_users / $scisco_limit) + 1;

        switch ($scisco_orderby) {
            case 'registration_date':
                $user_query = array(
                    'orderby'	 => 'user_registered',
                    'order'		 => $scisco_order,
                    'exclude' => $exclude,
                    'number'	 => $scisco_limit
                );
            break;
            case 'alphabetical':
                $user_query = array(
                    'orderby'	 => 'title',
                    'order'		 => $scisco_order,
                    'exclude' => $exclude,
                    'number'	 => $scisco_limit
                );
            break;
            case 'reputation':
                $user_query = array(
                    'orderby'	 => 'meta_value_num',
                    'meta_key'	 => 'ap_reputations',
                    'order'		 => $scisco_order,
                    'exclude' => $exclude,
                    'number'	 => $scisco_limit
                );
            break;
        }
        
        $final_query = new WP_User_Query($user_query + $verified_filter);
        $total_query = count($final_query->get_results());


        if ($final_query->get_results()) {
        ?>
        <?php if ($settings['heading']) { ?>
        <<?php echo $settings['heading_level']; ?> class="scisco-carousel-title <?php echo $settings['title_border']; ?>">
            <span><?php echo $settings['heading']; ?></span>
        </<?php echo $settings['heading_level']; ?>>
        <?php } ?>
        <div class="scisco-carousel-container">  
            <div id="scisco-post-carousel-<?php echo esc_attr($widget_id) ?>" class="scisco-carousel">
                <?php
                foreach ($final_query->get_results() as $user) {
                $scisco_header_img = wp_get_attachment_image_url( get_user_meta( $user->ID, 'scisco_cmb2_user_cover_image_id', true ), 'large' );
                if (empty($scisco_header_img)) {
                    $scisco_header_img = get_theme_mod('scisco_ap_user_default_img', '');
                }
                ?>
                <?php $scisco_page_slug = get_theme_mod('scisco_ap_about_slug', 'about'); ?>
                <div class="card card-profile">
                    <div class="card-profile-cover" style="background-image:url('<?php echo esc_url($scisco_header_img); ?>')">
                        <a href="<?php echo esc_url(ap_user_link($user->ID) . $scisco_page_slug); ?>/"></a>
                    </div>
                    <div class="card-profile-image">
                    <a href="<?php echo esc_url(ap_user_link($user->ID) . $scisco_page_slug); ?>/">
                        <?php echo get_avatar( $user->ID, 150 ); ?>
                    </a>
                    </div>
                    <div class="card-body pt-0">
                        <h5 class="card-title">
                            <a href="<?php echo esc_url(ap_user_link($user->ID) . $scisco_page_slug); ?>/">
                                <?php echo esc_html($user->display_name); ?>
                                <?php $reputation_count = ap_get_user_reputation_meta( $user->ID, true ); ?>
                                <span class="ap-user-reputation"><?php echo esc_html($reputation_count); ?></span>
                            </a>
                        </h5>
                        <p class="card-profile-date">
                            <?php esc_html_e( 'Member since:', 'scisco'); ?> <?php echo esc_html(date( get_option('date_format'), strtotime( $user->user_registered ))); ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
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
    $('#scisco-post-carousel-<?php echo esc_js($widget_id) ?>').css('opacity', '1');
});
})(jQuery);        
</script>


	<?php } else { ?>
    <div class="alert alert-danger"><?php esc_html_e( 'No users found!', 'scisco' ); ?></div>         
<?php } ?>
<?php }
}
?>