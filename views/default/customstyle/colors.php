<?php
	/**
	* CustomStyle - Color configure
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	gatekeeper();

	$current_user = $_SESSION['user']->getGUID();
	$current_user_entity = $_SESSION['user'];
	$currentConfig = get_custom_style_from_metadata($current_user, 'customstylecolors');	
		
	$body .= "<table class='customstyle'><col style='white-space:nowrap'>";
	// creating fields for autodetecting of css colors
	$body .= "<div style='display:none;'>";
	$body .= "<div id='profile_info'></div>";
	$body .= "<div class='collapsable_box_header'><h1></h1></div>";
	$body .= "<div class='collapsable_box_content'></div>";
	$body .= "</div>";
	
	$configArray = array(
		array(
			'title' => elgg_echo("customstyle:colors:configure:background:title"),
			'internalname' =>"bodybackground",
			'html-element' => "body",
			'css-element'=>"body",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:background:info")
			),
		array(
			'title' => elgg_echo("customstyle:colors:configure:headerbackground:title"),
			'internalname' =>"headerbackground",
			'html-element' => "#layout_header",
			'css-element'=>"#layout_header",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:headerbackground:info")
			),
		array(
			'title' => elgg_echo("customstyle:colors:configure:contentbackground:title"),
			'internalname' =>"contentbackground",
			'html-element' => "#layout_canvas",
			'css-element'=>"#layout_canvas",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:contentbackground:info")
			),
		array(
			'title' => elgg_echo("customstyle:colors:configure:profilebox:title"),
			'internalname' =>"profilebox",
			'html-element' => "#profile_info",
			'css-element'=>"#profile_info",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:profilebox:info")
			),	
		array(
			'title' => elgg_echo("customstyle:colors:configure:widgettitle:title"),
			'internalname' =>"widgettitle",
			'html-element' => ".collapsable_box_header h1",
			'css-element'=>".collapsable_box_header h1",
			'css-property'=>"color",
			'info'=>elgg_echo("customstyle:colors:configure:widgettitle:info")
			),	
		array(
			'title' => elgg_echo("customstyle:colors:configure:widgetheader:title"),
			'internalname' =>"widgetheader",
			'html-element' => ".collapsable_box_header",
			'css-element'=>".collapsable_box_header",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:widgetheader:info")
			),	
		array(
			'title' => elgg_echo("customstyle:colors:configure:widgetbody:title"),
			'internalname' =>"widgetbody",
			'html-element' => ".collapsable_box_content",
			'css-element'=>".collapsable_box_content",
			'css-property'=>"background-color",
			'info'=>elgg_echo("customstyle:colors:configure:widgetbody:info")
			),	
		array(
			'title' => elgg_echo("customstyle:colors:configure:fontcolor:title"),
			'internalname' =>"fontcolor",
			'html-element' => "#page_container",
			'css-element'=>"#page_container",
			'css-property'=>"color",
			'info'=>elgg_echo("customstyle:colors:configure:fontcolor:info")
			),	
		array(
			'title' => elgg_echo("customstyle:colors:configure:linkcolor:title"),
			'internalname' =>"linkcolor",
			'html-element' => "#page_container a",
			'css-element'=>"#page_container a",
			'css-property'=>"color",
			'info'=>elgg_echo("customstyle:colors:configure:linkcolor:info")
			)
	);
	
	$customJs = "";
	
	foreach($configArray as $configElement){
		//creating the form elements
		$body .= "<tr><th colspan=2>" . $configElement['title'] . "</th></tr>\n";
		$body .= "<tr><td>\n";
		$body .= "<input type='text' id='" . $configElement['internalname'] . "A' name='customstyle[" . $configElement['css-element'] . "|" . $configElement['css-property'] . "]' onchange=\"setElementColor('" . $configElement['html-element'] . "', '" . $configElement['css-property'] . "', this.value)\" /><br />\n";
		$body .= "<input type='checkbox' id='" . $configElement['internalname'] . "B' name='customstyle[" . $configElement['css-element'] . "|" . $configElement['css-property'] . "]' value='transparent' onclick=\"if(this.checked==true){" . $configElement['internalname'] . "A.disabled=true;setElementColor('" . $configElement['html-element'] . "', '" . $configElement['css-property'] . "', 'transparent');} else {" . $configElement['internalname'] . "A.disabled=false;setElementColor('" . $configElement['html-element'] . "', '" . $configElement['css-property'] . "', " . $configElement['internalname'] . "A.value);}\" /> \n";
		$body .= elgg_echo("customstyle:colors:configure:transparent") . "</td>\n"; 
		$body .= "<td>" . $configElement['info'] . "</td></tr>\n";	
		
		// creating the jscolor buttons
		$customJs .= "
		
			var color = $('" . $configElement['css-element'] . "').css('" . $configElement['css-property'] . "')
			
			var " . $configElement['internalname'] . "A = new jscolor.color(document.getElementById('" . $configElement['internalname'] . "A'), {})
			" . $configElement['internalname'] . "A.hash = true
			if(color == 'transparent' || color.indexOf('rgba') == 0){
				document.getElementById('" . $configElement['internalname'] . "B').checked = true
				document.getElementById('" . $configElement['internalname'] . "A').disabled = true
			} else {
				
				if(color.indexOf('rgb') == 0){
					
					color = color.replace('rgb(','').replace(')','')
					color = color.replace(/ /g,'')
					
					color = color.split(',')
					
				" . $configElement['internalname'] . "A.fromRGB(parseInt(color[0])/255, parseInt(color[1])/255, parseInt(color[2])/255)
				} else {
					" . $configElement['internalname'] . "A.fromString(color)
				}
			}
			";
	}
	
	$body .= "</table>";
	$body .= "<br />";

	$body .= elgg_view('input/submit', array("internalname"=>"submitButton", 'value' => elgg_echo('save'))) . " ";
	$body .= elgg_view('input/submit', array("internalname"=>"submitButton", 'value' => elgg_echo('customstyle:colors:reset')));
	
	$configForm = elgg_view("input/form",array('body' => $body,'method' => 'post','action' => $vars['url'] . "action/customstyle/savecolors"));
	
?>
<script type="text/javascript" src="<?php echo $vars['url'];?>mod/customstyle/js/jscolor.js"></script>
<script type="text/javascript" src="<?php echo $vars['url'];?>mod/customstyle/js/colors.js"></script>
<div class="contentWrapper">

	<div id="noconfig" <?php if($currentConfig){ ?>style="display:none"<?php }?>>
		<p>
		<?php 
			echo elgg_echo("customstyle:colors:noconfig") . "<br />";
			$js = "onclick='$(\"#noconfig\").toggle();$(\"#config\").toggle()'";
			echo elgg_view("input/button", array("value"=>elgg_echo("customstyle:colors:customizebutton"), "js"=>$js));
		?>
		</p>
	</div>
	<div id="config" <?php if(!$currentConfig){ ?>style="display:none"<?php }?>>
		<?php
			echo elgg_echo("customstyle:colors:selectstyle");
			echo $configForm;
		?>
	</div>	
</div>
<script type="text/javascript">
	<?php echo $customJs; ?>
</script>