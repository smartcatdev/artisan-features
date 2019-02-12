<?php 
namespace beyrouth;

$this->css['#' . $args['widget_id'] ] = array(
    'background-color'  => $values['bg_color'],
);

if ( !empty( $values['use_gradient'] ) && $values['use_gradient'] == 'on' ) : 

    $this->css['#' . $args['widget_id'] . ' .hero-inner' ] = array(
        'background'    => 'linear-gradient(180deg, ' . beyrouth_hex2rgba( $values['gradient_start_color'], $values['overlay_opacity'] ) . ' 0%, ' . beyrouth_hex2rgba( $values['gradient_end_color'], $values['overlay_opacity'] ) . ' 100%)',
        'padding'       => $values['padding'] . 'px 0px',
    );
    
else :
    
    $this->css['#' . $args['widget_id'] . ' .hero-inner' ] = array(
        'background'    => beyrouth_hex2rgba( $values['single_overlay_color'], $values['overlay_opacity'] ),
        'padding'       => $values['padding'] . 'px 0px',
    );

endif;

$this->css['#'. $args['widget_id'] . ' div.hero-content'] = array(
    'text-align'        => $values['content_alignment'],
);

$this->css['#'. $args['widget_id'] . ' h2.hero-title'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .pre-title'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' p.content'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .feature-wrap .feature-label'] = array(
    'color'             => $values['text_color'],
);

$this->css['#'. $args['widget_id'] . ' .feature-wrap .feature-icon'] = array(
    'color'             => $values['icon_color'],
);

?>

<div class="beyrouth-module features-hero" style="background-image: url(<?php \beyrouth\url( $values['background_image'] ); ?>);" id="<?php \beyrouth\attr( $args['widget_id' ] ); ?>">

    <div class="hero-inner template-<?php \beyrouth\attr( $values['template_style'] ); ?>">

        <div class="container">

            <div class="row">
                
                <div class="col-sm-12">

                    <?php 
                    if ( $values['template_style'] == 'stacked' ) : 
                        render_template( 'Features_Hero/partials/partial_hero_stacked.php', $values );
                    elseif ( $values['template_style'] == 'right' ) :
                        render_template( 'Features_Hero/partials/partial_hero_right.php', $values );
                    else :
                        render_template( 'Features_Hero/partials/partial_hero_left.php', $values );
                    endif;
                    ?>    
                    
                </div>

            </div>
            
        </div>
        
    </div>
    
</div>