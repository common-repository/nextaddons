<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Timer extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-timer';
    }

    static function get_next_title() {
        return esc_html__( 'Timer', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-countdown-3'; 
    }
	static function get_next_keywords() {
       return [ 'Counting', 'Counter', 'Timmer', 'time', 'countdown', 'count', 'date'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'timer/';
            }
        }
        return Manifest::_widgets_dir() . 'timer/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'timer/';
            }
        }
        return Manifest::_widgets_url() . 'timer/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-timer', self::get_next_url() . 'assets/css/timer.css', false, self::__version() );
        wp_register_script( 'nextaddons-timer-nx', self::get_next_url() . 'assets/js/nx-counter-timer.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-timer', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}