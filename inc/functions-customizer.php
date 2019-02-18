<?php

/**
 * Beyrouth Theme Customizer
 *
 * @package Beyrouth
 */
include_once beyrouth\get_plugin_path( '/inc/lib/Acid/acid.php' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beyrouth_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


    // Housekeeping ------------------------------------------------------------
    $wp_customize->get_section( 'header_image' )->panel = 'panel_custom_header';
    $wp_customize->get_section( 'title_tagline' )->title = __( 'General Settings', 'beyrouth' );
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
            'render_callback' => 'beyrouth_customize_partial_blogname',
        ) );

        $wp_customize->selective_refresh->add_partial( 'blogdescription', array (
            'selector' => '.site-description',
            'render_callback' => 'beyrouth_customize_partial_blogdescription',
        ) );

        $wp_customize->selective_refresh->add_partial( BEYROUTH_OPTIONS::NAVBAR_SHOW_SOCIAL, array(
            'selector'  => '.navbar-social'
        ) );

        $wp_customize->selective_refresh->add_partial( BEYROUTH_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE, array(
            'selector'  => '#custom-header-content'
        ) );

        $wp_customize->selective_refresh->add_partial( BEYROUTH_OPTIONS::BLOG_SHOW_DATE, array(
            'selector'  => '.masonry_card_blog .post-date'
        ) );

        $wp_customize->selective_refresh->add_partial( BEYROUTH_OPTIONS::BLOG_CARD_FONT_SIZE_DSK, array(
            'selector'  => '.masonry_card_blog .entry-title'
        ) );

        $wp_customize->selective_refresh->add_partial( BEYROUTH_OPTIONS::BLOG_SHOW_COMMENT_COUNT, array(
            'selector'  => '.masonry_card_blog .meta-stats'
        ) );

    }
    // End Selective Refresh ---------------------------------------------------
}

add_action( 'customize_register', 'beyrouth_customize_register', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function beyrouth_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function beyrouth_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zenith_customize_preview_js() {
    wp_enqueue_style( 'zenith-customizer-preview-style', beyrouth\get_plugin_url( '/assets/admin/customizer-preview.css' ), BEYROUTH_VERSION, null );
    wp_enqueue_script( 'zenith-customizer-preview-script', beyrouth\get_plugin_url( '/assets/admin/customizer-preview.js' ), array ( 'jquery', 'customize-preview' ), BEYROUTH_VERSION, true );
}
add_action( 'customize_preview_init', 'zenith_customize_preview_js' );
function zenith_customize_controls_js() {
    wp_enqueue_script( 'zenith-customizer-control', beyrouth\get_plugin_url( '/assets/admin/customizer-control.js' ), array ( 'jquery', 'customize-controls' ), BEYROUTH_VERSION, true );
    wp_enqueue_style( 'zenith-customizer-style', beyrouth\get_plugin_url( '/assets/admin/customizer-alt.css' ), BEYROUTH_VERSION, null );
}
add_action( 'customize_controls_enqueue_scripts', 'zenith_customize_controls_js' );


$acid = acid_instance( get_template_directory_uri() . '/inc/lib/' );

$data = array (

    'sections'  => array(

        'static_front_page'  => array(

            'title'         => __( 'Homepage Settings', 'beyrouth' ),
            'desciption'    => __( 'You can choose what\'s displayed on the homepage of your site. It can be posts in reverse chronological order (classic blog), or a fixed/static page. To set a static homepage, you first need to create two Pages. One will become the homepage, and the other will be where your posts are displayed.', 'beyrouth' ),
            'options'       => array(

                BEYROUTH_OPTIONS::HOMEPAGE_SHOW_CONTENT => array (
                    'type'          => 'toggle',
                    'label'         => __( 'Show the Frontpage Content?', 'beyrouth' ),
                    'description'   => __( 'While this is on, the content of the page set as the static Homepage will be visible', 'beyrouth' ),
                    'default'       => BEYROUTH_DEFAULTS::HOMEPAGE_SHOW_CONTENT,
                ),

            ),

        ),

    ),

    'panels' => array (

        // Panel: Site Title & Logo --------------------------------------------
        'panel_title_tagline' => array (

            'title'         => __( 'Site Title & Logo', 'beyrouth' ),
            'sections'      => array (

                // Section : Site Title & Logo: Advanced -----------------------
                'section_title_tagline' => array (

                    'title' => __( 'Advanced Settings', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::NAVBAR_ALWAYS_SHOW_LOGO => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Logo - Always Visible?', 'beyrouth' ),
                            'description'   => __( 'If on, the logo will be visible even when Slim Navbar is collapsed / unstuck', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_ALWAYS_SHOW_LOGO,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LOGO_HORIZONTAL_PADDING => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Horizontal Padding', 'beyrouth' ),
                            'description'   => __( 'Set the space (in pixels) between menu links and the logo', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LOGO_HORIZONTAL_PADDING
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LOGO_HEIGHT_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Desktop)', 'beyrouth' ),
                            'description'   => __( 'Set the logo height for the desktop Navbar', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LOGO_HEIGHT_DSK
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LOGO_HEIGHT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Logo - Height (Mobile)', 'beyrouth' ),
                            'description'   => __( 'Set the logo height for the mobile Navbar', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LOGO_HEIGHT_MBL
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SITE_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Title - Font Family', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SITE_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'beyrouth' ),
                                'secondary' => __( 'Use Secondary Font', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Title - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SITE_TITLE_FONT_SIZE
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SITE_TITLE_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Site Title - Letter Spacing', 'beyrouth' ),
                            'description'   => __( 'Set the scaling "em" value. Can be positive or negative. 0 for normal spacing.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SITE_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'beyrouth' ),
                                '-.075'     => __( '-.075em', 'beyrouth' ),
                                '-.050'     => __( '-.050em', 'beyrouth' ),
                                '-.025'     => __( '-.025em', 'beyrouth' ),
                                '0.0'       => __( '0.00em (Default)', 'beyrouth' ),
                                '.025'      => __( '.025em', 'beyrouth' ),
                                '.050'      => __( '.050em', 'beyrouth' ),
                                '.075'      => __( '.075em', 'beyrouth' ),
                                '.100'      => __( '.100em', 'beyrouth' ),
                                '.250'      => __( '.250em', 'beyrouth' ),
                                '.500'      => __( '.500em (Widest)', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SITE_TITLE_ALL_CAPS => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Site Title - All Uppercase?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SITE_TITLE_ALL_CAPS
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_HIDE_TAGLINE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Hide Site Tagline?', 'beyrouth' ),
                            'description'   => __( 'Both the Title & Tagline show by default when no logo is chosen', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_HIDE_TAGLINE,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_TAGLINE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Site Tagline - Font Family', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_TAGLINE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'beyrouth' ),
                                'secondary' => __( 'Use Secondary Font', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Site Tagline - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_TAGLINE_FONT_SIZE
                        ),

                    )

                ),

            ), // End of Site Identity

        ), // End of Site Identity Panel


        // Panel: Custom Header ------------------------------------------------
        'panel_custom_header' => array (

            'title'         => __( 'Header', 'beyrouth' ),
            'desciption'    => __( 'Customize the header banner on your site', 'beyrouth' ),
            'sections'      => array (

                // Section : Custom Header Settings ----------------------------
                'section_custom_header_general' => array (

                    'title' => __( 'General Settings', 'beyrouth' ),
                    'options' => array (
                        // Style
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_STYLE_TOGGLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Header - Style', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_STYLE_TOGGLE,
                            'choices'   => array (
//                                'social'                => __( 'Parallax - Social', 'beyrouth' ),
                                'parallax_vertical'     => __( 'Parallax - Vertical Scroll', 'beyrouth' ),
//                                'parallax_layers'       => __( 'Parallax - Perspective Layers', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_HEIGHT_CALC => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Height Calculation', 'beyrouth' ),
                            'description'   => __( 'This allows you to choose between using % values or fixed pixel values for setting the header height', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_HEIGHT_CALC,
                            'choices'   => array (
                                'percent'   => __( 'Use % of browser height', 'beyrouth' ),
                                'fixed'     => __( 'Use a fixed pixel value', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (%)', 'beyrouth' ),
                            'description'   => __( 'Setting this to 100 will match the Header height to the browser window on both Desktop and Mobile devices.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT,
                            'min'           => 25,
                            'max'           => 100,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_HEIGHT_PCT_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (%)', 'beyrouth' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PCT_MBL,
                            'max'           => 100,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_HEIGHT_PX => array (
                            'type'          => 'number',
                            'label'         => __( 'Height (px)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX,
                            'min'           => 250,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_HEIGHT_PX_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Height for Mobile (px)', 'beyrouth' ),
                            'description'   => __( 'When viewed on screens less than 992px wide', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_HEIGHT_PX_MBL,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_PLX_INTENSITY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Parallax Effect - Intensity', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_PLX_INTENSITY,
                            'choices'   => array (
                                'subtle'            => __( 'Subtle', 'beyrouth' ),
                                'default'           => __( 'Medium (Default)', 'beyrouth' ),
                                'high'              => __( 'High', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TEXTURE_IMG => array (
                            'type'          => 'image',
                            'label'         => __( 'Perspective Layers - Transparent Pattern', 'beyrouth' ),
                            'description'   => __( 'https://www.transparenttextures.com', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TEXTURE_IMG,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TEXTURE_OPAC => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Perspective Layers - Pattern (Opacity)', 'beyrouth' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TEXTURE_OPAC,
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_HEADER_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Parallax Social - Content Alignment', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_HEADER_ALIGNMENT,
                            'choices'   => array (
                                'flex-start'        => __( 'Left Side', 'beyrouth' ),
                                'center'            => __( 'Centered', 'beyrouth' ),
                                'flex-end'          => __( 'Right Side', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_HEADER_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Parallax Social - Show Social Icons?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_HEADER_SHOW_SOCIAL,
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_HEADER_SHOW_SCROLL_TAB => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Parallax Social - Show Scroll Tab?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_HEADER_SHOW_SCROLL_TAB,
                        ),

                    )

                ),

                // Section : Custom Header Locations ----------------------------
                'section_custom_header' => array (

                    'title' => __( 'Display Locations', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_POSTS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Posts?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_POSTS,
                        ),

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_PAGES => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Pages?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_PAGES,
                        ),

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_FRONT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Front Page?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_FRONT,
                        ),

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_BLOG => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Blog?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_BLOG,
                        ),

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_ARCHIVE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on Archive Pages?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_ARCHIVE,
                        ),

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_ON_SHOP => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include on the Shop Page?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_ON_SHOP,
                        ),

                    )

                ),

                // Section : Custom Header - Logo Settings ---------------------
                'section_custom_header_logo' => array (

                    'title' => __( 'Content', 'beyrouth' ),
                    'options' => array (

                        // Main Heading
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_TITLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Main Heading?', 'beyrouth' ),
                            'description'   => __( 'If on, the primary content heading will be displayed', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_TITLE
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_CONTENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'What to Display?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_CONTENT,
                            'choices'   => array (
                                'site_title'        => __( 'Site Title', 'beyrouth' ),
                                'site_description'  => __( 'Site Description', 'beyrouth' ),
                                'both'              => __( 'Title & Description', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'beyrouth' ),
                                'secondary' => __( 'Use Secondary Font', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_FONT_SIZE
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'beyrouth' ),
                                '-.075'     => __( '-.075em', 'beyrouth' ),
                                '-.050'     => __( '-.050em', 'beyrouth' ),
                                '-.025'     => __( '-.025em', 'beyrouth' ),
                                '0.0'       => __( '0.00em', 'beyrouth' ),
                                '.025'      => __( '.025em', 'beyrouth' ),
                                '.050'      => __( '.050em', 'beyrouth' ),
                                '.075'      => __( '.075em', 'beyrouth' ),
                                '.100'      => __( '.100em', 'beyrouth' ),
                                '.250'      => __( '.250em (Default)', 'beyrouth' ),
                                '.500'      => __( '.500em (Widest)', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'All Uppercase?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_ALL_CAPS
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_TITLE_COLOR
                        ),

                    )

                ),

                // Section : Custom Header - Menu Settings ---------------------
                'section_custom_header_menu' => array (

                    'title' => __( 'Custom Menu', 'beyrouth' ),
                    'options' => array (

                        // Menu
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_SHOW_MENU => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Display the Menu?', 'beyrouth' ),
                            'description'   => __( 'If on, the "Custom Header" menu will be displayed (if one is set)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_SHOW_MENU
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Font Family', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'beyrouth' ),
                                'secondary' => __( 'Use Secondary Font', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_FONT_SIZE
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_LETTER_GAP => array (
                            'type'          => 'select',
                            'label'         => __( 'Menu - Link Letter Spacing', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'beyrouth' ),
                                '-.075'     => __( '-.075em', 'beyrouth' ),
                                '-.050'     => __( '-.050em', 'beyrouth' ),
                                '-.025'     => __( '-.025em', 'beyrouth' ),
                                '0.0'       => __( '0.00em', 'beyrouth' ),
                                '.025'      => __( '.025em', 'beyrouth' ),
                                '.050'      => __( '.050em', 'beyrouth' ),
                                '.075'      => __( '.075em', 'beyrouth' ),
                                '.100'      => __( '.100em', 'beyrouth' ),
                                '.250'      => __( '.250em', 'beyrouth' ),
                                '.500'      => __( '.500em (Default/Widest)', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Text Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_COLOR
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Link Spacing', 'beyrouth' ),
                            'description'   => __( 'Amount of space in px between each link in the menu', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_LINKS_GAP
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_MENU_BUTTONS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style all Custom Header menu items as Buttons?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_MENU_BUTTONS
                        ),

                    )

                ),

                // Section : Custom Header Style - Parallax Layers -------------
                'section_custom_header_plx_vertical' => array (

                    'title' => __( 'Color / Gradient Overlay', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Include a colored overlay layer?', 'beyrouth' ),
                            'description'   => __( 'If "Yes", a semi-transparent colored layer will be added between the texture and content layers', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_STYLE,
                            'choices'   => array (
                                'no'        => __( 'No Color', 'beyrouth' ),
                                'single'    => __( 'Single Color', 'beyrouth' ),
                                'gradient'  => __( 'Gradient', 'beyrouth' ),
                            )
                        ),

                        // Overlay - Single Color
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Color Overlay - Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_COLOR,
                        ),
                        BEYROUTH_OPTIONS::CUSTOM_HEADER_COLOR_LAYER_OPACITY => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Color Overlay - Color (Opacity)', 'beyrouth' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::CUSTOM_HEADER_COLOR_LAYER_OPACITY,
                        ),

                        // Overlay - Gradient
                        BEYROUTH_OPTIONS::GRADIENT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Gradient - Style', 'beyrouth' ),
                            'description'   => __( 'Choose from linear or radial', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_STYLE,
                            'choices'   => array (
                                'linear'    => __( 'Linear', 'beyrouth' ),
                                'radial'    => __( 'Radial', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_OVERALL_OPACITY => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient - Layer Opacity', 'beyrouth' ),
                            'description'   => __( 'This option can be used to set transparency for the entire gradient. Set 0.0 for transparent, up to 1.0 for solid/opaque', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_OVERALL_OPACITY,
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_LINEAR_DIRECTION => array (
                            'type'          => 'select',
                            'label'         => __( 'Linear Gradient - Direction', 'beyrouth' ),
                            'description'   => __( 'Set the linear gradient direction (Start to End)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_LINEAR_DIRECTION,
                            'choices'   => array (
                                'up'        => __( 'Up', 'beyrouth' ),
                                'down'      => __( 'Down', 'beyrouth' ),
                                'right'     => __( 'Right', 'beyrouth' ),
                                'left'      => __( 'Left', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_START_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - Start Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_START_COLOR,
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_START_COLOR_OPACITY => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - Start Color (Opacity)', 'beyrouth' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_START_COLOR_OPACITY,
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_END_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Gradient Overlay - End Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_END_COLOR,
                        ),
                        BEYROUTH_OPTIONS::GRADIENT_END_COLOR_OPACITY => array (
                            'type'          => 'decimal',
                            'label'         => __( 'Gradient Overlay - End Color (Opacity)', 'beyrouth' ),
                            'description'   => __( '0.0 for transparent, up to 1.0 for solid/opaque', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::GRADIENT_END_COLOR_OPACITY,
                        ),

                    )

                ),

            ), // End of Custom Header Sections

        ), // End of Custom Header Panel

        // Panel: Blog ---------------------------------------------------------
        'panel_blog' => array (

            'title'         => __( 'Blog', 'beyrouth' ),
            'desciption'    => __( 'Customize the blog and archive pages on your site', 'beyrouth' ),
            'sections'      => array (

                // Section : Blog General Settings ------------------------------
                'section_blog_general' => array (

                    'title' => __( 'General Settings', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::BLOG_LAYOUT_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Style', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_LAYOUT_STYLE,
                            'choices'   => array (
                                'blog_standard' => __( 'Standard', 'beyrouth' ),
                                'blog_masonry'  => __( 'Masonry - Cards', 'beyrouth' ),
                                'blog_mosaic'   => __( 'Mosaic - Grid', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::BLOG_SHOW_DATE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Date Posted?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_SHOW_DATE,
                        ),
                        BEYROUTH_OPTIONS::BLOG_SHOW_AUTHOR => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Author?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_SHOW_AUTHOR,
                        ),
                        BEYROUTH_OPTIONS::BLOG_SHOW_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Content / Excerpt?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_SHOW_CONTENT,
                        ),
                        BEYROUTH_OPTIONS::BLOG_SHOW_CATEGORY => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Category Footer?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_SHOW_CATEGORY,
                        ),
                        BEYROUTH_OPTIONS::BLOG_SHOW_COMMENT_COUNT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show the Comment Count in the Meta Stats tab?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_SHOW_COMMENT_COUNT,
                        ),
                        BEYROUTH_OPTIONS::BLOG_EXCERPT_TRIM_NUM => array (
                            'type'          => 'number',
                            'label'         => __( 'Automatic Excerpt - Trim by Number of Words', 'beyrouth' ),
                            'description'   => __( 'If no manual excerpt exists, a post will show this many words of preview content', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_EXCERPT_TRIM_NUM,
                        ),
                        BEYROUTH_OPTIONS::BLOG_READ_MORE_TEXT => array (
                            'type'          => 'text',
                            'label'         => __( 'Automatic Excerpt - "Read more" Link Text', 'beyrouth' ),
                            'description'   => __( 'This link only shows on posts with no manual excerpt, as a content preview will be used instead', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_READ_MORE_TEXT,
                        ),

                    )

                ),

                // Section : Blog Layout Settings ------------------------------
                'section_blog_advanced' => array (

                    'title' => __( 'Advanced Settings', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::BLOG_LAYOUT_NUM_COLS => array (
                            'type'          => 'select',
                            'label'         => __( 'Layout - Number of Columns', 'beyrouth' ),
                            'description'   => __( 'Mobile devices will automatically show fewer columns to maximize space.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_LAYOUT_NUM_COLS,
                            'choices'   => array (
                                '1col'      => __( 'Single Column', 'beyrouth' ),
                                '2col'      => __( 'Two Columns', 'beyrouth' ),
                                '3col'      => __( 'Three Columns', 'beyrouth' ),
                                '4col'      => __( 'Four Columns', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::BLOG_CARD_APPEARANCE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Blog Card Appearance', 'beyrouth' ),
                            'description'   => __( 'Select whether the Standard style blog cards should appear flat, or as raised cards with a shadow.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_CARD_APPEARANCE,
                            'choices'   => array (
                                'flat'      => __( 'Flat', 'beyrouth' ),
                                'raised'    => __( 'Raised', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::BLOG_CARD_BORDER_RADIUS => array (
                            'type'          => 'number',
                            'label'         => __( 'Round Corners on Posts in the Blog?', 'beyrouth' ),
                            'description'   => __( 'Set this to 0 for sharp corners, or set the rounding value in pixels.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_CARD_BORDER_RADIUS,
                        ),
                        BEYROUTH_OPTIONS::BLOG_CARD_MOSAIC_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Space around each Mosaic tile?', 'beyrouth' ),
                            'description'   => __( 'This is the uncombined padding around each tile. For example, setting this to 5px per tile will equal a 10px wide gutter. Set to 0 for gapless tiles.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_CARD_MOSAIC_GAP,
                        ),
                        BEYROUTH_OPTIONS::BLOG_CARD_FONT_SIZE_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Desktop)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_CARD_FONT_SIZE_DSK,
                        ),
                        BEYROUTH_OPTIONS::BLOG_CARD_FONT_SIZE_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Title - Font Size (Mobile)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_CARD_FONT_SIZE_MBL,
                        ),
                        BEYROUTH_OPTIONS::BLOG_META_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Post Date & Author - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::BLOG_META_FONT_SIZE,
                        ),

                    )

                ),

            ), // End of Blog Sections

        ), // End of Blog Panel

        // Panel: Social -------------------------------------------------------
        null => array (

            'sections'       => array (

                'section_nav_social_links' => array (

                    'title' => __( 'Social Links', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::SOCIAL_URL_1 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #1 - URL', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_URL_1
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_ICON_1 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #1 - Icon', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_ICON_1,
                            'choices'       => beyrouth_get_icons( 'social' )
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_URL_2 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #2 - URL', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_URL_2
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_ICON_2 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #2 - Icon', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_ICON_2,
                            'choices'       => beyrouth_get_icons( 'social' )
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_URL_3 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #3 - URL', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_URL_3
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_ICON_3 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #3 - Icon', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_ICON_3,
                            'choices'       => beyrouth_get_icons( 'social' )
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_URL_4 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #4 - URL', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_URL_4
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_ICON_4 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #4 - Icon', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_ICON_4,
                            'choices'       => beyrouth_get_icons( 'social' )
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_URL_5 => array (
                            'type'          => 'url',
                            'label'         => __( 'Social Link #5 - URL', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_URL_5
                        ),
                        BEYROUTH_OPTIONS::SOCIAL_ICON_5 => array (
                            'type'          => 'select',
                            'label'         => __( 'Social Link #5 - Icon', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::SOCIAL_ICON_5,
                            'choices'       => beyrouth_get_icons( 'social' )
                        ),

                    )

                ),

            ), // End of Social Section

        ), // End of Social Panel

        // Panel: Navbar -------------------------------------------------------
        'panel_navbar' => array (

            'title'         => __( 'Navbar', 'beyrouth' ),
            'desciption'    => __( 'Customize the primary navbar on your site, including control over appearance & behaviour', 'beyrouth' ),
            'sections'      => array (

                // Section : Navbar General Settings ---------------------------
                'section_nav_general' => array (

                    'title' => __( 'General Settings', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::NAVBAR_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Style', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_STYLE,
                            'choices'   => array (
//                                'slim_split'    => __( 'Slim - Centered & Split', 'beyrouth' ),
//                                'slim_left'     => __( 'Slim - Left Aligned', 'beyrouth' ),
//                                'banner'        => __( 'Banner', 'beyrouth' ),
                                'vertical'      => __( 'Vertical', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LINKS_FONT_FAMILY => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Navbar Links - Font Family', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LINKS_FONT_FAMILY,
                            'choices'   => array (
                                'primary'   => __( 'Use Primary Font', 'beyrouth' ),
                                'secondary' => __( 'Use Secondary Font', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LINKS_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LINKS_FONT_SIZE
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_LINKS_GAP => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar Links - Gap Between Links', 'beyrouth' ),
                            'label'         => __( 'Set the pixel value for the amount of space between links', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_LINKS_GAP
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_HAS_SHADOW => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Add a box shadow to the Navbar?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_HAS_SHADOW,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Social Links in Navbar?', 'beyrouth' ),
                            'description'   => __( 'If on, social links will display in the Navbar. Navbar styles display these in different ways', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SHOW_SOCIAL,
                        ),
                        BEYROUTH_OPTIONS::VERT_NAVBAR_DISPLAY_SETTING => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Vertical Navbar - Visibility', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::VERT_NAVBAR_DISPLAY_SETTING,
                            'choices'   => array (
                                'toggled'       => __( 'Openable (Hidden by Default)', 'beyrouth' ),
                                'always'        => __( 'Always Visible', 'beyrouth' ),
                            )
                        ),

                    )

                ),

                // Section : Slim Style Settings ---------------------------
                'section_nav_style_a' => array (

                    'title' => __( 'Advanced Settings', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::NAVBAR_INITIAL_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Initial)', 'beyrouth' ),
                            'description'   => __( 'When the Slim Navbar is at the very top of the page (unstuck)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_INITIAL_HEIGHT
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_STICKY_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Navbar - Height (Sticky)', 'beyrouth' ),
                            'description'   => __( 'When the Slim Navbar is sticky, after the user scrolls down the page', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_STICKY_HEIGHT
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_RIGHT_ALIGN_MENU => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Right Aligned Menu?', 'beyrouth' ),
                            'description'   => __( 'If on, the menu will be right-aligned. For the "Slim - Left Aligned" style of Navbar, the menu will replace the Social Links section', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_RIGHT_ALIGN_MENU,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BOXED_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Box the Content?', 'beyrouth' ),
                            'description'   => __( 'If on, the Navbar content will be lined up with the main content of the page instead of the left & right bounds of the window', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BOXED_CONTENT,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_TRANSPARENT_MENU_BG => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Transparent Menu?', 'beyrouth' ),
                            'description'   => __( 'If on, the menu will be transparent, allowing the Navbar background (color or image) to show through', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_TRANSPARENT_MENU_BG,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BRANDING_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - Alignment', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BRANDING_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'beyrouth' ),
                                'center'    => __( 'Centered', 'beyrouth' ),
                                'right'     => __( 'Right', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_MENU_ALIGNMENT => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Menu - Alignment', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_MENU_ALIGNMENT,
                            'choices'   => array (
                                'left'      => __( 'Left', 'beyrouth' ),
                                'center'    => __( 'Centered', 'beyrouth' ),
                                'right'     => __( 'Right', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above', 'beyrouth' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding (for the Banner style of Navbar)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_DSK
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below', 'beyrouth' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding (for the Banner style of Navbar)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_DSK
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BRANDING_SPACE_TOP_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Above (Mobile)', 'beyrouth' ),
                            'description'   => __( 'Set the amount of space (in pixels) above the branding on mobile devices (for the Banner style of Navbar)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BRANDING_SPACE_TOP_MBL
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Space Below (Mobile)', 'beyrouth' ),
                            'description'   => __( 'Set the amount of space (in pixels) below the branding on mobile devices (for the Banner style of Navbar)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BRANDING_SPACE_BOTTOM_MBL
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_FINAL_LINK_ACCENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Style final Navbar link as a CTA?', 'beyrouth' ),
                            'description'   => __( 'When toggled on, the last (right-most) link in the Navbar will appear as a unique button callout', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_FINAL_LINK_ACCENT
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_FINAL_LINK_ROUNDED => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Rounded button?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_FINAL_LINK_ROUNDED
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_FINAL_LINK_FILL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Color fill?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_FINAL_LINK_FILL
                        ),

                    )

                ),

                // Section : Navbar Colors -------------------------------------
                'section_nav_colors' => array (

                    'title' => __( 'Colors', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::NAVBAR_BG_STYLE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Background Style', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BG_STYLE,
                            'choices'   => array (
                                'color'     => __( 'Color', 'beyrouth' ),
                                'image'     => __( 'Background Image', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Background Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Foreground Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_MENU_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Background Color', 'beyrouth' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the background color for the menu bar', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_MENU_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_MENU_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Menu - Foreground Color', 'beyrouth' ),
                            'description'   => __( 'If the menu is not set to transparent (in Advanced Settings), you can set the foreground color for the menu bar', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_MENU_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_BG_IMAGE => array (
                            'type'          => 'image',
                            'label'         => __( 'Background Image', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_BG_IMAGE,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SOCIAL_BG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Drawer Background', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SOCIAL_BG_COLOR,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SOCIAL_FG_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR,
                        ),
                        BEYROUTH_OPTIONS::NAVBAR_SOCIAL_FG_COLOR_HOVER => array (
                            'type'          => 'color',
                            'label'         => __( 'Social Links - Icons (Hover)', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::NAVBAR_SOCIAL_FG_COLOR_HOVER,
                        ),
                        BEYROUTH_OPTIONS::VERT_NAVBAR_TAB_BACKGROUND => array (
                            'type'          => 'color',
                            'label'         => __( 'Vertical Navbar Tab - Background Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::VERT_NAVBAR_TAB_BACKGROUND,
                        ),
                        BEYROUTH_OPTIONS::VERT_NAVBAR_TAB_FOREGROUND => array (
                            'type'          => 'color',
                            'label'         => __( 'Vertical Navbar Tab - Foreground Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::VERT_NAVBAR_TAB_FOREGROUND,
                        ),

                    )

                ),

            ), // End of Navbar Sections

        ), // End of Navbar Panel

        // Panel: Appearance ---------------------------------------------------
        'panel_appearance' => array (

            'title'         => __( 'Appearance', 'beyrouth' ),
            'description'   => __( 'Customize your site colors, fonts, and more', 'beyrouth' ),
            'sections'      => array (

                // Section : Colors --------------------------------------------
                'section_colors' => array (

                    'title'         => __( 'Skin Colors', 'beyrouth' ),
                    'description'   => __( 'Customize the color theme in use on your site', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::COLOR_SKIN_PRIMARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Primary', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::COLOR_SKIN_PRIMARY,
                            'choices'   => array(
                                '#00a0bc'       => __( 'Cool Peppermint', 'beyrouth' ),
                                '#f04265'       => __( 'Cherry Gloss', 'beyrouth' ),
                                '#75dbb3'       => __( 'Seafoam Coast', 'beyrouth' ),
                                '#7f66ff'       => __( 'Royal Lilac', 'beyrouth' ),
                                '#00d4ff'       => __( 'Sky Blue', 'beyrouth' ),
                            ),
                        ),
                        BEYROUTH_OPTIONS::COLOR_SKIN_SECONDARY => array(
                            'type'          => 'color-select',
                            'label'         => __( 'Skin Color - Secondary', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::COLOR_SKIN_SECONDARY,
                            'choices'   => array(
                                '#007fa3'       => __( 'Deep Azure', 'beyrouth' ),
                                '#d60059'       => __( 'Magenta Rose', 'beyrouth' ),
                                '#04aeae'       => __( 'Tide Pool', 'beyrouth' ),
                                '#6e3399'       => __( 'Wildberry', 'beyrouth' ),
                                '#0b84da'       => __( 'Ocean Swell', 'beyrouth' ),
                            ),
                        ),

                    ),

                ),

                // Section : Fonts ---------------------------------------------
                'fonts' => array (

                    'title'         => __( 'Fonts', 'beyrouth' ),
                    'description'   => __( 'Customize the fonts in use on your site. Visit <a target="_BLANK" href="https://fonts.google.com/"> Google Fonts to see font options.</a> Please be advised some fonts on this link may not be present in the theme, as Google Fonts are constantly updated. We periodically update the font list here from Google Fonts.', 'beyrouth' ),
                    'options' => array (

                        // Primary Font
                        BEYROUTH_OPTIONS::FONT_PRIMARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Primary Font - For Headings & Titles', 'beyrouth' ),
                            'default'   => BEYROUTH_DEFAULTS::FONT_PRIMARY,
                            'choices'   => beyrouth_fonts(),
                        ),
                        BEYROUTH_OPTIONS::FONT_HEADINGS_LETTER_GAP => array(
                            'type'          => 'select',
                            'label'         => __( 'Letter Spacing for Headings & Titles', 'beyrouth' ),
                            'description'   => __( 'Set to 0 for normal spacing, negative for smaller gap between letters, positive for increased separation.', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FONT_HEADINGS_LETTER_GAP,
                            'choices'   => array (
                                '-.1'       => __( '-.100em (Narrowest)', 'beyrouth' ),
                                '-.075'     => __( '-.075em', 'beyrouth' ),
                                '-.050'     => __( '-.050em', 'beyrouth' ),
                                '-.025'     => __( '-.025em', 'beyrouth' ),
                                '0.0'         => __( '0.00em (Default)', 'beyrouth' ),
                                '.025'      => __( '.025em', 'beyrouth' ),
                                '.050'      => __( '.050em', 'beyrouth' ),
                                '.075'      => __( '.075em', 'beyrouth' ),
                                '.100'      => __( '.100em (Widest)', 'beyrouth' ),
                            )
                        ),

                        // Secondary Font
                        BEYROUTH_OPTIONS::FONT_SECONDARY => array(
                            'type'      => 'select',
                            'label'     => __( 'Secondary Font - For Content', 'beyrouth' ),
                            'default'   => BEYROUTH_DEFAULTS::FONT_SECONDARY,
                            'choices'   => beyrouth_fonts(),
                        ),
                        BEYROUTH_OPTIONS::FONT_BODY_SIZE => array(
                            'type'      => 'number',
                            'label'     => __( 'Secondary Font - Text Size (px)', 'beyrouth' ),
                            'default'   => BEYROUTH_DEFAULTS::FONT_BODY_SIZE,
                        ),

                    ),

                ),

                // Section : Smooth Scrolling ----------------------------------
                'section_scroll' => array (

                    'title'         => __( 'Smooth Scrolling', 'beyrouth' ),
                    'description'   => __( 'Customize whether the Smooth Scrolling feature is enabled on your site', 'beyrouth' ),
                    'options' => array (

                        BEYROUTH_OPTIONS::EASE_SCROLL_TOGGLE => array(
                            'type'          => 'toggle',
                            'label'         => __( 'Enable Smooth Scrolling?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::EASE_SCROLL_TOGGLE,
                        ),

                    ),

                ),

            ), // End of Appearance Sections

        ), // End of Appearance Panel

        // Panel: Footer -------------------------------------------------------
        'panel_footer' => array (

            'title'         => __( 'Footer', 'beyrouth' ),
            'desciption'    => __( 'Customize the theme footer', 'beyrouth' ),
            'sections'      => array (


                // Section : Footer General Settings  --------------------------
                'section_footer_general' => array (

                    'title'     => __( 'General Settings', 'beyrouth' ),
                    'options'   => array (

                        BEYROUTH_OPTIONS::FOOTER_BOXED_CONTENT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Boxed Content?', 'beyrouth' ),
                            'description'   => __( 'If on, the Footer will be lined up with the main content instead of the left & right bounds of the window', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_BOXED_CONTENT,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_CENTER_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Centered?', 'beyrouth' ),
                            'description'   => __( 'If on, the Footer content will be centered', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_CENTER_BRANDING,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_SHOW_SOCIAL => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Social?', 'beyrouth' ),
                            'description'   => __( 'If on, the Footer will include the social icon links you have set', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_SHOW_SOCIAL,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_SHOW_BRANDING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Branding?', 'beyrouth' ),
                            'description'   => __( 'If on,  the Footer will include either an alternate custom logo or your site title', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_SHOW_BRANDING,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_SHOW_COPYRIGHT => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Footer - Show Copyright?', 'beyrouth' ),
                            'description'   => __( 'If on, the Footer will include the copyright tagline you set', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_SHOW_COPYRIGHT,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_COPYRIGHT_TAGLINE => array (
                            'type'          => 'text',
                            'label'         => __( 'Copyright - Tagline Text', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_BRANDING_TYPE => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Branding - What to Display?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_BRANDING_TYPE,
                            'choices'   => array (
                                'site_title'    => __( 'Show Site Title', 'beyrouth' ),
                                'alt_logo'      => __( 'Show Logo', 'beyrouth' ),
                            )
                        ),
                        BEYROUTH_OPTIONS::FOOTER_ALTERNATE_LOGO => array (
                            'type'          => 'image',
                            'label'         => __( 'Branding - Logo', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_ALTERNATE_LOGO,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_ALTERNATE_LOGO_HEIGHT => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Logo Height', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_ALTERNATE_LOGO_HEIGHT,
                        ),
                        BEYROUTH_OPTIONS::FOOTER_SITE_TITLE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Branding - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_SITE_TITLE_FONT_SIZE
                        ),
                        BEYROUTH_OPTIONS::FOOTER_SITE_TITLE_ALL_CAPS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Branding - All Uppercase?', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_SITE_TITLE_ALL_CAPS
                        ),
                        BEYROUTH_OPTIONS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE => array (
                            'type'          => 'number',
                            'label'         => __( 'Copyright - Font Size', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_COPYRIGHT_TAGLINE_FONT_SIZE
                        ),

                    )

                ),

                // Section : Footer Colors -------------------------------------
                'section_footer_colors' => array (

                    'title'     => __( 'Colors', 'beyrouth' ),
                    'options'   => array (

                        // Pre-Footer Background
                        BEYROUTH_OPTIONS::PRE_FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Background Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::PRE_FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),

                        // Pre-Footer Foreground
                        BEYROUTH_OPTIONS::PRE_FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Prefooter: Foreground Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::PRE_FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),

                        // Pre-Footer Widget Titles
                        BEYROUTH_OPTIONS::PRE_FOOTER_WIDGET_TITLE_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Prefooter: Widgets Title Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::PRE_FOOTER_WIDGET_TITLE_COLOR,
                        ),

                        // Footer Background
                        BEYROUTH_OPTIONS::FOOTER_BG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Background Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_BG_COLOR,
                            'choices'   => array (
                                '#000000'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),

                        // Footer Foreground
                        BEYROUTH_OPTIONS::FOOTER_FG_COLOR => array (
                            'type'          => 'color-select',
                            'label'         => __( 'Footer: Foreground Color', 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::FOOTER_FG_COLOR,
                            'choices'   => array (
                                '#141414'    => __( 'Dark', 'beyrouth' ),
                                '#ffffff'    => __( 'Light', 'beyrouth' ),
                            )
                        ),

                    )

                ),

            ), // End of Footer Sections

        ), // End of Footer Panel

        // Panel: WooCommerce --------------------------------------------------
        'woocommerce' => array (

            'title'         => __( 'WooCommerce', 'beyrouth' ),
            'sections'      => array (

                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_featured' => array (

                    'title'     => __( 'Featured Products', 'beyrouth' ),
                    'options'   => array (

                        BEYROUTH_OPTIONS::WOO_SHOW_FEATURED_PRODUCTS => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show Featured Products at the top of the Shop page?' , 'beyrouth' ),
                            'description'   => __( 'To feature a product, click the corresponding star icon on the Products page.' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_SHOW_FEATURED_PRODUCTS,
                        ),
                        BEYROUTH_OPTIONS::WOO_SHOW_FEATURED_PRODUCT_HEADING => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Show "Featured" Header Banner?' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_SHOW_FEATURED_PRODUCT_HEADING,
                        ),
                        BEYROUTH_OPTIONS::WOO_FEATURED_PRODUCTS_NUM_COLS => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Featured Products Per Row' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_FEATURED_PRODUCTS_NUM_COLS,
                            'choices'       => array (
                                'two'   => __( 'Two', 'beyrouth' ),
                                'three' => __( 'Three', 'beyrouth' ),
                            )
                        ),

                    )

                ),

                // Section : WooCommerce Advanced  -----------------------------
                'section_woocommerce_slide_cart' => array (

                    'title'     => __( 'Slide-In Cart', 'beyrouth' ),
                    'options'   => array (

                        BEYROUTH_OPTIONS::WOO_SLIDE_CART_TOGGLE => array (
                            'type'          => 'toggle',
                            'label'         => __( 'Include the Slide-In Cart Drawer?' , 'beyrouth' ),
                            'description'   => __( 'If this is on, users can click a tab on the right side of the page to open a drawer displaying the items currently added to their cart.' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_SLIDE_CART_TOGGLE,
                        ),
                        BEYROUTH_OPTIONS::WOO_SLIDE_CART_TAB_COLOR => array (
                            'type'          => 'color',
                            'label'         => __( 'Tab: Color' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_SLIDE_CART_TAB_COLOR,
                        ),
                        BEYROUTH_OPTIONS::WOO_SLIDE_CART_TAB_ICON => array (
                            'type'          => 'radio-toggle',
                            'label'         => __( 'Tab: Icon' , 'beyrouth' ),
                            'default'       => BEYROUTH_DEFAULTS::WOO_SLIDE_CART_TAB_ICON,
                            'choices'       => array (
                                'fa-shopping-cart'      =>  __( 'Cart', 'beyrouth' ),
                                'fa-shopping-bag'       =>  __( 'Bag', 'beyrouth' ),
                                'fa-shopping-basket'    =>  __( 'Basket', 'beyrouth' ),
                            )
                        ),

                    )

                ),

            ), // End of Footer Sections

        ), // End of WooCommerce Panel

    ), // End of Panels

);

$acid->config( $data );
