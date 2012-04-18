<?php
	/**
	* CustomStyle
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	
	// Load Elgg engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	function customstyle_init() {
		global $CONFIG;
		
		if(get_plugin_setting("colorsCustomizable","customstyle") == "yes" || get_plugin_setting("backgroundCustomizable","customstyle") == "yes"){
			extend_view('css','customstyle/css');
			extend_view('js/initialise_elgg','customstyle/js');
			
			// Register a page handler, so we can have nice URLs
			register_page_handler('customstyle','customstyle_page_handler');
			
			if (get_context() == "profile" && is_plugin_enabled('profile')) {
				add_submenu_item(elgg_echo('customstyle:shorttitle') , $CONFIG->wwwroot . "pg/customstyle");
			}
			
			register_elgg_event_handler('pagesetup','system','customstyle_pagesetup');
		}
	}
	
	function customstyle_pagesetup(){
		global $CONFIG;
		
		if(!page_owner() && isloggedin()){
			set_page_owner($_SESSION['user']->getGUID()); 
		}
		if (isloggedin()) {
			add_menu(elgg_echo('customstyle:shorttitle'), $CONFIG->wwwroot . 'pg/customstyle/');
		}
		if(get_context() == 'customstyle'){
			if(get_plugin_setting("colorsCustomizable","customstyle") == "yes"){
				add_submenu_item(elgg_echo('customstyle:menu:colors'), $CONFIG->wwwroot . "mod/customstyle/colors.php" , '');
			}
			if(get_plugin_setting("backgroundCustomizable","customstyle") == "yes"){
				add_submenu_item(elgg_echo('customstyle:menu:background'), $CONFIG->wwwroot . "mod/customstyle/background.php" , '');
			}
		}
		 if ($_SERVER['PHP_SELF'] != "/index.php" && page_owner() != 0) {
			extend_view('metatags','customstyle/metatags');
		}
	}
	
	function customstyle_page_handler($page){
		global $CONFIG;
		
		if(!empty($page[0]) && $page[0] == "getbackground"){
			include($CONFIG->pluginspath . "customstyle/getbackground.php");
		} elseif(isloggedin()){
			// only interested in one page for now
			include($CONFIG->pluginspath . "customstyle/index.php"); 
		} else {
			forward($CONFIG->wwwroot);
		}
	}
	
	function get_custom_style_from_metadata($user, $metadata_name){
		$returnArray = false;
		
		$user = get_entity($user);
		
		$customstyle_object = $user->getObjects($metadata_name, 1, 0);
		
		$customConfig = get_metadata_for_entity($customstyle_object[0]->guid);
		
		if($customConfig){
			foreach($customConfig as $metadataObject){
				$returnArray[$metadataObject['name']] = $metadataObject['value'];
			}
		}
		
		return $returnArray;		
	}
	
	register_elgg_event_handler('init','system','customstyle_init');
	
	// Register actions
	global $CONFIG;
	register_action("customstyle/savebackground", false, $CONFIG->pluginspath . "customstyle/actions/savebackground.php");
	register_action("customstyle/savecolors", false, $CONFIG->pluginspath . "customstyle/actions/savecolors.php");
	
?>