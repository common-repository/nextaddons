<?php namespace NextAddons\Modules\Controls;defined('ABSPATH')||exit;class Icons{private static $instance;public function __init(){add_filter('elementor/icons_manager/additional_tabs',[$this,'__add_fonts'],99);}public function __add_fonts($tabs){$tab['nxicons']=['name'=>'nxicons','label'=>__('Next Addons - Icons','next-addons'),'url'=>Init::_get_url().'assets/css/nx-icons.css','enqueue'=>[Init::_get_url().'assets/css/nx-icons.css'],'prefix'=>'nx-icon-','displayPrefix'=>'nx-icon','labelIcon'=>'nx-icon nx-icon-down-arrow','ver'=>'5.9.0','fetchJson'=>Init::_get_url().'assets/js/nx-icons.js','native'=>true,];$tabs_marge=apply_filters('nextaddons/icons_manager/native',$tab);return array_merge($tabs,$tabs_marge);}public static function __generate_font(){global $wp_filesystem;require_once(ABSPATH.'/wp-admin/includes/file.php');WP_Filesystem();$css_file=Init::_get_dir().'assets/css/nx-icons.css';if($wp_filesystem->exists($css_file)){$css_source=$wp_filesystem->get_contents($css_file);}preg_match_all("/\.(nx-icon-.*?):\w*?\s*?{/",$css_source,$matches,PREG_SET_ORDER,0);$iconList=[];foreach($matches as $match){$icon=str_replace('nx-icon-','',$match[1]);$icons=explode(' ',$icon);$iconList[]=current($icons);}$icons=new \stdClass();$icons->icons=$iconList;$icon_data=json_encode($icons);$file=Init::_get_dir().'assets/js/nx-icons.js';global $wp_filesystem;require_once(ABSPATH.'/wp-admin/includes/file.php');WP_Filesystem();if($wp_filesystem->exists($file)){$content=$wp_filesystem->put_contents($file,$icon_data);}}public static function instance(){if(!self::$instance){self::$instance=new self();}return self::$instance;}}