<?php namespace beyrouth; ?>

<?php $clear_ctr = 0; ?>
<?php $ctr = $values['columns']; ?>

<div class="container">
    
    <div class="row">
        
        <div class="posts-template-cards columns-<?php \beyrouth\attr( $ctr ); ?>">

            <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

                <div class="col-md-<?php \beyrouth\attr( 12 / $ctr ); ?> col-sm-<?php \beyrouth\attr( determine_mobile_columns( $ctr ) ); ?>">

                    <?php render_template( 'Posts/partials/partial_card.php', $values ); ?>    

                </div>

                <?php $clear_ctr++; ?>

                <?php if ( $clear_ctr != 0 && $ctr != 3 && $clear_ctr % 4 == 0 ) : ?>
                    <div class="clear"></div>
                <?php elseif ( $clear_ctr != 0 && $ctr != 3 && $clear_ctr % 2 == 0 ) : ?>
                    <div class="clear-tablet"></div>
                <?php elseif ( $clear_ctr != 0 && $ctr == 3 && $clear_ctr % 3 == 0 ) : ?>
                    <div class="clear"></div>
                <?php endif; ?>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div>
    
    </div>
    
</div>
