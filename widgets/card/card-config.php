<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Card extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-card';
    }

    static function get_next_title() {
        return esc_html__( 'Card', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-image-box'; 
    }
	static function get_next_keywords() {
       return [ 'Buy', 'Woo', 'Card', 'Promo Box', 'Card Box', 'shop'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'card/';
            }
        }
        return Manifest::_widgets_dir() . 'card/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'card/';
            }
        }
        return Manifest::_widgets_url() . 'card/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-card', self::get_next_url() . 'assets/css/card.css', false, self::__version() );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-card', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}