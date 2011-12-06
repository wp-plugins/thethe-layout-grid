<?php /** @version $Id: view-settings.php */ ?>
<?php $config = $this->config();?>
<form method="post" action="">
<?php include 'inc.submit-buttons.php';?> 
<fieldset>
  <legend><?php _e('All Settings','thethe-layout-grid'); ?></legend>
  <ul class="thethe-settings-list">
   <li>
      <label for="data-grid"><?php _e('Enable Layout Grid Script','thethe-layout-grid'); ?>:</label>
      <input name="data[grid]" id="data-grid" class="str-field"  type="checkbox" <?php if ($config['grid']) echo 'checked="checked"'; ?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this checkbox to activate the script on your site.','thethe-layout-grid'); ?> (grid)</span></a> 
	</li> 
    <li>
      <label for="data-vEnabled"><?php _e('Enable Vertical','thethe-layout-grid'); ?>:</label>
      <input name="data[vEnabled]" id="data-vEnabled" class="str-field"  type="checkbox" <?php if ($config['vEnabled']) echo 'checked="checked"';?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this checkbox to display grid columns.','thethe-layout-grid'); ?> (vEnabled)</span></a> 
	</li> 
    <li>
    <label for="data-hEnabled "><?php _e('Enable Horizontal','thethe-layout-grid'); ?>:</label>
      <input name="data[hEnabled]" id="data-hEnabled" class="str-field" type="checkbox" <?php if ($config['hEnabled']) echo 'checked="checked"';?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this checkbox to dispaly horizontal lines.','thethe-layout-grid'); ?> (hEnabled)</span></a> 
	</li> 
	<li>
      <label for="data-gridCenter"><?php _e('Center Grid','thethe-layout-grid'); ?>:</label>
      <input name="data[gridCenter]" id="data-gridCenter" class="str-field"  type="checkbox" <?php if ($config['gridCenter']) echo 'checked="checked"';?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this checkbox to center the grid.','thethe-layout-grid'); ?> (gridCenter)</span></a> 
	</li>
	<li>
	  <label for="data-backlink"><?php _e('Linkback to Developer','thethe-layout-grid'); ?>:</label>
      <input name="data[backlink]" id="data-backlink" class="str-field"  type="checkbox" <?php if ($config['backlink']) echo 'checked="checked"';?> >
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Check this box to display a backlink to the plugin home page.','thethe-layout-grid'); ?> (backlink)</span></a> 
	</li> 
  </ul>
</fieldset>
<fieldset>
  <legend><?php _e('Horizontal','thethe-layout-grid'); ?></legend>
  <ul class="thethe-settings-list">
    <li>
      <label for="data-hColor"><?php _e('Color','thethe-layout-grid'); ?>:</label>
      <input name="data[hColor]" id="pColor" class="str-field pickcolor" value="<?php print $config['hColor'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose a color for horizontal lines.','thethe-layout-grid'); ?> (hColor)</span></a> 
	</li> 
    <li>
    <label for="data-hOpacity"><?php _e('Opacity','thethe-layout-grid'); ?>:</label>
      <input name="data[hOpacity]" id="pOpacity" class="str-field" value="<?php print $config['hOpacity'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose opacity of the horizontal lines.','thethe-layout-grid'); ?> (hOpacity)</span></a> 
	</li> 
    <li>
      <label for="data-hHeight"><?php _e('Height','thethe-layout-grid'); ?>:</label>
      <input name="data[hHeight]" id="pHeight" class="str-field" value="<?php print $config['hHeight'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the size between horizontal lines.','thethe-layout-grid'); ?> (hHeight)</span></a> 
	</li>
	   <li>
      <label for="data-hOffset"><?php _e('Offset','thethe-layout-grid'); ?></label>
      <input name="data[hOffset]" id="pOffset" class="str-field" value="<?php print $config['hOffset'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the offset (margin) from the top for the content.','thethe-layout-grid'); ?> (hOffset):</span></a> 
	</li>
  </ul>
</fieldset>
<fieldset>
  <legend><?php _e('Vertical','thethe-layout-grid'); ?></legend>
  <ul class="thethe-settings-list">
 	<li>
      <label for="data-popular_grids"><?php _e('Popular Grids','thethe-layout-grid'); ?>:</label>
		<select id="popular_grids" size="1" name="data[system]">
			<optgroup label="- 960px Grids -">
				<option value="0" <?php if ($config['system']==0) echo 'selected'; ?>>960px, 12cols</option>
				<option value="1" <?php if ($config['system']==1) echo 'selected'; ?>>960px, 16cols</option>
				<option value="2" <?php if ($config['system']==2) echo 'selected'; ?>>960px, 3cols</option>
				<option value="3" <?php if ($config['system']==3) echo 'selected'; ?>>960px, 4cols</option>
				<option value="4" <?php if ($config['system']==4) echo 'selected'; ?>>960px, 24cols</option>
			</optgroup>
			<optgroup label="- 1200px Grids -">
				<option value="5" <?php if ($config['system']==5) echo 'selected'; ?>>1200px, 15cols</option>
				<option value="6" <?php if ($config['system']==6) echo 'selected'; ?>>1200px, 12cols</option>
				<option value="7" <?php if ($config['system']==7) echo 'selected'; ?>>1200px, 3cols</option>
				<option value="8" <?php if ($config['system']==8) echo 'selected'; ?>>1200px, 4cols</option>
				<option value="9" <?php if ($config['system']==9) echo 'selected'; ?>>1200px, 24cols</option>
			</optgroup>
			<option value="1000" <?php if ($config['system']==1000) echo 'selected'; ?>>Custom Grid</option>
		</select>
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose a pre-designed grid specification from the list.','thethe-layout-grid'); ?> (system)</span></a> </li>
    <li>
      <label for="data-vColor"><?php _e('Color','thethe-layout-grid'); ?>:</label>
      <input name="data[vColor]" id="cColor" class="str-field pickcolor" value="<?php print $config['vColor'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Select a color for columns.','thethe-layout-grid'); ?> (vColor)</span></a> 
	</li> 
    <li>
	  <label for="data-vOpacity"><?php _e('Opacity','thethe-layout-grid'); ?>:</label>
      <input name="data[vOpacity]" id="cOpacity" class="str-field" value="<?php print $config['vOpacity'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Choose opacity for columns.','thethe-layout-grid'); ?> (vOpacity)</span></a> 
	</li> 
	<li>
	  <label for="data-vMargin"><?php _e('Margin','thethe-layout-grid'); ?>:</label>
      <input name="data[vMargin]" id="cMargin" class="str-field" value="<?php print $config['vMargin'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the margin from the left/right in pexels.','thethe-layout-grid'); ?> (vMargin)</span></a> 
	</li> 
	<li>
	  <label for="data-vGutter"><?php _e('Gutter','thethe-layout-grid'); ?>:</label>
      <input name="data[vGutter]" id="cGutter" class="str-field" value="<?php print $config['vGutter'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Cpecify the gutter between grid columns.','thethe-layout-grid'); ?> (vGutter)</span></a> 
	</li> 
	<li>
	  <label for="data-vColWidth"><?php _e('Column Width','thethe-layout-grid'); ?>:</label>
      <input name="data[vColWidth]" id="cWidth" class="str-field" value="<?php print $config['vColWidth'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the grid columns width in pixels.','thethe-layout-grid'); ?> (vColWidth)</span></a> 
	</li> 
	<li>
	  <label for="data-vColNumber"><?php _e('Column Number','thethe-layout-grid'); ?>:</label>
      <input name="data[vColNumber]" id="cNumber" class="str-field" value="<?php print $config['vColNumber'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the number of grid columns.','thethe-layout-grid'); ?> (vColNumber)</span></a> 
	</li> 
	<li>
	  <label for="data-vContentWidth"><?php _e('Content Width','thethe-layout-grid'); ?>:</label>
      <input name="data[vContentWidth]" id="contentWidth" class="str-field" value="<?php print $config['vContentWidth'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the content width in pixels.','thethe-layout-grid'); ?> (vContentWidth)</span></a> 
	</li> 
	<li>
	  <label for="data-vFullWidth"><?php _e('Full Width','thethe-layout-grid'); ?>:</label>
      <input name="data[vFullWidth]" id="fullWidth" class="str-field" value="<?php print $config['vFullWidth'];?>" type="text">
      <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Specify the full width in pixels.','thethe-layout-grid'); ?> (vFullWidth)</span></a> 
	</li> 
	<li>
	<label for="data-Grid_URL"><?php _e('Grid Activating URL Parameters','thethe-layout-grid'); ?>:</label>
	<textarea rows="10" cols="25" name="Grid_URL" id="copy-settings"><?php
		  foreach ($config as $key => $value) {
			if ($key==vColor) $value = substr($config['vColor'], 1);
			if ($key==hColor) $value = substr($config['hColor'], 1);	
			if ($key==grid)	$value = "1"; 
			if ($key==system)
			switch ($value) {
				case 0:
					$value = '960x12';
					break;
				case 1:
					$value = '960x16';
					break;
				case 2:
					$value = '960x3';
					break;
				case 3:
					$value = '960x4';
					break;
				case 4:
					$value = '960x24';
					break;
				case 5:
					$value = '1200x15';
					break;
				case 6:
					$value = '1200x12';
					break;
				case 7:
					$value = '1200x3';
					break;
				case 8:
					$value = '1200x4';
					break;
				case 9:
					$value = '1200x24';
					break;
				default:
					$value = "1000";
				}
			if ($count!=0)echo "&".$key."=".$value;
				else echo $key."=".$value;
			$count++;
		  }
	?></textarea>
	<a href="#" id="copy-dynamic" class="str-field" ><?php _e('Copy to clipboard','thethe-layout-grid');?></a>
	 <a class="tooltip" href="javascript:void(0);">?<span><?php _e('Copy  the  code and append it to your page URL using "&amp;" or "?" to force  activation of the grid on that particular page even in case the grid is disabled.','thethe-layout-grid'); ?></span></a> 
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('a#copy-dynamic').zclip({
				path:'<?php echo WP_PLUGIN_URL . '/thethe-layout-grid/style/admin/js/ZeroClipboard.swf'?>',
				copy:function(){return jQuery('textarea#copy-settings').val();}
			});
		});
	</script>

	</li>
  </ul>
</fieldset>
<?php include 'inc.submit-buttons.php';?> 
</form>