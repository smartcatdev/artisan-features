<?php

namespace zenith;

/**
 * Enqueue scripts and styles.
 */
function wp_head_styles() { ?>
    
    <style type="text/css">

        
        
    </style>
    
<?php
}
add_action( 'wp_head', '\zenith\wp_head_styles' );