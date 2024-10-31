<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Pricing as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Pricing extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-pricing', 'nextaddons-pricing-pro'];
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
			'nextaddons_pricing_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_pricing_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Pricing Style styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pricing-table/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_pricing_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_pricing_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_pricing_alignment', [
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
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'nextaddons_pricing_active_pricing',
			[
				'label' => __( 'Active Pricing', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [ 'nextaddons_pricing_styles' => ['wave', 'modern-services', 'hover-button', 'background-effect', 'arrow-effect', 'rotate-effect'] ],
			]
		);

		
		$this->end_controls_section();
		// End General Here

		// Start icon Here
		$this->start_controls_section(
			'nextaddons_pricing_icon_section',
			array(
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_styles' => ['hover-button', 'background-effect', 'arrow-effect'] ],
			)
		);

		$this->add_control(
			'nextaddons_pricing_icon_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_pricing_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_pricing_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-statamic',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_pricing_icon_enable' => 'yes'],
			]
		);
		$this->end_controls_section();
		
		// title section
		$this->start_controls_section(
			'nextaddons_pricing_title_section',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
			)
		);
		$this->add_control(
			'nextaddons_pricing_title_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_pricing_title', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'What is title? ', 'next-addons' ),
				'default'	 =>esc_html__( 'Free', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_title_enable' => 'yes'],
			]
		);
		
       $this->add_control(
			'nextaddons_pricing_title_tag',
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
					'p' => 'p',
				],
				'default' => 'h3',
				'condition' => [ 'nextaddons_pricing_title_enable' => 'yes'],
			]
		);
		
		// headding title animation
		$this->add_control(
			'nextaddons_pricing_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_pricing_title_enable' => 'yes'],
			]
		);
		$this->end_controls_section();

		// focus popular
		$this->start_controls_section(
			'nextaddons_pricing_popular_section',
			array(
				'label' => esc_html__( 'Special Focus', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_styles' => ['popular', 'hover-button', 'background-effect', 'arrow-effect', 'rotate-effect'] ],
			)
		);
		$this->add_control(
			'nextaddons_pricing_popular_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_pricing_popular_text', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'focus text', 'next-addons' ),
				'default'	 => 'Popular',
				'condition' => [ 'nextaddons_pricing_popular_enable' => 'yes'],
				'selectors' => [
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.nxadd-pricing-bridge:before' => 'content: "{{VALUE}}";',
				],
			]
		);

		$this->end_controls_section();


		// start here price
		$this->start_controls_section(
			'nextaddons_pricing_price_section',
			array(
				'label' => esc_html__( 'Price', 'next-addons' ),
			)
		);
		
		$this->add_control(
			'nextaddons_pricing_price_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'nextaddons_pricing_currency', [
				'label'			 =>esc_html__( 'Currency', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'Set currency ', 'next-addons' ),
				'default'	 => '$',
				'condition' => [ 'nextaddons_pricing_price_enable' => 'yes'],
			]
		);

		$this->add_control(
			'nextaddons_pricing_amount', [
				'label'			 =>esc_html__( 'Current Amount', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( '0.00', 'next-addons' ),
				'default'	 	 => '4.99',
				'condition' => [ 'nextaddons_pricing_price_enable' => 'yes'],
			]
		);

		$this->add_control(
			'nextaddons_pricing_beforeamount', [
				'label'			 =>esc_html__( 'Before Amount', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( '0.00', 'next-addons' ),
				'default'	 	 => '',
				'condition' => [ 'nextaddons_pricing_price_enable' => 'yes'],
			]
		);

	
		$this->add_control(
			'nextaddons_pricing_package', [
				'label'			 =>esc_html__( 'Package', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Set package duration. ', 'next-addons' ),
				'default'	 => '/Yearly',
				'condition' => [ 'nextaddons_pricing_price_enable' => 'yes'],
			]
		);

		$this->end_controls_section();


		// Start description Here
		$this->start_controls_section(
			'nextaddons_pricing_description_section',
			array(
				'label' => esc_html__( 'Sort title', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_styles' => ['normal', 'list-services', 'modern-services', 'background-effect', 'arrow-effect'] ],
			)
		);

		$this->add_control(
			'nextaddons_pricing_description_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'nextaddons_pricing_description', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Enter Description here ', 'next-addons' ),
				'default'	 =>esc_html__( 'Lorem Ipsum is simply dummy text of the {{printing}} and typesetting industry', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{printing}} for focusing title.', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_description_enable' => 'yes'],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_pricing_services_section',
			array(
				'label' => esc_html__( 'Services', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_styles!' => ['normal'] ],
			)
		);

		if( !$this->help ):
		$this->add_control(
			'nextaddons_pricing_table_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Use dynamic icons with styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pricing-table/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		$repeater = new Repeater();
		
		$repeater->add_control(
			'nextaddons_pricing_table_title',
			[
				'label' => __( 'Title', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1. Lorem Ipsum is simply dummy text.',
				'dynamic' => [
					'active' => true,
				],
				'label_block'	 => true,
			]
		);
		do_action('nextaddons_pricing_table_icons__1', $repeater);
		
		$this->add_control(
            'nextaddons_pricing_table_content',
            [
                'label' => esc_html__( 'Services list:', 'next-addons' ),
                'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{nextaddons_pricing_table_title}}',
                'default' => [
                    [
                        'nextaddons_pricing_table_title' => esc_html__( '1. Lorem Ipsum is simply dummy text.', 'next-addons' ),
                        'nextaddons_pricing_table_icons' => 'nx-icon nx-icon-checkmark2',
                    ],
                    [
						'nextaddons_pricing_table_title' => esc_html__( '2. Lorem Ipsum is simply dummy text.', 'next-addons' ),
						'nextaddons_pricing_table_icons' => 'nx-icon nx-icon-checkmark2',
                    ],
                    [
						'nextaddons_pricing_table_title' => esc_html__( '3. Lorem Ipsum is simply dummy text.', 'next-addons' ),
						'nextaddons_pricing_table_icons' => 'nx-icon nx-icon-cross',
                    ],
                ],
				'dynamic' => [
					'active' => true,
				],
            ]
		);
		
		$this->add_responsive_control(
			'nextaddons_pricing_services_alignment', [
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
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-list' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// start button 
		$this->start_controls_section(
			'nextaddons_pricing_button_section',
			array(
				'label' => esc_html__( 'Button', 'next-addons' ),
				//'condition' => [ 'nextaddons_pricing_styles' => ['button-box'] ],
			)
		);

		$this->add_control(
			'nextaddons_pricing_button_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_pricing_button_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'text',
				'condition' => [ 'nextaddons_pricing_button_enable' => 'yes'],
				
			]
		);
		$this->add_control(
			'nextaddons_pricing_button_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Button text', 'next-addons' ),
				'default'	 =>esc_html__( 'Purchase Now', 'next-addons' ),
				'condition' => [ 'nextaddons_pricing_button_enable' => 'yes', 'nextaddons_pricing_button_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_pricing_button_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_pricing_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-cart-plus',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_pricing_button_type' => ['icon', 'icon-text' ], 'nextaddons_pricing_button_enable' => 'yes' ],
			]
		);
		$this->add_control(
			'nextaddons_pricing_button_icon_position', [
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
                
				'condition' => [ 'nextaddons_pricing_button_type' => ['icon', 'icon-text' ],
								'nextaddons_pricing_button_enable' => 'yes'
							] 
			]
		);
		$this->add_control(
            'nextaddons_pricing_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_pricing_button_enable' => 'yes']
            ]
		);
		$this->add_control(
			'nextaddons_pricing_button_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_pricing_button_enable' => 'yes'],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_pricing_button_alignment', [
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
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action' => 'text-align: {{VALUE}};',
				],
				'condition' => [ 'nextaddons_pricing_button_enable' => 'yes'],
			]
		);
		$this->end_controls_section();
		//end button

		// general styles
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		// margin - General separator
		$this->add_responsive_control(
			'nextaddons_pricing_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_pricing_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->start_controls_tabs( 'nextaddons_pricing_general_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_pricing_general_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_pricing_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table',
				'default'   => '',
			]
		);
	
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_pricing_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table',
			]
		);

		$this->add_responsive_control(
            'nextaddons_pricing_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_pricing_shadow',
                'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table',
				
            ]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_pricing_general_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		
		if( !$this->help ):
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name'      => 'nextaddons_pricing_background_hover',
					'label'     => esc_html__( 'Background', 'next-addons' ),
					'types'     => [ 'classic'],
					'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover',
					'default'   => '',
				]
			);
		
			$this->add_control(
				'nextaddons_pricing_background_pro_notice',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Hover styles (Background, Box Shadow, Border etc) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pricing-table/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		do_action('nextaddons_pricing_general_hover_styles__1', $this);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .pricing-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .pricing-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_shadow',
                'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .pricing-title',
				
            ]
        );

		$this->add_responsive_control(
			'nextaddons_pricing_title_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		// icon styles
		$this->start_controls_section(
			'nextaddons_icontyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_icon_enable' => 'yes', 'nextaddons_pricing_styles' => ['hover-button', 'background-effect', 'arrow-effect'] ]
			]
		);
		
		$this->add_control(
            'nextaddons_nextaddons_icon_size',
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
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);
		

		if( !$this->help ):
			$this->add_control(
				'nextaddons_icon_color', [
					'label'		 =>esc_html__( 'Color', 'next-addons' ),
					'type'		 => Controls_Manager::COLOR,
					'default' => '',
					'selectors'	 => [
						'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .nextaddons-icon:before' => 'color: {{VALUE}};',
						'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
					],
					
				]
			);
			$this->add_control(
				'nextaddons_pricing_icon_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Icon Extra Features - normal & hover (Color, Background, Border, Border Radius, CSS Filter, Box Shadow) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pricing-table/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;

		do_action('nextaddons_pricing_icon_pro__1', $this);
		
		$this->add_responsive_control(
			'nextaddons_pricing_icon_paddins',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .nextaddons-icon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'nextaddons_pricing_icon_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header .nextaddons-icon'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-header svg'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		
		$this->end_controls_section();
		// price
		$this->start_controls_section(
			'nextaddons_peixestyle_section', [
				'label'	 => esc_html__( 'Price', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_price_enable' => 'yes']
			]
		);
		$this->add_control(
            'nextaddons_currency_heading',
            [
                'label' => esc_html__( 'Currency', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_currency_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price > sup',
			]
		);
		$this->add_control(
			'nextaddons_currency_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price > sup' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
            'nextaddons_amount_heading',
            [
                'label' => esc_html__( 'Amount', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_amount_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price',
			]
		);
		$this->add_control(
			'nextaddons_amount_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
            'nextaddons_beamount_heading',
            [
                'label' => esc_html__( 'Before Amount', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_beamount_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nx-before-price',
			]
		);
		$this->add_control(
			'nextaddons_beamount_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nx-before-price' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_package_heading',
            [
                'label' => esc_html__( 'Package', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_package_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price > sub',
			]
		);
		$this->add_control(
			'nextaddons_package_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-price > sub' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_pricebody_heading',
            [
                'label' => esc_html__( 'Body', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);

		$this->add_responsive_control(
			'nextaddons_pricebody_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_pricebody_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->start_controls_tabs( 'nextaddons_pricing_pricebody_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_pricing_pricebody_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_pricebody_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-pricing-tag,
				{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price.bg-price',
				'default'   => '',
			]
		);
		$this->add_control(
			'nextaddons_pricebody_borderarror', [
				'label'		 =>esc_html__( 'Arrow Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-tag.left-arrow:before' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.wave-style .nxadd-pricing-price:after' => 'border-color: {{VALUE}} transparent transparent;'
				],
				'condition' => ['nextaddons_pricing_styles' => ['arrow-effect', 'wave']]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_pricebody_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-pricing-tag,
				{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price.bg-price',
			]
		);

		$this->add_control(
            'nextaddons_pricebody_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-pricing-tag,
					{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price.bg-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_pricebody_shadow',
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price .nxadd-pricing-tag,
				{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price.bg-price',
				
            ]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_pricing_pricebody_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		
		if( !$this->help ):
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name'      => 'nextaddons_pricebody_background_hover',
					'label'     => esc_html__( 'Background', 'next-addons' ),
					'types'     => [ 'classic'],
					'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-price .nxadd-pricing-tag,
					{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-price.bg-price',
					'default'   => '',
				]
			);
		
			$this->add_control(
				'nextaddons_pricebody_background_pro_notice',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Hover styles (Background, Box Shadow, Border etc) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pricing-table/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		do_action('nextaddons_pricing_pricebody_hover_styles__1', $this);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();



		// Subtitle
		$this->start_controls_section(
			'nextaddons_subtitletyle_section', [
				'label'	 => esc_html__( 'Sort Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_description_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_subtitle_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-content > *,
			{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .pricing-subtitle',
			
			]
		);
		$this->add_control(
			'nextaddons_subtitle_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-content > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .pricing-subtitle' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_pricing_subtitle_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-content > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// spcial Title
		$this->start_controls_section(
			'nextaddons_spcialstyle_section', [
				'label'	 => esc_html__( 'Spacial Focus', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_popular_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_spical_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.nxadd-pricing-bridge:before',
			
			]
		);
		$this->add_control(
			'nextaddons_spical_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.nxadd-pricing-bridge:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_spical_bgcolor', [
				'label'		 =>esc_html__( 'Background', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.nxadd-pricing-bridge:before' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_pricing_spical_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table.nxadd-pricing-bridge:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

		// Services
		$this->start_controls_section(
			'nextaddons_servicesstyle_section', [
				'label'	 => esc_html__( 'Services', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_styles!' => ['normal'] ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_service_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-list li',
			
			]
		);
		$this->add_control(
			'nextaddons_service_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-list li' => 'color: {{VALUE}};',
				],
				
			]
		);

		do_action('nextaddons_pricing_services_icons__1', $this);

		$this->add_responsive_control(
			'nextaddons_pricing_service_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// start button style
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_pricing_button_enable' => 'yes', ]
				
			]
		);

		$this->add_control(
			'nextaddons_pricing_button_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
			]
		);
		
		$this->add_control(
            'nextaddons_pricing_button_icon_typography',
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
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
			
            ]
		);
		$this->start_controls_tabs( 'nextaddons_pricing_buttonicons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_pricing_buttonicons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_pricing_button_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_pricing_buttonicons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
            ]
		);
		$this->add_control(
			'nextaddons_pricing_button_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => ['nextaddons_pricing_button_type' => ['icon', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'nextaddons_pricing_button_text_heading',
			[
				'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']],
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_pricing_button_typography',
			'selector'	 => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn',
			'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_pricing_buttontext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_pricing_buttontext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_pricing_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_pricing_buttontext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_pricing_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_pricing_button_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// button tab
		$this->add_control(
            'nextaddons_pricing_buttonheading',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->start_controls_tabs( 'nextaddons_pricing_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_pricing_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_pricing_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn',
				
			]
		);

		$this->add_control(
			'nextaddons_pricing_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'next-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nextaddons_pricing_button_box_shadow',
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn',
				

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_pricing_button_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn',
				'default'   => '',
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_pricing_button_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_pricing_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn',
				
			]
		);

		$this->add_control(
			'nextaddons_pricing_button_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'next-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nextaddons_pricing_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn',
				

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_pricing_button_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table:hover .nxadd-pricing-action .nxadd-btn',
				'default'   => '',
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_pricing_button_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_pricing_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-pricing-area .nxadd-pricing-table .nxadd-pricing-action .nxadd-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
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
			'list-services' => [
				'title' => esc_html__( 'List Services', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/list-services.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/list-services.jpg',
				'width' => '30%',
			],
			'popular' => [
				'title' => esc_html__( 'Popular', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/popular.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/popular.jpg',
				'width' => '30%',
			],
			'wave' => [
				'title' => esc_html__( 'Wave', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/wave.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/wave.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_pricing_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$animation_title = '';
		if($nextaddons_pricing_title_animation != 'none'){
			$animation_title = 'animated nx-'.$nextaddons_pricing_title_animation;
		}

		$buttonAnimation = '';
		if($nextaddons_pricing_button_animation != 'none'){
			$buttonAnimation = 'animated nx-'.$nextaddons_pricing_button_animation;
		}


		$classs = '';
		
		if(in_array($nextaddons_pricing_styles, ['normal'])){
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['list-services'])){
			$classs = 'square-style';
			if( is_file( NX_Config::get_next_dir( ) .'/include/list-services.php' ) ){
				include( NX_Config::get_next_dir( ) .'/include/list-services.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['popular'])){
			$classs = 'colorfull-style';
			if($nextaddons_pricing_popular_enable == 'yes'){
				$classs .= ' nxadd-pricing-bridge';
			}
			
			if( is_file( NX_Config::get_next_dir( ) .'/include/popular.php' ) ){
				include( NX_Config::get_next_dir( ) .'/include/popular.php');
			}
		}else if(in_array($nextaddons_pricing_styles, ['wave'])){
			$classs = 'wave-style';
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			
			if( is_file( NX_Config::get_next_dir( ) .'/include/wave.php' ) ){
				include( NX_Config::get_next_dir( ) .'/include/wave.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['modern-services'])){
			$classs = 'modern-style';
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/modern-services.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/modern-services.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['hover-button'])){
			$classs = 'border-style';
			if($nextaddons_pricing_popular_enable == 'yes'){
				$classs .= ' nxadd-pricing-bridge';
			}
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-button.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/hover-button.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['background-effect'])){
			$classs = 'bg-wave-style';
			if($nextaddons_pricing_popular_enable == 'yes'){
				$classs .= ' nxadd-pricing-bridge';
			}
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/background-effect.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/background-effect.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['arrow-effect'])){
			$classs = 'border-style left-arrow-style';
			if($nextaddons_pricing_popular_enable == 'yes'){
				$classs .= ' nxadd-pricing-bridge';
			}
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/arrow-effect.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/arrow-effect.php');
			}
		} else if(in_array($nextaddons_pricing_styles, ['rotate-effect'])){
			$classs = 'bg-wave-style2';
			if($nextaddons_pricing_popular_enable == 'yes'){
				$classs .= ' nxadd-pricing-bridge';
			}
			if($nextaddons_pricing_active_pricing == 'yes'){
				$classs .= ' nxadd-active';
			}
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/rotate-effect.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/rotate-effect.php');
			}
		}
    }
    protected function _content_template() { 
		
	}
}