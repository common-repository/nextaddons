<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Hotspots extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-hotspots';
    }

    static function get_next_title() {
        return esc_html__( 'Hotspots', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-hotspot'; 
    }
	static function get_next_keywords() {
       return [ 'Map', 'Info', 'Mapping', 'Focus', 'Hotspots', 'Tag'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'hotspots/';
            }
        }
        return Manifest::_widgets_dir() . 'hotspots/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'hotspots/';
            }
        }
        return Manifest::_widgets_url() . 'hotspots/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-hotspots', self::get_next_url() . 'assets/css/hotspots.css', false, self::__version() );
        wp_register_style( 'nextaddons-hotspots-nx', self::get_next_url() . 'assets/css/nx-focus-timeline.css', false, self::__version() );
        wp_register_script( 'nextaddons-hotspots-nx', self::get_next_url() . 'assets/js/nx-focus-timeline.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-hotspots', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}