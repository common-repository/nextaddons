<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Pricing extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-pricing';
    }

    static function get_next_title() {
        return esc_html__( 'Pricing', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-pricing-tag'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'Pricing', 'price', 'list', 'compare', 'next pricing'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'pricing/';
            }
        }
        return Manifest::_widgets_dir() . 'pricing/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'pricing/';
            }
        }
        return Manifest::_widgets_url() . 'pricing/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-pricing', self::get_next_url() . 'assets/css/pricing.css', false, self::__version() );
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-pricing', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}