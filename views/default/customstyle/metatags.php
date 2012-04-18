<?php
	/**
	* CustomStyle - Overrides all loaded css (not inline style)
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	
	global $CONFIG;
	
	$important = "";
	if(get_context() != "customstyle") $important = " !important";
	
	$currentConfig = get_custom_style_from_metadata(page_owner(), 'customstylecolors');
	
	if($currentConfig){
		//colors configured
		
		?>
		<style type="text/css" title="customstylesheet">
		/* customstylecolors */
		<?php
		
		
		foreach($currentConfig as $key=>$value){
			$rowData = explode("|", $key);
			if($rowData[0] <> ""){
				echo $rowData[0] . " { \n" . $rowData[1] . ": ". $value . $important . ";\n }\n";
			}
		}
		?>
		</style>
		<?php
	}
	
	$currentConfig = get_custom_style_from_metadata(page_owner(), 'customstylebackground');
	
	if($currentConfig){
		// background configured
		
		?>
			<style type="text/css" title="customstylesheet">
				/* customstylebackground */
				body {
					<?php
						foreach($currentConfig as $key=>$value){
							if($key == 'background-image'){
								echo $key . ": url(" . $CONFIG->wwwroot . $value .  ")" . $important . ";\n";
								
							} else {
								echo $key . ": " . $value . $important .";\n";
							}
						}
					?>
					
				}
			</style>
		<?php
	}


?>
<script type="text/javascript">
	var cacheArray = [];
	if(c=='disabled'){		
		$('style[title="customstylesheet"]').each(function(i){
				
				// chrome/safari hack
				if($.browser.safari){
					cacheArray[i] = $(this).html();
					$(this).html("");
				} else {
					this.disabled=true;
				}
				
		});
	}
</script>