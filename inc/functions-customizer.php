<?php

/**
 * Zenith Theme Customizer
 *
 * @package Zenith
 */
include_once zenith\get_plugin_path( '/inc/lib/Acid/acid.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zenith_customize_register( $wp_customize ) {
    
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    
    
    // Housekeeping ------------------------------------------------------------
    $wp_customize->get_section( 'header_image' )->panel = 'panel_custom_header';
    $wp_customize->get_section( 'title_tagline' )->title = __( 'General Settings', 'zenith' );
    $wp_customize->get_section( 'title_tagline' )->panel = 'panel_title_tagline';
    // End Housekeeping --------------------------------------------------------
    
    
    // Priority ----------------------------------------------------------------
    $wp_customize->get_section( 'title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_title_tagline' )->priority = 1;
    $wp_customize->get_panel( 'panel_navbar' )->priority = 2;
    $wp_customize->get_panel( 'panel_custom_header' )->priority = 3;
    $wp_customize->get_panel( 'panel_blog' )->priority = 4;
    $wp_customize->get_panel( 'panel_appearance' )->priority = 5;
    // End Priority ------------------------------------------------------------
    
    // Selective Refresh -------------------------------------------------------
    if ( isset( $wp_customize->selective_refresh ) ) {
        
        $wp_customize->selective_refresh->add_partial( 'blogname', array (
            'selector' => '.site-title a',
            'render_callback' => 'zenith_customize_partial_blogname',
        ) );
        
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array (
            'selector' => '.site-description',
            'render_callback' => 'zenith_customize_partial_blogdescription',
        ) );
        
        $wp_customize->selective_refresh->add_partial( ZENITH_OPTIONS::NAVBAR_SHOW_SOCIAL, array(
            'selector'  => '.navbar-social'
        ) );
        
        $wp_customize->selective_refresh->add_partial( ZENITH_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE, array(
            'selector'  => '#custom-header-content'
        ) );
        
        $wp_customize->selective_refresh->add_partial( ZENITH_OPTIONS::BLOG_SHOW_DATE, array(
            'selector'  => '.masonry_card_blog .post-date'
        ) );
        
        $wp_customize->selective_refresh->add_partial( ZENITH_OPTIONS::BLOG_CARD_FONT_SIZE_DSK, array(
            'selector'  => '.masonry_card_blog .entry-title'
        ) );
        
        $wp_customize->selective_refresh->add_partial( ZENITH_OPTIONS::BLOG_SHOW_COMMENT_COUNT, array(
            'selector'  => '.masonry_card_blog .meta-stats'
        ) );
        
    }
    // End Selective Refresh ---------------------------------------------------
}

add_action( 'customize_register', 'zenith_customize_register', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function zenith_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function zenith_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zenith_customize_preview_js() {
    wp_enqueue_style( 'zenith-customizer-preview-style', zenith\get_plugin_url( '/assets/admin/customizer-preview.css' ), ZENITH_VERSION, null );
    wp_enqueue_script( 'zenith-customizer-preview-script', zenith\get_plugin_url( '/assets/admin/customizer-preview.js' ), array ( 'jquery', 'customize-preview' ), ZENITH_VERSION, true );
}
add_action( 'customize_preview_init', 'zenith_customize_preview_js' );


function zenith_customize_controls_js() {
    wp_enqueue_script( 'zenith-customizer-control', zenith\get_plugin_url( '/assets/admin/customizer-control.js' ), array ( 'jquery', 'customize-controls' ), ZENITH_VERSION, true );
    wp_enqueue_style( 'zenith-customizer-style', zenith\get_plugin_url( '/assets/admin/customizer-alt.css' ), ZENITH_VERSION, null );
}
add_action( 'customize_controls_enqueue_scripts', 'zenith_customize_controls_js' );


$acid = acid_instance( zenith\get_plugin_url( '/inc/lib/' ) );

$data = array (
    
    'sections'  => array(
        
        'static_front_page'  => array(
            
            'title'         => __( 'Homepage Settings', 'zenith' ),
            'desciption'    => __( 'You can choose what\'s displayed on the homepage of your site. It can be posts in reverse chronological order (classic blog), or a fixed/static page. To set a static homepage, you first need to create two Pages. One will become the homepage, and the other will be where your posts are displayed.', 'zenith' ),
            'options'       => array(
                
                ZENITH_OPTIONS::HOMEPAGE_SHOW_CONTENT => array (
                    'type'          => 'toggle',
                    'label'         => __( 'Show the Frontpage Content?', 'zenith' ),
                    'description'   => __( 'While this is on, the content of the page set as the static Homepage will be visible', 'zenith' ),
                    'default'       => ZENITH_DEFAULTS::HOMEPAGE_SHOW_CONTENT,
                ),
                
            ),
            
        ),
        
    ),

    'panels' => array (

        // Panel: Site Title & Logo --------------------------------------------
        'panel_title_tagline' => array (

            'title'         => __( 'Site Title & Logo', 'zenith' ),
            'sections'      => array (
                
                // Section : Site Title & Logo: Advanced -----------------------
                'section_title_tagline' => array (

                    'title' => __( 'Advanced Settings', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::NAVBAR_BRANDING_WHAT_TO_SHOW => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Branding', 'zenith' ),
                            'description'   => __( 'Set whether the Navbar shows Site Title & Tagline or the custom Logo (if one is set).', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_WHAT_TO_SHOW,
                            'choices'   => array (
                                'title_tagline'     => __( 'Title & Tagline', 'zenith' ),
                                'logo'              => __( 'Logo', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_ALWAYS_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Logo - Always Visible?', 'zenith' ),
                            'description'   => __( 'If on, the logo will be visible even when Slim Navbar is collapsed / unstuck', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_ALWAYS_SHOW_LOGO,
                        ),
                        ZENITH_OPTIONS::NAVBAR_LOGO_HORIZONTAL_PADDING => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Horizontal Padding', 'zenith' ),
                            'description'   => __( 'Set the space (in pixels) between menu links and the logo', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LOGO_HORIZONTAL_PADDING
                        ),
                        ZENITH_OPTIONS::NAVBAR_LOGO_HEIGHT_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Desktop)', 'zenith' ),
                            'description'   => __( 'Set the logo height for the desktop Navbar', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LOGO_HEIGHT_DSK
                        ),
                        ZENITH_OPTIONS::NAVBAR_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Mobile)', 'zenith' ),
                            'description'   => __( 'Set the logo height for the mobile Navbar', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LOGO_HEIGHT_MBL
                        ),
                        ZENITH_OPTIONS::NAVBAR_SITE_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Title - Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SITE_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Title - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SITE_TITLE_FONT_SIZE
                        ),
                        ZENITH_OPTIONS::NAVBAR_SITE_TITLE_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Site Title - Letter Spacing', 'zenith' ),
                            'description'   => __( 'Set the scaling "em" value. Can be positive or negative. 0 for normal spacing.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SITE_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'zenith' ),
                                '-.075'     => __( '-.075em', 'zenith' ),
                                '-.050'     => __( '-.050em', 'zenith' ),
                                '-.025'     => __( '-.025em', 'zenith' ),
                                '0.0'       => __( '0.00em (Default)', 'zenith' ),
                                '.025'      => __( '.025em', 'zenith' ),
                                '.050'      => __( '.050em', 'zenith' ),
                                '.075'      => __( '.075em', 'zenith' ),
                                '.100'      => __( '.100em', 'zenith' ),
                                '.250'      => __( '.250em', 'zenith' ),
                                '.500'      => __( '.500em (Widest)', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_SITE_TITLE_ALL_CAPS => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Site Title - All Uppercase?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SITE_TITLE_ALL_CAPS
                        ),
                        ZENITH_OPTIONS::NAVBAR_HIDE_TAGLINE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Hide Site Tagline?', 'zenith' ),
                            'description'   => __( 'Both the Title & Tagline show by default when no logo is chosen', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_HIDE_TAGLINE,
                        ),
                        ZENITH_OPTIONS::NAVBAR_TAGLINE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Tagline - Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_TAGLINE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Tagline - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_TAGLINE_FONT_SIZE
                        ),
                        
                    )

                ),
                
            ), // End of Site Identity

        ), // End of Site Identity Panel
            
            
        // Panel: Custom Header ------------------------------------------------
        'panel_custom_header' => array (

            'title'         => __( 'Header', 'zenith' ),
            'desciption'    => __( 'Customize the header banner on your site', 'zenith' ),
            'sections'      => array (

                // Section : Custom Header Settings ----------------------------
                'section_custom_header_general' => array (

                    'title' => __( 'General Settings', 'zenith' ),
                    'options' => array (
                        // Style
                        ZENITH_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Header - Style', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_STYLE_TOGGLE,
                            'choices'   => array (
                                'split'                 => __( 'Angled & Split', 'zenith' ),
                                'parallax_vertical'     => __( 'Parallax - Vertical Scroll', 'zenith' ),
                                'parallax_layers'       => __( 'Parallax - Perspective Layers', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_HEIGHT_CALC => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Height Calculation', 'zenith' ),
                            'description'   => __( 'This allows you to choose between using % values or fixed pixel values for setting the header height', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_HEIGHT_CALC,
                            'choices'   => array (
                                'percent'   => __( 'Use % of browser height', 'zenith' ),
                                'fixed'     => __( 'Use a fixed pixel value', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (%)', 'zenith' ),
                            'description'   => __( 'Setting this to 100 will match the Header height to the browser window on both Desktop and Mobile devices.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT,
                            'min'           => 25,
                            'max'           => 100,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (%)', 'zenith' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT_MBL,
                            'max'           => 100,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_HEIGHT_PX => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (px)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX,
                            'min'           => 250,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_HEIGHT_PX_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (px)', 'zenith' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX_MBL,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_PLX_INTENSITY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Parallax Effect - Intensity', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_PLX_INTENSITY,
                            'choices'   => array (
                                'subtle'            => __( 'Subtle', 'zenith' ),
                                'default'           => __( 'Medium (Default)', 'zenith' ),
                                'high'              => __( 'High', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TEXTURE_IMG => array (
                            'type'          => 'image',
                            'label'         => __( 'Perspective Layers - Transparent Pattern', 'zenith' ),
                            'description'   => __( 'https://www.transparenttextures.com', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TEXTURE_IMG,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TEXTURE_OPAC => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Perspective Layers - Pattern (Opacity)', 'zenith' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TEXTURE_OPAC,
                        ),
                        
                    )

                ),
                
                // Section : Custom Header Locations ----------------------------
                'section_custom_header' => array (

                    'title' => __( 'Display Locations', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_POSTS => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Posts?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_POSTS,
                        ),
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_PAGES => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Pages?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_PAGES,
                        ),
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_FRONT => array (  
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Front Page?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_FRONT,
                        ),
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_BLOG => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Blog?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_BLOG,
                        ),
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_ARCHIVE => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Archive Pages?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_ARCHIVE,
                        ),
                        
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_ON_SHOP => array (   
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Shop Page?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_SHOP,
                        ),
                        
                    )

                ),

                // Section : Custom Header - Logo Settings ---------------------
                'section_custom_header_logo' => array (

                    'title' => __( 'Content', 'zenith' ),
                    'options' => array (

                        // Logo
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Site Logo?', 'zenith' ),
                            'description'   => __( 'If on, the Custom Logo for the site will be displayed', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_LOGO,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo (px)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height of Logo for Mobile (px)', 'zenith' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_LOGO_HEIGHT_MBL,
                        ),
                        
                        // Main Heading
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_TITLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Main Heading?', 'zenith' ),
                            'description'   => __( 'If on, the primary content heading will be displayed', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_TITLE
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_CONTENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'What to Display?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_CONTENT,
                            'choices'   => array (
                                'site_title'        => __( 'Site Title', 'zenith' ),
                                'site_description'  => __( 'Site Description', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_SIZE
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'zenith' ),
                                '-.075'     => __( '-.075em', 'zenith' ),
                                '-.050'     => __( '-.050em', 'zenith' ),
                                '-.025'     => __( '-.025em', 'zenith' ),
                                '0.0'       => __( '0.00em', 'zenith' ),
                                '.025'      => __( '.025em', 'zenith' ),
                                '.050'      => __( '.050em', 'zenith' ),
                                '.075'      => __( '.075em', 'zenith' ),
                                '.100'      => __( '.100em', 'zenith' ),
                                '.250'      => __( '.250em (Default)', 'zenith' ),
                                '.500'      => __( '.500em (Widest)', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'All Uppercase?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_ALL_CAPS
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_TITLE_COLOR
                        ),

                    )

                ),

                // Section : Custom Header - Menu Settings ---------------------
                'section_custom_header_menu' => array (

                    'title' => __( 'Custom Menu', 'zenith' ),
                    'options' => array (

                        // Menu
                        ZENITH_OPTIONS::CUSTOM_HEADER_SHOW_MENU => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Menu?', 'zenith' ),
                            'description'   => __( 'If on, the "Custom Header" menu will be displayed (if one is set)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_SHOW_MENU
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_FONT_SIZE
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Menu - Link Letter Spacing', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'zenith' ),
                                '-.075'     => __( '-.075em', 'zenith' ),
                                '-.050'     => __( '-.050em', 'zenith' ),
                                '-.025'     => __( '-.025em', 'zenith' ),
                                '0.0'       => __( '0.00em', 'zenith' ),
                                '.025'      => __( '.025em', 'zenith' ),
                                '.050'      => __( '.050em', 'zenith' ),
                                '.075'      => __( '.075em', 'zenith' ),
                                '.100'      => __( '.100em', 'zenith' ),
                                '.250'      => __( '.250em', 'zenith' ),
                                '.500'      => __( '.500em (Default/Widest)', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_COLOR
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Link Spacing', 'zenith' ),
                            'description'   => __( 'Amount of space in px between each link in the menu', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_LINKS_GAP
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_MENU_BUTTONS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style all Custom Header menu items as Buttons?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_MENU_BUTTONS
                        ),
                       
                    )

                ),

                // Section : Custom Header Style - Parallax Layers -------------
                'section_custom_header_plx_vertical' => array (

                    'title' => __( 'Color / Gradient Overlay', 'zenith' ),
                    'options' => array (

                        ZENITH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Include a colored overlay layer?', 'zenith' ),
                            'description'   => __( 'If "Yes", a semi-transparent colored layer will be added between the texture and content layers', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE,
                            'choices'   => array (
                                'no'        => __( 'No Color', 'zenith' ),
                                'single'    => __( 'Single Color', 'zenith' ),
                                'gradient'  => __( 'Gradient', 'zenith' ),
                            )
                        ),

                        // Overlay - Single Color
                        ZENITH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Color Overlay - Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_COLOR,
                        ),
                        ZENITH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Color Overlay - Color (Opacity)', 'zenith' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_OPACITY,
                        ),

                        // Overlay - Gradient
                        ZENITH_OPTIONS::GRADIENT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Gradient - Style', 'zenith' ),
                            'description'   => __( 'Choose from linear or radial', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_STYLE,
                            'choices'   => array (
                                'linear'    => __( 'Linear', 'zenith' ),
                                'radial'    => __( 'Radial', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::GRADIENT_OVERALL_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient - Layer Opacity', 'zenith' ),
                            'description'   => __( 'This option can be used to set transparency for the entire gradient. Set 0.0 for transparent, up to 1.0 for solid/opaque', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_OVERALL_OPACITY,
                        ),
                        ZENITH_OPTIONS::GRADIENT_LINEAR_DIRECTION => array (
                            'type'          => 'select',
                            'label'         => __( 'Linear Gradient - Direction', 'zenith' ),
                            'description'   => __( 'Set the linear gradient direction (Start to End)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_LINEAR_DIRECTION,
                            'choices'   => array (
                                'up'        => __( 'Up', 'zenith' ),
                                'down'      => __( 'Down', 'zenith' ),
                                'right'     => __( 'Right', 'zenith' ),
                                'left'      => __( 'Left', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::GRADIENT_START_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - Start Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_START_COLOR,
                        ),
                        ZENITH_OPTIONS::GRADIENT_START_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - Start Color (Opacity)', 'zenith' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_START_COLOR_OPACITY,
                        ),
                        ZENITH_OPTIONS::GRADIENT_END_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - End Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_END_COLOR,
                        ),
                        ZENITH_OPTIONS::GRADIENT_END_COLOR_OPACITY => array ( 
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - End Color (Opacity)', 'zenith' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::GRADIENT_END_COLOR_OPACITY,
                        ),
                        
                    )

                ),

            ), // End of Custom Header Sections

        ), // End of Custom Header Panel

        // Panel: Blog ---------------------------------------------------------
        'panel_blog' => array (

            'title'         => __( 'Blog', 'zenith' ),
            'desciption'    => __( 'Customize the blog and archive pages on your site', 'zenith' ),
            'sections'      => array (

                // Section : Blog General Settings ------------------------------
                'section_blog_general' => array (

                    'title' => __( 'General Settings', 'zenith' ),
                    'options' => array (

                        ZENITH_OPTIONS::BLOG_LAYOUT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Style', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_LAYOUT_STYLE,
                            'choices'   => array (
                                'blog_standard' => __( 'Standard', 'zenith' ),
                                'blog_masonry'  => __( 'Masonry - Cards', 'zenith' ),
                                'blog_mosaic'   => __( 'Mosaic - Grid', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::BLOG_SHOW_DATE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Date Posted?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_SHOW_DATE,
                        ),
                        ZENITH_OPTIONS::BLOG_SHOW_AUTHOR => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Author?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_SHOW_AUTHOR,
                        ),
                        ZENITH_OPTIONS::BLOG_SHOW_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Content / Excerpt?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_SHOW_CONTENT,
                        ),
                        ZENITH_OPTIONS::BLOG_SHOW_CATEGORY => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Category Footer?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_SHOW_CATEGORY,
                        ),
                        ZENITH_OPTIONS::BLOG_SHOW_COMMENT_COUNT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show the Comment Count in the Meta Stats tab?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_SHOW_COMMENT_COUNT,
                        ),
                        ZENITH_OPTIONS::BLOG_EXCERPT_TRIM_NUM => array (
                            'type'          => 'number',
                            'label'         => __( 'Automatic Excerpt - Trim by Number of Words', 'zenith' ),
                            'description'   => __( 'If no manual excerpt exists, a post will show this many words of preview content', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_EXCERPT_TRIM_NUM,
                        ),
                        ZENITH_OPTIONS::BLOG_READ_MORE_TEXT => array (
                            'type'          => 'text',
                            'label'         => __( 'Automatic Excerpt - "Read more" Link Text', 'zenith' ),
                            'description'   => __( 'This link only shows on posts with no manual excerpt, as a content preview will be used instead', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_READ_MORE_TEXT,
                        ),

                    )

                ),
                
                // Section : Blog Layout Settings ------------------------------
                'section_blog_advanced' => array (

                    'title' => __( 'Advanced Settings', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::BLOG_LAYOUT_NUM_COLS => array (
                            'type'          => 'select',
                            'label'         => __( 'Layout - Number of Columns', 'zenith' ),
                            'description'   => __( 'Mobile devices will automatically show fewer columns to maximize space.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_LAYOUT_NUM_COLS,
                            'choices'   => array (
                                '1col'      => __( 'Single Column', 'zenith' ),
                                '2col'      => __( 'Two Columns', 'zenith' ),
                                '3col'      => __( 'Three Columns', 'zenith' ),
                                '4col'      => __( 'Four Columns', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::BLOG_CARD_APPEARANCE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Card Appearance', 'zenith' ),
                            'description'   => __( 'Select whether the Standard style blog cards should appear flat, or as raised cards with a shadow.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_CARD_APPEARANCE,
                            'choices'   => array (
                                'flat'      => __( 'Flat', 'zenith' ),
                                'raised'    => __( 'Raised', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::BLOG_CARD_BORDER_RADIUS => array (
                            'type'          => 'number',
                            'label'         => __( 'Round Corners on Posts in the Blog?', 'zenith' ),
                            'description'   => __( 'Set this to 0 for sharp corners, or set the rounding value in pixels.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_CARD_BORDER_RADIUS,
                        ),
                        ZENITH_OPTIONS::BLOG_CARD_MOSAIC_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Space around each Mosaic tile?', 'zenith' ),
                            'description'   => __( 'This is the uncombined padding around each tile. For example, setting this to 5px per tile will equal a 10px wide gutter. Set to 0 for gapless tiles.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_CARD_MOSAIC_GAP,
                        ),
                        ZENITH_OPTIONS::BLOG_CARD_FONT_SIZE_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Desktop)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_CARD_FONT_SIZE_DSK,
                        ),
                        ZENITH_OPTIONS::BLOG_CARD_FONT_SIZE_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Mobile)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_CARD_FONT_SIZE_MBL,
                        ),
                        ZENITH_OPTIONS::BLOG_META_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Date & Author - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::BLOG_META_FONT_SIZE,
                        ),

                    )

                ),

            ), // End of Blog Sections

        ), // End of Blog Panel

        // Panel: Social -------------------------------------------------------
        null => array (

            'sections'       => array (

                'section_nav_social_links' => array (

                    'title' => __( 'Social Links', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::SOCIAL_URL_1 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #1 - URL', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_URL_1
                        ),
                        ZENITH_OPTIONS::SOCIAL_ICON_1 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #1 - Icon', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_ICON_1,
                            'choices'       => zenith_get_icons( 'social' )
                        ),
                        ZENITH_OPTIONS::SOCIAL_URL_2 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #2 - URL', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_URL_2
                        ),
                        ZENITH_OPTIONS::SOCIAL_ICON_2 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #2 - Icon', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_ICON_2,
                            'choices'       => zenith_get_icons( 'social' )
                        ),
                        ZENITH_OPTIONS::SOCIAL_URL_3 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #3 - URL', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_URL_3
                        ),
                        ZENITH_OPTIONS::SOCIAL_ICON_3 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #3 - Icon', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_ICON_3,
                            'choices'       => zenith_get_icons( 'social' )
                        ),
                        ZENITH_OPTIONS::SOCIAL_URL_4 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #4 - URL', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_URL_4
                        ),
                        ZENITH_OPTIONS::SOCIAL_ICON_4 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #4 - Icon', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_ICON_4,
                            'choices'       => zenith_get_icons( 'social' )
                        ),
                        ZENITH_OPTIONS::SOCIAL_URL_5 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #5 - URL', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_URL_5
                        ),
                        ZENITH_OPTIONS::SOCIAL_ICON_5 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #5 - Icon', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::SOCIAL_ICON_5,
                            'choices'       => zenith_get_icons( 'social' )
                        ),

                    )

                ),
                
            ), // End of Social Section
            
        ), // End of Social Panel

        // Panel: Navbar -------------------------------------------------------
        'panel_navbar' => array (

            'title'         => __( 'Navbar', 'zenith' ),
            'desciption'    => __( 'Customize the primary navbar on your site, including control over appearance & behaviour', 'zenith' ),
            'sections'      => array (

                // Section : Navbar General Settings ---------------------------
                'section_nav_general' => array (

                    'title' => __( 'General Settings', 'zenith' ),
                    'options' => array (

                        ZENITH_OPTIONS::NAVBAR_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Style', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_STYLE,
                            'choices'   => array (
                                'slim_split'    => __( 'Slim - Centered & Split', 'zenith' ),
                                'slim_left'     => __( 'Slim - Left Aligned', 'zenith' ),
                                'banner'        => __( 'Banner', 'zenith' ),
                                'vertical'      => __( 'Vertical', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_LINKS_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Links - Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LINKS_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_LINKS_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LINKS_FONT_SIZE
                        ),
                        ZENITH_OPTIONS::NAVBAR_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Gap Between Links', 'zenith' ),
                            'label'         => __( 'Set the pixel value for the amount of space between links', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_LINKS_GAP
                        ),
                        ZENITH_OPTIONS::NAVBAR_HAS_SHADOW => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Add a box shadow to the Navbar?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_HAS_SHADOW,
                        ),
                        ZENITH_OPTIONS::NAVBAR_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Social Links in Navbar?', 'zenith' ),
                            'description'   => __( 'If on, social links will display in the Navbar. Navbar styles display these in different ways', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SHOW_SOCIAL,
                        ),
                        ZENITH_OPTIONS::VERT_NAVBAR_DISPLAY_SETTING => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Vertical Navbar - Visibility', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::VERT_NAVBAR_DISPLAY_SETTING,
                            'choices'   => array (
                                'toggled'       => __( 'Openable (Hidden by Default)', 'zenith' ),
                                'always'        => __( 'Always Visible', 'zenith' ),
                            )
                        ),
                        
                    )

                ),

                // Section : Slim Style Settings ---------------------------
                'section_nav_style_a' => array (

                    'title' => __( 'Advanced Settings', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::NAVBAR_INITIAL_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Initial)', 'zenith' ),
                            'description'   => __( 'When the Slim Navbar is at the very top of the page (unstuck)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_INITIAL_HEIGHT
                        ),
                        ZENITH_OPTIONS::NAVBAR_STICKY_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Sticky)', 'zenith' ),
                            'description'   => __( 'When the Slim Navbar is sticky, after the user scrolls down the page', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_STICKY_HEIGHT
                        ),
                        ZENITH_OPTIONS::NAVBAR_RIGHT_ALIGN_MENU => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Right Aligned Menu?', 'zenith' ),
                            'description'   => __( 'If on, the menu will be right-aligned. For the "Slim - Left Aligned" style of Navbar, the menu will replace the Social Links section', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_RIGHT_ALIGN_MENU,
                        ),
                        ZENITH_OPTIONS::NAVBAR_BOXED_CONTENT => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Box the Content?', 'zenith' ),
                            'description'   => __( 'If on, the Navbar content will be lined up with the main content of the page instead of the left & right bounds of the window', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BOXED_CONTENT,
                        ),
                        ZENITH_OPTIONS::NAVBAR_TRANSPARENT_MENU_BG => array ( 
                            'type'          => 'toggle',
                            'label'         => __( 'Transparent Menu?', 'zenith' ),
                            'description'   => __( 'If on, the menu will be transparent, allowing the Navbar background (color or image) to show through', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_TRANSPARENT_MENU_BG,
                        ),
                        ZENITH_OPTIONS::NAVBAR_BRANDING_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - Alignment', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'zenith' ),
                                'center'    => __( 'Centered', 'zenith' ),
                                'right'     => __( 'Right', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_MENU_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Menu - Alignment', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_MENU_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'zenith' ),
                                'center'    => __( 'Centered', 'zenith' ),
                                'right'     => __( 'Right', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above', 'zenith' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding (for the Banner style of Navbar)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_DSK
                        ),
                        ZENITH_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below', 'zenith' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding (for the Banner style of Navbar)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK
                        ),
                        ZENITH_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above (Mobile)', 'zenith' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding on mobile devices (for the Banner style of Navbar)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_MBL
                        ),
                        ZENITH_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below (Mobile)', 'zenith' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding on mobile devices (for the Banner style of Navbar)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL
                        ),
                        ZENITH_OPTIONS::NAVBAR_FINAL_LINK_ACCENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style final Navbar link as a CTA?', 'zenith' ),
                            'description'   => __( 'When toggled on, the last (right-most) link in the Navbar will appear as a unique button callout', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_FINAL_LINK_ACCENT
                        ),
                        ZENITH_OPTIONS::NAVBAR_FINAL_LINK_ROUNDED => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Rounded button?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_FINAL_LINK_ROUNDED
                        ),
                        ZENITH_OPTIONS::NAVBAR_FINAL_LINK_FILL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Color fill?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_FINAL_LINK_FILL
                        ),

                    )

                ),

                // Section : Navbar Colors -------------------------------------
                'section_nav_colors' => array (

                    'title' => __( 'Colors', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::NAVBAR_BG_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Background Style', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BG_STYLE,
                            'choices'   => array (
                                'color'     => __( 'Color', 'zenith' ),
                                'image'     => __( 'Background Image', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Background Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Foreground Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_MENU_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Background Color', 'zenith' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the background color for the menu bar', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_MENU_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_MENU_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Foreground Color', 'zenith' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the foreground color for the menu bar', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_MENU_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::NAVBAR_BG_IMAGE => array (
                            'type'          => 'image',
                            'label'         => __( 'Background Image', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_BG_IMAGE,
                        ),
                        ZENITH_OPTIONS::NAVBAR_SOCIAL_BG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Drawer Background', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SOCIAL_BG_COLOR,
                        ),
                        ZENITH_OPTIONS::NAVBAR_SOCIAL_FG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR,
                        ),
                        ZENITH_OPTIONS::NAVBAR_SOCIAL_FG_COLOR_HOVER => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons (Hover)', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR_HOVER,
                        ),
                        ZENITH_OPTIONS::VERT_NAVBAR_TAB_BACKGROUND => array (
                            'type'          => 'color',
                            'label'         => __( 'Vertical Navbar Tab - Background Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::VERT_NAVBAR_TAB_BACKGROUND,
                        ),
                        ZENITH_OPTIONS::VERT_NAVBAR_TAB_FOREGROUND => array (
                            'type'          => 'color',
                            'label'         => __( 'Vertical Navbar Tab - Foreground Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::VERT_NAVBAR_TAB_FOREGROUND,
                        ),

                    )

                ),

            ), // End of Navbar Sections

        ), // End of Navbar Panel

        // Panel: Appearance ---------------------------------------------------
        'panel_appearance' => array (

            'title'         => __( 'Appearance', 'zenith' ),
            'description'   => __( 'Customize your site colors, fonts, and more', 'zenith' ),
            'sections'      => array (

                // Section : Colors --------------------------------------------
                'section_colors' => array (

                    'title'         => __( 'Skin Colors', 'zenith' ),
                    'description'   => __( 'Customize the color theme in use on your site', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::COLOR_SKIN_PRIMARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Primary', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::COLOR_SKIN_PRIMARY,
                            'choices'   => array(
                                '#f04265'       => __( 'Cherry Gloss', 'zenith' ),
                                '#13ecb6'       => __( 'Seafoam Coast', 'zenith' ),
                                '#7f66ff'       => __( 'Royal Lilac', 'zenith' ),
                                '#00d4ff'       => __( 'Sky Blue', 'zenith' ),
                            ),
                        ),
                        ZENITH_OPTIONS::COLOR_SKIN_SECONDARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Secondary', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::COLOR_SKIN_SECONDARY,
                            'choices'   => array(
                                '#d60059'       => __( 'Magenta Rose', 'zenith' ),
                                '#04aeae'       => __( 'Tide Pool', 'zenith' ),
                                '#6e3399'       => __( 'Wildberry', 'zenith' ),
                                '#0b84da'       => __( 'Ocean Swell', 'zenith' ),
                            ),
                        ),

                    ),

                ),

                // Section : Fonts ---------------------------------------------
                'fonts' => array (

                    'title'         => __( 'Fonts', 'zenith' ),
                    'description'   => __( 'Customize the fonts in use on your site. Visit <a target="_BLANK" href="https://fonts.google.com/"> Google Fonts to see font options.</a> Please be advised some fonts on this link may not be present in the theme, as Google Fonts are constantly updated. We periodically update the font list here from Google Fonts.', 'zenith' ),
                    'options' => array (
                        
                        // Primary Font
                        ZENITH_OPTIONS::FONT_PRIMARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Primary Font - For Headings & Titles', 'zenith' ),
                            'default'   => ZENITH_DEFAULTS::FONT_PRIMARY,
                            'choices'   => zenith_fonts(),
                        ),
                        ZENITH_OPTIONS::FONT_HEADINGS_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing for Headings & Titles', 'zenith' ),
                            'description'   => __( 'Set to 0 for normal spacing, negative for smaller gap between letters, positive for increased separation.', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FONT_HEADINGS_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'zenith' ),
                                '-.075'     => __( '-.075em', 'zenith' ),
                                '-.050'     => __( '-.050em', 'zenith' ),
                                '-.025'     => __( '-.025em', 'zenith' ),
                                '0.0'         => __( '0.00em (Default)', 'zenith' ),
                                '.025'      => __( '.025em', 'zenith' ),
                                '.050'      => __( '.050em', 'zenith' ),
                                '.075'      => __( '.075em', 'zenith' ),
                                '.100'      => __( '.100em (Widest)', 'zenith' ),
                            )
                        ),

                        // Secondary Font
                        ZENITH_OPTIONS::FONT_SECONDARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Secondary Font - For Content', 'zenith' ),
                            'default'   => ZENITH_DEFAULTS::FONT_SECONDARY,
                            'choices'   => zenith_fonts(),
                        ),
                        ZENITH_OPTIONS::FONT_BODY_SIZE => array(
                            'type'      => 'number',
                            'label'     => __( 'Secondary Font - Text Size (px)', 'zenith' ),
                            'default'   => ZENITH_DEFAULTS::FONT_BODY_SIZE,
                        ),

                    ),

                ),
                
                // Section : Smooth Scrolling ----------------------------------
                'section_scroll' => array (

                    'title'         => __( 'Smooth Scrolling', 'zenith' ),
                    'description'   => __( 'Customize whether the Smooth Scrolling feature is enabled on your site', 'zenith' ),
                    'options' => array (
                        
                        ZENITH_OPTIONS::EASE_SCROLL_TOGGLE => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Enable Smooth Scrolling?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::EASE_SCROLL_TOGGLE,
                        ),

                    ),

                ),

            ), // End of Appearance Sections

        ), // End of Appearance Panel

        // Panel: Footer -------------------------------------------------------
        'panel_footer' => array (

            'title'         => __( 'Footer', 'zenith' ),
            'desciption'    => __( 'Customize the theme footer', 'zenith' ),
            'sections'      => array (

                // Section : Pre-Footer Widget Area Settings  ------------------
                'section_pre_footer' => array (

                    'title'     => __( 'Pre-Footer Sidebar', 'zenith' ),
                    'options'   => array (
                        
                        ZENITH_OPTIONS::FOOTER_NUM_WIDGET_COLS => array (
                            'type'          => 'range',
                            'label'         => __( 'Number of Widget Columns' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_NUM_WIDGET_COLS,
                            'min'           => 1,
                            'max'           => 4,
                            'step'          => 1
                        ),
                        ZENITH_OPTIONS::WIDGETS_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Widget Titles - Font Family', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WIDGETS_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'zenith' ),
                                'secondary' => __( 'Use Secondary Font', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::WIDGETS_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Widget Titles - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WIDGETS_TITLE_FONT_SIZE,
                        ),
                        ZENITH_OPTIONS::WIDGETS_TITLE_FONT_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Widget Titles - Letter Spacing', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WIDGETS_TITLE_FONT_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'zenith' ),
                                '-.075'     => __( '-.075em', 'zenith' ),
                                '-.050'     => __( '-.050em', 'zenith' ),
                                '-.025'     => __( '-.025em', 'zenith' ),
                                '0.0'       => __( '0.00em', 'zenith' ),
                                '.025'      => __( '.025em', 'zenith' ),
                                '.050'      => __( '.050em', 'zenith' ),
                                '.075'      => __( '.075em', 'zenith' ),
                                '.100'      => __( '.100em', 'zenith' ),
                                '.250'      => __( '.250em (Default)', 'zenith' ),
                                '.500'      => __( '.500em (Widest)', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::WIDGETS_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Widget Titles - All Uppercase?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WIDGETS_TITLE_ALL_CAPS,
                        ),
                        ZENITH_OPTIONS::FOOTER_BORDER_TOP_THICKNESS => array (
                            'type'          => 'number',
                            'label'         => __( 'Colored Top Border - Thickness', 'zenith' ),
                            'description'   => __( 'If set to a value greater than 0, the Prefooter will include a primary color top border of this many pixels', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_BORDER_TOP_THICKNESS,
                        ),
                        
                    )
                    
                ),
                        
                // Section : Footer General Settings  --------------------------
                'section_footer_general' => array (

                    'title'     => __( 'General Settings', 'zenith' ),
                    'options'   => array (

                        ZENITH_OPTIONS::FOOTER_BOXED_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Boxed Content?', 'zenith' ),
                            'description'   => __( 'If on, the Footer will be lined up with the main content instead of the left & right bounds of the window', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_BOXED_CONTENT,
                        ),
                        ZENITH_OPTIONS::FOOTER_CENTER_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Centered?', 'zenith' ),
                            'description'   => __( 'If on, the Footer content will be centered', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_CENTER_BRANDING,
                        ),
                        ZENITH_OPTIONS::FOOTER_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Social?', 'zenith' ),
                            'description'   => __( 'If on, the Footer will include the social icon links you have set', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_SHOW_SOCIAL,
                        ),
                        ZENITH_OPTIONS::FOOTER_SHOW_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Branding?', 'zenith' ),
                            'description'   => __( 'If on,  the Footer will include either an alternate custom logo or your site title', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_SHOW_BRANDING,
                        ),
                        ZENITH_OPTIONS::FOOTER_SHOW_COPYRIGHT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Copyright?', 'zenith' ),
                            'description'   => __( 'If on, the Footer will include the copyright tagline you set', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_SHOW_COPYRIGHT,
                        ),
                        ZENITH_OPTIONS::FOOTER_COPYRIGHT_TAGLINE => array (
                            'type'          => 'text',
                            'label'         => __( 'Copyright - Tagline Text', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE,
                        ),
                        ZENITH_OPTIONS::FOOTER_BRANDING_TYPE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - What to Display?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_BRANDING_TYPE,
                            'choices'   => array (
                                'site_title'    => __( 'Show Site Title', 'zenith' ),
                                'alt_logo'      => __( 'Show Logo', 'zenith' ),
                            )
                        ),
                        ZENITH_OPTIONS::FOOTER_ALTERNATE_LOGO => array (
                            'type'          => 'image',
                            'label'         => __( 'Branding - Logo', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_ALTERNATE_LOGO,
                        ),
                        ZENITH_OPTIONS::FOOTER_ALTERNATE_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Logo Height', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_ALTERNATE_LOGO_HEIGHT,
                        ),
                        ZENITH_OPTIONS::FOOTER_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_SITE_TITLE_FONT_SIZE
                        ),
                        ZENITH_OPTIONS::FOOTER_SITE_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Branding - All Uppercase?', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_SITE_TITLE_ALL_CAPS
                        ),
                        ZENITH_OPTIONS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Copyright - Font Size', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE
                        ),

                    )

                ),

                // Section : Footer Colors -------------------------------------
                'section_footer_colors' => array (

                    'title'     => __( 'Colors', 'zenith' ),
                    'options'   => array (
                        
                        // Pre-Footer Background
                        ZENITH_OPTIONS::PRE_FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Background Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::PRE_FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),

                        // Pre-Footer Foreground
                        ZENITH_OPTIONS::PRE_FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Foreground Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::PRE_FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),
                        
                        // Pre-Footer Widget Titles
                        ZENITH_OPTIONS::PRE_FOOTER_WIDGET_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Prefooter: Widgets Title Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::PRE_FOOTER_WIDGET_TITLE_COLOR,
                        ),
                        
                        // Footer Background
                        ZENITH_OPTIONS::FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Background Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#000000'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),

                        // Footer Foreground
                        ZENITH_OPTIONS::FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Foreground Color', 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'zenith' ),
                                '#ffffff'    => __( 'Light', 'zenith' ),
                            )
                        ),

                    )

                ),

            ), // End of Footer Sections

        ), // End of Footer Panel

        // Panel: WooCommerce --------------------------------------------------
        'woocommerce' => array (

            'title'         => __( 'WooCommerce', 'zenith' ),
            'sections'      => array (

                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_featured' => array (

                    'title'     => __( 'Featured Products', 'zenith' ),
                    'options'   => array (
                        
                        ZENITH_OPTIONS::WOO_SHOW_FEATURED_PRODUCTS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Featured Products at the top of the Shop page?' , 'zenith' ),
                            'description'   => __( 'To feature a product, click the corresponding star icon on the Products page.' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_SHOW_FEATURED_PRODUCTS,
                        ),
                        ZENITH_OPTIONS::WOO_SHOW_FEATURED_PRODUCT_HEADING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show "Featured" Header Banner?' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_SHOW_FEATURED_PRODUCT_HEADING,
                        ),
                        ZENITH_OPTIONS::WOO_FEATURED_PRODUCTS_NUM_COLS => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Featured Products Per Row' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_FEATURED_PRODUCTS_NUM_COLS,
                            'choices'       => array (
                                'two'   => __( 'Two', 'zenith' ),
                                'three' => __( 'Three', 'zenith' ),
                            )
                        ),
                        
                    )
                    
                ),
                
                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_slide_cart' => array (

                    'title'     => __( 'Slide-In Cart', 'zenith' ),
                    'options'   => array (
                        
                        ZENITH_OPTIONS::WOO_SLIDE_CART_TOGGLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include the Slide-In Cart Drawer?' , 'zenith' ),
                            'description'   => __( 'If this is on, users can click a tab on the right side of the page to open a drawer displaying the items currently added to their cart.' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_SLIDE_CART_TOGGLE,
                        ),
                        ZENITH_OPTIONS::WOO_SLIDE_CART_TAB_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Tab: Color' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_SLIDE_CART_TAB_COLOR,
                        ),
                        ZENITH_OPTIONS::WOO_SLIDE_CART_TAB_ICON => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Tab: Icon' , 'zenith' ),
                            'default'       => ZENITH_DEFAULTS::WOO_SLIDE_CART_TAB_ICON,
                            'choices'       => array (
                                'fa-shopping-cart'      =>  __( 'Cart', 'zenith' ),
                                'fa-shopping-bag'       =>  __( 'Bag', 'zenith' ),
                                'fa-shopping-basket'    =>  __( 'Basket', 'zenith' ),
                            )
                        ),
                        
                    )
                    
                ),
                
            ), // End of Footer Sections

        ), // End of WooCommerce Panel
       
    ), // End of Panels

);

$acid->config( $data );
