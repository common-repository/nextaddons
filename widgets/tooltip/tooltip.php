<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Tooltip as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Tooltip extends Widget_Base {
    
    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-tooltip'];
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
			'nextaddons_tooltip_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// style choose
		$this->add_control(
            'nextaddons_tooltip_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );
		
		$this->add_control(
            'nextaddons_tooltip_type',
            [
                'label' => esc_html__( 'Type', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'tooltip-right tooltip-right-bar' => 'Right',
					'tooltip-bottom tooltip-bottom-bar' => 'Bottom',
					'tooltip-left tooltip-left-bar' => 'Left',
					'tooltip-top tooltip-top-bar' => 'Top',
				],
				'default' => 'tooltip-right tooltip-right-bar'
				
            ]
		);	

		$this->add_control(
            'nextaddons_tooltip_effect',
            [
                'label' => esc_html__( 'Effect', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => 'None',
					'effect-1' => 'Effect 1',
					'effect-2' => 'Effect 2',
					'effect-3' => 'Effect 3',
					'effect-4' => 'Effect 4',
				
				],
				'default' => ''
				
            ]
		);	

		$this->add_control(
			'nextaddons_tooltip_enable',
			[
				'label' => esc_html__( 'Default Show', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'next-addons' ),
                'label_off' => esc_html__( 'No', 'next-addons' ),
                'return_value' => 'tool-active',
                'default' => '',
			]
		);

		$this->add_responsive_control(
			'nextaddons_tooltip_alignment', [
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
                    '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
				],
			]
		);

		do_action('nextaddons_tooltip_tab_general', $this);

		$this->end_controls_section();
		// End general Here

		$this->start_controls_section(
			'nextaddons_tooltip_content',
			array(
				'label' => esc_html__( 'Content', 'next-addons' ),
			)
		);
		
		$this->add_control(
			'nextaddons_tooltip_content_type', [
				'label'			 =>esc_html__( 'Query by', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'icon'		 => [
						'title'	 =>esc_html__( 'Icon', 'next-addons' ),
						'icon'	 => 'fas fa-icons',
					],
					'photos'		 => [
						'title'	 =>esc_html__( 'Photos', 'next-addons' ),
						'icon'	 => 'fas fa-photo-video',
					],
					
					
				],
				'default'		 => 'icon',
               
			]
		);

		$this->add_control(
			'nextaddons_content_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_content_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-wordpress',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_tooltip_content_type' => 'icon']
			]
		);
	
		$this->add_control(
			'nextaddons_content_photos',
			[
				'label' => esc_html__( 'Photos', 'next-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'nextaddons_tooltip_content_type' => 'photos']
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_photos',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'default' => 'full',
				'condition' => [ 'nextaddons_tooltip_content_type' => 'photos']
			]
		);

		

		$this->add_control(
            'nextaddons_content_text',
            [
                'label' => esc_html__( 'Content', 'next-addons' ),
                'type' =>  \Elementor\Controls_Manager::TEXT,
                'default' => 'I am WordPress',
                'label_block'	 => true,
				
            ]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_tooltip_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '
					{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip
				',

				'default'   => '',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_tooltip_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip',
				
			]
		);

		$this->add_control(
            'nextaddons_tooltip_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_tooltip_box',
				'selector' => '
				{{WRAPPER}}   .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip
				',
            ]
		);
		$this->add_responsive_control(
			'nextaddons_tooltip_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}}  .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_contentstyle_section', [
				'label'	 => esc_html__( 'Content', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_content_typography',
			'selector'	 => '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text',
			
			]
		);
		$this->add_control(
			'nextaddons_content_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text' => 'color: {{VALUE}};',
				],
				
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_content_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text',
				
			]
		);

		$this->add_control(
            'nextaddons_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_content_box_shadow',
                'selector' => '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text',
				

            ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_content_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text',
				'default'   => '',
			
			]
		);
	

		$this->add_control(
			'nextaddons_content_barcolor', [
				'label'		 =>esc_html__( 'Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text.tooltip-right-bar:after' => 'border-color: transparent {{VALUE}} transparent transparent;',
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text.tooltip-bottom-bar:after' => 'border-color: transparent transparent {{VALUE}}  transparent;',
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text.tooltip-top-bar:after' => 'border-color: {{VALUE}}  transparent transparent  transparent;',
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text.tooltip-letf-bar:after' => 'border-color:transparent transparent  transparent  {{VALUE}} ;',
				],
				
			]
		);

		$this->add_responsive_control(
			'nextaddons_content_padding',
			[
				'label' => __( 'padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
            'nextaddons_content_spacing',
            [
                'label' => esc_html__( 'Width', 'next-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip .nxadd-tooltip-text' => 'width: {{SIZE}}{{UNIT}};',
                ],
				
            ]
		);

		$this->add_control(
            'nextaddons_position_pop',
            [
                'label' => __( 'Position', 'next-addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'next-addons' ),
                'label_on' => __( 'Custom', 'next-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
            ]
		);
		
		$this->start_popover();

        $this->add_responsive_control(
            'nextaddons_position_pop_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'nextaddons_position_pop' => 'yes'
                ],
				'default' => [
					'unit' => '%',
					'size' => '100'
				],
                'selectors' => [
                    '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip-text' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
			'nextaddons_position_pop_x',
			[
				'label' => __( 'Horizontal', 'next-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nextaddons_position_pop' => 'yes'
				],
				'default' => [
					'unit' => '%',
					'size' => '35'
				],
				'selectors' => [
                    '{{WRAPPER}} .themeDev-tooltip-wraper .nxadd-tooltip-item .nxadd-tooltip-text' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
			]
		);

		$this->end_popover();
		
		$this->end_controls_section();

		do_action('nextaddons_tooltip_tab', $this);

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
		return apply_filters( 'nextaddons_tooltip_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-tooltip-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
	
		$classs = '';
		if(in_array($nextaddons_tooltip_styles, ['normal'])){
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		}
	
		
    }

    protected function _content_template() { 
		
	}
}