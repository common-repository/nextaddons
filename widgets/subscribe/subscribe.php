<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Subscribe as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Subscribe extends Widget_Base {
    
    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}
/*
	public function get_style_depends() {
		return [ 'nextaddons-subscribe'];
	}
*/
    public function get_name() {
        return NX_Config::get_next_name();
    }

    public function get_title() {
        return NX_Config::get_next_title();
    }

    public function get_icon() {
        return NX_Config::get_next_icon();
    }
	public function get_keywords() {
		return NX_Config::get_next_keywords();
	}
    public function get_categories() {
        return NX_Config::get_next_categories();
	}
	
	public function get_custom_help_url() {
		return 'http://support.themedev.net/docs-category/next-mail/';
	}

	public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {
	   // Start General Here
		
	   $this->start_controls_section(
			'_section_nextmail',
			[
				'label' => NX_Config::instance()->_is_nextmail_activated() ? __( 'Next Mail', 'next-addons' ) : __( 'Missing Notice',
					'next-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		if ( ! NX_Config::instance()->_is_nextmail_activated() ) {
			$this->add_control(
				'_nextmail_missing_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf(
						__( 'Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'next-addons' ),
						'<a href="'.esc_url( admin_url( 'plugin-install.php?s=Next Mail&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Next Mail</a>',
						\wp_get_current_user()->display_name
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				]
			);

			if ( file_exists( WP_PLUGIN_DIR . '/next-mail-chimp/next-mailchimp.php' ) ) {
				$link = wp_nonce_url( 'plugins.php?action=activate&plugin=next-mail-chimp/next-mailchimp.php&plugin_status=all&paged=1', 'activate-plugin_next-mail-chimp/next-mailchimp.php' );
            
			}else{
				$link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=next-mail-chimp' ), 'install-plugin_next-mail-chimp' );
			}

			$this->add_control(
				'_nextmail_install',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<a href="'. $link .'" target="_blank" rel="noopener">Click to install or activate Next Mail</a>',
				]
			);
			$this->end_controls_section();
			return;
		}

		$this->add_control(
			'_nextmail_support',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<a href="http://support.themedev.net/docs-category/next-mail/" target="_blank" rel="noopener">Click to view doc of Next Mail</a>',
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __( 'Select Form', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => NX_Config::instance()->_get_next_forms(),
			]
		);

		$this->add_control(
			'form_style',
			[
				'label' => __( 'Form Layout', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' =>  NX_Config::instance()->_form_style(),
			]
		);

		$this->add_control(
			'forms_icons_type',
			[
				'label' => __( 'Icon', 'next-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'default' => 'Default', 'elementor' => 'Elementor Icon', 'none' => 'None'],
				'default' => 'default',
			]
		);

		$this->add_control(
			'forms_icons_default',
			[
				'label' => __( 'Select Icon', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => NX_Config::instance()->_get_icons(),
				'condition' => [ 'forms_icons_type' => 'default'],
			]
		);

		$this->add_control(
			'forms_icons_ele',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'forms_icons_eles',
                'default' => [
                    'value' => 'nx-icon nx-icon-sent-mail',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'forms_icons_type' => 'elementor'],
			]
		);

		$this->add_control(
			'forms_icons_position',
			[
				'label' => __( 'Icon Position', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => NX_Config::instance()->_icon_position(),
				'default' => 'left'
			]
		);

		$this->add_control(
			'_button_text', [
				'label'			 =>esc_html__( 'Button Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default'	 => 'Subscribe',
			]
		);

		$this->add_control(
			'_custom_class', [
				'label'			 =>esc_html__( 'Custom Class', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default'	 => '',
			]
		);

		do_action('nextaddons_subscribe_tab_form', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_inputstyle_section', [
				'label'	 => esc_html__( 'Input', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'nextaddons_input_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .next-mail-section .next-inner-from .next-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_input_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-input-filed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_input_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-input-filed',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_input_boxshadow',
                'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-input-filed',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_input_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-input-filed',
			]
		);

		$this->add_control(
            'nextaddons_input_borderradius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .nextaddons-mailforms .next-mail-section .next-inner-from .next-input-filed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		do_action('nextaddons_subscribe_tab_input_style', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_button_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);

		$this->start_controls_tabs( 'nextaddons_indicator_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_indicator_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_indicator_typography',
			'selector'	 => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button .nextaddons-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button .nextaddons-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_indicator_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_indicator_typography_active',
			'selector'	 => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button .nextaddons-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button .nextaddons-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	
		
		$this->add_control(
            'nextaddons_button_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_button_typography',
			'selector'	 => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button .next-btn-text',
			
			]
		);
		

		$this->start_controls_tabs( 'nextaddons_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button .next-btn-text' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_button_boxshadow',
                'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button',
			]
		);

		$this->add_control(
            'nextaddons_button_borderradius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_button_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		
		$this->add_control(
			'nextaddons_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button .next-btn-text' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_button_boxshadow_hover',
                'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button',
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button',
			]
		);

		$this->add_control(
            'nextaddons_button_borderradius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .nextaddons-mailforms .next-mail-section .next-inner-from:hover .next-mail-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_button_global_headding',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_button_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nextaddons-mailforms .next-mail-section .next-inner-from .next-mail-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		do_action('nextaddons_subscribe_tab_button_style', $this);

		$this->end_controls_section();

		do_action('nextaddons_subscribe_tab', $this);

    }
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-subscribe-'.$this->get_id();
		
		if ( ! NX_Config::instance()->_is_nextmail_activated() ) {
            return;
        }

		if( empty($form_id) || $form_id == 0){
			echo esc_html__('Please select any forms', 'next-addons');
			return;
		}
		$atts['form-id'] = $form_id;
        $atts['class'] = $_custom_class;
        $atts['btn-text'] = $_button_text;
        $atts['btn-style'] = !empty($form_style) ? $form_style : 'from1';
		$atts['icon-position'] = $forms_icons_position;

		if( $forms_icons_type == 'default'){
			$atts['icon'] = 'nx-subscribe '.$forms_icons_default;
		}else if( $forms_icons_type == 'elementor'){
			$atts['icon'] = isset($forms_icons_ele['value']) ?  'nextaddons-icon ' .$forms_icons_ele['value'] : '';
		}
		echo '<div class="nextaddons-mailforms " id="'.$elementorID.'">';
		echo NX_Config::instance()->_mail_shortcode_action($atts);
		echo '</div>';
		
    }

    protected function _content_template() { 
		
	}
}