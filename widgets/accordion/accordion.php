<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Accordion as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Accordion extends Widget_Base {
    
    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-accordion'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-collapse-nx' ];
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
			'nextaddons_accordion_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// style choose
		$this->add_control(
            'nextaddons_accordion_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_accordion_alignment', [
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
                    '{{WRAPPER}} .nx-image-accrodion-wraper .nx-accrodion-content ' => 'text-align: {{VALUE}};',
				],
			]
		);

		do_action('nextaddons_accordion_tab_general', $this);

		$this->end_controls_section();
		// End general Here


		// items
		$this->start_controls_section(
			'nextaddons_accordion_data_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
				
			)
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_items_title',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Enter title here',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		$repeater->add_control(
            'nextaddons_items_content',
            [
                'label' => esc_html__( 'Content', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		do_action('nextaddons_accordion_tab_items_repeater_after_title', $repeater);

		
		$repeater->add_control(
			'nextaddons_items_active',
			[
				'label' => esc_html__( 'Default Active', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'next-addons' ),
                'label_off' => esc_html__( 'No', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
			]
		);
		
		do_action('nextaddons_accordion_tab_items_repeater', $repeater);

        $this->add_control(
            'nextaddons_accordion_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_items_title}}}',
				'default' => [
                    [
                        'nextaddons_items_title' => 'How to Change my Photo from Admin Dashboard?',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'yes',
					],
					[
                        'nextaddons_items_title' => 'How to Change my Photo from Admin Dashboard?',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'no',
					],
					[
                        'nextaddons_items_title' => 'How to Change my Photo from Admin Dashboard?',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'no',
					],
					[
                        'nextaddons_items_title' => 'How to Change my Photo from Admin Dashboard?',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'no',
					],
				
				]
            ]
        );


		do_action('nextaddons_accordion_tab_items', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_accordion_options_section',
			array(
				'label' => esc_html__( 'Options', 'next-addons' ),
			)
		);

		$this->add_control(
            'nextaddons_accordion_indicator_headding',
            [
                'label' => esc_html__( 'Indicator', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				
            ]
        );	
	
		$this->add_control(
			'nextaddons_indicator_enable',
			[
				'label' => esc_html__( 'Show', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'next-addons' ),
                'label_off' => esc_html__( 'No', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
			]
		);
		$this->start_controls_tabs( 'nextaddons_indicator_c_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_indicator_c_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
			]
		);
		$this->add_control(
			'nextaddons_indicator_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-arrow-down2',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_indicator_c_tab_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
            ]
		);
		$this->add_control(
			'nextaddons_indicator_icon2',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-arrow-up2',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
            'nextaddons_accordion_serial_headding',
            [
                'label' => esc_html__( 'Serial', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				
            ]
		);
		
		$this->add_control(
            'nextaddons_accordion_serial_type',
            [
                'label' => esc_html__( 'Serial', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'None',
					'number' => 'Number',
					'icon' => 'Icon'
				],
				'default' => 'number'
				
            ]
		);	
		
		$this->start_controls_tabs( 'nextaddons_serial_c_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_serial_c_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => [ 'nextaddons_accordion_serial_type' => 'icon']
			]
		);

		$this->add_control(
			'nextaddons_serial_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-question1',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_accordion_serial_type' => 'icon']
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_serial_c_tab_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
				'condition' => [ 'nextaddons_accordion_serial_type' => 'icon']
            ]
		);
		$this->add_control(
			'nextaddons_serial_icon2',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-question1',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_accordion_serial_type' => 'icon']
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		// Header
		$this->start_controls_section(
			'nextaddons_headertyle_section', [
				'label'	 => esc_html__( 'Header', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'nextaddons_header_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_header_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_header_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-click-collapse',
				
			]
		);

		$this->add_control(
            'nextaddons_header_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-click-collapse' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_header_box_shadow',
                'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-click-collapse',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_header_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-click-collapse',
				'default'   => '',
			
			]
		);
	
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_header_tab_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
            ]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_header_border_active',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header.active .nx-click-collapse',
				
			]
		);

		$this->add_control(
            'nextaddons_header_border_radius_active',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header.active .nx-click-collapse' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_header_box_shadow_active',
                'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header.active .nx-click-collapse',
				

            ]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_header_bg_active',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header.active .nx-click-collapse',
				'default'   => '',
			
			]
		);
	
		$this->end_controls_tab();

		$this->end_controls_tabs();

		
		
		$this->add_control(
            'nextaddons_header_global_headding',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_headding_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-click-collapse' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->add_control(
            'nextaddons_headding_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .themedev-tab-wrapper .nxadd-accordion .nx-card' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->end_controls_section();

		// Body
		$this->start_controls_section(
			'nextaddons_bodyrtyle_section', [
				'label'	 => esc_html__( 'Body', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_body_typography',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-card-body',
			
			]
		);
		$this->add_control(
			'nextaddons_body_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-card-body' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_body_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body',
				
			]
		);

		$this->add_control(
            'nextaddons_body_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_body_box_shadow',
                'selector' => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_body_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body',
				'default'   => '',
			
			]
		);
	
	
		$this->add_responsive_control(
			'nextaddons_body_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nextaddons_body_margin',
			[
				'label' => __( 'margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card .nx-card-header .nx-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'nextaddons_title_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_title_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .accon-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .accon-title' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_title_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography_active',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .accon-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .accon-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_control(
            'nextaddons_accordion_titleglobal_headding',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_title_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .accon-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_accordion_tab_style_title', $this);

		$this->end_controls_section();


		// Serial
		$this->start_controls_section(
			'nextaddons_serialstyle_section', [
				'label'	 => esc_html__( 'Serial', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'nextaddons_serial_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_serial_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_serial_typography',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .left-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_serial_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .left-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_serial_tab_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_serial_typography_active',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .left-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_serial_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .left-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	
		$this->add_control(
            'nextaddons_serial_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header > .nx-click-collapse .nextaddons-icon.left-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
				'separator' => 'before',
            ]
		);
		
		do_action('nextaddons_accordion_tab_style_serial', $this);
		
		$this->end_controls_section();


		// Indicator
		$this->start_controls_section(
			'nextaddons_indicatortyle_section', [
				'label'	 => esc_html__( 'Indicator', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
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
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .right-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header .nx-click-collapse .right-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_indicator_tab_hover',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_indicator_typography_active',
			'selector'	 => '{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .right-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-accrodion-wraper .nxadd-accordion .nx-card-header.active .nx-click-collapse .right-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	
		do_action('nextaddons_accordion_tab_style_indicator', $this);
		
		$this->end_controls_section();

		do_action('nextaddons_accordion_tab', $this);

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
		return apply_filters( 'nextaddons_accordion_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-accordion-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
	
		$classs = '';
		if(in_array($nextaddons_accordion_styles, ['normal'])){
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_accordion_styles, ['icon-card'])){
			$classs = '';
			if( is_file( NX_Config::get_next_dir() .'/include/icon-card.php' ) ){
				include( NX_Config::get_next_dir() .'/include/icon-card.php');
			}
		} 
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			nx_collapse_start('.<?php echo $elementorID;?>');
		});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}