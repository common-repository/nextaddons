<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Hotspots as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Hotspots extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-hotspots-nx', 'nextaddons-hotspots', 'nextaddons-hotspots-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-hotspots-nx' ];
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
			'nextaddons_hotspots_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_hotspots_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Hotspots styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/hotspots/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;

		if( $this->help ):	
			$this->add_control(
				'nextaddons_hotspots_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_hotspots_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_control(
			'nextaddons_hotspots_images',
			[
				'label' => __( 'Choose Image', 'next-addons-pro' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'nextaddons_hotspots_move',
			[
				'label' => esc_html__( 'Enable Event', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Hover', 'next-addons' ),
                'label_off' => esc_html__( 'Click', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
			]
		);
		
		$this->end_controls_section();
		// End General Here


		$this->start_controls_section(
			'nextaddons_hotspots_items_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
				
			)
		);

		if( !$this->help ):
		$this->add_control(
			'nextaddons_hotspots_table_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More setup options available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/hotspots/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;

		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_hotspots_pointer_heading',
            [
                'label' => esc_html__( 'Pointer', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::HEADING,
            ]
        );
		$repeater->add_control(
			'nextaddons_hotspots_pointer',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text'],
				'default' => 'icon',
				
			]
        );
		
		$repeater->add_control(
			'nextaddons_hotspots_pointer_text',
			[
				'label' => __( 'Text', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1',
				'dynamic' => [
					'active' => true,
				],
				'label_block'	 => false,
				'condition' => ['nextaddons_hotspots_pointer' => 'text']
			]
		);

		$repeater->add_control(
			'nextaddons_hotspots_pointer_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_dualbutton_divider_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-map-marker',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_hotspots_pointer' => ['icon']],
			]
		);

		$repeater->add_control(
            'nextaddons_hotspots_data_heading',
            [
                'label' => esc_html__( 'Data', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$repeater->add_control(
			'nextaddons_hotspots_data_title',
			[
				'label' => __( 'Title', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Title here',
				'dynamic' => [
					'active' => true,
				],
				'label_block'	 => true,
			]
		);

		do_action('nextaddons_hotspots_items_data_1', $repeater);

		$repeater->add_control(
            'nextaddons_hotspots_data_position_pop',
            [
                'label' => __( 'Content Position', 'next-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'next-addons' ),
                'label_on' => __( 'Custom', 'next-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				
            ]
		);
		
		$repeater->start_popover();

        $repeater->add_responsive_control(
            'nextaddons_hotspots_data_control_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'nextaddons_hotspots_data_position_pop' => 'yes'
                ],
				'default' => [
					'unit' => 'px',
					'size' => '-38'
				],
                'selectors' => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus-pane' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
			'nextaddons_hotspots_data_control_x',
			[
				'label' => __( 'Horizontal', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nextaddons_hotspots_data_position_pop' => 'yes'
				],
				'default' => [
					'unit' => 'px',
					'size' => '-60'
				],
				'selectors' => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus-pane' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
			]
		);

		$repeater->end_popover();


		$repeater->add_control(
            'nextaddons_hotspots_data_position_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
            ]
		);
		
		$repeater->add_control(
            'nextaddons_hotspots_position_pop',
            [
                'label' => __( 'Position', 'next-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'next-addons' ),
                'label_on' => __( 'Custom', 'next-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
		);
		
		$repeater->start_popover();

        $repeater->add_responsive_control(
            'nextaddons_hotspots_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'nextaddons_hotspots_position_pop' => 'yes'
                ],
				'default' => [
					'unit' => '%',
				],
                'selectors' => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus-pane' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                ],
            ]
        );

        $repeater->add_responsive_control(
			'nextaddons_hotspots_position_x',
			[
				'label' => __( 'Horizontal', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nextaddons_hotspots_position_pop' => 'yes'
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus-pane' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image {{CURRENT_ITEM}}.nx-focus' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
			]
		);

		$repeater->end_popover();

		$repeater->add_control(
			'nextaddons_hotspots_data_show',
			[
				'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
			]
		);

		// extra features
		do_action('nextaddons_hotspots_items_pro_1', $repeater);
		
		$this->add_control(
            'nextaddons_hotspots_items',
            [
                'label' => esc_html__( 'Item list', 'next-addons' ),
                'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{nextaddons_hotspots_data_title}}',
                'default' => [
                    [
                        'nextaddons_hotspots_data_title' => esc_html__( 'Title here', 'next-addons' ),
                        'nextaddons_hotspots_pointer_text' => '1',
                        'nextaddons_hotspots_pointer_icon' => 'nx-icon nx-icon-map-marker',
                        'nextaddons_hotspots_position_y' => [
							'size' => '24',
							'unit' => '%',
						],
						'nextaddons_hotspots_position_x' => [
							'size' => '19',
							'unit' => '%',
						],
					],
					[
                        'nextaddons_hotspots_data_title' => esc_html__( 'Title here', 'next-addons' ),
                        'nextaddons_hotspots_pointer_text' => '2',
						'nextaddons_hotspots_pointer_icon' => 'nx-icon nx-icon-map-marker',
						
						'nextaddons_hotspots_position_y' => [
							'size' => '49',
							'unit' => '%',
						],
						'nextaddons_hotspots_position_x' => [
							'size' => '64',
							'unit' => '%',
						],
					],
					[
                        'nextaddons_hotspots_data_title' => esc_html__( 'Title here', 'next-addons' ),
                        'nextaddons_hotspots_pointer_text' => '3',
						'nextaddons_hotspots_pointer_icon' => 'nx-icon nx-icon-map-marker',
						'nextaddons_hotspots_position_y' => [
							'size' => '60',
							'unit' => '%',
						],
						'nextaddons_hotspots_position_x' => [
							'size' => '70',
							'unit' => '%',
						],
                    ],
                    
                ],
				'dynamic' => [
					'active' => true,
				],
            ]
		);
		

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_hotspots_contentstyle', [
				'label'	 => esc_html__( 'Data', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_hotspots_title_heading',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_hotspots_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hotspots-content .nxadd-hotspot-title',
			
			]
		);
		$this->add_control(
			'nextaddons_hotspots_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hotspots-content .nxadd-hotspot-title' => 'color: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
            'nextaddons_hotspots_details_heading',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_hotspots_styles' => ['advance-focus']],
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'		 => 'nextaddons_hotspots_details_typography',
				'selector'	 => '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hotspots-content .nxadd-hotspot-des',
				'condition' => ['nextaddons_hotspots_styles' => ['advance-focus']],
			]
		);
		$this->add_control(
			'nextaddons_hotspots_details_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hotspots-content .nxadd-hotspot-des' => 'color: {{VALUE}};',
				],
				'separator' => 'after',
				'condition' => ['nextaddons_hotspots_styles' => ['advance-focus']],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_hotspots_content_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content',
			]
		);

		$this->add_control(
            'nextaddons_hotspots_content_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_hotspots_content_shadow',
                'selector' => '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_hotspots_content_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_hotspots_contentbg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content',
				
			]
		);
		$this->add_control(
			'nextaddons_hotspots_content_barcolor', [
				'label'		 =>esc_html__( 'Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content:before' => 'border-color: {{VALUE}};',
				],
				
			]
		);
		$this->add_responsive_control(
            'nextaddons_hotspots_content_width',
            [
                'label' => esc_html__( 'Width', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 2000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
					]
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hotspots-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
			
			]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_hotspots_focusstyle', [
				'label'	 => esc_html__( 'Focus', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_hotspots_focus_icon_typography',
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
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner .hotspot-icon' => 'font-size: {{SIZE}}{{UNIT}}; ',
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);

		$this->add_control(
			'nextaddons_hotspots_focus_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner .hotspot-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-hotspots-area .nxadd-hotspots-wrapper .nxadd-hot-spots-image .nxadd-hots-pots-inner svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'separator' => 'after',
			]
		);

		do_action('nextaddons_hotspots_focusstyle_1', $this);

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
			
			
		];
		return apply_filters( 'nextaddons_hotspots_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-hotspots-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$classs = '';
		
		
		if(in_array($nextaddons_hotspots_styles, ['normal'])){
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_hotspots_styles, ['advance-focus'])){
			$classs = 'style-4';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/advance-focus.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/advance-focus.php');
			}
		} else if(in_array($nextaddons_hotspots_styles, ['team-focus'])){
			$classs = 'hotspot-team';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/team-focus.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/team-focus.php');
			}
		}
		?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			nx_focus_content( '#<?php echo esc_attr($elementorID);?>');
		});
	</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}