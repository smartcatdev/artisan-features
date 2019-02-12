<?php

namespace beyrouth;

class Posts extends \AcidWidget{
    
    function __construct() {
        
        $args = array(
            'id'            => 'beyrouth_posts',
            'title'         => 'Beyrouth: Posts',
            'description'   => 'A widget that outputs a group of posts based on user-defined options', 
            'output_file'   => get_plugin_path( 'inc/widgets/Posts/Posts_View.php' ), 
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
           
            'title' => array (
                'label'             => 'Title',
                'id'                => 'title',
                'default'           => '',
                'type'              => 'text',
            ),
            'subtitle' => array (
                'label'             => 'Subtitle',
                'id'                => 'subtitle',
                'default'           => '',
                'type'              => 'textarea',
            ),
            
            'heading_criteria' => array(
                'label'             => 'Posts Criteria',
                'id'                => '',
                'default'           => '',
                'type'              => 'section',
            ),
            
            'posts' => array (
                'label'             => 'Post IDs (Comma Separated)',
                'id'                => 'posts',
                'default'           => '',
                'type'              => 'textarea',
            ),
            'post_types' => array (
                'label'             => 'Post Types (Comma Separated)',
                'id'                => 'post_types',
                'default'           => '',
                'type'              => 'textarea',
            ),
            'show_all' => array (
                'label'             => 'Show all found Posts?',
                'id'                => 'show_all',
                'default'           => 'on',
                'type'              => 'toggle',
            ),
            'count' => array (
                'label'             => 'Number of Posts to Return (If Show All is not set above.)',
                'id'                => 'count',
                'default'           => '',
                'type'              => 'number',
            ),
            'ordered_by' => array (
                'label'             => 'Order By',
                'id'                => 'ordered_by',
                'default'           => '',
                'type'              => 'text',
            ),
            'sort_direction' => array (
                'label'             => 'Order By - Sort Direction',
                'id'                => 'sort_direction',
                'default'           => 'DESC',
                'type'              => 'select',
                'options'       => array(
                    'ASC'       => 'Ascending',
                    'DESC'      => 'Descending'
                ),
            ),
            'category_in' => array (
                'label'             => 'Category In (Comma Separated)',
                'id'                => 'category_in',
                'default'           => '',
                'type'              => 'text',
            ),
            'tags_in' => array (
                'label'             => 'Tags In (Comma Separated)',
                'id'                => 'tags_in',
                'default'           => '',
                'type'              => 'text',
            ),
            
            'heading_appearance' => array(
                'label'          => 'Appearance',
                'id'             => '',
                'default'        => '',
                'type'           => 'section',
            ),           
            
            'columns' => array (
                'label'             => 'Number of Layout Columns',
                'id'                => 'columns',
                'default'           => 3,
                'type'              => 'select',
                'options'           => array(
                    1   => 'One Column',
                    2   => 'Two Columns',
                    3   => 'Three Columns',
                    4   => 'Four Columns',
                ),
            ),
            'text_align' => array(
                'label'          => 'Text Align - Headings',
                'id'             => 'text_align',
                'default'        => 'center',
                'type'           => 'select',
                'options'       => \beyrouth\alignment_options()
            ),
            'text_align_content' => array(
                'label'          => 'Text Align - Content',
                'id'             => 'text_align_content',
                'default'        => 'left',
                'type'           => 'select',
                'options'       => \beyrouth\alignment_options()
            ),
            'show_dates' => array(
                'label'          => 'Show Date?',
                'id'             => 'show_dates',
                'default'        => 'on',
                'type'           => 'toggle',
            ),
            'template' => array (
                'label'          => 'Template',
                'id'             => 'template',
                'default'        => 'cards',
                'type'           => 'select',
                'options'        => array(
                    'cards'         => 'Cards',
                    'carousel'      => 'Carousel'
                )
            ),
            'vertical_title' => array (
                'label'          => 'Rotate text content to be vertical?',
                'id'             => 'vertical_title',
                'default'        => 'on',
                'type'           => 'toggle',
            ),
            'carousel_height' => array (
                'label'          => 'Carousel Height (in pixels)',
                'id'             => 'carousel_height',
                'default'        => 650,
                'type'           => 'number',
            ),
            'arrows_toggle' => array (
                'label'          => 'Show Navigation Arrows',
                'id'             => 'arrows_toggle',
                'default'        => 'on',
                'type'           => 'toggle',
            ),
            'autoplay_toggle' => array (
                'label'          => 'Autoplay Through Carousel?',
                'id'             => 'autoplay_toggle',
                'default'        => 'on',
                'type'           => 'toggle',
            ),
            'autoplay_speed' => array (
                'label'          => 'Autoplay Slide Duration (in milliseconds)',
                'id'             => 'autoplay_speed',
                'default'        => 4000,
                'type'           => 'number',
            ),
            'max_visible_slides' => array (
                'label'          => 'Maximum Number of Visible Slides',
                'id'             => 'max_visible_slides',
                'default'        => 4,
                'type'           => 'select',
                'options'        => array(
                    1   => 'One',
                    2   => 'Two',
                    3   => 'Three',
                    4   => 'Four',
                    5   => 'Five',
                ),
            ),
            'slide_scroll_num' => array (
                'label'          => 'Advance Carousel by how many Slides at a time?',
                'id'             => 'slide_scroll_num',
                'default'        => 1,
                'type'           => 'select',
                'options'        => array(
                    1   => 'One',
                    2   => 'Two',
                    3   => 'Three',
                    4   => 'Four',
                    5   => 'Five',
                ),
            ),
            'bg_color' => array (
                'label'          => 'Background Color',
                'id'             => 'bg_color',
                'default'        => '#ffffff',
                'type'           => 'colorpicker',
            ),
            'text_color' => array (
                'label'          => 'Text Color',
                'id'             => 'text_color',
                'default'        => '#333333',
                'type'           => 'colorpicker',
            ),
            'overlay_text_color' => array (
                'label'          => 'Carousel Overlay Text Color',
                'id'             => 'overlay_text_color',
                'default'        => '#ffffff',
                'type'           => 'colorpicker',
            ),
            'padding' => array(
                'label'          => 'Vertical Padding',
                'id'             => 'padding',
                'default'        => '50',
                'type'           => 'number'
            ),

        );
       
        parent::__construct( $args, $fields, 
            array(
                'beyrouth-posts' => get_plugin_url( 'inc/widgets/Posts/assets/posts.css' )
            )
        );
        
    }
    
    
}

function register_posts_widget() {
    register_widget( 'beyrouth\Posts' );
}
add_action( 'widgets_init', 'beyrouth\register_posts_widget' );