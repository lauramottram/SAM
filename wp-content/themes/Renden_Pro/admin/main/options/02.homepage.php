<?php
/**
 * Homepage functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	ENABLE SLIDER - HOMEPAGE & INNER-PAGES
---------------------------------------------------------------------------------- */

// Add full width slider class to body
function thinkup_input_sliderclass($classes){
global $thinkup_homepage_sliderswitch;
global $thinkup_homepage_sliderpresetwidth;

global $post;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}
	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sliderswitch ) or $thinkup_homepage_sliderswitch == 'option1' ) {
			if ( empty( $thinkup_homepage_sliderpresetwidth ) or $thinkup_homepage_sliderpresetwidth == '1' ) {
				$classes[] = 'slider-full';
			} else {
				$classes[] = 'slider-boxed';
			}
		}
	} else if ( ! is_front_page() and !is_archive() and !thinkup_check_isblog() and $_thinkup_meta_slider == 'on' ) {
		if ( is_array( $_thinkup_meta_sliderpage ) ) {
			if ( $_thinkup_meta_sliderpage['full_width'] == 'on' ) {
				$classes[] = 'slider-full';
			} else {
				$classes[] = 'slider-boxed';
			}
		}
	}
	return $classes;
}
add_action( 'body_class', 'thinkup_input_sliderclass');

// Output jQuery for video backgrounds
function thinkup_input_slidervideojs() {
global $thinkup_homepage_sliderpreset;
global $thinkup_homepage_sliderstyle;

global $post;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_slidername = get_post_meta( $post->ID, '_thinkup_meta_slidername', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}

	$count = 0;

	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sliderstyle ) or $thinkup_homepage_sliderstyle == 'option1' ) {

			if ( isset($thinkup_homepage_sliderpreset) and is_array($thinkup_homepage_sliderpreset) ) {

			foreach ($thinkup_homepage_sliderpreset as $slide) {
				if ( ! empty( $slide['slide_video'] ) ) {

				// Reset slide url variable values
				$slide_video      = NULL;
				$slide_video_mp4  = NULL;
				$slide_video_ogv  = NULL;
				$slide_video_webm = NULL;
				$slide_video_jpg  = NULL;
				
				// Remove suffix for url's
				$slide_video = $slide['slide_video'];
				$slide_video = str_replace( '.mp4',  '', $slide_video );
				$slide_video = str_replace( '.ogv',  '', $slide_video );
				$slide_video = str_replace( '.webm', '', $slide_video );
				$slide_video = str_replace( '.jpg',  '', $slide_video );
				
				// Assign suffix for url's
				$slide_video_mp4  = $slide_video . '.mp4';
				$slide_video_ogv  = $slide_video . '.ogv';
				$slide_video_webm = $slide_video . '.webm';
				$slide_video_jpg  = $slide_video . '.jpg';
				
					$output .= '$("#slider #rslides1_s' . $count . '").videoBG({' . "\n";
					$output .= 'mp4:"' . $slide_video_mp4 . '",' . "\n";
					$output .= 'ogv:"' . $slide_video_ogv . '",' . "\n";
					$output .= 'webm:"' . $slide_video_webm . '",' . "\n";
					$output .= 'poster:"' . $slide_video_jpg . '",' . "\n";
					$output .= 'scale:true,' . "\n";
					$output .= 'loop:true,' . "\n";
					$output .= 'opacity: 1,' . "\n";
					$output .= 'zIndex:0,' . "\n";
					$output .= '});' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).css({ opacity: 1 });' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).removeClass();' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).removeAttr( "id" );' . "\n";
				}
				$count++;
			}
			}
		}
	} else if ( ! is_front_page() and !is_archive() and !thinkup_check_isblog() and $_thinkup_meta_slider == 'on' ) {

		if ( empty( $_thinkup_meta_sliderpage['style'] ) or $_thinkup_meta_sliderpage['style'] == 'option1' ) {

		if ( isset($_thinkup_meta_sliderpage['image']) and is_array($_thinkup_meta_sliderpage['image']) ) {
		
			foreach ( $_thinkup_meta_sliderpage['image'] as $slide => $list) {

				if ( ! empty( $_thinkup_meta_sliderpage['video'][ $count ] ) ) {

				// Reset slide url variable values
				$slide_video      = NULL;
				$slide_video_mp4  = NULL;
				$slide_video_ogv  = NULL;
				$slide_video_webm = NULL;
				$slide_video_jpg  = NULL;

				// Remove suffix for url's
				$slide_video = $_thinkup_meta_sliderpage['video'][ $count ];
				$slide_video = str_replace( '.mp4',  '', $slide_video );
				$slide_video = str_replace( '.ogv',  '', $slide_video );
				$slide_video = str_replace( '.webm', '', $slide_video );
				$slide_video = str_replace( '.jpg',  '', $slide_video );
				
				// Assign suffix for url's
				$slide_video_mp4  = $slide_video . '.mp4';
				$slide_video_ogv  = $slide_video . '.ogv';
				$slide_video_webm = $slide_video . '.webm';
				$slide_video_jpg  = $slide_video . '.jpg';
				
					$output .= '$("#slider #rslides1_s' . $count . '").videoBG({' . "\n";
					$output .= 'mp4:"' . $slide_video_mp4 . '",' . "\n";
					$output .= 'ogv:"' . $slide_video_ogv . '",' . "\n";
					$output .= 'webm:"' . $slide_video_webm . '",' . "\n";
					$output .= 'poster:"' . $slide_video_jpg . '",' . "\n";
					$output .= 'scale:true,' . "\n";
					$output .= 'loop:true,' . "\n";
					$output .= 'opacity: 1,' . "\n";
					$output .= 'zIndex:0,' . "\n";
					$output .= '});' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).css({ opacity: 1 });' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).removeClass();' . "\n";
					$output .= '$( "#slider #rslides1_s' . $count . '" ).find( "#rslides1_s' . $count . '" ).removeAttr( "id" );' . "\n";
				}
				$count++;
			}
			}
		}
	}
	
	// Output video js if required
	if ( ! empty( $output ) ) {
		echo '<script>(function ( $ ) { $(window).load(function() {' . $output . '}) }( jQuery ));</script>';
	}
}
add_action( 'wp_footer','thinkup_input_slidervideojs', '13' );


/* ----------------------------------------------------------------------------------
	ENABLE HOMEPAGE SLIDER
---------------------------------------------------------------------------------- */

// Content for slider layout - Standard
function thinkup_input_sliderhomestandard() {
global $thinkup_homepage_sliderpreset;

	foreach ($thinkup_homepage_sliderpreset as $slide) {

		// Get url of background image or set video overlay image
		if ( ! empty( $slide['slide_video'] ) ) {
			$slide_image = 'background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/overlay.png' . ') repeat center;';
		} else {
			$slide_image = 'background: url(' . $slide['slide_image_url'] . ') no-repeat center; background-size: cover;';
		}

		// Get additional style classes if set by user
		if ( ! empty( $slide['slide_class'] ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide['slide_class'] );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide['slide_url'] ) and empty( $slide['slide_button'] ) ) {
			$slide_link_start = '<a href="' . $slide['slide_url'] . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		// Used for slider image alt text
		if ( ! empty( $slide['slide_title'] ) ) {
			$slide_alt = $slide['slide_title'];
		} else {
			$slide_alt = __( 'Slider Image', 'renden' );
		}

		echo '<li>',
			 '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . esc_attr( $slide_image ) . '" alt="' . esc_attr( $slide_alt ) . '" />',
			 '<div class="rslides-content' . $slide_class .'">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">',
			 '<div class="featured">';

			if ( ! empty( $slide['slide_title'] ) ) {

				// Wrap text in <span> tags
				$slide['slide_title'] = '<span>' . $slide['slide_title'] . '</span>';
				$slide['slide_title'] = str_replace( '<br />', '</span><br /><span>', $slide['slide_title'] );
				$slide['slide_title'] = str_replace( '<br/>', '</span><br/><span>', $slide['slide_title'] );

				echo '<div class="featured-title">',
					 $slide['slide_title'],
					 '</div>';
			}
			if ( ! empty( $slide['slide_description'] ) ) {
				$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide['slide_description'] ));
				$slide_description = str_replace( '</p>', '</span></p>', $slide_description );

				// Wrap text in <span> tags
				$slide_description = str_replace( '<br />', '</span><br /><span>', $slide_description );
				$slide_description = str_replace( '<br/>', '</span><br/><span>', $slide_description );

				echo '<div class="featured-excerpt">',
					 $slide_description,
					 '</div>';
			}
			if ( ! empty( $slide['slide_url'] ) and ! empty( $slide['slide_button'] ) ) {

				echo '<div class="featured-link">',
					 '<a href="' . $slide['slide_url'] . '"><span>' . $slide['slide_button'] . '</span></a>',
					 '</div>';
			}

			// Input slider icon with slider style3 class - Experon specific!
			if ( strpos( $slide_class, 'style3' ) !== false ) {
				echo '<div class="featured-icon"><a href="#thinkupslider-after"><i class="fa fa-angle-down"></i></a></div>';
			}

		echo '</div>',
			  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	}
}

// Content for slider layout - Video Left & Video Right
function thinkup_input_sliderhomevideo() {
global $thinkup_homepage_sliderpreset;
global $thinkup_homepage_sliderstyle;
global $wp_embed;

	if ( $thinkup_homepage_sliderstyle == 'option2' ) {
		$thinkup_classvideo = ' one_half';
		$thinkup_classtext  = ' one_half last';
	} else if ( $thinkup_homepage_sliderstyle == 'option3' ) {
		$thinkup_classvideo = ' one_half last';
		$thinkup_classtext  = ' one_half';
	}

	foreach ($thinkup_homepage_sliderpreset as $slide) {
	$output_text  = NULL;
	$output_video = NULL;

	$output_text .= '<div class="featured' . $thinkup_classtext . '">';
		if ( ! empty( $slide['slide_title'] ) ) {

			// Wrap text in <span> tags
			$slide['slide_title'] = '<span>' . $slide['slide_title'] . '</span>';
			$slide['slide_title'] = str_replace( '<br />', '</span><br /><span>', $slide['slide_title'] );
			$slide['slide_title'] = str_replace( '<br/>', '</span><br/><span>', $slide['slide_title'] );

			$output_text .= '<div class="featured-title">';
			$output_text .= $slide['slide_title'];
			$output_text .= '</div>';
			}
		if ( ! empty( $slide['slide_description'] ) ) {
			$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide['slide_description'] ));
			$slide_description = str_replace( '</p>', '</span></p>', $slide_description );

			// Wrap text in <span> tags
			$slide_description = str_replace( '<br />', '</span><br /><span>', $slide_description );
			$slide_description = str_replace( '<br/>', '</span><br/><span>', $slide_description );

			$output_text .= '<div class="featured-excerpt">' . $slide_description . '</div>';
			}
		if ( ! empty( $slide['slide_url'] ) and ! empty( $slide['slide_button'] ) ) {
			$output_text .= '<div class="featured-link">';
			$output_text .= '<a href="' . $slide['slide_url'] . '"><span>' . $slide['slide_button'] . '</span></a>';
			$output_text .= '</div>';
		}
	$output_text .= '</div>';

	$output_video .= '<div class="featured-video' . $thinkup_classvideo . '">';
		// Determing whether video is YouTube, Vimeo or html.
		if ( strpos( $slide['slide_video'], 'youtube.com' ) !== false or strpos( $slide['slide_video'], 'vimeo.com' ) !== false ) {
			$output_video .= $wp_embed->run_shortcode('[embed]' . $slide['slide_video'] . '[/embed]');
		} else {
			$output_video .= do_shortcode('[video src="' . $slide['slide_video'] . '"]');
		}
	$output_video .= '</div>';

		// Get url of background image
		$slide_image = 'background: url(' . $slide['slide_image_url'] . ') no-repeat center; background-size: cover;';

		// Get additional style classes if set by user
		if ( ! empty( $slide['slide_class'] ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide['slide_class'] );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide['slide_url'] ) and empty( $slide['slide_button'] ) ) {
			$slide_link_start = '<a href="' . $slide['slide_url'] . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		// Used for slider image alt text
		if ( ! empty( $slide['slide_title'] ) ) {
			$slide_alt = $slide['slide_title'];
		} else {
			$slide_alt = __( 'Slider Image', 'renden' );
		}

		echo '<li>',
			 '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . esc_attr( $slide_image ) . '" alt="' . esc_attr( $slide_alt ) . '" />',
			 '<div class="rslides-content' . $slide_class . '">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">';
			 
			if ( $thinkup_homepage_sliderstyle == 'option2' ) {
				echo $output_video;
				echo $output_text;
			} else if ( $thinkup_homepage_sliderstyle == 'option3' ) {
				echo $output_text;
				echo $output_video;
			}

		echo  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	}
}

// Add Slider - Homepage
function thinkup_input_sliderhome() {
global $thinkup_homepage_sliderswitch;
global $thinkup_homepage_slidername;
global $thinkup_homepage_sliderpreset;
global $thinkup_homepage_sliderspeed;
global $thinkup_homepage_sliderstyle;

$thinkup_class_fullwidth = NULL;
$thinkup_class_style     = NULL;
$slide_image             = NULL;
$slider_toggle           = NULL;

	if ( is_front_page() ) {

		// Check if any slides have been assigned to ThinkUpSlider
		if ( isset( $thinkup_homepage_sliderpreset ) and is_array( $thinkup_homepage_sliderpreset ) ) {
			foreach( $thinkup_homepage_sliderpreset as $slide ) {
				$slide_image_url = $slide['slide_image_url'];
				if( ! empty( $slide_image_url ) ) {
					$slider_toggle = '1';	
				}
			}
		}

		// Set slider speed data attribute
		if ( empty( $thinkup_homepage_sliderspeed ) ) {
			$thinkup_homepage_sliderspeed = 'off';
		} else {
			$thinkup_homepage_sliderspeed = $thinkup_homepage_sliderspeed * 1000;
		}

		$thinkup_data_speed = ' data-speed="' . $thinkup_homepage_sliderspeed . '"';

		// Set slider style class
		if ( empty( $thinkup_homepage_sliderstyle ) or $thinkup_homepage_sliderstyle == 'option1' ) {
			$thinkup_class_style = ' class="style1"';
		} else if ( $thinkup_homepage_sliderstyle == 'option2' ) {
			$thinkup_class_style = ' class="style2"';
		} else if ( $thinkup_homepage_sliderstyle == 'option3' ) {
			$thinkup_class_style = ' class="style3"';
		}

		if ( empty( $thinkup_homepage_sliderswitch ) or $thinkup_homepage_sliderswitch == 'option1' ) {

			echo '<div id="slider"' . $thinkup_class_style . '><div id="slider-core">',
			     '<div class="rslides-container"' . $thinkup_data_speed . '><div class="rslides-inner"><ul class="slides">';
				if ( empty( $slider_toggle ) ) {				 
					echo '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
					echo '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
					echo '<li><img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png) no-repeat center; background-size: cover;" alt="Demo Image" /></li>';
				} else if (isset($thinkup_homepage_sliderpreset) && is_array($thinkup_homepage_sliderpreset)) {
					// Input slider content for specified stlyle
					if ( empty( $thinkup_homepage_sliderstyle ) or $thinkup_homepage_sliderstyle == 'option1' ) {
						thinkup_input_sliderhomestandard();
					} else if ( $thinkup_homepage_sliderstyle == 'option2' or $thinkup_homepage_sliderstyle == 'option3' ) {
						thinkup_input_sliderhomevideo();
					}
				}
			echo '</ul></div></div>',
			     '</div></div>';

		} else if ( $thinkup_homepage_sliderswitch !== 'option2' or empty( $thinkup_homepage_slidername ) ) {
			echo '';
		} else {
			echo	'<div id="slider"><div id="slider-core">',
				do_shortcode( $thinkup_homepage_slidername ),
				'</div></div>';
		}
	}
}

// Add ThinkUpSlider Height - Homepage
function thinkup_input_sliderhomeheight() {
global $thinkup_homepage_sliderswitch;
global $thinkup_homepage_sliderpresetheight;

	if ( empty( $thinkup_homepage_sliderpresetheight ) ) $thinkup_homepage_sliderpresetheight = '350';

	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sliderswitch ) or $thinkup_homepage_sliderswitch == 'option1' ) {
		echo 	"\n" .'<style type="text/css">' . "\n",
			'#slider .rslides, #slider .rslides li { height: ' . $thinkup_homepage_sliderpresetheight . 'px; max-height: ' . $thinkup_homepage_sliderpresetheight . 'px; }' . "\n",
			'#slider .rslides img { height: 100%; max-height: ' . $thinkup_homepage_sliderpresetheight . 'px; }' . "\n",
			'</style>' . "\n";
		}
	}
}
add_action( 'wp_head','thinkup_input_sliderhomeheight', '13' );


/* ----------------------------------------------------------------------------------
	ENABLE INNER-PAGES SLIDER
---------------------------------------------------------------------------------- */

// Content for slider layout - Standard
function thinkup_input_sliderpagestandard() {
global $post;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_slidername = get_post_meta( $post->ID, '_thinkup_meta_slidername', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}

	$count = 0;

	foreach ( $_thinkup_meta_sliderpage['image'] as $slide => $list) {

		$slide_id          = $_thinkup_meta_sliderpage['image'][ $count ];
		$slide_video       = $_thinkup_meta_sliderpage['video'][ $count ];
		$slide_title       = $_thinkup_meta_sliderpage['title'][ $count ];
		$slide_description = $_thinkup_meta_sliderpage['description'][ $count ];
		$slide_button      = $_thinkup_meta_sliderpage['button'][ $count ];
		$slide_link        = $_thinkup_meta_sliderpage['link'][ $count ];
		$slide_class       = $_thinkup_meta_sliderpage['class'][ $count ];

		$slide_img = wp_get_attachment_url( $slide_id, true );

		// Get url of background image or set video overlay image
		if ( ! empty( $slide_video ) ) {
			$slide_image = 'background: url(' . esc_url( get_template_directory_uri() ) . '/images/slideshow/overlay.png' . ') repeat center;';
		} else {
			$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';
		}

		// Get additional style classes if set by user
		if ( ! empty( $slide_class ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide_class );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide_link ) and empty( $slide_button ) ) {
			$slide_link_start = '<a href="' . $slide_link . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		// Used for slider image alt text
		if ( ! empty( $slide_title ) ) {
			$slide_alt = $slide_title;
		} else {
			$slide_alt = __( 'Slider Image', 'renden' );
		}

		echo '<li>',
			 '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . esc_attr( $slide_image ) . '" alt="' . esc_attr( $slide_alt ) . '" />',
			 '<div class="rslides-content' . $slide_class . '">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">',
			 '<div class="featured">';

			if ( ! empty( $slide_title ) ) {

				// Wrap text in <span> tags
				$slide_title = '<span>' . $slide_title . '</span>';
				$slide_title = str_replace( '<br />', '</span><br /><span>', $slide_title );
				$slide_title = str_replace( '<br/>', '</span><br/><span>', $slide_title );

				echo '<div class="featured-title">',
					 $slide_title,
					 '</div>';
			}
			if ( ! empty( $slide_description ) ) {
				$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide_description ));
				$slide_description = str_replace( '</p>', '</span></p>', $slide_description );

				// Wrap text in <span> tags
				$slide_description = str_replace( '<br />', '</span><br /><span>', $slide_description );
				$slide_description = str_replace( '<br/>', '</span><br/><span>', $slide_description );

				echo '<div class="featured-excerpt">',
					 $slide_description,
					 '</div>';
			}
			if ( ! empty( $slide_link ) and ! empty( $slide_button ) ) {

				echo '<div class="featured-link">',
					 '<a href="' . $slide_link . '"><span>' . $slide_button . '</span></a>',
					 '</div>';
			}

			// Input slider icon with slider style3 class - Experon specific!
			if ( strpos( $slide_class, 'style3' ) !== false ) {
				echo '<div class="featured-icon"><a href="#thinkupslider-after"><i class="fa fa-angle-down"></i></a></div>';
			}

		echo '</div>',
			  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	$count++;
	}
}

// Content for slider layout - Video Left & Video Right
function thinkup_input_sliderpagevideo() {
global $post;
global $wp_embed;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_slidername = get_post_meta( $post->ID, '_thinkup_meta_slidername', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}

	$thinkup_classvideo = NULL;
	$thinkup_classtext  = NULL;
		
	if ( $_thinkup_meta_sliderpage['style'] == 'option2' ) {
		$thinkup_classvideo = ' one_half';
		$thinkup_classtext  = ' one_half last';
	} else if ( $_thinkup_meta_sliderpage['style'] == 'option3' ) {
		$thinkup_classvideo = ' one_half last';
		$thinkup_classtext  = ' one_half';
	}

	$count = 0;

	foreach ( $_thinkup_meta_sliderpage['image'] as $slide => $list) {

		$output_text  = NULL;
		$output_video = NULL;

		$slide_id          = $_thinkup_meta_sliderpage['image'][ $count ];
		$slide_video       = $_thinkup_meta_sliderpage['video'][ $count ];
		$slide_title       = $_thinkup_meta_sliderpage['title'][ $count ];
		$slide_description = $_thinkup_meta_sliderpage['description'][ $count ];
		$slide_button      = $_thinkup_meta_sliderpage['button'][ $count ];
		$slide_link        = $_thinkup_meta_sliderpage['link'][ $count ];
		$slide_class       = $_thinkup_meta_sliderpage['class'][ $count ];

		$slide_img = wp_get_attachment_url( $slide_id, true );

		$output_text .= '<div class="featured' . $thinkup_classtext . '">';

		if ( ! empty( $slide_title ) ) {

			// Wrap text in <span> tags
			$slide_title = '<span>' . $slide_title . '</span>';
			$slide_title = str_replace( '<br />', '</span><br /><span>', $slide_title );
			$slide_title = str_replace( '<br/>', '</span><br/><span>', $slide_title );

			$output_text .= '<div class="featured-title">';
			$output_text .= $slide_title;
			$output_text .= '</div>';
			}
		if ( ! empty( $slide_description ) ) {
			$slide_description = str_replace( '<p>', '<p><span>', wpautop( $slide_description ));
			$slide_description = str_replace( '</p>', '</span></p>', $slide_description );

			// Wrap text in <span> tags
			$slide_description = str_replace( '<br />', '</span><br /><span>', $slide_description );
			$slide_description = str_replace( '<br/>', '</span><br/><span>', $slide_description );

			$output_text .= '<div class="featured-excerpt">' . $slide_description . '</div>';
		}
		if ( ! empty( $slide_link ) and ! empty( $slide_button ) ) {
			$output_text .= '<div class="featured-link">';
			$output_text .= '<a href="' . $slide_link . '"><span>' . $slide_button . '</span></a>';
			$output_text .= '</div>';
		}
	$output_text .= '</div>';

	$output_video .= '<div class="featured-video' . $thinkup_classvideo . '">';
		// Determing whether video is YouTube, Vimeo or html.
		if ( strpos( $slide_video, 'youtube.com' ) !== false or strpos( $slide_video, 'vimeo.com' ) !== false ) {
			$output_video .= $wp_embed->run_shortcode('[embed]' . $slide_video . '[/embed]');
		} else {
			$output_video .= do_shortcode('[video src="' . $slide_video . '"]');
		}
	$output_video .= '</div>';

		// Get url of background image
		$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';

		// Get additional style classes if set by user
		if ( ! empty( $slide_class ) ) {
			$slide_class = ' ' . str_replace( ',', ' ', $slide_class );
		} else {
			$slide_class = NULL;		
		}

		// Determine whether to link slide or add button or no link
		if ( ! empty( $slide_link ) and empty( $slide_button ) ) {
			$slide_link_start = '<a href="' . $slide_link . '">';
			$slide_link_end   = '</a>';
		} else {
			$slide_link_start = NULL;
			$slide_link_end   = NULL;
		}

		// Used for slider image alt text
		if ( ! empty( $slide_title ) ) {
			$slide_alt = $slide_title;
		} else {
			$slide_alt = __( 'Slider Image', 'renden' );
		}

		echo '<li>',
			 '<img src="' . esc_url( get_template_directory_uri() ) . '/images/transparent.png" style="' . esc_attr( $slide_image ) . '" alt="' . esc_attr( $slide_alt ) . '" />',
			 '<div class="rslides-content' . $slide_class . '">',
			 $slide_link_start,
			 '<div class="wrap-safari">',
			 '<div class="rslides-content-inner">';
			 
			if ( $_thinkup_meta_sliderpage['style'] == 'option2' ) {
				echo $output_video;
				echo $output_text;
			} else if ( $_thinkup_meta_sliderpage['style'] == 'option3' ) {
				echo $output_text;
				echo $output_video;
			}

		echo  '</div>',
			  '</div>',
			  $slide_link_end,
			  '</div>',
			  '</li>';
	$count++;
	}
}

// Add Slider - Inner Page
function thinkup_input_sliderpage() {
global $post;

// Set variables to avoid php non-object notice error
$_thinkup_meta_slider     = NULL;
$_thinkup_meta_slidername = NULL;
$_thinkup_meta_sliderpage = NULL;

// Assign meta data variable
if ( ! empty( $post->ID ) and thinkup_check_currentpage() == get_permalink() ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_slidername = get_post_meta( $post->ID, '_thinkup_meta_slidername', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}

$thinkup_data_speed  = NULL;
$thinkup_class_style = NULL;

	if ( ! is_front_page() and !is_archive() and !thinkup_check_isblog() and $_thinkup_meta_slider == 'on' ) {

		// Set slider speed data attribute
		if ( empty( $_thinkup_meta_sliderpage['slider_speed'] ) ) {
			$_thinkup_meta_sliderpage['slider_speed'] = '6000';
		} else {
			$_thinkup_meta_sliderpage['slider_speed'] = $_thinkup_meta_sliderpage['slider_speed'] * 1000;
		}

		$thinkup_data_speed = ' data-speed="' . $_thinkup_meta_sliderpage['slider_speed'] . '"';

		// Set slider style class
		if ( empty( $_thinkup_meta_sliderpage['style'] ) or $_thinkup_meta_sliderpage['style'] == 'option1' ) {
			$thinkup_class_style = ' class="style1"';
		} else if ( $_thinkup_meta_sliderpage['style'] == 'option2' ) {
			$thinkup_class_style = ' class="style2"';
		} else if ( $_thinkup_meta_sliderpage['style'] == 'option3' ) {
			$thinkup_class_style = ' class="style3"';
		}
	
		echo	'<div id="slider"' . $thinkup_class_style . '><div id="slider-core">';

			if ( empty( $_thinkup_meta_slidername ) and is_array( $_thinkup_meta_sliderpage ) ) {
			echo '<div class="rslides-container"' . $thinkup_data_speed . '><div class="rslides-inner page-inner"><ul class="slides">';

			if ( empty( $_thinkup_meta_sliderpage['style'] ) or $_thinkup_meta_sliderpage['style'] == 'option1' ) {
				echo thinkup_input_sliderpagestandard();
			} else if ( $_thinkup_meta_sliderpage['style'] == 'option2' or $_thinkup_meta_sliderpage['style'] == 'option3' ) {
				echo thinkup_input_sliderpagevideo();
			}

			echo '</ul></div></div>';
			} else if ( ! empty( $_thinkup_meta_slidername ) ) {
				echo do_shortcode( $_thinkup_meta_slidername );
			}
		echo '</div></div>';
	}
}

// Add ThinkUpSlider Height - Inner Page
function thinkup_input_sliderpageheight() {
global $post;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_slider     = get_post_meta( $post->ID, '_thinkup_meta_slider', true );
	$_thinkup_meta_slidername = get_post_meta( $post->ID, '_thinkup_meta_slidername', true );
	$_thinkup_meta_sliderpage = get_post_meta( $post->ID, '_thinkup_meta_sliderimages', true ); 
}

		if ( is_array( $_thinkup_meta_sliderpage ) ) $slide_height = $_thinkup_meta_sliderpage['height'];

		if ( empty( $slide_height ) ) $slide_height = '200';

		if ( ! is_front_page() and $_thinkup_meta_slider == 'on' and empty( $_thinkup_meta_slidername ) and ! empty( $_thinkup_meta_sliderpage[ 'image' ][0] ) ) {

		echo 	"\n" .'<style type="text/css">' . "\n",
			'#slider .rslides, #slider .rslides li { height: ' . $slide_height . 'px; max-height: ' . $slide_height . 'px; }' . "\n",
			'#slider .rslides img { height: 100%; max-height: ' . $slide_height . 'px; }' . "\n",
			'</style>' . "\n";
	}
}
add_action( 'wp_head','thinkup_input_sliderpageheight', '13' );


//----------------------------------------------------------------------------------
//	ENABLE HOMEPAGE CONTENT
//----------------------------------------------------------------------------------

function thinkup_input_homepagesection() {
global $thinkup_homepage_sectionswitch;
global $thinkup_homepage_section1_image;
global $thinkup_homepage_section1_imagesize;
global $thinkup_homepage_section1_title;
global $thinkup_homepage_section1_desc;
global $thinkup_homepage_section1_link;
global $thinkup_homepage_section1_url;
global $thinkup_homepage_section1_target;
global $thinkup_homepage_section1_button;
global $thinkup_homepage_section2_image;
global $thinkup_homepage_section2_imagesize;
global $thinkup_homepage_section2_title;
global $thinkup_homepage_section2_desc;
global $thinkup_homepage_section2_link;
global $thinkup_homepage_section2_url;
global $thinkup_homepage_section2_target;
global $thinkup_homepage_section2_button;
global $thinkup_homepage_section3_image;
global $thinkup_homepage_section3_imagesize;
global $thinkup_homepage_section3_title;
global $thinkup_homepage_section3_desc;
global $thinkup_homepage_section3_link;
global $thinkup_homepage_section3_url;
global $thinkup_homepage_section3_target;
global $thinkup_homepage_section3_button;
global $thinkup_homepage_section4_image;
global $thinkup_homepage_section4_imagesize;
global $thinkup_homepage_section4_title;
global $thinkup_homepage_section4_desc;
global $thinkup_homepage_section4_link;
global $thinkup_homepage_section4_url;
global $thinkup_homepage_section4_button;
global $thinkup_homepage_section4_target;

	// Set default values for images
	$imagesize1 = 'column3-1/3';
	$imagesize2 = 'column3-1/3';
	$imagesize3 = 'column3-1/3';
	$imagesize4 = 'column3-1/3';
		
	if ( ! empty( $thinkup_homepage_section1_image ) ) {
		if ( $thinkup_homepage_section1_imagesize == '1' ) {
			$imagesize1 = 'full';
		}
		$thinkup_homepage_section1_image = wp_get_attachment_image_src( $thinkup_homepage_section1_image, $imagesize1 );
	}
	if ( ! empty( $thinkup_homepage_section2_image ) ) {
		if ( $thinkup_homepage_section2_imagesize == '1' ) {
			$imagesize2 = 'full';
		}
		$thinkup_homepage_section2_image = wp_get_attachment_image_src( $thinkup_homepage_section2_image, $imagesize2 );
	}
	if ( ! empty( $thinkup_homepage_section3_image ) ) {
		if ( $thinkup_homepage_section3_imagesize == '1' ) {
			$imagesize3 = 'full';
		}
		$thinkup_homepage_section3_image = wp_get_attachment_image_src( $thinkup_homepage_section3_image, $imagesize3 );
	}
	if ( ! empty( $thinkup_homepage_section4_image ) ) {
		if ( $thinkup_homepage_section4_imagesize == '1' ) {
			$imagesize4 = 'full';
		}
		$thinkup_homepage_section4_image = wp_get_attachment_image_src( $thinkup_homepage_section4_image, $imagesize4 );
	}

	// Set default values for titles
	if ( empty( $thinkup_homepage_section1_title ) ) $thinkup_homepage_section1_title = __( 'Step 1 &#45; Theme Options', 'renden' );
	if ( empty( $thinkup_homepage_section2_title ) ) $thinkup_homepage_section2_title = __( 'Step 2 &#45; Setup Slider', 'renden' );
	if ( empty( $thinkup_homepage_section3_title ) ) $thinkup_homepage_section3_title = __( 'Step 3 &#45; Create Homepage', 'renden' );
	if ( empty( $thinkup_homepage_section4_title ) ) $thinkup_homepage_section4_title = __( 'Step 4 &#45; Add Content', 'renden' );

	// Set default values for descriptions
	if ( empty( $thinkup_homepage_section1_desc ) ) 
	$thinkup_homepage_section1_desc = __( 'To begin customizing your site go to Appearance &#45;&#62; Customizer and select Theme Options. Here&#39;s you&#39;ll find custom options to help build your site.', 'renden' );

	if ( empty( $thinkup_homepage_section2_desc ) ) 
	$thinkup_homepage_section2_desc = __( 'To add a slider go to Theme Options &#45;&#62; Homepage and choose page slider. The slider will use the page title, excerpt and featured image for the slides.', 'renden' );

	if ( empty( $thinkup_homepage_section3_desc ) ) 
	$thinkup_homepage_section3_desc = __( 'To add featured content go to Theme Options &#45;&#62; Homepage (Featured) and turn the switch on then add the content you want for each section.', 'renden' );

	if ( empty( $thinkup_homepage_section4_desc ) ) 
	$thinkup_homepage_section4_desc = __( 'To start adding page content go to Pages -> Add New in your WordPress admin area. You can add content as you normally would. Have fun!', 'renden' );

	// Get page names for links
	if ( ! empty( $thinkup_homepage_section1_url ) ) {
		$thinkup_homepage_section1_link = $thinkup_homepage_section1_url;
	} else if ( ! empty( $thinkup_homepage_section1_link ) ) {
		$thinkup_homepage_section1_link = get_permalink( $thinkup_homepage_section1_link );
	}
	if ( ! empty( $thinkup_homepage_section2_url ) ) {
		$thinkup_homepage_section2_link = $thinkup_homepage_section2_url;
	} else if ( ! empty( $thinkup_homepage_section2_link ) ) {
		$thinkup_homepage_section2_link = get_permalink( $thinkup_homepage_section2_link );
	}
	if ( ! empty( $thinkup_homepage_section3_url ) ) {
		$thinkup_homepage_section3_link = $thinkup_homepage_section3_url;
	} else if ( ! empty( $thinkup_homepage_section3_link ) ) {
		$thinkup_homepage_section3_link = get_permalink( $thinkup_homepage_section3_link );
	}
	if ( ! empty( $thinkup_homepage_section4_url ) ) {
		$thinkup_homepage_section4_link = $thinkup_homepage_section4_url;
	} else if ( ! empty( $thinkup_homepage_section4_link ) ) {
		$thinkup_homepage_section4_link = get_permalink( $thinkup_homepage_section4_link );
	}

	// Get button text
	if ( empty( $thinkup_homepage_section1_button ) )
		$thinkup_homepage_section1_button = __( 'Read More', 'renden' );
	if ( empty( $thinkup_homepage_section2_button ) )
		$thinkup_homepage_section2_button = __( 'Read More', 'renden' );
	if ( empty( $thinkup_homepage_section3_button ) )
		$thinkup_homepage_section3_button = __( 'Read More', 'renden' );
	if ( empty( $thinkup_homepage_section4_button ) )
		$thinkup_homepage_section4_button = __( 'Read More', 'renden' );

	// Set target values
	if ( $thinkup_homepage_section1_target == 'option2' ) $thinkup_homepage_section1_target = ' target="_blank"';
	if ( $thinkup_homepage_section2_target == 'option2' ) $thinkup_homepage_section2_target = ' target="_blank"';
	if ( $thinkup_homepage_section3_target == 'option2' ) $thinkup_homepage_section3_target = ' target="_blank"';
	if ( $thinkup_homepage_section4_target == 'option2' ) $thinkup_homepage_section4_target = ' target="_blank"';

	// Determine whether 3 column or 4 column layout should be used
	if ( empty( $thinkup_homepage_section4_image ) ) {
		$class_three_col1 = ' one_third';
		$class_three_col2 = ' one_third';
		$class_three_col3 = ' one_third last';

		$class_four_col1 = NULL;
		$class_four_col2 = NULL;
		$class_four_col3 = NULL;
		$class_four_col4 = NULL;
	} else {
		$class_three_col1 = NULL;
		$class_three_col2 = NULL;
		$class_three_col3 = NULL;

		$class_four_col1 = ' one_fourth';
		$class_four_col2 = ' one_fourth';
		$class_four_col3 = ' one_fourth';
		$class_four_col4 = ' one_fourth last';
	}

	if ( is_front_page() ) {
		if ( empty( $thinkup_homepage_sectionswitch ) or $thinkup_homepage_sectionswitch == '1' ) {

		echo '<div id="section-home"><div id="section-home-inner">';

			echo '<article class="section1' . $class_three_col1 . $class_four_col1 . '">',
					'<div class="section">',
					'<div class="entry-header">';
					if ( empty( $thinkup_homepage_section1_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image', 'renden' ) . '" />';
					} else {
						if ( ! empty( $thinkup_homepage_section1_link ) ) {
							echo '<a href="' . esc_url( $thinkup_homepage_section1_link ) . '"><img src="' . esc_url( $thinkup_homepage_section1_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section1_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $thinkup_homepage_section1_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section1_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="entry-content">',
					'<h3>' . esc_html( $thinkup_homepage_section1_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $thinkup_homepage_section1_desc ) ) );
					if ( ! empty( $thinkup_homepage_section1_link ) ) {
						echo '<p><a href="' . esc_url( $thinkup_homepage_section1_link ) . '"' . esc_attr( $thinkup_homepage_section1_target ) . ' class="more-link">' . esc_html( $thinkup_homepage_section1_button ) . '</a></p>';
					}
			echo	'</div>',
					'</div>',
				'</article>';

			echo '<article class="section2' . $class_three_col2 . $class_four_col2 . '">',
					'<div class="section">',
					'<div class="entry-header">';
					if ( empty( $thinkup_homepage_section2_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image', 'renden' ) . '" />';
					} else {
						if ( ! empty( $thinkup_homepage_section2_link ) ) {
							echo '<a href="' . esc_url( $thinkup_homepage_section2_link ) . '"><img src="' . esc_url( $thinkup_homepage_section2_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section2_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $thinkup_homepage_section2_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section2_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="entry-content">',
					'<h3>' . esc_html( $thinkup_homepage_section2_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $thinkup_homepage_section2_desc ) ) );
					if ( ! empty( $thinkup_homepage_section2_link ) ) {
						echo '<p><a href="' . esc_url( $thinkup_homepage_section2_link ) . '"' . esc_attr( $thinkup_homepage_section2_target ) . ' class="more-link">' . esc_html( $thinkup_homepage_section2_button ) . '</a></p>';
					}
			echo	'</div>',
					'</div>',
				'</article>';

			echo '<article class="section3' . $class_three_col3 . $class_four_col3 . '">',
					'<div class="section">',
					'<div class="entry-header">';
					if ( empty( $thinkup_homepage_section3_image ) ) {
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image', 'renden' ) . '" />';
					} else {
						if ( ! empty( $thinkup_homepage_section3_link ) ) {
							echo '<a href="' . esc_url( $thinkup_homepage_section3_link ) . '"><img src="' . esc_url( $thinkup_homepage_section3_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section3_title ) . '" /></a>';
						} else {
							echo '<img src="' . esc_url( $thinkup_homepage_section3_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section3_title ) . '" />';
						}
					}
			echo	'</div>',
					'<div class="entry-content">',
					'<h3>' . esc_html( $thinkup_homepage_section3_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $thinkup_homepage_section3_desc ) ) );
				if ( ! empty( $thinkup_homepage_section3_link ) ) {
					echo '<p><a href="' . esc_url( $thinkup_homepage_section3_link ) . '"' . esc_attr( $thinkup_homepage_section3_target ) . ' class="more-link">' . esc_html( $thinkup_homepage_section3_button ) . '</a></p>';
				}
			echo	'</div>',
					'</div>',
				'</article>';

			if ( ! empty( $class_four_col4 ) ) {
				echo '<article class="section4' . $class_four_col4 . '">',
						'<div class="section">',
						'<div class="entry-header">';
						if ( empty( $thinkup_homepage_section4_image ) ) {
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/slideshow/placeholder_image.png' . '" alt="' . esc_attr__( 'Placeholder Image', 'renden' ) . '" />';
						} else {
							if ( ! empty( $thinkup_homepage_section4_link ) ) {
								echo '<a href="' . esc_url( $thinkup_homepage_section4_link ) . '"><img src="' . esc_url( $thinkup_homepage_section4_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section4_title ) . '" /></a>';
							} else {
								echo '<img src="' . esc_url( $thinkup_homepage_section4_image[0] ) . '" alt="' . esc_attr( $thinkup_homepage_section4_title ) . '" />';
							}
						}
				echo	'</div>',
						'<div class="entry-content">',
						'<h3>' . esc_html( $thinkup_homepage_section4_title ) . '</h3>' . wpautop( esc_html( do_shortcode ( $thinkup_homepage_section4_desc ) ) );
					if ( ! empty( $thinkup_homepage_section4_link ) ) {
						echo '<p><a href="' . esc_url( $thinkup_homepage_section4_link ) . '"' . esc_attr( $thinkup_homepage_section4_target ) . ' class="more-link">' . esc_html( $thinkup_homepage_section4_button ) . '</a></p>';
					}
				echo	'</div>',
						'</div>',
					'</article>';
			}

		echo '<div class="clearboth"></div></div></div>';
		}
	}
}


/* ----------------------------------------------------------------------------------
	CALL TO ACTION - INTRO
---------------------------------------------------------------------------------- */

function thinkup_input_ctaintro() {
global $thinkup_homepage_introswitch;
global $thinkup_homepage_introaction;
global $thinkup_homepage_introactionteaser;
global $thinkup_homepage_introactiontext1;
global $thinkup_homepage_introactionlink1;
global $thinkup_homepage_introactionpage1;
global $thinkup_homepage_introactioncustom1;

	if ( $thinkup_homepage_introswitch == '1' and is_front_page() and ! empty( $thinkup_homepage_introaction ) ) {

		echo '<div id="introaction"><div id="introaction-core">';

			echo '<div class="action-message two_third">';

			echo '<div class="action-text">',
				 '<h3>' . $thinkup_homepage_introaction . '</h3>',
				 '</div>';

			echo '<div class="action-teaser">',
				 wpautop( $thinkup_homepage_introactionteaser ),
				 '</div>';

			echo '</div>';

			if ( ( !empty( $thinkup_homepage_introactionlink1) and $thinkup_homepage_introactionlink1 !== 'option3' ) ) {

				// Set default value of buttons to "Read more"
				if( empty( $thinkup_homepage_introactiontext1 ) ) { $thinkup_homepage_introactiontext1 = __( 'Read More', 'renden' ); }
				
				echo '<div class="action-link one_third last">';
					// Add call to action button 1
					if ( $thinkup_homepage_introactionlink1 == 'option1' ) {
						echo '<a class="themebutton" href="' . get_permalink( $thinkup_homepage_introactionpage1 ) . '">',
						$thinkup_homepage_introactiontext1,
						'</a>';
					} else if ( $thinkup_homepage_introactionlink1 == 'option2' ) {
						echo '<a class="themebutton" href="' . $thinkup_homepage_introactioncustom1 . '">',
						$thinkup_homepage_introactiontext1,
						'</a>';
					}
				echo '</div>';
			}

		echo '</div></div>';
	}
}


/* ----------------------------------------------------------------------------------
	CALL TO ACTION - OUTRO
---------------------------------------------------------------------------------- */

function thinkup_input_ctaoutro() {
global $thinkup_homepage_outroswitch;
global $thinkup_homepage_outroaction;
global $thinkup_homepage_outroactionteaser;
global $thinkup_homepage_outroactiontext1;
global $thinkup_homepage_outroactionlink1;
global $thinkup_homepage_outroactionpage1;
global $thinkup_homepage_outroactioncustom1;

global $thinkup_footer_outroswitch;
global $thinkup_footer_outroaction;
global $thinkup_footer_outroactionteaser;
global $thinkup_footer_outroactiontext1;
global $thinkup_footer_outroactionlink1;
global $thinkup_footer_outroactionpage1;
global $thinkup_footer_outroactioncustom1;

	if ( $thinkup_homepage_outroswitch == '1' and is_front_page() and ! empty( $thinkup_homepage_outroaction ) ) {

		echo '<div id="outroaction"><div id="outroaction-core">';

			echo '<div class="action-message two_third">';

			echo '<div class="action-text">',
				 '<h3>' . $thinkup_homepage_outroaction . '</h3>',
				 '</div>';

			echo '<div class="action-teaser">',
				 wpautop( $thinkup_homepage_outroactionteaser ),
				 '</div>';

			echo '</div>';

			if ( ( !empty( $thinkup_homepage_outroactionlink1) and $thinkup_homepage_outroactionlink1 !== 'option3' ) ) {

				// Set default value of buttons to "Read more"
				if( empty( $thinkup_homepage_outroactiontext1 ) ) { $thinkup_homepage_outroactiontext1 = __( 'Read More', 'renden' ); }
				
				echo '<div class="action-link one_third last">';
					// Add call to action button 1
					if ( $thinkup_homepage_outroactionlink1 == 'option1' ) {
						echo '<a class="themebutton" href="' . get_permalink( $thinkup_homepage_outroactionpage1 ) . '">',
						$thinkup_homepage_outroactiontext1,
						'</a>';
					} else if ( $thinkup_homepage_outroactionlink1 == 'option2' ) {
						echo '<a class="themebutton" href="' . $thinkup_homepage_outroactioncustom1 . '">',
						$thinkup_homepage_outroactiontext1,
						'</a>';
					}
					echo '</div>';
			}
		echo '</div></div>';
	} else if ( $thinkup_footer_outroswitch == '1' and !is_front_page() and ! empty( $thinkup_footer_outroaction ) ) {

		echo '<div id="outroaction"><div id="outroaction-core">';

			echo '<div class="action-message two_third">';

			echo '<div class="action-text">',
				 '<h3>' . $thinkup_footer_outroaction . '</h3>',
				 '</div>';

			echo '<div class="action-teaser">',
				 wpautop( $thinkup_footer_outroactionteaser ),
				 '</div>';

			echo '</div>';

			if ( ( !empty( $thinkup_footer_outroactionlink1) and $thinkup_footer_outroactionlink1 !== 'option3' ) ) {

				// Set default value of buttons to "Read more"
				if( empty( $thinkup_footer_outroactiontext1 ) ) { $thinkup_footer_outroactiontext1 = __( 'Read More', 'renden' ); }
				
				echo '<div class="action-link one_third last">';
					// Add call to action button 1
					if ( $thinkup_footer_outroactionlink1 == 'option1' ) {
						echo '<a class="themebutton" href="' . get_permalink( $thinkup_footer_outroactionpage1 ) . '">',
						$thinkup_footer_outroactiontext1,
						'</a>';
					} else if ( $thinkup_footer_outroactionlink1 == 'option2' ) {
						echo '<a class="themebutton" href="' . $thinkup_footer_outroactioncustom1 . '">',
						$thinkup_footer_outroactiontext1,
						'</a>';
					}
					echo '</div>';
			}
		echo '</div></div>';
	}
}


?>