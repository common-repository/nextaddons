<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Slider as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Slider extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-grid-nx', 'nextaddons-slider', 'nextaddons-slider-nx', 'nextaddons-slider-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-slider-nx', 'nextaddons-play-nx' ];
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
			'nextaddons_slider_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		if( !$this->help ):
		$this->add_control(
			'nextaddons_slider_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Slider Gallery, Video Gallery (Youtube, Vimeo, Dailymotion) styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/slider/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_slider_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_slider_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_slider_alignment', [
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
                    '{{WRAPPER}} .themedev-gallery-slider-wrapper  .slider-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_layout_type',
            [
                'label' => esc_html__( 'Layout', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'nx-bottom-layout',
                'options' => [
                    'nx-bottom-layout' => esc_html__( 'default', 'next-addons' ),
                    'nx-left-layout' => esc_html__( 'Left', 'next-addons' ),
                    'nx-right-layout' => esc_html__( 'Right', 'next-addons' ),
                    'nx-top-layout' => esc_html__( 'Top', 'next-addons' ),
				],
				'condition' => [
                    'nextaddons_slider_styles' => [ 'image-feed', 'video-feed']
				],
            ]
		);
		$this->add_responsive_control(
			'nextaddons_layout_width', [
				'label'		 =>esc_html__( 'Width', 'next-addons' ),
				'type'		 => Controls_Manager::SLIDER,
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
                    'unit' => '%',
                    'size' => 20,
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-left-layout .nxadd-gallery-slider-sync-thumb ' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-right-layout .nxadd-gallery-slider-sync-thumb ' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'nextaddons_layout_type' => [ 'nx-left-layout', 'nx-right-layout' ]
				],
			]
		);
		$this->end_controls_section();
        // End General Here
        
		 // Start gallery images Here
		 $this->start_controls_section(
			'nextaddons_slider_data_section',
			array(
				'label' => esc_html__( 'Photos', 'next-addons' ),
				'condition' => [
                    'nextaddons_slider_styles' => [ 'normal', 'image-feed']
				],
			)
        );
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_photos_title',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
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
            'nextaddons_photos_des',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Set description', 'next-addons-pro' ),
                'dynamic' => [
                    'active' => true
				],
				
            ]
        );
		
		$repeater->add_control(
			'nextaddons_photos_url',
			[
				'label' => esc_html__( 'Image', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
			]
		);

		$repeater->add_control(
            'nextaddons_photos_button_headding',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);

		$repeater->add_control(
			'nextaddons_photos_button_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'nextaddons_photos_button_name', [
				'label'			 =>esc_html__( 'Name', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Read more', 'next-addons' ),
				'default'	 =>esc_html__( 'Read more', 'next-addons' ),
				'condition' => [ 'nextaddons_photos_button_enable' => 'yes'],
			]
		);

		$repeater->add_control(
            'nextaddons_photos_button_link',
            [
                'label' => esc_html__( 'Link', 'next-addons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '',
				],
				'condition' => ['nextaddons_photos_button_enable' => 'yes']
            ]
		);

        $this->add_control(
            'nextaddons_slider_photos_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_photos_title}}}',
				'default' => [
                    [
                        'nextaddons_photos_title' => 'Title here 1',
                        'nextaddons_photos_des' => 'Details of photos',
                        'nextaddons_photos_url' => Utils::get_placeholder_image_src(),
					],
					[
                        'nextaddons_photos_title' => 'Title here 2',
                        'nextaddons_photos_des' => 'Details of photos',
                        'nextaddons_photos_url' => Utils::get_placeholder_image_src(),
					],
					[
                        'nextaddons_photos_title' => 'Title here 3',
                        'nextaddons_photos_des' => 'Details of photos',
                        'nextaddons_photos_url' => Utils::get_placeholder_image_src(),
					],

				]
            ]
        );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_photos',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'default' => 'full'
			]
		);

		$this->add_control(
			'nextaddons_photos_title_enable',
			[
				'label' => __( 'Title Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_photos_details_enable',
			[
				'label' => __( 'Details Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		
		 // Start gallery video Here
		 $this->start_controls_section(
			'nextaddons_videos_data_section',
			array(
				'label' => esc_html__( 'Videos', 'next-addons' ),
				'condition' => [
                    'nextaddons_slider_styles' => [ 'video-slider', 'video-feed']
				],
			)
        );
		if( !$this->help ):
			$this->add_control(
				'nextaddons_video_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Vimeo, Dailymotion videos URL Support in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/slider/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;

		$repeater = new Repeater();
		
		$repeater->add_control(
			'nextaddons_videos_overlay_set',
			[
				'label' => __( 'Set Overlay', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'nextaddons_videos_images',
			[
				'label' => esc_html__( 'Overlay', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'nextaddons_videos_overlay_set' => 'yes']
			]
		);
		$repeater->add_control(
            'nextaddons_videos_title',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
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
            'nextaddons_videos_des',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Set description', 'next-addons-pro' ),
                'dynamic' => [
                    'active' => true
				],
				
            ]
        );
		$repeater->add_control(
            'nextaddons_videos_url',
            [
                'label' => esc_html__( 'Video URL', 'next-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				'description' => 'Enter full vedio url. Example: https://www.youtube.com/watch?v=0Ii4yogRygMdf.',
				
            ]
		);
		$repeater->add_control(
            'nextaddons_videos_type',
            [
                'label' => esc_html__( 'Source Type', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => apply_filters( 'nextaddons_videos_slider_sourcetype', [
                    'youtube' => esc_html__( 'YouTube', 'next-addons' ),
				]),
				'description' => 'Vimeo, Dailymotion video url support in PRO.'
            ]
		);


        $this->add_control(
            'nextaddons_slider_videos_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_videos_title}}}',
				'default' => [
                    [
                        'nextaddons_videos_type' => 'youtube',
                        'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=fnPZ38vbIo8',
                        'nextaddons_videos_title' => 'Title here 1',
                        'nextaddons_videos_des' => 'Details of video',
					],
					[
                        'nextaddons_videos_type' => 'youtube',
						'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=o3oi1UHAO_M',
						'nextaddons_videos_title' => 'Title here 2',
                        'nextaddons_videos_des' => 'Details of video 2',
					],
					[
                        'nextaddons_videos_type' => 'youtube',
						'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=UFB-sR3Upd0',
						'nextaddons_videos_title' => 'Title here 3',
                        'nextaddons_videos_des' => 'Details of video 3',
					]
				]
            ]
        );

		$this->add_control(
			'nextaddons_videos_title_enable',
			[
				'label' => __( 'Title Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_videos_details_enable',
			[
				'label' => __( 'Details Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'nextaddons_videos_overlay_headding',
            [
                'label' => esc_html__( 'Overlay Image', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_videos',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'default' => 'full'
			]
		);

		$this->add_control(
			'nextaddons_videos_overlay_images',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'nextaddons_videos_iframe_headding',
            [
                'label' => esc_html__( 'iFrame', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
            'nextaddons_videos_iframe_width',
            [
                'label' => esc_html__( 'Width', 'next-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '960',
            ]
		);
		$this->add_responsive_control(
            'nextaddons_videos_iframe_height',
            [
                'label' => esc_html__( 'Height', 'next-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '600',
            ]
		);

		$this->add_control(
            'nextaddons_videos_settings_headding',
            [
                'label' => esc_html__( 'Settings', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_videos_settings_autoplay',
			[
				'label' => __( 'Autoplay', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->end_controls_section();

		// slide
		$this->start_controls_section(
			'nextaddons_slide_section', [
				'label'	 => esc_html__( 'Slide Controls', 'next-addons' ),
			]
		);
		
		$this->add_control(
            'nextaddons_slide_width',
            [
                'label'         => esc_html__('Item Size (PX)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default' 		=> '',
 
            ]
		);
		$this->add_control(
            'nextaddons_slide_spacing',
            [
                'label'         => esc_html__('Spacing (PX)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
				'default' 		=> '20',
				
            ]
		);
	
		$this->add_control(
            'nextaddons_slide_speed',
            [
                'label'         => esc_html__('Slide Speed (ms)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
				'default' 		=> '1500',
				
            ]
		);
		$this->add_control(
            'nextaddons_slide_dot',
            [
                'label' => esc_html__( 'Display dot control', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
				'default' => 'yes',
				
            ]
		);
		
		$this->add_control(
            'nextaddons_slide_arrow',
            [
                'label' => esc_html__( 'Display arrow control', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
				'default' => 'yes',
				
            ]
		);
		$this->add_control(
			'nextaddons_slide_arrow_left',
			[
				'label' => esc_html__( 'Left Icon', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_slide_arrow_lefts',
                'default' => [
                    'value' => 'nx-icon nx-icon-chevron-left',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_slide_arrow' => 'yes'],
			]
		);
		$this->add_control(
			'nextaddons_slide_arrow_right',
			[
				'label' => esc_html__( 'Right Icon', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_slide_arrow_rights',
                'default' => [
                    'value' => 'nx-icon nx-icon-chevron-right',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_slide_arrow' => 'yes'],
			]
		);
		$this->end_controls_section();


		
		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-gallery-slider-single-item .nxadd-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-gallery-slider-single-item .nxadd-title' => 'color: {{VALUE}};',
				],
				
			]
		);
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
			'selector'	 => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-subtitle',
			
			]
		);
		$this->add_control(
			'nextaddons_des_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-subtitle' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_section();

		
		// button
		$this->start_controls_section(
			'nextaddons_buttonstyle_section', [
				'label'	 => esc_html__( 'Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'nextaddons_slider_styles' => [ 'normal', 'image-feed']
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_slider_button_typography',
			'selector'	 => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a',
			]
		);

		$this->start_controls_tabs( 'nextaddons_slider_button_tabs' );
		
		
		$this->start_controls_tab(
			'nextaddons_slider_button_tab_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
				
			]
		);
		$this->add_control(
			'nextaddons_slider_button_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a' => 'color: {{VALUE}};',
				],
				
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_slider_button_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a',
				
			]
		);

		$this->add_control(
            'nextaddons_slider_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_slider_button_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a',
            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_slider_button_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a',
				'default'   => '',
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_slider_button_tab_hover',
            [
                'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_control(
			'nextaddons_slider_button_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a:hover' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_slider_button_border_hover',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a:hover',
				
			]
		);

		$this->add_control(
            'nextaddons_slider_button_border_radius_hover',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_slider_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a:hover',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_slider_button_background_pro_hover',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a:hover',
				'default'   => '',
				//'condition' => [ 'nextaddons_slider_styles' => ['normal'] ],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_slider_button_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_slider_button_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-btn-wraper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->end_controls_section();

		// Slider Control
		$this->start_controls_section(
			'nextaddons_slidestyle_section', [
				'label'	 => esc_html__( 'Slide Controls', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_dot_heading',
            [
                'label' => esc_html__( 'Dot', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				
            ]
		);
		
		
		$this->add_control(
            'dot_position_toggle',
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
            'dot_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'dot_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nx-control-dot' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'dot_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1050,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nx-control-dot' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    
                ],
            ]
        );

		$this->end_popover();

		$this->add_control(
            'nextaddons_dot_specing',
            [
                'label' => __( 'Specing', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.nx-control-dot > li.nx-dot-span' => 'margin-right: {{SIZE}}{{UNIT}}; ',
                ],
            ]
        );

		$this->add_control(
            'dot_width_toggle',
            [
                'label' => __( 'Size', 'next-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'next-addons' ),
                'label_on' => __( 'Custom', 'next-addons' ),
                'return_value' => 'yes',
            ]
        );
		$this->start_popover();

        $this->add_control(
            'dot_width_y',
            [
                'label' => __( 'Width', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'dot_width_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.nx-control-dot li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'dot_width_x',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'dot_width_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 250,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.nx-control-dot li' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();
		

		$this->add_control(
            'nextaddons_slidedot_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} ul.nx-control-dot li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		
		$this->start_controls_tabs( 'nextaddons_slidedot_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_slidedot_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_dot_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} ul.nx-control-dot > li.nx-dot-span' => 'background: {{VALUE}};',
				],
				
			]
		);


		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_slidedot_active',
            [
				'label' =>esc_html__( 'Active', 'next-addons' ),
            ]
		);	
		$this->add_control(
			'nextaddons_dot_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} ul.nx-control-dot > li.nx-dot-span.active' => 'background: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
            'nextaddons_arrow_heading',
            [
                'label' => esc_html__( 'Arrow', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
        );

		$this->add_control(
            'arrow_position_toggle',
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
            'arrow_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nx-previous, {{WRAPPER}} .nx-next' => 'top: {{SIZE}}{{UNIT}}; buttom: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
			'arrow_position_x',
			[
				'label' => __( 'Horizontal', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'arrow_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 250,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nx-previous' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
					'{{WRAPPER}} .nx-next' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
				],
			]
		);

		$this->end_popover();
		

		$this->add_control(
            'nextaddons_arrow_icon_width',
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
                    '{{WRAPPER}} .nx-previous' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-next' => 'width: {{SIZE}}{{UNIT}};  height: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_control(
            'nextaddons_arrow_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'next-addons' ),
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
                    '{{WRAPPER}} .nx-previous i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .nx-next i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_control(
            'nextaddons_arrow_icon_border',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .nx-previous' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}  .nx-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_responsive_control(
			'nextaddons_arrow_icon_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}}  .nx-previous' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .nx-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);

		$this->start_controls_tabs( 'nextaddons_slide_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_slide_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_arrow_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}}  .nx-previous i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}}   .nx-next i:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_arrow_icon_bgcolor', [
				'label'		 =>esc_html__( 'Background', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}}  .nx-previous' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}  .nx-next' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_slide_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);

		$this->add_control(
			'nextaddons_arrow_icon_color_hover', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}}  .nx-previous:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}}   .nx-next:hover i:before' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_arrow_icon_bgcolor_hover', [
				'label'		 =>esc_html__( 'Background', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}}  .nx-previous:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}  .nx-next:hover' => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		do_action('nextaddons_slider_tab_style_slide', $this);

		$this->end_controls_section();


		// tab
		$this->start_controls_section(
			'nextaddons_tabstyle_section', [
				'label'	 => esc_html__( 'Tab', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'nextaddons_tab_width', [
				'label'		 =>esc_html__( 'Width', 'next-addons' ),
				'type'		 => Controls_Manager::SLIDER,
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
                    'size' => 150,
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .slidercontent .nx-item' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_tab_brcolor', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .slidercontent .nx-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_tab_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-gallery-slider-wrapper .slidercontent .nx-item .nxadd-nav-item',
			]
		);
		$this->add_responsive_control(
			'nextaddons_tab_global_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .slidercontent .nx-item .nxadd-nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nextaddons_tab_global_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}}  .themedev-gallery-slider-wrapper .slidercontent .nx-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_active_heading',
            [
                'label' => esc_html__( 'Active Tab', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
		);

		$this->add_control(
			'nextaddons_tab_brcolor_active', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-item.active .nxadd-single-thumb' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_content_heading',
            [
                'label' => esc_html__( 'Content', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
		);

		$this->add_responsive_control(
			'nextaddons_tab_width_content', [
				'label'		 =>esc_html__( 'Width / Height', 'next-addons' ),
				'type'		 => Controls_Manager::SLIDER,
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
					'size' => '600'
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-bottom-layout .video-bottom-content' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-top-layout .video-bottom-content' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-left-layout .video-bottom-content' => 'max-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-right-layout .video-bottom-content' => 'max-height: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->add_control(
			'nextaddons_tab_brcolor_content', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nxadd-gallery-slider-sync-thumb' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_title_headding',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_tab_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-item .nxadd-single-thumb .nxadd-nav-item .nxadd-nav-title',
			
			]
		);
		$this->add_control(
			'nextaddons_tab_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-item .nxadd-single-thumb .nxadd-nav-item .nxadd-nav-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nextaddons_tab_title_enable',
			[
				'label' => __( 'Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
            'nextaddons_tab_details_headding',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_tab_details_enable',
			[
				'label' => __( 'Enable', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_tab_details_typography',
			'selector'	 => '{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-item .nxadd-single-thumb .nxadd-nav-item .nxadd-nav-credits',
			
			]
		);
		$this->add_control(
			'nextaddons_tab_details_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-item .nxadd-single-thumb .nxadd-nav-item .nxadd-nav-credits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_playbutton_section', [
				'label'	 => esc_html__( 'Play Button', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'nextaddons_slider_styles' => [ 'video-slider', 'video-feed']
				],
			]
		);
		$this->add_control(
			'nextaddons_tab_play_bgcolor', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-video-slider .nxadd-play-video-icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nextaddons_tab_play_bgcolor_hover', [
				'label'		 =>esc_html__( 'Back Color (Hover)', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-gallery-slider-wrapper .nx-video-slider .nxadd-play-video-icon:hover' => 'background-color: {{VALUE}};',
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
				'title' => esc_html__( 'Image Slider', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],
			'video-slider' => [
				'title' => esc_html__( 'Video Slider', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/video-slider.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/video-slider.jpg',
				'width' => '30%',
			],

			'image-feed' => [
				'title' => esc_html__( 'Image Feed', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/image-feed.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/image-feed.jpg',
				'width' => '30%',
			],

			'video-feed' => [
				'title' => esc_html__( 'Video Feed', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/video-feed.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/video-feed.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_slider_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-slider-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
	
		$classs = '';
		
		if(in_array($nextaddons_slider_styles, ['normal'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_slider_styles, ['video-slider'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/video-slider.php' ) ){
				include( NX_Config::get_next_dir() .'/include/video-slider.php');
			}
		} else if(in_array($nextaddons_slider_styles, ['image-feed'])){			
			$classs = 'button-style1';
			if( is_file( NX_Config::get_next_dir() .'/include/image-feed.php' ) ){
				include( NX_Config::get_next_dir() .'/include/image-feed.php');
			}
		} else if(in_array($nextaddons_slider_styles, ['video-feed'])){
			$classs = 'button-square-style';
			if( is_file( NX_Config::get_next_dir( ) .'/include/video-feed.php' ) ){
				include( NX_Config::get_next_dir( ) .'/include/video-feed.php');
			}
		} 
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				
			let x_mend = window.matchMedia("(max-width: 700px)");
			let id_nd = '<?php echo esc_attr($elementorID);?>';
				nx_slider_start(id_nd);
			});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}