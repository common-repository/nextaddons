<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Heading as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Heading extends Widget_Base {

    public $base;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
	}

	public function get_style_depends() {
		return [ 'nextaddons-headding'];
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
       
	   // Start Title Here
	   $this->start_controls_section(
			'themedev_next_heading_section_title',
			array(
				'label' => esc_html__( 'Title', 'next-addons' ),
			)
		);
		$this->add_control(
			'themedev_next_heading_title_switch',
			[
				'label' => __( 'Show Title', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'themedev_next_heading_title', [
				'label'			 =>esc_html__( 'Heading Title', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Grow your ', 'next-addons' ),
				'default'	 =>esc_html__( 'Grow your {{Business}}', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{Business}} for focusing title.', 'next-addons' ),
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		
       $this->add_control(
			'themedev_next_heading_title_tag',
			[
				'label' => esc_html__( 'Title Tag', 'next-addons' ),
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
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_title_focus_tag',
			[
				'label' => esc_html__( 'Focus Title Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'strong' => 'strong',
					'em' => 'em',
				],
				'default' => 'span',
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_title_bar_style',
			[
				'label' => esc_html__( 'Bar Style', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'none' => 'None',
					'version-2 left' => 'Left Bar',	
					'version-2 right' => 'Right Bar',	
					'version-2' => 'Both Bar',	
					
				],
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes',
				'themedev_next_heading_style_select!' => ['style16', 'style17']],
			]
		);
		// headding title animation
		$this->add_control(
			'themedev_next_heading_title_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		
		
        $this->end_controls_section();
		// End Title Here
		
		// Start Sub Title Here
	   $this->start_controls_section(
			'themedev_next_heading_section_sub_title',
			array(
				'label' => esc_html__( 'Sub Title', 'next-addons' ),
				
			)
		);
		$this->add_control(
			'themedev_next_heading_sub_title_switch',
			[
				'label' => __( 'Show Sub Title', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'themedev_next_heading_sub_title', [
				'label'			 =>esc_html__( 'Sub Heading Title', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Time has ', 'next-addons' ),
				'default'	 =>esc_html__( 'Time has {{changed}}', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{changed}} for focusing title.', 'next-addons' ),
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_sub_title_position',
			[
				'label' => esc_html__( 'Sub Title Position', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'after_title' => 'After Title',
					'before_title' => 'Before Title',	
				],
				'default' => 'after_title',
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
       $this->add_control(
			'themedev_next_heading_sub_title_tag',
			[
				'label' => esc_html__( 'Sub Title Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
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
				'default' => 'div',
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_sub_title_focus_tag',
			[
				'label' => esc_html__( 'Focus Sub Title Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'strong' => 'strong',
					'em' => 'em',
				],
				'default' => 'span',
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_sub_title_bar_style',
			[
				'label' => esc_html__( 'Bar Style', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'none' => 'None',
					'style-border left' => 'Left Bar',	
					'style-border right' => 'Right Bar',	
					'style-border' => 'Both Bar',	
					
				],
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes',
				'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']],
			]
		);
		
		// headding sub title animation
		$this->add_control(
			'themedev_next_heading_title_sub_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
        $this->end_controls_section();
		// End Sub Title Here
		
		// Start Description Here
	   $this->start_controls_section(
			'themedev_next_heading_section_description',
			array(
				'label' => esc_html__( 'Description', 'next-addons' ),
				'condition' => ['themedev_next_heading_style_select!' => ['style17']],
			)
		);
		$this->add_control(
			'themedev_next_heading_description_switch',
			[
				'label' => __( 'Show Description', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				
			]
		);
		$this->add_control(
			'themedev_next_heading_description', [
				'label'			 =>esc_html__( 'Description', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Description write here ', 'next-addons' ),
				'default'	 =>esc_html__( 'Lorem ipsum dolor sit amet, {{changed}} consectetur adipiscing elit, sed do eiusmod tempor incididunt ', 'next-addons' ),
				'description'	 =>esc_html__( 'Use {{changed}} for focusing title.', 'next-addons' ),
				'condition' => [ 'themedev_next_heading_description_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_description_position',
			[
				'label' => esc_html__( 'Position', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'after_seperator' => 'After Seperator',
					'before_seperator' => 'Before Seperator',	
				],
				'default' => 'before_seperator',
				'condition' => [ 'themedev_next_heading_description_switch' => 'yes',
								'themedev_next_heading_seperator_position' => 'middle',
								'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']
								],
			]
		);
		
       $this->add_control(
			'themedev_next_heading_description_tag',
			[
				'label' => esc_html__( 'Description Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'p',
				'condition' => [ 'themedev_next_heading_description_switch' => 'yes'],
			]
		);
		// headding sub title animation
		$this->add_control(
			'themedev_next_heading_description_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_description_switch' => 'yes'],
			]
		);
        $this->end_controls_section();
		// End Description Here
		
		// Start Seperator Here
	   $this->start_controls_section(
			'themedev_next_heading_section_seperator',
			array(
				'label' => esc_html__( 'Seperator', 'next-addons' ),
				'condition' => ['themedev_next_heading_style_select!' => ['style17', 'style18', 'style19']],
			)
		);
		$this->add_control(
			'themedev_next_heading_seperator_switch',
			[
				'label' => __( 'Show Seperator', 'next-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'themedev_next_heading_seperator_style',
			[
				'label' => esc_html__( 'Style', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'style-big' => 'Normal',
					'themedev-heading-border-before' => 'Left Dotted',	
					'themedev-heading-border-after' => 'Right Dotted',	
					'themedev-heading-border-before themedev-heading-border-after' => 'Both Dotted',	
					'border-star' => 'Center Box Border',	
					'border-star left' => 'Left Box Border',	
					'border-star right' => 'Right Box Border',	
				],
				'default' => 'themedev-heading-border-before',
				'condition' => [ 'themedev_next_heading_seperator_switch' => 'yes'],
			]
		);
		$this->add_control(
			'themedev_next_heading_seperator_position',
			[
				'label' => esc_html__( 'Position', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'top' => 'Top',
					'middle' => 'Middle',	
					'bottom' => 'Bottom',	
				],
				'default' => 'middle',
				'condition' => [ 'themedev_next_heading_seperator_switch' => 'yes'],
			]
		);
		// headding sub title animation
		$this->add_control(
			'themedev_next_heading_seperator_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_seperator_switch' => 'yes'],
			]
		);
        $this->end_controls_section();
		// End Seperator Here
		
		// Start General Here
		$this->start_controls_section(
			'themedev_next_heading_section_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		$this->add_control(
			'themedev_next_heading_style_select',
			[
				'label' => esc_html__( 'Choose Styles', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'normal' => 'Normal',					
					'style4' => 'Gradient Title',
					//'style7' => 'Gradient Title with Sub Title',
					'style13' => 'Justify Title',
					'style16' => 'Transparent Title',
					//'style17' => 'Smart Title',
					//'style18' => 'Piramid Title',
					'style19' => 'Shadow Title',
				],
				'default' => 'normal',
				'label_block'	 => true,
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_style_transparent',
				'label' => __( 'Transparent Image', 'next-addons' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper.style16 .version-3 .mix-title
					',
				'condition' => ['themedev_next_heading_style_select' => ['style16']],
			]
		);
		$this->add_control(
			'themedev_next_heading_style_smart',
			[
				'label' => __( 'Choose Image', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => ['themedev_next_heading_style_select' => ['style17']],
			]
		);
		
		
		
		$this->add_responsive_control(
			'themedev_next_heading_alignment', [
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
                    '{{WRAPPER}} .theDev-section-title-wraper ' => 'text-align: {{VALUE}} !important;',
				],
			]
		);
		
        $this->end_controls_section();
		// End General Here
		
		/**
		*start style section
		*/
		
		// start style for title
		
		$this->start_controls_section(
			'themedev_next_heading_title_style_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		// heading - title 
		$this->add_control(
            'themedev_next_heading_title_headding_style',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		// color - title
		$this->add_control(
			'themedev_next_heading_title_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title
					' => 'color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_style_select!' => ['style16', 'style17']],
			]
		);
		
		// color gradient - title focus
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_title_gradian_color',
				'label' => __( 'Gradient Color', 'next-addons' ),
				//'types' => [ 'classic', 'gradient'],
				'types' => [ 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text
					',
				'condition' => ['themedev_next_heading_style_select' => ['style17']],
				
			]
		);
		// typography - title
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_title_typography',
			'selector'	 => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title,
							{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .mix-title,
							{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text,
							{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text
							',
			]
		);
		
		// end title style
		
		// focus title style start
		
		// color - title focus
		$this->add_control(
            'themedev_next_heading_title_focus_headding',
            [
                'label' => esc_html__( 'Focus Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_style_select!' => ['style16']],
            ]
        );
		
		// typography - title focus
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_title_focus_typography',
			'selector'	 => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title > *,
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-title > *,
							 {{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text > *
							 ',
			'condition' => ['themedev_next_heading_style_select!' => ['style16']],
			]
		);
		// color - title focus
		$this->add_control(
			'themedev_next_heading_title_focus_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
							'
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title > *
							' => 'color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_style_select!' => ['style4', 'style7', 'style16', 'style17'] ],
				
			]
		);
		// color gradient - title focus
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_title_focus_gradian_color',
				'label' => __( 'Focus Color', 'next-addons' ),
				//'types' => [ 'classic', 'gradient'],
				'types' => [ 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-title > *,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text > *
					',
				'condition' => ['themedev_next_heading_style_select' => ['style4', 'style7', 'style17'], 'themedev_next_heading_style_select!' => ['style16']],
				
			]
		);
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_title_focus_shadow',
                'selector' => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title > *,
								{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-title > *,
								{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .mix-title > *,
								{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text > *',
				
            ]
        );
		// headding title animation
		$this->add_control(
			'themedev_next_heading_title_focus_animation',
			[
				'label' => esc_html__( 'Animation', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => Package::nx_animation(),
				'default' => 'none',
				'condition' => [ 'themedev_next_heading_title_switch' => 'yes'],
			]
		);
		// title  bar style 
		$this->add_control(
            'themedev_next_heading_title_bar_headding_style',
            [
                'label' => esc_html__( 'Title Bar', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_title_bar_style!' => ['none'],
						'themedev_next_heading_style_select!' => ['style16', 'style17']	],
            ]
        );
		// color - before title bar
		$this->add_control(
			'themedev_next_heading_title_bar_before_color', [
				'label'		 =>esc_html__( 'Left Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:before' => 'background-color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 left', 'version-2'],
								'themedev_next_heading_style_select!' => ['style16', 'style17']	],
			]
		);
		// weight - before title bar
		$this->add_responsive_control(
			'themedev_next_heading_title_bar_before_width',
			[
				'label' => __( 'Left Bar Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 left', 'version-2'],
								'themedev_next_heading_style_select!' => ['style16', 'style17']	],
				
			]
		);
		// height - before title bar
		$this->add_responsive_control(
			'themedev_next_heading_title_bar_before_height',
			[
				'label' => __( 'Left Bar Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 left', 'version-2'] ,
				'themedev_next_heading_style_select!' => ['style16', 'style17']	],
				
			]
		);
		// color - after title bar
		$this->add_control(
			'themedev_next_heading_title_bar_after_color', [
				'label'		 =>esc_html__( 'Right Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:after' => 'background-color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 right', 'version-2'] ,
				'themedev_next_heading_style_select!' => ['style16', 'style17']	],
			]
		);
		// width - after title bar
		$this->add_responsive_control(
			'themedev_next_heading_title_bar_after_width',
			[
				'label' => __( 'Right Bar Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 right', 'version-2'],
					'themedev_next_heading_style_select!' => ['style16', 'style17']	],
				
			]
		);
		// height - after title bar
		$this->add_responsive_control(
			'themedev_next_heading_title_bar_after_height',
			[
				'label' => __( 'Right Bar Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_title_bar_style' => ['version-2 right', 'version-2'],
				'themedev_next_heading_style_select!' => ['style16', 'style17']	],
				
			]
		);
		
		// General Style - title
		$this->add_control(
            'themedev_next_heading_title_headding_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General title
		$this->add_responsive_control(
			'themedev_next_heading_title_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 10,
					'bottom' => 0,
					'left' => 10,
					'right' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .mix-title,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General title
		$this->add_responsive_control(
			'themedev_next_heading_title_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .mix-title,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// shadow - General title
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_title_shadow',
                'selector' => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-title,
				{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .mix-title,
				{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-before-text,
				{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text',
				

            ]
        );
		$this->end_controls_section();
		// end title style
		
		// start style for title sub
		
		$this->start_controls_section(
			'themedev_next_heading_title_sub_style_section', [
				'label'	 => esc_html__( 'Sub Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_heading_sub_title_switch' => 'yes'],
			]
		);
		$this->add_control(
            'themedev_next_heading_title_sub_headding',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_style_select!' => ['style19']],
            ]
        );
		$this->add_control(
			'themedev_next_heading_title_sub_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area
					' => 'color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_style_select!' => ['style17', 'style19']],
			]
		);
		
		
		// color gradient - title focus
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_title_sub_gradian_color',
				'label' => __( 'Gradient Color', 'next-addons' ),
				//'types' => [ 'classic', 'gradient'],
				'types' => [ 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text
					',
				'condition' => [ 'themedev_next_heading_style_select' => ['style17'], 'themedev_next_heading_style_select!' => ['style19']],
				
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_title_sub_typography',
			'selector'	 => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle,
			{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .theDev-section-subtitle.nx-after-text,
			{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area',
			
			'condition' => ['themedev_next_heading_style_select!' => ['style19']],
			]
		);
		
		// focus sub title start
		$this->add_control(
            'themedev_next_heading_title_focus_sub_headding',
            [
                'label' => esc_html__( 'Focus Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_style_select!' => ['style19']],
            ]
        );
		// typography - sub title focus
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_title_sub_focus_typography',
			'selector'	 => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle > *,
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-subtitle > *,
							 {{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text > *,
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area > *
							 ',
			'condition' => ['themedev_next_heading_style_select!' => ['style19']],
			]
		);
		// color - sub title focus
		$this->add_control(
			'themedev_next_heading_title_sub_focus_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
							'
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle > *,
							 {{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area > *
							' => 'color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_style_select!' => ['style7', 'style17', 'style19'] ],
				
			]
		);
		
		// color gradient - title focus
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_title_sub_focus_gradian_color1',
				'label' => __( 'Focus Color', 'next-addons' ),
				//'types' => [ 'classic', 'gradient'],
				'types' => [ 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-subtitle > *,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text > *
					',
				'condition' => ['themedev_next_heading_style_select' => ['style7', 'style17']],
				
			]
		);
		
		// text shadow - sub title focus
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_sub_title_focus_shadow',
                'selector' => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle > *,
								{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .gradient-subtitle > *,
								{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text > *,
								{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area > *',
				
				'condition' => ['themedev_next_heading_style_select!' => ['style19'] ],
            ]
        );
		
		// sub title  bar style 
		$this->add_control(
            'themedev_next_heading_sub_title_bar_headding_style',
            [
                'label' => esc_html__( 'Sub Title Bar', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_sub_title_bar_style!' => ['none'], 'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19'] ],
            ]
        );
		// color - before sub title bar
		$this->add_control(
			'themedev_next_heading_sub_title_bar_before_color', [
				'label'		 =>esc_html__( 'Left Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:before' => 'background-color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border left', 'style-border'],
					'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']],
			]
		);
		// weight - before sub title bar
		$this->add_responsive_control(
			'themedev_next_heading_sub_title_bar_before_width',
			[
				'label' => __( 'Left Bar Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border left', 'style-border'],
						'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']	],
				
			]
		);
		// height - before sub title bar
		$this->add_responsive_control(
			'themedev_next_heading_sub_title_bar_before_height',
			[
				'label' => __( 'Left Bar Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border left', 'style-border'],
					'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']	],
				
			]
		);
		// color - after sub title bar
		$this->add_control(
			'themedev_next_heading_sub_title_bar_after_color', [
				'label'		 =>esc_html__( 'Right Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:after' => 'background-color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border right', 'style-border'],
					'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']	],
			]
		);
		// width - after sub title bar
		$this->add_responsive_control(
			'themedev_next_heading_sub_title_bar_after_width',
			[
				'label' => __( 'Right Bar Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 70,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border right', 'style-border'],
				'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19'] ],
				
			]
		);
		// height - after sub title bar
		$this->add_responsive_control(
			'themedev_next_heading_sub_title_bar_after_height',
			[
				'label' => __( 'Right Bar Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_sub_title_bar_style' => ['style-border right', 'style-border'],
					'themedev_next_heading_style_select!' => ['style16', 'style17', 'style19']],
				
			]
		);
		
		
		// end sub title bar 
		
		// General Style - sub title
		$this->add_control(
            'themedev_next_heading_title_sub_headding_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General sub title
		$this->add_responsive_control(
			'themedev_next_heading_title_sub_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 10,
					'bottom' => 0,
					'left' => 10,
					'right' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General sub title
		$this->add_responsive_control(
			'themedev_next_heading_title_sub_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle,
					{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// shadow - General sub title
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_title_sub_shadow',
                'selector' => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-section-subtitle,
				{{WRAPPER}} .theDev-element-wrapper .nx-smart-heading-wrapper .nx-after-text,
				{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area',

            ]
        );
		// Top style - for style19
		// focus sub title start
		$this->add_control(
            'themedev_next_heading_title_focus_sub_headding_hidden',
            [
                'label' => esc_html__( 'Shadow Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_style_select' => ['style19']],
            ]
        );
		
		$this->add_control(
			'themedev_next_heading_title_sub_color_hidden', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#f7f7f7',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area,
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area > *
					' => 'color: {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_style_select' => ['style19']],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_title_sub_typography_hidden',
			'selector'	 => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area,
			{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area > *',
			
			'condition' => ['themedev_next_heading_style_select' => ['style19']],
			]
		);
		
		
		$this->add_responsive_control(
            'themedev_next_heading_sub_title_hidden_top', [
                'label'			 =>esc_html__( 'Top', 'next-addons' ),
                'type'			 => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'default'		 => [
                    'size' => '',
                ],
                'range'			 => [
                    'px' => [
                        'min'	 => -100,
                        'step'	 => 1,
                    ],
					 '%' => [
                        'min'	 => -100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'		 => [
                    '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area'	=> 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'themedev_next_heading_style_select' => 'style19',
                ],

            ]
        );
		$this->add_responsive_control(
            'themedev_next_heading_sub_title_hidden_left', [
                'label'			 =>esc_html__( 'Left / Right', 'next-addons' ),
                'type'			 => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'default'		 => [
                    'size' => '0',
                ],
                'range'			 => [
                    'px' => [
                        'min'	 => -100,
                        'step'	 => 1,
                    ],
					 '%' => [
                        'min'	 => -100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'		 => [
                    '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .theDev-hidden-area'	=> 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'themedev_next_heading_style_select' => 'style19',
                ],

            ]
        );
		
		$this->end_controls_section();
		// end sub title style
		
		// start style - for description
		$this->start_controls_section(
			'themedev_next_heading_description_style_section', [
				'label'	 => esc_html__( 'Description', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_heading_description_switch' => 'yes'],
			]
		);
		
		// heading - description 
		$this->add_control(
            'themedev_next_heading_description_headding_style',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		// color - description
		$this->add_control(
			'themedev_next_heading_description_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors'	 => [
					'
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description
					' => 'color: {{VALUE}};',
				],
				
			]
		);
		// typography - description
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_description_typography',
			'selector'	 => '
						{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description
							',
			]
		);
		
		// heading - description focus
		$this->add_control(
            'themedev_next_heading_description_headding_focus_style',
            [
                'label' => esc_html__( 'Focus Text', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		// color - description focus
		$this->add_control(
			'themedev_next_heading_description_focus_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description > *
					' => 'color: {{VALUE}};',
				],
				
			]
		);
		// typography - description focus
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'themedev_next_heading_description_focus_typography',
			'selector'	 => '
						{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description > *
							',
			]
		);
		// Text Shadow - description focus
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_description_focus_shadow',
                'selector' => '{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description > *',
				
            ]
        );
		
		// General Style - Description
		$this->add_control(
            'themedev_next_heading_description_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General description
		$this->add_responsive_control(
			'themedev_next_heading_description_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 10,
					'bottom' => 0,
					'left' => 10,
					'right' => 10,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description
					' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General description
		$this->add_responsive_control(
			'themedev_next_heading_description_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// shadow - General description
		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'themedev_next_heading_description_shadow',
                'selector' => '
				{{WRAPPER}} .theDev-element-wrapper .theDev-section-title-wraper .themedev-headding-description
				',
				

            ]
        );
		
		 
		
		$this->end_controls_section();
		// end description style
		
		// start style - for Seperator
		$this->start_controls_section(
			'themedev_next_heading_seperator_style_section', [
				'label'	 => esc_html__( 'Seperator', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'themedev_next_heading_seperator_switch' => 'yes'],
			]
		);
		// heading - seperator 
		$this->add_control(
            'themedev_next_heading_seperator_headding_style',
            [
                'label' => esc_html__( 'Bar', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		// color gradient - seperator
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'themedev_next_heading_seperator_gradian_color',
				'label' => __( 'Gradient Color', 'next-addons' ),
				//'types' => [ 'classic', 'gradient'],
				'types' => [ 'gradient'],
				'selector' => '
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border,
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.style-big
					',
				'condition' => ['themedev_next_heading_seperator_style!' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		// color star - seperator
		$this->add_control(
			'themedev_next_heading_seperator_bar_color_border_star', [
				'label'		 =>esc_html__( 'Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star' => '
						background: -webkit-gradient(linear, left top, right top, from({{VALUE}}), color-stop(38%, {{VALUE}}), color-stop(38%, rgba(255, 255, 255, 0)), color-stop(62%, rgba(255, 255, 255, 0)), color-stop(62%, {{VALUE}}), to({{VALUE}}));
						background: linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 38%, rgba(255, 255, 255, 0) 38%, rgba(255, 255, 255, 0) 62%, {{VALUE}} 62%, {{VALUE}} 100%);
						',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		
		// width - bar seperator
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_width',
			[
				'label' => __( 'Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'step' => 1,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		// height - seperator bar
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_height',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border' => 'height: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		// border radius - bar seperator
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_border_radius',
			[
				'label' => __( 'Border Radius', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
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
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		// heading - seperator left
		$this->add_control(
            'themedev_next_heading_seperator_left_headding_style',
            [
                'label' => esc_html__( 'Left Dotted', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
            ]
        );
		// color gradient - seperator left dotted
		$this->add_control(
			'themedev_next_heading_seperator_gradian_color_left', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-before:before' => 'background: linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%); box-shadow: 9px 0px 0px 0px {{VALUE}}, 18px 0px 0px 0px {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// width - bar seperator left
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_width_left',
			[
				'label' => __( 'Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-before:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// height - seperator bar left
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_height_left',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-before:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// border radius - bar seperator left
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_border_radius_left',
			[
				'label' => __( 'Border Radius', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => '%',
					'size' => 50
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-before:before' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		
		$this->add_responsive_control(
			'themedev_next_heading_separator_margin_left',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => -30,
					'right' => 0,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-before:before
					' => 'top:{{TOP}}{{UNIT}}; right:{{RIGHT}}{{UNIT}}; bottom:{{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-before', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		
		// heading - seperator right
		$this->add_control(
            'themedev_next_heading_seperator_right_headding_style',
            [
                'label' => esc_html__( 'Right Dotted', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
            ]
        );
		// color gradient - seperator right dotted
		$this->add_control(
			'themedev_next_heading_seperator_gradian_color_right', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-after:after
					' => 'background: linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%); box-shadow: 9px 0px 0px 0px {{VALUE}}, 18px 0px 0px 0px {{VALUE}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// width - bar seperator right
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_width_right',
			[
				'label' => __( 'Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-after:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// height - seperator bar right
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_height_right',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-after:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		// border radius - bar seperator right
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_border_radius_right',
			[
				'label' => __( 'Border Radius', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => '%',
					'size' => 50
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-after:after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		
		// right dotted margin
		$this->add_responsive_control(
			'themedev_next_heading_separator_margin_right',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 40,
					'right' => 0,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.themedev-heading-border-after:after
					' => 'top:{{TOP}}{{UNIT}}; right:{{RIGHT}}{{UNIT}}; bottom:{{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['themedev-heading-border-after', 'themedev-heading-border-before themedev-heading-border-after']],
			]
		);
		
		
		
		// heading - seperator _star_dotted
		$this->add_control(
            'themedev_next_heading_seperator_right_headding_style_star_dotted',
            [
                'label' => esc_html__( 'Dotted', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
            ]
        );
		
		// color star dotted - seperator 
		$this->add_control(
			'themedev_next_heading_seperator_bar_color_border_star_dotted', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#2575fc',
				'selectors'	 => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star:after' => '
						background: {{VALUE}};
						',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		
		// width - bar seperator star_dotted
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_width_star_dotted',
			[
				'label' => __( 'Width', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		// height - seperator bar star_dotted
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_height_star_dotted',
			[
				'label' => __( 'Height', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		// border radius - bar seperator star_dotted
		$this->add_responsive_control(
			'themedev_next_heading_seperator_bar_border_radius_star_dotted',
			[
				'label' => __( 'Border Radius', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 1
				],
				'selectors' => [
					'{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star:after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		
		// right dotted margin
		$this->add_responsive_control(
			'themedev_next_heading_separator_margin_star_dotted',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '5',
					'top' => -7,
					'bottom' => 0,
					'left' => 50,
					'right' => 0,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border.border-star:after
					' => 'top:{{TOP}}{{UNIT}}; right:{{RIGHT}}{{UNIT}}; bottom:{{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
				'condition' => ['themedev_next_heading_seperator_style' => ['border-star', 'border-star left', 'border-star right']],
			]
		);
		
		
		// General Style - Description
		$this->add_control(
            'themedev_next_heading_seperator_style_general',
            [
                'label' => esc_html__( 'General', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				
            ]
        );
		// margin - General separator
		$this->add_responsive_control(
			'themedev_next_heading_separator_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 10,
					'bottom' => 10,
					'left' => 10,
					'right' => 10,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border
					' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'themedev_next_heading_separator_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'top' => 0,
					'bottom' => 0,
					'left' => 0,
					'right' => 0,
				],
				'selectors' => [
					'
					{{WRAPPER}} .theDev-element-wrapper .themedev-heading-border
					' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		// start custom style
		$this->start_controls_section(
			'themedev_next_heading_custom_style_section', [
				'label'	 => esc_html__( 'Custom Style', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		// custom css 
		$this->add_control(
			'themedev_next_heading_custom_class', [
				'label'			 =>esc_html__( 'Custom Class', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '.class-name', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
			]
		);
		// custom Id
		$this->add_control(
			'themedev_next_heading_custom_id', [
				'label'			 =>esc_html__( 'Custom Id', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( '#class-id', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
			]
		);
		
		$this->add_control(
			'themedev_next_heading_custom_css', [
				'label'			 =>esc_html__( 'Custom Css', 'next-addons' ),
				'type'			 => Controls_Manager::TEXTAREA ,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'css code here', 'next-addons' ),
				'default'	 =>esc_html__( '', 'next-addons' ),
				'description'	 =>esc_html__( 'Your custom css code for this section. Please sett your custom class after write your custom css code here.', 'next-addons' ),
			]
		);
	
		$this->end_controls_section();
		// end custom style
		
    }
	
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'elementor-element-'.$this->get_id();
		if(strlen($themedev_next_heading_custom_css) > 2):
			NX_Config::instance()->inline_css($themedev_next_heading_custom_css);
		endif;
		// seperator class render
		$seperatorStyle = 'themedev-heading-border '.$themedev_next_heading_seperator_style.' ';
		
		// alignment render
		$sectionTitleWraper = 'theDev-section-title-wraper  nx-text-center ';
		if($themedev_next_heading_title_bar_style != 'none'){
			$sectionTitleWraper .= $themedev_next_heading_title_bar_style.' ';
		}
		// sub title styles bar
		$subtitle_calss = $themedev_next_heading_sub_title_bar_style.' ';
		
		// Title Class
		$title_class = 'theDev-section-title fs-25 ';
		
		if($themedev_next_heading_style_select == 'style4'){
			$title_class .= 'gradient-title ';
		}
		if($themedev_next_heading_style_select == 'style7'){
			$title_class .= 'gradient-title ';
			$subtitle_calss .= 'gradient-subtitle ';
		}
		
		if($themedev_next_heading_style_select == 'style13'){
			$sectionTitleWraper .= 'version-3 ';
		}
		
		if($themedev_next_heading_style_select == 'style16'){
			$sectionTitleWraper .= 'version-3 ';
			$title_class = 'mix-title fs-35 ';
			$subtitle_calss = 'fs-20   ';
		}
		
		if($themedev_next_heading_style_select == 'style17'){
			$sectionTitleWraper = 'nx-smart-heading-wrapper align-self-center ';
			$title_class = 'nx-before-text ';
			$subtitle_calss = 'nx-after-text ';
			
			$imageSmart = NX_Config::get_next_url().'assets/img/timeline-bg.jpg';
			if( !empty($themedev_next_heading_style_smart['id']) ){
				$imageSmart = $themedev_next_heading_style_smart['url'];
			}
			//print_r( $themedev_next_heading_style_smart);
		}
		if($themedev_next_heading_style_select == 'style18'){
			$sectionTitleWraper .= 'version-4 ';
			$title_class = 'theDev-section-title fs-35 ';
			$themedev_next_heading_seperator_switch  = 'no';
		}
		if($themedev_next_heading_style_select == 'style19'){
			$sectionTitleWraper .= 'version-5 ';
			$themedev_next_heading_seperator_switch = $themedev_next_heading_sub_title_switch = 'no';
			$title_class = 'theDev-section-title fs-45 fw-700 ';
			$subtitle_calss = 'theDev-hidden-area ';
		}
		$title_class .= 'animated nx-'.$themedev_next_heading_title_animation;
		$subtitle_calss .= 'animated nx-'.$themedev_next_heading_title_sub_animation.' ';
		$discription_calss = 'animated nx-'.$themedev_next_heading_description_animation.' ';
		$seperatorStyle .= 'animated nx-'.$themedev_next_heading_seperator_animation.' ';
		
		// focus title animation
		$findClass = '';
		if($themedev_next_heading_title_focus_animation != 'none'){
			$findClass = 'animated nx-'.$themedev_next_heading_title_focus_animation;
		}
		
		?>
		<div class="theDev-element-wrapper <?php echo esc_attr($themedev_next_heading_style_select);?> <?php echo esc_attr($themedev_next_heading_custom_class);?>" id="<?php echo esc_attr($themedev_next_heading_custom_id);?>">
			<div class="<?php echo esc_attr($sectionTitleWraper);?>">
				<!--Seperator-->
				<?php if($themedev_next_heading_seperator_switch == 'yes' && in_array($themedev_next_heading_seperator_position, ['top'])):?>
					<span class="<?php echo esc_attr($seperatorStyle);?> "></span>
				<?php endif;?>
				<!--Sub Title-->
				<?php if($themedev_next_heading_sub_title_switch == 'yes' && $themedev_next_heading_sub_title_position == 'before_title'):?>
					<<?php echo esc_html($themedev_next_heading_sub_title_tag);?> class="theDev-section-subtitle <?php echo esc_attr($subtitle_calss);?> fs-15 fw-700"> <?php echo Help::_nspan($themedev_next_heading_sub_title, $themedev_next_heading_sub_title_focus_tag);?> </<?php echo esc_html($themedev_next_heading_sub_title_tag);?>>
				<?php endif; ?>
				<!--Title-->
				<?php if($themedev_next_heading_title_switch == 'yes'):?>
					<<?php echo esc_html($themedev_next_heading_title_tag);?> class="<?php echo esc_attr($title_class);?>" > <?php echo Help::_nspan($themedev_next_heading_title, $themedev_next_heading_title_focus_tag, $findClass);?> </<?php echo esc_html($themedev_next_heading_title_tag);?>>
				<?php endif; ?>
				
				<!--Shadow Title-->
				<?php if($themedev_next_heading_style_select == 'style19'):?>
					<<?php echo esc_html($themedev_next_heading_sub_title_tag);?> class="<?php echo esc_attr($subtitle_calss);?> "> <?php echo Help::_nspan($themedev_next_heading_sub_title, 'span');?> </<?php echo esc_html($themedev_next_heading_sub_title_tag);?>>
				<?php endif; ?>
				
				<!--Smart Title-->
				<?php if($themedev_next_heading_style_select == 'style17'):?>
					<div class="version-4 nx-fadeInRight">
						<img src="<?php echo esc_url($imageSmart);?>" alt="">
					</div>
				<?php endif; ?>
				<!--Sub Title-->
				<?php if($themedev_next_heading_sub_title_switch == 'yes' && $themedev_next_heading_sub_title_position == 'after_title'):?>
					<<?php echo esc_html($themedev_next_heading_sub_title_tag);?> class="theDev-section-subtitle <?php echo esc_attr($subtitle_calss);?> fs-15 fw-700"> <?php echo Help::_nspan($themedev_next_heading_sub_title, $themedev_next_heading_sub_title_focus_tag);?> </<?php echo esc_html($themedev_next_heading_sub_title_tag);?>>
				<?php endif; ?>
				<!--Description-->
				<?php if($themedev_next_heading_description_switch == 'yes' && $themedev_next_heading_description_position == 'before_seperator'):?>
					<<?php echo esc_html($themedev_next_heading_description_tag);?> class="themedev-headding-description <?php echo esc_attr($discription_calss);?>"> <?php echo Help::_nspan($themedev_next_heading_description, 'span');?></<?php echo esc_html($themedev_next_heading_description_tag);?>>							
				<?php endif; ?>
				<!--Seperator-->
				<?php if($themedev_next_heading_seperator_switch == 'yes' && in_array($themedev_next_heading_seperator_position, ['middle'])):?>
					<span class="<?php echo esc_attr($seperatorStyle);?> "></span>
				<?php endif;?>
				<!--Description-->
				<?php if($themedev_next_heading_description_switch == 'yes' && $themedev_next_heading_description_position == 'after_seperator'):?>
					<<?php echo esc_html($themedev_next_heading_description_tag);?> class="themedev-headding-description <?php echo esc_attr($discription_calss);?>"> <?php echo Help::_nspan($themedev_next_heading_description, 'span');?></<?php echo esc_html($themedev_next_heading_description_tag);?>>							
				<?php endif; ?>
				<!--Seperator-->
				<?php if($themedev_next_heading_seperator_switch == 'yes' && in_array($themedev_next_heading_seperator_position, [ 'bottom'])):?>
					<span class="<?php echo esc_attr($seperatorStyle);?> "></span>
				<?php endif;?>
			</div>	
		</div>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}