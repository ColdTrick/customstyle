<?php
	/**
	* CustomStyle - EN Language File
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	
	$english = array(
	
		'customstyle' => 'Custom Style',
		'customstyle:title' => 'Custom Style',
		'customstyle:shorttitle' => 'Custom Style',
		
		//objects
		'item:object:customstylecolors' => 'Custom Style Colors Configuration',
		'item:object:customstylebackground' => 'Custom Style Background Configuration',
		
		'customstyle:spotlight' => 'This plugin allows you to fully customize your profile. Everyone who visits your profile will experience it how you defined it. You have control over the background and some colors. If you dont like your own choices anymore, you can switch back to default settings. Have <b>fun</b> and be <b>creative</b>!',
		
		//admin settings
		'customstyle:settings:options' => 'Select which of the following items can be configured.',
		'customstyle:settings:upload' => 'Allow upload of custom background images',
		'customstyle:settings:maxupload' => 'Max upload image size (in bytes)',
		'customstyle:settings:river' => 'Changes in style posted to the river',
	
		//menu
		
		'customstyle:menu:colors' => 'Colors',
		'customstyle:menu:background' => 'Background',
		
		//river
		'customstyle:river:change' => '%s changed the style of his/her profile',
	
		//information
		'customstyle:information:welcome' => 'The options in the menu give you the ability to change the look and feel of your personal profile. The changes you make will effect the appearance of your profile.',
		'customstyle:information:colors' => 'Here you can change many colors of your profile or select from a predifined set of colors.',
		'customstyle:information:background' => 'Here you can change the background image by selecting a default image or upload your own.',
	
		//colors config
		'customstyle:colors:title' => 'Customize your profile colors',
		'customstyle:colors:noconfig' => 'Currently you have no custom colors. The default colors will be used. If you want to configure your own colors press the button below.',
		'customstyle:colors:customizebutton' => 'Yes, i would like to customize my colors!',
		'customstyle:colors:reset' => 'Return to default color settings',
		'customstyle:colors:selectstyle' => 'Choose one of the following default color sets or choose to customize everything.',
		
		'customstyle:colors:save:success' => 'Succesfully saved your colors.',
		'customstyle:colors:reset:success' => 'Succesfully returned to default color settings.',
		'customstyle:colors:configure:transparent' => 'Transparent',
		
		'customstyle:colors:configure:preset:title' => 'Preset colors',
		'customstyle:colors:configure:preset:info' => 'Choose a preset colorscheme',
		
		
		// configurable colors
		'customstyle:colors:configure:background:title' => 'Configure background color',
		'customstyle:colors:configure:background:info' => 'Select a color for the background. Check transparent for a transparent background.',
		
		'customstyle:colors:configure:headerbackground:title' => 'Configure header background color',
		'customstyle:colors:configure:headerbackground:info' => 'Select a color for the header background. Check transparent for a transparent header background.',
		
		'customstyle:colors:configure:contentbackground:title' => 'Configure content background color',
		'customstyle:colors:configure:contentbackground:info' => 'Select a color for the content background. Check transparent for a transparent background.',
		
		'customstyle:colors:configure:profilebox:title' => 'Configure profile box background color',
		'customstyle:colors:configure:profilebox:info' => 'Select a color for the profile box background. Check transparent for a transparent background.',
		
		'customstyle:colors:configure:widgettitle:title' => 'Configure widget title color',
		'customstyle:colors:configure:widgettitle:info' => 'Select a color for the widget title. Check transparent for a transparent color.',
		
		'customstyle:colors:configure:widgetheader:title' => 'Configure widget header background color',
		'customstyle:colors:configure:widgetheader:info' => 'Select a color for the widget header background. Check transparent for a transparent background.',
		
		'customstyle:colors:configure:widgetbody:title' => 'Configure widget body background color',
		'customstyle:colors:configure:widgetbody:info' => 'Select a color for the widget body background. Check transparent for a transparent background.',
		
		'customstyle:colors:configure:fontcolor:title' => 'Configure all font color',
		'customstyle:colors:configure:fontcolor:info' => 'Select a color for all fonts. Check transparent for a transparent color.',
		
		'customstyle:colors:configure:linkcolor:title' => 'Configure link font color',
		'customstyle:colors:configure:linkcolor:info' => 'Select a color for the links. Check transparent for a transparent color.',
		
		//background config
		'customstyle:background:title' => 'Customize your profile background',
		'customstyle:background:noconfig' => 'Currently you have no custom background. The default background will be used. If you want to configure your own background press the button below.',
		'customstyle:background:customizebutton' => 'Yes, i would like to customize my background!',
		'customstyle:background:selectinfo' => 'Choose one of the following default backgrounds or upload your own.',
		'customstyle:background:custombackground' => 'My own background',
		'customstyle:background:currentbackground' => 'Current image',
		'customstyle:background:previouslyuploadedbackground' => 'Previously uploaded',
		'customstyle:background:reset' => 'Return to default background settings',
		'customstyle:background:reset:success' => 'Succesfully returned to default background settings',
		'customstyle:background:error:unknown' => 'Unknown error occurred. Please try again or contact your administrator.',
		'customstyle:background:error:image' => 'Unknown image type or file too large.',
		'customstyle:background:save:success' => 'Succesfully saved background configuration.',
		
		'customstyle:background:repeat:title' => 'Background repeat',
		'customstyle:background:repeat:description' => 'Change this to configure if the background is repeated',
		// dont translate the keys in the next array, only the value's need to be translated
		'customstyle:background:repeat:options' => array('repeat'=>'Repeat','repeat-x'=>'Only repeat horizontally','repeat-y'=>'Only repeat vertically','no-repeat'=>'Don\'t repeat the background'),

		'customstyle:background:attachment:title' => 'Background attachment',
		'customstyle:background:attachment:description' => 'Change this to configure if the background is fixed or scrolls with the page',
		// dont translate the keys in the next array, only the value's need to be translated
		'customstyle:background:attachment:options' => array('scroll'=>'Scroll','fixed'=>'Fixed'),
		
		'customstyle:background:position:title' => 'Background position',
		'customstyle:background:position:description' => 'Change this to configure the position of the background',
		// dont translate the keys in the next array, only the value's need to be translated
		'customstyle:background:position:options' => array(
			'top left'=>'Top Left',
			'top center'=>'Top Center',
			'top right'=>'Top Right',
			'center left'=>'Center Left',
			'center center'=>'Center Center',
			'center right'=>'Center Right',
			'bottom left'=>'Bottom Left',
			'bottom center'=>'Bottom Center',
			'bottom right'=>'Bottom Right'					
			),
		
		'customstyle:reset:tocustom' => 'Show personalized design!',	
		'customstyle:reset:todefault' => 'Show in normal design',	
		
			
	);
					
	add_translation("en",$english);

?>