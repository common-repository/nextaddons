<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Accordion extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-accordion';
    }

    static function get_next_title() {
        return esc_html__( 'Accordion', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-accordion'; 
    }
	static function get_next_keywords() {
       return [ 'advance accordion', 'accordion', 'accordion', 'tab', 'toggle box'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'accordion/';
            }
        }
        return Manifest::_widgets_dir() . 'accordion/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'accordion/';
            }
        }
        return Manifest::_widgets_url() . 'accordion/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
        wp_register_style( 'nextaddons-accordion', self::get_next_url() . 'assets/css/accordion.css', false, self::__version() );
        wp_register_script( 'nextaddons-collapse-nx', self::get_next_url() . 'assets/js/nx-collapse.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-accordion', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}