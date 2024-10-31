<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Price_Menu extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-pricemenu';
    }

    static function get_next_title() {
        return esc_html__( 'Price Menu', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-price-tag'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'Price Menu', 'Price List', 'Foods List', 'Pricing List', 'List Price'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'price-menu/';
            }
        }
        return Manifest::_widgets_dir() . 'price-menu/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'price-menu/';
            }
        }
        return Manifest::_widgets_url() . 'price-menu/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-price-menu', self::get_next_url() . 'assets/css/price-menu.css', false, self::__version() );
       
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-price-menu', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}