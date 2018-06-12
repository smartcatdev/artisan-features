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
                    $('li#customize-control-navbar_banner_logo_alignment').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('zenith-hidden');
                    
                    // Hide
                    $('li#customize-control-style_a_right_align_menu').addClass('zenith-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('zenith-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('zenith-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('zenith-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('zenith-hidden');
                    
                } else if ( 'vertical' === value ) {
                    
                    // Show
                    $('li#customize-control-navbar_banner_menu_alignment').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_height').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').removeClass('zenith-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_background_style').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_background').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').addClass('zenith-hidden');
                    $('li#customize-control-navbar_bg_image').addClass('zenith-hidden');
                    $('li#customize-control-navbar_social_drawer_background').addClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_accent').addClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_rounded').addClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_fill').addClass('zenith-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('zenith-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('zenith-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('zenith-hidden');
                    $('li#customize-control-style_a_always_show_logo').addClass('zenith-hidden');
                    $('li#customize-control-style_a_logo_space').addClass('zenith-hidden');
                    $('li#customize-control-style_a_collapse_height').addClass('zenith-hidden');
                    $('li#customize-control-style_a_expand_height').addClass('zenith-hidden');
                    
                } else if ( 'slim_left' === value ) {
                    
                    // Slim Left Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_right_align_menu').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_boxed_navbar').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('zenith-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('zenith-hidden');
                    
                } else {
                    
                    // Slim Split Style
                    
                    // Show
                    $('li#customize-control-style_a_always_show_logo').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_logo_space').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_collapse_height').removeClass('zenith-hidden');
                    $('li#customize-control-style_a_expand_height').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_links_gap_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_accent').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_rounded').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_final_link_fill').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_background_style').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_background').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_foreground').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_bg_image').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_social_drawer_background').removeClass('zenith-hidden');
                    
                    // Hide
                    $('li#customize-control-navbar_banner_logo_alignment').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_menu_alignment').addClass('zenith-hidden');
                    $('li#customize-control-style_a_right_align_menu').addClass('zenith-hidden');
                    $('li#customize-control-style_a_boxed_navbar').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_transparent_menu_toggle').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_height').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_top_spacing_mbl').addClass('zenith-hidden');
                    $('li#customize-control-navbar_banner_logo_bottom_spacing_mbl').addClass('zenith-hidden');
                    
                }
                
            }
            
        });
        
        // Custom Logo
        customize( 'zenith_custom_header_height_percent', function ( value ) {
            
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
                    $('li#customize-control-zenith_custom_header_height_percent_mbl').addClass('zenith-hidden');
                } else {
//                    console.log("false");
                    $('li#customize-control-zenith_custom_header_height_percent_mbl').removeClass('zenith-hidden');
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
                    $('li#customize-control-navbar_social_drawer_background').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_social_link_foreground').removeClass('zenith-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-navbar_social_drawer_background').addClass('zenith-hidden');
                    $('li#customize-control-navbar_social_link_foreground').addClass('zenith-hidden');
                    $('li#customize-control-navbar_social_link_foreground_hover').addClass('zenith-hidden');
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
                    $('li#customize-control-standard_blog_appearance_style').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-standard_blog_appearance_style').addClass('zenith-hidden');
                }
                
                if ( value && value == 'blog_mosaic' ) {
                    $('li#customize-control-mosaic_blog_gap_spacing').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-mosaic_blog_gap_spacing').addClass('zenith-hidden');
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
                    $('li#customize-control-zenith_custom_header_logo_height').removeClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_logo_height_mbl').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-zenith_custom_header_logo_height').addClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_logo_height_mbl').addClass('zenith-hidden');
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
                    $('li#customize-control-custom_header_title_content').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_font_family').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_font_size').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_color').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_uppercase').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-custom_header_title_content').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_font_family').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_font_size').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_letter_spacing').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_color').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_title_uppercase').addClass('zenith-hidden');
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
                    $('li#customize-control-custom_header_menu_font_family').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_font_size').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_color').removeClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-custom_header_menu_font_family').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_font_size').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_letter_spacing').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_color').addClass('zenith-hidden');
                    $('li#customize-control-custom_header_menu_link_spacing').addClass('zenith-hidden');
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
                    $('li#customize-control-parallax_layers_single_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('zenith-hidden');
                } else if ( 'single' === value ) {
                    $('li#customize-control-parallax_layers_single_color').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').addClass('zenith-hidden');
                } else {
                    $('li#customize-control-parallax_layers_single_color').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_single_color_opacity').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_style').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_overall_opacity').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_linear_direction').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_start_color_opacity').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_gradient_end_color_opacity').removeClass('zenith-hidden');
                }
                
            }
            
        });
        
        // Custom Header - Height Units Toggle
        customize( 'zenith_custom_header_height_unit', function ( value ) {
            
            // Initial Load
            toggle( value.get() ); 
            
            // Value Change
            value.bind( function ( to ) {    
                toggle( to );
            });
            
            function toggle( value ) {
                
                if ( 'percent' === value ) {
                    $('li#customize-control-zenith_custom_header_height_pixels').addClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_pixels_mbl').addClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_percent').removeClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_percent_mbl').removeClass('zenith-hidden');
                } else {
                    $('li#customize-control-zenith_custom_header_height_percent').addClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_percent_mbl').addClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_pixels').removeClass('zenith-hidden');
                    $('li#customize-control-zenith_custom_header_height_pixels_mbl').removeClass('zenith-hidden');
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
                    $('li#customize-control-parallax_layers_texture_pattern').addClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').addClass('zenith-hidden');
                } else {
                    $('li#customize-control-parallax_layers_texture_pattern').removeClass('zenith-hidden');
                    $('li#customize-control-parallax_layers_texture_layer_opacity').removeClass('zenith-hidden');
                }
                
            }
            
        });
        
    });
    
})(jQuery);