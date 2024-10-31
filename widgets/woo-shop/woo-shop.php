<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Woo_Shop as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Woo_Shop extends Widget_Base {

    public $base, $help = false;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();
		
	}

	public function get_style_depends() {
		return [ 'nextaddons-wooshop', 'nextaddons-wooshop-pro', 'nextaddons-slider-nx', 'nextaddons-grid-nx'];
	}

	public function get_script_depends() {
		return [ 'nextaddons-slider-nx'];
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
	   
		if ( ! did_action( 'woocommerce_loaded' ) ) {
			$this->start_controls_section(
				'_section_woo',
				[
					'label' =>  __( 'Missing Notice',
						'next-addons' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'_woo_missing_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf(
						__( 'Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'next-addons' ),
						'<a href="'.esc_url( admin_url( 'plugin-install.php?s=Woocommerce&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Woocommerce</a>',
						\wp_get_current_user()->display_name
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				]
			);

			if ( file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ) ) {
				$link = wp_nonce_url( 'plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php' );
            
			}else{
				$link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
			}

			$this->add_control(
				'_nextsocial_install',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<a href="'. $link .'" target="_blank" rel="noopener">Click to install or activate Woocommerce</a>',
				]
			);
			$this->end_controls_section();
			return;
		}
		
		// Start General Here
		$this->start_controls_section(
			'nextaddons_wooshop_general_options',
			array(
				'label' => esc_html__( 'General Options', 'next-addons' ),
			)
		);
		
		// bar style - general options
		if( !$this->help ):
		$this->add_control(
			'nextaddons_wooshop_styles_pro',
			[
				'raw' => '<strong>' . esc_html__( 'PRO Features:', 'next-addons' ) . '</strong> ' . esc_html__( 'More Woo Style styles and slider option available in PRO', 'next-addons' ). '<br/><a href="http://nextaddons.themedev.net/woo-shop/" style="color: #ea2a2a;" target="_blank"> '.esc_html__('Click to PRO', 'next-addons').' </a>',
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type' => 'ui',
				
			]
		);
		endif;
		if( $this->help ):	
			$this->add_control(
				'nextaddons_wooshop_styles_pro_enable',
				[
					'raw' => '<strong>' . esc_html__( 'PRO Features Actived', 'next-addons' ) . '</strong> ' ,
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'render_type' => 'ui',
					
				]
			);
		endif;
		
		$this->add_control(
            'nextaddons_wooshop_styles',
            [
                'label' => esc_html__('Choose Style', 'next-addons'),
                'type' => Next_Controls_Manager::IMAGECHOOSE,
                'default' => 'normal',
                'options' => $this->_styles(),
            ]
        );

		$this->add_responsive_control(
			'nextaddons_wooshop_alignment', [
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
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .nxadd-slider-item' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		do_action('nextaddons_wooshop_tab_general', $this);
		
		$this->end_controls_section();
		// End General Here

		$this->start_controls_section(
			'nextaddons_blog',
			array(
				'label' => esc_html__( 'Query Options', 'next-addons' ),
			)
		);

		
		$this->add_control(
			'nextaddons_wooshop_queryby', [
				'label'			 =>esc_html__( 'Query by', 'next-addons' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => apply_filters('nextaddons_wooshop_query_by', [
					'all'		 => [
						'title'	 =>esc_html__( 'All', 'next-addons' ),
						'icon'	 => 'fas fa-border-none',
					],
					'categories'		 => [
						'title'	 =>esc_html__( 'By Categories', 'next-addons' ),
						'icon'	 => 'far fa-list-alt',
					],
					'product'		 => [
						'title'	 =>esc_html__( 'By Product', 'next-addons' ),
						'icon'	 => 'far fa-id-badge',
					],
					
				]),
				'default'		 => 'all',
               
			]
		);

		$this->add_control(
			'nextaddons_wooshop_bycategories',
			[
				'label' => __( 'By Categories', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'nextaddons_wooshop_queryby' => [ 'categories' ]
				],
			]
		);
        $this->add_control(
			'nextaddons_wooshop_categories',
			[
				'label' => __( 'Select Categories', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => NX_Config::get_category(),
				'default' => [],
				'condition' => [
                    'nextaddons_wooshop_queryby' => [ 'categories' ]
				],
			]
		);
		
		$this->add_control(
			'nextaddons_wooshop_bypost',
			[
				'label' => __( 'By Products', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    'nextaddons_wooshop_queryby' => [ 'product' ]
				],
			]
		);
		
		$this->add_control(
			'nextaddons_wooshop_post',
			[
				'label' => __( 'Select Products', 'next-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => NX_Config::get_post( ),
				
				'condition' => [
                    'nextaddons_wooshop_queryby' => [ 'product' ]
				],
			]
		);

		$this->add_control(
			'nextaddons_wooshop_otherquery',
			[
				'label' => __( 'Others Filter', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'nextaddons_wooshop_order_by',
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
			'nextaddons_wooshop_order',
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
			'nextaddons_wooshop_offset',
			[
				'label'     => esc_html__( 'Offset', 'next-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 15,
				'default'   => 0,
			]
		);
 
		$this->add_control(
			'nextaddons_wooshop_limit',
			[
				'label'     => esc_html__( 'Limit Display', 'next-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 5,
			]
		);

		$this->add_control(
			'nextaddons_wooshop_display_cols',
			[
				'label' => __( 'Display Column', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'nextaddons_wooshop_display_column',
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
			]
		);
		
		do_action('nextaddons_wooshop_tab_query', $this);
		
		$this->end_controls_section();

		// Featured section
		$this->start_controls_section(
			'nextaddons_wooshop_featured_section', [
				'label'	 => esc_html__( 'Featured', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_featured_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'separator' => 'none',
				'condition' => ['nextaddons_wooshop_featured_enable' => 'yes'],
			]
		);

		do_action('nextaddons_wooshop_tab_featured', $this);
		$this->end_controls_section();

		// title section
		$this->start_controls_section(
			'nextaddons_wooshop_title_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_title_enable',
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
			'nextaddons_wooshop_title_tag',
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
				'default' => 'h4',
				'description'	 =>esc_html__( 'Set HTMl Tag for Product title', 'next-addons' ),
				'condition' => ['nextaddons_wooshop_title_enable' => 'yes'],
			]
		);
        $this->add_control(
            'nextaddons_wooshop_title_limit',
            [
                'label'         => esc_html__('Limit', 'next-addons'),
                'type'          => Controls_Manager::NUMBER,
                'default' 		=> 20,
				'min' 			=> 1,
				'max' 			=> 150,
				'step' 			=> 1,
                'condition' => ['nextaddons_wooshop_title_enable' => 'yes'],
            ]
		);
		$this->add_control(
			'nextaddons_wooshop_title_limit_by',
			[
				'label' => esc_html__( 'Limit by', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'word' => 'Words',
					'letter' => 'Letter',
				],
				'default' => 'word',
				'description'	 =>esc_html__( 'Blog title limit type', 'next-addons' ),
				'condition' => ['nextaddons_wooshop_title_enable' => 'yes'],
			]
		);
		$this->add_control(
            'nextaddons_wooshop_title_limit_symbol',
            [
                'label'         => esc_html__('Limit Symbol', 'next-addons'),
                'type'          => Controls_Manager::TEXT,
                'default' 		=> '...',
                'condition' => ['nextaddons_wooshop_title_enable' => 'yes'],
            ]
		);
		
		do_action('nextaddons_wooshop_tab_title', $this);
		$this->end_controls_section();

		// Ratting section
		$this->start_controls_section(
			'nextaddons_wooshop_ratting_section', [
				'label'	 => esc_html__( 'Ratting', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_ratting_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
	

		do_action('nextaddons_wooshop_tab_ratting', $this);
		$this->end_controls_section();

		// Price section
		$this->start_controls_section(
			'nextaddons_wooshop_price_section', [
				'label'	 => esc_html__( 'Price', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_price_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
	

		do_action('nextaddons_wooshop_tab_price', $this);
		$this->end_controls_section();

		// Badge section
		$this->start_controls_section(
			'nextaddons_wooshop_badge_section', [
				'label'	 => esc_html__( 'Badge', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_badge_enable',
            [
                'label' => esc_html__( 'Display as', 'next-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'next-addons' ),
                'label_off' => esc_html__( 'Hide', 'next-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
		);
	

		do_action('nextaddons_wooshop_tab_badge', $this);
		$this->end_controls_section();

		// Badge section
		$this->start_controls_section(
			'nextaddons_wooshop_addtocart_section', [
				'label'	 => esc_html__( 'Add to Cart', 'next-addons' ),
			]
		);
		$this->add_control(
            'nextaddons_wooshop_addtocart_enable',
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
			'nextaddons_content_icon',
			[
				'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'nextaddons_content_icons',
                'default' => [
                    'value' => 'nx-icon nx-icon-cart-plus',
                    'library' => 'nxicons',
				],
				'condition' => [ 'nextaddons_wooshop_addtocart_enable' => 'yes']
			]
		);

		$this->add_control(
			'nextaddons_content_icon_position',
			[
				'label' 	=> esc_html__( 'Position', 'next-addons' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'nxleft',
				'options' 	=> [
					'nxleft' 	=> esc_html__( 'Left', 'next-addons' ),
					'nxright' => esc_html__( 'Right', 'next-addons' ),
				],
				'condition' => [
                    'nextaddons_wooshop_addtocart_enable' => 'yes'
                ]
			]
		);

		do_action('nextaddons_wooshop_tab_addtocart', $this);
		$this->end_controls_section();

		$this->start_controls_section(
			'nextaddons_generalstyle_section', [
				'label'	 => esc_html__( 'General', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		// margin - General separator
		$this->add_responsive_control(
			'nextaddons_woo_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper  .nxadd-slider-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// padding - General separator
		$this->add_responsive_control(
			'nextaddons_woo_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper  .nxadd-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);


		do_action('nextaddons_wooshop_tab_general_style', $this);
		$this->end_controls_section();

		// item style
		$this->start_controls_section(
			'nextaddons_itemsstyle_section', [
				'label'	 => esc_html__( 'Items', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_items_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-woocommerce-wrapper .products-item',
				
			]
		);

		$this->add_control(
            'nextaddons_items_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_items_box',
                'selector' => '{{WRAPPER}}  .themedev-woocommerce-wrapper .products-item',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_items_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item',
				'default'   => '',
			]
		);

		
		$this->add_responsive_control(
			'nextaddons_items_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		do_action('nextaddons_wooshop_tab_item_style', $this);
		$this->end_controls_section();

		// General
		$this->start_controls_section(
			'nextaddons_bodystyle_section', [
				'label'	 => esc_html__( 'Body', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_body_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-woocommerce-wrapper .nxadd-wc-products-des',
				'default'   => '',
			]
		);
		
		$this->add_responsive_control(
			'nextaddons_body_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .nxadd-wc-products-des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'nextaddons_body_margin',
			[
				'label' => __( 'Margin', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .nxadd-wc-products-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				//'separator' => 'after',
			]
		);
		do_action('nextaddons_wooshop_tab_body_style', $this);

		$this->end_controls_section();	

		// title style
		$this->start_controls_section(
			'nextaddons_titlestyle_section', [
				'label'	 => esc_html__( 'Title', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_title_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_name_typography',
			'selector'	 => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-title a',
			
			]
		);
		$this->add_control(
			'nextaddons_name_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-title a' => 'color: {{VALUE}};',
				],
				
			]
		);

		do_action('nextaddons_wooshop_tab_title_style', $this);
		$this->end_controls_section();


		// Featured
		$this->start_controls_section(
			'nextaddons_featuredtyle_section', [
				'label'	 => esc_html__( 'Featured', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_featured_enable' => 'yes']
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
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .post-image img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
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
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .post-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    
                ],
            ]
        );

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_featured_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}} .themedev-woocommerce-wrapper .post-image img',
				
			]
		);

		$this->add_control(
            'nextaddons_featured_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
	
		do_action('nextaddons_wooshop_tab_featured_style', $this);
		$this->end_controls_section();



		// price style
		$this->start_controls_section(
			'nextaddons_pricestyle_section', [
				'label'	 => esc_html__( 'Price', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_price_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_price_typography',
			'selector'	 => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-price .woocommerce-Price-amount',
			
			]
		);
		$this->add_control(
			'nextaddons_price_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-price .woocommerce-Price-amount' => 'color: {{VALUE}};',
				],
				
			]
		);

		
		$this->add_control(
            'nextaddons_pricestyle_heading',
            [
                'label' => esc_html__( 'Before Price', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_price_typography_del',
			'selector'	 => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-price del .woocommerce-Price-amount',
			
			]
		);
		$this->add_control(
			'nextaddons_price_color_del', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-price del' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
            'nextaddons_before_spaceing',
            [
                'label' => __( 'Speacing', 'next-feed' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                
                'selectors' => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .nxadd-price del .woocommerce-Price-amount' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		do_action('nextaddons_wooshop_tab_price_style', $this);
		$this->end_controls_section();

		// cart style
		$this->start_controls_section(
			'nextaddons_addtocartstyle_section', [
				'label'	 => esc_html__( 'Add to Cart', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_addtocart_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_cart_typography',
			'selector'	 => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button',
			
			]
		);
		$this->add_control(
			'nextaddons_cart_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_cart_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-woocommerce-wrapper .products-item .add_to_cart_button',
				
			]
		);

		$this->add_control(
            'nextaddons_cart_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_cart_box',
                'selector' => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_cart_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button',
				'default'   => '',
			]
		);

		
		$this->add_responsive_control(
			'nextaddons_cart_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .add_to_cart_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		do_action('nextaddons_wooshop_tab_addtocart_style', $this);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'_title_section_style',
			array(
				'label' => esc_html__( 'Ratting', 'next-feed' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_ratting_enable' => 'yes']
			)
		);
		$this->add_control(
			'_star_color',
			[
				'label'     => esc_html__( 'Star Color', 'next-feed' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .star-rating' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'_empty_star_color',
			[
				'label'     => esc_html__( 'Empty Star Color', 'next-feed' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .star-rating::before' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'_star_size',
			[
				'label' => esc_html__( 'Star Size', 'next-feed' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'_space_between',
			[
				'label' => esc_html__( 'Space Between', 'next-feed' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce:not(.rtl) {{WRAPPER}} .star-rating' => 'margin-right: {{SIZE}}{{UNIT}}',
					'.woocommerce.rtl {{WRAPPER}} .star-rating' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		do_action('nextaddons_wooshop_tab_ratting_style', $this);

		$this->end_controls_section();
		// cart style
		$this->start_controls_section(
			'nextaddons_badgestyle_section', [
				'label'	 => esc_html__( 'Badge', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [ 'nextaddons_wooshop_badge_enable' => 'yes']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_badge_typography',
			'selector'	 => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale',
			
			]
		);
		$this->add_control(
			'nextaddons_badge_color', [
				'label'		 =>esc_html__( 'Color', 'next-addons' ),
				'type'		 => Controls_Manager::COLOR,
				'default' => '',
				'selectors'	 => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale' => 'color: {{VALUE}};',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nextaddons_badge_border',
				'label' => __( 'Border', 'next-addons' ),
				'selector' => '{{WRAPPER}}  .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale',
				
			]
		);

		$this->add_control(
            'nextaddons_badge_border_radi',
            [
                'label'      => esc_html__( 'Border Radius', 'next-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nextaddons_badge_box',
                'selector' => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale',
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'nextaddons_badge_bg',
				'label'     => esc_html__( 'Background', 'next-addons' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale',
				'default'   => '',
			]
		);

		
		$this->add_responsive_control(
			'nextaddons_badge_padding',
			[
				'label' => __( 'Padding', 'next-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				
				'selectors' => [
					'{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'badge_position_toggle',
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
            'badge_position_y',
            [
                'label' => __( 'Vertical', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'badge_position_toggle' => 'yes'
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_position_x',
            [
                'label' => __( 'Horizontal', 'next-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'badge_position_toggle' => 'yes'
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .themedev-woocommerce-wrapper .products-item .nxadd-wc-badge .onsale' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    
                ],
            ]
        );

		$this->end_popover();
		do_action('nextaddons_wooshop_tab_badge_style', $this);

		$this->end_controls_section();

		do_action('nextaddons_wooshop_tab', $this);

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
			
			'advance' => [
				'title' => esc_html__( 'Advance', 'next-addons' ),
				'imagelarge' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'imagesmall' => NX_Config::get_next_url() . 'assets/img/normal.jpg',
				'width' => '30%',
			],

		];
		return apply_filters( 'nextaddons_wooshop_styles', $style);
	}
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-wooshop-'.$this->get_id();
		if(strlen($nextaddons_custom_css) > 2):
			NX_Config::instance()->inline_css($nextaddons_custom_css);
		endif;
		
		$query['post_status'] = 'publish';
		$query['suppress_filters'] = false;
		
		$query['post_type'] = ['product'];
		
		$query['orderby'] = $nextaddons_wooshop_order_by;
		if( !empty($nextaddons_wooshop_order) ){
			$query['order'] = $nextaddons_wooshop_order;
		}
		if( !empty($nextaddons_wooshop_limit) ){
			$query['posts_per_page'] = (int) $nextaddons_wooshop_limit;
		}
		if( !empty($nextaddons_wooshop_offset) ){
			$query['offset'] = (int) $nextaddons_wooshop_offset;
		}

		if($nextaddons_wooshop_queryby == 'categories'){
			if( is_array($nextaddons_wooshop_categories) && sizeof($nextaddons_wooshop_categories) > 0){
				$cate_query = [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $nextaddons_wooshop_categories, 
					],			
					'relation' => 'AND',
				];
				$query['tax_query'] = $cate_query;
			}
		}
		

		if($nextaddons_wooshop_queryby == 'product'){
			if( is_array($nextaddons_wooshop_post) && sizeof($nextaddons_wooshop_post) > 0){
				$query['post__in'] = $nextaddons_wooshop_post;
			}
		}

		$post_query = new \WP_Query( $query );
		//print_r($post_query);
		if ( $post_query->have_posts() ) {
			
			$classs = '';
			if(in_array($nextaddons_wooshop_styles, ['normal'])){
				$classs = '';
				if( is_file( NX_Config::get_next_dir() .'/include/normal.php' ) ){
					include( NX_Config::get_next_dir() .'/include/normal.php');
				}
			} else if(in_array($nextaddons_wooshop_styles, ['advance'])){
				$classs = ' style-2';
				
				if( is_file( NX_Config::get_next_dir( ) .'/include/advance.php' ) ){
					include( NX_Config::get_next_dir( ) .'/include/advance.php');
				}
			} else if(in_array($nextaddons_wooshop_styles, ['hover-pro'])){
				$classs = ' style-3';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/hover-pro.php' ) ){
					include( NX_Config::get_next_dir(  'pro' ) .'/include/hover-pro.php');
				}
			} else if(in_array($nextaddons_wooshop_styles, ['list-shop'])){
				$classs = ' ';
				
				if( is_file( NX_Config::get_next_dir( 'pro' ) .'/include/list-shop.php' ) ){
					include( NX_Config::get_next_dir(  'pro' ) .'/include/list-shop.php');
				}
			} 
			
		}else{
			echo esc_html__(' No product here', 'next-addons');
		}
		?>
		<?php if(isset($nextaddons_slide_enable) && $nextaddons_slide_enable == 'yes'){?>
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