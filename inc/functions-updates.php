<?php

namespace zenith;


//add_action( 'admin_init', 'zenith\pro_announce' );


function pro_announce() {
    
    if( ! get_option( 'zenith_pro_announce') ) {
        
        update_option( 'zenith_pro_announce', true );
        wp_safe_redirect( admin_url( 'themes.php?page=zenith-theme-upgrade' ) );
        exit();
    }
    
}