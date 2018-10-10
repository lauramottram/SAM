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
	'id' => '41115827',
	'master' => 'number',
	'fields' => array(
		'number'	=>	array(
			'label'		=> 	__('Number','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'title'	=>	array(
			'label'		=> 	__('Title','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay (ms)','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'textfield',
			'default'	=> 	'0',
		),
		'color_custom'	=>	array(
			'label'		=> 	__('Custom Color?','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'onoff',
			'default'	=> 	'on||On,*off||Off',
			'inline'	=> 	true,
		),
		'color_number'	=>	array(
			'label'		=> 	__('Color (Number)','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
	),
	'styles'	=> array(
		'toggles.css',
		'minicolors.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
		'minicolors.js',
	),
	'multiple'	=> false,
);

