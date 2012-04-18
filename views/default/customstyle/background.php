<?php
	/**
	* CustomStyle - Background configuration
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	gatekeeper();

	$current_user = $_SESSION['user']->getGUID();
	$currentConfig = get_custom_style_from_metadata($current_user, 'customstylebackground');	
	global $CONFIG;
	
	$wallpaper_path = "mod/customstyle/graphics/wallpapers";
	$imageArray = array();	
	$dir_handle = opendir($CONFIG->path . $wallpaper_path);
	while (($file = readdir($dir_handle)) !== false) {
		if ($file!='.' && $file!='..' && !is_dir($dir.$entry)){
			$dotPosition = strrpos($file,".");
			if($dotPosition){
				$shortFileName = substr($file,0,$dotPosition);
				$imageArray[elgg_echo($shortFileName)] = $wallpaper_path . "/" . str_replace(" ", "%20",$file);
			}
		}
	}
		
	$body = "<br />";
	$body .= "<table id='gallery'><tr>";
	
	$i=0;
	
	// own image
	if($currentConfig["background-image"]){
		$body .= "<td>";
		$body .= "<input type='radio' name='background-image' value='" . $currentConfig['background-image'] . "' onclick='document.body.style.backgroundImage = \"url(" . $CONFIG->wwwroot . $currentConfig['background-image'] . ")\"' CHECKED> " . elgg_echo("customstyle:background:currentbackground") . "<br />";
		$body .= "<a href='" . $CONFIG->wwwroot . $currentConfig['background-image'] . "' title='" . elgg_echo('customstyle:background:custombackground') . "'><img src=";
		$body .= $CONFIG->wwwroot . $currentConfig['background-image']; 
		if(substr_count($currentConfig['background-image'], "getbackground?id=")) $body .= "&thumb=true";
		$body .= " style='width:150px;' alt='" . elgg_echo('customstyle:background:custombackground') . "'/></a>";
		$body .= "</td>";
		$i++;
	} 
	
	if(get_plugin_setting("allowUploadBackground","customstyle") != "no"){
		// check for previously uploaded background
		$filehandler = new ElggFile();
		$filehandler->owner_guid = $current_user;
		$filehandler->setFilename('custombackground');
		if($filehandler->exists()){
			$imageUrl = 'pg/customstyle/getbackground?id=' . $current_user;
			if($imageUrl != $currentConfig["background-image"]){
				$body .= "<td>";
				$body .= "<input type='radio' name='background-image' value='" . $imageUrl . "' onclick='document.body.style.backgroundImage = \"url(" . $CONFIG->wwwroot . $imageUrl . ")\"'> " . elgg_echo("customstyle:background:previouslyuploadedbackground") . "<br />";
				$body .= "<a href='" . $CONFIG->wwwroot . $imageUrl . "' title='" . elgg_echo('customstyle:background:previouslyuploadedbackground') . "'><img src='" . $CONFIG->wwwroot . $imageUrl . "&thumb=true' style='width:150px;' alt='" . elgg_echo('customstyle:background:previouslyuploadedbackground') . "'/></a>";
				$body .= "</td>";
				$i++;
			}
		}
	}
	
	// load default images
	foreach($imageArray as $name=>$image){
		if($i == 4) {
			$body .= "</tr><tr>";	
			$i = 0;
		}
		if($image != $currentConfig['background-image']){
			$body .= "<td>";
			$body .= "<input type='radio' name='background-image' value='" . $image . "' onclick='document.body.style.backgroundImage = \"url(" . $CONFIG->wwwroot . $image . ")\"'> " . $name . "<br />";
			$body .= "<a href='" . $CONFIG->wwwroot . $image . "' title='" . $name . "'><img src='" . $CONFIG->wwwroot . $image . "' style='width:150px;'/></a>";
			$body .= "</td>";
			
			$i++;
		}
	}	
	$body .= "</tr></table>";
	
	if(get_plugin_setting("allowUploadBackground","customstyle") != "no"){
		$body .= "<input type='radio' id='custombackground' name='background-image' value='custombackground'> " . elgg_echo("customstyle:background:custombackground") . "<br />";
		// max file size of uploaded file in bytes
		$max_file_size = get_plugin_setting("maxUploadSize","customstyle");
		if(!$max_file_size) $max_file_size = "512000";
		$body .= "<input type='hidden' name='MAX_FILE_SIZE' value='" . $max_file_size . "' />";
		$body .= elgg_view("input/file",array("internalname"=>"backgroundfile", "js"=>"onclick=\"$('#custombackground').attr('checked', 'checked');\"")) . "<br /><br />";
	}
	$body .= "<table><col STYLE='white-space:nowrap;'>";
	
	// repeat
	$body .= "<tr><td colspan=2>";
	$body .= "<div class='user_settings'><h3>" . elgg_echo("customstyle:background:repeat:title") . "</h3></div>";
	$body .= "</td></tr><tr><td>";
	foreach(elgg_echo("customstyle:background:repeat:options") as $value=>$text){
		$checked = "";
		if(array_key_exists('background-repeat',$currentConfig)){
			if($currentConfig['background-repeat'] == $value){
				$checked = " checked";
			}
		}
		$body .= "<input type='radio' name='background-repeat' value='" . $value . "'" . $checked . " onclick='document.body.style.backgroundRepeat = \"" . $value . "\"'> " . $text . "<br />";
	}
	$body .= "</td><td>" . elgg_echo("customstyle:background:repeat:description") . "</td></tr>";
	
	// attachment
	$body .= "<tr><td colspan=2>";
	$body .= "<div class='user_settings'><h3>" . elgg_echo("customstyle:background:attachment:title") . "</h3></div>";
	$body .= "</td></tr><tr><td>";
	foreach(elgg_echo("customstyle:background:attachment:options") as $value=>$text){
		$checked = "";
		if(array_key_exists('background-attachment',$currentConfig)){
			if($currentConfig['background-attachment'] == $value){
				$checked = " checked";
			}
		}
		$body .= "<input type='radio' name='background-attachment' value='" . $value . "'" . $checked . " onclick='document.body.style.backgroundAttachment = \"" . $value . "\"'> " . $text . "<br />";
	}
	$body .= "</td><td>" . elgg_echo("customstyle:background:attachment:description") . "</td></tr>";
		
	// position
	$body .= "<tr><td colspan=2>";
	$body .= "<div class='user_settings'><h3>" . elgg_echo("customstyle:background:position:title") . "</h3></div>";
	$body .= "</td></tr><tr><td>";
	$i=0;
	foreach(elgg_echo("customstyle:background:position:options") as $value=>$text){
		if($i==3){
			$body .= "<br />";
			$i=0;
		}
		$checked = "";
		if(array_key_exists('background-position',$currentConfig)){
			if($currentConfig['background-position'] == $value){
				$checked = " checked";
			}
		}
		$body .= "<input type='radio' name='background-position' title='" . $text . "' value='" . $value . "'" . $checked . " onclick='document.body.style.backgroundPosition = \"" . $value . "\"'>";
		$i++;
	}
	$body .= "</td><td>" . elgg_echo("customstyle:background:position:description") . "</td></tr>";
		
	$body .= "</table>";
	$body .= elgg_view('input/submit', array("internalname"=>"submitButton", 'value' => elgg_echo('save'))) . " ";
	$body .= elgg_view('input/submit', array("internalname"=>"submitButton", 'value' => elgg_echo('customstyle:background:reset')));
	$configForm = elgg_view("input/form",array('body' => $body,'method' => 'post', 'enctype' => 'multipart/form-data' ,'action' => $vars['url'] . "action/customstyle/savebackground"));
	
?>
<script type="text/javascript" src="<?php echo $vars['url'];?>mod/customstyle/js/lightbox/js/jquery.lightbox-0.5.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $vars['url'];?>mod/customstyle/js/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$('#gallery a').lightBox();
	});
</script>
<div class="contentWrapper">

	<div id="noconfig" <?php if($currentConfig){ ?>style="display:none"<?php }?>>
		<p>
		<?php 
			echo elgg_echo("customstyle:background:noconfig") . "<br />";
			$js = "onclick='$(\"#noconfig\").toggle();$(\"#config\").toggle()'";
			echo elgg_view("input/button", array("value"=>elgg_echo("customstyle:background:customizebutton"), "js"=>$js));
		?>
		</p>
	</div>
	<div id="config" <?php if(!$currentConfig){ ?>style="display:none"<?php }?>>	
		<?php
			echo elgg_echo("customstyle:background:selectinfo") . "<br />";
			echo $configForm;
		?>
	</div>	
</div>
