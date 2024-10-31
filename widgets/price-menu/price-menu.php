<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Price_Menu as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Price_Menu extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-price-menu', 'nextaddons-price-menu-pro'];
	}

	public function get_script_depends() {
		return [ ];
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
			'nextaddons_pricemenu_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		
		if( $this->help ):	
			$this->add_control(
				'nextaddons_pricemenu_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_pricemenu_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		$this->add_responsive_control(
			'nextaddons_pricemenu_alignment', [
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
                    '{{WRAPPER}} .themedev-image-slider-wrapper .nxadd-image-slider-item' => 'text-align: {{VALUE}};',
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
				'default' => 'nx-left-layout'
				
            ]
		);
		

		$this->add_responsive_control(
            'nextaddons_tabs_type_spacing',
            [
                'label' => esc_html__( 'Spacing', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .themedev-pricing-list-area .nxadd-single-price-list-block.nx-left-layout .nx-media-price' => 'flex-basis: {{SIZE}}{{UNIT}}; ',
                    '{{WRAPPER}} .themedev-pricing-list-area .nxadd-single-price-list-block.nx-right-layout .nx-media-price' => 'flex-basis: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-pricing-list-area .nxadd-single-price-list-block.nx-top-layout .nx-media-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-pricing-list-area .nxadd-single-price-list-block.nx-bottom-layout .nx-media-price' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		do_action('nextaddons_pricemenu_tab_general', $this);

		$this->end_controls_section();
        // End General Here
        
		 // Start gallery images Here
		 $this->start_controls_section(
			'nextaddons_pricemenu_data_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
			)
        );
		
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_menu_title',
            [
                'label' => esc_html__( 'Name', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		
		$repeater->add_control(
            'nextaddons_menu_badge_heading',
            [
                'label' => esc_html__( 'Badge', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::HEADING,
				'condition' => ['nextaddons_button_type' => ['icon', 'icon-text']]
            ]
        );
		
        $repeater->add_control(
			'nextaddons_menu_badge_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text'],
				'default' => 'text',
				
			]
		);
        
        $repeater->add_control(
            'nextaddons_menu_badge',
            [
                'label' => esc_html__( 'Text', 'next-addons-pro' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'NEW',
                'dynamic' => [
                    'active' => true
				],
                'label_block'	 => false,
                'condition' => [ 'nextaddons_menu_badge_type' => 'text']
				
            ]
        );

        $repeater->add_control(
			'nextaddons_menu_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_menu_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-gift',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_menu_badge_type' => ['icon']],
			]
        );
        
        
        $repeater->add_control(
            'nextaddons_menu_ratting',
            [
                'label' => esc_html__( 'Ratting', 'next-addons-pro' ),
                'type' =>  \Elementor\Controls_Manager::NUMBER,
                'default' => '5',
                'min' 			=> 1,
				'max' 			=> 5,
				'step' 			=> 1,
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
        );
        $repeater->add_control(
			'nextaddons_menu_photos',
			[
				'label' => esc_html__( 'Menu Photos', 'next-addons-pro' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' =>  \Elementor\Utils::get_placeholder_image_src(),
				],
				
			]
        );
		
		$repeater->add_control(
            'nextaddons_menu_price',
            [
                'label' => esc_html__( 'Price', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => '$10',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
            ]
        );
		
		 /*
        $repeater->add_control(
            'nextaddons_menu_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				
            ]
		);*/

        $repeater->add_control(
            'nextaddons_menu_des',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
            ]
		);
		
		do_action('nextaddons_pricemenu_menus_repeater',  $repeater);
		

        $this->add_control(
            'nextaddons_pricemenu_menu_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_menu_title}}}',
				'default' => [
                    [
                        'nextaddons_menu_title' => 'Smoke Combos',
                        'nextaddons_menu_price' => '$20',
                        'nextaddons_menu_des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                       
					],
					[
						'nextaddons_menu_title' => 'Ribs & Steaks',
						'nextaddons_menu_price' => '$30',
                        'nextaddons_menu_des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                       
					],
					[
						'nextaddons_menu_title' => 'Guiltless Grill',
						'nextaddons_menu_price' => '$50',
                        'nextaddons_menu_des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                       
					],
					[
						'nextaddons_menu_title' => 'Salads, Soups & Chili',
						'nextaddons_menu_price' => '$100',
                        'nextaddons_menu_des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                       
					],

				]
            ]
        );

		if( $this->help ):
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail_menu',
					'exclude' => [ 'custom' ],
					'separator' => 'none',
					'default' => 'full'
				]
			);

		endif;
		
		$this->end_controls_section();


		// general styles
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		// margin - General separator
		$this->add_responsive_control(
			'nextaddons_galley_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_galley_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	

		$this->end_controls_section();

		// Photos
		$this->start_controls_section(
			'nextaddons_itemstyle_section', [
				'label'	 => esc_html__( 'Items', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_items_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block',
				'default'   => '',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_items_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block',
				
			]
		);

		$this->add_control(
            'nextaddons_items_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_items_box',
                'selector' => '{{WRAPPER}}   .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block',
            ]
		);

		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_items_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nextaddons_items_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 10,
					'bottom' => 10,
					'left' => 10,
					'right' => 10,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nxadd-single-price-list-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		$this->end_controls_section();

		

		// Name
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Name', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .pricing-list-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .pricing-list-title' => 'color: {{VALUE}};',
				],
				
			]
		);
		do_action('nextaddons_pricemenu_tab_style_name', $this);
		$this->end_controls_section();

		// Price
		$this->start_controls_section(
			'nextaddons_pricetyle_section', [
				'label'	 => esc_html__( 'Price', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_price_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .pricing-list-price',
			
			]
		);
		$this->add_control(
			'nextaddons_price_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .pricing-list-price' => 'color: {{VALUE}};',
				],
				
			]
		);
		do_action('nextaddons_pricemenu_tab_style_price', $this);

		$this->end_controls_section();

		// Description
		$this->start_controls_section(
			'nextaddons_desstyle_section', [
				'label'	 => esc_html__( 'Details', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_des_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .product-des',
			
			]
		);
		$this->add_control(
			'nextaddons_des_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .product-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_section();

		// Photos
        $this->start_controls_section(
            'nextaddons_photostyle_section', [
                'label'	 => esc_html__( 'Photos', 'next-addons' ),
                'tab'	 => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'nextaddons_menu_width', [
                'label'		 =>esc_html__( 'Size', 'next-addons' ),
                'type'		 => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors'	 => [
                    '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-media-price img.nx-full-width' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nextaddons_menu_border',
                'label' => __( 'Border', 'next-addons' ),
                'selector' => '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-media-price img.nx-full-width',
                
            ]
        );

        $this->add_control(
            'nextaddons_menu_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-media-price img.nx-full-width' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_menu_box',
                'selector' => '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-media-price img.nx-full-width',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nextaddons_badgestyle_section', [
                'label'	 => esc_html__( 'Badge', 'next-addons' ),
                'tab'	 => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_badge_typography',
            'selector'	 => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-badge .badges-text,
            {{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-badge .badges-icon i:before',
			
			]
		);
		$this->add_control(
			'nextaddons_badge_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-badge .badges-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-badge .badges-icon i:before' => 'color: {{VALUE}};',
				],
				
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'nextaddons_rattingsstyle_section', [
                'label'	 => esc_html__( 'Ratting', 'next-addons' ),
                'tab'	 => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_rattings_typography',
            'selector'	 => '{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body,
            {{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body i:before',
			
			]
		);
		$this->add_control(
			'nextaddons_rattings_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body i:before' => 'color: {{VALUE}};',
				],
				
			]
        );
    
        $this->add_control(
			'nextaddons_rattings_bg', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body' => 'background-color: {{VALUE}};',
				],
				
			]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_rattings_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body',
				
			]
		);

		$this->add_control(
            'nextaddons_rattings_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_rattings_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-list-area .nx-pricemenu .nx-price-ratting .ratting-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

		do_action('nextaddons_pricemenu_tab', $this);

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
				'default'	 =>	esc_html__( '', 'next-addons' ),
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
		return apply_filters( 'nextaddons_pricemenu_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-pricemenu-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
	
		$classs = '';
		
		if(in_array($nextaddons_pricemenu_styles, ['normal'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_pricemenu_styles, ['smart-menu'])){
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/smart-menu.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/smart-menu.php');
			}
		} 
		?>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}