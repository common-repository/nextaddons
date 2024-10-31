<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Business_Hours as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Business_Hours extends Widget_Base {
    
    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-businesshours'];
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
		
		// items
		$this->start_controls_section(
			'nextaddons_business_data_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
				
			)
		);

		$this->add_control(
            'nextaddons_items_heading',
            [
                'label' => esc_html__( 'Heading', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Working Hour',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		$this->add_responsive_control(
			'nextaddons_item_alignment', [
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
                    '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title h3' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_items_days',
            [
                'label' => esc_html__( 'Day', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Monday - Friday',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		$repeater->add_control(
            'nextaddons_items_time',
            [
                'label' => esc_html__( 'Time', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => '10:00AM - 07:00PM',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		$repeater->add_control(
			'nextaddons_items_close',
			[
				'label' => esc_html__( 'Close hour', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'next-addons' ),
                'label_off' => esc_html__( 'No', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
			]
		);
		
		do_action('nextaddons_business_tab_items_repeater', $repeater);

        $this->add_control(
            'nextaddons_business_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_items_days}}}',
				'default' => [
                    [
                        'nextaddons_items_days' => 'Monday - Friday',
                        'nextaddons_items_time' => '10:00AM - 07:00PM',
						'nextaddons_items_close' => 'no',
					],

					[
                        'nextaddons_items_days' => 'Saturday',
                        'nextaddons_items_time' => '10:00AM - 03:00PM',
						'nextaddons_items_close' => 'no',
					],

					[
                        'nextaddons_items_days' => 'Sunday',
                        'nextaddons_items_time' => 'Closed',
						'nextaddons_items_close' => 'yes',
					],
				
				]
            ]
        );


		do_action('nextaddons_business_tab_items', $this);

		$this->end_controls_section();


		// title
		$this->start_controls_section(
			'nextaddons_titlestyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title h3',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title h3' => 'color: {{VALUE}};',
				],
				
			]
		);
		
		$this->add_responsive_control(
			'nextaddons_title_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_title_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title',
				
			]
		);

		$this->add_control(
            'nextaddons_title_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_title_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner li.nxadd-business-hour-title',
				'default'   => '',
			
			]
		);

		do_action('nextaddons_business_tab_title_style', $this);

		$this->end_controls_section();

		// items

		$this->start_controls_section(
			'nextaddons_itesmstyle_section', [
				'label'	 => esc_html__( 'Items', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_items_days_headding',
            [
                'label' => esc_html__( 'Days', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_item_typography',
			'selector'	 => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item .nxadd-business-day',
			
			]
		);
		$this->add_control(
			'nextaddons_item_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item .nxadd-business-day' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_items_time_headding',
            [
                'label' => esc_html__( 'Time', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_item_time_typography',
			'selector'	 => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item .nxadd-business-time',
			
			]
		);
		$this->add_control(
			'nextaddons_item_time_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item .nxadd-business-time' => 'color: {{VALUE}};',
				],
				
			]
		);
		

		$this->add_control(
            'nextaddons_items_close_headding',
            [
                'label' => esc_html__( 'Close Hour', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_item_close_typography',
			'selector'	 => '
			{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item.nx-business-close .nxadd-business-time,
			{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item.nx-business-close .nxadd-business-day
			',
			
			]
		);
		$this->add_control(
			'nextaddons_item_close_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#e2498a',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item.nx-business-close .nxadd-business-day' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item.nx-business-close .nxadd-business-time' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_item_bg_close',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item.nx-business-close',
				'default'   => '',
			
			]
		);

		$this->add_control(
            'nextaddons_items_global_headding',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_item_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_item_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_item_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item',
				
			]
		);

		$this->add_control(
            'nextaddons_item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_item_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_item_bg_normal',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-business-hours-wrapper .nxadd-business-hours-inner .nxadd-business-hour-single-item',
				'default'   => '',
			
			]
		);


		do_action('nextaddons_business_tab_items_style', $this);

		$this->end_controls_section();


		do_action('nextaddons_business_tab', $this);

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
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-businesshours-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
	
		$classs = '';
		
		if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
			include( NX_Config::get_next_dir() .'/include/normal.php');
		}
		
    }

    protected function _content_template() { 
		
	}
}