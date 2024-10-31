<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Business_Hours extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-businesshours';
    }

    static function get_next_title() {
        return esc_html__( 'Business Hours', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-business-hour'; 
    }
	static function get_next_keywords() {
       return [ 'office schedule', 'office time', 'time', 'business hour', 'hour'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'business-hours/';
            }
        }
        return Manifest::_widgets_dir() . 'business-hours/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'business-hours/';
            }
        }
        return Manifest::_widgets_url() . 'business-hours/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
        wp_register_style( 'nextaddons-businesshours', self::get_next_url() . 'assets/css/business-hours.css', false, self::__version() );
       
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-businesshours', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}