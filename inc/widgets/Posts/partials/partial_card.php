<?php namespace beyrouth; ?>

<div class="featured-post-page <?php echo has_post_thumbnail() ? '' : 'no-image'; ?>">
    
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php url( get_the_permalink() ); ?>">
            <div class="featured-image-wrap" style="background-image: url(<?php url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>);">
            </div>
        </a>
    <?php endif; ?>
    
    <div class="featured-inner">

        <?php if ( get_the_title() ) : ?>
            <h4>
                <a href="<?php url( get_the_permalink() ); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
        <?php endif; ?>

        <?php if ( get_the_excerpt() ) : ?>
            <p>
                <?php the_excerpt(); ?>
            </p>
        <?php endif; ?>
        
        <?php if ( $show_dates == 'on' ) : ?>
            
            <div class="blog-meta">

                <span class="post-date">
                    <?php html( get_the_date( get_option( 'date_format' ) ) ); ?>
                </span>
                |
                <span class="post-author">
                    <?php _e( 'by', 'beyrouth' ); ?> <?php the_author_posts_link(); ?>
                </span>

            </div>
            
        <?php endif; ?>

    </div>

</div>