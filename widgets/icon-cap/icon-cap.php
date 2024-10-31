<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Icon_Cap as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Icon_Cap extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-iconcap', 'nextaddons-iconcap-pro'];
	}

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

    protected function _register_controls() {
	   
		// Start General Here
		$this->start_controls_section(
			'nextaddons_iconcap_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		
		$this->add_control(
            'nextaddons_iconcap_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_iconcap_alignment', [
				'label'			 =>esc_html__( 'Alignment', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'next-addons' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'next-addons' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'next-addons' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'next-addons' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'center',
                'selectors' => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
            'nextaddons_tabs_type',
            [
                'label' => esc_html__( 'Layout', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'nx-top-layout' => 'Top',
					'nx-bottom-layout' => 'Bottom',
					'nx-left-layout' => 'Left',
					'nx-right-layout' => 'Right',
				],
				'default' => 'nx-top-layout'
				
            ]
		);
		

		$this->add_responsive_control(
            'nextaddons_tabs_type_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-left-layout .nxadd-icon' => 'flex-basis: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-right-layout .nxadd-icon' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [ 'nextaddons_tabs_type' => ['nx-left-layout', 'nx-right-layout'] ]
            ]
		);
		
		do_action('nextaddons_iconcap_tab_general', $this);

		$this->end_controls_section();
		// End General Here
		
		$this->start_controls_section(
			'nextaddons_content_section',
			array(
				'label' => esc_html__( 'Data', 'next-addons' ),
			)
		);

		$this->add_control(
            'nextaddons_content_badge',
            [
                'label' => esc_html__( 'Badge', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Free',
				'label_block'	 => true,
            ]
		);

		$this->add_control(
			'nextaddons_content_headding',
			[
				'label' => __( 'Content', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
            'nextaddons_content_title',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Wordpress',
				'label_block'	 => true,
				
            ]
		);
		
		
		$this->add_control(
            'nextaddons_content_title_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				
            ]
		);
		
		$this->add_control(
			'nextaddons_icon_headding',
			[
				'label' => __( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		
		$this->add_control(
			'nextaddons_icon_icons',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_icon_icon',
                'default' => [
                    'value' => 'nx-icon nx-icon-angellist',
                    'library' => 'nxicons',
				],
				
			]
		);

		do_action('nextaddons_iconcap_tab_data', $this);

		$this->end_controls_section();


		// General
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_responsive_control(
			'nextaddons_iconcap_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_iconcap_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);
		

		$this->start_controls_tabs( 'nextaddons_iconcap_general_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_iconcap_general_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_iconcap_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_iconcap_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper',
			]
		);

		$this->add_control(
            'nextaddons_iconcap_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_iconcap_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper',
            ]
		);
	
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_iconcap_general_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_iconcap_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_iconcap_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover',
			]
		);

		$this->add_control(
            'nextaddons_iconcap_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_iconcap_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover',
            ]
		);
	
		$this->add_responsive_control(
			'nextaddons_iconcap_transform_hover',
			[
				'label' => __( 'Transform', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => -100,
						'step' => 1,
					],
					'em' => [
						'min' => -100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
				
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover' => 'transform:translateY({{SIZE}}{{UNIT}});',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_iconcap_background_duration_hover',
            [
                'label' => __( 'Transition Duration', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .themedev-icon-caps-area .nxadd-icon-caps-wrapper' => 'transition-duration: {{SIZE}}s',
                    '{{WRAPPER}}  .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_iconcap_tab_general_style', $this);

		$this->end_controls_section();

		// start title style
		$this->start_controls_section(
			'nextaddons_titlestyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_iconcap_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper .nxadd-icon-caps-title-wrap .nxadd-icon-caps-title',
			]
		);

		$this->add_responsive_control(
			'nextaddons_iconcap_title_spacing',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
				
				],
				'selectors' => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-top-layout .nxadd-icon-caps-title-wrap' => 'margin-top:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-bottom-layout .nxadd-icon-caps-title-wrap' => 'margin-bottom:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-left-layout .nxadd-icon-caps-title-wrap' => 'margin-left:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-inner.nx-right-layout .nxadd-icon-caps-title-wrap' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->start_controls_tabs( 'nextaddons_iconcap_titletext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_iconcap_titletext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_iconcap_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper .nxadd-icon-caps-title-wrap .nxadd-icon-caps-title' => 'color: {{VALUE}};',
				],
			
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_iconcap_titletext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_control(
			'nextaddons_iconcap_title_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover .nxadd-icon-caps-title-wrap .nxadd-icon-caps-title' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_iconcap_tab_title_style', $this);

		$this->end_controls_section();

		// badge
		$this->start_controls_section(
			'nextaddons_badgestyle_section', [
				'label'	 => esc_html__( 'Badge', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_iconcap_badge_typography',
			'selector'	 => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge',
			]
		);

		$this->add_control(
			'nextaddons_iconcap_badge_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge' => 'color: {{VALUE}};',
				],
			
			]
		);
	
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_iconcap_badge_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_iconcap_badge_br',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge',
			]
		);

		$this->add_control(
            'nextaddons_iconcap_badge_dor_ra',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_iconcap_badge_box',
                'selector' => '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge',
            ]
		);

		$this->add_responsive_control(
			'nextaddons_iconcap_badge_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->add_control(
            'badge_position_toggle',
            [
                'label' => __( 'Position', 'next-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'next-addons' ),
                'label_on' => __( 'Custom', 'next-addons' ),
                'return_value' => 'yes',
            ]
		);
		$this->start_popover();
		
        $this->add_responsive_control(
            'badge_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'badge_position_toggle' => 'yes'
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'badge_position_toggle' => 'yes'
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-badge' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    
                ],
            ]
        );

		$this->end_popover();

		do_action('nextaddons_iconcap_tab_badge_style', $this);

		$this->end_controls_section();


		// Icon
		$this->start_controls_section(
			'nextaddons_iconstyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'nextaddons_iconcap_icons_size',
			[
				'label' => __( 'Size', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'em' => [
						'min' => -100,
						'step' => 1,
						'max' => 100
					],
					'%' => [
						'min' => 1,
						'step' => 1,
						'max' => 100
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper .nextaddons-icon:before' => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
				],
				
			]
		);

		$this->start_controls_tabs( 'nextaddons_iconcap_icon_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_iconcap_icon_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_iconcap_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_iconcap_icon_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_control(
			'nextaddons_iconcap_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-icon-caps-area .nxadd-icon-caps-wrapper:hover svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_iconcap_tab_icon_style', $this);

		$this->end_controls_section();


		do_action('nextaddons_iconcap_tab', $this);

		// start custom style
		$this->start_controls_section(
			'nextaddons_customstyle_section', [
				'label'	 => esc_html__( 'Custom Style', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		// custom css 
		$this->add_control(
			'nextaddons_custom_class', [
				'label'			 =>esc_html__( 'Custom Class', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '.class-name', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
			]
		);
		
		$this->add_control(
			'nextaddons_custom_css', [
				'label'			 =>esc_html__( 'Custom Css', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA ,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'css code here', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
				'description'	 =>esc_html__( 'Your custom css code for this section. Please set your custom class after write your custom css code here.', 'next-addons' ),
			]
		);
	
		$this->end_controls_section();
		// end custom style
    }
	
	public static function _styles(){
		$style = [
			'normal' => [
				'title' => esc_html__( 'Normal', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_iconcap_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-iconcap-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$classs = '';
		if(in_array($nextaddons_iconcap_styles, ['normal'])){
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		}  
		?>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}