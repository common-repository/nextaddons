<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Timer as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Timer extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-timer', 'nextaddons-timer-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-timer-nx' ];
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
			'nextaddons_timer_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_timer_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Timer styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/countdown-timer/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_timer_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_timer_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_timer_alignment', [
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
                    '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		// End General Here


		$this->start_controls_section(
			'nextaddons_timer_data_section',
			array(
				'label' => esc_html__( 'Data', 'next-addons' ),
			)
		);
		
		$this->add_control(
            'nextaddons_timer_date_heding',
            [
                'label' => esc_html__( 'Date Setup', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
		);
		$this->add_control(
			'nextaddons_timer_date', [
				'label'			 =>esc_html__( 'Date', 'next-addons' ),
				'type'			 => Controls_Manager::DATE_TIME,
				'label_block'	 => false,
				'placeholder'	 =>esc_html__( 'YYYY-MM-DD H:i:s', 'next-addons' ),
				'default'	 => date("Y/m/d H:i:s", strtotime("+ 2 day")),
				
				'description'	 =>esc_html__( 'Select your target date.', 'next-addons' ),
			]
		);

		
		$this->add_control(
			'nextaddons_timer_date_format',
			[
				'label' => esc_html__( 'Format', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'days' => 'Days',
					'hours' => 'Hours',
					'minutes' => 'Minutes',
					'seconds' => 'Seconds',
				],
				'multiple' => true,
				'label_block'	 => false,
				'default' => ['days', 'hours', 'minutes', 'seconds'],
				'description'	 =>esc_html__( 'Set format of Timer', 'next-addons' ),
			]
		);

		$this->add_control(
			'nextaddons_timer_date_tag',
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
				'default' => 'h2',
				'description'	 =>esc_html__( 'Set HTMl Tag for counter', 'next-addons' ),
			]
		);

		$this->add_control(
            'nextaddons_timer_date_format_heding',
            [
                'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_timer_days_text',
			[
				'label' => esc_html__( 'Days', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default' => 'DAYS',
				'description'	 =>esc_html__( 'Label for Days', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_timer_hours_text',
			[
				'label' => esc_html__( 'Hours', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default' => 'HRS',
				'description'	 =>esc_html__( 'Label for Hours', 'next-addons' ),
				
			]
		);

		$this->add_control(
			'nextaddons_timer_minutes_text',
			[
				'label' => esc_html__( 'Minutes', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default' => 'MIN',
				'description'	 =>esc_html__( 'Label for Minutes', 'next-addons' ),
				
			]
		);

		$this->add_control(
			'nextaddons_timer_seconds_text',
			[
				'label' => esc_html__( 'Seconds', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default' => 'SEC',
				'description'	 =>esc_html__( 'Label for Seconds', 'next-addons' ),
				
			]
		);

		$this->add_control(
			'nextaddons_timer_dateformat_tag',
			[
				'label' => esc_html__( 'Tag', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'p',
				'description'	 =>esc_html__( 'Set HTMl Tag for Label', 'next-addons' ),
			]
		);

		$this->add_control(
            'nextaddons_timer_exprie_headding',
            [
                'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
		$this->add_control(
			'nextaddons_timer_exprie_enable',
			[
				'label' => __( 'Show', 'next-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'nextaddons_timer_exprie_text',
			[
				'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default' => 'Time out',
				'description'	 =>esc_html__( 'Enter expire message when timeover.', 'next-addons' ),
				'condition' => ['nextaddons_timer_exprie_enable' => 'yes']
			]
		);


		$this->end_controls_section();



		// global
		$this->start_controls_section(
			'nextaddons_globalstyle_section', [
				'label'	 => esc_html__( 'Global', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_timer_global_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown',
			]
		);

		$this->add_control(
            'nextaddons_timer_global_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_responsive_control(
			'nextaddons_timer_global_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nextaddons_timer_global_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_timer_global_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_timer_global_box_label',
                'selector' => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown',
            ]
		);

		$this->end_controls_section();


		// days
		$this->start_controls_section(
			'nextaddons_timer_days_section', [
				'label'	 => esc_html__( 'Days', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nextaddons_timer_days_heading',
			[
				'label' => esc_html__( 'Counter', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_days_typo',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-counter',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_days_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-counter' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_timer_days_heading_label',
			[
				'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_days_typo_label',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_days_color_label', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_timer_days_padding_label',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_timer_days_border_label',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
			]
		);

		$this->add_control(
            'nextaddons_timer_days_border_radius_label',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_timer_days_bg_label',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
				'default'   => '',
			]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_timer_days_box_label',
                'selector' => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
            ]
		);

		
		
		$this->end_controls_section();

		// hours
		$this->start_controls_section(
			'nextaddons_timer_hours_section', [
				'label'	 => esc_html__( 'Hours', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nextaddons_timer_hours_heading',
			[
				'label' => esc_html__( 'Counter', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_hours_typo',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-counter',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_hours_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-counter' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_timer_hours_heading_label',
			[
				'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_hours_typo_label',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_hours_color_label', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_timer_hours_padding_label',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_timer_hours_border_label',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label',
			]
		);

		$this->add_control(
            'nextaddons_timer_hours_border_radius_label',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_timer_hours_bg_label',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.hours > .nx-label',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_timer_hours_box_label',
                'selector' => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
            ]
		);
		
		$this->end_controls_section();

		// minutes
		$this->start_controls_section(
			'nextaddons_timer_minutes_section', [
				'label'	 => esc_html__( 'Minutes', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nextaddons_timer_minutes_heading',
			[
				'label' => esc_html__( 'Counter', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_minutes_typo',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-counter',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_minutes_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-counter' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_timer_minutes_heading_label',
			[
				'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_minutes_typo_label',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_minutes_color_label', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_timer_minutes_padding_label',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_timer_minutes_border_label',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label',
			]
		);

		$this->add_control(
            'nextaddons_timer_minutes_border_radius_label',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_timer_minutes_bg_label',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.minutes > .nx-label',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_timer_minutes_box_label',
                'selector' => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
            ]
		);
		$this->end_controls_section();

		// senecnds
		$this->start_controls_section(
			'nextaddons_timer_seconds_section', [
				'label'	 => esc_html__( 'Seconds', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nextaddons_timer_seconds_heading',
			[
				'label' => esc_html__( 'Counter', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_seconds_typo',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-counter',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_seconds_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-counter' => 'color: {{VALUE}};',
				],
				
			]
		);
		$this->add_control(
			'nextaddons_timer_seconds_heading_label',
			[
				'label' => esc_html__( 'Label', 'next-addons' ),
                'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_timer_seconds_typo_label',
			'selector'	 => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label',
			
			]
		);
		$this->add_control(
			'nextaddons_timer_seconds_color_label', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_timer_seconds_padding_label',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_timer_seconds_border_label',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label',
			]
		);

		$this->add_control(
            'nextaddons_timer_seconds_border_radius_label',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_timer_seconds_bg_label',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.seconds > .nx-label',
				'default'   => '',
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_timer_secends_box_label',
                'selector' => '{{WRAPPER}} .themedev-countdown-wraper .nxadd-countdown-timer .nx-countdown.days > .nx-label',
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

			'label-timer' => [
				'title' => esc_html__( 'Label Timer', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/label-timer.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/label-timer.jpg',
				'width' => '30%',
			],
			
			'label-timer2' => [
				'title' => esc_html__( 'Label Timer 2', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/label-timer2.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/label-timer2.jpg',
				'width' => '30%',
			],
			
		];
		return apply_filters( 'nextaddons_timer_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-timer-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$date = date('Y/m/d H:i:s', strtotime($nextaddons_timer_date));

		$format = implode('-', $nextaddons_timer_date_format);

		$label_name[] = $nextaddons_timer_days_text;
		$label_name[] = $nextaddons_timer_hours_text;
		$label_name[] = $nextaddons_timer_minutes_text;
		$label_name[] = $nextaddons_timer_seconds_text;
		$label = implode('-', $label_name);

		$classs = '';
		if(in_array($nextaddons_timer_styles, ['normal', 'label-timer', 'label-timer2'])){
			$classs = ($nextaddons_timer_styles == 'label-timer') ? 'style-6' : $classs;
			$classs = ($nextaddons_timer_styles == 'label-timer2') ? 'style-8' : $classs;
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		} else if(in_array($nextaddons_timer_styles, ['modren-style', 'inline-style', 'timer-pro'])){
			$classs = ($nextaddons_timer_styles == 'modren-style') ? 'style-9' : $classs;
			$classs = ($nextaddons_timer_styles == 'inline-style') ? 'style-10' : $classs;
			$classs = ($nextaddons_timer_styles == 'timer-pro') ? 'style-11' : $classs;
			
			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/modren-style.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/modren-style.php');
			}
		} 

		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				nx_count_down_start( '<?php echo esc_attr($elementorID);?>');
			});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}