<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Info_Box as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Info_Box extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-infobox', 'nextaddons-infobox-pro'];
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
			'nextaddons_infobox_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_infobox_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Icon Box or Info Box styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/icon-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_infobox_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_infobox_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_infobox_alignment', [
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
                    '{{WRAPPER}} .nxadd-info_box ' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		// End General Here

	   // Start icon Here
	   $this->start_controls_section(
			'nextaddons_infobox_icon_section',
			array(
				'label' => esc_html__( 'Icon / Images', 'next-addons' ),
				'condition' => [ 'nextaddons_infobox_styles!' => ['serial-counter'] ],
			)
		);

		$this->add_control(
			'nextaddons_infobox_icon_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_infobox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-statamic',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_infobox_icon_enable' => 'yes'],
			]
		);

		// hover icon backgroud

		$this->add_control(
            'nextaddons_infobox_hover_icon_heading',
            [
                'label' => esc_html__( 'Icon 2', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'nextaddons_infobox_styles' => ['icon-hover', 'icon-gradient', 'fly-card'] ],
            ]
        );
		$this->add_control(
			'nextaddons_infobox_hover_icon_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_infobox_styles' => ['icon-hover', 'icon-gradient', 'fly-card'] ],
			]
		);
		$this->add_control(
			'nextaddons_infobox_hover_icon',
			[
				'label' => esc_html__( 'Icon 2', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_infobox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-alarm-clock2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_infobox_styles' => ['icon-hover', 'icon-gradient', 'fly-card'], 'nextaddons_infobox_hover_icon_enable' => 'yes' ],
			]
		);
		
		// hober image background
		$this->add_control(
            'nextaddons_infobox_hover_image_heading',
            [
                'label' => esc_html__( 'Image', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'nextaddons_infobox_styles' => ['image-hover', 'overlay-image', 'fly-card', 'list-overlay'] ],
            ]
        );
		$this->add_control(
			'nextaddons_infobox_hover_image_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_infobox_styles' => ['image-hover', 'overlay-image', 'fly-card', 'list-overlay'] ],
			]
		);
		$this->add_control(
			'nextaddons_infobox_hover_image',
			[
				'label' => esc_html__( 'Image', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' =>  NX_Config::get_next_url() . 'include/images/hover-image.png',
				],
				'condition' => [ 'nextaddons_infobox_styles' => ['image-hover', 'overlay-image', 'fly-card', 'list-overlay'], 'nextaddons_infobox_hover_image_enable' => 'yes' ],
			]
		);

		
		// overlay video
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'nextaddons_infobox_background_overlyimage',
                'label'     => esc_html__( 'Background', 'next-addons' ),
                'types'     => [ 'classic', 'gradient', 'video' ],
                'selector'  => '{{WRAPPER}} .themedev-info-box .nxadd-info_box.image-active.bg-image',
                'default'   => '',
				'condition' => ['nextaddons_infobox_styles' => ['overlay-video'] ],
            ]
		);

		$this->end_controls_section();
		// end image hover 

		$this->start_controls_section(
			'nextaddons_infobox_title_section',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
			)
		);
		$this->add_control(
			'nextaddons_infobox_title_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_infobox_title', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Grow your ', 'next-addons' ),
				'default'	 =>esc_html__( 'What is {{Lorem}} Ipsum?', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{Lorem}} for focusing title.', 'next-addons' ),
				'condition' => [ 'nextaddons_infobox_title_enable' => 'yes'],
			]
		);
		
       $this->add_control(
			'nextaddons_infobox_title_tag',
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
				'default' => 'h3',
				'condition' => [ 'nextaddons_infobox_title_enable' => 'yes'],
			]
		);
		$this->add_control(
			'nextaddons_infobox_title_focus_tag',
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
				'condition' => [ 'nextaddons_infobox_title_enable' => 'yes'],
			]
		);
		
		// headding title animation
		$this->add_control(
			'nextaddons_infobox_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_infobox_title_enable' => 'yes'],
				'description'	 =>esc_html__( 'Set animation for title.', 'next-addons' ),
				
			]
		);
		$this->add_control(
			'nextaddons_infobox_title_link_enable',
			[
				'label' => __( 'Enable Link', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
            'nextaddons_infobox_title_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_infobox_title_link_enable' => 'yes']
            ]
        );
		
		$this->add_control(
			'themedev_next_infobox_title_bar_enable',
			[
				'label' => __( 'Show Bar', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
        $this->end_controls_section();
		// End Title Here

		do_action('nextaddons_infobox_subtitle__content', $this);

		// Start icon Here
		$this->start_controls_section(
			'themedev_next_infobox_description_section',
			array(
				'label' => esc_html__( 'Description', 'next-addons' ),
			)
		);

		$this->add_control(
			'themedev_next_infobox_description_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'themedev_next_infobox_description', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Enter Description here ', 'next-addons' ),
				'default'	 =>esc_html__( 'Lorem Ipsum is simply dummy text of the {{printing}} and typesetting industry', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{printing}} for focusing title.', 'next-addons' ),
				'condition' => [ 'themedev_next_infobox_description_enable' => 'yes'],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_infobox_button_section',
			array(
				'label' => esc_html__( 'Button', 'next-addons' ),
				'condition' => [ 'nextaddons_infobox_styles' => ['icon-hover', 'button-box', 'overlay-image','icon-gradient', 'serial-counter', 'fly-card'] ],
			)
		);

		$this->add_control(
			'nextaddons_infobox_button_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_infobox_button_type',
			[
				'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'icon' => 'Icon', 'text' => 'Text', 'icon-text' => 'Icon with Text'],
				'default' => 'text',
				'condition' => [ 'nextaddons_infobox_button_enable' => 'yes'],
				
			]
		);
		$this->add_control(
			'nextaddons_infobox_button_text', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_infobox_button_enable' => 'yes', 'nextaddons_infobox_button_type' => ['text', 'icon-text' ]],
			]
		);

		$this->add_control(
			'nextaddons_infobox_button_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_imagebox_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-right-arrow-2',
                    'library' => 'nxicons',
                ],
				'condition' => [ 'nextaddons_infobox_button_type' => ['icon', 'icon-text' ], 'nextaddons_infobox_button_enable' => 'yes' ],
			]
		);
		$this->add_control(
			'nextaddons_infobox_button_icon_position', [
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
                
				'condition' => [ 'nextaddons_infobox_button_type' => ['icon', 'icon-text' ],
								'nextaddons_infobox_button_enable' => 'yes'
							] 
			]
		);
		
		$this->add_control(
            'nextaddons_infobox_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_infobox_button_enable' => 'yes']
            ]
		);
		$this->add_control(
			'nextaddons_infobox_button_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_infobox_button_enable' => 'yes'],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_infobox_button_alignment', [
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
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-btn-wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [ 'nextaddons_infobox_button_enable' => 'yes'],
			]
		);
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
			'nextaddons_infobox_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_infobox_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);


		$this->start_controls_tabs( 'nextaddons_infobox_general_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_infobox_general_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_infobox_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-info-box .nxadd-info_box, {{WRAPPER}} .themedev-info-box .nxadd-info_list .nxadd-icon.active-image:before',
				'default'   => '',
				'condition' => [ 'nextaddons_infobox_styles' => ['normal', 'icon-hover', 'icon-gradient', 'button-box', 'serial-counter', 'fly-card', 'list-card', 'list-overlay'] ],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_infobox_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box',
			]
		);

		$this->add_control(
            'nextaddons_infobox_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_infobox_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box',
				

            ]
		);
		
		if( !$this->help ):
			
			$this->add_control(
				'nextaddons_infobox_background_pro_notice',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Box Extra Features (Overlay Background) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/icon-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		do_action('nextaddons_infobox_general_pro__1', $this);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'nextaddons_infobox_general_tab_hover',
			[
				'label' =>esc_html__( 'Hover', 'next-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_infobox_background_hover_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-info-box .nxadd-info_box:hover,
				 {{WRAPPER}} .themedev-info-box .nxadd-info_list .nxadd-icon.active-image:before,
				 {{WRAPPER}} .themedev-info-box .nxadd-info_box.gradient:hover:before',
				'default'   => '',
				'condition' => [ 'nextaddons_infobox_styles' => ['normal', 'icon-hover', 'icon-gradient', 'button-box', 'serial-counter', 'fly-card', 'list-card', 'list-overlay'] ],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_infobox_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box:hover',
			]
		);

		$this->add_control(
            'nextaddons_infobox_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_infobox_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box:hover',
				

            ]
		);
		$this->add_responsive_control(
			'nextaddons_infobox_transform',
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
					'size' => -10,
				],
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box:hover' => 'transform:translateY({{SIZE}}{{UNIT}});',
				],
				
			]
		);
		
		do_action('nextaddons_infobox_general_pro__2', $this);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// icon styles
		$this->start_controls_section(
			'nextaddons_icontyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_infobox_icon_enable' => 'yes', 'nextaddons_infobox_styles!' => ['serial-counter'] ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_icon_typography',
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon:before',
			
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
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
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
						'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon:before' => 'color: {{VALUE}};',
						'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
					],
					
				]
			);
			$this->add_control(
				'nextaddons_infobox_icon_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Icon Extra Features - normal & hover (Color, Background, Border, Border Radius, CSS Filter, Box Shadow) are available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/icon-box/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;

		do_action('nextaddons_infobox_info_pro__1', $this);
		
		$this->add_responsive_control(
			'nextaddons_infobox_icon_paddins',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'nextaddons_infobox_icon_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		
		$this->end_controls_section();

		// hover icon
		// icon styles
		$this->start_controls_section(
			'nextaddons_hover_icontyle_section', [
				'label'	 => esc_html__( 'Icon 2', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_infobox_hover_icon_enable' => 'yes',
								 'nextaddons_infobox_styles' => ['icon-hover', 'icon-gradient', 'fly-card'] 
							] 
			]
		);
		
		$this->add_control(
            'nextaddons_hover_icon_typography',
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
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon2:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);
		$this->add_control(
			'nextaddons_hover_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon .nextaddons-icon2:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nextaddons_infobox_hover_icon_alignment', [
				'label'			 =>esc_html__( 'Position', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'left:0px;right: auto;'		 => [
						'title'	 =>esc_html__( 'Left', 'next-addons' ),
						'icon'	 => 'fa fa-align-left',
					],
					
					'left:auto;right: 0px;'		 => [
						'title'	 =>esc_html__( 'Right', 'next-addons' ),
						'icon'	 => 'fa fa-align-right',
					],
					
				],
				'default'		 => 'left:auto;right: 0px;',
                'selectors' => [
                    '{{WRAPPER}} .nxadd-info_box .nxadd-icon-hover' => '{{VALUE}}',
				],
				'condition' => [ 'nextaddons_infobox_styles!' => ['fly-card'] 
							] 
			]
		);
		$this->end_controls_section();


		// counter style
		$this->start_controls_section(
			'nextaddons_countertyle_section', [
				'label'	 => esc_html__( 'Counter', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_infobox_styles' => ['serial-counter']]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_counter_typography',
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .numeric-number',
			
			]
		);
		$this->add_control(
			'nextaddons_counter_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .numeric-number' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_counter_shadow',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .numeric-number',
				
            ]
        );
		

		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_infobox_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_shadow',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title',
				
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
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title > *',
			
			]
		);
		$this->add_control(
			'nextaddons_focustitle_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#4054b2',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title > *' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_focustitle_shadow',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-title > *',
				
            ]
		);
		
		
		$this->add_responsive_control(
			'nextaddons_infobox_title_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-body .nxadd-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nextaddons_title_color_bar', [
				'label'		 =>esc_html__( 'Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-heading-border' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-heading-border:before' => 'background-color: {{VALUE}}; box-shadow: 9px 0 0 0 {{VALUE}};'
				],
				'condition' => [ 'themedev_next_infobox_title_bar_enable' => 'yes', 'nextaddons_infobox_styles' => ['overlay-image'] ],
				
			]
		);
		$this->end_controls_section();

		do_action('nextaddons_infobox_subtitle__1', $this);

		// desctiption
		$this->start_controls_section(
			'nextaddons_desctiptionstyle_section', [
				'label'	 => esc_html__( 'Description', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_infobox_description_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_desctiption_typography',
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-des',
			
			]
		);
		$this->add_control(
			'nextaddons_desctiption_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-des' => 'color: {{VALUE}};',
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
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-info_box  .nxadd-des > *',
			
			]
		);
		$this->add_control(
			'nextaddons_focusdesctiption_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#4054b2',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-des > *' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_infobox_descroption_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-info_box .nxadd-body .nxadd-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		// start button style
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_infobox_button_enable' => 'yes', 
								'nextaddons_infobox_styles' => ['icon-hover', 'button-box', 'overlay-image', 'icon-gradient', 'serial-counter', 'fly-card']
							]
			]
		);

		$this->add_control(
            'nextaddons_infobox_button_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
            ]
        );
		
		$this->add_control(
            'nextaddons_infobox_button_icon_typography',
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
                    '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
			
            ]
		);

		$this->start_controls_tabs( 'nextaddons_infobox_buttonicons_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_infobox_buttonicons_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->add_control(
			'nextaddons_infobox_button_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_infobox_buttonicons_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
            ]
		);
		$this->add_control(
			'nextaddons_infobox_button_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_infobox_button_type' => ['icon', 'icon-text']]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_infobox_button_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']],
				'separator' => 'before'
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_infobox_button_typography',
			'selector'	 => '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a',
			'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']]
			]
		);
		$this->start_controls_tabs( 'nextaddons_infobox_buttontext_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_infobox_buttontext_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']],
			]
		);
		$this->add_control(
			'nextaddons_infobox_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']]
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_infobox_buttontext_tab_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']],
            ]
		);
		$this->add_control(
			'nextaddons_infobox_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper a' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_infobox_button_type' => ['text', 'icon-text']]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// button tab
		$this->add_control(
            'nextaddons_infobox_buttonheading',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );
		$this->start_controls_tabs( 'nextaddons_infobox_button_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_infobox_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_infobox_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a',
				
			]
		);

		$this->add_control(
            'nextaddons_infobox_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_infobox_button_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_infobox_button_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a',
				'default'   => '',
				//'condition' => [ 'nextaddons_infobox_styles' => ['normal'] ],
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_infobox_button_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_infobox_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper a',
				
			]
		);

		$this->add_control(
            'nextaddons_infobox_button_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_infobox_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper a',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_infobox_button_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-info-box:hover .nxadd-btn-wrapper a',
				'default'   => '',
				//'condition' => [ 'nextaddons_infobox_styles' => ['normal'] ],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_infobox_button_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_infobox_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-info-box .nxadd-btn-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'icon-hover' => [
				'title' => esc_html__( 'Icon Hover', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/icon-hover.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/icon-hover.jpg',
				'width' => '30%',
			],
			'icon-gradient' => [
				'title' => esc_html__( 'Icon Hover with Gradient', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/icon-gradient.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/icon-gradient.jpg',
				'width' => '30%',
			],
			'list-style' => [
				'title' => esc_html__( 'List Box', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/list-style.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/list-style.jpg',
				'width' => '30%',
			],
			'button-box' => [
				'title' => esc_html__( 'Button box', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/button-box.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/button-box.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_infobox_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$animationClass = '';
		if($nextaddons_infobox_title_animation != 'none'){
			$animationClass = 'animated nx-'.$nextaddons_infobox_title_animation;
		}

		$buttonAnimation = '';
		if($nextaddons_infobox_button_animation != 'none'){
			$buttonAnimation = 'animated nx-'.$nextaddons_infobox_button_animation;
		}

		$classs = '';
		
		if(in_array($nextaddons_infobox_styles, ['normal'])){
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['icon-hover'])){
			$classs = 'solid-active white-cl';
			if( is_file( NX_Config::get_next_dir() .'/include/icon-hover.php' ) ){
				include( NX_Config::get_next_dir() .'/include/icon-hover.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['icon-gradient'])){
			$classs = 'gradient white-cl';
			if( is_file( NX_Config::get_next_dir() .'/include/icon-gradient.php' ) ){
				include( NX_Config::get_next_dir() .'/include/icon-gradient.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['button-box'])){
			if( is_file( NX_Config::get_next_dir() .'/include/button-box.php' ) ){
				include( NX_Config::get_next_dir() .'/include/button-box.php');
			}
		}  else if(in_array($nextaddons_infobox_styles, ['list-style'])){
			$classs = 'nxadd-info_list';
			if( is_file( NX_Config::get_next_dir() .'/include/list-style.php' ) ){
				include( NX_Config::get_next_dir() .'/include/list-style.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['serial-counter'])){
			$classs = 'gradient white-cl';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/serial-counter.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/serial-counter.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['image-hover'])){
			$classs = 'image-active white-cl';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/image-hover.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/image-hover.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['overlay-image'])){
			$classs = 'image-active shape-divider colorfull-box bg-image';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/overlay-image.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/overlay-image.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['fly-card'])){
			$classs = 'fly-card image-active white-cl bg-image';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/fly-card.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/fly-card.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['list-card'])){
			$classs = 'nxadd-info_list';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/list-card.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/list-card.php');
			}
		} else if(in_array($nextaddons_infobox_styles, ['list-overlay'])){
			$classs = 'nxadd-info_list';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/list-overlay.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/list-overlay.php');
			}
		}
		?>
		
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}