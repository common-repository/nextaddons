<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Fun_Fact as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Fun_Fact extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-funfact', 'nextaddons-funfact-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-funfact-nx' ];
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
			'nextaddons_funfact_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_funfact_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More FunFact or Counting styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/funfact/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_funfact_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_funfact_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_funfact_alignment', [
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
                    '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		// End General Here
		 // Start icon Here
		 $this->start_controls_section(
			'nextaddons_funfact_data_section',
			array(
				'label' => esc_html__( 'Data', 'next-addons' ),
			)
		);
		$this->add_control(
			'nextaddons_funfact_counter', [
				'label'			 =>esc_html__( 'Counter', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'Enter number of counter', 'next-addons' ),
				'default'	 => 16500,
				'min' => 0,
				'step' => 10,
				'description'	 =>esc_html__( 'Set total number want to display count.', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_funfact_start', [
				'label'			 =>esc_html__( 'Start', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'Enter number of start', 'next-addons' ),
				'default'	 => 500,
				'min' => 0,
				'step' => 10,
				'description'	 =>esc_html__( 'Want to start counter from number', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_funfact_step', [
				'label'			 =>esc_html__( 'Step', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'Enter number of step', 'next-addons' ),
				'default'	 => 50,
				'min' => 1,
				'step' => 5,
				'description'	 =>esc_html__( 'Set counter step number', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_funfact_speed', [
				'label'			 =>esc_html__( 'Speed', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'Enter number of speed', 'next-addons' ),
				'default'	 => 20,
				'min' => 1,
				'max' => 200,
				'step' => 1,
				'description'	 =>esc_html__( 'Set counter speed number', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_funfact_counter_tag',
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
				'default' => 'span',
				'description'	 =>esc_html__( 'Set HTMl Tag for counter title', 'next-addons' ),
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'nextaddons_funfact_control_section',
			array(
				'label' => esc_html__( 'Control', 'next-addons' ),
				
			)
		);

		$this->add_control(
            'nextaddons_funfact_control_format_heading',
            [
                'label' => esc_html__( 'Number Format', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                
            ]
		);
		$this->add_control(
			'nextaddons_funfact_control_format',
			[
				'label' => __( 'Show', 'next-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_funfact_currency_format',
			[
				'label' => esc_html__( 'Type', 'next-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'en-IN' => 'en-IN', 'it_IT' => 'it-IT', 'de-DE' => 'de-DE', 'ar-EG' => 'ar-EG', 'ar-EG' => 'ar-EG'],
				'default' => 'en-IN',
				'condition' => [ 'nextaddons_funfact_control_format' => 'yes'],
				
			]
		);

		$this->add_control(
            'nextaddons_funfact_extra_text_heading',
            [
                'label' => esc_html__( 'Extra Data', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_funfact_extra_text_enable',
			[
				'label' => __( 'Show', 'next-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_funfact_extra_text', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '+', 'next-addons' ),
				'default'	 => '+',
				'description'	 => esc_html__( 'Set Extra text with Counter', 'next-addons' ),
				'condition' => [ 'nextaddons_funfact_extra_text_enable' => 'yes'],
			]
		);
		$this->add_control(
			'nextaddons_funfact_extra_text_direction',
			[
				'label' => esc_html__( 'Direction', 'next-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'after' => 'After', 'before' => 'Before'],
				'default' => 'after',
				'condition' => [ 'nextaddons_funfact_extra_text_enable' => 'yes'],
				
			]
		);

		$this->add_control(
			'nextaddons_funfact_extra_supertext', [
				'label'			 =>esc_html__( 'Super Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '+', 'next-addons' ),
				'default'	 => '+',
				'description'	 => esc_html__( 'Set Super text upto counter', 'next-addons' ),
				'condition' => [ 'nextaddons_funfact_styles' => ['modren-style'] ],
			]
		);
		$this->end_controls_section();
	   // Start icon Here
	   $this->start_controls_section(
			'nextaddons_funfact_icon_section',
			array(
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'condition' => [ 'nextaddons_funfact_styles!' => ['serial-counter'] ],
			)
		);

		$this->add_control(
			'nextaddons_funfact_icon_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_funfact_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_funfact_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-statamic',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_funfact_icon_enable' => 'yes'],
			]
		);


		$this->end_controls_section();
		// end image hover 



		$this->start_controls_section(
			'nextaddons_funfact_title_section',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
			)
		);
		$this->add_control(
			'nextaddons_funfact_title_enable',
			[
				'label' => __( 'Show', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nextaddons_funfact_title', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'This is Title ', 'next-addons' ),
				'default'	 =>esc_html__( 'Client Rating', 'next-addons' ),
				'description'	 =>esc_html__( 'Enter funfact title', 'next-addons' ),
				'condition' => [ 'nextaddons_funfact_title_enable' => 'yes'],
			]
		);
	
        $this->end_controls_section();
		// End Title Here
		// general styles
		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		// margin - General separator
		$this->add_responsive_control(
			'nextaddons_funfact_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_funfact_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_funfact_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item',
				'default'   => '',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_funfact_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-fun-fact-area .nxadd-fun-fact-item',
			]
		);

		$this->add_control(
            'nextaddons_funfact_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-fun-fact-area .nxadd-fun-fact-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_funfact_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item',
				//'separator' => 'after',
            ]
		);

		$this->add_control(
			'nextaddons_general_bottom_bordercolor', [
				'label'		 =>esc_html__( 'Box Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item.border-bottom-style:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item.border-bottom-style:hover .nxadd-funfact-icon .nextaddons-icon:before' => 'color: {{VALUE}};'
				],
				'condition' => ['nextaddons_funfact_styles' => ['box-style']]
			]
		);

		$this->add_control(
            'nextaddons_funfact_background_pro_overlay_headding',
            [
                'label' => esc_html__( 'Overly', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_funfact_styles' => ['inline-icon'] ],
				'separator' => 'before',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_funfact_background_pro_overlay',
				'label'     => esc_html__( 'Overly', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-overlay',
				'default'   => '',
				'condition' => ['nextaddons_funfact_styles' => ['inline-icon']]
			]
		);
		$this->end_controls_section();
		
		// icon styles
		$this->start_controls_section(
			'nextaddons_icontyle_section', [
				'label'	 => esc_html__( 'Icon', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_funfact_icon_enable' => 'yes']
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
                    '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
                ],
				
            ]
		);
		$this->add_control(
			'nextaddons_icon_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};'
				],
				
			]
		);

		if( !$this->help ):
		$this->add_control(
			'nextaddons_funfact_icon_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'Icons Extra Features - normal & hover (Background, Border, Border Radius, CSS Filter, Box Shadow) available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/funfact/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;

		do_action('nextaddons_funfact_icon_pro__1', $this);
		
		$this->add_responsive_control(
			'nextaddons_funfact_icon_paddins',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon .nextaddons-icon:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'nextaddons_funfact_icon_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon .nextaddons-icon:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		
		$this->end_controls_section();

		// Title
		$this->start_controls_section(
			'nextaddons_datatyle_section', [
				'label'	 => esc_html__( 'Data', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_data_typography',
			'selector'	 => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-timer > *',
			
			]
		);
		$this->add_control(
			'nextaddons_data_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-timer  > *' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_data_shadow',
                'selector' => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-timer  > *',
				
            ]
        );
		$this->add_responsive_control(
			'nextaddons_funfact_data_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-timer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		do_action('nextaddons_funfact_icon_pro__2', $this);

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'nextaddons_titletyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_funfact_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_title_typography',
			'selector'	 => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-title',
			
			]
		);
		$this->add_control(
			'nextaddons_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-title' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'nextaddons_title_shadow',
                'selector' => '{{WRAPPER}} .themedev-fun-fact-area .nxadd-fun-fact-item .nxadd-funfact-title',
				
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
			'box-style' => [
				'title' => esc_html__( 'Box Border', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/box-style.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/box-style.jpg',
				'width' => '30%',
			],
			'round-style' => [
				'title' => esc_html__( 'Round Icon', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/round-style.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/round-style.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_funfact_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-funfact-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$classs = '';
		if(in_array($nextaddons_funfact_styles, ['normal', 'box-style', 'round-style'])){
			if($nextaddons_funfact_styles == 'box-style'){
				$classs = 'border-bottom-style';
			} else if($nextaddons_funfact_styles == 'round-style'){
				$classs = 'round-style';
			}
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_funfact_styles, ['modren-style'])){
			$classs = 'modren-style';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/modren-style.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/modren-style.php');
			}
		} else if(in_array($nextaddons_funfact_styles, ['inline-icon'])){
			$classs = 'inline-icon';
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/inline-icon.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/inline-icon.php');
			}
		} 

		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				nx_fun_fact_start( '#<?php echo esc_attr($elementorID);?>');
			});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}