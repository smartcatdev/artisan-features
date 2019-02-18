<?php

namespace beyrouth;

add_filter( 'user_contactmethods', 'beyrouth\modify_user_contact_methods' );
add_action( 'wp_ajax_reset_content', '\beyrouth\reset_content' );
//add_action( 'admin_menu', 'beyrouth\add_tools_page' );
//add_action( 'admin_menu', 'beyrouth\add_upgrade_page' );


function reset_content() {
    
    if( ! wp_verify_nonce( $_POST['nonce'], 'beyrouth_reset_content' ) ) {
        die('un-authorized');
    }
    
    global $wpdb;
    
    $wpdb->query( 'delete from ' . $wpdb->prefix . 'posts where post_type in ("post","page","beyrouth_faq","beyrouth_service","beyrouth_testimonial","beyrouth_event")');
    
    update_option( 'sidebars_widgets','' );
    
    exit();
}



    
function add_upgrade_page() {

    if ( function_exists( '\beyrouth_pro\init' ) ) {
        return;
    }

    add_theme_page( __( 'Beyrouth Pro', 'beyrouth' ), __( 'Beyrouth Pro', 'beyrouth' ), 'edit_theme_options', 'beyrouth-theme-upgrade', function() {
        include_once get_plugin_path() . '/admin/beyrouth-upgrade.php';
    });

}



function add_tools_page() {

    add_theme_page( __( 'Theme Tools', 'beyrouth' ), __( 'Theme Tools', 'beyrouth' ), 'edit_theme_options', 'beyrouth-theme-tools', function() {
        include_once get_plugin_path() . '/admin/beyrouth-tools.php';
    });
    
}


function modify_user_contact_methods( $user_contact ) {

    // Add additional user meta contact fields
    $user_contact['job_title']      = __( 'Job Title', 'beyrouth' );
    $user_contact['location']       = __( 'Location', 'beyrouth' );
    $user_contact['facebook']       = __( 'Facebook', 'beyrouth' );
    $user_contact['twitter']        = __( 'Twitter', 'beyrouth' );
    $user_contact['linkedin']       = __( 'LinkedIn', 'beyrouth' );
    $user_contact['pinterest']      = __( 'Pinterest', 'beyrouth' );
    $user_contact['instagram']      = __( 'Instagram', 'beyrouth' );
    $user_contact['author_banner']  = __( 'Author Banner Image URL', 'beyrouth' );

    return $user_contact;
    
}
