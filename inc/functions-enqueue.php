<?php

namespace zenith;

/**
 * Load CSS & JS for the front-end
 * 
 * @since 1.0.0
 * @return void
 */
function enqueue_plugin_styles_scripts() {
    
    // Styles
    wp_enqueue_style( 'slick', get_plugin_url() . 'assets/lib/slick/slick.css', null, ZENITH_MODULES_VERSION );
    wp_enqueue_style( 'zenith-features-common', get_plugin_url() . 'assets/css/common.css', null, ZENITH_MODULES_VERSION );
    
    // Scripts
    wp_enqueue_script( 'slick', get_plugin_url() . 'assets/lib/slick/slick.min.js', array( 'jquery' ), ZENITH_MODULES_VERSION );

    if( current_user_can( 'edit_theme_options' ) ) {
        wp_enqueue_style( 'zenith-admin-css', get_plugin_url() . 'assets/admin/admin.css', null, ZENITH_MODULES_VERSION );
    }
    
}
add_action( 'wp_enqueue_scripts', 'zenith\enqueue_plugin_styles_scripts' );

/**
 * Load Admin JS & CSS for the back-end
 * 
 * @since 1.0.0
 * @return void
 */
function enqueue_admin_styles() {
    
    // Styles
    wp_enqueue_style( 'zenith-customize', get_plugin_url() . 'assets/admin/customizer.css', null, ZENITH_MODULES_VERSION );
    
    // Scripts
    wp_enqueue_media();
    wp_enqueue_script( 'wp-media-uploader', get_plugin_url() . 'assets/lib/wp-media-uploader/wp_media_uploader.js', array( 'jquery' ), ZENITH_MODULES_VERSION );
    wp_enqueue_script( 'zenith-admin', get_plugin_url() . 'assets/admin/admin.js', array( 'jquery' ), ZENITH_MODULES_VERSION );
    
}
add_action( 'customize_controls_enqueue_scripts', 'zenith\enqueue_admin_styles' );
add_action( 'admin_print_styles-post-new.php', 'zenith\enqueue_admin_styles' );
add_action( 'admin_print_styles-post.php', 'zenith\enqueue_admin_styles' );
add_action( 'admin_print_styles-widgets.php', 'zenith\enqueue_admin_styles' );

add_action( 'admin_enqueue_scripts', 'zenith\zenith_load_upgrade_css' );
function zenith_load_upgrade_css( $hook ) {
    
    // Enqueue fonts and css only on this page
    if( 
            'appearance_page_zenith-theme-upgrade' == $hook 
            || 'appearance_page_pt-one-click-demo-import' == $hook 
            || 'appearance_page_zenith-theme-tools' == $hook 
    ) {
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/lib/font-awesome/fontawesome-all.min.css' );
        wp_enqueue_style( 'zenith-admin-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900' );
        wp_enqueue_style( 'zenith-admin-css', get_plugin_url() . 'assets/admin/upgrade.css' );
        
        wp_enqueue_script( 'zenith-reset-content', get_plugin_url() . 'assets/admin/reset-content.js', array( 'jquery' ), ZENITH_MODULES_VERSION );
        
        wp_localize_script( 'zenith-reset-content', 'zenith', array(
            'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce('zenith_reset_content'),
        ) );
        
    }
    
}