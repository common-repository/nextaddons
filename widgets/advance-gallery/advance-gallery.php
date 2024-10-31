<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Advance_Gallery as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Advance_Gallery extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-grid-nx', 'nextaddons-mixingallery', 'nextaddons-mixin-nx', 'nextaddons-popup-nx', 'nextaddons-mixingallery-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-popup-nx', 'nextaddons-mixin-nx'];
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
			'nextaddons_adgallery_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		if( !$this->help ):
		$this->add_control(
			'nextaddons_adgallery_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Images Gallery, Video Gallery (Youtube, Vimeo, Dailymotion) styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/tab-gallery/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_adgallery_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_adgallery_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		$this->add_responsive_control(
			'nextaddons_adgallery_alignment', [
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
                    '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-gallery-style .nxadd-mix-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_layout_type',
            [
                'label' => esc_html__( 'Layout', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'nx-top-layout',
                'options' => [
					'nx-top-layout' => esc_html__( 'Default', 'next-addons' ),
					'nx-left-layout' => esc_html__( 'Left', 'next-addons' ),
                    'nx-right-layout' => esc_html__( 'Right', 'next-addons' ),
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
					'{{WRAPPER}} .nx-left-layout .nxadd-main-filter' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .nx-right-layout .nxadd-main-filter' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'nextaddons_layout_type' => [ 'nx-left-layout', 'nx-right-layout' ]
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_style',
            [
                'label' => esc_html__( 'Tab style', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
					'style-1' => esc_html__( 'Default', 'next-addons' ),
					'nxadd-square' => esc_html__( 'Square Pro', 'next-addons' ),
                    'nxadd-square-border' => esc_html__( 'Square Border', 'next-addons' ),
                   
				],
				
            ]
		);
		$this->end_controls_section();
        // End General Here
		
		$this->start_controls_section(
			'nextaddons_adgallery_tab_section',
			array(
				'label' => esc_html__( 'Tab', 'next-addons' ),
				
			)
        );
		$repeater = new Repeater();
		$repeater->add_control(
            'nextaddons_tab_title',
            [
                'label' => esc_html__( 'Name', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Tab',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => false,
				
            ]
		);
		$repeater->add_control(
            'nextaddons_tab_id',
            [
                'label' => esc_html__( 'Id', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'tab1',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => false,
				'description' => 'Tab id must be unique.',
				
            ]
		);
		$this->add_control(
            'nextaddons_tab_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_tab_title}}}',
				'default' => [
                    [
                        'nextaddons_tab_title' => 'Tab 1',
                        'nextaddons_tab_id' => 'tab1',
					],
					[
						'nextaddons_tab_title' => 'Tab 2',
						'nextaddons_tab_id' => 'tab2',
					],

				]
            ]
		);
		
		$this->add_responsive_control(
			'nextaddons_adgallery_tabalignment', [
				'label'			 =>esc_html__( 'Lab Alignment', 'next-addons' ),
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
                    '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-gallery-style .nxadd-main-filter' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();


		 // Start gallery images Here
		 $this->start_controls_section(
			'nextaddons_adgallery_data_section',
			array(
				'label' => esc_html__( 'Photos', 'next-addons' ),
				'condition' => [
                    'nextaddons_adgallery_styles' => [ 'normal' ]
				],
			)
        );
		
		$repeater = new Repeater();
		$repeater->add_control(
            'nextaddons_photos_tab',
            [
                'label' => esc_html__( 'Tab Id', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'tab1',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => false,
				'description' => 'Select tab id.',
				
            ]
		);
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
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
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

        $this->add_control(
            'nextaddons_adgallery_photos_items',
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
						'nextaddons_photos_tab' => 'tab1'
					],
					[
                        'nextaddons_photos_title' => 'Title here 2',
                        'nextaddons_photos_des' => 'Details of photos',
						'nextaddons_photos_url' => Utils::get_placeholder_image_src(),
						'nextaddons_photos_tab' => 'tab2'
					],
					[
                        'nextaddons_photos_title' => 'Title here 3',
                        'nextaddons_photos_des' => 'Details of photos',
						'nextaddons_photos_url' => Utils::get_placeholder_image_src(),
						'nextaddons_photos_tab' => 'tab1'
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

		
		$this->end_controls_section();
		
		 // Start gallery video Here
		 $this->start_controls_section(
			'nextaddons_videos_data_section',
			array(
				'label' => esc_html__( 'Videos', 'next-addons' ),
				'condition' => [
                    'nextaddons_adgallery_styles' => [ 'video-gallery', 'smart-video']
				],
			)
        );
		if( !$this->help ):
			$this->add_control(
				'nextaddons_video_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Vimeo, Dailymotion videos URL Support in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/tab-gallery/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
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
            'nextaddons_videos_tab',
            [
                'label' => esc_html__( 'Tab Id', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'tab1',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => false,
				'description' => 'Select tab id.',
				
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
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
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
				'description' => 'Enter full vedio url. Example: https://www.youtube.com/watch?v=0Ii4yogRygMdf.',
				'label_block'	 => true,
            ]
		);
		$repeater->add_control(
            'nextaddons_videos_type',
            [
                'label' => esc_html__( 'Source Type', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => apply_filters( 'nextaddons_advideos_sourcetype', [
                    'youtube' => esc_html__( 'YouTube', 'next-addons' ),
				]),
				'description' => 'Vimeo, Dailymotion video url support in PRO.'
            ]
		);

		//do_action('nextaddons_adgallery_videos_title__1', $repeater);

        $this->add_control(
            'nextaddons_adgallery_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_videos_type}}}',
				'default' => [
                    [
                        'nextaddons_videos_type' => 'youtube',
                        'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=0Ii4yogRygM',
                        'nextaddons_videos_title' => 'Title here 1',
                        'nextaddons_videos_des' => 'Details of video',
                        'nextaddons_videos_tab' => 'tab1',
					],
					[
                        'nextaddons_videos_type' => 'youtube',
						'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=o3oi1UHAO_M',
						'nextaddons_videos_title' => 'Title here 2',
						'nextaddons_videos_des' => 'Details of video 2',
						'nextaddons_videos_tab' => 'tab2',
					],
					[
                        'nextaddons_videos_type' => 'youtube',
						'nextaddons_videos_url' => 'https://www.youtube.com/watch?v=UFB-sR3Upd0',
						'nextaddons_videos_title' => 'Title here 3',
						'nextaddons_videos_des' => 'Details of video 3',
						'nextaddons_videos_tab' => 'tab1',
					]
				]
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
				'default' => '400',
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


		// start controls of gallery
		$this->start_controls_section(
			'nextaddons_adgallery_control_section',
			array(
				'label' => esc_html__( 'Control', 'next-addons' ),
				
			)
		);
		$this->add_control(
            'nextaddons_adgallery_type',
            [
                'label' => esc_html__( 'Style', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__( 'Grid', 'next-addons' ),
					'masonry' => esc_html__( 'Masonry', 'next-addons' ),
                ],
            ]
		);
		
        $_columns = range( 1, 12 );
		
		$gallery_columns = array_combine( $_columns, $_columns );
		
        $this->add_responsive_control(
            'nextaddons_adgallery_columns',
            [
                'label' => esc_html__( 'Columns', 'next-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => $gallery_columns,
				'selectors'	=> [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content.nxadd-masonary-style' => 'column-count: {{VALUE}};',
				],
                'condition' => [
                    'nextaddons_adgallery_type' => [ 'masonry' ]
				],
				
            ]
		);
		$this->add_responsive_control(
            'nextaddons_adgallery_columns_gap',
            [
                'label' => esc_html__( 'Gap', 'next-addons' ),
                'type' => Controls_Manager::NUMBER,
                'selectors'	=> [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content.nxadd-masonary-style' => 'column-gap: {{VALUE}}px;',
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content.nxadd-masonary-style .nxadd-gallery-item' => 'margin-bottom: {{VALUE}}px;',
				],
                'condition' => [
                    'nextaddons_adgallery_type' => [ 'masonry' ]
				],
				
            ]
		);
		
		$this->add_responsive_control(
            'nextaddons_adgallery_columns_maxwidth',
            [
                'label' => esc_html__( 'Max Width(%)', 'next-addons' ),
				'type' => Controls_Manager::NUMBER,
				
                'selectors'	=> [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content.grid-style .nxadd-gallery-item' => 'width: {{VALUE}}%;',
				],
                'condition' => [
                    'nextaddons_adgallery_type' => [ 'grid' ]
				],
				
            ]
		);
		$this->add_responsive_control(
            'nextaddons_adgallery_columns_height',
            [
                'label' => esc_html__( 'Max Height(px)', 'next-addons' ),
				'type' => Controls_Manager::NUMBER,
				
                'selectors'	=> [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content.grid-style .nxadd-gallery-item' => 'height: {{VALUE}}px;',
				],
                'condition' => [
                    'nextaddons_adgallery_type' => [ 'grid' ]
				],
				
            ]
		);
		
		// enable popup
		$this->add_control(
            'nextaddons_adgallery_popup_headding',
            [
                'label' => esc_html__( 'Popup', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_adgallery_popup_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'nextaddons_adgallery_overlay_headding',
            [
                'label' => esc_html__( 'Overlay', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_adgallery_overlay_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		// title
		$this->add_control(
            'nextaddons_adgallery_title_headding',
            [
                'label' => esc_html__( 'Title', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_adgallery_title_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);
		// details
		$this->add_control(
            'nextaddons_adgallery_details_headding',
            [
                'label' => esc_html__( 'Details', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_adgallery_details_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);
		$this->add_control(
            'nextaddons_adgallery_icon_headding',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_adgallery_overlay_enable_icon',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);

		$this->add_control(
			'nextaddons_adgallery_overlay_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_adgallery_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-eye-slash',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_adgallery_overlay_enable_icon' => 'yes', 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);
		$this->add_control(
			'nextaddons_adgallery_overlay_icon_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_adgallery_overlay_enable_icon' => 'yes', 'nextaddons_adgallery_overlay_enable' => 'yes'],
				
			]
		);
        $this->end_controls_section();
		
		
		// general
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
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_galley_background',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content',
				'default'   => '',
			]
		);

		$this->add_control(
			'nextaddons_galley_button_icon_color', [
				'label'		 =>esc_html__( 'Overlay Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content .nxadd-hover-area:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_tabstyle_section', [
				'label'	 => esc_html__( 'Tab', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_tab_typography',
			'selector'	 => '{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item > a.nx-controls',
			
			]
		);
		$this->add_control(
			'nextaddons_tab_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item > a.nx-controls' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nextaddons_tab_bordercolor', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nxadd-main-filter.style-1 > .nxadd-nav-item > a.nx-controls:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square > .nxadd-nav-item > a.nx-controls' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square-border > .nxadd-nav-item > a.nx-controls' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_active_heading',
            [
                'label' => esc_html__( 'Active', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_tab_typography_active',
			'selector'	 => '{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item > a.nx-controls.nx-active',
			
			]
		);
		$this->add_control(
			'nextaddons_tab_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item > a.nx-controls.nx-active' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'nextaddons_tab_bccolor_active', [
				'label'		 =>esc_html__( 'Back Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square > .nxadd-nav-item > a.nx-controls.nx-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square-border > .nxadd-nav-item > a.nx-controls.nx-active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nextaddons_tab_bordercolor_active', [
				'label'		 =>esc_html__( 'Border Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .nxadd-main-filter.style-1 > .nxadd-nav-item > a.nx-controls.nx-active:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square-border > .nxadd-nav-item > a.nx-controls.nx-active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .nxadd-main-filter.nxadd-square-border > .nxadd-nav-item > a.nx-controls:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_tab_global_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);

		$this->add_responsive_control(
			'nextaddons_tab_global_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item > a.nx-controls' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .nxadd-main-filter > .nxadd-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// icon style
		$this->start_controls_section(
			'nextaddons_iconstyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_adgallery_overlay_enable' => 'yes'],
			]
		);

		
		$this->add_control(
			'nextaddons_galley_play_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'nextaddons_galley_play_icon_size', [
				'label'		 =>esc_html__( 'Size(px)', 'next-addons' ),
				'type'		 => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
				],
			]
		);

		
		$this->add_responsive_control(
			'nextaddons_adgallery_iconbutton_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon .nextaddons-icon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_galley_iconbutton_headding',
            [
                'label' => esc_html__( 'Button', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_galley_iconbutton_bgcolor',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon',
				'default'   => '',
			]
		);


		$this->add_control(
			'nextaddons_galley_playbutton_icon_size', [
				'label'		 =>esc_html__( 'Sizing', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_galley_playbutton_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon',
			]
		);
		$this->add_control(
            'nextaddons_galley_playbutton_borderradius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_galley_playbutton_boxshadow',
                'selector' => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content  .nxadd-gallery-icon',
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
			'selector'	 => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content .nxadd-gallery-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content .nxadd-gallery-title' => 'color: {{VALUE}};',
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
			'selector'	 => '{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content .nxadd-des',
			
			]
		);
		$this->add_control(
			'nextaddons_des_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-mixin-gallery-wraper .nxadd-mix-content .nxadd-des' => 'color: {{VALUE}};',
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
				'title' => esc_html__( 'Image Gallery', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],
			'video-gallery' => [
				'title' => esc_html__( 'Video Gallery', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/video-gallery.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/video-gallery.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_adgallery_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-mixgallery-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
	
		$classs = 'grid-style';
		$class2 = 'gallery-grid-item';
		if( $nextaddons_adgallery_type == 'masonry'){
			$classs = 'nxadd-masonary-style';
			$class2 = 'gallery-masonary-item';
		} else if($nextaddons_adgallery_type == 'list'){
			$classs = 'list-style';
			$class2 = 'gallery-list-item';
		}

		if($nextaddons_adgallery_popup_enable == 'yes'){
			$class2 .= '  nx-popup-gallery-open';
		}
		
		$iconAnimation = '';
		if($nextaddons_adgallery_overlay_icon_animation != 'none'){
			$iconAnimation = 'animated nx-'.$nextaddons_adgallery_overlay_icon_animation;
		}

		if(in_array($nextaddons_adgallery_styles, ['normal'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_adgallery_styles, ['video-gallery'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/video-gallery.php' ) ){
				include( NX_Config::get_next_dir() .'/include/video-gallery.php');
			}
		} else if(in_array($nextaddons_adgallery_styles, ['smart-video'])){
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/smart-video.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/smart-video.php');
			}
		} 
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				nx_minxin_gallery_start('#<?php echo $elementorID;?>');
				nx_popup_image('.nx-popup-gallery-open');
			});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}