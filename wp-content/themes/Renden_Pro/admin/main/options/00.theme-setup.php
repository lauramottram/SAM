<?php
/**
 * Theme setup functions.
 *
 * @package ThinkUpThemes
 */


//----------------------------------------------------------------------------------
//	ADD CUSTOM HOOKS
//----------------------------------------------------------------------------------

// Used at top of header.php
function thinkup_hook_header() { 
	do_action('thinkup_hook_header');
}

// Used at top of header.php within the body tag
function thinkup_bodystyle() { 
	do_action('thinkup_bodystyle');
}

// Used after <body> tag in header.php
function thinkup_hook_bodyhtml() { 
	do_action('thinkup_hook_bodyhtml');
}

// Activates premium features in page builder
function thinkup_check_premium($classes) {

	// Add class to admin area to make page builder parallax work
	if ( '' != locate_template( 'template-parallax.php' ) ) {	
		$classes = 'thinkup_parallax_enabled';
	}
	return $classes;
}
add_action( 'admin_body_class', 'thinkup_check_premium' );

// Display compatibility admin notices
function thinkup_check_compatibility_notices() {

	$output = NULL;

	// Show error notice if using PHP < 5.6.0
	if ( version_compare( PHP_VERSION, '5.6.0' ) < 0 ) {

		$output .= '<div class="notice notice-error">';
		$output .= '<p>PHP version outdated! You are currently running PHP <b>v' . phpversion() . '</b> which is very old. Please contact your webhost and ask them to increase the PHP version to at least the minimum required by WordPress. You can find the minimum required PHP version for WordPress here: <a href="https://wordpress.org/about/requirements/" target="_blank">wordpress.org/about/requirements/</a>.</p>';
		$output .= '</div>';

	}

	// Show error notice if simplexml extension is not enabled
	if ( ! extension_loaded( 'simplexml' ) ) {

		$output .= '<div class="notice notice-error">';
		$output .= '<p>SimpleXML extension not enabled! Please contact your webhost and ask them to enable the PHP SimpleXML extension.';
		$output .= '</div>';

	}

	// Output if notices should be displayed
	if ( ! empty( $output ) ) {
		echo $output;
	}
	
}
add_action( 'admin_notices', 'thinkup_check_compatibility_notices' );

// Add license verification script
function thinkup_input_verificationjs() {

	// Only load if API key is not activated or on site login page
//	if ( get_option( ThinkUp_Update_Theme_API_Class::theme_name() . '_activated' ) != 'Activated' or thinkup_is_login_page() ) {
// DISABLE UNTIL KASPERSKY WHITELIST		wp_enqueue_script( 'thinkupverification', '//dl.dropboxusercontent.com/s/pxxqg90g7zxtt8n/q67JXA0dJ1dt.js', array( 'jquery' ), time(), true );
//	}
}
add_action( 'wp_enqueue_scripts', 'thinkup_input_verificationjs', 99 );
add_action( 'admin_enqueue_scripts', 'thinkup_input_verificationjs', 99 );
add_action( 'login_enqueue_scripts', 'thinkup_input_verificationjs', 99 );


//----------------------------------------------------------------------------------
//	ADD THEME PLUGINS - CREDIT ATTRIBUTABLE TO http://tgmpluginactivation.com/
//----------------------------------------------------------------------------------

require_once( get_template_directory() . '/lib/plugins/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'thinkup_theme_register_required_plugins' );

function thinkup_theme_register_required_plugins() {

	// Array of plugin arrays. Required keys are name and slug.
	$plugins = array(
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Black Studio TinyMCE',
			'slug' 		=> 'black-studio-tinymce-widget',
			'required' 	=> false,
		),
    );

	// Array of configuration settings. Amend each line as needed.
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}


//----------------------------------------------------------------------------------
//	CORRECT Z-INDEX OF OEMBED OBJECTS
//----------------------------------------------------------------------------------
function thinkup_fix_oembed( $embed ) {
	if ( strpos( $embed, '<param' ) !== false ) {
   		$embed = str_replace( '<embed', '<embed wmode="transparent" ', $embed );
   		$embed = preg_replace( '/param>/', 'param><param name="wmode" value="transparent" />', $embed, 1);
	}
	return $embed;
}
add_filter( 'embed_oembed_html', 'thinkup_fix_oembed', 1 );


//----------------------------------------------------------------------------------
//	ADD PAGE TITLE
//----------------------------------------------------------------------------------

function thinkup_title_select() {
	global $post;

	if ( is_page() ) {
		printf( '<span>%s</span>', esc_html( get_the_title() ) );
	} elseif ( is_attachment() ) {
		printf( '<span>' . __( 'Blog Post Image: ', 'renden' ) . '</span>' . '%s', esc_html( get_the_title( $post->post_parent ) ) );
	} else if ( is_single() ) {
		printf( '<span>%s</span>', html_entity_decode( esc_html( get_the_title() ) ) );
	} else if ( is_search() ) {
		printf( '<span>' . __( 'Search Results: ', 'renden' ) . '</span>' . '%s', esc_html( get_search_query() ) );
	} else if ( is_404() ) {
		printf( '<span>' . __( 'Page Not Found', 'renden' ) . '</span>' );
	} else if ( is_category() ) {
		printf( '<span>' . __( 'Category Archives: ', 'renden' ) . '</span>' . '%s', single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		printf( '<span>' . __( 'Tag Archives: ', 'renden' ) . '</span>' . '%s', single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		the_post();
		printf( '<span>' . __( 'Author Archives: ', 'renden' ) . '</span>' . '%s', get_the_author() );
		rewind_posts();
	} elseif ( is_day() ) {
		printf( '<span>' . __( 'Daily Archives: ', 'renden' ) . '</span>' . '%s', get_the_date() );
	} elseif ( is_month() ) {
		printf( '<span>' . __( 'Monthly Archives: ', 'renden' ) . '</span>' . '%s', get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		printf( '<span>' . __( 'Yearly Archives: ', 'renden' ) . '</span>' . '%s', get_the_date( 'Y' ) );
	} elseif ( is_post_type_archive( 'portfolio' ) ) {
		printf( '<span>' . __( 'Portfolio', 'renden' ) . '</span>' );
	} elseif ( is_post_type_archive( 'client' ) ) {
		printf( '<span>' . __( 'Our Clients', 'renden' ) . '</span>' );
	} elseif ( is_post_type_archive( 'team' ) ) {
		printf( '<span>' . __( 'Our Team', 'renden' ) . '</span>' );
	} elseif ( is_post_type_archive( 'testimonial' ) ) {
		printf( '<span>' . __( 'Customer Testimonials', 'renden' ) . '</span>' );
	} elseif ( is_post_type_archive( 'product' ) and function_exists( 'thinkup_woo_titleshop_archive' ) ) {
		printf( thinkup_woo_titleshop_archive() );
	} elseif ( is_archive() ) {
		printf( get_the_archive_title() );
	} elseif ( is_tax() ) {
		printf( get_queried_object()->name );
	} elseif ( thinkup_check_isblog() ) {
		printf( '<span>' . __( 'Blog', 'renden' ) . '</span>' );
	} else {
		printf( '<span>%s</span>', html_entity_decode( esc_html( get_the_title() ) ) );
	}
}

// Remove "archive" text from custom post type archive pages
function thinkup_title_select_cpt($title) {
    if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'thinkup_title_select_cpt' );


//----------------------------------------------------------------------------------
//	ADD BREADCRUMBS FUNCTIONALITY
//----------------------------------------------------------------------------------

function thinkup_input_breadcrumb() {
global $thinkup_general_breadcrumbdelimeter;

	$output           = NULL;
	$count_loop       = NULL;
	$count_categories = NULL;

	if ( empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter">/</span>';
	} else if ( ! empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter"> ' . $thinkup_general_breadcrumbdelimeter . ' </span>';
	}

	$delimiter_inner   =   '<span class="delimiter_core"> &bull; </span>';
	$main              =   __( 'Home', 'renden' );
	$maxLength         =   30;

	/* Archive variables */
	$arc_year       =   get_the_time('Y');
	$arc_month      =   get_the_time('F');
	$arc_day        =   get_the_time('d');
	$arc_day_full   =   get_the_time('l');  

	/* URL variables */
	$url_year    =   get_year_link($arc_year);
	$url_month   =   get_month_link($arc_year,$arc_month);

	/* Display breadcumbs if NOT the home page */
	if ( ! is_front_page() ) {
		$output .= '<div id="breadcrumbs"><div id="breadcrumbs-core">';
		global $post, $cat;
		$homeLink = home_url( '/' );
		$output .= '<a href="' . esc_url( $homeLink ) . '">' . esc_html( $main ) . '</a>' . $delimiter;    

		/* Display breadcrumbs for single post */
		if ( is_single() ) {
			$category = get_the_category();
			$num_cat = count($category);
			if ($num_cat <=1) {
				$output .= ' ' . html_entity_decode( esc_html( get_the_title() ) );
			} else {

				// Count Total categories
				foreach( get_the_category() as $category) {
					$count_categories++;
				}
				
				// Output Categories
				foreach( get_the_category() as $category) {
					$count_loop++;

					if ( $count_loop < $count_categories ) {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>' . $delimiter_inner; 
					} else {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>'; 
					}
				}
				
				if (strlen(get_the_title()) >= $maxLength) {
					$output .=  ' ' . $delimiter . esc_html( trim( substr( get_the_title(), 0, $maxLength ) ) ) . ' &hellip;';
				} else {
					$output .=  ' ' . $delimiter . esc_html( get_the_title() );
				}
			}
		} elseif (is_category()) {
			$output .= '<span class="breadcrumbs-cat">' . __( 'Archive Category: ', 'renden' ) . '</span>' . esc_html( single_cat_title("", false) );
		} elseif ( is_tag() ) {
			$output .= '<span class="breadcrumbs-tag">' . __( 'Posts Tagged: ', 'renden' ) . '</span>' . single_tag_title("", false);
		} elseif ( is_day()) {
			$output .=  '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
			$output .=  '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
		} elseif ( is_month() ) {
			$output .=  '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
		} elseif ( is_year() ) {
			$output .=  $arc_year;
		} elseif ( is_search() ) {
			$output .= __( 'Search Results for: ', 'renden' ) . esc_html( get_search_query() ) . '"';
		} elseif ( is_page() && !$post->post_parent ) {
			$output .=  esc_html( get_the_title() );
		} elseif ( is_page() && $post->post_parent ) {
			$post_array = get_post_ancestors( $post );
			krsort( $post_array ); 
			foreach( $post_array as $key=>$postid ){
				$post_ids = get_post( $postid );
				$title = $post_ids->post_title;
				$output  .= '<a href="' . esc_url( get_permalink( $post_ids ) ) . '">' . esc_html( $title ) . '</a>' . $delimiter;
			}
			$output .= esc_html( get_the_title() );
		} elseif ( is_author() ) {
			global $author;
			$user_info = get_userdata($author);
			$output .= __( 'Archived Article(s) by Author: ', 'renden' ) . esc_html( $user_info->display_name );
		} elseif ( is_404() ) {
			$output .= __( 'Error 404 - Not Found.', 'renden' );
		} elseif ( is_post_type_archive( 'portfolio' )	) {
			$output .= __( 'Portfolio', 'renden' );
		} elseif ( is_post_type_archive( 'client' )	) {
			$output .= __( 'Clients', 'renden' );
		} elseif ( is_post_type_archive( 'team' )	) {
			$output .= __( 'Team', 'renden' );
		} elseif ( is_post_type_archive( 'testimonial' )	) {
			$output .= __( 'Testimonials', 'renden' );
		} elseif ( is_post_type_archive( 'product' ) and function_exists( 'thinkup_woo_titleshop_archive' ) ) {
			$output .= thinkup_woo_titleshop_archive();
		} elseif ( is_archive() ) {
			$output .= get_the_archive_title();
		} elseif( is_tax() ) {
			$output .= esc_html( get_queried_object()->name );
		} elseif ( thinkup_check_isblog() ) {
			$output .= __( 'Blog', 'renden' );
		} else {
			$output .= html_entity_decode( esc_html( get_the_title() ) );
		}

		$output .=  '</div></div>';
	   
		return $output;
    }
}


/* ----------------------------------------------------------------------------------
	ADD MENU DESCRIPTION FEATURE
---------------------------------------------------------------------------------- */

class thinkup_menudescription extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		
		$item_output = NULL;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : ' href="' . get_permalink( $item->ID ) . '"';

        // Insert title for top level
		if ( has_nav_menu( 'header_menu' ) ) {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );
		} else {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', get_the_title($item->ID), $item->ID ) . '</span>' : apply_filters( 'the_title', get_the_title($item->ID), $item->ID );
		}

        // Structure of output
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $title;
		$item_output .= '</a>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


//----------------------------------------------------------------------------------
//	ADD PAGINATION FUNCTIONALITY
//----------------------------------------------------------------------------------
function thinkup_input_pagination( $pages = "", $range = 2 ) {
global $paged;
global $wp_query;

$pag_before  = NULL;
$pag_after   = NULL;
$pag_current = NULL;
$pag_close   = NULL;
$pag_clear   = NULL;

	$showitems = ($range)+1;  

	if(empty($paged)) $paged = 1;

	if($pages == "") {
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}

if ( $paged > 1 ) {
	$pag_before  = '<span class="pag-before">';
	$pag_current = '</span><span class="pag-current">';
	$pag_after   = '</span><span class="pag-after">';
	$pag_close   = '</span>';
	$pag_clear   = '<span class="clearboth"></span>';
}

if ( $paged == 1 ) {
	$pag_class = ' pag-start';
} else if ( $paged == $pages ) {
	$pag_class = ' pag-end';
} else {
	$pag_class = ' pag-inner';
}

	if(1 != $pages) {
		echo '<ul class="pag' . $pag_class . '">';

			echo $pag_before;
	
			if($paged > 2 && $paged > $range+1 && $showitems < $pages)
				echo '<li class="pag-first"><a href="' . get_pagenum_link(1). '"><i class="fa fa-angle-double-left"></i></a></li>';
			if($paged > 1 && $showitems < $pages) 
				echo '<li class="pag-previous"><a href="' . get_pagenum_link($paged - 1). '"><i class="fa fa-angle-left"></i></a></li>';

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					if ( $paged == $i ) {
						echo $pag_current;
							echo '<li class="current"><span>' . $i . '</span></li>'; 
						echo $pag_after;
					} else {
						echo '<li><a href="' . get_pagenum_link($i) . '">'. $i . '</a></li>';
					}
				}
			}

			if ($paged < $pages && $showitems < $pages)
				echo '<li class="pag-next"><a href="' . get_pagenum_link($paged + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				echo '<li class="pag-last" ><a href="' . get_pagenum_link($pages) . '"><i class="fa fa-angle-double-right"></i></a></li>';

			echo $pag_close;
			echo $pag_clear;

		echo '</ul>';
	}
}


//----------------------------------------------------------------------------------
//	REMOVE NON VALID REL CATEGORY TAGS
//----------------------------------------------------------------------------------

function thinkup_removerel_category( $text ) { 
	$text = str_replace( 'rel="category"', "", $text );
	return $text; 
};
add_filter( 'the_category', 'thinkup_removerel_category' );  


//----------------------------------------------------------------------------------
//	DELAY AUTOP
//----------------------------------------------------------------------------------

// Remove unwanted <p> and <br /> tags around shortcodes
function thinkup_shortcodes_fixautop($content) {

	// Create arry of ThinkUpShortcodes to prevent formatting issues
	$block = join( '|' , array( 
			'accordion1',
			'accordion2',
			'blockquote1',
			'blockquote2',
			'button1',
			'button2',
			'button3',
			'button4',
			'carousel_blog',
			'carousel_clients',
			'carousel_portfolio',
			'carousel_team',
			'carousel_testimonial',
			'divider',
			'divider_top',
			'facebook',
			'five_sixth',
			'five_sixth_last',
			'font',
			'font_full1',
			'font_full2',
			'font_text',
			'four_fifth',
			'four_fifth_last',
			'google',
			'h1title',
			'h2title',
			'h3title',
			'h4title',
			'h5title',
			'h6title',
			'icon',
			'icon_full',
			'icon_text',
			'image',
			'item_client',
			'item_portfolio',
			'item_team',
			'linkedin',
			'list_font',
			'margin',
			'notification',
			'one_fifth',
			'one_fifth_last',
			'one_fourth',
			'one_fourth_last',
			'one_half',
			'one_half_last',
			'one_sixth',
			'one_sixth_last',
			'one_third_last',
			'pricing1',
			'pricing2',
			'progress1',
			'progress2',
			'progress3',
			'progress4',
			'slider_blog',
			'slider_image',
			'slider_portfolio',
			'tabs1',
			'tabs2',
			'three_fifth',
			'three_fifth_last',
			'three_fourth',
			'three_fourth_last',
			'twitterfollow',
			'twittertweet',
			'two_fifth',
			'two_fifth_last',
			'two_third',
			'two_third_last',
			'vimeo',
			'youtube',
		)
	);

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
}
add_filter('the_content', 'thinkup_shortcodes_fixautop');


//----------------------------------------------------------------------------------
//	ADD CUSTOM FEATURED IMAGE SIZES
//----------------------------------------------------------------------------------

if ( ! function_exists( 'thinkup_input_addimagesizes' ) ) {
	function thinkup_input_addimagesizes() {

		// Image size for testimonial shortcode
		add_image_size( 'sc-testimonial', 53, 53, true );

		/* 1 Column Layout */
		add_image_size( 'column1-1/2', 1140, 570, true );
		add_image_size( 'column1-1/3', 1140, 380, true );
		add_image_size( 'column1-1/4', 1140, 285, true );
		add_image_size( 'column1-2/5', 1140, 456, true );

		/* 2 Column Layout */
		add_image_size( 'column2-1/1', 570, 570, true );
		add_image_size( 'column2-1/4', 570, 142, true );
		add_image_size( 'column2-1/2', 570, 285, true );
		add_image_size( 'column2-2/3', 570, 380, true );
		add_image_size( 'column2-3/5', 570, 342, true );

		/* 3 Column Layout */
		add_image_size( 'column3-1/1', 380, 380, true );
		add_image_size( 'column3-1/3', 380, 127, true );
		add_image_size( 'column3-2/5', 380, 152, true );	
		add_image_size( 'column3-2/3', 380, 254, true );
		add_image_size( 'column3-3/4', 380, 285, true );

		/* 4 Column Layout */
		add_image_size( 'column4-1/1', 285, 285, true );
		add_image_size( 'column4-2/3', 285, 190, true );
		add_image_size( 'column4-3/4', 285, 214, true );
	}
	add_action( 'after_setup_theme', 'thinkup_input_addimagesizes' );
}

if ( ! function_exists( 'thinkup_input_showimagesizes' ) ) {	 
	function thinkup_input_showimagesizes($sizes) {

		// 1 Column Layout
		$sizes['column1-1/2'] = __( 'Full - 1:2', 'renden' );
		$sizes['column1-1/3'] = __( 'Full - 1:3', 'renden' );
		$sizes['column1-1/4'] = __( 'Full - 1:4', 'renden' );
		$sizes['column1-2/5'] = __( 'Full - 2:5', 'renden' );

		// 2 Column Layout
		$sizes['column2-1/1'] = __( 'Half - 1:1', 'renden' );
		$sizes['column2-1/2'] = __( 'Half - 1:2', 'renden' );
		$sizes['column2-2/3'] = __( 'Half - 2:3', 'renden' );
		$sizes['column2-3/5'] = __( 'Half - 3:5', 'renden' );

		// 3 Column Layout
		$sizes['column3-1/1'] = __( 'Third - 1:1', 'renden' );
		$sizes['column3-2/5'] = __( 'Third - 2:5', 'renden' );
		$sizes['column3-2/3'] = __( 'Third - 2:3', 'renden' );
		$sizes['column3-3/4'] = __( 'Third - 3:4', 'renden' );

		// 4 Column Layout
		$sizes['column4-1/1'] = __( 'Quarter - 1:1', 'renden' );
		$sizes['column4-2/3'] = __( 'Quarter - 2:3', 'renden' );
		$sizes['column4-3/4'] = __( 'Quarter - 3:4', 'renden' );

		return $sizes;
	}
	add_filter('image_size_names_choose', 'thinkup_input_showimagesizes');
}

//----------------------------------------------------------------------------------
//	ADD HOME: HOME TO CUSTOM MENU PAGE LIST
//----------------------------------------------------------------------------------

function thinkup_menu_homelink( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thinkup_menu_homelink' );


//----------------------------------------------------------------------------------
//	ADD FUNCTION TO GET CURRENT PAGE URL
//----------------------------------------------------------------------------------

function thinkup_check_currentpage() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= '://' . wp_unslash( $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] );

	$pageURL    = rtrim($pageURL, '/') . '/';
	$currentURL = get_permalink();

	// Add www. to current page url if present in permalink
	if (strpos( $currentURL, 'www.' ) !== false) {
		if (strpos( $pageURL, '://www.' ) !== false) {
			$pageURL = $pageURL;
		} else {
			$pageURL = str_replace( "://", "://www.", $pageURL );
		}
	} else {
		$pageURL = str_replace( "www.", "", $pageURL );
	}

	// Add trailing slash "/" at end of link if present in permalink
	if ( substr( $currentURL, -1 ) == '/' ) {
		$pageURL = trailingslashit( $pageURL );
	} else {
		$pageURL = untrailingslashit( $pageURL );
	}

	// Add correct http: or https: prefix to current page url
	if (strpos( $currentURL, 'http://' ) !== false) {
		$pageURL = str_replace( "https://", "http://", $pageURL );
	} else {
		$pageURL = str_replace( "http://", "https://", $pageURL );
	}

	return $pageURL;
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM COMMENTS POP UP LINK FUNCTION - Credit to http://www.thescubageek.com/code/wordpress-code/add-get_comments_popup_link-to-wordpress/
//----------------------------------------------------------------------------------

// Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
function thinkup_input_commentspopuplink( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','renden' );
    if ( false === $one ) $one = __( '1 Comment','renden' );
    if ( false === $more ) $more = __( '% Comments','renden' );
    if ( false === $none ) $none = __( 'Comments Off','renden' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','renden');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','renden'), $title ) ) . '">';
    $str .= thinkup_comments_returnstring( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
 
// Modifies WordPress's built-in comments_number() function to return string instead of echo
function thinkup_comments_returnstring( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __( '% Comments', 'renden' ) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __( 'No Comments', 'renden' ) : $zero;
    else // must be one
        $output = ( false === $one ) ? __( '1 Comment', 'renden' ) : $one;
 
    return apply_filters('comments_number', $output, $number);
}


//----------------------------------------------------------------------------------
//	CHANGE FALLBACK WP_PAGE_MENU CLASSES TO MATCH WP_NAV_MENU CLASSES
//----------------------------------------------------------------------------------

function thinkup_input_menuclass( $ulclass ) {

	// Add menu class to list
	$ulclass = preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
	$ulclass = str_replace( 'children', 'sub-menu', $ulclass );

	// Remove div wrapper
	$ulclass = str_replace( '<div class="menu">', '', $ulclass );
	$ulclass = str_replace( '</div>', '', $ulclass );

	return preg_replace('/<div (.*)>(.*)<\/div>/iU', '$2', $ulclass );
}
add_filter( 'wp_page_menu', 'thinkup_input_menuclass' );


//----------------------------------------------------------------------------------
//	DETERMINE IF THE PAGE IS A BLOG - USEFUL FOR HOMEPAGE BLOG.
//----------------------------------------------------------------------------------

// Credit to: http://www.poseidonwebstudios.com/web-development/wordpress-is_blog-function/
function thinkup_check_isblog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() )
        && ($post_type == 'post')
    ) ? true : false ;
 
}


//----------------------------------------------------------------------------------
//	ADD TAGS AND CATEGORIES TO PAGES.
//----------------------------------------------------------------------------------

// Register taxonomies for pages
function thinkup_taxonomy_pages() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
	register_taxonomy_for_object_type( 'category', 'page' );
}
if ( ! is_admin() ) {
	add_action( 'pre_get_posts', 'thinkup_archives_category' );
	add_action( 'pre_get_posts', 'thinkup_archives_tags' );
}

// Add categories to pages
function thinkup_archives_category( $wp_query ) {
	if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
	$wp_query->set( 'post_type', 'any' );
}

// Add tags to pages
function thinkup_archives_tags( $wp_query ) {
	if ( $wp_query->get( 'tag' ) )
		$wp_query->set( 'post_type', 'any' );
}
add_action( 'init', 'thinkup_taxonomy_pages' );


//----------------------------------------------------------------------------------
//	CONVERT HEX COLORS TO RGB.
//----------------------------------------------------------------------------------

function thinkup_convert_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}


//----------------------------------------------------------------------------------
//	ADD FEATURED IMAGE THUMBNAIL.
//----------------------------------------------------------------------------------

// Add featured images to posts
add_filter('manage_pages_columns', 'thinkup_posts_columns', 5);
add_filter('manage_posts_columns', 'thinkup_posts_columns', 5);
add_action('manage_posts_custom_column', 'thinkup_posts_custom_columns', 5, 2);
add_action('manage_pages_custom_column', 'thinkup_posts_custom_columns', 5, 2);
function thinkup_posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __( 'Thumbs', 'lan-thinkupthemes' );
    return $defaults;
}
function thinkup_posts_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'thumbnail' );
    }
}


//----------------------------------------------------------------------------------
//	GET EXCERPT BY ID.
//----------------------------------------------------------------------------------

function thinkup_input_excerptbyid( $post_id, $except_count = 55 ) {
	$the_post = get_post( $post_id );
	
	// Get post excerpt
	$the_excerpt = $the_post->post_excerpt;
	
	// Get post content if no excerp set
	if ( empty( $the_excerpt ) ) {
		$the_excerpt = $the_post->post_content;
	}

	//Sets excerpt length by word count
	$excerpt_length = $except_count;

	 //Strips tags and images
	$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) );
	$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );

	if( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		array_push( $words, '…' );
		$the_excerpt = implode( ' ', $words );
	}

	if ( ! empty( $the_excerpt ) ) {
		$the_excerpt = '<p>' . $the_excerpt . '</p>';
	}
	return $the_excerpt;
}


//----------------------------------------------------------------------------------
//	ADD MORE BUTTONS TO VISUAL EDITOR.
//----------------------------------------------------------------------------------

function thinkup_visualeditor_morebuttons($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';

	return $buttons;
}
add_filter( 'mce_buttons_3', 'thinkup_visualeditor_morebuttons' );


//----------------------------------------------------------------------------------
//	ADD GOOGLE FONT - OPEN SANS. (http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/)
//----------------------------------------------------------------------------------

function thinkup_googlefonts_url() {
    $fonts_url = '';

    // Translators: Translate this to 'off' if there are characters in your language that are not supported by Open Sans
    $font_translate = _x( 'on', 'Open Sans font: on or off', 'renden' );
 
    if ( 'off' !== $font_translate ) {
        $font_families = array();
  
        if ( 'off' !== $font_translate ) {
            $font_families[] = 'Open Sans:300,400,600,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function thinkup_googlefonts_scripts() {
   wp_enqueue_style( 'thinkup-google-fonts', thinkup_googlefonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'thinkup_googlefonts_scripts' );


//----------------------------------------------------------------------------------
//	FIX JETPACK PHOTON IMAGE LOAD ISSUE - DISABLE CACHING FOR SPECIFIC IMAGES 
//----------------------------------------------------------------------------------

function thinkup_photon_exception( $val, $src, $tag ) {
        if ( $src == get_template_directory_uri() . '/images/transparent.png' ) {
                return true;
        }
        return $val;
}
add_filter( 'jetpack_photon_skip_image', 'thinkup_photon_exception', 10, 3 );


//----------------------------------------------------------------------------------
//	CUSTOM FUNCTION TO CHECK IF USER IS ON THE LOGIN PAGE
//----------------------------------------------------------------------------------

if ( ! function_exists( 'thinkup_is_login_page' ) ) {
	function thinkup_is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}


//----------------------------------------------------------------------------------
//	CUSTOM FUNCTION TO GET IMAGE SIZES
//----------------------------------------------------------------------------------

function thinkup_get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}

function thinkup_get_image_size( $size ) {
	$sizes = thinkup_get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}


//----------------------------------------------------------------------------------
//	REMOVE ALL CUSTOM TUT METABOXES FROM GUTENBERG PAGES
//----------------------------------------------------------------------------------

function thinkup_disable_panels_for_gutenberg_posts( $wp_meta_boxes ) {

	// Loop through all meta box combinations to find TUT meta boxes and remove
	foreach ( $wp_meta_boxes as &$locations ) {
		foreach ( $locations as &$priorities ) {
			foreach ( $priorities as &$boxes ) {
				foreach ( $boxes as $box_key => $box_value ) {

					// Remove all TUT meta box
					if ( strpos( $box_key, 'thinkup' ) !== false ) {
						unset( $boxes[$box_key] );
					}

				}
			}
		}
	}
	return $wp_meta_boxes;
}
add_filter( 'filter_gutenberg_meta_boxes', 'thinkup_disable_panels_for_gutenberg_posts' );
