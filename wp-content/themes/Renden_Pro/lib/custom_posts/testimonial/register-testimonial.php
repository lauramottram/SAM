<?php
/**
 * Register Testimonial menu in admin area.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Add Testimonials Menu to Admin
---------------------------------------------------------------------------------- */
function thinkup_register_testimonialpost() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'renden' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'renden' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'renden', 'renden' ),
		'add_new_item'       => __( 'Add New Testimonial', 'renden' ),
		'edit_item'          => __( 'Edit Testimonial', 'renden' ),
		'new_item'           => __( 'New Testimonial', 'renden' ),
		'view_item'          => __( 'View Testimonial', 'renden' ),
		'search_items'       => __( 'Search Testimonials', 'renden' ),
		'not_found'          =>  __( 'No testimonials found', 'renden' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash', 'renden' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Testimonials', 'renden' ),
	);
	  
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies'         => array('category'),
		'menu_icon'          => 'dashicons-format-chat'
	);

	/* Register Testimonial menu */
	register_post_type( 'testimonial', $args );


	/* Fixes redirect to 404 error template */
	flush_rewrite_rules();
	  
	/* Initialise New Taxonomy Labels */
	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name', 'renden' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'renden' ),
		'search_items'      => __( 'Search Types', 'renden' ),
		'all_items'         => __( 'All Tags', 'renden' ),
		'parent_item'       => __( 'Parent Tag', 'renden' ),
		'parent_item_colon' => __( 'Parent Tag:', 'renden' ),
		'edit_item'         => __( 'Edit Tags', 'renden' ),
		'update_item'       => __( 'Update Tag', 'renden' ),
		'add_new_item'      => __( 'Add New Tag', 'renden' ),
		'new_item_name'     => __( 'New Tag Name', 'renden' ),
	);

	/*  Register custom taxonomy for Testimonial tags */
	register_taxonomy( 'tagtestimonial', array( 'testimonial' ), array(
		'hierarchical' => true,
		'labels'       => $labels,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'tag-testimonial' ),
	));
	  
}
add_action('init', 'thinkup_register_testimonialpost');
	

/* ----------------------------------------------------------------------------------
	Custom Testimonial Messages
---------------------------------------------------------------------------------- */
function thinkup_register_testimonialmessages( $messages ) {
global $post, $post_ID;

	$messages[ 'testimonial' ] = array(
		0 => '',
		1 => sprintf( 'Testimonial updated. <a href="%s">View testimonial</a>', esc_url( get_permalink( $post_ID ) ) ),
		2 => 'Custom field updated.',
		3 => 'Custom field deleted.',
		4 => 'Testimonial updated.',
		5 => isset($_GET[ 'revision' ]) ? sprintf( 'Testimonial restored to revision from %s', wp_post_revision_title( (int) 

$_GET[ 'revision' ], false ) ) : false,
		6 => sprintf( 'Testimonial published. <a href="%s">View testimonial</a>', esc_url( get_permalink( $post_ID ) ) ),
		7 => 'Testimonial saved.',
		8 => sprintf( 'Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( 'Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>',
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( 'Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>', esc_url( add_query_arg( 'preview', 

'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'thinkup_register_testimonialmessages' );