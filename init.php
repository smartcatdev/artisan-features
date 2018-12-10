<?php
/**
 * Plugin Name: Zenith Features
 * Author: Smartcat
 * Description: Advanced Widgets for Zenith theme.
 * Version: 1.0.0
 * Author: Smartcat
 * Author URI: https://smartcatdesign.net/
 * License: GPL V2
 * Text Domain: zenith
 * Domain Path: /languages 
 *
 * @package zenith
 * @since 1.0.0
 */
namespace zenith;

/**
 * Exit if accessed directly for security
 */
if( !defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Constant Declarations
 */
const ZENITH_MODULES_VERSION = '1.0.0';
const BUILD_MIN_VERSION = '1.0.0';

/**
 * @since 1.0.0
 * @param string $path
 * @return string
 */
function get_plugin_path( $path = '' ) {
    return plugin_dir_path( __FILE__ ) . $path;
}

/**
 * @since 1.0.0
 * @param string $url
 * @return string
 */
function get_plugin_url( $url = '' ) {
    return plugin_dir_url( __FILE__ ) . $url;
}


// initialize the plugin
add_action( 'plugins_loaded', 'zenith\plugins_loaded', 99 );

/**
 * Checks if Zenith is active as a parent or child theme
 */
function zenith_flag() {
    
    if ( function_exists( 'wp_get_theme' ) ) {

        $active_theme = wp_get_theme();

        $active_theme_name = strtolower( $active_theme->get( 'Name' ) );
        $parent_theme_name = strtolower( $active_theme->get( 'Template' ) );

    } else {

        $active_theme_name = strtolower( get_option( 'current_theme') );
        $parent_theme_name = strtolower( get_option( 'current_theme') );

    }
    
    if( $active_theme_name == 'zenith' || $parent_theme_name == 'zenith' ) {
        return true;
    }
    
    return false;
}

/**
 * @since 1.0.0
 * @return null
 */
function after_setup_theme() {

    if( ZENITH_VERSION < BUILD_MIN_VERSION ) {

        $message = 'Please update your Zenith theme. This is a required update. <a href="' . esc_url( admin_url( 'themes.php' ) ) . '">Click here</a> then click Update on the Zenith Theme Icon';

        make_admin_notice( __( $message, 'error', false ) );

        return;
    }
    
   /**
    * Load Necessary Includes
    */
    require get_plugin_path() . 'inc/functions-fontawesome.php';
    require get_plugin_path() . 'inc/functions-general.php';
    require get_plugin_path() . 'inc/functions-metabox.php';
    require get_plugin_path() . 'inc/functions-shortcodes.php';
    if ( !class_exists( 'AcidConfig' ) ) { require get_plugin_path( '/inc/lib/Acid/acid.php' ); }
    require get_plugin_path() . 'inc/functions-widgets.php';
    require get_plugin_path() . 'inc/functions-enqueue.php';
    require get_plugin_path() . 'inc/functions-css.php';
    
    require get_plugin_path() . 'inc/functions-tgmpa.php';
    
    if ( !function_exists( '\zenith_pro\init' ) ) {
        require get_plugin_path() . 'inc/functions-updates.php';
        require get_plugin_path() . 'inc/customizer/class-zenith-pro-customize.php';
    }
    
    do_action( 'zenith_after_setup_theme' );
    
}

function plugins_loaded() {
    
    
    if( ! zenith_flag() ) {
        return false;
    }
    
    if( is_admin() ) {
        require get_plugin_path() . 'inc/functions-admin.php';
    }
    
    require get_plugin_path() . 'inc/functions-import.php';
    
    do_action( 'zenith_plugins_loaded' );
    
    add_action( 'after_setup_theme', 'zenith\after_setup_theme', 99 );  
    
}

function make_admin_notice( $message, $type = 'error', $dismissible = true ) {
    add_action( 'admin_notices', function () use ( $message, $type, $dismissible ) {
        echo '<div class="notice notice-' . esc_attr( $type ) . ' ' . ( $dismissible ? 'is-dismissible' : '' ) . '">';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    } );
}

function init() {
    return;
}
