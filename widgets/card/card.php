<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Card as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Card extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-card', 'nextaddons-card-pro'];
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
			'nextaddons_card_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		
		$this->add_control(
            'nextaddons_card_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_card_alignment', [
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
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-left-layout .nxadd-card-header' => 'flex-basis: {{SIZE}}{{UNIT}}; ',
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-right-layout .nxadd-card-header' => 'flex-basis: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-top-layout .nxadd-card-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-bottom-layout .nxadd-card-header' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);
		
		do_action('nextaddons_card_tab_general', $this);

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
            'nextaddons_content_price',
            [
                'label' => esc_html__( 'Price', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => '$10',
				'label_block'	 => false,
				
            ]
		);

		$this->add_control(
            'nextaddons_content_details',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
				'label_block'	 => true,
				
            ]
		);
		
		$this->add_control(
			'nextaddons_image_headding',
			[
				'label' => __( 'Image', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'nextaddons_card_image',
			[
				'label' => esc_html__( 'Image', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' =>  \Elementor\Utils::get_placeholder_image_src(),
				],
				
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'default' => 'full'
			]
		);
		
		$this->add_control(
			'nextaddons_button_headding',
			[
				'label' => __( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'nextaddons_button_text',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Buy Now',
				'label_block'	 => true,
				
            ]
		);

		$this->add_control(
			'nextaddons_icon_icons',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_icon_icon',
                'default' => [
                    'value' => 'nx-icon nx-icon-cart-plus',
                    'library' => 'nxicons',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_icon_icons_position', [
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
			]
		);

		$this->add_control(
            'nextaddons_content_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				
            ]
		);
		
		do_action('nextaddons_card_tab_data', $this);

		$this->end_controls_section();


		// General
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_responsive_control(
			'nextaddons_card_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_card_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);
		

		$this->start_controls_tabs( 'nextaddons_card_general_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_card_general_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_card_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themdev-card-area .nxadd-card-box',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_card_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box',
			]
		);

		$this->add_control(
            'nextaddons_card_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_card_box_shadow',
                'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box',
            ]
		);
	
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_card_general_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_card_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_card_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover',
			]
		);

		$this->add_control(
            'nextaddons_card_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_card_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover',
            ]
		);
	
		$this->add_responsive_control(
			'nextaddons_card_transform_hover',
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
				
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover' => 'transform:translateY({{SIZE}}{{UNIT}});',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_card_background_duration_hover',
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
                    '{{WRAPPER}}  .themdev-card-area .nxadd-card-box' => 'transition-duration: {{SIZE}}s',
                    '{{WRAPPER}}  .themdev-card-area .nxadd-card-box:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_card_tab_general_style', $this);

		$this->end_controls_section();

		// General
		$this->start_controls_section(
			'nextaddons_bodystyle_section', [
				'label'	 => esc_html__( 'Body', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_responsive_control(
			'nextaddons_body_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_body_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);
		$this->end_controls_section();	


		// start title style
		$this->start_controls_section(
			'nextaddons_titlestyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_title!' => '']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_card_title_typography',
			'selector'	 => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-title',
			]
		);

		$this->add_responsive_control(
			'nextaddons_card_title_spacing',
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
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-title' => 'margin-bottom:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->start_controls_tabs( 'nextaddons_card_titletext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_card_titletext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_card_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-title' => 'color: {{VALUE}};',
				],
			
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_card_titletext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_control(
			'nextaddons_card_title_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-card-title' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_card_tab_title_style', $this);

		$this->end_controls_section();

		// start Details style
		$this->start_controls_section(
			'nextaddons_detailsstyle_section', [
				'label'	 => esc_html__( 'Details', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_details!' => '']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_card_details_typography',
			'selector'	 => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-text .card-des',
			]
		);

		$this->add_responsive_control(
			'nextaddons_card_details_spacing',
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
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-text .card-des' => 'margin-bottom:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->start_controls_tabs( 'nextaddons_card_detailstext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_card_detailstext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_card_details_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-card-text .card-des' => 'color: {{VALUE}};',
				],
			
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_card_detailstext_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_card_details_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-card-text .card-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_card_tab_details_style', $this);

		$this->end_controls_section();

		// start price style
		$this->start_controls_section(
			'nextaddons_pricestyle_section', [
				'label'	 => esc_html__( 'Price', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_content_price!' => '']
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_card_price_typography',
			'selector'	 => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-product-price',
			]
		);

		$this->add_responsive_control(
			'nextaddons_card_price_spacing',
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
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-product-price' => 'margin-bottom:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->start_controls_tabs( 'nextaddons_card_pricetext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_card_pricetext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_card_price_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-product-price' => 'color: {{VALUE}};',
				],
			
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_card_pricetext_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_card_price_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-product-price' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_card_tab_price_style', $this);

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
			'name'		 => 'nextaddons_card_badge_typography',
			'selector'	 => '{{WRAPPER}} .themdev-card-area .nxadd-card-badge',
			]
		);

		$this->add_control(
			'nextaddons_card_badge_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-badge' => 'color: {{VALUE}};',
				],
			
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_card_badge_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themdev-card-area .nxadd-card-badge',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_card_badge_br',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-badge',
			]
		);

		$this->add_control(
            'nextaddons_card_badge_dor_ra',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_card_badge_box',
                'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-badge',
            ]
		);

		$this->add_responsive_control(
			'nextaddons_card_badge_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-badge' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
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
                    '{{WRAPPER}} .themdev-card-area .nxadd-card-badge' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    
                ],
            ]
        );

		$this->end_popover();

		do_action('nextaddons_card_tab_badge_style', $this);

		$this->end_controls_section();


		// Icon
		$this->start_controls_section(
			'nextaddons_iconstyle_section', [
				'label'	 => esc_html__( 'Image', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'featured_position_toggle',
			[
				'label' => __( 'Size', 'next-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'next-addons' ),
				'label_on' => __( 'Custom', 'next-addons' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();

		$this->add_responsive_control(
			'featured_position_y',
			[
				'label' => __( 'Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'featured_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area figure.nxadd-card-header img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
				],
			]
		);

		$this->add_responsive_control(
			'featured_position_x',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'featured_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area figure.nxadd-card-header img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
					
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'nextaddons_card_image_spacing',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
				
				],
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-top-layout .nxadd-card-header' => 'margin-bottom:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-bottom-layout .nxadd-card-header' => 'margin-top:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-left-layout .nxadd-card-header' => 'flex-basis:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box.nx-right-layout .nxadd-card-header' => 'flex-basis:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_image_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box figure.nxadd-card-header .nxcardbox',
			]
		);

		$this->add_control(
			'nextaddons_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'next-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box figure.nxadd-card-header .nxcardbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nextaddons_image_box_shadow',
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box figure.nxadd-card-header .nxcardbox',
			]
		);


		$this->add_responsive_control(
			'nextaddons_images_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box figure.nxadd-card-header .nxcardbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		do_action('nextaddons_card_tab_image_style', $this);

		$this->end_controls_section();


		// Button
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'nextaddons_button_icons_size',
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
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn span' => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn .nextaddons-icon:before' => 'font-size:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
				],
				
			]
		);
		
		$this->add_responsive_control(
			'nextaddons_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_button_details_spacing',
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
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn.nxadd-left-icon .nextaddons-icon' => 'margin-right:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn.nxadd-right-icon .nextaddons-icon' => 'margin-left:{{SIZE}}{{UNIT}};',
				],
				
			]
		);
		

		$this->start_controls_tabs( 'nextaddons_button_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_button_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_button_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
			]
		);

		$this->add_control(
			'nextaddons_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'next-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nextaddons_button_box_shadow',
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
			]
		);
	
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_button_button_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_button_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
			
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_button_background_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
			]
		);

		$this->add_control(
			'nextaddons_button_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'next-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nextaddons_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .themdev-card-area .nxadd-card-box:hover .nxadd-card-body .nxadd-btn-wrapper .nxadd-btn',
			]
		);
	
		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_button_tab_button_style', $this);

		$this->end_controls_section();

		do_action('nextaddons_card_tab', $this);

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
		return apply_filters( 'nextaddons_card_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-card-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$classs = '';
		if(in_array($nextaddons_card_styles, ['normal'])){
			
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