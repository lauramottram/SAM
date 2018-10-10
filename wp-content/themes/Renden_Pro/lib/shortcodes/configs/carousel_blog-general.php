<?php
/**
*
* fieldconfig for thinkupshortcodes/General
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2018 Think Up Themes Ltd
*/


$group = array(
	'label' => __('General','thinkupshortcodes'),
	'id' => '293489',
	'master' => 'items',
	'fields' => array(
		'items'	=>	array(
			'label'		=> 	__('Items','thinkupshortcodes'),
			'caption'	=>	__('Choose the number of blog posts to display in carousel window','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'2,3,4',
		),
		'scroll'	=>	array(
			'label'		=> 	__('Scroll','thinkupshortcodes'),
			'caption'	=>	__('Choose the number of blog posts to scroll on click','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'1,2,3,4',
		),
		'speed'	=>	array(
			'label'		=> 	__('Scroll Duration','thinkupshortcodes'),
			'caption'	=>	__('Specify a duartion for the carousel scroll in milliseconds (default = 500)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'500',
		),
		'effect'	=>	array(
			'label'		=> 	__('Effect','thinkupshortcodes'),
			'caption'	=>	__('Choose a scroll effect (Default: scroll)','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'none,scroll,directscroll,fade,crossfade,cover,cover-fade,uncover,uncover-fade',
		),
		'link_icon'	=>	array(
			'label'		=> 	__('Link Icon','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'lightbox_icon'	=>	array(
			'label'		=> 	__('Lightbox Icon','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'onoff',
			'default'	=> 	'*on||on,off||off',
			'inline'	=> 	true,
		),
		'title'	=>	array(
			'label'		=> 	__('Title (on or off)','thinkupshortcodes'),
			'caption'	=>	__('Toggle post title','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'excerpt'	=>	array(
			'label'		=> 	__('Excerpt (on or off)','thinkupshortcodes'),
			'caption'	=>	__('Toggle post title','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'date'	=>	array(
			'label'		=> 	__('Date (on or off)','thinkupshortcodes'),
			'caption'	=>	__('Toggle post details','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'comments'	=>	array(
			'label'		=> 	__('Comments (on or off)','thinkupshortcodes'),
			'caption'	=>	__('Toggle post comment count','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'center'	=>	array(
			'label'		=> 	__('Center align?','thinkupshortcodes'),
			'caption'	=>	__('Choose whether to align center in center.','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on,*off',
			'inline'	=> 	true,
		),
		'category'	=>	array(
			'label'		=> 	__('Category','thinkupshortcodes'),
			'caption'	=>	__('Input the category ID number to display posts from a single category (i.e. 0 = all).','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'toggles.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
	),
	'multiple'	=> false,
);

