<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Heading extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'themedev-next-headding';
    }

    static function get_next_title() {
        return esc_html__( 'Heading', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-text'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'heading', 'title', 'sub title', 'header', 'next heading'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir() {
        return Manifest::_widgets_dir() . 'heading/';
    }
    
    static function get_next_url() {
        return Manifest::_widgets_url() . 'heading/';
    }
    
    static function __version(){
        return Manifest::_version();
    }
    public function next_scripts(){
        wp_register_style( 'nextaddons-headding', self::get_next_url() . 'assets/css/heading.css', false, self::__version() );
    }
    
    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-headding', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}