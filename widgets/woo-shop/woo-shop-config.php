<?php 
namespace NextAddons\Widgets;
use \NextAddons\Apps\Next_Widget as Next_Widget;
use \NextAddons\Widgets\Manifest as Manifest;

class NextConfig_Woo_Shop extends Next_Widget{

    private static $instance;
    
	public function next_init(){
        
    }
    
    static function get_next_name() {
        return 'nextaddons-wooshop';
    }

    static function get_next_title() {
        return esc_html__( 'Woo Shop', 'next-addons' );
    }

    static function get_next_icon() {
        return 'nexticons nx-addons nx-addons-cart'; // addons-pro
    }
	static function get_next_keywords() {
       return [ 'shop', 'post', 'products', 'woocommerce', 'products feed', 'cart', 'shopping'];
    }
  
    static function get_next_categories() {
        return [ 'next-addons-lite' ];
    }
    
    static function get_next_dir( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_dir() . 'woo-shop/';
            }
        }
        return Manifest::_widgets_dir() . 'woo-shop/';
    }
    
    static function get_next_url( $type = '') {
        if($type == 'pro'){
            if ( did_action( 'nextaddonsPro/loaded' ) ) {
                return \NextAddonsPro\Widgets\Manifest::_widgets_url() . 'woo-shop/';
            }
        }
        return Manifest::_widgets_url() . 'woo-shop/';
    }
    
    static function __version(){
        return Manifest::_version();
    }

    public function next_scripts(){
        wp_register_style( 'nextaddons-wooshop', self::get_next_url() . 'assets/css/shop.css', false, self::__version() );
    }

    public function inline_css( $css = ''){
        wp_add_inline_style( 'nextaddons-wooshop', $css);
    }

    public static function get_category( $cate = 'product' ){
        $post_cat = self::_get_terms($cate);
        
        $taxonomy	 = isset($post_cat[0]) && !empty($post_cat[0]) ? $post_cat[0] : ['product_cat'];
        $query_args = [
            'taxonomy'      => ['product_cat'],
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
    
    public static function get_taxonomies( $cate = 'product', $type = 0){
        $post_cat = self::_get_terms($cate);
        
        $tag	 = isset($post_cat[$type]) && !empty($post_cat[$type]) ? $post_cat[$type] : 'product_cat';
        $terms = get_terms( array(
            'taxonomy' => $tag, 
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ) );
      
        return $terms;
    }

    public static function  _get_terms( $post = 'product'){
        $taxonomy_objects = get_object_taxonomies( $post );
     return $taxonomy_objects;
    }
    
  
    public static function get_post($cate = ''){
        $post_type = ['product'];
        $args['post_status'] = 	'publish';
        $args['post_type'] =  $post_type;

        if(is_array($cate) && !empty($cate) ){
            $args['tax_query'] = [ 
                [
                    'taxonomy' => 'product_cat', 
                    'field'    => 'id',
                    'terms'    => $cate,
                ],
            ];
        }

        $posts = get_posts($args);    
        $options = [];
        $count = count((array)$posts);
        if($count > 0):
            foreach ($posts as $post) {
                $options[$post->ID] = $post->post_title;
            }
        endif;  

        return $options;
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

  
}