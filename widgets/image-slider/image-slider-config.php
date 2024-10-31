<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Image_Slider extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-imageslider';
    }

    static function get_next_title() {
        return esc_html__( 'Image Slider', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-slider'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'Slider', 'Video', 'Photos Slider', 'Image Slider', 'Single Slider'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'image-slider/';
            }
        }
        return Manifest::_widgets_dir() . 'image-slider/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'image-slider/';
            }
        }
        return Manifest::_widgets_url() . 'image-slider/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-image-slider', self::get_next_url() . 'assets/css/image-slider.css', false, self::__version() );
       
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-image-slider', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}