<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Image_Box as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Image_Box extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-imagebox', 'nextaddons-imagebox-pro'];
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
			'nextaddons_imagebox_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		if( !$this->help ):
			$this->add_control(
				'nextaddons_imagebox_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Images Box styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/image-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		if( $this->help ):	
				$this->add_control(
					'nextaddons_imagebox_styles_pro_enable',
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
            'nextaddons_imagebox_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_imagebox_alignment', [
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
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box ' => 'text-align: {{VALUE}};',
				],
			]
		);
		 $this->end_controls_section();
		// End general Here

		// image sections
		$this->start_controls_section(
			'nextaddons_imagebox_image_section',
			array(
				'label' => esc_html__( 'Image', 'next-addons' ),
				//'condition' => [ 'nextaddons_imagebox_styles!' => ['serial-counter'] ],
			)
		);
		$this->add_control(
			'nextaddons_imagebox_image_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);	
		$this->add_control(
			'nextaddons_imagebox_image',
			[
				'label' => esc_html__( 'Image', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' =>  \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [  'nextaddons_imagebox_image_enable' => 'yes' ],
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
			'nextaddons_imagebox_image_link_enable',
			[
				'label' => __( 'Enable Link', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);
		$this->add_control(
            'nextaddons_imagebox_image_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_imagebox_image_link_enable' => 'yes']
            ]
        );

		$this->end_controls_section();
		//end image section

		// start title
		$this->start_controls_section(
			'nextaddons_imagebox_title_section',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
				//'condition' => [ 'nextaddons_imagebox_styles!' => ['serial-counter'] ],
			)
		);

		$this->add_control(
			'nextaddons_imagebox_title_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_imagebox_title', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Grow your ', 'next-addons' ),
				'default'	 =>esc_html__( 'What is {{Lorem}} Ipsum?', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{Lorem}} for focusing title.', 'next-addons' ),
				'condition' => [ 'nextaddons_imagebox_title_enable' => 'yes'],
			]
		);
		
		$this->add_control(
			'nextaddons_imagebox_title_focus_tag',
			[
				'label' => esc_html__( 'Focus Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'strong' => 'strong',
					'em' => 'em',
				],
				'default' => 'span',
				'condition' => [ 'nextaddons_imagebox_title_enable' => 'yes'],
			]
		);
		
		// headding title animation
		$this->add_control(
			'nextaddons_imagebox_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_imagebox_title_enable' => 'yes'],
				'description'	 =>esc_html__( 'Set animation for title.', 'next-addons' ),
				
			]
		);
		
		$this->add_control(
            'nextaddons_imagebox_title_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_imagebox_title_enable' => 'yes']
            ]
		);
		

		// icon section
		$this->add_control(
			'nextaddons_imagebox_icon_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_imagebox_styles' => ['hover-shadow', 'hover-card', 'advanced-card'] ],
			]
		);
		$this->add_control(
			'nextaddons_imagebox_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-sphere',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_imagebox_icon_enable' => 'yes', 'nextaddons_imagebox_styles' => ['hover-shadow', 'hover-card', 'advanced-card']],
			]
		);
		$this->end_controls_section();
		//end title

		// Start description Here
		$this->start_controls_section(
			'themedev_next_imagebox_description_section',
			array(
				'label' => esc_html__( 'Description', 'next-addons' ),
			)
		);

		$this->add_control(
			'themedev_next_imagebox_description_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'themedev_next_imagebox_description', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Enter Description here ', 'next-addons' ),
				'default'	 =>esc_html__( 'Lorem Ipsum is simply dummy text of the {{printing}} and typesetting industry', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{printing}} for focusing title.', 'next-addons' ),
				'condition' => [ 'themedev_next_imagebox_description_enable' => 'yes'],
			]
		);
		$this->end_controls_section();

		// start button 
		$this->start_controls_section(
			'nextaddons_imagebox_button_section',
			array(
				'label' => esc_html__( 'Button', 'next-addons' ),
				//'condition' => [ 'nextaddons_imagebox_styles' => ['button-box'] ],
			)
		);

		$this->add_control(
			'nextaddons_imagebox_button_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_imagebox_button_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'icon',
				'condition' => [ 'nextaddons_imagebox_button_enable' => 'yes'],
				
			]
		);
		$this->add_control(
			'nextaddons_imagebox_button_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_imagebox_button_enable' => 'yes', 'nextaddons_imagebox_button_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_imagebox_button_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-right-arrow-2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_imagebox_button_type' => ['icon', 'icon-text' ], 'nextaddons_imagebox_button_enable' => 'yes' ],
			]
		);
		$this->add_control(
			'nextaddons_imagebox_button_icon_position', [
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
                
				'condition' => [ 'nextaddons_imagebox_button_type' => ['icon', 'icon-text' ],
								'nextaddons_imagebox_button_enable' => 'yes'
							] 
			]
		);
		$this->add_control(
            'nextaddons_imagebox_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_imagebox_button_enable' => 'yes']
            ]
		);
		$this->add_control(
			'nextaddons_imagebox_button_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_imagebox_button_enable' => 'yes'],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_imagebox_button_alignment', [
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
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-btn-wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [ 'nextaddons_imagebox_button_enable' => 'yes'],
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
			'nextaddons_imagebox_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_imagebox_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->start_controls_tabs( 'nextaddons_imagebox_general_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_imagebox_general_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_imagebox_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-image-box .nxadd-image-box',
				'default'   => '',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_imagebox_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-image-box .nxadd-image-box',
			]
		);

		$this->add_control(
            'nextaddons_imagebox_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-image-box .nxadd-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_imagebox_box_shadow',
                'selector' => '{{WRAPPER}}  .themedev-image-box .nxadd-image-box',
				

            ]
		);

		if( !$this->help ):
            $this->add_control(
                'nextaddons_imagebox_general_pro',
                [
                    'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Box Extra Features (Overlay, Opacity and more) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/image-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    'render_type' => 'ui',
                    
                ]
            );
         endif;
		// pro services call
		do_action('nextaddons_imagebox_general_pro_1', $this);
		
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_imagebox_general_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_imagebox_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-image-box .nxadd-image-box:hover',
				'default'   => '',
			]
		);

		
		do_action('nextaddons_imagebox_general_pro_2', $this);

		$this->add_responsive_control(
            'nextaddons_imagebox_transform',
            [
                'label' => __( 'Transform', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    'size' => -10,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .themedev-image-box .nxadd-image-box:hover' => 'transform:translateY({{SIZE}}{{UNIT}});',
                ],
                
            ]
        );
        
        
        $this->add_control(
            'nextaddons_imagebox_background_duration_hover',
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
                    '{{WRAPPER}}  .themedev-image-box .nxadd-image-box:hover' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// image styles
		$this->start_controls_section(
			'nextaddons_imagetyle_section', [
				'label'	 => esc_html__( 'Image', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_imagebox_image_enable' => 'yes' ]
			]
		);
		$this->add_responsive_control(
			'nextaddons_imagebox_image_width',
			[
				'label' => __( 'Width', 'next-addons' ),
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
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box img.nximagebox' => 'width:{{SIZE}}{{UNIT}}; object-fit: cover;',
				],
				
			]
		);
		$this->start_controls_tabs( 'image_css_effects' );

		$this->start_controls_tab( 'image_css_normal',
			[
				'label' => __( 'Normal', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_imagebox_image_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-image-box img.nximagebox',
			]
		);

		$this->add_control(
            'nextaddons_imagebox_image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box img.nximagebox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		do_action('nextaddons_imagebox_image_pro__1', $this);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'image_css_hover',
			[
				'label' => __( 'Hover', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_imagebox_image_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-image-box:hover img.nximagebox',
			]
		);

		$this->add_control(
            'nextaddons_imagebox_image_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box:hover img.nximagebox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		do_action('nextaddons_imagebox_image_pro__2', $this);
		
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		if( !$this->help ):
		$this->add_control(
			'nextaddons_imagebox_icon_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Image Extra Features - normal & hover (CSS Filter, Box Shadow) available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/image-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		$this->end_controls_section();

		// start button style
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_imagebox_button_enable' => 'yes']
				
			]
		);

		$this->add_control(
            'nextaddons_imagebox_button_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
            ]
        );
		
		$this->add_control(
            'nextaddons_imagebox_button_icon_typography',
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
                    '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
            ]
		);
		$this->start_controls_tabs( 'nextaddons_imagebox_buttonicons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_imagebox_buttonicons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_imagebox_button_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_imagebox_buttonicons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
            ]
		);

		$this->add_control(
			'nextaddons_imagebox_button_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				'condition' => ['nextaddons_imagebox_button_type' => ['icon', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
            'nextaddons_imagebox_button_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_imagebox_button_type' => ['text', 'icon-text']],
				'separator' => 'before'
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_imagebox_button_typography',
			'selector'	 => '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a',
			'condition' => ['nextaddons_imagebox_button_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_imagebox_buttontext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_imagebox_buttontext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_imagebox_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_imagebox_button_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_imagebox_buttontext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_imagebox_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper a' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_imagebox_button_type' => ['text', 'icon-text']]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		// button tab
		$this->add_control(
            'nextaddons_imagebox_buttonheading',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->start_controls_tabs( 'nextaddons_imagebox_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_imagebox_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_imagebox_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a',
				
			]
		);

		$this->add_control(
            'nextaddons_imagebox_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_imagebox_button_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_imagebox_button_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a',
				'default'   => '',
				//'condition' => [ 'nextaddons_imagebox_styles' => ['normal'] ],
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_imagebox_button_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_imagebox_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper a',
				
			]
		);

		$this->add_control(
            'nextaddons_imagebox_button_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_imagebox_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper a',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_imagebox_button_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-image-box:hover .nxadd-btn-wrapper a',
				'default'   => '',
				//'condition' => [ 'nextaddons_imagebox_styles' => ['normal'] ],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_imagebox_button_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_imagebox_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-btn-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_imagebox_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_shadow',
                'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title',
				
            ]
        );
		$this->add_control(
            'nextaddons_focustitle_style_heading',
            [
                'label' => esc_html__( 'Focus Title', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_focustitle_typography',
			'selector'	 => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title > *',
			
			]
		);
		$this->add_control(
			'nextaddons_focustitle_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#4054b2',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title > *' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_focustitle_shadow',
                'selector' => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title > *',
				
            ]
        );
		$this->add_responsive_control(
			'nextaddons_imagebox_title_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-image-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// icon styles
		$this->start_controls_section(
			'nextaddons_icontyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_imagebox_icon_enable' => 'yes', 'nextaddons_imagebox_styles' => ['hover-shadow', 'hover-card', 'advanced-card'] ]
			]
		);
		$this->add_control(
            'nextaddons_icon_typography',
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
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nextaddons-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);
		$this->add_control(
			'nextaddons_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				
			]
		);
		
		$this->end_controls_section();


		// desctiption
		$this->start_controls_section(
			'nextaddons_desctiptionstyle_section', [
				'label'	 => esc_html__( 'Description', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_imagebox_description_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_desctiption_typography',
			'selector'	 => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-des',
			
			]
		);
		$this->add_control(
			'nextaddons_desctiption_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
            'nextaddons_focusdesctiption_style_heading',
            [
                'label' => esc_html__( 'Focus Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_focusdesctiption_typography',
			'selector'	 => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-des > *',
			
			]
		);
		$this->add_control(
			'nextaddons_focusdesctiption_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#4054b2',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-des > *' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_imagebox_destitle_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// content body box
		$this->start_controls_section(
			'nextaddonsbodytyle_section', [
				'label'	 => esc_html__( 'Content Body', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_imagebox_background_body',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-box-body,
				 {{WRAPPER}} .themedev-image-box .nxadd-image-box .thumble-hover-content',
				'default'   => '',
			]
		);
		// margin - body
		$this->add_responsive_control(
			'nextaddons_imagebox_body_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-box-body,
					{{WRAPPER}} .themedev-image-box .nxadd-image-box .thumble-hover-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_imagebox_body_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box .nxadd-box-body,
					{{WRAPPER}} .themedev-image-box .nxadd-image-box .thumble-hover-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
            'nextaddons_solidborder_style_heading',
            [
                'label' => esc_html__( 'Bottom Border', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_imagebox_styles' => ['solid-border']]
            ]
        );
		$this->add_control(
			'nextaddons_solidborder_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box.hover-border-bottom .nxadd-box-body:before' => 'background-color: {{VALUE}};',
				],
				'condition' => ['nextaddons_imagebox_styles' => ['solid-border']]
			]
		);
		
		$this->add_control(
			'nextaddons_solidborder_height',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-image-box .nxadd-image-box.hover-border-bottom .nxadd-box-body:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['nextaddons_imagebox_styles' => ['solid-border']],
				'separator' => 'after',
			]
		);
		
		if( !$this->help ):
			$this->add_control(
				'nextaddons_imagebox_bodymessage_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Body Extra Features - (Box Shadow, Border, Border Radius) available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/image-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		do_action('nextaddons_imagebox_body_pro__1', $this);
		
		$this->end_controls_section();


		do_action('nextaddons_imagebox_tab', $this);

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
			'modern-style' => [
				'title' => esc_html__( 'Modern Style', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/modern-style.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/modern-style.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_imagebox_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$animationClass = '';
		if($nextaddons_imagebox_title_animation != 'none'){
			$animationClass = 'animated nx-'.$nextaddons_imagebox_title_animation;
		}

		$buttonAnimation = '';
		if($nextaddons_imagebox_button_animation != 'none'){
			$buttonAnimation = 'animated nx-'.$nextaddons_imagebox_button_animation;
		}

		$classs = 'overlay-bg ';
		
		if(in_array($nextaddons_imagebox_styles, ['normal'])){
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_imagebox_styles, ['modern-style'])){
			$classs = 'modern-style';
			if( is_file( NX_Config::get_next_dir() .'/include/modern-style.php' ) ){
				include( NX_Config::get_next_dir() .'/include/modern-style.php');
			}
		} else if(in_array($nextaddons_imagebox_styles, ['solid-border'])){
			$classs = 'style-solid hover-border-bottom';
			if( is_file( NX_Config::get_next_dir( 'pro') .'/include/solid-border.php' ) ){
				include( NX_Config::get_next_dir( 'pro') .'/include/solid-border.php');
			}
		}  else if(in_array($nextaddons_imagebox_styles, ['hover-shadow'])){
			$classs = 'floating-style';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-shadow.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/hover-shadow.php');
			}
		} else if(in_array($nextaddons_imagebox_styles, ['image-card'])){
			$classs = 'image-card';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/image-card.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/image-card.php');
			}
		}  else if(in_array($nextaddons_imagebox_styles, ['hover-card'])){
			$classs = 'thumble-card';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-card.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/hover-card.php');
			}
		} else if(in_array($nextaddons_imagebox_styles, ['advanced-card'])){
			$classs = 'image-card colorfull';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/advanced-card.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/advanced-card.php');
			}
		}
		?>
		
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}