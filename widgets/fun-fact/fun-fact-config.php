<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Fun_Fact extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-funfact';
    }

    static function get_next_title() {
        return esc_html__( 'Fun Fact', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-fun-facts-line'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'Fun Fact', 'Counter', 'Timmer', 'time', 'target'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'fun-fact/';
            }
        }
        return Manifest::_widgets_dir() . 'fun-fact/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'fun-fact/';
            }
        }
        return Manifest::_widgets_url() . 'fun-fact/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-funfact', self::get_next_url() . 'assets/css/funfact.css', false, self::__version() );
        wp_register_script( 'nextaddons-funfact-nx', self::get_next_url() . 'assets/js/nx-fun-fact.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-funfact', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}