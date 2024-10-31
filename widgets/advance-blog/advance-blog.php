<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Advance_Blog as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Advance_Blog extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-advance-blog', 'nextaddons-advance-blog-pro', 'nextaddons-slider-nx', 'nextaddons-mixin-nx', 'nextaddons-grid-nx'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-slider-nx', 'nextaddons-mixin-nx'];
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
			'nextaddons_advanceblog_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_advanceblog_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Show Feed by (posttype, posts) and Feed Style styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/advance-blog/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_advanceblog_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_advanceblog_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_advanceblog_alignment', [
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
				'default'		 => 'left',
                'selectors' => [
                    '{{WRAPPER}} .themedev-advance-blog-post-area  .nxadd-blog-post-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		
		
		$this->end_controls_section();
		// End General Here

		$this->start_controls_section(
			'nextaddons_blog',
			array(
				'label' => esc_html__( 'Query Options', 'next-addons' ),
			)
		);

		if( !$this->help ):
			$this->add_control(
				'nextaddons_advanceblog_query_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Show blog by (posttype, posts) available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/advance-blog/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		$this->add_control(
			'nextaddons_advanceblog_queryby', [
				'label'			 =>esc_html__( 'Query by', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => apply_filters('nextaddons_advanceblog_query_by', [
					'all'		 => [
						'title'	 =>esc_html__( 'All', 'next-addons' ),
						'icon'	 => 'fas fa-border-none',
					],
					'categories'		 => [
						'title'	 =>esc_html__( 'By Categories', 'next-addons' ),
						'icon'	 => 'far fa-list-alt',
					],
					
					
				]),
				'default'		 => 'all',
               
			]
		);
		do_action('nextaddons_advanceblog_posttype_search', $this);

		$this->add_control(
			'nextaddons_advanceblog_bycategories',
			[
				'label' => __( 'By Categories', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'nextaddons_advanceblog_queryby' => [ 'categories' ]
				],
			]
		);
        $this->add_control(
			'nextaddons_advanceblog_categories',
			[
				'label' => __( 'Select Categories', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => NX_Config::get_category(),
				'default' => [],
				'condition' => [
                    'nextaddons_advanceblog_queryby' => [ 'categories' ]
				],
			]
		);
		
		$this->add_control(
			'nextaddons_advanceblog_otherquery',
			[
				'label' => __( 'Others Filter', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'nextaddons_advanceblog_order_by',
			[
				'label'   => esc_html__( 'Order by', 'next-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__( 'Date', 'next-addons' ),
					'title'         => esc_html__( 'Title', 'next-addons' ),
					'author'        => esc_html__( 'Author', 'next-addons' ),
					'comment_count' => esc_html__( 'Comments', 'next-addons' ),
				],
				'default' => 'date',
			]
		);
 
		$this->add_control(
			'nextaddons_advanceblog_order',
			[
				'label'   => esc_html__( 'Order', 'next-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'next-addons' ),
					'DESC' => esc_html__( 'DESC', 'next-addons' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'nextaddons_advanceblog_offset',
			[
				'label'     => esc_html__( 'Offset', 'next-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 15,
				'default'   => 0,
			]
		);
 
		$this->add_control(
			'nextaddons_advanceblog_limit',
			[
				'label'     => esc_html__( 'Limit Display', 'next-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 100,
				'default'   => 10,
			]
		);

		$this->end_controls_section();


		// title section
		$this->start_controls_section(
			'nextaddons_advanceblog_title_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_advanceblog_title_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
		$this->add_control(
			'nextaddons_advanceblog_title_tag',
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
					'p' => 'p',
				],
				'default' => 'h3',
				'description'	 =>esc_html__( 'Set HTMl Tag for blog title', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_title_enable' => 'yes'],
			]
		);
        $this->add_control(
            'nextaddons_advanceblog_title_limit',
            [
                'label'         => esc_html__('Limit', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default' 		=> 20,
				'min' 			=> 1,
				'max' 			=> 150,
				'step' 			=> 1,
                'condition' => ['nextaddons_advanceblog_title_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_advanceblog_title_limit_by',
			[
				'label' => esc_html__( 'Limit by', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'word' => 'Words',
					'letter' => 'Letter',
				],
				'default' => 'word',
				'description'	 =>esc_html__( 'Blog title limit type', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_title_enable' => 'yes'],
			]
		);
		$this->add_control(
            'nextaddons_advanceblog_title_limit_symbol',
            [
                'label'         => esc_html__('Limit Symbol', 'next-addons'),
                'type'          => Controls_Manager::TEXT,
                'default' 		=> '...',
                'condition' => ['nextaddons_advanceblog_title_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_advanceblog_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'nextaddons_advanceblog_title_enable' => 'yes'],
				
			]
		);
		$this->end_controls_section();

		// Excerpt section
		do_action('nextaddons_advanceblog_excerpt_pro_1', $this);

		// Featured section
		$this->start_controls_section(
			'nextaddons_advanceblog_featured_section', [
				'label'	 => esc_html__( 'Featured', 'next-addons' ),
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'default' 		=> 'full',
			]
		);
		$this->end_controls_section();

		// Date section
		$this->start_controls_section(
			'nextaddons_advanceblog_date_section', [
				'label'	 => esc_html__( 'Date', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_styles!' => [] ]
			]
		);
		$this->add_control(
            'nextaddons_advanceblog_date_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
		$this->add_control(
            'nextaddons_advanceblog_date_icon',
            [
                'label' => esc_html__( 'Icon Display', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['nextaddons_advanceblog_date_enable' => 'yes'],
            ]
		);
		
		do_action('nextaddons_advanceblog_date_icons', $this);

		if( !$this->help ):
			$this->add_control(
				'nextaddons_advanceblog_date_format_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More than date format and Icons available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/advance-blog/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		$this->add_control(
			'nextaddons_advanceblog_date_format',
			[
				'label' => esc_html__( 'Date Format', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => apply_filters('nextaddons_advanceblog_date_format', [
					'd F' => '29 December',
					'd F, Y' => '29 December, 2019',
					
				]),
				'default' => 'd F',
				'description'	 =>esc_html__( 'Selet date format', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_date_enable' => 'yes'],
			]
		);
		$this->end_controls_section();

		// Categories section
		$this->start_controls_section(
			'nextaddons_advanceblog_categories_section', [
				'label'	 => esc_html__( 'Categories', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_styles!' => [] ]
			]
		);
		$this->add_control(
            'nextaddons_advanceblog_categories_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
		$this->add_control(
            'nextaddons_advanceblog_categories_icon',
            [
                'label' => esc_html__( 'Icon Display', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['nextaddons_advanceblog_categories_enable' => 'yes'],
            ]
		);
		if( !$this->help ):
			$this->add_control(
				'nextaddons_advanceblog_categories_icon_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Icons available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/advance-blog/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		do_action('nextaddons_advanceblog_categories_icons', $this);
		$this->add_control(
            'nextaddons_advanceblog_categories_seperator',
            [
                'label'         => esc_html__('Seperator', 'next-addons'),
                'type'          => Controls_Manager::TEXT,
                'default' 		=> ' - ',
                'condition' => ['nextaddons_advanceblog_categories_enable' => 'yes'],
            ]
		);
		$this->end_controls_section();

		// Author section
		$this->start_controls_section(
			'nextaddons_advanceblog_author_section', [
				'label'	 => esc_html__( 'Author', 'next-addons' ),
				'condition' => ['nextaddons_advanceblog_styles!' => [] ]
			]
		);
		$this->add_control(
            'nextaddons_advanceblog_author_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
		
		$this->end_controls_section();

		
		// slide
		do_action('nextaddons_advanceblog_slider_pro_1', $this);


		// general styles
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		// margin - General separator
		$this->add_responsive_control(
			'nextaddons_advanceblog_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_advanceblog_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_advanceblog_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_advanceblog_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap',
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_advanceblog_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap',
			
            ]
		);


		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_advanceblog_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title a',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title a' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_shadow',
                'selector' => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title a',
				
            ]
        );
		
		$this->add_responsive_control(
			'nextaddons_advanceblog_title_margin',
			[
				'label' => __( 'Spacing', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_spaical_heading',
            [
                'label' => esc_html__( 'Special Title', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_spicaltitle_typography',
			'selector'	 => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title.fz-large a',
			
			]
		);

		$this->add_control(
			'nextaddons_spicaltitle_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-blog-post-content .nxadd-post-title.fz-large a' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->end_controls_section();

		// Featured
		$this->start_controls_section(
			'nextaddons_featuredtyle_section', [
				'label'	 => esc_html__( 'Featured', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->add_control(
            'nextaddons_featured_spaical_heading',
            [
                'label' => esc_html__( 'Special Size', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
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
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxfull-blog .thumb-img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
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
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxfull-blog .thumb-img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    
                ],
            ]
        );

		$this->end_popover();

		$this->add_control(
            'nextaddons_featured_normal_heading',
            [
                'label' => esc_html__( 'Normal', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
		);

		$this->add_control(
            'featured_position_toggle_normal',
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
            'featured_position_y_normal',
            [
                'label' => __( 'Width', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'featured_position_toggle_normal' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxsmall-blog .thumb-img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->add_responsive_control(
            'featured_position_x_normal',
            [
                'label' => __( 'Height', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'featured_position_toggle_normal' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxsmall-blog .thumb-img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    
                ],
            ]
        );

		$this->end_popover();


		$this->end_controls_section();

		// Excerpt
		do_action('nextaddons_advanceblog_excerptstyle_pro_1', $this);
		
		// Date
		$this->start_controls_section(
			'nextaddons_datestyle_section', [
				'label'	 => esc_html__( 'Date', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_advanceblog_date_enable' => 'yes']
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_date_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_advanceblog_date_icon' => 'yes']
            ]
        );
		
		$this->add_control(
            'nextaddons_advanceblog_date_icon_size',
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
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_advanceblog_date_icon' => 'yes'],
				
            ]
		);

		$this->add_control(
			'nextaddons_advanceblog_date_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_advanceblog_date_icon' => 'yes'],
				'separator' => 'after',
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_date_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
        );
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_advanceblog_date_icon_text',
			'selector'	 => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data',
			
			]
		);
		$this->add_control(
			'nextaddons_advanceblog_date_icon_text', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .meta-data' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_date_global_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_advanceblog_styles' => []
				],
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_advanceblog_date_global_back',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-blog-post-area .nxadd-blog-post-wrap .nxadd-meta-lists .nxadd-single-meta .nxadd-meta-wrap',
				'default'   => '',
				'condition' => [ 'nextaddons_advanceblog_styles' => []
							]
			]
		);
		
		$this->end_controls_section();

		// Categories
		$this->start_controls_section(
			'nextaddons_categoriesstyle_section', [
				'label'	 => esc_html__( 'Categories', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_advanceblog_categories_enable' => 'yes']
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_cate_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_advanceblog_categories_icon' => 'yes']
            ]
        );
		
		$this->add_control(
            'nextaddons_advanceblog_cate_icon_size',
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
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				'condition' => ['nextaddons_advanceblog_categories_icon' => 'yes'],
				
            ]
		);

		$this->add_control(
			'nextaddons_advanceblog_cate_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat .nextaddons-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
				'condition' => ['nextaddons_advanceblog_categories_icon' => 'yes'],
				'separator' => 'after',
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_cate_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
            ]
        );
		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_advanceblog_cate_icon_text',
			'selector'	 => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat > *,
			{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat',
			
			]
		);
		$this->add_control(
			'nextaddons_advanceblog_cate_icon_text', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-cat > *' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_cate_global_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_advanceblog_styles!' => []
				],
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_advanceblog_cate_global_back',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .post-category, {{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .nxadd-post-cat',
				'default'   => '',
				'condition' => [ 'nextaddons_advanceblog_styles!' => []
							]
			]
		);
		$this->end_controls_section();
		// button styles


		

		// Slider Control
		$this->start_controls_section(
			'nextaddons_slidestyle_section', [
				'label'	 => esc_html__( 'Slide Controls', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => ['nextaddons_advanceblog_styles' => ['slide-feed', 'slide-feed-pro'] ],
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
                    '{{WRAPPER}} ul.nx-control-dot > li.nx-dot-span' => 'margin-right: {{SIZE}}{{UNIT}};',
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

		do_action('nextaddons_advanceblog_tab_style_slide', $this);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_authorsstyle_section', [
				'label'	 => esc_html__( 'Author', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => ['nextaddons_advanceblog_author_enable' => 'yes']
			]
		);

		$this->add_control(
            'nextaddons_advanceblog_author_heading',
            [
                'label' => esc_html__( 'Name', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => ['nextaddons_advanceblog_author_enable' => 'yes']
            ]
        );
		
		$this->add_control(
			'nextaddons_advanceblog_author_name_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .author-name' => 'color: {{VALUE}};',
				],
				'condition' => ['nextaddons_advanceblog_author_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'		 => 'nextaddons_advanceblog_author_name_typeo',
				'selector'	 => '{{WRAPPER}} .themedev-advance-blog-post-area .nxadd-blog-post-wrap .author-name',
				'condition' => ['nextaddons_advanceblog_author_enable' => 'yes']
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
			'news-feed' => [
				'title' => esc_html__( 'News Feed', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/news-feed.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/news-feed.jpg',
				'width' => '30%',
			],
			
			
		];
		return apply_filters( 'nextaddons_advanceblog_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-adblog-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$query['post_status'] = 'publish';
		$query['suppress_filters'] = false;
		if($nextaddons_advanceblog_queryby == 'postype'){
			$query['post_type'] = isset($nextaddons_advanceblog_posttype) ? $nextaddons_advanceblog_posttype : ['post'];
		}else{
			$query['post_type'] = ['post'];
		}
		
		$query['orderby'] = $nextaddons_advanceblog_order_by;
		if( !empty($nextaddons_advanceblog_order) ){
			$query['order'] = $nextaddons_advanceblog_order;
		}
		if( !empty($nextaddons_advanceblog_limit) ){
			$query['posts_per_page'] = (int) $nextaddons_advanceblog_limit;
		}
		if( !empty($nextaddons_advanceblog_offset) ){
			$query['offset'] = (int) $nextaddons_advanceblog_offset;
		}

		if($nextaddons_advanceblog_queryby == 'categories'){
			if( is_array($nextaddons_advanceblog_categories) && sizeof($nextaddons_advanceblog_categories) > 0){
				$cate_query = [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $nextaddons_advanceblog_categories, 
					],			
					'relation' => 'AND',
				];
				$query['tax_query'] = $cate_query;
			}
		}

		if($nextaddons_advanceblog_queryby == 'posts'){
			if( is_array($nextaddons_advanceblog_post) && sizeof($nextaddons_advanceblog_post) > 0){
				$query['post__in'] = $nextaddons_advanceblog_post;
			}
		}

		$post_query = new \WP_Query( $query );
		
		if ( $post_query->have_posts() ) {
			
			$animation_title = '';
			if($nextaddons_advanceblog_title_animation != 'none'){
				$animation_title = 'animated nx-'.$nextaddons_advanceblog_title_animation;
			}

			$classs = '';
			if(in_array($nextaddons_advanceblog_styles, ['normal'])){
				if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
					include( NX_Config::get_next_dir() .'/include/normal.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['news-feed'])){
				
				if( is_file( NX_Config::get_next_dir( ) .'/include/news-feed.php' ) ){
					include( NX_Config::get_next_dir( ) .'/include/news-feed.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['slide-feed'])){
				$classs = 'block-gradient';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/slide-feed.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/slide-feed.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['slide-feed-pro'])){
				$classs = 'grid-style modern-style';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/slide-feed-pro.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/slide-feed-pro.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['list-pro'])){
				//$classs = '';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/list-pro.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/list-pro.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['list-special'])){
				//$classs = '';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/list-special.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/list-special.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['modern-style'])){
				//$classs = '';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/modern-style.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/modern-style.php');
				}
			} else if(in_array($nextaddons_advanceblog_styles, ['modern-list'])){
				//$classs = '';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/modern-list.php' ) ){
					include( NX_Config::get_next_dir( 'pro' ) .'/include/modern-list.php');
				}
			} 
			
		}else{
			echo esc_html__(' No post here', 'next-addons');
		}
		?>
	
		<?php
    }
    protected function _content_template() { 
		
	}
}