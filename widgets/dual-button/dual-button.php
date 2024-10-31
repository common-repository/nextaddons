<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Dual_Button as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;

use \NextAddons\Utilities\Help as Help;

class NextAddons_Dual_Button extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-dualbutton', 'nextaddons-dualbutton-pro'];
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
			'nextaddons_dualbutton_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		if( !$this->help ):
			$this->add_control(
				'nextaddons_dualbutton_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Dual Button styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/button/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		if( $this->help ):	
				$this->add_control(
					'nextaddons_dualbutton_styles_pro_enable',
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
            'nextaddons_dualbutton_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_dualbutton_alignment', [
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
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button' => 'text-align: {{VALUE}};',
				],
			]
		);
		 $this->end_controls_section();
		// End general Here

		
		$this->start_controls_section(
			'nextaddons_dualbutton_section',
			array(
				'label' => esc_html__( 'Button 1', 'next-addons' ),
				)
		);

		$this->add_control(
			'nextaddons_dualbutton_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'text',
				
			]
		);
		$this->add_control(
			'nextaddons_dualbutton_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_dualbutton_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_dualbutton_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_buttons_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-right-arrow-2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_dualbutton_type' => ['icon', 'icon-text' ]],
			]
		);
		$this->add_control(
			'nextaddons_dualbutton_icon_position', 
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
				'condition' => [ 'nextaddons_dualbutton_type' => ['icon', 'icon-text']] 
			]
		);
		
		$this->add_control(
            'nextaddons_dualbutton_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				
            ]
		);
	
		$this->add_control(
			'nextaddons_dualbutton_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				
			]
		);
		
		// effect for advance
		do_action('nextaddons_dualbutton_effect_pro__1', $this);


		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_dualbutton1_section',
			array(
				'label' => esc_html__( 'Button 2', 'next-addons' ),
				)
		);

		$this->add_control(
			'nextaddons_dualbutton1_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'text',
				
			]
		);
		$this->add_control(
			'nextaddons_dualbutton1_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_dualbutton1_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_dualbutton1_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_buttons_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-right-arrow-2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_dualbutton1_type' => ['icon', 'icon-text' ]],
			]
		);
		$this->add_control(
			'nextaddons_dualbutton1_icon_position', 
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
				'condition' => [ 'nextaddons_dualbutton1_type' => ['icon', 'icon-text']] 
			]
		);
		
		$this->add_control(
            'nextaddons_dualbutton1_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				
            ]
		);
	
		$this->add_control(
			'nextaddons_dualbutton1_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				
			]
		);
		
		$this->end_controls_section();

		// divider options
		do_action('nextaddons_dualbutton_divider_options', $this);
		
		// start button 1
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button 1', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,	
			]
		);

		$this->add_control(
            'nextaddons_dualbutton_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
            ]
        );
		
		$this->add_control(
            'nextaddons_dualbutton_icon_typography',
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
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
			
            ]
		);

		$this->start_controls_tabs( 'nextaddons_buttonicons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttonicons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_dualbutton_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttonicons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
            ]
		);
		$this->add_control(
			'nextaddons_dualbutton_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_dualbutton_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']],
				'separator' => 'before'
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_dualbutton_typography',
			'selector'	 => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one',
			'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_buttontext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttontext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_dualbutton_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttontext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_dualbutton_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']]
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
		$this->start_controls_tabs( 'nextaddons_dualbutton_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_dualbutton_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_dualbutton_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one',
				
			]
		);

		$this->add_control(
            'nextaddons_dualbutton_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_dualbutton_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_dualbutton_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one',
				'default'   => '',
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_dualbutton_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_dualbutton_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover',
				
			]
		);

		$this->add_control(
            'nextaddons_dualbutton_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_dualbutton_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_dualbutton_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_dualbutton_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_dualbutton_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		// end button 1


		// start button 2

		$this->start_controls_section(
			'nextaddons_buttonstyle1_section', [
				'label'	 => esc_html__( 'Button 2', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,	
			]
		);

		$this->add_control(
            'nextaddons_dualbutton1_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
            ]
        );
		
		$this->add_control(
            'nextaddons_dualbutton1_icon_typography',
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
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
			
            ]
		);

		$this->start_controls_tabs( 'nextaddons_buttonicons1_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttonicons1_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_dualbutton1_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttonicons1_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
            ]
		);
		$this->add_control(
			'nextaddons_dualbutton1_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton1_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_dualbutton1_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_dualbutton1_type' => ['text', 'icon-text']],
				'separator' => 'before'
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_dualbutton1_typography',
			'selector'	 => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two',
			'condition' => ['nextaddons_dualbutton_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_buttontext1_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_buttontext1_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton1_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_dualbutton1_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton1_type' => ['text', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_buttontext1_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_dualbutton1_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_dualbutton1_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_dualbutton1_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// button tab
		$this->add_control(
            'nextaddons_buttonheading1',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->start_controls_tabs( 'nextaddons_dualbutton1_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_dualbutton1_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_dualbutton1_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two',
				
			]
		);

		$this->add_control(
            'nextaddons_dualbutton1_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_dualbutton1_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_dualbutton1_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two',
				'default'   => '',
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_dualbutton1_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_dualbutton1_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover',
				
			]
		);

		$this->add_control(
            'nextaddons_dualbutton1_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_dualbutton1_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_dualbutton1_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_dualbutton1_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_dualbutton1_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		// end button 2


		// advance style

		do_action('nextaddons_dualbutton_effectstyle_pro__1', $this);

		

		// pro dual
		do_action('nextaddons_dualbutton_dividerstyle_pro__1', $this);


		// on hover
		$this->start_controls_section(
			'nextaddons_skew_section', [
				'label'	 => esc_html__( 'Skew Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_dualbutton_styles' => ['skew-button']]
			]
		);

		$this->add_control(
            'nextaddons_skew_scale',
            [
                'label' => esc_html__( 'Scale', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg'],
                'range' => [
                    'deg' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 5,
					]
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button.nx-skew-style .nxadd-dual-btn:before' => 'transform: skewX({{SIZE}}deg);',
                ],
			
			]
		);

		$this->add_control(
			'nextaddons_skew_button1_headding',
			[
				'label' => esc_html__( 'Button 1', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs( 'nextaddons_skew_button1_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_skew_button1_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_skew_button1_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:before',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_skew_button1_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_skew_button1_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-one:hover:before',
				'default'   => '',
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'nextaddons_skew_button2_headding',
			[
				'label' => esc_html__( 'Button 2', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'seperator' => 'before'
			]
		);
		$this->start_controls_tabs( 'nextaddons_skew_button2_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_skew_button2_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_skew_button2_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:before',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_skew_button2_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_skew_button2_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-dual-button-wrapper .nxadd-dual-button .nxadd-dual-btn-two:hover:before',
				'default'   => '',
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

			'skew-button' => [
				'title' => esc_html__( 'Skew Button', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/skew-button.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/skew-button.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_dualbutton_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$buttonAnimation = '';
		if($nextaddons_dualbutton_animation != 'none'){
			$buttonAnimation = 'animated nx-'.$nextaddons_dualbutton_animation;
		}

		$buttonAnimation1 = '';
		if($nextaddons_dualbutton1_animation != 'none'){
			$buttonAnimation1 = 'animated nx-'.$nextaddons_dualbutton1_animation;
		}

		$mclass = '';

		$classs = '';
		
		if(in_array($nextaddons_dualbutton_styles, ['normal', 'skew-button'])){
			$mclass = ($nextaddons_dualbutton_styles == 'skew-button') ? 'nx-skew-style' : $mclass;
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_dualbutton_styles, ['advance-pro'])){
			$classs = ($nextaddons_dualbutton_advance_effect != 'none') ? 'advance-button '. $nextaddons_dualbutton_advance_effect : '';
			$classs = ($nextaddons_dualbutton_advance_effect == 'animate-button') ? 'animate-button' : $classs;
			$classs = ($nextaddons_dualbutton_advance_effect == 'hover-animate') ? 'hover-animate' : $classs;
			$classs = ($nextaddons_dualbutton_advance_effect == 'hover-animate2') ? 'hover-animate2' : $classs;
			$classs = ($nextaddons_dualbutton_advance_effect == 'hover-animate3') ? 'hover-animate3' : $classs;
			$classs = ($nextaddons_dualbutton_advance_effect == 'hover-animate-right') ? 'hvr-right-to-left' : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/advance-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/advance-pro.php');
			}
		} 

		?>
		
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}