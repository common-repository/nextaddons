<?php 
namespace NextAddons\Widgets;

use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Subscribe extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-subscribe';
    }

    static function get_next_title() {
        return esc_html__( 'Subscribe', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-subscribe'; 
    }
	static function get_next_keywords() {
       return [ 'Campaign', 'subscribe', 'mailchimp', 'newsletter', 'forms'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    public function _is_nextmail_activated(){
        if ( did_action( 'nextmail/loaded' ) ) {
            return true;
        }
        return false;
    }
    

    public function _get_next_forms(){
        if ( did_action( 'nextmail/loaded' ) ) {
            if( class_exists( '\themeDevMail\Apps\Settings') ){
                $obj  = new \themeDevMail\Apps\Settings(false);
                if( method_exists( '\themeDevMail\Apps\Settings', 'get_mail') ){
                    return $obj->get_mail();
                }
            }
            return [
               '' => 'No found any form'
           ];
        }
        return [];
    }

    public function _mail_shortcode_action( $atts ){
        if ( did_action( 'nextmail/loaded' ) ) {
            if( class_exists( '\themeDevMail\Apps\Mail') ){
                $obj  = new \themeDevMail\Apps\Mail(false);
                if( method_exists( '\themeDevMail\Apps\Mail', 'next_mail_shortcode_action') ){
                    return $obj->next_mail_shortcode_action($atts);
                }
            }
        }
        return;
    }

    public function _form_style(){
        if ( did_action( 'nextmail/loaded' ) ) {
            if( class_exists( '\themeDevMail\Apps\Settings') ){
                $data = \themeDevMail\Apps\Settings::$form_style;
                $r = [];
                foreach( $data as $k=>$v){
                    $r[$k] = $v['text'];
                }
                return $r;
            }
            return [
               '' => 'No found any form'
           ];
        }
        return [];
    }

    public function _get_icons(){
        if ( did_action( 'nextmail/loaded' ) ) {
            if( class_exists( '\themeDevMail\Apps\Mail') ){
                $obj  = new \themeDevMail\Apps\Mail(false);
                if( method_exists( '\themeDevMail\Apps\Mail', '__get_icons') ){
                    return $obj->__get_icons();
                }
            }
        }
        return [];
    }

    public function _icon_position(){
       
        return [
            'left' => 'Left',
            'right' => 'Right',
        ];
    }

    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'subscribe/';
            }
        }
        return Manifest::_widgets_dir() . 'subscribe/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'subscribe/';
            }
        }
        return Manifest::_widgets_url() . 'subscribe/';
    }
    
    static function __version(){
        return Manifest::_version();
    }


    public function next_scripts(){
       // wp_register_style( 'nextaddons-subscribe', self::get_next_url() . 'assets/css/subscribe.css', false, self::__version() );
       
    }

    public function inline_css( $css = ''){
       // wp_add_inline_style( 'nextaddons-subscribe', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}