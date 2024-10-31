<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Progress_Bar as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Progress_Bar extends Widget_Base {

    public $base;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
	}

	public function get_script_depends() {
		return [ 'nextaddons-progressbar-nx' ];
	}

	public function get_style_depends() {
		return [ 'nextaddons-progressbar'];
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


	public static function _styles(){
		$style = [
			'normal' => 'Normal',					
			'inner-content' => 'Inner Bar',
			'tooltip-style' => 'Tooltip Bar',
			'pin-style' => 'Pin Bar',
			'tooltip-style2' => 'Tooltip Bar 2',
			'switch' => 'Round Switch',
			'stripe' => 'Stripe',
			'ribbon' => 'Ribbon'
		];
		return apply_filters( 'nextaddons_progress_styles', $style);
	}
    protected function _register_controls() {
		// Start title Content
		$this->start_controls_section(
			'themedev_next_progress_title_section',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
			)
		);
		// enable Title - bar content
		$this->add_control(
			'themedev_next_progress_title_enable',
			[
				'label' => __( 'Show Title', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		// Bar Title - bar content
		$this->add_control(
			'themedev_next_progress_title', [
				'label'			 =>esc_html__( 'Title', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Title here ', 'next-addons' ),
				'default'	 =>esc_html__( 'Wordpress', 'next-addons' ),
				'description'	 =>esc_html__( '', 'next-addons' ),
				'condition' => [ 'themedev_next_progress_title_enable' => 'yes'],
			]
		);
		// Bar Title tag - bar content
		$this->add_control(
			'themedev_next_progress_title_tag',
			[
				'label' => esc_html__( 'Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'p',
				'condition' => [ 'themedev_next_progress_title_enable' => 'yes'],
			]
		);
		$this->end_controls_section();
		 // end title Content
		 
		// Start Bar Content
	   $this->start_controls_section(
			'themedev_next_progress_bar_section',
			array(
				'label' => esc_html__( 'Bar', 'next-addons' ),
			)
		);
		// data bar
		$this->add_control(
            'themedev_next_progress_bar_percentage',
            [
                'label'     => esc_html__('Data', 'next-addons'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 100,
                'step'      => 1,
                'default'   => 90,
            ]
        );
		// animation duration bar
		$this->add_control(
            'themedev_next_progress_bar_duration',
            [
                'label'     => esc_html__('Timing', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range' => [
					'min' => 10,
					'max' => 100,
					'step' => 1,
				],
				'default' => [
					'size' => 60,
				],

            ]
        );
		// enable percentage - bar content
		$this->add_control(
			'themedev_next_progress_bar_percentage_enable',
			[
				'label' => __( 'Show Percentage', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'themedev_next_progress_bar_percentage_symbol', [
				'label'			 =>esc_html__( 'Symbol', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'placeholder'	 =>esc_html__( '%', 'next-addons' ),
				'default'	 =>esc_html__( '%', 'next-addons' ),
				'condition' => [ 'themedev_next_progress_bar_percentage_enable' => 'yes'],
			]
		);
		
		$this->add_control(
			'themedev_next_progress_bar_icon_enable',
			[
				'label' => __( 'Show Icon', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [ 'themedev_next_progress_general_bar_style' => 'inner-content' ]
			]
		);
		
		$this->add_control(
			'themedev_next_progress_bar_icon_class',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'themedev_next_progress_bar_icons_class',
                'default' => [
                    'value' => 'nx-icon nx-icon-arrow-right2',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'themedev_next_progress_bar_icon_enable' => 'yes', 'themedev_next_progress_general_bar_style' => 'inner-content'],
			]
		);
		$this->end_controls_section();
		 // end Bar Content
		 
		 // Start General Here
		$this->start_controls_section(
			'themedev_next_progress_general_section',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		$this->add_control(
			'themedev_next_progress_general_bar_style',
			[
				'label' => esc_html__( 'Choose Styles', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => self::_styles(),
				'default' => 'normal',
				'label_block'	 => true,
			]
		);
		
		
		$this->end_controls_section();
		// End General Here
		
		// start progress title style
		$this->start_controls_section(
			'themedev_next_progress_title_style_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => ['themedev_next_progress_title_enable' => 'yes']
			]
		);
		
		// progress title color - style
		$this->add_control(
			'themedev_next_progress_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title' => 'color: {{VALUE}};',
				],
			]
		);
		//title typography - style
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_progress_title_typography',
			'selector'	 => '{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title',
			]
		);
		
		// Text Shadow title - style
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_progress_title_shadow',
                'selector' => '{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title',
				
            ]
        );
		
		$this->add_responsive_control(
			'themedev_next_progress_title_alignment', [
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
				'default'		 => 'left',
				 'selectors' => [
                    '{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content' => 'text-align: {{VALUE}} !important; width: 100%;',
					'{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title' => 'width: 100%;'
				],
			]
		);
		// title animation - style
		$this->add_control(
			'themedev_next_progress_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none'
			]
		);
		
		// General Style - title
		$this->add_control(
            'themedev_next_progress_title_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General title
		$this->add_responsive_control(
			'themedev_next_progress_title_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General title
		$this->add_responsive_control(
			'themedev_next_progress_title_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .themDev-single-skill-bar .skill-bar-content .skill-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		// end progress bar style
		
		// start progress bar style
		$this->start_controls_section(
			'themedev_next_progress_bar_style_section', [
				'label'	 => esc_html__( 'Bar', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		// visible title  bar headding 
		$this->add_control(
            'themedev_next_progress_bar_headding_visible',
            [
                'label' => esc_html__( 'Visible bar', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                //'separator' => 'before',
            ]
        );
		
		// background color bar - style
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'themedev_next_progress_bar_background_visible',
                'label'     => esc_html__( 'Background', 'next-addons' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress',
                'default'   => '',
				'condition' => ['themedev_next_progress_general_bar_style!' => ['stripe']]
            ]
        );
		$this->add_control(
			'themedev_next_progress_bar_background_visible_stripe', [
				'label'		 =>esc_html__( 'Background Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .style-stripe .themDev-single-skill-bar .nx-skill-progress' => 'background: repeating-linear-gradient(to right, {{VALUE}}, {{VALUE}} 4px, #FFFFFF 4px, #FFFFFF 8px);',
				],
				'condition' => ['themedev_next_progress_general_bar_style' => ['stripe']]
			]
		);
		// bar visible height style
		$this->add_control(
            'themedev_next_progress_bar_visible_height',
            [
                'label'     => esc_html__('Height', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				/*'default' => [
					'unit' => 'px',
					'size' => 3,
				],*/
				'selectors'  => ['{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress' => 'height: {{SIZE}}{{UNIT}};'],
            ]
        );
		// bar visible shadow - style
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'themedev_next_progress_bar_visible_shadow',
                'label' => esc_html__( 'Shadow', 'next-addons' ),
                'selector' => '
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40,
				{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress
				',
            ]
        );
		// border width - visible bar
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'themedev_next_progress_bar_visible_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress',
			]
		);
		// bar visible radius - style
        $this->add_control(
            'themedev_next_progress_bar_visible_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		// bar visible padding - style
		$this->add_responsive_control(
			'themedev_next_progress_bar_visible_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				/*'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0,
				],*/
				'selectors' => [
					'{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		// hidden bar headding
		$this->add_control(
            'themedev_next_progress_bar_headding_back',
            [
                'label' => esc_html__( 'Back bar', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		// background color bar - style
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'themedev_next_progress_bar_background_hidden',
                'label'     => esc_html__( 'Background', 'next-addons' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				',
                'default'   => ''
            ]
        );
		// bar hidden height style
		$this->add_control(
            'themedev_next_progress_bar_hidden_height',
            [
                'label'     => esc_html__('Height', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				/*'default' => [
					'unit' => 'px',
					'size' => 3,
				],*/
				'selectors'  => ['
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				' => 'height: {{SIZE}}{{UNIT}};'],
            ]
        );
		// bar hidden shadow - style
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'themedev_next_progress_bar_hidden_shadow',
                'label' => esc_html__( 'Shadow', 'next-addons' ),
                'selector' => '
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				',
            ]
        );
		
		// border width - visible bar
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'themedev_next_progress_bar_hidden_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40',
			]
		);
		// bar hidden radius - style
        $this->add_control(
            'themedev_next_progress_bar_hidden_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => ['
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		// icon
		$this->add_control(
            'themedev_next_progress_bar_style_icon',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => [ 'themedev_next_progress_general_bar_style' => 'inner-content'],
            ]
		);
		
		$this->add_control(
            'themedev_next_progress_bar_style_icon_type',
            [
                'label' => esc_html__( 'Size', 'next-addons' ),
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
                    '{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress .themedev-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);
		$this->add_control(
			'themedev_next_progress_bar_style_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons-pro' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress .themedev-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themDev-single-skill-bar .nx-skill-progress svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => [ 'themedev_next_progress_general_bar_style' => 'inner-content'],
			]
		);
		// General Style - bar
		$this->add_control(
            'themedev_next_progress_bar_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General bar
		$this->add_responsive_control(
			'themedev_next_progress_bar_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => ['{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General bar
		$this->add_responsive_control(
			'themedev_next_progress_bar_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => ['{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar12,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar20,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar24,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar28,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar32,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar36,
					{{WRAPPER}} .themDev-single-skill-bar .nx-skill-bar40
				' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		// end progress bar style
		
		// start percentange styles
		$this->start_controls_section(
			'themedev_next_progress_percentage_style_section', [
				'label'	 => esc_html__( 'Percentage', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => ['themedev_next_progress_bar_percentage_enable' => 'yes']
			]
		);
		// progress title color - style
		$this->add_control(
			'themedev_next_progress_percentage_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper' => 'color: {{VALUE}};',
				],
			]
		);
		//percentage typography - style
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_progress_percentage_typography',
			'selector'	 => '{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper',
			]
		);
		
		// Text Shadow percentage - style
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_progress_percentage_shadow',
                'selector' => '{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper',
				
            ]
        );
		// background fill color percentage - style
		
		$this->add_control(
			'themedev_next_progress_background_percentage_tooltip', [
				'label'		 =>esc_html__( 'Background Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper .nx-svg-content > svg' => 'fill: {{VALUE}};',
				],
				'condition' => ['themedev_next_progress_general_bar_style' => ['tooltip-style', 'stripe']]
			]
		);
		// background color percentage - style
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'themedev_next_progress_background_percentage',
                'label'     => esc_html__( 'Background', 'next-addons' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper,
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper:before
				',
                'default'   => '',
				'condition' => ['themedev_next_progress_general_bar_style!' => ['tooltip-style', 'tooltip-style2', 'stripe', 'ribbon']]
            ]
        );
		$this->add_control(
			'themedev_next_progress_background_percentage_tooltip2', [
				'label'		 =>esc_html__( 'Background Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .tooltip-style2 .themDev-single-skill-bar .number-percentage-wraper:before,
					{{WRAPPER}} .style-ribbon .themDev-single-skill-bar .number-percentage-wraper:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tooltip-style2 .themDev-single-skill-bar .number-percentage-wraper,
					{{WRAPPER}} .style-ribbon .themDev-single-skill-bar .number-percentage-wraper' => ' background-color: {{VALUE}};'
				],
				'condition' => ['themedev_next_progress_general_bar_style' => ['tooltip-style2', 'ribbon']]
			]
		);
		// border width - visible bar
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'themedev_next_progress_bar_percentage_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper',
				'condition' => ['themedev_next_progress_general_bar_style!' => ['stripe']]
			]
		);
		// bar hidden radius - style
        $this->add_control(
            'themedev_next_progress_border_radius_percentage',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => ['
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper
				' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition' => ['themedev_next_progress_general_bar_style!' => ['tooltip-style', 'stripe']]
            ]
        );
		// bar hidden height style
		$this->add_control(
            'themedev_next_progress_height_percentage',
            [
                'label'     => esc_html__('Height', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				
				'selectors'  => ['
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper
				' => 'height: {{SIZE}}{{UNIT}};'],
				'condition' => ['themedev_next_progress_general_bar_style!' => ['tooltip-style', 'stripe']]
            ]
        );
		$this->add_control(
            'themedev_next_progress_width_percentage',
            [
                'label'     => esc_html__('Width', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				
				'selectors'  => ['
					{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper
				' => 'width: {{SIZE}}{{UNIT}};'],
				'condition' => ['themedev_next_progress_general_bar_style!' => ['tooltip-style', 'stripe']]
            ]
        );
		
		// General Style - percentage
		$this->add_control(
            'themedev_next_progress_percentage_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General percentage
		$this->add_responsive_control(
			'themedev_next_progress_percentage_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General percentage
		$this->add_responsive_control(
			'themedev_next_progress_percentage_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => '',
					'bottom' => '',
					'left' => '',
					'right' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .themDev-single-skill-bar .number-percentage-wraper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// end percentange styles
		// start switch styles
		$this->start_controls_section(
			'themedev_next_progress_switch_style_section', [
				'label'	 => esc_html__( 'Switch', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => ['themedev_next_progress_general_bar_style' => 'switch']
			]
		);
		
		// switch height
		$this->add_control(
            'themedev_next_progress_switch_heading',
            [
                'label' => esc_html__( 'Switch', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// switch height
		$this->add_control(
            'themedev_next_progress_height_switch',
            [
                'label'     => esc_html__('Height', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before
				' => 'height: {{SIZE}}{{UNIT}};']
            ]
        );
		// switch weight
		$this->add_control(
            'themedev_next_progress_width_switch',
            [
                'label'     => esc_html__('Width', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before
				' => 'width: {{SIZE}}{{UNIT}};']
            ]
        );
		// top switch
		$this->add_control(
            'themedev_next_progress_width_switch_top',
            [
                'label'     => esc_html__('Top - Bottom', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before
				' => 'top: {{SIZE}}{{UNIT}};']
            ]
        );
		// border width - visible bar
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'themedev_next_progress_bar_switch_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before',
			]
		);
		// switch height
		$this->add_control(
            'themedev_next_progress_switch_heading_dotted',
            [
                'label' => esc_html__( 'Dotted', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// switch height
		$this->add_control(
            'themedev_next_progress_height_switch_dotted',
            [
                'label'     => esc_html__('Height', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:after
				' => 'height: {{SIZE}}{{UNIT}};']
            ]
        );
		// switch weight
		$this->add_control(
            'themedev_next_progress_width_switch_dotted',
            [
                'label'     => esc_html__('Width', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:after
				' => 'width: {{SIZE}}{{UNIT}};']
            ]
        );
		$this->add_control(
            'themedev_next_progress_width_switch_dotted_top',
            [
                'label'     => esc_html__('Top - Bottom', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:after
				' => 'top: {{SIZE}}{{UNIT}};']
            ]
        );
		$this->add_control(
            'themedev_next_progress_width_switch_dotted_right',
            [
                'label'     => esc_html__('Left - Right', 'next-addons'),
                'type'      => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 100,
						'step' => 1,
					],
					
				],
				
				'selectors'  => ['
					{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:after
				' => 'right: {{SIZE}}{{UNIT}};']
            ]
        );
		$this->add_control(
            'themedev_next_progress_switch_general_heading',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// switch color
		$this->add_control(
			'themedev_next_progress_switch_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:after, {{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before' => 'color: {{VALUE}};'
				],
				
			]
		);
		// switch background color
		$this->add_control(
			'themedev_next_progress_switch_background_color', [
				'label'		 =>esc_html__( 'Background', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .style-switch .themDev-single-skill-bar .nx-skill-progress:before' => 'background-color: {{VALUE}};'
				],
				
			]
		);
		
		$this->end_controls_section();
		// start custom style
		$this->start_controls_section(
			'themedev_next_progress_custom_style_section', [
				'label'	 => esc_html__( 'Custom Style', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		// custom css 
		$this->add_control(
			'themedev_next_progress_custom_class', [
				'label'			 =>esc_html__( 'Custom Class', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '.class-name', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
			]
		);
		
		
		$this->add_control(
			'themedev_next_progress_custom_css', [
				'label'			 =>esc_html__( 'Custom Css', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA ,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'css code here', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
				'description'	 =>esc_html__( 'Your custom css code for this section. Please sett your custom class after write your custom css code here.', 'next-addons' ),
			]
		);
		
		$this->end_controls_section();
		// end custom style
		
	}
	
	protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($themedev_next_progress_custom_css) > 2):
			NX_Config::instance()->inline_css($themedev_next_progress_custom_css);
		endif;
		
		$title_class = 'skill-title ';
		$title_class .= 'animated nx-'.$themedev_next_progress_title_animation;
		
		$groupClass = '';
		$skillClass = '';
		$progressClass = 'nx-skill-bar ';
		$percentageClass = '';
		if($themedev_next_progress_general_bar_style == 'inner-content'){
			$groupClass = ' skill-big gradient-bar multicolor-skill inner-content ';
			$skillClass = ' ';
			$progressClass = 'nx-skill-bar12 ';
		}else if($themedev_next_progress_general_bar_style == 'tooltip-style'){
			$groupClass = ' skill-medium tooltip-style color-style';
			$progressClass = 'nx-skill-bar20 ';
		}else if($themedev_next_progress_general_bar_style  == 'pin-style'){
			$groupClass = ' skill-medium pin-style track-color-style2';
			$skillClass = ' ';
			$progressClass = 'nx-skill-bar24 ';
			$percentageClass = ' style2';
		}else if($themedev_next_progress_general_bar_style  == 'tooltip-style2'){
			$groupClass = ' skill-medium tooltip-style2 track-color-style2';
			$skillClass = ' ';
			$progressClass = 'nx-skill-bar28 ';
			$percentageClass = ' style2';
		}else if($themedev_next_progress_general_bar_style  == 'switch'){
			$groupClass = ' style-switch color-style';
			$skillClass = ' ';
			$progressClass = 'nx-skill-bar32 ';
			$percentageClass = ' style2';
		}else if($themedev_next_progress_general_bar_style == 'stripe'){
			$groupClass = ' skill-medium tooltip-style color-style style-stripe';
			$progressClass = 'nx-skill-bar36 ';
			$percentageClass = ' style1';
		}else if($themedev_next_progress_general_bar_style == 'ribbon'){
			$groupClass = ' skill-medium style-ribbon track-color-style2';
			$skillClass = ' ';
			$progressClass = 'nx-skill-bar40 ';
			$percentageClass = ' style2';
		}
		
		
		
		if(in_array($themedev_next_progress_general_bar_style, ['normal', 'inner-content', 'pin-style', 'tooltip-style2', 'ribbon',''])){
			include( __DIR__ .'/include/normal.php');
		}else if(in_array($themedev_next_progress_general_bar_style, ['tooltip-style', 'stripe'])){
			include( __DIR__ .'/include/tooltip.php');
		}else if(in_array($themedev_next_progress_general_bar_style, ['switch'])){
			include( __DIR__ .'/include/switch.php');
		}
	?>
	 <!--progress bar style Start here-->
	
	<!--progress bar style End here-->
	<script type="text/javascript">
		jQuery(document).ready(function($){
			nx_progress_start( '.<?php echo esc_attr($elementorID);?>');
		});
	</script>
	<?php	  
		
    }
		
    protected function _content_template() { 
		
	}
}