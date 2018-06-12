<?php namespace zenith; ?>

<div class="wrap" id="zenith-upgrade-prompt">
    
    <div>
        <h2></h2>
    </div>
    
    <div id="zenith-docs-content">
        
        <h2 class="section-heading">
            <img class="zenith-pro-logo" src="<?php url(get_plugin_url() . 'assets/images/zenith_pro.png' ); ?>" alt="<?php esc_html_e( 'Zenith Pro', 'zenith' ); ?>">
            <?php esc_html_e( 'Now Available!', 'zenith' ); ?>
            <a class="get-button button button-primary" href="https://smartcatdesign.net/downloads/zenith-pro/">
                <?php esc_html_e( 'Get Zenith Pro', 'zenith' ); ?>
            </a>
        </h2>

        <span class="discount-code"><?php _e( 'Get Zenith Pro today and receive a limited time <span class="accent-color">50% discount</span>', 'zenith' ) ?></span>
        
        <div class="clear"></div>
        
    </div>
    
    <div id="">
        
        <h2 style="margin-bottom: 30px" class="section-subheading"><?php _e( 'Zenith Pro Demos & Presets', 'zenith' ) ?></h2>
        
        <div id="upgrade-presets-loop">
            
            <?php $presets = pro_import_files(); ?>
            
            <?php foreach ( $presets as $preset ) : ?>
            
                <div class="preset">
                    
                    <img src="<?php url( $preset['import_preview_image_url'] ); ?>" alt="<?php attr( $preset['import_file_name'] ); ?>">
                    
                    <div class="preset-content">
                        
                        <h4 class="title"><?php html( $preset['import_file_name'] ); ?></h4>
                        
                        <div class="button-wrap">
                            <a class="button button-primary" href="<?php url( $preset['preview_url'] ); ?>">
                                <?php esc_html_e( 'View Demo', 'zenith' ); ?>
                            </a>
                        </div>
                        
                    </div>
                    
                </div>
                
            <?php endforeach; ?>
            
            <div class="clear"></div>
            
        </div>
        
    </div>
    
    <div id="zenith-docs-content">

        <h2 class="section-heading">
            <?php esc_html_e( 'Why Get Zenith Pro?', 'zenith' ); ?>
        </h2>
        
        <div id="pro-features">
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-sliders-h"></span>

                    <p class="feature-label">
                        <?php esc_html_e( 'Live Customizer', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Zenith\'s Live Customizer is so easy to use, and allows you to preview any change before you publish it', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-bolt"></span>

                    <p class="feature-label">
                        <?php esc_html_e( 'Fast & Lightweight', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Zenith is intelligent about how it loads assets only when needed, it is optimized for speed', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-bars"></span>

                    <p class="feature-label">
                        <?php esc_html_e( 'Page Builder', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Create widgets, drag, drop and re-order them, customize each widget', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="clear"></div>
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-th-large"></span>

                    <p class="feature-label">
                        <?php esc_html_e( '20+ Widgets', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Highly customizable Sliders, Videos, Carousels, Galleries, Posts, CTAs, Pages, Events, FAQs, Pricing Tables, Maps', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-code"></span>

                    <p class="feature-label">
                        <?php esc_html_e( 'Coded By Experts', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Zenith is coded by developers who live and breathe WordPress. You can trust Zenith with you and your clients\' sites', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="feature-wrap">

                <div class="feature">

                    <span class="feature-icon fas fa-shopping-cart"></span>

                    <p class="feature-label">
                        <?php esc_html_e( 'E-commerce Ready', 'zenith' ); ?>
                    </p>

                    <p class="feature-description">
                        <?php esc_html_e( 'Zenith is fully integrated with WooCommerce, and designed to convert sales. Use it to create an online store', 'zenith' ); ?>
                    </p>

                </div>

            </div>
            
            <div class="clear"></div>
            
        </div>
        
    </div>
    
</div>