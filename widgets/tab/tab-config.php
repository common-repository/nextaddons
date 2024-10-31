<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Tab extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-tab';
    }

    static function get_next_title() {
        return esc_html__( 'Tab', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-tabs-1'; 
    }
	static function get_next_keywords() {
       return [ 'advance tab', 'toggle tab', 'mixin', 'tab', 'toggle box'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'tab/';
            }
        }
        return Manifest::_widgets_dir() . 'tab/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'tab/';
            }
        }
        return Manifest::_widgets_url() . 'tab/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
        wp_register_style( 'nextaddons-tab', self::get_next_url() . 'assets/css/tab.css', false, self::__version() );
        wp_register_script( 'nextaddons-tab-nx', self::get_next_url() . 'assets/js/nx-tab.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-tab', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}