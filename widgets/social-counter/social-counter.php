<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

use \NextAddons\Widgets\NextConfig_Social_Counter as NX_Config;
use \Elementor\Controls_Manager AS Controls_Manager;

//controls
use \NextAddons\Modules\Controls\Controls_Manager AS Next_Controls_Manager;

// laibray
use \NextAddons\Utilities\Package as Package;
use \NextAddons\Utilities\Help as Help;

class NextAddons_Social_Counter extends Widget_Base {
    
    public $base, $help = false; public $login, $settings;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		NX_Config::instance()->next_init();
		NX_Config::instance()->next_scripts();
		$this->help = Help::_get_check();

		$this->login = NX_Config::instance()->_get_counter();

		if ( NX_Config::instance()->_is_nextsocial_activated() && is_object($this->login) ) {
			
			$this->settings = NX_Config::instance()->_get_counter();

			$getProvider = get_option( \themeDevSocial\Apps\Settings::$counter_provider_key );
			
			$this->login_style = \themeDevSocial\Apps\Settings::$counter_style;
			
			$this->login->allow_pro = isset($getProvider['provider']) ? array_keys($getProvider['provider']) : [];
			$this->login->but_content = isset($getProvider['provider']) ? $getProvider['provider'] : [];
			
			$getDisplay = get_option( \themeDevSocial\Apps\Settings::$counter_display_key );
			$this->login->btn_style = isset($getDisplay['display']['button']) ? $getDisplay['display']['button'] : 'button6';
			
		}
		
	}
/*
	public function get_style_depends() {
		return [ 'nextaddons-subscribe'];
	}
*/
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
	
	public function get_custom_help_url() {
		return 'http://support.themedev.net/docs-category/next-social/';
	}

	public function is_reload_preview_required() {
        return true;
    }

    protected function _register_controls() {
	   // Start General Here
		
	   $this->start_controls_section(
			'_section_nextsocial',
			[
				'label' => NX_Config::instance()->_is_nextsocial_activated() ? __( 'Social Counter', 'next-addons' ) : __( 'Missing Notice',
					'next-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		if ( ! NX_Config::instance()->_is_nextsocial_activated() ) {
			$this->add_control(
				'_nextsocial_missing_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf(
						__( 'Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'next-addons' ),
						'<a href="'.esc_url( admin_url( 'plugin-install.php?s=Next Social&tab=search&type=term' ) ).'" target="_blank" rel="noopener">Next Social</a>',
						\wp_get_current_user()->display_name
					),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
				]
			);

			if ( file_exists( WP_PLUGIN_DIR . '/next-social-login-feed-sharing/next-social-login-feed-sharing.php' ) ) {
				$link = wp_nonce_url( 'plugins.php?action=activate&plugin=next-social-login-feed-sharing/next-social-login-feed-sharing.php&plugin_status=all&paged=1', 'activate-plugin_next-social-login-feed-sharing/next-social-login-feed-sharing.php' );
            
			}else{
				$link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=next-social-login-feed-sharing' ), 'install-plugin_next-social-login-feed-sharing' );
			}

			$this->add_control(
				'_nextsocial_install',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<a href="'. $link .'" target="_blank" rel="noopener">Click to install or activate Next Social</a>',
				]
			);
			$this->end_controls_section();
			return;
		}

		$this->add_control(
			'_nextsocial_support',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<a href="http://support.themedev.net/docs-category/social-counter/" target="_blank" rel="noopener">Click to view doc of Social Counter</a>',
			]
		);


		$this->add_control(
			'_select_providers',
			[
				'label' => __( 'Select Providers', 'next-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => true,
				'options' =>  NX_Config::instance()->_counter_provider(),
				'default' => 'all',
			]
		);

		$this->add_control(
			'_select_styles',
			[
				'label' => __( 'Select Style', 'next-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' =>  NX_Config::instance()->_counter_style(),
				'default' => '',
			]
		);
		
		$this->add_control(
			'_custom_class', [
				'label'			 =>esc_html__( 'Custom Class', 'next-addons' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => false,
				'default'	 => '',
			]
		);

		do_action('nextaddons_socialcounter_tab_settings', $this);

		$this->end_controls_section();


		// Counter
		$this->start_controls_section(
			'nextaddons_datastyle_section', [
				'label'	 => esc_html__( 'Data', 'next-addons' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'nextaddons_counter_heading',
            [
                'label' => esc_html__( 'Counter', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
	
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_counter_typography',
			'selector'	 => '{{WRAPPER}} .nextaddons-socialcounter .next-social-counter ._next_style_ul > li._next_style_li > a .login-count',
			
			]
		);

		$this->add_control(
            'nextaddons_label_heading',
            [
                'label' => esc_html__( 'Label', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
	
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_label_typography',
			'selector'	 => '{{WRAPPER}} .nextaddons-socialcounter .next-social-counter ._next_style_ul > li._next_style_li > a .login-text',
			
			]
		);

		$this->add_control(
            'nextaddons_icon_heading',
            [
                'label' => esc_html__( 'Icon', 'next-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
            ]
		);
	
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'nextaddons_icon_typography',
			'selector'	 => '{{WRAPPER}} .nextaddons-socialcounter .next-social-counter ._next_style_ul > li._next_style_li > a .next-icon > i:before',
			
			]
		);

		do_action('nextaddons_socialcounter_tab_data_style', $this);

		$this->end_controls_section();

		do_action('nextaddons_socialcounter_tab', $this);

    }
	
    protected function render() {
        $settings = $this->get_settings();
		extract($settings);
		$elementorID = 'nxaddons-socialcounter-'.$this->get_id();
		
		if ( ! NX_Config::instance()->_is_nextsocial_activated() ) {
            return;
        }

		if( is_array($_select_providers) && isset($_select_providers[0]) && $_select_providers[0] != 'all'){
			$this->login->allow_pro = $_select_providers;
		}
		
		if(!empty($_select_styles)){
			$this->login->btn_style = $_select_styles;
		}

		if(!empty($_custom_class)){
			$this->login->class_name = $_custom_class;
		}

		echo '<div class="nextaddons-socialcounter " id="'.$elementorID.'">';
		echo $this->login->next_counter_shortcode_action();
		echo '</div>';
		
    }

    protected function _content_template() { 
		
	}
}