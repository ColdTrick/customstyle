<?php
	/**
	* CustomStyle - Admin settings
	* 
	* @package customstyle
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
?>
<p>
	<?php echo elgg_echo('customstyle:settings:options');?>
	<p>
		<select name="params[colorsCustomizable]">
			<option value="yes" <?php if ($vars['entity']->colorsCustomizable == 'yes' || empty($vars['entity']->colorsCustomizable)) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
			<option value="no" <?php if ($vars['entity']->colorsCustomizable == 'no') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
		</select>
		<?php echo elgg_echo("customstyle:menu:colors");?><br />
		
		<select name="params[backgroundCustomizable]">
			<option value="yes" <?php if ($vars['entity']->backgroundCustomizable == 'yes' || empty($vars['entity']->backgroundCustomizable)) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
			<option value="no" <?php if ($vars['entity']->backgroundCustomizable == 'no') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
		</select>
		<?php echo elgg_echo("customstyle:menu:background");?><br /><br />
		
		<select name="params[showInRiver]">
			<option value="yes" <?php if ($vars['entity']->showInRiver == 'yes' || empty($vars['entity']->showInRiver)) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
			<option value="no" <?php if ($vars['entity']->showInRiver == 'no') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
		</select>
		<?php echo elgg_echo("customstyle:settings:river");?><br>
		
		<select name="params[allowUploadBackground]">
			<option value="yes" <?php if ($vars['entity']->allowUploadBackground == 'yes' || empty($vars['entity']->allowUploadBackground)) echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:yes'); ?></option>
			<option value="no" <?php if ($vars['entity']->allowUploadBackground == 'no') echo " selected=\"yes\" "; ?>><?php echo elgg_echo('option:no'); ?></option>
		</select>
		<?php echo elgg_echo("customstyle:settings:upload");?><br>
		<?php if(!$vars['entity']->maxUploadSize) $vars['entity']->maxUploadSize = "512000";?>
		<input type="text" name="params[maxUploadSize]" value="<?php echo $vars['entity']->maxUploadSize;?>"/><?php echo elgg_echo("customstyle:settings:maxupload"); ?>
		
	</p>
</p>
