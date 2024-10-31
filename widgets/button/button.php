<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Button as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;

use \NextAddons\Utilities\Help as Help;

class NextAddons_Button extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-button', 'nextaddons-button-pro', 'nextaddons-popup-nx'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-popup-nx' ];
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
			'nextaddons_button_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		if( !$this->help ):
			$this->add_control(
				'nextaddons_button_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Button styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/button/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		if( $this->help ):	
				$this->add_control(
					'nextaddons_button_styles_pro_enable',
					[
						'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
						'type' => Controls_Manager::RAW_HTML,
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
						'render_type' => 'ui',
						
					]
				);
		endif;
		// style choose
		$this->add_control(
            'nextaddons_button_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_button_alignment', [
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
                    '{{WRAPPER}} .themedev-button-area .nxadd-single-btn' => 'text-align: {{VALUE}};',
				],
			]
		);
		 $this->end_controls_section();
		// End general Here

		
		$this->start_controls_section(
			'nextaddons_button_section',
			array(
				'label' => esc_html__( 'Button', 'next-addons' ),
				)
		);

		$this->add_control(
			'nextaddons_button_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'text',
				
			]
		);
		$this->add_control(
			'nextaddons_button_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_button_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_button_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_buttons_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-right-arrow-2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_button_type' => ['icon', 'icon-text' ]],
			]
		);
		$this->add_control(
			'nextaddons_button_icon_position', 
			[
				'label'			 =>esc_html__( 'Position', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'next-addons' ),
						'icon'	 => 'fa fa-align-left',
					],
					
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'next-addons' ),
						'icon'	 => 'fa fa-align-right',
					],
					
				],
				'default'		 => 'left',
				'condition' => [ 'nextaddons_button_type' => ['icon', 'icon-text']] 
			]
		);
		
		$this->add_control(
			'nextaddons_button_linkmessage',
			[
				'raw' => '<strong>' . esc_html__( 'Use lik or Youtube, PRO (Vimeo and Dailymotion) Video Popup.', 'next-addons' ) . '</strong> ' ,
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		$this->add_control(
			'nextaddons_button_linktype',
			[
				'label' => esc_html__( 'Link Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'link' => 'Link', 'video' => 'Video'],
				'default' => 'link',
				
			]
		);
		$this->add_control(
            'nextaddons_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => [ 'nextaddons_button_linktype' => 'link']
            ]
		);

		$this->add_control(
            'nextaddons_button_video',
            [
                'label' => esc_html__( 'Video Link', 'next-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=fnPZ38vbIo8',
				'condition' => [ 'nextaddons_button_linktype' => 'video']
            ]
		);
	
	
		$this->add_control(
			'nextaddons_button_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				
			]
		);
		
		// effect for advance
		do_action('nextaddons_button_effect_pro__1', $this);

		// animate text
		do_action('nextaddons_button_animatetext_pro__1', $this);

		// animate pro
		do_action('nextaddons_button_animatepro__1', $this);

		$this->end_controls_section();

		
		
		// start button style
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
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
            ]
        );
		
		$this->add_control(
            'nextaddons_button_icon_typography',
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
                    '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
			
            ]
		);

		$this->start_controls_tabs( 'nextaddons_buttonicons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttonicons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_button_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttonicons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
            ]
		);
		$this->add_control(
			'nextaddons_button_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_button_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_button_type' => ['text', 'icon-text']],
				'separator' => 'before'
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_button_typography',
			'selector'	 => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn',
			'condition' => ['nextaddons_button_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_buttontext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttontext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_button_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_button_type' => ['text', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttontext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_button_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_button_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// button tab
		$this->add_control(
            'nextaddons_buttonheading',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->start_controls_tabs( 'nextaddons_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn',
				
			]
		);

		$this->add_control(
            'nextaddons_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_button_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn',
				'default'   => '',
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_button_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover',
				
			]
		);

		$this->add_control(
            'nextaddons_button_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn:hover',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_button_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();


		// advance style

		do_action('nextaddons_button_effectstyle_pro__1', $this);

		// Hover Animate

		do_action('nextaddons_button_hoveranimate_pro__1', $this);

		// Animate Pro

		do_action('nextaddons_button_animationpro_style__1', $this);

		// Hover Scale

		do_action('nextaddons_button_hoverscale_pro__1', $this);


		// on hover
		$this->start_controls_section(
			'nextaddons_onhover_section', [
				'label'	 => esc_html__( 'On Hover', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_button_styles' => ['on-hover']]
			]
		);
		$this->add_control(
            'nextaddons_onhover_border1_headding',
            [
                'label' => esc_html__( 'Top Border', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
        );
		$this->add_responsive_control(
			'nextaddons_onhover_border1_width',
			[
				'label' => __( 'Height', 'next-addons' ),
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
				
				'selectors' => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn.on-hover:before' => 'height:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_onhover_border1_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn.on-hover:before' => 'background: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_control(
            'nextaddons_onhover_border2_headding',
            [
                'label' => esc_html__( 'Left Border', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
        );
		$this->add_responsive_control(
			'nextaddons_onhover_border2_width',
			[
				'label' => __( 'Width', 'next-addons' ),
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
				
				'selectors' => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn.on-hover:after' => 'width:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_onhover_border2_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-button-area .nxadd-single-btn .nxadd-btn.on-hover:after' => 'background: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_section();

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
			/*'simple-hover' => [
				'title' => esc_html__( 'Simple Hover', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],*/
			'gradient' => [
				'title' => esc_html__( 'Gradient', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/gradient.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/gradient.jpg',
				'width' => '30%',
			],
			/*'gradient-hover' => [
				'title' => esc_html__( 'Gradient Hover', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],*/
			'on-hover' => [
				'title' => esc_html__( 'On Hover', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/on-hover.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/on-hover.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_button_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$buttonAnimation = '';
		if($nextaddons_button_animation != 'none'){
			$buttonAnimation = 'animated nx-'.$nextaddons_button_animation;
		}

		$classs = 'nx-btn-primary';
		
		if(in_array($nextaddons_button_styles, ['normal', 'simple-hover', 'gradient', 'gradient-hover', 'on-hover'])){
			$classs = ($nextaddons_button_styles == 'simple-hover') ? 'nx-btn-outline-primary' : $classs;
			$classs = ($nextaddons_button_styles == 'gradient') ? 'nx-btn-info nx-btn-gra gradient' : $classs;
			$classs = ($nextaddons_button_styles == 'gradient-hover') ? 'nxadd-btn nx-btn-outline-info gradient-border' : $classs;
			$classs = ($nextaddons_button_styles == 'on-hover') ? 'nx-nx-btn-info on-hover' : $classs;
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_button_styles, ['advance-effect'])){
			$classs = ($nextaddons_button_styles == 'advance-effect') ? 'advance-button '.$nextaddons_button_advance_effect  : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/advance-effect.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/advance-effect.php');
			}
		} else if(in_array($nextaddons_button_styles, ['hover-icon', 'hover-scale'])){
			$classs = ($nextaddons_button_styles == 'hover-icon') ? 'nx-btn-primary icon-before ' : $classs;
			$classs = ($nextaddons_button_styles == 'hover-scale') ? 'hover-scale ' : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-icon.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/hover-icon.php');
			}
		} else if(in_array($nextaddons_button_styles, ['animate-text'])){
			$classs = ($nextaddons_button_styles == 'animate-text') ? 'nx-btn-primary nxadd-round animate-button ' : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/animate-text.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/animate-text.php');
			}
		} else if(in_array($nextaddons_button_styles, ['hover-animate', 'hover-animate2', 'hover-animate3', 'hover-animate-right'])){
			$classs = ($nextaddons_button_styles == 'hover-animate') ? 'hover-animate ' : $classs;
			$classs = ($nextaddons_button_styles == 'hover-animate2') ? 'hover-animate2 ' : $classs;
			$classs = ($nextaddons_button_styles == 'hover-animate3') ? 'hover-animate3 ' : $classs;
			$classs = ($nextaddons_button_styles == 'hover-animate-right') ? 'hvr-right-to-left ' : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-animate.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/hover-animate.php');
			}
		} else if(in_array($nextaddons_button_styles, ['animate-pro', 'animate-pro2'])){
			$classs = ($nextaddons_button_styles == 'animate-pro') ? 'nxadd-modren-button '.$nextaddons_animatepro_effect  : $classs;
			$classs = ($nextaddons_button_styles == 'animate-pro2') ? 'nxadd-modren-button bg-icon-style '.$nextaddons_animatepro_effect  : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/animate-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/animate-pro.php');
			}
		} 

		?>
		<?php if($nextaddons_button_linktype == 'video'){?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				nx_popup_image('.nx-popup-data');
			});
			</script>
		<?php }?>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}