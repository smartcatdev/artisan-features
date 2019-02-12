<?php 
namespace beyrouth;

$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
    'padding'           => $values['padding'] . 'px 0 ' . $values['padding'] . 'px 0',
);

$this->css['#'. $args['widget_id'] . ' h2'] = array(
    'color'             => $values['text_color'],
    'text-align'        => $values['text_align'],
);

$this->css['#'. $args['widget_id'] . ' h6'] = array(
    'color'             => $values['text_color'],
    'text-align'        => $values['text_align'],
);

$this->css['#'. $args['widget_id'] . ' .posts-template-carousel .slide'] = array(
    'height'            => $values['carousel_height'] . 'px',
);

$this->css['#'. $args['widget_id'] . ' .featured-inner'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .featured-inner .blog-meta'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .featured-inner h4 a'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .posts-template-carousel .slide .vert-title'] = array(
    'color'             => $values['overlay_text_color'],
);

$this->css['#'. $args['widget_id'] . ' .posts-template-carousel div.vert-title .post-panel-position'] = array(
    'color'             => $values['overlay_text_color'],
);

$this->css['#'. $args['widget_id'] . ' .posts-template-carousel .slide .vert-title a'] = array(
    'color'             => $values['overlay_text_color'],
);

$this->css['#'. $args['widget_id'] . ' .posts-template-carousel .slide .vert-title.actually-vertical'] = array(
    'width'             => $values['carousel_height'] - 80 . 'px',
);

?>

<div class="beyrouth-module posts-query" id="<?php \beyrouth\attr( $args['widget_id' ] ); ?>">
    
    <?php if( $values['title'] || $values['subtitle'] ) : ?>
    
        <div class="container">

            <div class="row">

                <div class="col-sm-12">

                    <?php if( $values['title'] ) : ?>
                        <h2 class="title"><?php \beyrouth\attr( $values['title'] ); ?></h2>
                    <?php endif; ?>

                    <?php if( $values['subtitle'] ) : ?>
                        <h6 class="subtitle"><?php \beyrouth\html( $values['subtitle'] ); ?></h6>
                    <?php endif; ?>

                </div>

            </div>

        </div>
    
    <?php endif; ?>
          
    <?php

    $query_args = get_custom_query_args( array(
        'posts'             => $values['posts'],
        'post_types'        => $values['post_types'],
        'ordered_by'        => $values['ordered_by'],
        'sort_direction'    => $values['sort_direction'],
        'category_in'       => $values['category_in'],
        'tags_in'           => $values['tags_in'],
        'show_all'          => $values['show_all'],
        'count'             => $values['count'],
    ) );

    $posts_query = new \WP_Query($query_args); 

    if ( $posts_query->have_posts() ) : ?>

        <?php 
        switch ( $values['template'] ) :

            case 'cards' :
                include get_plugin_path( 'inc/widgets/Posts/loops/loop_cards.php' );
                break;
            case 'carousel' :
                include get_plugin_path( 'inc/widgets/Posts/loops/loop_carousel.php' );
                break;
            default :
                include get_plugin_path( 'inc/widgets/Posts/loops/loop_cards.php' );

        endswitch;
        ?>

    <?php endif; ?>
                
</div>