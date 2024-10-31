<?php 
namespace NextAddons\Modules;
defined( 'ABSPATH' ) || exit;
/**
 * Global Load class.
 *
 * @since 1.0.0
 */
class Load{
    private static $instance;

    public static function _get_url(){
        return \NextAddons\Plugin::modules_url();
    }
    public static function _get_dir(){
        return \NextAddons\Plugin::modules_dir();
    }

    public static function _version(){
        return \NextAddons\Plugin::version();
    }

    public function _init() {        
        // call Controls Modules
        Controls\Init::instance()->_init();
           
        if(current_user_can('manage_options')){
           // proactive
           Proactive\Init::instance()->_init();
        }
        
    }

    public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}
}