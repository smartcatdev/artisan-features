<?php namespace beyrouth; ?>

<div class="slide" style="background-image: url(<?php url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>);">

    <div class="post-panel-inner">

        <div class="vert-title <?php echo empty( $vertical_title ) || $vertical_title == 'on' ? 'actually-vertical' : ''; ?>">

            <h3 class="post-panel-title">
                <a href="<?php url( get_the_permalink() ); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <?php if ( $show_dates == 'on' ) : ?>
                
                <h4 class="post-panel-position">
            
                    <div class="blog-meta">

                        <span class="post-date">
                            <?php html( get_the_date( get_option( 'date_format' ) ) ); ?>
                        </span>
                        |
                        <span class="post-author">
                            <?php _e( 'by', 'beyrouth' ); ?> <?php the_author_posts_link(); ?>
                        </span>

                    </div>
            
                </h4>
            
            <?php endif; ?>

        </div>

    </div>

</div>