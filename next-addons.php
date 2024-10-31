<?php
defined( 'ABSPATH' ) || exit;
/**
 * Plugin Name: Next Addons
 * Description: The most advanced addons for Elementor Page Builder  of WordPress with powerful custom controls with custom class and custom css. Design Beautiful Professional Websites, Without The Pain.
 * Plugin URI: http://nextaddons.themedev.net
 * Author: ThemeDev
 * Version: 2.1.2
 * Author URI: http://themedev.net
 *
 * Text Domain: next-addons
 *
 * @package NextAddons
 * @category free
 *
 * NextAddons is a most advanced addon for Elementor page builder of WordPress.
 *
 * License:  GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

define( 'NEXTADDONS_FILE_', __FILE__ );

include 'loader.php'; 
include 'plugin.php';

// load plugin
add_action( 'plugins_loaded', function(){
	// load text domain
	load_plugin_textdomain( 'next-addons', false, basename( dirname( __FILE__ ) ) . '/languages'  );

	// load plugin instance
	\NextAddons\Plugin::instance()->init();
}, 100); 

// 110


	

