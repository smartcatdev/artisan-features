<?php 
namespace zenith;
?>

<div class="col-sm-12">

    <div class="flxbx center mid <?php attr( $icon_location ); ?>-align-image <?php attr( $text_align ); ?>-align-text">

        <div>
            
            <span class="icon-cta-icon <?php attr( $icon ); ?>"></span>
            
        </div>
        
        <div>
            
            <h3><?php attr( $title ); ?></h3>
            <p><?php html( $details ); ?></p>

            <?php button( $btn_text, $btn_url, $btn_style, $btn_size ); ?>
            
        </div>
        
    </div>
    
</div>
