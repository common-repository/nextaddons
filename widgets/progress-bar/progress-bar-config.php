<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;

use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Progress_Bar extends Next_Widget{

    private static $instance;
    
	public function next_init(){
       
    }

    static function get_next_name() {
        return 'nextaddons-progressbar';
    }

    static function get_next_title() {
        return esc_html__( 'Progress bar', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-progress-bar-line';
    }
	static function get_next_keywords() {
       return [ 'bar', 'progress', 'progress bar', 'skill bar', 'skills', 'next progress bar'];
    }
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir() {
        return Manifest::_widgets_dir() . 'progress-bar/';
    }
    
    static function get_next_url() {
        return Manifest::_widgets_url() . 'progress-bar/';
    }
   
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        
        wp_register_style( 'nextaddons-progressbar', self::get_next_url() . 'assets/css/progress-bar.css',  false, self::__version() );
        wp_register_script( 'nextaddons-progressbar-nx', self::get_next_url() . 'assets/js/nx-progress-bar.js', [ 'elementor-frontend'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-progressbar', $css);
    }
    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

   
}