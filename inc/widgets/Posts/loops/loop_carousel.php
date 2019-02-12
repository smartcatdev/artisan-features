<?php namespace beyrouth; ?>

<div class="posts-template-carousel panel-slider arrowed-slider carousel-columns-<?php echo !empty( $values['max_visible_slides'] ) ? $values['max_visible_slides'] : 4; ?>">

    <script type="text/javascript">
        
        jQuery(document).ready(function ($) {

            $('#<?php \beyrouth\attr( $args['widget_id'] ); ?> .post-panels-wrapper').slick({
                infinite: true,
                dots: false,
                arrows: <?php echo empty( $values['arrows_toggle'] ) || $values['arrows_toggle'] == 'on' ? 'true' : 'false'; ?>,
                autoplay: <?php echo empty( $values['autoplay_toggle'] ) || $values['autoplay_toggle'] == 'on' ? 'true' : 'false'; ?>,
                speed: 1000,
                autoplaySpeed: <?php echo !empty( $values['autoplay_speed'] ) ? esc_js( $values['autoplay_speed'] ) : 4000; ?>,
                slidesToShow: <?php echo !empty( $values['max_visible_slides'] ) ? $values['max_visible_slides'] : 4; ?>,
                slidesToScroll: <?php echo !empty( $values['slide_scroll_num'] ) ? $values['slide_scroll_num'] : 4; ?>,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ],
                prevArrow: '<span class="slick-prev slick-arrow"><svg version="1.1" id="prevArrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 407.437 407.437" style="enable-background:new 0 0 407.437 407.437;" xml:space="preserve"><g><polygon points="203.718,84.507 386.258,266.453 407.437,245.205 203.718,42.15 0,245.205 21.179,266.453 	"/><polygon points="0,344.039 21.179,365.287 203.718,183.341 386.258,365.287 407.437,344.039 203.718,140.984 "/></g></svg></span>',
                nextArrow: '<span class="slick-next slick-arrow"><svg version="1.1" id="nextArrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 407.437 407.437" style="enable-background:new 0 0 407.437 407.437;" xml:space="preserve"><g><polygon points="203.718,84.507 386.258,266.453 407.437,245.205 203.718,42.15 0,245.205 21.179,266.453 	"/><polygon points="0,344.039 21.179,365.287 203.718,183.341 386.258,365.287 407.437,344.039 203.718,140.984 "/></g></svg></span>'
            });

        });

    </script>
    
    <div class="post-panels-wrapper">
        
        <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
        
            <?php render_template( 'Posts/partials/partial_carousel.php', $values ); ?>    

        <?php endwhile; ?>

    </div>
        
</div>