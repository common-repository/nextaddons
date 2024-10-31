<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Pie_Chart as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Pie_Chart extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-piechart', 'nextaddons-piechart-pro'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-piechart-nx' ];
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
			'nextaddons_piechart_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		if( !$this->help ):
		$this->add_control(
			'nextaddons_piechart_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Pie Chart styles available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pie-chart/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_piechart_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_piechart_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_piechart_alignment', [
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
                    '{{WRAPPER}} .themedev-piechart-area .themedev-single-pie_chart' => 'text-align: {{VALUE}};',
				],
			]
		);
		

		do_action('nextaddons_pie_tab_general', $this);

		$this->end_controls_section();
		// End General Here
		
		$this->start_controls_section(
			'nextaddons_piechart_data_section',
			array(
				'label' => esc_html__( 'Data', 'next-addons' ),
			)
		);

		$this->add_control(
			'nextaddons_piechart_counter', [
				'label'			 =>esc_html__( 'Percentage', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 60,
				'min' => 0,
				'max' => 100,
				'step' => 5,
				'description'	 =>esc_html__( 'Set total number want to display percentage.', 'next-addons' ),
			]
		);
		$this->add_control(
			'nextaddons_piechart_display',
			[
				'label' => __( 'Display as', 'next-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'text' => 'Text', 'icon' => 'Icon', 'none' => 'None'],
				'default' => 'text',
			]
		);

		$this->add_control(
			'nextaddons_piechart_display_text', [
				'label'			 =>esc_html__( 'Text', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default'	 => '70%',
				'condition' => [ 'nextaddons_piechart_display' => 'text']
			]
		);

		$this->add_control(
			'nextaddons_piechart_display_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_piechart_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-database',
                    'library' => 'nxicons',
                ],
				
				'condition' => [ 'nextaddons_piechart_display' => 'icon'],
			]
		);
		
		do_action('nextaddons_pie_tab_data', $this);

		if( !$this->help ):
			$this->add_control(
				'nextaddons_piechart_styles_pro',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More data (Title, Discription, custom icons and Animatie Pie ) available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/pie-chart/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_piechart_decoration_section',
			array(
				'label' => esc_html__( 'Options', 'next-addons' ),
			)
		);

		$this->add_control(
			'nextaddons_piechart_width', [
				'label'			 =>esc_html__( 'Pie Width', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 150,
				'min' => 50,
				'max' => 1000,
				'step' => 5,
			]
		);

		$this->add_control(
			'nextaddons_piechart_linewidth', [
				'label'			 =>esc_html__( 'Line Width', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 8,
				'min' => 1,
				'max' => 100,
				'step' =>1,
			]
		);
		$this->add_control(
			'nextaddons_piechart_linecap',
			[
				'label' => __( 'Line Cap', 'next-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 'round' => 'Round', 'square' => 'Square', 'butt' => 'Butt'],
				'default' => 'round',
			]
		);


		$this->add_control(
			'nextaddons_piechart_rotate', [
				'label'			 =>esc_html__( 'Rotate Pie', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 0,
				'min' => 1,
				'max' => 360,
				'step' =>1,
			]
		);

		$this->add_control(
			'nextaddons_piechart_animation', [
				'label'			 =>esc_html__( 'Animate Time', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 1000,
				'min' => 0,
				'step' => 100,
			]
		);

		do_action('nextaddons_pie_tab_options', $this);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'nextaddons_piechart_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-piechart-area .themedev-single-pie_chart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_piechart_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-piechart-area .themedev-single-pie_chart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_piechart_background_pro',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-piechart-area .themedev-single-pie_chart',
				'default'   => '',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_piechart_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-piechart-area .themedev-single-pie_chart',
			]
		);

		$this->add_control(
            'nextaddons_piechart_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}  .themedev-piechart-area .themedev-single-pie_chart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_piechart_box_shadow',
                'selector' => '{{WRAPPER}} .themedev-piechart-area .themedev-single-pie_chart',
				//'separator' => 'after',
            ]
		);

		$this->add_control(
            'nextaddons_piechart_overlay_back',
            [
                'label' => esc_html__( 'Overlay', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'nextaddons_piechart_styles' => 'hover-pie']
            ]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_piechart_background_overly',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-single-pie_chart.nx-hover-pie .nx-piechart-content',
				'default'   => '',
				'condition' => [ 'nextaddons_piechart_styles' => 'hover-pie']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_piestyle_section', [
				'label'	 => esc_html__( 'Pie', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nextaddons_pie_barcolor', [
				'label'		 =>esc_html__( 'Bar Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#7ED500',
			]
		);

		$this->add_control(
			'nextaddons_pie_trackcolor', [
				'label'		 =>esc_html__( 'Track Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '#e7e7e7',
			]
		);


		$this->add_control(
			'nextaddons_pie_scalecolor', [
				'label'		 =>esc_html__( 'Scale Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
			]
		);

		$this->add_control(
			'nextaddons_piechart_scalelength', [
				'label'			 =>esc_html__( 'Scale Length', 'next-addons' ),
				'type'			 => Controls_Manager::NUMBER,
				'label_block'	 => false,
				'default'	 => 10,
				'min' => 0,
				'max' => 100,
				'step' =>1,
			]
		);

		do_action('nextaddons_pie_tab_style_pie', $this);

		$this->end_controls_section();


		$this->start_controls_section(
			'nextaddons_datastyle_section', [
				'label'	 => esc_html__( 'Data', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'nextaddons_data_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_piechart_display' => 'icon']
            ]
		);

		$this->add_control(
            'nextaddons_data_icon_size',
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
                    '{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nextaddons-icon:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nx-chart svg' => 'max-width: {{SIZE}}{{UNIT}}; vertical-align: middle;',
				],
				'condition' => [ 'nextaddons_piechart_display' => 'icon']
				
            ]
		);
	
		$this->add_control(
            'nextaddons_data_text_heading',
            [
                'label' => esc_html__( 'Text', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [ 'nextaddons_piechart_display' => 'text']
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'		 => 'nextaddons_data_text_typo',
				'selector'	 => '{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nx-piedisply',
				'condition' => [ 'nextaddons_piechart_display' => 'text']
			]
			
		);


		$this->add_control(
			'nextaddons_data_text_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				
				'selectors'	 => [
					'{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nextaddons-icon:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nx-chart svg path'	=> 'stroke: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .themedev-piechart-area  .themedev-single-pie_chart .nx-piedisply' => 'color: {{VALUE}};',
				],
				
			]
		);
		do_action('nextaddons_pie_tab_style_data', $this);

		$this->add_control(
            'nextaddons_data_global_heading',
            [
                'label' => esc_html__( 'Global', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);


		$this->add_responsive_control(
			'nextaddons_funfact_global_position',
			[
				'label' => __( 'Position', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'allowed_dimensions' => ['top', 'left'],
				'default' => [
					'top' => '0',
					'left' => '0',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .themedev-single-pie_chart canvas' => 'top: {{TOP}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		do_action('nextaddons_pie_tab', $this);

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
		return apply_filters( 'nextaddons_piechart_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-funfact-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		

		$classs = '';
		if(in_array($nextaddons_piechart_styles, ['normal'])){
			
			if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
				include( NX_Config::get_next_dir() .'/include/normal.php');
			}
		}  else if(in_array($nextaddons_piechart_styles, ['box-pie', 'hover-pie'])){
			$classs = ($nextaddons_piechart_styles == 'box-pie') ? 'nx-box-pie' : $classs;
			$classs = ($nextaddons_piechart_styles == 'hover-pie') ? 'nx-hover-pie' : $classs;

			if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/box-pie.php' ) ){
				include( NX_Config::get_next_dir( 'pro' ) .'/include/box-pie.php');
			}
		} 

		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				
				$('.chart-<?php echo esc_attr($elementorID);?>').easyPieChart({
					lineWidth: <?php echo (int) $nextaddons_piechart_linewidth;?>,
					size: <?php echo (int) $nextaddons_piechart_width;?>,
					barColor: '<?php echo $nextaddons_pie_barcolor;?>',
					rotate: <?php echo (int) $nextaddons_piechart_rotate;?>,
					lineCap: '<?php echo $nextaddons_piechart_linecap;?>',
					scaleColor: '<?php echo $nextaddons_pie_scalecolor;?>',
					scaleLength: <?php echo (int) $nextaddons_piechart_scalelength;?>,
					trackColor: '<?php echo $nextaddons_pie_trackcolor;?>',
					animate: {duration: <?php echo (int) $nextaddons_piechart_animation;?>, enabled: true}
				});

			});
		</script>
		
	<?php
		
    }

    protected function _content_template() { 
		
	}
}