<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Pie_Chart extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-piechart';
    }

    static function get_next_title() {
        return esc_html__( 'Pie', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-pie1'; 
    }
	static function get_next_keywords() {
       return [ 'Pie Bar', 'Counter', 'Chart', 'Pie', 'Progress', 'Percentange'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'pie-chart/';
            }
        }
        return Manifest::_widgets_dir() . 'pie-chart/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'pie-chart/';
            }
        }
        return Manifest::_widgets_url() . 'pie-chart/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-piechart', self::get_next_url() . 'assets/css/pie-chart.css', false, self::__version() );
        wp_register_script( 'nextaddons-piechart-nx', self::get_next_url() . 'assets/js/nx.easypiechart.js', [ 'elementor-frontend', 'jquery'], self::__version(), true );
        
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-piechart', $css);
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}