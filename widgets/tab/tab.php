<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Tab as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Tab extends Widget_Base {
    
    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-tab'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-tab-nx' ];
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
			'nextaddons_tabs_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// style choose
		$this->add_control(
            'nextaddons_tabs_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_tabs_alignment', [
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
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tabs_type',
            [
                'label' => esc_html__( 'Layout', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top-tab' => 'Top',
					'left-tab' => 'Left',
					'right-tab' => 'Right',
				],
				'default' => 'top-tab'
				
            ]
		);
		
		$this->add_control(
            'nextaddons_tabs_type_full',
            [
                'label' => esc_html__( 'Layout Settings', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'Default',
					'nx-full-tab' => 'Full Width',
				],
				'default' => '',
				'condition' => [ 'nextaddons_tabs_type' => ['top-tab'] ]
            ]
		);	

		$this->add_control(
            'nextaddons_tabs_type_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style.left-tab .nx-nav-tabs' => 'flex-basis: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style.right-tab .nx-nav-tabs' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [ 'nextaddons_tabs_type' => ['left-tab', 'right-tab'] ]
            ]
		);

		do_action('nextaddons_tabs_tab_general', $this);

		$this->end_controls_section();
		// End general Here


		// items
		$this->start_controls_section(
			'nextaddons_tabs_data_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
				
			)
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_items_title',
            [
                'label' => esc_html__( 'Name', 'next-addons' ),
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

		do_action('nextaddons_tabs_tab_items_repeater_after_title', $repeater);

		
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
		
		do_action('nextaddons_tabs_tab_items_repeater', $repeater);

        $this->add_control(
            'nextaddons_tabs_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_items_title}}}',
				'default' => [
                    [
                        'nextaddons_items_title' => 'Developing',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'yes',
					],
					[
                        'nextaddons_items_title' => 'Designing',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'no',
					],
					[
                        'nextaddons_items_title' => 'Marketing',
                        'nextaddons_items_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
						'nextaddons_items_active' => 'no',
					],
				
				]
            ]
        );


		do_action('nextaddons_tabs_tab_items', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_tabs_options_section',
			array(
				'label' => esc_html__( 'Options', 'next-addons' ),
			)
		);

		$this->add_control(
            'nextaddons_tabs_indicator_headding',
            [
                'label' => esc_html__( 'Icons', 'next-addons' ),
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
		
	

		$this->add_control(
			'nextaddons_indicator_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-wordpress',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
			]
		);
		
		$this->add_control(
            'nextaddons_tabs_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'nx-left-icon' => 'Default',
					'nx-top-icon' => 'Top',					
					'nx-right-icon' => 'Right',
					'nx-bottom-icon' => 'Bottom',
				],
				'default' => 'nx-left-icon',
				'condition' => [ 'nextaddons_indicator_enable' => 'yes']
				
            ]
		);	


		$this->end_controls_section();


		// Header
		$this->start_controls_section(
			'nextaddons_headertyle_section', [
				'label'	 => esc_html__( 'Tab', 'next-addons' ),
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
				'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link',
				
			]
		);

		$this->add_control(
            'nextaddons_header_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_header_box_shadow',
                'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_header_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link',
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
				'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active',
				
			]
		);

		$this->add_control(
            'nextaddons_header_border_radius_active',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_header_box_shadow_active',
                'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active',
				

            ]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_header_bg_active',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active',
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
					'{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style.left-tab .nx-nav-tabs .nav-item ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style.right-tab .nx-nav-tabs .nav-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style.top-tab .nx-nav-tabs .nav-item' => 'margin-right: {{SIZE}}{{UNIT}};',
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
			'selector'	 => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane',
			
			]
		);
		$this->add_control(
			'nextaddons_body_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_body_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane',
				
			]
		);

		$this->add_control(
            'nextaddons_body_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_body_box_shadow',
                'selector' => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_body_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane',
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
					'{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-tab-content .nx-tab-pane' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'selector'	 => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link' => 'color: {{VALUE}};',
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
			'selector'	 => '{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-tabs-wraper .nx-tab-style .nx-nav-tabs .nav-item .nx-nav-link.nx-active' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_control(
            'nextaddons_tabs_titleglobal_headding',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
	
		do_action('nextaddons_tabs_tab_style_title', $this);

		$this->end_controls_section();

		
		// Indicator
		$this->start_controls_section(
			'nextaddons_indicatortyle_section', [
				'label'	 => esc_html__( 'Icons', 'next-addons' ),
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
			'selector'	 => '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link .nextaddons-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link .nextaddons-icon:before' => 'color: {{VALUE}};',
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
			'selector'	 => '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-active .nextaddons-icon:before',
			
			]
		);
		$this->add_control(
			'nextaddons_indicator_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-active .nextaddons-icon:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	
		$this->add_control(
            'nextaddons_indicator_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-left-icon .nextaddons-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-top-icon .nextaddons-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-right-icon .nextaddons-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-tabs-wraper .nx-nav-tabs .nav-item .nx-nav-link.nx-bottom-icon .nextaddons-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				
            ]
		);
		do_action('nextaddons_tabs_tab_style_indicator', $this);
		
		$this->end_controls_section();

		do_action('nextaddons_tabs_tab', $this);

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
		return apply_filters( 'nextaddons_tabs_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-tab-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
	
		$classs = '';
		if(in_array($nextaddons_tabs_styles, ['normal'])){
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		}
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			nx_tab_start('.<?php echo $elementorID;?>');
		});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}