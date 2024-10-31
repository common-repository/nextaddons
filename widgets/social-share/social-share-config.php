<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Social_Share extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-socialshare';
    }

    static function get_next_title() {
        return esc_html__( 'Social Share', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-social-media'; 
    }
	static function get_next_keywords() {
       return [ 'Share Social', 'Social', 'Like', 'Fans', 'Subscribe'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    public function _is_nextsocial_activated(){
        if ( did_action( 'nextsocial/loaded' ) ) {
            return true;
        }
        return false;
    }
    

    public function _get_counter(){
        if ( did_action( 'nextsocial/loaded' ) ) {
            if( class_exists( '\themeDevSocial\Apps\Sharing') ){
                $obj  = new \themeDevSocial\Apps\Sharing(false);
               return $obj;
            }
        }
        return;
    }

    public function _get_settings(){
        if ( did_action( 'nextsocial/loaded' ) ) {
            if( class_exists( '\themeDevSocial\Apps\Settings') ){
                $obj  = new \themeDevSocial\Apps\Settings(false);
               return $obj;
            }
        }
        return;
    }

    public function _counter_style(){
        if ( did_action( 'nextsocial/loaded' ) ) {
            if( class_exists( '\themeDevSocial\Apps\Settings') ){
                $styles = \themeDevSocial\Apps\Settings::$share_style;
                $r = [];
                foreach($styles as $k=>$v){
                    $r[$k] = isset($v['text']) ? $v['text'] : $k;
                }
                return $r;
            }
        }
        return [];
    }

    public function _counter_provider(){
        if ( did_action( 'nextsocial/loaded' ) ) {
            if( class_exists( '\themeDevSocial\Apps\Settings') ){
                $getProvider = get_option( \themeDevSocial\Apps\Settings::$sharing_provider_key, [] );
                $gProvider = isset($getProvider['provider']) ? array_keys($getProvider['provider']) : [];
                $r = [];
                foreach($gProvider as $v){
                    $r[$v] = ucfirst($v);
                }
                return $r;
            }
        }
        return [];
    }


    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'social-counter/';
            }
        }
        return Manifest::_widgets_dir() . 'social-counter/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'social-counter/';
            }
        }
        return Manifest::_widgets_url() . 'social-counter/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
       // wp_register_style( 'nextaddons-socialcounter', self::get_next_url() . 'assets/css/social-counter.css', false, self::__version() );
       
    }

    public function inline_css( $css = ''){
       // wp_add_inline_style( 'nextaddons-socialcounter', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}