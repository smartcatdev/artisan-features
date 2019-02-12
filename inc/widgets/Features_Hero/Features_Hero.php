<?php

namespace beyrouth;

class Features_Hero extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'beyrouth_features_hero',
            'title'         => 'Beyrouth: Features Hero',
            'description'   => 'A widget to output a large image banner with icons that showcase features', 
            'output_file'   => get_plugin_path( 'inc/widgets/Features_Hero/Features_Hero_View.php' ), 
            'widget_title'  => false, 
        );
        
        /**
        * Widget Fields
        */
        $fields = array (
           
            'heading_content' => array(
                'label'             => 'Content',
                'id'                => '',
                'default'           => '',
                'type'              => 'section',
            ),
           
            'background_image' => array (
                'label'             => 'Background Image',
                'id'                => 'background_image',
                'default'           => '',
                'type'              => 'media',
            ),
            'pre_title' => array (
                'label'             => 'Pre-Title',
                'id'                => 'pre_title',
                'default'           => '',
                'type'              => 'text',
            ),
            'title' => array (
                'label'             => 'Title',
                'id'                => 'title',
                'default'           => '',
                'type'              => 'text',
            ),
            'content' => array (
                'label'             => 'Content',
                'id'                => 'content',
                'default'           => '',
                'type'              => 'textarea',
            ),
            
            'button_1_label' => array (
                'label'             => 'Button #1 - Label',
                'id'                => 'button_1_label',
                'default'           => '',
                'type'              => 'text',
            ),
            'button_1_url' => array (
                'label'             => 'Button #1 - URL',
                'id'                => 'button_1_url',
                'default'           => '',
                'type'              => 'url',
            ),
            'button_1_style' => array (
                'label'             => 'Button #1 - Style',
                'id'                => 'button_1_style',
                'default'           => 'primary',
                'type'              => 'select',
                'options'           => \beyrouth\button_options(),
            ),
            'button_1_size' => array (
                'label'             => 'Button #1 - Size',
                'id'                => 'button_1_size',
                'default'           => 'medium',
                'type'              => 'select',
                'options'           => \beyrouth\button_sizes(),
            ),
            'button_1_target' => array (
                'label'             => 'Button #1 - Open Link in...',
                'id'                => 'button_1_target',
                'default'           => 'same',
                'type'              => 'select',
                'options'           => \beyrouth\button_targets(),
            ),
            
            'button_2_label' => array (
                'label'             => 'Button #2 - Label',
                'id'                => 'button_2_label',
                'default'           => '',
                'type'              => 'text',
            ),
            'button_2_url' => array (
                'label'             => 'Button #2 - URL',
                'id'                => 'button_2_url',
                'default'           => '',
                'type'              => 'url',
            ),
            'button_2_style' => array (
                'label'             => 'Button #2 - Style',
                'id'                => 'button_2_style',
                'default'           => 'primary',
                'type'              => 'select',
                'options'           => \beyrouth\button_options(),
            ),
            'button_2_size' => array (
                'label'             => 'Button #2 - Size',
                'id'                => 'button_2_size',
                'default'           => 'medium',
                'type'              => 'select',
                'options'           => \beyrouth\button_sizes(),
            ),
            'button_2_target' => array (
                'label'             => 'Button #2 - Open Link in...',
                'id'                => 'button_2_target',
                'default'           => 'same',
                'type'              => 'select',
                'options'           => \beyrouth\button_targets(),
            ),
            
            'heading_appearance' => array(
                'label'          => 'Appearance',
                'id'             => '',
                'default'        => '',
                'type'           => 'section',
            ),           
            
            'padding' => array(
                'label'          => 'Vertical Padding',
                'id'             => 'padding',
                'default'        => 50,
                'type'           => 'number'
            ),
            'template_style' => array(
                'label'          => 'Template Style',
                'id'             => 'template_style',
                'default'        => 'left',
                'type'           => 'select',
                'options'       => array(
                    'left'  =>  'Content on Left Side',
                    'right' =>  'Content on Right Side',
                    'stacked' =>  'Stacked',
                )
            ),
            'content_alignment' => array(
                'label'          => 'Text Align - Content',
                'id'             => 'content_alignment',
                'default'        => 'left',
                'type'           => 'select',
                'options'       => \beyrouth\alignment_options()
            ),
            'bg_color' => array (
                'label'          => 'Background Color (if no image set)',
                'id'             => 'bg_color',
                'default'        => '#333333',
                'type'           => 'colorpicker',
            ),
            'text_color' => array (
                'label'          => 'Text Color',
                'id'             => 'text_color',
                'default'        => '#ffffff',
                'type'           => 'colorpicker',
            ),
            'icon_color' => array (
                'label'          => 'Icons - Color',
                'id'             => 'icon_color',
                'default'        => '#ffffff',
                'type'           => 'colorpicker',
            ),
        
            'heading_overlay' => array(
                'label'          => 'Overlay',
                'id'             => '',
                'default'        => '',
                'type'           => 'section',
            ),  
            
            'single_overlay_color' => array (
                'label'          => 'Overlay - Color',
                'id'             => 'single_overlay_color',
                'default'        => '#000000',
                'type'           => 'colorpicker',
            ),
            'overlay_opacity' => array (
                'label'          => 'Overlay Opacity',
                'id'             => 'overlay_opacity',
                'default'        => 0.15,
                'type'           => 'decimal',
            ),
            'use_gradient' => array (
                'label'          => 'Use the Gradient Colors?',
                'id'             => 'use_gradient',
                'default'        => 'off',
                'type'           => 'toggle',
            ),
            'gradient_start_color' => array (
                'label'          => 'Gradient - Top Color',
                'id'             => 'gradient_start_color',
                'default'        => '#000000',
                'type'           => 'colorpicker',
            ),
            'gradient_end_color' => array (
                'label'          => 'Gradient - Bottom Color',
                'id'             => 'gradient_end_color',
                'default'        => '#000000',
                'type'           => 'colorpicker',
            ),
            
        );
       
        for ( $i = 1; $i < 4; $i++ ) :
            
            $fields['feature_'. $i . '_heading'] = array(
                'label'         => 'Feature #' . $i,
                'id'            => '',
                'default'       => '',
                'type'          => 'section',
            );
            $fields['feature_'. $i . '_icon'] = array(
                'label'         => 'Icon',
                'id'            => 'feature_'. $i . '_icon',
                'default'       => '',
                'type'          => 'select',
                'options'       => \beyrouth\fa_icons(),
            );
            $fields['feature_'. $i . '_title'] = array(
                'label'         => 'Title',
                'id'            => 'feature_'. $i . '_title',
                'default'       => '',
                'type'          => 'text',
            );
            $fields['feature_'. $i . '_link'] = array(
                'label'         => 'Link / URL',
                'id'            => 'feature_'. $i . '_link',
                'default'       => '',
                'type'          => 'url',
            );
            $fields['feature_'. $i . '_target'] = array(
                'label'         => 'Open Link in...',
                'id'            => 'feature_'. $i . '_target',
                'default'       => '',
                'type'          => 'select',
                'options'       => \beyrouth\button_targets(),
            );
            
        endfor;
        
        parent::__construct( $args, $fields, array(
            'beyrouth-features-hero' => get_plugin_url( 'inc/widgets/Features_Hero/assets/features-hero.css' )
        ) );
        
    }
    
    
}

function register_features_hero_widget() {
    register_widget( 'beyrouth\Features_Hero' );
}
add_action( 'widgets_init', 'beyrouth\register_features_hero_widget' );