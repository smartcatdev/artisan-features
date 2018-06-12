<?php namespace zenith; ?>

<div class="wrap" id="zenith-upgrade-prompt">
    
    <div>
        <h2></h2>
    </div>
    
    <div id="zenith-docs-content">
        <?php _e( 'Use these tools to delete any custom or demo content that you have on your site. Be advised that once you delete something, it cannot be restored', 'zenith') ?>
    </div>
    
    <div id="zenith-docs-content">
        <h2 class="section-subheading">
            <?php esc_html_e( 'Reset Content', 'zenith' ); ?>
            <a class="get-button button button-primary" id="reset-content" href="#">
                <?php esc_html_e( 'Delete content', 'zenith' ); ?>
            </a>
        </h2>
        <span class="discount-code"><?php _e( 'Clicking will <b>delete all widgets pages, posts, testimonials, faqs, events and services</b>', 'zenith' ) ?></span><br>
        <span class="discount-code"><?php _e( 'Useful if you\'re re-importing another preset', 'zenith' ) ?></span>
        <div class="clear"></div>
    </div>
    
    
</div>