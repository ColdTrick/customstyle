<?php
	/**
	* CustomStyle - Saves background configuration
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
	$current_user_entity = $_SESSION['user'];
	
	if(get_input('submitButton') == elgg_echo('customstyle:background:reset')){
		$customstyle_object = $current_user_entity->getObjects("customstylebackground", 1, 0); 
		if($customstyle_object){
			if($customstyle_object[0]->delete()){	
				system_message(elgg_echo('customstyle:background:reset:success'));
			} else {
				register_error(elgg_echo('customstyle:background:error:unknown'));
			}
		}
	} else {
		
		// check for existing customstyle object, if not, create it
		$customstyle_object = $current_user_entity->getObjects("customstylebackground", 1, 0); 
		if(!$customstyle_object){
			$customstyle_object = new ElggObject();
			$customstyle_object->subtype = "customstylebackground";
			$customstyle_object->access_id = 2;
			$customstyle_object->save();
			$customstyle_object = $current_user_entity->getObjects("customstylebackground", 1, 0); 
		} 
		$customstyle_object = $customstyle_object[0];
		$access_id = 2; //public
		$error = false;
		
		//backgroundfile
		// if use current
		if(get_input('background-image')){
			$image = get_input('background-image');
			
			// custom image?
			// right file type and not to big?
			if($image == 'custombackground'){
				if(substr_count($_FILES['backgroundfile']['type'],'image/') && isset($_FILES['backgroundfile']) && $_FILES['backgroundfile']['error'] == 0){
					$filename = "custombackground";
					$extension = pathinfo($_FILES['backgroundfile']['name']);
					$extension = $extension['extension'];
					
					$filehandler = new ElggFile();
					$filehandler->setFilename($filename);
					$filehandler->open("write");
					$filehandler->write(get_uploaded_file('backgroundfile'));
					$filehandler->close();
					
					$thumbnail = new ElggFile();
					$thumbnail->setFilename($filename . "_thumb");
					$thumbnail->open("write");
					$thumbnail->write(get_resized_image_from_uploaded_file('backgroundfile',150,150,false));
					$thumbnail->close();
					
					$backgroundURL = 'pg/customstyle/getbackground?id=' . $current_user;
				} else {
					register_error(elgg_echo('customstyle:background:error:image'));
					forward($_SERVER['HTTP_REFERER']);
				}
			} else {
				$backgroundURL = $image;	
			}
			if(create_metadata($customstyle_object->guid, 'background-image', $backgroundURL, 'string', $_SESSION['guid'], $access_id) == false || empty($backgroundURL)){
				$error = true;
			}
		}
		// repeat
		if(get_input('background-repeat')){
			if(create_metadata($customstyle_object->guid, 'background-repeat', get_input('background-repeat'), 'string', $_SESSION['guid'], $access_id) == false){
				$error = true;
			}
		}
		// attachment
		if(get_input('background-attachment')){
			if(create_metadata($customstyle_object->guid, 'background-attachment', get_input('background-attachment'), 'string', $_SESSION['guid'], $access_id) == false){
				$error = true;
			}
		}
		// position
		if(get_input('background-position')){
			if(create_metadata($customstyle_object->guid, 'background-position', get_input('background-position'), 'string', $_SESSION['guid'], $access_id) == false){
				$error = true;
			}
		}
		// check for error
		if(!$error){
			if(get_plugin_setting("showInRiver","customstyle") != "no"){
				add_to_river('river/object/customstyle/update','update',$current_user,$current_user);
			}
			system_message(elgg_echo('customstyle:background:save:success'));
		} else {
			register_error(elgg_echo('customstyle:background:error:unknown'));
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