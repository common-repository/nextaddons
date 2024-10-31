<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Icon_Cap extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-iconcap';
    }

    static function get_next_title() {
        return esc_html__( 'Icon Cap', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-faq1'; 
    }
	static function get_next_keywords() {
       return [ 'Icon Box', 'Icon', 'Cap', 'Info Box', 'Box Icon'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'icon-cap/';
            }
        }
        return Manifest::_widgets_dir() . 'icon-cap/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'icon-cap/';
            }
        }
        return Manifest::_widgets_url() . 'icon-cap/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-iconcap', self::get_next_url() . 'assets/css/icon-cap.css', false, self::__version() );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-iconcap', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}