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
	'id' => '41139102',
	'master' => 'size',
	'fields' => array(
		'size'	=>	array(
			'label'		=> 	__('Size','thinkupshortcodes'),
			'caption'	=>	__('Choose a button size.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'small||Small,*medium||Medium,large||Large',
		),
		'width'	=>	array(
			'label'		=> 	__('Width','thinkupshortcodes'),
			'caption'	=>	__('Choose a button width.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*standard||Standard,wide||Wide',
		),
		'link'	=>	array(
			'label'		=> 	__('Link','thinkupshortcodes'),
			'caption'	=>	__('Add a link. Make sure to use http:// for external links.','thinkupshortcodes'),
			'type'		=>	'textfield',
			'default'	=> 	'',
		),
		'icon'	=>	array(
			'label'		=> 	__('Icon','thinkupshortcodes'),
			'caption'	=>	__('Choose and icon to display.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'adjust,adn,align-center,align-justify,align-left,align-right,ambulance,anchor,android,angle-double-down,angle-double-left,angle-double-right,angle-double-up,angle-down,angle-left,angle-right,angle-up,apple,archive,arrow-circle-down,arrow-circle-left,arrow-circle-o-down,arrow-circle-o-left,arrow-circle-o-right,arrow-circle-o-up,arrow-circle-right,arrow-circle-up,arrow-down,arrow-left,arrow-right,arrows,arrows-alt,arrows-h,arrows-v,arrow-up,asterisk,backward,ban,bar-chart-o,barcode,bars,beer,behance,behance-square,bell,bell-o,bitbucket,bitbucket-square,bold,bolt,bomb,book,bookmark,bookmark-o,briefcase,btc,bug,building,building-o,bullhorn,bullseye,calendar,calendar-o,camera,camera-retro,car,caret-down,caret-left,caret-right,caret-square-o-down,caret-square-o-left,caret-square-o-right,caret-square-o-up,caret-up,certificate,chain-broken,check,check-circle,check-circle-o,check-square,check-square-o,chevron-circle-down,chevron-circle-left,chevron-circle-right,chevron-circle-up,chevron-down,chevron-left,chevron-right,chevron-up,child,circle,circle-o,circle-o-notch,circle-thin,clipboard,clock-o,cloud,cloud-download,cloud-upload,code,code-fork,codepen,coffee,cog,cogs,columns,comment,comment-o,comments,comments-o,compass,compress,credit-card,crop,crosshairs,css3,cube,cubes,cutlery,database,delicious,desktop,deviantart,digg,dot-circle-o,download,dribbble,dropbox,drupal,eject,ellipsis-h,ellipsis-v,empire,envelope,envelope-o,envelope-square,eraser,eur,exchange,exclamation,exclamation-circle,exclamation-triangle,expand,external-link,external-link-square,eye,eye-slash,facebook,facebook-square,fast-backward,fast-forward,fax,female,fighter-jet,file,file-archive-o,file-audio-o,file-code-o,file-excel-o,file-image-o,file-o,file-pdf-o,file-powerpoint-o,files-o,file-text,file-text-o,file-video-o,file-word-o,film,filter,fire,fire-extinguisher,flag,flag-checkered,flag-o,flask,flickr,floppy-o,folder,folder-o,folder-open,folder-open-o,font,forward,foursquare,frown-o,gamepad,gavel,gbp,gift,git,github,github-alt,github-square,git-square,gittip,glass,globe,google,google-plus,google-plus-square,graduation-cap,hacker-news,hand-o-down,hand-o-left,hand-o-right,hand-o-up,hdd-o,header,headphones,heart,heart-o,history,home,hospital-o,h-square,html5,inbox,indent,info,info-circle,inr,instagram,italic,joomla,jpy,jsfiddle,key,keyboard-o,krw,language,laptop,leaf,lemon-o,level-down,level-up,life-ring,lightbulb-o,link,linkedin,linkedin-square,linux,list,list-alt,list-ol,list-ul,location-arrow,lock,long-arrow-down,long-arrow-left,long-arrow-right,long-arrow-up,magic,magnet,male,map-marker,maxcdn,medkit,meh-o,microphone,microphone-slash,minus,minus-circle,minus-square,minus-square-o,mobile,money,moon-o,music,openid,outdent,pagelines,paperclip,paper-plane,paper-plane-o,paragraph,pause,paw,pencil,pencil-square,pencil-square-o,phone,phone-square,picture-o,pied-piper,pied-piper-alt,pinterest,pinterest-square,plane,play,play-circle,play-circle-o,plus,plus-circle,plus-square,plus-square-o,power-off,print,puzzle-piece,qq,qrcode,question,question-circle,quote-left,quote-right,random,rebel,recycle,reddit,reddit-square,refresh,renren,repeat,reply,reply-all,retweet,road,rocket,rss,rss-square,rub,scissors,search,search-minus,search-plus,share,share-alt,share-alt-square,share-square,share-square-o,shield,shopping-cart,signal,sign-in,sign-out,sitemap,skype,slack,sliders,smile-o,sort,sort-alpha-asc,sort-alpha-desc,sort-amount-asc,sort-amount-desc,sort-asc,sort-desc,sort-numeric-asc,sort-numeric-desc,soundcloud,space-shuttle,spinner,spoon,spotify,square,square-o,stack-exchange,stack-overflow,star,star-half,star-half-o,star-o,steam,steam-square,step-backward,step-forward,stethoscope,stop,strikethrough,stumbleupon,stumbleupon-circle,subscript,suitcase,sun-o,superscript,table,tablet,tachometer,tag,tags,tasks,taxi,tencent-weibo,terminal,text-height,text-width,th,th-large,th-list,thumbs-down,thumbs-o-down,thumbs-o-up,thumbs-up,thumb-tack,ticket,times,times-circle,times-circle-o,tint,trash-o,tree,trello,trophy,truck,try,tumblr,tumblr-square,twitter,twitter-square,umbrella,underline,undo,university,unlock,unlock-alt,upload,usd,user,user-md,users,video-camera,vimeo-square,vine,vk,volume-down,volume-off,volume-up,weibo,weixin,wheelchair,windows,wordpress,wrench,xing,xing-square,yahoo,youtube,youtube-play,youtube-square',
		),
		'animate'	=>	array(
			'label'		=> 	__('Animate','thinkupshortcodes'),
			'caption'	=>	__('Add an animation style.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*none,bounceIn,bounceInDown,bounceInUp,bounceInLeft,bounceInRight,bounceOut,bounceOutDown,bounceOutUp,bounceOutLeft,bounceOutRight,flipInX,flipOutX,flipInY,flipOutY,fadeIn,fadeInUp,fadeInDown,fadeInLeft,fadeInRight,fadeInUpBig,fadeInDownBig,fadeInLeftBig,fadeInRightBig,fadeOut,fadeOutUp,fadeOutDown,fadeOutLeft,fadeOutRight,fadeOutUpBig,fadeOutDownBig,fadeOutLeftBig,fadeOutRightBig,hinge,lightSpeedIn,lightSpeedOut,rollIn,rollOut,rotateIn,rotateInDownLeft,rotateInDownRight,rotateInUpLeft,rotateInUpRight,rotateOut,rotateOutDownLeft,rotateOutDownRight,rotateOutUpLeft,rotateOutUpRight,slideInDown,slideInLeft,slideInRight,slideOutUp,slideOutLeft,slideOutRight',
		),
		'delay'	=>	array(
			'label'		=> 	__('Delay','thinkupshortcodes'),
			'caption'	=>	__('Add a delay to the animation effect (ms)','thinkupshortcodes'),
			'type'		=>	'smalltextfield',
			'default'	=> 	'',
		),
		'color'	=>	array(
			'label'		=> 	__('Color (Preset)','thinkupshortcodes'),
			'caption'	=>	__('Choose a preset button color scheme.','thinkupshortcodes'),
			'type'		=>	'dropdown',
			'default'	=> 	'*default||Default,aqua||Aqua,black||Black,blue_dark||Blue (dark),blue_light||blue (light),brown||Brown,green_dark||Green (dark),green_light||Green (light),grey||Grey,red_dark||Red (dark),red_light||Red (light),pink||Pink,purple||Purple',
		),
		'color_custom'	=>	array(
			'label'		=> 	__('Custom Colors?','thinkupshortcodes'),
			'caption'	=>	__('Switch on to use custom colors (configure below).','thinkupshortcodes'),
			'type'		=>	'onoff',
			'default'	=> 	'on||On,*off||Off',
			'inline'	=> 	true,
		),
		'color_text'	=>	array(
			'label'		=> 	__('Text Color','thinkupshortcodes'),
			'caption'	=>	__('Choose a text color.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_text_hover'	=>	array(
			'label'		=> 	__('Text Color (Hover)','thinkupshortcodes'),
			'caption'	=>	__('Choose a text color on hover.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_bg'	=>	array(
			'label'		=> 	__('Background Color','thinkupshortcodes'),
			'caption'	=>	__('Choose a background color.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'color_bg_hover'	=>	array(
			'label'		=> 	__('Background Color (Hover)','thinkupshortcodes'),
			'caption'	=>	__('Choose a background color on hover.','thinkupshortcodes'),
			'type'		=>	'colorpicker',
			'default'	=> 	'',
		),
		'border_radius'	=>	array(
			'label'		=> 	__('Border Radius','thinkupshortcodes'),
          'caption'   =>  '',
			'type'		=>	'slider',
			'default'	=> 	'0,20|0|px',
			'inline'	=> 	true,
		),
	),
	'styles'	=> array(
		'toggles.css',
		'minicolors.css',
		'simple-slider.css',
	),
	'scripts'	=> array(
		'toggles.min.js',
		'minicolors.js',
		'simple-slider.min.js',
	),
	'multiple'	=> false,
);

