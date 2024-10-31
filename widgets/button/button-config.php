<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Button extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-button';
    }

    static function get_next_title() {
        return esc_html__( 'Button', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-button'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'single button', 'animation button', 'link', 'button'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'button/';
            }
        }
        return Manifest::_widgets_dir() . 'button/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'button/';
            }
        }
        return Manifest::_widgets_url() . 'button/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-button', self::get_next_url() . 'assets/css/button.css', false, self::__version() );
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-button', $css);
    }


    public function _get_video_data_new( $type, $url ) {
        
        $return = apply_filters('nextaddons_button_geturl', $type, $url);
        if(!empty( $return ) && $return != 'youtube'){
            return $return;
        }
        $return = [];
		
		$youtube = 'https://www.youtube.com/oembed?url=%s&format=json';
        
        $service = 'youtube';
        $id = '';
		if( $service == 'youtube' ) {
			$data_url = sprintf( $youtube, $url );			
			if(stripos( $url, 'youtu.be' ) !== false){
				$id = substr( parse_url( $url, PHP_URL_PATH ), 1 );
				$id = strlen($id) > 0 ? $id : time();
			}else if(strpos( $url, 'youtube.com' ) !== false){
				parse_str( parse_url( $url, PHP_URL_QUERY ), $query );
				if( !isset( $query['v'] ) ){
					return false;
				}
				$id = $query['v'];
				$id = strlen($id) > 0 ? $id : time();
			}else if( stripos( $url, 'youtube.com/embed' ) !== false ){
                $id = substr( parse_url( $url, PHP_URL_PATH ), 2 );
                $id = strlen($id) > 0 ? $id : '';
            }		

			$response = wp_remote_get( $data_url );
			if ( is_array( $response ) && ! is_wp_error( $response ) ) {
				$data    = json_decode($response['body']); 
			}else{
				return false;
			}
			if( !isset($data->thumbnail_url) ){
				return false;
			}
			$return = array( 'thumbnail' => $data->thumbnail_url, 'id' => $id, 'type' => 'youtube', 'title' => $data->title, 'html' => $data->html );
		}

		return $return;

	}

    public function _get_id( $type, $url ){
        
        if( strpos( $url, 'youtube.com' ) !== false || stripos( $url, 'youtu.be' ) !== false ) {
			$service = 'youtube';	
		}else{
			$service = '';
        }
        $service = !empty($service) ? $service : $type;
        $id = '';
        switch( $service ){

            case 'youtube':
                if(stripos( $url, 'youtu.be' ) !== false){
                    $id = substr( parse_url( $url, PHP_URL_PATH ), 1 );
                    $id = strlen($id) > 0 ? $id : '';
                }else if(strpos( $url, 'youtube.com' ) !== false){
                    parse_str( parse_url( $url, PHP_URL_QUERY ), $query );                 
                    $id = isset($query['v']) ? $query['v'] : '';
                } else if( stripos( $url, 'youtube.com/embed' ) !== false ){
                    $id = substr( parse_url( $url, PHP_URL_PATH ), 2 );
                    $id = strlen($id) > 0 ? $id : '';
                }
            break;
        }
        return [ 'id' => $id, 'type' => $service]; 
    }

    public function _embaed_url( $type, $url_video, $settings){
        
        $url = apply_filters('nextaddons_button_getembaded_url', $type, $url_video, $settings);
        if(!empty($url) && $url != 'youtube'){
            return $url;
        }

        $videos = $this->_get_id($type, $url_video);
        if( !isset($videos['id'])){
            return null;
        }
        $video = $videos['id'];
        $video_type = isset($videos['type']) ? $videos['type'] : $type;
        $autoplay = ($settings['autoplay'] == 'yes') ? 1 : 0;
       
        $url = null;
        if( $video_type == 'youtube' ) {
            $youtube_query = [
                'autoplay' => $autoplay
            ] ;

            $youtube_query = http_build_query( $youtube_query );
            $url =  '//www.youtube.com/embed/'.$video.'?'.$youtube_query;
        }
        return  $url;
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}