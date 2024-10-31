<?php
namespace NextAddons\Apps;

defined( 'ABSPATH' ) || exit;

class Build{
	/**
	 * Collection of default widgets.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private static $instance;

    public function _init() {

        add_action( 'rest_api_init', function () {
            register_rest_route( 'nextaddons/', '/v(?P<version>\d+)/(?P<route>\w+)', array(
              'methods' => 'POST',
              'callback' => [$this, 'register_post_apis'],
            ));
        });
        
        add_action( 'rest_api_init', function () {
            register_rest_route( 'nextaddons/', '/v(?P<version>\d+)/(?P<route>\w+)', array(
              'methods' => 'GET',
              'callback' => [$this, 'register_get_apis'],
            ));
        });
    }
    
    public function register_post_apis(\WP_REST_Request  $request){
        $route = $request['route'];
       do_action('nextaddons/apis_registered/post', $route, $request);
    }
    public function register_get_apis(\WP_REST_Request $request){
		  return do_action('nextaddons/apis_registered/get', $request);
    }
	
	public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}
}