<?php namespace beyrouth; ?>

<div class="hero-flex-wrap">
    
    <div class="hero-flex image">

        <div class="features">

            <?php if ( !empty( $feature_1_title ) || !empty( $feature_1_icon ) ) : ?>

                <div class="feature-wrap">

                    <div class="feature">

                        <?php if ( !empty( $feature_1_icon ) ) : ?>

                            <?php if ( !empty( $feature_1_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_1_link ); ?>" <?php echo !empty( $feature_1_target ) && $feature_1_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <span class="feature-icon <?php echo esc_attr( $feature_1_icon ); ?> wow fadeInUp"></span>

                            <?php if ( !empty( $feature_1_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty( $feature_1_title ) ) : ?>

                            <?php if ( !empty( $feature_1_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_1_link ); ?>" <?php echo !empty( $feature_1_target ) && $feature_1_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <p class="feature-label wow fadeInUp">
                                    <?php echo esc_html( $feature_1_title ); ?>
                                </p>

                            <?php if ( !empty( $feature_1_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>
            <?php if ( !empty( $feature_2_title ) || !empty( $feature_2_icon ) ) : ?>

                <div class="feature-wrap">

                    <div class="feature">

                        <?php if ( !empty( $feature_2_icon ) ) : ?>

                            <?php if ( !empty( $feature_2_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_2_link ); ?>" <?php echo !empty( $feature_2_target ) && $feature_2_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <span class="feature-icon <?php echo esc_attr( $feature_2_icon ); ?> wow fadeInUp"></span>

                            <?php if ( !empty( $feature_2_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty( $feature_2_title ) ) : ?>

                            <?php if ( !empty( $feature_2_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_2_link ); ?>" <?php echo !empty( $feature_2_target ) && $feature_2_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <p class="feature-label wow fadeInUp">
                                    <?php echo esc_html( $feature_2_title ); ?>
                                </p>

                            <?php if ( !empty( $feature_2_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>
            <?php if ( !empty( $feature_3_title ) || !empty( $feature_3_icon ) ) : ?>

                <div class="feature-wrap">

                    <div class="feature">

                        <?php if ( !empty( $feature_3_icon ) ) : ?>

                            <?php if ( !empty( $feature_3_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_3_link ); ?>" <?php echo !empty( $feature_3_target ) && $feature_3_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <span class="feature-icon <?php echo esc_attr( $feature_3_icon ); ?> wow fadeInUp"></span>

                            <?php if ( !empty( $feature_3_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ( !empty( $feature_3_title ) ) : ?>

                            <?php if ( !empty( $feature_3_link ) ) : ?>
                                <a href="<?php echo esc_url( $feature_3_link ); ?>" <?php echo !empty( $feature_3_target ) && $feature_3_target == 'new' ? 'target="_BLANK"' : ''; ?>>
                            <?php endif; ?>

                                <p class="feature-label wow fadeInUp">
                                    <?php echo esc_html( $feature_3_title ); ?>
                                </p>

                            <?php if ( !empty( $feature_3_link ) ) : ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>
    
    <div class="hero-flex hero-content">
        
        <?php if( !empty( $pre_title ) ) : ?>
            <span class="pre-title">
                <?php html( $pre_title ); ?>
            </span>
        <?php endif; ?>

        <?php if( !empty( $title ) ) : ?>
            <h2 class="hero-title">
                <?php html( $title ); ?>
            </h2>
        <?php endif; ?>

        <?php if( !empty( $content ) ) : ?>
            <p class="content">
                <?php html( $content ); ?>
            </p>
        <?php endif; ?>

        <?php button( $button_1_label, $button_1_url, $button_1_style, $button_1_size, $button_1_target ); ?>
        <?php button( $button_2_label, $button_2_url, $button_2_style, $button_2_size, $button_2_target ); ?>
            
    </div>

</div>
