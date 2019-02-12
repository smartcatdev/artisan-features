<?php

namespace beyrouth;


//add_action( 'admin_init', 'beyrouth\pro_announce' );


function pro_announce() {
    
    if( ! get_option( 'beyrouth_pro_announce') ) {
        
        update_option( 'beyrouth_pro_announce', true );
        wp_safe_redirect( admin_url( 'themes.php?page=beyrouth-theme-upgrade' ) );
        exit();
    }
    
}