<?php
namespace NextAddons\Widgets;
defined( 'ABSPATH' ) || exit;
use \NextAddons\Utilities\Help as Help;

Class Manifest{

    private static $instance;

	private $cate = [ 'next-addons-lite' => 'Next Addons', 'next-addons-pro' => 'Next Addons Pro', 'next-addons-header-footer' => 'Next Header & Footer', 'next-addons-megamenu' => 'Next MegaMenu' ];

    private function cate(){
        $cate = [
            'next-addons-lite' => 'Next Addons',
        ];

        return apply_filters( 'nextaddons_widgets_cate_add', $cate);
    }
    public static function _widgets_url(){
        return \NextAddons\Plugin::widgets_url();
    }
    public static function _widgets_dir(){
        return \NextAddons\Plugin::widgets_dir();
    }

    public static function _version(){
        return \NextAddons\Plugin::version();
    }

    public static function get_widgets_dir( $dir ){
        if($dir == 'next-addons-pro'){
            $file = \NextAddonsPro\Plugin::widgets_dir();
        }else{
            $file = \NextAddons\Plugin::widgets_dir();
        }
        return $file;
    }

    public static function get_class_config( $k, $dir ){
        if($dir == 'next-addons-pro'){
            $class = '\NextAddonsPro\Widgets\NextConfig_'. Help::_make_classname($k);
        }else{
            $class = '\NextAddons\Widgets\NextConfig_'. Help::_make_classname($k);
        }
        return $class;
    }

    public static function get_class( $k, $dir ){
        if($dir == 'next-addons-pro'){
            $class = '\Elementor\NextAddons_'. Help::_make_classname($k);
        }else{
            $class = '\Elementor\NextAddons_'. Help::_make_classname($k);
        }
        return $class;
    }
    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

	public function init() {
		add_action( 'elementor/elements/categories_registered', [$this, '_widget_categories']);
		add_action( 'elementor/widgets/widgets_registered', [ $this, '_register_widgets' ] );

	}

	public function _widgets(){
		$widget = [
            'card' => [ 'type' => 'next-addons', 'name' => 'Card', 'cate' => 'new', 'link' => 'card'],
            'woo-shop' => [ 'type' => 'next-addons', 'name' => 'Woo Shop', 'cate' => 'new', 'link' => 'woo-shop'],
            'heading' => [ 'type' => 'next-addons', 'name' => 'Heading', 'link' => 'heading'],
            'business-hours' => [ 'type' => 'next-addons', 'name' => 'Business Hours', 'link' => 'business-hour'],
            'button' => [ 'type' => 'next-addons', 'name' => 'Button', 'link' => 'button'],
            'dual-button' => [ 'type' => 'next-addons', 'name' => 'Dual Button', 'link' => 'dual-button'],
            'info-box' => [ 'type' => 'next-addons', 'name' => 'Info Box', 'link' => 'icon-box'],
            'icon-cap' => [ 'type' => 'next-addons', 'name' => 'Icon Cap', 'cate' => 'new',  'link' => 'icon-cap'],
            'image-box' => [ 'type' => 'next-addons', 'name' => 'Image Box', 'link' => 'image-box'],
            'image-slider' => [ 'type' => 'next-addons', 'name' => 'Image Slider',  'link' => 'image-slider'],
            'fun-fact' => [ 'type' => 'next-addons', 'name' => 'Fun Fact', 'link' => 'funfact'],
            'gallery' => [ 'type' => 'next-addons', 'name' => 'Gallery', 'link' => 'gallery'],
            'advance-gallery' => [ 'type' => 'next-addons', 'name' => 'Tab Gallery', 'link' => 'tab-gallery'],
            'slider' => [ 'type' => 'next-addons', 'name' => 'Slider', 'link' => 'slider'],
            'pricing' => [ 'type' => 'next-addons', 'name' => 'Pricing', 'cate' => '', 'link' => 'pricing-table'],
            'blog' => [ 'type' => 'next-addons', 'name' => 'Blog', 'link' => 'blog'],
            'advance-blog' => [ 'type' => 'next-addons', 'name' => 'Blog Feed', 'link' => 'blog-feed'],
            'progress-bar' => [ 'type' => 'next-addons', 'name' => 'Progress Bar', 'link' => 'progress-bar'],
            'pie-chart' => [ 'type' => 'next-addons', 'name' => 'Pie Chart', 'link' => 'pie-chart'],
            'price-menu' => [ 'type' => 'next-addons', 'name' => 'Price Menu', 'link' => 'price-menu'],
            'hotspots' => [ 'type' => 'next-addons', 'name' => 'Hotspots', 'link' => 'hotspots'],
            'timer' => [ 'type' => 'next-addons', 'name' => 'Timer', 'cate' => '', 'link' => 'countdown-timer'],
            'testimonial' => [ 'type' => 'next-addons', 'name' => 'Testimonial',  'link' => 'testimonial'],
            'team' => [ 'type' => 'next-addons', 'name' => 'Team',  'link' => 'team'],
            'accordion' => [ 'type' => 'next-addons', 'name' => 'Accordion', 'link' => 'accordion'],
            'tab' => [ 'type' => 'next-addons', 'name' => 'Tab', 'link' => 'tab'],
            'tooltip' => [ 'type' => 'next-addons', 'name' => 'ToolTip', 'cate' => 'new',  'link' => 'tooltip'],
            'step-flow' => [ 'type' => 'next-addons', 'name' => 'Step Flow', 'link' => 'step-flow'],
            'subscribe' => [ 'type' => 'next-addons', 'name' => 'Subscribe', 'link' => 'subscribe'],
            'social-counter' => [ 'type' => 'next-addons', 'name' => 'Social Counter', 'cate' => 'new', 'link' => 'social-counter'],
            'social-share' => [ 'type' => 'next-addons', 'name' => 'Social Share', 'link' => 'social-share'],
        ];
        return apply_filters( 'nextaddons_widgets_add', $widget);
	}

	public function _register_widgets( $widgets_manager ) {
        if(empty( $this->_widgets() ) || !is_array( $this->_widgets() )){
            return;
        }
        $getServices = get_option('__next_addons_active', '');
        $status = true;
        $active = [];
        if(is_array($getServices) && isset($getServices['addons']) ){
            $active = array_keys($getServices['addons']);
            $status = false;
        }

        foreach( $this->_widgets() as $k=>$v):
            $type = isset($v['type']) ? $v['type'] : '';
            
            if(!in_array($k, $active ) && !$status){
                continue;
            }
            $files = self::get_widgets_dir($type).$k.'/'.$k.'.php';
            $files_config = self::get_widgets_dir($type).$k.'/'.$k.'-config.php';           
            if( file_exists($files) && file_exists($files_config) ){
                require_once $files_config;
                require_once $files;
               
                $class_name = self::get_class($k,  $type);
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name());
			}
		endforeach;
	}

	public function _widget_categories( $elements_manager ) {
        if(empty( $this->cate() ) || !is_array( $this->cate() )){
            return;
        }

		foreach( $this->cate() as $k=>$v) :
			\Elementor\Plugin::$instance->elements_manager->add_category(
				$k,
				[
					'title' => esc_html__( $v, 'next-addons' ),
					'icon' => 'fa fa-plug',
				]
			);
		endforeach;
	}
}

