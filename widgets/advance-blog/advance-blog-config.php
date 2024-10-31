<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Advance_Blog extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-advanceblog';
    }

    static function get_next_title() {
        return esc_html__( 'Blog Feed', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-blogging'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'blog', 'post', 'block', 'news', 'news feed', 'blog feed', 'magazine'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'advance-blog/';
            }
        }
        return Manifest::_widgets_dir() . 'advance-blog/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'advance-blog/';
            }
        }
        return Manifest::_widgets_url() . 'advance-blog/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-advance-blog', self::get_next_url() . 'assets/css/advance-blog.css', false, self::__version() );
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-advance-blog', $css);
    }

    public static function get_category( $cate = 'post' ){
        $post_cat = self::_get_terms($cate);
        
        $taxonomy	 = isset($post_cat[0]) && !empty($post_cat[0]) ? $post_cat[0] : ['category'];
        $query_args = [
            'taxonomy'      => $taxonomy,
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ];
        $terms = get_terms( $query_args );

        $options = [];
        $count = count( (array) $terms);
        if($count > 0):
            foreach ($terms as $term) {
                if( $term->parent == 0 ) {
                    $options[$term->term_id] = $term->name;
                    foreach( $terms as $subcategory ) {
                        if($subcategory->parent == $term->term_id) {
                            $options[$subcategory->term_id] = $subcategory->name;
                        }
                    }
                }
            }
        endif;      
        return $options;
    }
    
    public static function get_taxonomies( $cate = 'post', $type = 0){
        $post_cat = self::_get_terms($cate);
        
        $tag	 = isset($post_cat[$type]) && !empty($post_cat[$type]) ? $post_cat[$type] : 'category';
        $terms = get_terms( array(
            'taxonomy' => $tag, 
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ) );
      
        return $terms;
    }
    

    public static function  _get_terms( $post = 'post'){
        $taxonomy_objects = get_object_taxonomies( $post );
     return $taxonomy_objects;
    }
    

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}