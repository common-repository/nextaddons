<?php
namespace NextAddons\Utilities;

defined( 'ABSPATH' ) || exit;

/**
 * Global Admin class.
 *
 * @since 1.0.0
 */
use \NextAddons\Widgets\manifest as manifest;

class Admin{
	
    private static $instance;

    public function init() {        
        if(current_user_can('manage_options')){
            add_filter( 'plugin_action_links_' . plugin_basename( \NextAddons\Plugin::plugin_file() ), [ $this , '_action_links'] );
            add_filter( 'plugin_row_meta', [ $this, '_plugin_row_meta'], 10, 2 );
            add_action( 'admin_enqueue_scripts', [ $this , '_admin_global_scripts'] );
            // admin script
            add_action( 'admin_enqueue_scripts', [ $this , '_admin_scripts'] );
           
            //admin bar render
            add_action( 'wp_before_admin_bar_render',   [ $this , '_before_admin_bar_render' ], 1000000 );

            // elementor css load
            add_action( 'elementor/editor/before_enqueue_styles', [  $this, '_admin_global_scripts' ] );
            add_action( 'elementor/editor/before_enqueue_styles', [  $this, '_scripts_elementor' ] );

             // notices load
             Notice::instance()->_init();
        }

        add_action( 'wp_enqueue_scripts', [ $this , '_admin_global_scripts'] );   
        // public script
        add_action( 'wp_enqueue_scripts', [ $this , '_public_scripts'] );

    }
    public static function _version(){
        return \NextAddons\Plugin::version();
    }
    public static function _plugin_url(){
        return \NextAddons\Plugin::plugin_url();
    }
    public static function _plugin_dir(){
        return \NextAddons\Plugin::plugin_dir();
    }

    public function _admin_global_scripts(){
        // next icon
        wp_register_style( 'nextaddons-icon-nx', self::_plugin_url() . 'assets/css/icon/nx-icon.css', false, self::_version() );
        // next addons icon
        wp_register_style( 'nextaddons-icon', self::_plugin_url() . 'assets/css/icon/nx-icon-elementor.css', false, self::_version() );
        // next addons elementor
        wp_register_style( 'nextaddons-elementor', self::_plugin_url() . 'assets/css/nx-elementor.css', false, self::_version() );
       
        // settings style
        wp_register_style( 'nextaddons-settings', self::_plugin_url() . 'assets/css/nx-setting.css', false, self::_version() );
        // settings js
        wp_register_script( 'nextaddons-settings', self::_plugin_url() . 'assets/script/nx-setting.js', ['jquery'], self::_version(), true );
        

        // public js
        wp_register_script( 'nextaddons-public', self::_plugin_url() . 'assets/script/public.js', ['jquery'], self::_version(), true );
        wp_register_style( 'nextaddons-public', self::_plugin_url() . 'assets/css/public.css', false, self::_version() );
         

        // next popup
        wp_register_style( 'nextaddons-popup-nx', self::_plugin_url() . 'assets/css/nx-library/nx-popup.css', false, self::_version() );
        wp_register_script( 'nextaddons-popup-nx', self::_plugin_url() . 'assets/script/nx-library/nx-popup.js', [ 'elementor-frontend'], self::_version(), true );
        
        // next mixin gallery
        wp_register_style( 'nextaddons-mixin-nx', self::_plugin_url() . 'assets/css/nx-library/nx-mix-gallery.css', false, self::_version() );
        wp_register_script( 'nextaddons-mixin-nx', self::_plugin_url() . 'assets/script/nx-library/nx-mixin-gallery.js', [ 'elementor-frontend'], self::_version(), true );
        
        // next slider
        wp_register_style( 'nextaddons-slider-nx', self::_plugin_url() . 'assets/css/nx-library/nx-slider.css', false, self::_version() );
        wp_register_script( 'nextaddons-slider-nx', self::_plugin_url() . 'assets/script/nx-library/nx-slider.js', [ 'elementor-frontend'], self::_version(), true );
        
        // next focus
        wp_register_style( 'nextaddons-focus-nx', self::_plugin_url() . 'assets/css/nx-library/nx-focus.css', false, self::_version() );
        wp_register_script( 'nextaddons-focus-nx', self::_plugin_url() . 'assets/script/nx-library/nx-focus.js', [ 'elementor-frontend'], self::_version(), true );
        
        // next animation
        wp_register_style( 'nextaddons-animation-nx', self::_plugin_url() . 'assets/css/nx-animation.css', false, self::_version() );
        wp_register_script( 'nextaddons-animation-nx', self::_plugin_url() . 'assets/script/nx-library/nx-animation.js', [ 'elementor-frontend'], self::_version(), true );
        
         // next grid
         wp_register_style( 'nextaddons-grid-nx', self::_plugin_url() . 'assets/css/nx-grid.css', false, self::_version() );
         
         // nx play js
         wp_register_script( 'nextaddons-play-nx', self::_plugin_url() . 'assets/script/nx-library/nx-video-play.js', [ 'elementor-frontend'], self::_version(), true );
        

          // flatpickr
         // wp_register_style( 'flatpickr', self::_plugin_url() . 'assets/css/flatpickr/flatpickr.min.css', false, self::_version() );
          //wp_register_script( 'flatpickr', self::_plugin_url() . 'assets/script/flatpickr/flatpickr.js', [ 'elementor-frontend', 'jquery'], self::_version(), true );
        
    }
    /**
     * Public function _admin_scripts.
     * enque admin scripts
     *
     * @since 1.0.0
     */
    public function _admin_scripts(){
        $screen = get_current_screen();
        
        wp_enqueue_style( 'nextaddons-icon-nx' );
        wp_enqueue_style( 'nextaddons-animation-nx' );
        //echo $screen->id;
        if( in_array($screen->id, [ 'toplevel_page_nextaddons', 'plugins']) ){
           wp_enqueue_script('nextaddons-settings');
           wp_enqueue_style('nextaddons-settings');
        }
       
        wp_register_style( 'themedev_ads', self::_plugin_url() . 'assets/css/ads.css', false, self::_version() );
        wp_enqueue_style('themedev_ads');
            
    }

     /**
     * Public function _public_scripts.
     * enque public scripts
     *
     * @since 1.0.0
     */
    public function _public_scripts(){
        
        wp_enqueue_style( 'nextaddons-icon-nx' );
        wp_enqueue_style( 'nextaddons-animation-nx' );
        wp_enqueue_style( 'nextaddons-grid-nx' );

        wp_enqueue_script('nextaddons-public');
        wp_enqueue_style( 'nextaddons-public' );
        
    }

    public function _scripts_elementor(){
        
        wp_enqueue_style( 'nextaddons-icon' );
        wp_enqueue_style( 'nextaddons-elementor' );
    }
    /**
     * Public function _admin_menu.
     * check for admin menu create
     *
     * @since 1.0.0
     */
    public function _admin_menu(){
        add_menu_page(
            esc_html__('Next Addons', 'next-addons'),
            esc_html__('Next Addons', 'next-addons'),
            'read',
            'nextaddons',
            [$this, 'next_addons'],
            'dashicons-feedback',
            6
        );
        add_submenu_page( 'nextaddons', esc_html__( 'Features', 'next-addons' ), esc_html__( 'Features', 'next-addons' ), 'manage_options', 'nextaddons', [ $this ,'next_addons'], 1);
        
        if ( ! did_action( 'nextaddonsPro/loaded' ) ) {
            add_submenu_page( 'nextaddons', esc_html__( 'Get Pro', 'next-addons' ), esc_html__( 'Get Pro', 'next-addons' ), 'manage_options', 'admin.php?page=nextaddons&tab=get-pro', '', 13);
        }
    }
    /**
     * Public function next_addons.
     * features include here
     *
     * @since 1.0.0
     */
    public function next_addons(){
        $message_status = 'No';
        $message_text = '';
        $tab = isset($_GET['tab']) ? help::sanitize($_GET['tab']) : 'widgets';
        if($tab == 'widgets'):
            if(isset($_POST['themedev-addons-submit'])){
                $addons = isset($_POST['themedev']) ? help::sanitize($_POST['themedev']) : [];
                if(update_option('__next_addons_active', $addons)){
                    $message_status = 'yes';
                    $message_text = __('Saved data.', 'next-addons');
                }
            }
      
            // get widgets
            $widgets =  manifest::instance()->_widgets();
            $getServices = get_option('__next_addons_active', []);
        endif;

        if($tab == 'get-pro'){
            $widget['promo-box'] = [ 'type' => 'next-addons-pro', 'name' => 'Promo Box', 'cate' => 'pro', 'link' => 'promo-box'];
            $widget['flip-box'] = [ 'type' => 'next-addons-pro', 'name' => 'Flip Box', 'cate' => 'pro', 'link' => 'flip-box'];
            $widget['image-comparison'] = [ 'type' => 'next-addons-pro', 'name' => 'Image Comparison', 'cate' => 'pro', 'link' => 'image-comparison'];
            $widget['image-accordion'] = [ 'type' => 'next-addons-pro', 'name' => 'Image Accordion', 'cate' => 'pro', 'link' => 'image-accordion'];
            $widget['instagram'] = [ 'type' => 'next-addons-pro', 'name' => 'Instagram', 'cate' => 'pro', 'link' => 'instagram'];
            $widget['tab-team'] = [ 'type' => 'next-addons-pro', 'name' => 'Tab Team', 'cate' => 'pro', 'link' => 'tab-team'];
            $widget['tab-testimonial'] = [ 'type' => 'next-addons-pro', 'name' => 'Tab Testimonial', 'cate' => 'pro', 'link' => 'tab-testimonial'];
            $widget['tab-price'] = [ 'type' => 'next-addons-pro', 'name' => 'Tab Price', 'cate' => 'pro', 'link' => 'tab-price'];
            $widget['tab-blog'] = [ 'type' => 'next-addons-pro', 'name' => 'Tab Blog', 'cate' => 'pro', 'link' => 'tab-blog'];
            $widget['ajax-blog'] = [ 'type' => 'next-addons-pro', 'name' => 'Ajax Blog', 'cate' => 'pro', 'link' => 'ajax-blog'];
            $widget['ajax-advance-blog'] = [ 'type' => 'next-addons-pro', 'name' => 'Ajax Blog Feed', 'cate' => 'pro', 'link' => 'ajax-blog-feed'];
            $widget['ajax-woo-shop'] = [ 'type' => 'next-addons-pro', 'name' => 'Ajax Woo Shop', 'cate' => 'pro', 'link' => 'ajax-woo-shop'];
            
        }
        // include files
        include ( self::_plugin_dir().'apps/views/settings/admin/settings.php');
    }
     /**
     * Public function _get_widgets_dir.
     * get widgets dir
     *
     * @since 1.0.0
     */
    public function _get_widgets_dir( $k, $v){
        $type = isset($v['type']) ? $v['type'] : '';
        return manifest::get_widgets_dir($type).$k.'/'.$k.'.php';
    }
     /**
     * Public function get_pro.
     * get pro features
     *
     * @since 1.0.0
     */
    public function get_pro(){
        echo 'get Pro';
    }
    /**
     * Public function _action_links.
     * ceate action link
     *
     * @since 1.0.0
     */
    public function _action_links($links){
        $links[] = '<a class="next-highlight-b" href="' . admin_url( 'admin.php?page=nextaddons' ).'"> '. __('Settings', 'next-addons').'</a>';
		$links[] = '<a class="next-highlight-a" href="http://nextaddons.themedev.net/pricing/" target="_blank"> '. __('Buy Now', 'next-addons').'</a>';
	    return $links;
    }

    /**
     * Public function _action_links.
     * ceate action link
     *
     * @since 1.0.0
     */
    public function _plugin_row_meta(   $links, $file  ){
        
        if ( strpos( $file, basename( \NextAddons\Plugin::plugin_file() ) ) ) {
            $new_links = array(
                'demo' => '<a class="next-highlight-b" href="http://nextaddons.themedev.net/" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>'. __('Live Demo', 'next-addons').'</a>',
                'doc' => '<a class="next-highlight-b" href="http://support.themedev.net/docs-category/next-addons/" target="_blank"><span class="dashicons dashicons-media-document"></span>'. __('User Guideline', 'next-addons').'</a>',
                'support' => '<a class="next-highlight-b" href="http://support.themedev.net/" target="_blank"><span class="dashicons dashicons-editor-help"></span>'. __('Support', 'next-addons').'</a>',
                'pro' => '<a class="next-highlight-a" href="http://nextaddons.themedev.net/pricing/" target="_blank" class="next-pro-plugin"><span class="dashicons dashicons-cart"></span>'. __('Get Pro', 'next-addons').'</a>'
            );
            $links = array_merge( $links, $new_links );
        }
          
        return $links;
    }

    /**
	 * Method Name: _before_admin_bar_render
	 * Description: Check PHP Version minimum Version 
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function _before_admin_bar_render(){
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'id'     => 'themedev-next-addons',
			'parent' => 'top-secondary',
			'title'  => __( 'Next Addons', 'next-addons' ) ,
			'meta'   => array( 'class' => 'themedev-next-addons' ),
			'href'   =>  esc_attr( admin_url( 'admin.php?page=nextaddons' ) )
		) );
		
	}
	
	 /**
     * Public function _missing_elementor.
     * check for elementor plugin
     *
     * @since 1.0.0
     */
	public function _missing_elementor(){
        if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
        }
        $error = 'info';
		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$btn['label'] = esc_html__('Activate Elementor', 'next-addons');
			$btn['url'] = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
            $error = 'info';
        } else {
			$btn['label'] = esc_html__('Install Elementor', 'next-addons');
			$btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $error = 'warning';
        }

		Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => $error,
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => esc_html__( 'NextAddons requires Elementor Plugin, which is currently NOT RUNNING. Please install and active this plugin', 'next-addons' ),
			]
		);
	}
     /**
     * Public function _check_version.
     * check for elementor version
     *
     * @since 1.0.0
     */
    public function _check_version(){
        $btn['label'] = esc_html__('Update Elementor', 'next-addons');
        $btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=elementor' ), 'upgrade-plugin_elementor' );
        
        Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => sprintf( esc_html__( 'NextAddons requires Elementor version %1$s+, which is currently NOT RUNNING.', 'next-addons' ), '2.7.4' ),
			]
		);
    }
    /**
     * Public function _check_php_version.
     * check for php version
     *
     * @since 1.0.0
     */
    public function _check_php_version(){
        Notice::push(
			[
				'id'          => 'unsupported-php-version',
				'type'        => 'error',
				'dismissible' => true,
				'message'     => sprintf( esc_html__( 'NextAddons requires PHP version %1$s+, which is currently NOT RUNNING on this server.', 'next-addons' ), '5.6'),
			]
		);
    }
	public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}

}