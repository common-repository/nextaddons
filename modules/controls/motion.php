<?php 
namespace NextAddons\Modules\Controls;


use \NextAddons\Utilities\Package as Package;

defined( 'ABSPATH' ) || exit;
/**
 * Global Motion class themedev.
 *
 * @since 1.0.0 -
 */
class Motion{
    private static $instance;

    public function __init() {        
        add_action('elementor/controls/animations/additional_animations', [ $this, '__add_motions'], 99 );
    }

    public function __add_motions( $motion){

        return array_merge($motion, Package::_extend_animation());
    }

    public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}
}