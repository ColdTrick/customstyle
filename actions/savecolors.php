<?php
	/**
	* CustomStyle - Save Color Configuration
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	gatekeeper();
	// Make sure action is secure
	action_gatekeeper();
	$current_user = $_SESSION['user']->getGUID();
	$current_user_entity = get_entity($current_user);
	
	if(get_input('submitButton') == elgg_echo('customstyle:colors:reset')){
		$customstyle_object = $current_user_entity->getObjects("customstylecolors", 1, 0); 
		if($customstyle_object){
			if($customstyle_object[0]->delete()){	
				system_message(elgg_echo('customstyle:colors:reset:success'));
			} else {
				register_error(elgg_echo('customstyle:colors:error:unknown'));
			}
		}
	} else {
		// check for existing customstyle object, if not, create it
		$customstyle_object = $current_user_entity->getObjects("customstylecolors", 1, 0); 
		if(!$customstyle_object){
			$customstyle_object = new ElggObject();
			$customstyle_object->subtype = "customstylecolors";
			$customstyle_object->access_id = 2;
			$customstyle_object->save();
			$customstyle_object = $current_user_entity->getObjects("customstylecolors", 1, 0); 
		} 
		$customstyle_object = $customstyle_object[0];
		$access_id = 2; //public
		$error = false;

		$data = get_input('customstyle');
		if($data){
			foreach($data as $key=>$value){
				if(create_metadata($customstyle_object->guid, $key, $value, 'string', $_SESSION['guid'], $access_id) == false){
					$error = true;
				}
			}
		}
		
		// save
		if(!$error){
			if(get_plugin_setting("showInRiver","customstyle") != "no"){
				add_to_river('river/object/customstyle/update','update',$current_user,$current_user);
			}
			system_message(elgg_echo('customstyle:colors:save:success'));
		} else {
			register_error(elgg_echo('customstyle:colors:error:unknown'));
		}
	}
	
	//no cache
	header("Expires: Mon, 26 Jul 1990 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	forward($_SERVER['HTTP_REFERER']);

?>