<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Tooltip extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-tooltip';
    }

    static function get_next_title() {
        return esc_html__( 'ToolTip', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-tooltip'; 
    }
	static function get_next_keywords() {
       return ['tooltip', 'hover text', 'hover box', 'tool box'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'tooltip/';
            }
        }
        return Manifest::_widgets_dir() . 'tooltip/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'tooltip/';
            }
        }
        return Manifest::_widgets_url() . 'tooltip/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
        wp_register_style( 'nextaddons-tooltip', self::get_next_url() . 'assets/css/tooltip.css', false, self::__version() );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-tooltip', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}