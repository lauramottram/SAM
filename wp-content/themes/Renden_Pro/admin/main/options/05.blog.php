<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */


 /* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogclass($classes){
global $thinkup_blog_style;
global $thinkup_blog_style1layout;

global $post;

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle        = NULL;
$_thinkup_meta_blogstyle1layout = NULL;
$_thinkup_meta_blogstyle2layout = NULL;

// Assign meta data variable
if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_blogstyle        = get_post_meta( $post->ID, '_thinkup_meta_blogstyle', true );
	$_thinkup_meta_blogstyle1layout = get_post_meta( $post->ID, '_thinkup_meta_blogstyle1layout', true );
	$_thinkup_meta_blogstyle2layout = get_post_meta( $post->ID, '_thinkup_meta_blogstyle2layout', true );
}

	if ( thinkup_check_isblog() ) {
		if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) {
			if ( $thinkup_blog_style1layout !== 'option2' ) {
				$classes[] = 'blog-style1 blog-style1-layout1';
			} else {
				$classes[] = 'blog-style1 blog-style1-layout2';
			}
		} else {
			$classes[] = 'blog-style2';
		}
	} else if ( is_page_template( 'template-blog.php' ) ) {
		if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
			if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) {
				if ( $thinkup_blog_style1layout !== 'option2' ) {
					$classes[] = 'blog-style1 blog-style1-layout1';
				} else {
					$classes[] = 'blog-style1 blog-style1-layout2';
				}
			} else {
				$classes[] = 'blog-style2';
			}
		} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
			if ( $_thinkup_meta_blogstyle1layout !== 'option2' ) {
				$classes[] = 'blog-style1 blog-style1-layout1';
			} else {
				$classes[] = 'blog-style1 blog-style1-layout2';
			}
		} else if ( $_thinkup_meta_blogstyle == 'option3' ) {
			$classes[] = 'blog-style2';
		}
	}
	return $classes;
}
add_action( 'body_class', 'thinkup_input_blogclass');


/* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function thinkup_input_stylelayout() {
global $thinkup_blog_style;
global $thinkup_blog_style2layout;

global $thinkup_blog_pageid;
$_thinkup_meta_blogstyle       = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
$_thinkup_meta_blogstyle2layout = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle2layout', true );
  
	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( $thinkup_blog_style !== 'option2' ) {
			echo ' column-1';
		} else if ( $thinkup_blog_style == 'option2' ) {			
			if ( empty($thinkup_blog_style2layout) or $thinkup_blog_style2layout == 'option1' ) {
				echo ' column-1';
			} else if ( $thinkup_blog_style2layout == 'option2' ) {
				echo ' column-2';
			} else if ( $thinkup_blog_style2layout == 'option3' ) {
				echo ' column-3';
			} else if ( $thinkup_blog_style2layout == 'option4' ) {
				echo ' column-4';
			}
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
			if ( $thinkup_blog_style !== 'option2' ) {
				echo ' column-1';
			} else if ( $thinkup_blog_style == 'option2' ) {		
				if ( empty($thinkup_blog_style2layout) or $thinkup_blog_style2layout == 'option1' ) {
					echo ' column-1';
				} else if ( $thinkup_blog_style2layout == 'option2' ) {
					echo ' column-2';
				} else if ( $thinkup_blog_style2layout == 'option3' ) {
					echo ' column-3';
				} else if ( $thinkup_blog_style2layout == 'option4' ) {
					echo ' column-4';
				}
			}
		} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
			echo ' column-1';	
		} else if ( $_thinkup_meta_blogstyle == 'option3' ) {
			if ( empty($_thinkup_meta_blogstyle2layout) or $_thinkup_meta_blogstyle2layout == 'option1' ) {
				echo ' column-1';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option2' ) {
				echo ' column-2';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option3' ) {
				echo ' column-3';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option4' ) {
				echo ' column-4';
			}
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG STYLE - CLASSES FOR STYLE 1
---------------------------------------------------------------------------------- */

function thinkup_input_stylelayout_class1() {
global $post;
global $thinkup_blog_postswitch;
global $thinkup_blog_style;
global $thinkup_blog_style1layout;

global $thinkup_blog_pageid;
$_thinkup_meta_blogstyle        = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
$_thinkup_meta_blogstyle1layout = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle1layout', true );

	if ( has_post_thumbnail( $post->ID ) and $thinkup_blog_postswitch !== 'option2' ) {
		if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
			if ( $thinkup_blog_style !== 'option2' and $thinkup_blog_style1layout !== 'option2' ) {
				echo ' one_third';
			}
		} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
			if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
				if ( $thinkup_blog_style !== 'option2' and $thinkup_blog_style1layout !== 'option2' ) {
					echo ' one_third';
				}
			} else if ( $_thinkup_meta_blogstyle == 'option2' and $_thinkup_meta_blogstyle1layout !== 'option2' ) {
				echo ' one_third';
			}
		}
	}
}

function thinkup_input_stylelayout_class2() {
global $post;
global $thinkup_blog_postswitch;
global $thinkup_blog_style;
global $thinkup_blog_style1layout;

global $thinkup_blog_pageid;
$_thinkup_meta_blogstyle        = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
$_thinkup_meta_blogstyle1layout = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle1layout', true );

	if ( has_post_thumbnail( $post->ID ) and $thinkup_blog_postswitch !== 'option2' ) {
		if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
			if ( $thinkup_blog_style !== 'option2' and $thinkup_blog_style1layout !== 'option2' ) {
				echo ' two_third last';
			}
		} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
			if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
				if ( $thinkup_blog_style !== 'option2' and $thinkup_blog_style1layout !== 'option2' ) {
					echo ' two_third last';
				}
			} else if ( $_thinkup_meta_blogstyle == 'option2' and $_thinkup_meta_blogstyle1layout !== 'option2' ) {
				echo ' two_third last';
			}
		}
	}
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function thinkup_input_blogtitle() {
global $thinkup_blog_title;

	if ( $thinkup_blog_title !== '1' ) {
		echo	'<h2 class="blog-title">',
				'<a href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'renden' ), the_title_attribute( 'echo=0' ) ) ) . '">' . get_the_title() . '</a>',
				'</h2>';
	}
}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

// Input post thumbnail / featured media
function thinkup_input_blogimage() {
global $post;
global $wp_embed;
global $thinkup_blog_style;
global $thinkup_blog_style1layout;
global $thinkup_blog_style2layout;
global $thinkup_blog_lightbox;
global $thinkup_blog_link;

global $thinkup_blog_pageid;
$_thinkup_meta_blogstyle        = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
$_thinkup_meta_blogstyle1layout = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle1layout', true );
$_thinkup_meta_blogstyle2layout = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle2layout', true );

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_featuredmedia   = get_post_meta( $post->ID, '_thinkup_meta_featuredmedia', true );
	$_thinkup_meta_featuredgallery = get_post_meta( $post->ID, '_thinkup_meta_featuredgallery', true ); 
}

	$size  = NULL;
	$link  = NULL;
	$media = NULL;

	$blog_lightbox = NULL;
	$blog_link     = NULL;
	$blog_class    = NULL;
	$blog_overlay  = NULL;

	// Set image size for blog thumbnail
	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( $thinkup_blog_style !== 'option2' ) {
			if ( empty($thinkup_blog_style1layout) or $thinkup_blog_style1layout == 'option1' ) {
				$size = 'column3-2/3';
			} else {
				$size = 'column1-1/3';
			}
		} else if ( $thinkup_blog_style == 'option2' ) {			
			if ( empty($thinkup_blog_style2layout) or $thinkup_blog_style2layout == 'option1' ) {
				$size = 'column1-1/3';
			} else if ( $thinkup_blog_style2layout == 'option2' ) {
				$size = 'column2-1/2';
			} else if ( $thinkup_blog_style2layout == 'option3' ) {
				$size = 'column3-2/3';
			} else if ( $thinkup_blog_style2layout == 'option4' ) {
				$size = 'column4-2/3';
			}
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {	
		if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
			if ( $thinkup_blog_style !== 'option2' ) {
				if ( empty($thinkup_blog_style1layout) or $thinkup_blog_style1layout == 'option1' ) {
					$size = 'column3-2/3';
				} else {
					$size = 'column1-1/3';
				}
			} else if ( $thinkup_blog_style == 'option2' ) {		
				if ( empty($thinkup_blog_style2layout) or $thinkup_blog_style2layout == 'option1' ) {
					$size = 'column1-1/3';
				} else if ( $thinkup_blog_style2layout == 'option2' ) {
					$size = 'column2-1/2';
				} else if ( $thinkup_blog_style2layout == 'option3' ) {
					$size = 'column3-2/3';
				} else if ( $thinkup_blog_style2layout == 'option4' ) {
					$size = 'column4-2/3';
				}
			}
		} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
			if ( empty( $_thinkup_meta_blogstyle1layout) or $_thinkup_meta_blogstyle1layout == 'option1' ) {
				$size = 'column3-2/3';
			} else {
				$size = 'column1-1/3';
			}
		} else if ( $_thinkup_meta_blogstyle == 'option3' ) {
			if ( empty($_thinkup_meta_blogstyle2layout) or $_thinkup_meta_blogstyle2layout == 'option1' ) {
				$size = 'column1-1/3';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option2' ) {
				$size = 'column2-1/2';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option3' ) {
				$size = 'column3-2/3';
			} else if ( $_thinkup_meta_blogstyle2layout == 'option4' ) {
				$size = 'column4-2/3';
			}
		}
	}

	$featured_id = get_post_thumbnail_id( $post->ID );
	$featured_img = wp_get_attachment_image_src($featured_id,'full', true);

	// Determine featured media to input
	if ( get_post_format() == 'video' and ! empty( $_thinkup_meta_featuredmedia ) ) {

		// Remove http:// and https:// from video link
		if ( strpos( $_thinkup_meta_featuredmedia, 'https://' ) !== false ) {
			$_thinkup_meta_featuredmedia = 'https://' . str_replace( 'https://', '', $_thinkup_meta_featuredmedia );
		} else {
			$_thinkup_meta_featuredmedia = 'http://' . str_replace( 'http://', '', $_thinkup_meta_featuredmedia );
		}

		$link  = $_thinkup_meta_featuredmedia;
		$media = $wp_embed->run_shortcode('[embed]' . $_thinkup_meta_featuredmedia . '[/embed]');
	} else if ( get_post_format() == 'gallery' and ! empty( $_thinkup_meta_featuredgallery ) ) {

		if ( is_array( $_thinkup_meta_featuredgallery ) ) $slide_height = $_thinkup_meta_featuredgallery['height'];

		if ( empty( $slide_height ) ) $slide_height = '200';

		$media .= '<div class="rslides-sc" data-height="' . $slide_height . '">';
		$media .= '<div class="rslides-container">';
		$media .= '<div class="rslides-inner">';
		$media .= '<ul class="slides">';

		$count = 0;

		// Begin loop to import gallery images
		foreach ( $_thinkup_meta_featuredgallery['image'] as $slide => $list) {

			$slide_id = $_thinkup_meta_featuredgallery['image'][ $count ];

			$slide_img   = wp_get_attachment_url( $slide_id, true );
			$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';

			$media .= '<li>';
			$media .= '<img src="' . get_template_directory_uri() . '/images/transparent.png" style="' . $slide_image . '" alt="Image" />';
			$media .= '</li>';

		$count++;
		}

		$media .= '</ul>';
		$media .= '</div>';
		$media .= '</div>';
		$media .= '</div>';

	} else {
		$link  = $featured_img[0];
		$media = get_the_post_thumbnail( $post->ID, $size );
	}

	// Determine which links to show on hover
	if ( $thinkup_blog_lightbox =='1' ) {
		$blog_lightbox = '<a class="hover-zoom prettyPhoto" href="' . $link . '"><i class="dashicons dashicons-editor-distractionfree"></i></a>';
	}
	if ( $thinkup_blog_link =='1' ) {
		$blog_link = '<a class="hover-link" href="' . get_permalink() . '"><i class="dashicons dashicons-arrow-right-alt2"></i></a>';
	}

	// Determine which if single link animation should be shown
	if ( ( $thinkup_blog_lightbox =='1' and $thinkup_blog_link !== '1' ) 
		or ( $thinkup_blog_lightbox !=='1' and $thinkup_blog_link == '1' ) ) {
		$blog_class = ' style2';
	}

	if ( $thinkup_blog_lightbox =='1' or $thinkup_blog_link =='1' ) {
		$blog_overlay .= '<div class="image-overlay' . $blog_class . '">';
		$blog_overlay .= '<div class="image-overlay-inner"><div class="prettyphoto-wrap">';
		$blog_overlay .= $blog_lightbox;
		$blog_overlay .= $blog_link;
		$blog_overlay .= '</div></div>';
		$blog_overlay .= '</div>';
	}

	// Output media on blog page
	if ( get_post_format() == 'gallery' and ! empty( $_thinkup_meta_featuredgallery ) ) {
		echo '<div class="blog-thumb gallery">',
			 '<a href="'. get_permalink($post->ID) . '">' . $media . '</a>',
			 '</div>';
	} else if ( get_post_format() == 'video' and ! empty( $_thinkup_meta_featuredmedia ) ) {
		echo '<div class="blog-thumb">',
			 '<a href="'. get_permalink($post->ID) . '">' . $media . '</a>',
			 $blog_overlay,
			 '</div>';
	} else if ( ! empty( $featured_id ) ) {
		echo '<div class="blog-thumb">',
			 '<a href="'. get_permalink($post->ID) . '">' . $media . '</a>',
			 $blog_overlay,
			 '</div>';
	}
}

// Input post excerpt / content to blog page
function thinkup_input_blogtext() {
global $post;
global $thinkup_blog_postswitch;

	// Output full content - EDD plugin compatibility
	if( function_exists( 'EDD' ) and is_post_type_archive( 'download' ) ) {
		the_content();
		return;
	}

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) ) {
			if( ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
				the_excerpt();
			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'renden' ), 'after'  => '</div>', ) );
			}
		} else if ( $thinkup_blog_postswitch == 'option2' ) {
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'renden' ), 'after'  => '</div>', ) );
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG POST EXCERPT
---------------------------------------------------------------------------------- */

function thinkup_input_blogpostexcerpt() {
global $thinkup_blog_postswitch;
global $thinkup_blog_postexcerpt;

global $thinkup_blog_pageid;
$_thinkup_meta_blogpostexcerpts = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogpostexcerpts', true );

	if ( $thinkup_blog_postswitch == 'option1' or empty( $thinkup_blog_postswitch ) ) {

		if ( thinkup_check_isblog() or get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {

			if ( ! is_numeric( $_thinkup_meta_blogpostexcerpts ) ) {
				if ( is_numeric( $thinkup_blog_postexcerpt ) ) {
					return $thinkup_blog_postexcerpt;
				}
			} else if ( is_numeric( $_thinkup_meta_blogpostexcerpts ) ) {
				return $_thinkup_meta_blogpostexcerpts;
			}
		}
	}

	// return default value if not triggered above
	return 55;
}
add_filter( 'excerpt_length', 'thinkup_input_blogpostexcerpt', 999 );

function thinkup_input_blogpostcount() {
global $thinkup_blog_pageid;
$_thinkup_meta_blogpostcount = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogpostcount', true );

	if ( empty( $_thinkup_meta_blogpostcount ) or $_thinkup_meta_blogpostcount == 'default' ) {
		return get_option('posts_per_page');
	} else {
		return $_thinkup_meta_blogpostcount;
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function thinkup_input_sticky() {
	printf( '<span class="sticky"><i class="fa fa-thumb-tack"></i><a href="%1$s" title="%2$s">' . __( 'Sticky', 'renden' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function thinkup_input_blogdate() {
	printf( __( '<span class="date"><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>', 'renden' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) )
	);
}

// Input blog comments
function thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment">';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '<i class="fa fa-comments"></i><span class="comment-count">0</span> <span class="comment-text">Comments</span>', 'renden' ), __( '<i class="fa fa-comments"></i><span class="comment-count">1</span> <span class="comment-text">Comment</span>', 'renden' ), __( '<i class="fa fa-comments"></i><span class="comment-count">%</span> <span class="comment-text">Comments</span>', 'renden' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'renden' ) );

	if ( $categories_list && thinkup_input_categorizedblog() ) {
		echo	'<span class="category"><i class="fa fa-list"></i>';
		printf( '%1$s', $categories_list );
		echo	'</span>';
	};
}

// Input blog tags
function thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'renden' ) );

	if ( $tags_list ) {
		echo	'<span class="tags"><i class="fa fa-tags"></i>';
		printf( '%1$s', $tags_list );
		echo	'</span>';
	};
}

// Input blog author
function thinkup_input_blogauthor() {
	printf( __( '<span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'renden' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'renden' ), get_the_author() ) ),
		get_the_author()
	);
}


//----------------------------------------------------------------------------------
//	CUSTOM READ MORE BUTTON.
//----------------------------------------------------------------------------------

function thinkup_input_readmore( $link ) {
global $post;
global $thinkup_blog_style;
global $thinkup_blog_pageid;
global $thinkup_translate_blogreadmore;

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;
$class_button = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
}

	// Make no changes if in admin area
	if ( is_admin() ) {
		return $link;
	}

	// Specify button class for blog style
	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1') {
			$class_button = 'themebutton2';
		} else {
			$class_button = 'themebutton';		
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
			if ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) {
				$class_button = 'themebutton2';
			} else {
				$class_button = 'themebutton';		
			}
		} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
			$class_button = 'themebutton2';
		} else {
			$class_button = 'themebutton';		
		}
	}

	if( empty( $thinkup_translate_blogreadmore ) ) {
		$thinkup_translate_blogreadmore = __( 'Read More', 'renden');
	}

	$link = '<p class="more-link"><a href="'. get_permalink($post->ID) . '" class="' . $class_button . '">' . $thinkup_translate_blogreadmore . '</a></p>';

	return $link;
}
add_filter( 'excerpt_more', 'thinkup_input_readmore' );
add_filter( 'the_content_more_link', 'thinkup_input_readmore' );


/* ----------------------------------------------------------------------------------
	INPUT BLOG META COMMENT CLASS
---------------------------------------------------------------------------------- */

// Input blog comments
function thinkup_input_blogcommentclass() {
global $thinkup_blog_style;
global $thinkup_blog_comment;

global $post;
global $thinkup_blog_pageid;

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
	$_thinkup_meta_blogcomment  = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogcomment', true );
}

	// Only output for blog layout 1
	if ( '0' != get_comments_number() ) {
		if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
			if ( ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) and $thinkup_blog_comment !== '1' ) {
				echo ' comment-icon';
			}
		} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
			if ( empty( $_thinkup_meta_blogstyle ) or $_thinkup_meta_blogstyle == 'option1' ) {
				if ( ( empty( $thinkup_blog_style ) or $thinkup_blog_style == 'option1' ) and $thinkup_blog_comment !== '1' ) {
					echo ' comment-icon';
				}
			} else if ( $_thinkup_meta_blogstyle == 'option2' ) {
				if ( $_thinkup_meta_blogcomment == 'on' ) {
					echo ' comment-icon';
				}
			}
		}
	}
}


/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Blog meta content - Blog style 1
function thinkup_input_blogmeta() {
global $thinkup_blog_style;
global $thinkup_blog_date;
global $thinkup_blog_author;
global $thinkup_blog_comment;
global $thinkup_blog_category;
global $thinkup_blog_tag;

global $post;
global $thinkup_blog_pageid;
$_thinkup_meta_blogdate     = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogdate', true );
$_thinkup_meta_blogauthor   = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogauthor', true );
$_thinkup_meta_blogcomment  = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogcomment', true );
$_thinkup_meta_blogcategory = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogcategory', true );
$_thinkup_meta_blogtags     = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogtags', true );

// Set variables to avoid php non-object notice error
$_thinkup_meta_blogstyle = NULL;

// Assign meta data variable
if ( ! empty( $thinkup_blog_pageid ) ) {
	$_thinkup_meta_blogstyle = get_post_meta( $thinkup_blog_pageid, '_thinkup_meta_blogstyle', true );
}

	if ( get_page_template_slug( $thinkup_blog_pageid ) !== 'template-blog.php' ) {
		if ( $thinkup_blog_date !== '1' or 
			$thinkup_blog_author !== '1' or 
			$thinkup_blog_comment !== '1' or 
			$thinkup_blog_category !== '1' or 
			$thinkup_blog_tag !== '1') {

			echo '<div class="entry-meta">';
				if ( is_sticky() && is_home() && ! is_paged() ) { thinkup_input_sticky(); }

				if ($thinkup_blog_date !== '1')     { thinkup_input_blogdate();     }
				if ($thinkup_blog_author !== '1')   { thinkup_input_blogauthor();   }
				if ($thinkup_blog_comment !== '1')  { thinkup_input_blogcomment();  }	
				if ($thinkup_blog_category !== '1') { thinkup_input_blogcategory(); }
				if ($thinkup_blog_tag !== '1')      { thinkup_input_blogtag();      }
			echo '</div>';
		}
	} else if ( get_page_template_slug( $thinkup_blog_pageid ) == 'template-blog.php' ) {
		if ( $_thinkup_meta_blogdate == 'on' or 
			$_thinkup_meta_blogauthor == 'on' or 
			$_thinkup_meta_blogcomment == 'on' or 
			$_thinkup_meta_blogcategory == 'on' or 
			$_thinkup_meta_blogtags == 'on') {

			echo '<div class="entry-meta">';
				if ($_thinkup_meta_blogdate == 'on')     { thinkup_input_blogdate();     }
				if ($_thinkup_meta_blogauthor == 'on')   { thinkup_input_blogauthor();   }
				if ($_thinkup_meta_blogcomment == 'on')  { thinkup_input_blogcomment();  }	
				if ($_thinkup_meta_blogcategory == 'on') { thinkup_input_blogcategory(); }
				if ($_thinkup_meta_blogtags == 'on')      { thinkup_input_blogtag();      }
			echo '</div>';
		}
	}
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */
function thinkup_input_postmedia() {
global $thinkup_post_date;
global $thinkup_post_author;
global $thinkup_post_comment;
global $thinkup_post_category;
global $thinkup_post_tag;

global $post;

if ( ! empty( $post->ID ) ) {
	$_thinkup_meta_featuredgallery = get_post_meta( $post->ID, '_thinkup_meta_featuredgallery', true ); 
}

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {

		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'column1-1/4' ) . '</div>';

	} else if ( get_post_format() == 'gallery' ) {

		if ( is_array( $_thinkup_meta_featuredgallery ) ) $slide_height = $_thinkup_meta_featuredgallery['height'];

		if ( empty( $slide_height ) ) $slide_height = '200';

		$output .= '<div class="rslides-sc" data-height="' . $slide_height . '">';
		$output .= '<div class="rslides-container">';
		$output .= '<div class="rslides-inner">';
		$output .= '<ul class="slides">';

		$count = 0;

		// Begin loop to import gallery images
		foreach ( $_thinkup_meta_featuredgallery['image'] as $slide => $list) {

			$slide_id = $_thinkup_meta_featuredgallery['image'][ $count ];

			$slide_img   = wp_get_attachment_url( $slide_id, true );
			$slide_image = 'background: url(' . $slide_img . ') no-repeat center; background-size: cover;';

			$output .= '<li>';
			$output .= '<img src="' . get_template_directory_uri() . '/images/transparent.png" style="' . $slide_image . '" alt="Image" />';
			$output .= '</li>';

		$count++;
		}

		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

function thinkup_input_postmeta() {
global $thinkup_post_date;
global $thinkup_post_author;
global $thinkup_post_comment;
global $thinkup_post_category;
global $thinkup_post_tag;
global $thinkup_post_title;

// Reset variable values to avoid php error
$class_comment = NULL;

	if ( $thinkup_post_date !== '1' or 
		$thinkup_post_author !== '1' or 
		$thinkup_post_comment !== '1' or 
		$thinkup_post_category !== '1' or 
		$thinkup_post_tag !== '1' or 
		$thinkup_post_title !== '1') {


			// Only output for blog layout 1
			if ( '0' != get_comments_number() and $thinkup_post_comment !== '1' ) {
				$class_comment = ' comment-icon';
			}

			echo '<header class="entry-header' . $class_comment . '">';

			if ($thinkup_post_title !== '1') { echo '<h3 class="post-title">' . get_the_title() . '</h3>'; }

			echo '<div class="entry-meta">';
				if ($thinkup_post_date !== '1')     { thinkup_input_blogdate();     }
				if ($thinkup_post_author !== '1')   { thinkup_input_blogauthor();   }
				if ($thinkup_post_comment !== '1')  { thinkup_input_blogcomment();  }	
				if ($thinkup_post_category !== '1') { thinkup_input_blogcategory(); }
				if ($thinkup_post_tag !== '1')      { thinkup_input_blogtag();      }
			echo '</div>';

			echo '<div class="clearboth"></div></header><!-- .entry-header -->';
	}
}


/* ----------------------------------------------------------------------------------
	SHOW AUTHOR BIO
---------------------------------------------------------------------------------- */

// HTML for Author Bio
function thinkup_input_postauthorbiocode() {

	echo	'<div id="author-bio">',
			'<div id="author-image">',
			get_avatar( get_the_author_meta( 'email' ), '120' ),
			'</div>',
			'<div id="author-content">',
			'<div id="author-title">',
			'<p><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"/>' . get_the_author() . '</a></p>',
			'</div>';

			if ( get_the_author_meta( 'description' ) !== '' ) {
			echo '<div id="author-text">',
				 wpautop( get_the_author_meta( 'description' ) ),
				 '</div>';
			}

	echo	'</div></div>';
}

// Output Author Bio
function thinkup_input_postauthorbio() {
global $thinkup_post_authorbio;

global $post;
$_thinkup_meta_authorbio = get_post_meta( $post->ID, '_thinkup_meta_authorbio', true );

	if ( empty( $_thinkup_meta_authorbio ) or $_thinkup_meta_authorbio == 'option1' )  {
		if ( $thinkup_post_authorbio == '1' ) {
			thinkup_input_postauthorbiocode();
		}
	} else if ( $_thinkup_meta_authorbio == 'option2' ) {
		thinkup_input_postauthorbiocode();
	}
}


/* ----------------------------------------------------------------------------------
	SHOW SOCIAL SHARING
---------------------------------------------------------------------------------- */

/* HTML for Social Sharing */
function thinkup_input_sharecode() {
global $thinkup_post_sharemessage;
global $thinkup_post_sharefacebook;
global $thinkup_post_sharetwitter;
global $thinkup_post_sharegoogle;
global $thinkup_post_sharelinkedin;
global $thinkup_post_sharetumblr;
global $thinkup_post_sharepinterest;
global $thinkup_post_shareemail;

	/* Remove white spaces from title */
	$page_title = str_replace(' ', '%20', get_the_title());

	echo	'<div id="sharepost">';
		echo	'<div id="sharemessage">';
		if ( ! empty( $thinkup_post_sharemessage ) ) { 
			echo '<p>' . $thinkup_post_sharemessage . '</p>';
		} else {
			echo '<p>Spread the word. Share this post!</p>'; 
		}
		echo	'</div>';
		echo	'<div id="shareicons" class="">';
		if ( $thinkup_post_sharefacebook == '1' ) {
			echo '<a class="shareicon facebook" onclick="MyWindow=window.open(&#39;//www.facebook.com/sharer.php?u=' . get_permalink() . '&#38;t=' . $page_title . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//www.facebook.com/sharer.php?u=' . get_permalink() . '&#38;t=' . $page_title . '" data-tip="top" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>';
		}
		if ( $thinkup_post_sharetwitter == '1' ) {
			echo '<a class="shareicon twitter" onclick="MyWindow=window.open(&#39;//twitter.com/home?status=Check%20this%20out!%20' . $page_title . '%20at%20' . get_permalink() . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//twitter.com/home?status=Check%20this%20out!%20' . $page_title . '%20at%20' . get_permalink() . '" data-tip="top" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>';
		}
		if ( $thinkup_post_sharegoogle == '1' ) {
			echo '<a class="shareicon Google" onclick="MyWindow=window.open(&#39;//plus.google.com/share?url=' . get_permalink() . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//plus.google.com/share?url=' . get_permalink() . '" data-tip="top" data-original-title="Google+"><i class="fa fa-google-plus"></i></a>';
		}
		if ( $thinkup_post_sharelinkedin =='1' ) {
			echo '<a class="shareicon linkedin" onclick="MyWindow=window.open(&#39;//linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&summary=' . $page_title . '&source=LinkedIn&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//linkedin.com/shareArticle?mini=true&url=' . get_permalink() . '&summary=' . $page_title . '&source=LinkedIn" data-tip="top" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>';
		}
		if ( $thinkup_post_sharetumblr == '1' ) {
			echo '<a class="shareicon tumblr" data-tip="top" data-original-title="Tumblr" onclick="MyWindow=window.open(&#39;//www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode($post->post_title) . '&amp;description=' . urlencode(get_the_excerpt()) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode($post->post_title) . '&amp;description=' . urlencode(get_the_excerpt()) . '"><i class="fa fa-tumblr"></i></a>';
		}
		if ( $thinkup_post_sharepinterest == '1' ) {
			echo '<a class="shareicon pinterest" data-tip="top" data-original-title="Pinterest" onclick="MyWindow=window.open(&#39;//pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="//pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) . '"><i class="fa fa-pinterest"></i></a>';
		}
		if ( $thinkup_post_shareemail == '1' ) {
			echo	'<a class="shareicon email" data-tip="top" data-original-title="Email" onclick="MyWindow=window.open(&#39;mailto:?subject=' . get_the_title() . '&amp;body=' . get_permalink() . '&#39;,&#39;MyWindow&#39;,width=650,height=450); return false;" href="mailto:?subject=' . get_the_title() . '&amp;body=' . get_permalink() . '"><i class="fa fa-envelope"></i></a>';
		}
		echo	'</div>';		
	echo	'</div>';
}

/* Output Social Sharing */
function thinkup_input_share() {
global $thinkup_post_share;

global $post;
$_thinkup_meta_share = get_post_meta($post->ID, '_thinkup_meta_share', true);

	if ( empty( $_thinkup_meta_share ) or $_thinkup_meta_share == 'option1' )  {
		if ( $thinkup_post_share == '1' ) {
			thinkup_input_sharecode();
		}
	} else if ( $_thinkup_meta_share == 'option2' ) {
		thinkup_input_sharecode();
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments  - Style 1 */
function thinkup_input_allowcomments() {

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '/comments.php', true );
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function thinkup_input_commenttemplate( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'renden'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'renden' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 70 ); ?>
			<header>

				<div class="comment-author">
					<h4><?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?></h4>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'renden'); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%1$s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'renden' ), ' ' );
					?>
				</div>

				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span>

			</header>

			<footer>

				<div class="comment-content"><?php comment_text(); ?></div>

			</footer><div class="clearboth"></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// List comments in single page
function thinkup_input_comments() {
	$args = array( 
		'callback' => 'thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}


?>