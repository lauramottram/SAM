<?php
/**
*
* fieldconfig for thinkupshortcodes/General Settings
*
* @package Thinkupshortcodes
* @author Think Up Themes Ltd contact@thinkupthemes.com
* @license GPL-2.0+
* @link www.thinkupthemes.com
* @copyright 2018 Think Up Themes Ltd
*/


$group = array(
	'label' => __('General Settings','thinkupshortcodes'),
	'id' => '1585702',
	'master' => 'title',
	'fields' => array(
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
			'caption'	=>	__('Title','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'teaser'	=>	array(
			'label'		=> 	__('Teaser','thinkupshortcodes'),
			'caption'	=>	__('Teaser','thinkupshortcodes'),
			'type'		=>	'textbox',
			'default'	=> 	'',
		),
		'button'	=>	array(
			'label'		=> 	__('Button Text','thinkupshortcodes'),
			'caption'	=>	__('Button Text','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'link'	=>	array(
			'label'		=> 	__('Button Link','thinkupshortcodes'),
			'caption'	=>	__('Button Link','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'target'	=>	array(
			'label'		=> 	__('Button Target','thinkupshortcodes'),
			'caption'	=>	__('Button Target','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*current||Current Tab ,new||New Tab',
		),
	),
	'multiple'	=> false,
);

