(function ($) {

    wp.customize.bind('ready', function () {

        var customize = this

        // Navbar Style ( Split || Left Align )
        customize( 'navbar_style', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'banner' === value ) {
                    
                    // Banner Style
                    
                    // Show
                    $('li#customize-control-navbar_banner_logo_alignment').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('beyrouth-hidden');
                    
                    // Hide
                    $('li#customize-control-style_a_right_align_menu').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('beyrouth-hidden');
                    
                } else if ( 'vertical' === value ) {
                    
                    // Show
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('beyrouth-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_background_style').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_background').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_bg_image').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_drawer_background').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_accent').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_rounded').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_fill').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('beyrouth-hidden');
                    
                } else if ( 'slim_left' === value ) {
                    
                    // Slim Left Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_right_align_menu').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('beyrouth-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('beyrouth-hidden');
                    
                } else {
                    
                    // Slim Split Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('beyrouth-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('beyrouth-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('beyrouth-hidden');
                    
                }
                
            }
            
        });
        
        // Custom Logo
        customize( 'beyrouth_custom_header_height_percent', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
//                console.log(value + " fired");
                
                if ( parseInt(value) == 100 ) {
//                    console.log("true match");
                    $('li#customize-control-beyrouth_custom_header_height_percent_mbl').addClass('beyrouth-hidden');
                } else {
//                    console.log("false");
                    $('li#customize-control-beyrouth_custom_header_height_percent_mbl').removeClass('beyrouth-hidden');
                }
                
            }
            
        });

        // Navbar - Social Icon Toggle
        customize( 'navbar_show_social', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-navbar_social_drawer_background').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_link_foreground').removeClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-navbar_social_drawer_background').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_link_foreground').addClass('beyrouth-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').addClass('beyrouth-hidden');
                }
                
            }
            
        });

        // Blog Layout
        customize( 'blog_layout_style', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
//                console.log('BLOG LAYOUT ' + value);
                
                if ( value && value == 'blog_standard' ) {
                    $('li#customize-control-standard_blog_appearance_style').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-standard_blog_appearance_style').addClass('beyrouth-hidden');
                }
                
                if ( value && value == 'blog_mosaic' ) {
                    $('li#customize-control-mosaic_blog_gap_spacing').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-mosaic_blog_gap_spacing').addClass('beyrouth-hidden');
                }
                
            }
            
        });

        // Custom Header - Main Heading Toggle
        customize( 'custom_header_show_logo', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-beyrouth_custom_header_logo_height').removeClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_logo_height_mbl').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-beyrouth_custom_header_logo_height').addClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_logo_height_mbl').addClass('beyrouth-hidden');
                }
                
            }
            
        });

        // Custom Header - Main Heading Toggle
        customize( 'custom_header_show_heading', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-custom_header_title_content').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_font_family').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_font_size').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_color').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_uppercase').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-custom_header_title_content').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_font_family').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_font_size').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_color').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_title_uppercase').addClass('beyrouth-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Menu Toggle
        customize( 'custom_header_show_menu', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( value ) {
                    $('li#customize-control-custom_header_menu_font_family').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_font_size').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_color').removeClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-custom_header_menu_font_family').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_font_size').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_color').addClass('beyrouth-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').addClass('beyrouth-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Gradient Overlay
        customize( 'parallax_layers_include_color_layer', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'no' === value ) {
                    $('li#customize-control-parallax_layers_single_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('beyrouth-hidden');
                } else if ( 'single' === value ) {
                    $('li#customize-control-parallax_layers_single_color').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-parallax_layers_single_color').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').removeClass('beyrouth-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Height Units Toggle
        customize( 'beyrouth_custom_header_height_unit', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'percent' === value ) {
                    $('li#customize-control-beyrouth_custom_header_height_pixels').addClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_pixels_mbl').addClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_percent').removeClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_percent_mbl').removeClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-beyrouth_custom_header_height_percent').addClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_percent_mbl').addClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_pixels').removeClass('beyrouth-hidden');
                    $('li#customize-control-beyrouth_custom_header_height_pixels_mbl').removeClass('beyrouth-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Height Units Toggle
        customize( 'custom_header_style_toggle', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'parallax_vertical' === value ) {
                    $('li#customize-control-parallax_layers_texture_pattern').addClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').addClass('beyrouth-hidden');
                } else {
                    $('li#customize-control-parallax_layers_texture_pattern').removeClass('beyrouth-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').removeClass('beyrouth-hidden');
                }
                
            }
            
        });
        
    });
    
})(jQuery);