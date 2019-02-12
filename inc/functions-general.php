<?php

namespace beyrouth;

function attr( $attr ) {
    echo esc_attr( $attr );
}

function url( $url ) {
    echo esc_url( $url );
}

function html( $html ) {
    echo html_entity_decode( $html );
}

function button( $text, $url, $class = 'primary', $size = 'medium', $target = 'same' ) { 
    
    if( $text ) : ?> 
        
        <a href="<?php url( $url ) ?>" class="button <?php attr( $class ) ?> <?php attr( $size ) ?>" <?php echo $target == 'new' ? 'target="_BLANK"' : ''; ?>>
            <?php attr( $text ); ?>
        </a>

    <?php endif;
    
}

function alignment_options() {
    return array(
        'left'      => 'Left',
        'right'     => 'Right',
        'center'    => 'Center',
    );
}

function button_options() {
    return array(
        'primary'       => 'Primary',
        'secondary'     => 'Secondary',
        'hollow'        => 'Hollow'
    );
}

function button_sizes() {
    return array(
        'small'       => 'Small',
        'medium'     => 'Medium',
        'large'        => 'Large'
    );
}

function button_targets() {
    return array(
        'same'      => 'Open in Same Tab',
        'new'       => 'Open in New',
    );
}

function render_template( $file, $args, $once = false ) {
    
    $file = get_plugin_path( 'inc/widgets/' . $file );
    
    if( file_exists( $file ) ) {
        
        extract( $args );
        
        
        if( $once ) {
            include_once $file;
        }else{
            include $file;
        }
        
    }
    
}

add_action('admin_bar_menu', 'beyrouth\toolbar_link', 999 );

function toolbar_link( $wp_admin_bar ) {
    
    if( is_admin() ) {
        return;
    }
    
    $post = get_queried_object();
    
    if( ! isset( $post->ID ) ) {
        return;
    }
    
    $query['autofocus[panel]'] = 'widgets';
    $query['url'] = get_the_permalink( $post->ID );
    $panel_link = add_query_arg( $query, admin_url( 'customize.php' ) );
    
    $args = array(
        'id'        =>  'beyrouth-widgets',
        'title'     =>  __( 'Edit Beyrouth Widgets', 'beyrouth' ),
        'href'      => $panel_link, 
        'meta'      => array(
            'class' => 'beyrouth-toolbar-link',
            'title' => __( 'Beyrouth Page Widgets', 'beyrouth' ),
        )
    );
    
    $wp_admin_bar->add_node( $args );
}

/**
 * Insert a widget in a sidebar.
 *
 * @param string $widget_id   ID of the widget (search, recent-posts, etc.)
 * @param array $widget_data  Widget settings.
 * @param string $sidebar     ID of the sidebar.
 */
function insert_widget_in_sidebar( $widget_id, $widget_data, $sidebar ) {

    // Retrieve sidebars, widgets and their instances
    $sidebars_widgets = get_option( 'sidebars_widgets', array() );
    $widget_instances = get_option( 'widget_' . $widget_id, array() );

    // Retrieve the key of the next widget instance
    $numeric_keys = array_filter( array_keys( $widget_instances ), 'is_int' );
    $next_key = $numeric_keys ? max( $numeric_keys ) + 1 : 2;

    // Add this widget to the sidebar
    if ( ! isset( $sidebars_widgets[ $sidebar ] ) ) {
        $sidebars_widgets[ $sidebar ] = array();
    }
    $sidebars_widgets[ $sidebar ][] = $widget_id . '-' . $next_key;

    // Add the new widget instance
    $widget_instances[ $next_key ] = $widget_data;

    // Store updated sidebars, widgets and their instances
    update_option( 'sidebars_widgets', $sidebars_widgets );
    update_option( 'widget_' . $widget_id, $widget_instances );

}

function get_custom_query_args( $args = null ) {

    if ( is_null( $args ) || !is_array( $args ) ) { return false; }

    $cat_IDs = null;
    $tag_IDs = null;

    /**
     * Post IDs
     *
     * Strip all whitespace characters, explode to array, remove all indices where string length == 0
     */
    if ( !empty( $args[ 'posts'] ) ) {
        $post_IDs = array_filter( explode( ',', preg_replace( '~\x{00a0}~', '', $args['posts'] ) ), 'strlen' );
    } else {
        $post_IDs = null;
    }

    /**
     * Post Types
     *
     * Strip all whitespace characters, explode to array, remove all indices where string length == 0
     */
    if ( !empty( $args[ 'post_types'] ) ) {
        $post_types = array_filter( explode( ',', preg_replace( '~\x{00a0}~', '', $args['post_types'] ) ), 'strlen' );
    } else {
        $post_types = array( 'post' );
    }

    /**
     * Ordered By
     */
    if ( !empty( $args[ 'ordered_by'] ) ) {
        $ordered_by = sanitize_key( $args['ordered_by'] );
    } else {
        $ordered_by = null;
    }


    /**
     * Ordered By - Sort Direction
     */
    if ( !empty( $args[ 'sort_direction'] ) ) {
        $sort_direction = sanitize_key( $args['sort_direction'] );
    } else {
        $sort_direction = 'ASC';
    }

    /**
     * Categories In
     *
     * Strip all whitespace characters, explode to array, remove all indices where string length == 0
     */
    if ( !empty( $args['category_in'] ) ) {
        $cat_IDs = array_filter( explode( ',', preg_replace( '~\x{00a0}~', '', $args['category_in'] ) ), 'strlen' );
    }

    /**
     * Tags In
     *
     * Strip all whitespace characters, explode to array, remove all indices where string length == 0
     */
    if ( !empty( $args['tags_in'] ) ) {
        $tag_IDs = array_filter( explode( ',', preg_replace( '~\x{00a0}~', '', $args['tags_in'] ) ), 'strlen' );
    }

    /**
     * Build the Query
     *
     */
    $query_args = array(
        'posts_per_page'    => $args['show_all'] == 'on' || !isset( $args['count'] ) ? -1 : intval( $args['count'] ),
        'post_type'         => !is_array( $post_types ) || empty( $post_types ) ? array( 'post' ) : $post_types,
        'post_status'       => 'publish',
        'order'             => $sort_direction
    );

    if ( is_array( $post_IDs ) && !empty( $post_IDs ) ) :
        $query_args['post__in'] = $post_IDs;
    endif;

    if ( !empty( $ordered_by ) ) :
        if ( $ordered_by == 'team_member_title' || $ordered_by == 'event_meta_date' ) {
            $query_args['orderby'] = 'meta_value';
            $query_args['meta_key'] = $ordered_by;
        } elseif (  $ordered_by == 'sc_member_order' || $ordered_by == 'sc_testimonial_order' || $ordered_by == 'sc_faq_order' || $ordered_by == 'sc_service_order' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = $ordered_by;
        } else {
            $query_args['orderby'] = $ordered_by;
        }
    endif;

    if ( !empty( $cat_IDs ) && is_array( $cat_IDs ) ) :
        $query_args['category__in'] = $cat_IDs;
    endif;

    if ( !empty( $tag_IDs ) && is_array( $tag_IDs ) ) :
        $query_args['tag__in'] = $tag_IDs;
    endif;

    return $query_args;

}

function determine_mobile_columns( $num_items ) {
    if ( $num_items == 3 ) {
        $col_sm_value = '4';
    } elseif ( $num_items == 4 || $num_items == 2 ) {
        $col_sm_value = '6';
    } else {
        $col_sm_value = '12';
    }
    return $col_sm_value;
}