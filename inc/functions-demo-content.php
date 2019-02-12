<?php

if( ! get_option( 'beyrouth_installed', false ) ) {

    $query['autofocus[panel]'] = 'widgets';
    $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );

    // Features Hero Widget
    insert_widget_in_sidebar( 'beyrouth_features_hero', array(
        'background_image'      => 'https://i.imgur.com/T3DTOYf.jpg',
        'pre_title'             => 'Customizable widget',
        'title'                 => 'Beyrouth Features Hero Widget',
        'content'               => 'Edit the contents of this widget from the theme customizer, under the Widgets section.',
        'text_color'            => '#333333',
        'icon_color'            => '#21aad3',
        'button_1_label'        => 'Click to edit',
        'button_1_url'          => $panel_link,
        'button_1_style'        => 'primary',
        'button_1_size'         => 'left',
        'button_1_target'       => '',
        'padding'               => '75',
        'single_overlay_color'  => '#ffffff',
        'overlay_opacity'       => 0.85,
        'feature_1_title'     => 'Customizable',
        'feature_1_icon'        => 'fas fa-sliders-h',
        'feature_2_title'     => 'Customizable',
        'feature_2_icon'        => 'fas fa-magic',
        'feature_3_title'     => 'Pixel-perfect',
        'feature_3_icon'        => 'fas fa-gem',
    ), 'sidebar-front-above' );


    // Slider Widget
    insert_widget_in_sidebar( 'beyrouth_slider', array(
        'slider_visibility'         => true,
        'slider_height_style'       => 42,
        'slider_height'             => 600,
        'slider_height_mobile'      => 400,
        'slider_autoplay'           => true,
        'slider_autoplay_speed'     => 6500,
        'slider_arrows'             => true,
        'slider_dots'               => false,
        'slider_fade'               => false,
        'slider_pause_hover'        => false,
        'slider_trans_speed'        => 500,
        'slide_image_1'             => 'https://i.imgur.com/rS8UAUt.jpg',
        'slide_pre_title_1'         => 'Beyrouth Slider',
        'slide_title_1'             => 'First slide title',
        'slide_caption_1'           => 'Edit the contents from the widgets section in customizer',
        'slide_button_label_1'      => 'Click to edit',
        'slide_button_url_1'        => $panel_link,
        'slide_overlay_opacity_1'   => 0.2,
        'slide_image_2'             => 'https://i.imgur.com/E5Zf7Pw.jpg',
        'slide_pre_title_2'         => 'Beyrouth slider',
        'slide_title_2'             => 'Second slide title',
        'slide_caption_2'           => 'Edit the contents from the widgets section in customizer',
        'slide_button_label_2'      => 'Click to edit',
        'slide_button_url_2'        => $panel_link,
        'slide_overlay_opacity_2'   => 0.2,
    ), 'sidebar-front-above' );

    // Image List Widget
    insert_widget_in_sidebar( 'beyrouth_image_list', array(
        'title'                 => 'Beyrouth Image List Widget',
        'subtitle'              => 'Use this widget to display a grid of images. You can stack several widgets.',
        'bg_color'              => '#f9f9f9',
        'text_color'            => '#333333',
        'padding'               => '60',
        'image_1'               => 'https://i.imgur.com/7QCNQVk.jpg',
        'title_1'               => 'First image',
        'image_2'               => 'https://i.imgur.com/2NNbzqm.jpg',
        'title_2'               => 'Second image',
        'image_3'               => 'https://i.imgur.com/ikXHQaC.jpg',
        'title_3'               => 'Third Image',
        'image_4'               => 'https://i.imgur.com/Iohd8Kh.jpg',
        'title_4'               => 'Fourth Image',
    ), 'sidebar-front-above' );


    insert_widget_in_sidebar( 'beyrouth_image_cta', array(
        'title'             => 'Beyrouth Image CTA Widget',
        'details'           => 'Edit the contents of this widget from the theme customizer, under the Widgets section.',
        'btn_text'          => 'Click to edit',
        'btn_url'           => $panel_link,
        'image_location'    => 'left',
        'text_align'        => 'left',
        'btn_style'         => 'primary',
        'padding'           => '90',
        'image'             => get_plugin_url('assets/images/girl.jpg')
    ), 'sidebar-front-above' );


    // Features Hero Widget
    insert_widget_in_sidebar( 'beyrouth_features_hero', array(
        'background_image'      => 'https://i.imgur.com/g5p00qA.jpg',
        'pre_title'             => 'Build Anything with Beyrouth',
        'title'                 => 'A Truly Multi-purpose Themet',
        'content'               => 'Use Beyrouth to create an online shop, a personal blog, a business website, a portfolio page, marketing landing pages, single product sites and so on. Buildr gives you the tools and the flexibility to build any website.',
        'button_1_label'        => 'Click to edit',
        'button_1_url'          => $panel_link,
        'button_1_style'        => 'primary',
        'button_1_size'         => 'left',
        'button_1_target'       => '',
        'padding'               => '75',
        'text_color'            => '#333333',
        'single_overlay_color'  => '#ffffff',
        'overlay_opacity'       => 0.01,
        'feature_1_heading'     => '',
        'feature_1_icon'        => '',
        'feature_2_heading'     => '',
        'feature_2_icon'        => '',
        'feature_3_heading'     => '',
        'feature_3_icon'        => '',
    ), 'sidebar-front-above' );



    update_option( 'beyrouth_installed', true );

}