<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Testimonial as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Testimonial extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-grid-nx', 'nextaddons-testimonial', 'nextaddons-slider-nx', 'nextaddons-testimonial-pro', 'nextaddons-popup-nx'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-slider-nx', 'nextaddons-popup-nx'];
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
			'nextaddons_testimonial_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		if( !$this->help ):
		$this->add_control(
			'nextaddons_testimonial_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Testimonial styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/testimonial/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_testimonial_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_testimonial_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_testimonial_alignment', [
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
                    '{{WRAPPER}} .themedev-testimonial-wrapper  .nxtestimonial-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		do_action('nextaddons_testimonial_tab_general', $this);

		$this->end_controls_section();
        // End General Here
		

		// items
		$this->start_controls_section(
			'nextaddons_testimonial_data_section',
			array(
				'label' => esc_html__( 'Items', 'next-addons' ),
				
			)
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
            'nextaddons_items_name',
            [
                'label' => esc_html__( 'Name', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'Tyler McKinney',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);

		$repeater->add_control(
            'nextaddons_items_designation ',
            [
                'label' => esc_html__( 'Designation ', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'CEO of ThemeDev',
                'placeholder' => '',
                'dynamic' => [
                    'active' => true
				],
				'label_block'	 => true,
				
            ]
		);
        
        $repeater->add_control(
            'nextaddons_items_overview',
            [
                'label' => esc_html__( 'Overview', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'placeholder' => esc_html__('Set description', 'next-addons-pro' ),
                'dynamic' => [
                    'active' => true
				],
				
            ]
        );
		
		$repeater->add_control(
			'nextaddons_items_photos',
			[
				'label' => esc_html__( 'Photos', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => NX_Config::get_next_url().'include/images/default.png',
				],
				
			]
		);

		do_action('nextaddons_testimonial_tab_items_repeater', $repeater);

        $this->add_control(
            'nextaddons_testimonial_items',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{nextaddons_items_name}}}',
				'default' => [
                    [
                        'nextaddons_items_name' => 'Tyler McKinney',
                        'nextaddons_items_designation' => 'CEO of ThemeDev',
                        'nextaddons_items_overview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'nextaddons_items_photos' =>  [ 'url' => NX_Config::get_next_url().'include/images/default.png' ],
					],
					[
                        'nextaddons_items_name' => 'Mical Jon',
                        'nextaddons_items_designation' => 'CTO of ThemeDev',
                        'nextaddons_items_overview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'nextaddons_items_photos' =>  [ 'url' => NX_Config::get_next_url().'include/images/default.png' ],
					],
					[
                        'nextaddons_items_name' => 'Jon Malcony',
                        'nextaddons_items_designation' => 'Software Engineer',
                        'nextaddons_items_overview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'nextaddons_items_photos' =>  [ 'url' => NX_Config::get_next_url().'include/images/default.png' ],
					],
					[
                        'nextaddons_items_name' => 'Crish Gollosi',
                        'nextaddons_items_designation' => 'Senior PHP Developer',
                        'nextaddons_items_overview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'nextaddons_items_photos' =>  [ 'url' => NX_Config::get_next_url().'include/images/default.png' ],
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
			'nextaddons_testimonial_photos_enable',
			[
				'label' => __( 'Show Photos', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_testimonial_name_enable',
			[
				'label' => __( 'Show Name', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_testimonial_designation_enable',
			[
				'label' => __( 'Show Designation', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_testimonial_overview_enable',
			[
				'label' => __( 'Show Overview', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'nextaddons_testimonial_designation_limit',
            [
                'label'         => esc_html__('Limit (Word)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default' 		=> 20,
				'min' 			=> 1,
				'max' 			=> 150,
				'step' 			=> 1,
                'condition' => ['nextaddons_testimonial_overview_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_testimonial_wartermark',
			[
				'label' => esc_html__( 'Watermark Icon', 'next-addons' ),
				'type' =>  \Elementor\Controls_Manager::ICONS,
				'default' => [
                    'value' => 'nx-icon nx-icon-quotes-left',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_testimonial_styles!' => 'normal'],
			]
		);

		$this->add_control(
			'nextaddons_testimonial_popup_enable',
			[
				'label' => __( 'Show Popup', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [ 'nextaddons_team_styles!' => []],
			]
		);

		do_action('nextaddons_testimonial_tab_items', $this);

		$this->end_controls_section();
		
		
		// slide
		$this->start_controls_section(
			'nextaddons_slide_section', [
				'label'	 => esc_html__( 'Slide Controls', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_slide_enable',
            [
                'label' => esc_html__( 'Enable Slide', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);

		$this->add_control(
            'nextaddons_slide_width',
            [
                'label'         => esc_html__('Item Size (PX)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default' 		=> '',
				'condition' => ['nextaddons_slide_enable' => 'yes'],
				'description' => esc_html__( 'Slider size only require for verticla styles.', 'next-addons')
            ]
		);
		$this->add_control(
            'nextaddons_slide_spacing',
            [
                'label'         => esc_html__('Spacing (PX)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
				'default' 		=> '0',
				'condition' => ['nextaddons_slide_enable' => 'yes'],
			
            ]
		);

		$this->add_control(
            'nextaddons_slide_item',
            [
                'label'         => esc_html__('Slide Item', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
				'default' 		=> '3',
				'condition' => ['nextaddons_slide_enable' => 'yes'],
                
            ]
		);
		
		$this->add_control(
            'nextaddons_slide_speed',
            [
                'label'         => esc_html__('Slide Speed (ms)', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
				'default' 		=> '1500',
				'condition' => ['nextaddons_slide_enable' => 'yes'],
				
                
            ]
		);

		if( !$this->help ):
			$this->add_control(
				'nextaddons_testimonial_vertical_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Vertical testimonial slider available in PRO', 'next-addons' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		do_action('nextaddons_testimonial_tab_slide_vertical', $this);
		
		$this->add_control(
            'nextaddons_slide_dot',
            [
                'label' => esc_html__( 'Display dot control', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['nextaddons_slide_enable' => 'yes'],
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
				'condition' => ['nextaddons_slide_enable' => 'yes'],
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
				
				'condition' => [ 'nextaddons_slide_arrow' => 'yes', 'nextaddons_slide_enable' => 'yes'],
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
				
				'condition' => [ 'nextaddons_slide_arrow' => 'yes', 'nextaddons_slide_enable' => 'yes'],
			]
		);

		$this->add_control(
			'nextaddons_testimonial_display_column',
			[
				'label'   => esc_html__( 'Type', 'next-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'nx-col-lg-12 nx-col-md-12 nx-col-sm-12'  => esc_html__( '1 Column', 'next-addons' ),
					'nx-col-lg-6 nx-col-md-6 nx-col-sm-12'  => esc_html__( '2 Columns', 'next-addons' ),
					'nx-col-lg-4 nx-col-md-6 nx-col-sm-12'  => esc_html__( '3 Columns', 'next-addons' ),
					'nx-col-lg-3 nx-col-md-6 nx-col-sm-12' => esc_html__( '4 Columns', 'next-addons' ),
				],
				'default' => 'nx-col-lg-4 nx-col-md-6 nx-col-sm-12',
				'condition' => ['nextaddons_slide_enable!' => 'yes'],
			]
		);

		do_action('nextaddons_testimonial_tab_slide', $this);

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
			'nextaddons_testimonial_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxadd-slider-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_testimonial_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxadd-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);

		do_action('nextaddons_testimonial_tab_style_general', $this);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_itemsstyle_section', [
				'label'	 => esc_html__( 'Items', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);

		
		$this->add_control(
            'nextaddons_items_global_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_items_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '
				{{WRAPPER}}  .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-single-testimonial,
				{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-smart-testimonial .nxadd-author-card
				',
				
			]
		);

		$this->add_control(
            'nextaddons_items_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-single-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-smart-testimonial .nxadd-author-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_items_box',
				'selector' => '
				{{WRAPPER}}  .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-single-testimonial,
				{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-smart-testimonial .nxadd-author-card
				',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_items_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '
					{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-single-testimonial,
					{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-smart-testimonial .nxadd-author-card
				',

				'default'   => '',
			]
		);

		$this->add_control(
			'nextaddons_items_bg2', [
				'label'		 =>esc_html__( 'Color 2', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'types'     => [ 'classic', 'gradient' ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .nxadd-author-card.before-bar:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content.nxadd-smart-testimonial.style2 .nxadd-author-card.before-bar:before' => 'border-top-color: {{VALUE}}; background-color: transparent;',
				],
				'condition' => [ 'nextaddons_testimonial_styles' => ['tooltip', 'tooltip-pro'] ]
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_items_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		do_action('nextaddons_testimonial_tab_style_items', $this);
		
		$this->end_controls_section();



		// name
		$this->start_controls_section(
			'nextaddons_nametyle_section', [
				'label'	 => esc_html__( 'Name', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_testimonial_name_enable' => 'yes']
			]
		);

		$this->start_controls_tabs( 'nextaddons_name_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_name_tabs_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_name_typography',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .author-name',
			
			]
		);
		$this->add_control(
			'nextaddons_name_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .author-name' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_name_tabs_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_name_typography_active',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .author-name',
			
			]
		);
		$this->add_control(
			'nextaddons_name_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .author-name' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_name_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_testimonial_tab_style_name', $this);

		$this->end_controls_section();

		// designation
		$this->start_controls_section(
			'nextaddons_designationtyle_section', [
				'label'	 => esc_html__( 'Designation', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_testimonial_designation_enable' => 'yes']
			]
		);

		$this->start_controls_tabs( 'nextaddons_designation_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_designation_tabs_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_designation_typography',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .author-des',
			
			]
		);
		$this->add_control(
			'nextaddons_designation_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .author-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_designation_tabs_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_designation_typography_active',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .author-des',
			
			]
		);
		$this->add_control(
			'nextaddons_designation_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .author-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_designation_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .author-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_testimonial_tab_style_designation', $this);
		$this->end_controls_section();

		// overview
		$this->start_controls_section(
			'nextaddons_overviewtyle_section', [
				'label'	 => esc_html__( 'Overview', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_testimonial_overview_enable' => 'yes']
			]
		);

		$this->start_controls_tabs( 'nextaddons_overview_tabs' );
		
		$this->start_controls_tab(
			'nextaddons_overview_tabs_normal',
			[
				'label' =>esc_html__( 'Normal', 'next-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_overview_typography',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .profile-des',
			
			]
		);
		$this->add_control(
			'nextaddons_overview_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .profile-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'nextaddons_overview_tabs_hover',
            [
				'label' =>esc_html__( 'Hover', 'next-addons' ),
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_overview_typography_active',
			'selector'	 => '{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .profile-des',
			
			]
		);
		$this->add_control(
			'nextaddons_overview_color_active', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content:hover .profile-des' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'nextaddons_overview_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-testimonial-wrapper .nxtestimonial-content .profile-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_testimonial_tab_style_overview', $this);
		$this->end_controls_section();

		// photos
		// overview
		$this->start_controls_section(
			'nextaddons_photostyle_section', [
				'label'	 => esc_html__( 'Photos', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_testimonial_photos_enable' => 'yes']
			]
		);
		$this->add_responsive_control(
			'nextaddons_photos_width', [
				'label'		 =>esc_html__( 'Size', 'next-addons' ),
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
                ],
				'selectors'	 => [
					'{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; object-fit: cover;',
				],
			
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_photos_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img',
				
			]
		);

		$this->add_control(
            'nextaddons_photos_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_photos_box',
				'selector' => '{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img',
            ]
		);

		$this->add_control(
            'nextaddons_photos_position',
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
            'nextaddons_photos_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'nextaddons_photos_position' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nextaddons_photos_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'nextaddons_photos_position' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1050,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-testimonial-wrapper img.testimonial-img' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: auto;',
                    
                ],
            ]
        );

		$this->end_popover();

		do_action('nextaddons_testimonial_tab_style_photos', $this);
		$this->end_controls_section();

		// Slider Control
		$this->start_controls_section(
			'nextaddons_slidestyle_section', [
				'label'	 => esc_html__( 'Slide Controls', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_slide_enable' => 'yes']
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

		do_action('nextaddons_testimonial_tab_style_slide', $this);

		$this->end_controls_section();



		do_action('nextaddons_testimonial_tab', $this);

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
				'title' => esc_html__( 'Scale', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],
			'square' => [
				'title' => esc_html__( 'Suqare', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/square.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/square.jpg',
				'width' => '30%',
			],
			'tooltip' => [
				'title' => esc_html__( 'Tooltip', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/tooltip.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/tooltip.jpg',
				'width' => '30%',
			],

			'round' => [
				'title' => esc_html__( 'Round', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/round.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/round.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_testimonial_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-slider-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
	
		$classs = ' nx-square-dot-style';
		
		if(in_array($nextaddons_testimonial_styles, ['normal'])){			
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['square'])){			
			$classs = ' border-active';
			if( is_file( NX_Config::get_next_dir() .'/include/square.php' ) ){
				include( NX_Config::get_next_dir() .'/include/square.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['tooltip'])){			
			$classs = ' smart-slider shadow-active';
			if( is_file( NX_Config::get_next_dir() .'/include/tooltip.php' ) ){
				include( NX_Config::get_next_dir() .'/include/tooltip.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['round'])){			
			$classs = ' single-smart-style nx-square-dot-style';
			if( is_file( NX_Config::get_next_dir() .'/include/round.php' ) ){
				include( NX_Config::get_next_dir() .'/include/round.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['tooltip-pro'])){
			$classs = 'smart-slider shadow-active';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/tooltip-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/tooltip-pro.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['round-pro'])){
			$classs = 'smart-slider shadow-active button-style-1';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/round-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/round-pro.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['ratting-pro'])){
			$classs = 'nx-item6 single-smart-style2 nx-square-dot-style';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/ratting-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/ratting-pro.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['transparent'])){
			$classs = 'nx-item7 transparent-style';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/transparent.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/transparent.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['block-pro'])){
			$classs = 'nx-item13 block-style-2';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/block-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/block-pro.php');
			}
		} else if(in_array($nextaddons_testimonial_styles, ['advance-pro'])){
			$classs = '';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/advance-pro.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/advance-pro.php');
			}
		} 
		?>
		<?php if($nextaddons_slide_enable == 'yes'){?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				let id_nd = '<?php echo esc_attr($elementorID);?>';
				nx_slider_start( id_nd);
			});
		</script>
		<?php }?>
	<?php
		
    }

    protected function _content_template() { 
		
	}
}