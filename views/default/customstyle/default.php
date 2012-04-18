<?php
	/**
	* CustomStyle
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
?>
<div class="contentWrapper">
<p><?php echo elgg_echo("customstyle:information:welcome");?></p>
<?php if(get_plugin_setting("colorsCustomizable","customstyle") == "yes"){ ?>
<p>
	<div class="user_settings"><h3><?php echo elgg_echo("customstyle:colors:title");?></h3></div>
	<?php echo elgg_echo("customstyle:information:colors");?>
</p>
<?php } ?>
<?php if(get_plugin_setting("backgroundCustomizable","customstyle") == "yes"){ ?>
<p>
	<div class="user_settings"><h3><?php echo elgg_echo("customstyle:background:title");?></h3></div>
	<?php echo elgg_echo("customstyle:information:background");?>
</p>
<?php } ?>
</div>
