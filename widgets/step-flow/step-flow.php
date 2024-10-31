<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Step_Flow as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Step_Flow extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-stepflow', 'nextaddons-stepflow-pro'];
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
			'nextaddons_stepflow_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		if( !$this->help ):
		$this->add_control(
			'nextaddons_stepflow_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Step Flow controls available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/step-flow/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_stepflow_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_stepflow_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_stepflow_alignment', [
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
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon-content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		
		do_action('nextaddons_stepflow_tab_general', $this);

		$this->end_controls_section();
		// End General Here
		
		$this->start_controls_section(
			'nextaddons_content_section',
			array(
				'label' => esc_html__( 'Data', 'next-addons' ),
			)
		);

		$this->add_control(
			'nextaddons_content_headding',
			[
				'label' => __( 'Content', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'nextaddons_content_show',
			[
				'label' => esc_html__( 'Show', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'next-addons' ),
                'label_off' => esc_html__( 'No', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
			]
		);	
		
		$this->add_control(
            'nextaddons_content_title',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Enter title here',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				'condition' => [ 'nextaddons_content_show' => 'yes']
            ]
		);

		$this->add_control(
            'nextaddons_content_details',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				'condition' => [ 'nextaddons_content_show' => 'yes']
            ]
		);

		$this->add_control(
			'nextaddons_content_counter_headding',
			[
				'label' => __( 'Counter', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'nextaddons_content_counter_data',
            [
                'label' => esc_html__( 'Data', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => '1',
				'label_block'	 => false,
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
		do_action('nextaddons_stepflow_tab_content', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_stepflow_decoration_section',
			array(
				'label' => esc_html__( 'Options', 'next-addons' ),
			)
		);

		if( !$this->help ):
		$this->add_control(
			'nextaddons_indication_data_message',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Top, Right, Bottom Indicator available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/step-flow/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;

		$this->add_control(
			'nextaddons_indication_data',
			[
				'label' => __( 'Select Indicator', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => apply_filters('nextaddons_stepflow_indication', [
					'nx-left' => 'Left',
				]),
				'default' => [ 'nx-left'],
				
			]
		);
		$this->add_control(
			'nextaddons_indication_left_heading',
			[
				'label' => __( 'For left label', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_indication_data' => 'nx-left']
			]
		);

		$this->add_control(
            'nextaddons_indication_left_label',
            [
                'label' => esc_html__( 'Label', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Yes',
                'placeholder' => '',
               
				'label_block'	 => true,
				'condition' => [ 'nextaddons_indication_data' => 'nx-left']
            ]
		);

		do_action('nextaddons_stepflow_tab_options', $this);

		$this->end_controls_section();


		// title
		$this->start_controls_section(
			'nextaddons_titlestyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_title!' => '', 'nextaddons_content_show' => 'yes']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content .nxadd-step-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content .nxadd-step-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_title_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content .nxadd-step-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);
		do_action('nextaddons_stepflow_tab_title_style', $this);

		$this->end_controls_section();

		

		// Details
		$this->start_controls_section(
			'nextaddons_detailsstyle_section', [
				'label'	 => esc_html__( 'Details', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_details!' => '', 'nextaddons_content_show' => 'yes']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_details_typography',
			'selector'	 => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content .nxadd-step-des',
			
			]
		);
		$this->add_control(
			'nextaddons_details_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-content .nxadd-step-des' => 'color: {{VALUE}};',
				],
				
			]
		);

		do_action('nextaddons_stepflow_tab_details_style', $this);

		$this->end_controls_section();


		// Details
		$this->start_controls_section(
			'nextaddons_counterstyle_section', [
				'label'	 => esc_html__( 'Counter', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_counter_data!' => '']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_counter_typography',
			'selector'	 => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label',
			
			]
		);
		$this->add_control(
			'nextaddons_counter_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_counter_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label',
				
			]
		);

		$this->add_control(
            'nextaddons_counter_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_counter_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label',
            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_counter_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label',
				'default'   => '',
			
			]
		);
	
	
		$this->add_responsive_control(
			'nextaddons_counter_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'counter_position_toggle',
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
            'counter_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'counter_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'counter_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1050,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-steps-label' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                    
                ],
            ]
        );

		$this->end_popover();

		do_action('nextaddons_stepflow_tab_counter_style', $this);

		$this->end_controls_section();


		// icons

		$this->start_controls_section(
			'nextaddons_iconsstyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
	
		$this->add_control(
            'nextaddons_icons_typography',
            [
                'label' => esc_html__( 'Font Size', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon  svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);

		$this->start_controls_tabs( 'nextaddons_icons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_icons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_icons_color_normal', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_icons_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon',
				
			]
		);

		$this->add_control(
            'nextaddons_icons_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_icons_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_icons_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon',
				'default'   => '',
			
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_icons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_control(
			'nextaddons_icons_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_icons_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon',
				
			]
		);

		$this->add_control(
            'nextaddons_icons_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_icons_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_icons_bg_normal_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner:hover .nxadd-step-icon',
				'default'   => '',
			
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_icons_global',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
            'nextaddons_icons_sizey',
            [
                'label' => esc_html__( 'Size', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 5,
                    ],
                  
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_responsive_control(
			'nextaddons_icons_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_stepflow_tab_icon_style', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_indicatorstyle_section', [
				'label'	 => esc_html__( 'Indicator', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_indicator_left',
            [
                'label' => esc_html__( 'Left', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
		);
		$this->add_control(
            'left_position_toggle',
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
            'left_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'left_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'left_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1050,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left' => 'right: auto; left: calc(100% + {{SIZE}}{{UNIT}});',
                    
                ],
            ]
        );

		$this->end_popover();

		$this->add_control(
			'left_indicator_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left:after' => 'border-right-color: {{VALUE}}; border-top-color: {{VALUE}};',
				],
				
			]
		);
		$this->add_responsive_control(
            'left_indicator_size',
            [
                'label' => __( 'Size', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left' => 'width: {{SIZE}}{{UNIT}};'
				],
				
            ]
        );

		$this->add_control(
			'left_indicator_labelcolor', [
				'label'		 =>esc_html__( 'Label Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left span.nx-arrow-lebel' => 'color: {{VALUE}};',
				],
				'condition' => [ 'nextaddons_indication_left_label!' => '']
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'left_indicator_label_typography',
			'selector'	 => '{{WRAPPER}} .themedev-step-flow-wrapper .nxadd-step-inner .nxadd-step-arrow.nx-left span.nx-arrow-lebel',
			'condition' => [ 'nextaddons_indication_left_label!' => '']
			]
		);

		do_action('nextaddons_stepflow_tab_indicator_style', $this);

		$this->end_controls_section();

		do_action('nextaddons_stepflow_tab', $this);

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
		return apply_filters( 'nextaddons_stepflow_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-stepflow-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$classs = '';
		if(in_array($nextaddons_stepflow_styles, ['normal'])){
			
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