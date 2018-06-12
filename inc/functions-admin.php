<?php

namespace zenith;

add_filter( 'user_contactmethods', 'zenith\modify_user_contact_methods' );
add_action( 'wp_ajax_reset_content', '\zenith\reset_content' );
//add_action( 'admin_menu', 'zenith\add_tools_page' );
add_action( 'admin_menu', 'zenith\add_upgrade_page' );


function reset_content() {
    
    if( ! wp_verify_nonce( $_POST['nonce'], 'zenith_reset_content' ) ) {
        die('un-authorized');
    }
    
    global $wpdb;
    
    $wpdb->query( 'delete from ' . $wpdb->prefix . 'posts where post_type in ("post","page","zenith_faq","zenith_service","zenith_testimonial","zenith_event")');
    
    update_option( 'sidebars_widgets','' );
    
    exit();
}



    
function add_upgrade_page() {

    if ( function_exists( '\zenith_pro\init' ) ) {
        return;
    }

    add_theme_page( __( 'Zenith Pro', 'zenith' ), __( 'Zenith Pro', 'zenith' ), 'edit_theme_options', 'zenith-theme-upgrade', function() {
        include_once get_plugin_path() . '/admin/zenith-upgrade.php';
    });

}



function add_tools_page() {

    add_theme_page( __( 'Theme Tools', 'zenith' ), __( 'Theme Tools', 'zenith' ), 'edit_theme_options', 'zenith-theme-tools', function() {
        include_once get_plugin_path() . '/admin/zenith-tools.php';
    });
    
}


function modify_user_contact_methods( $user_contact ) {

    // Add additional user meta contact fields
    $user_contact['job_title']      = __( 'Job Title', 'zenith' );
    $user_contact['location']       = __( 'Location', 'zenith' );
    $user_contact['facebook']       = __( 'Facebook', 'zenith' );
    $user_contact['twitter']        = __( 'Twitter', 'zenith' );
    $user_contact['linkedin']       = __( 'LinkedIn', 'zenith' );
    $user_contact['pinterest']      = __( 'Pinterest', 'zenith' );
    $user_contact['instagram']      = __( 'Instagram', 'zenith' );
    $user_contact['author_banner']  = __( 'Author Banner Image URL', 'zenith' );

    return $user_contact;
    
}
