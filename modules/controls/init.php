<?php 
namespace NextAddons\Modules\Controls;
defined( 'ABSPATH' ) || exit;
/**
 * Global Icons class.
 *
 * @since 1.0.0 - hazi
 */
class Init{
    private static $instance;

    //public static function get_controls
    public static function _get_url(){
        return \NextAddons\Plugin::modules_url().'controls/';
    }
    public static function _get_dir(){
        return \NextAddons\Plugin::modules_dir().'controls/';
    }

    public static function _version(){
        return \NextAddons\Plugin::version();
    }

    public function _init() {        
        add_action( 'wp_enqueue_scripts', [ $this , '_load_script'] );
        add_action( 'admin_enqueue_scripts', [ $this , '_load_script'] );

        //admin script
        add_action( 'admin_enqueue_scripts', [ $this , '_admin_scripts'] );
        // public script
        add_action( 'wp_enqueue_scripts', [ $this , '_public_scripts'] );

         // added image select control
        add_action('elementor/controls/controls_registered', [ $this, 'imageselect' ], 11 );
          
        if(current_user_can('manage_options')){
           // icon load
           Icons::instance()->__init();
            // generate icons
            //Icons::__generate_font();

            Clonea::instance()->__init();
            Column::instance()->__init();
            
        }
        
        Overlay::instance()->__init();
        Effect::instance()->__init();
        Transform::instance()->__init();
        Motion::instance()->__init();
        Link::instance()->__init();
       
    }

    public function _load_script(){
        wp_register_style( 'nextaddons-icons', self::_get_url() . 'assets/css/nx-icons.css',  false, self::_version() );
        wp_register_script( 'nextaddons-anime', self::_get_url() . 'assets/js/anime.min.js', [ 'jquery'], self::_version(), true );
        wp_register_script( 'nextaddons-effect-nx', self::_get_url() . 'assets/js/effect.js', [ 'jquery', 'nextaddons-anime'], self::_version(), true );
       
    }
    /**
     * Public function _admin_scripts.
     * enque admin scripts
     *
     * @since 1.0.0
     */
    public function _admin_scripts(){
        $screen = get_current_screen();
        
        if( in_array($screen->id, [ 'toplevel_page_next-addons']) ){

        }
        
    }

     /**
     * Public function _public_scripts.
     * enque public scripts
     *
     * @since 1.0.0
     */
    public function _public_scripts(){       
        wp_enqueue_style( 'nextaddons-icons' );     
        wp_enqueue_script('nextaddons-effect-nx');  
    }

    public function imageselect( $controls_manager ) {
        $controls_manager->register_control('imageselect', new \NextAddons\Modules\Controls\Imageselect());
    }

    public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}
}