<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Step_Flow extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-stepflow';
    }

    static function get_next_title() {
        return esc_html__( 'Step Flow', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-step-flow'; 
    }
	static function get_next_keywords() {
       return [ 'Step Flow', 'Flowchart', 'Flow', 'Direction', 'Use Process', 'Guideline'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'step-flow/';
            }
        }
        return Manifest::_widgets_dir() . 'step-flow/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'step-flow/';
            }
        }
        return Manifest::_widgets_url() . 'step-flow/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-stepflow', self::get_next_url() . 'assets/css/step-flow.css', false, self::__version() );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-stepflow', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}