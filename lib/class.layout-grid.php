<?php
/**
 * @version		$Id$
 * @author		xagero
 */
class PluginLayoutGrid extends PluginLayoutGrid_Abstract
{
	// }}}
	// {{{ init

	/**
	 * (non-PHPdoc)
	 * @see PluginAbstract::init()
	 */
	public function init()
	{
		parent::init();
		$this->viewIndexAll = array(
			'overview' => array(
				'title-tab' => 'Overview',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Overview'
			),
			'settings' => array(
				'title-tab' => 'Settings',
				'title' => $this->_config['meta']['Name'] . '&nbsp;Settings'
			),
		);
	} // end func init
	
	// }}}
	// {{{ _hook_wp_enqueue_scripts
	
	/**
	 * (non-PHPdoc)
	 * @see PluginLayoutGrid_Abstract::_hook_wp_enqueue_scripts()
	 */
	public function _hook_wp_enqueue_scripts($post)
	{	
		global $wpdb, $post;
		$config = $this->config();
		if (is_page($post->ID) || is_single($post->ID))	$config_meta=get_post_meta($post->ID, 'thethe-layout-grid'); else $config_meta=0;
		if (($config['grid']==1 || $config['grid']=="on") || ($config_meta[0]['grid']==1 || $config_meta[0]['grid']=="on") || ($_GET['grid']==1 || $_GET['grid']=="on"))
		{
			wp_enqueue_script('jquery');
			$ScriptUrl = WP_PLUGIN_URL . '/thethe-layout-grid/style/js/jQuery_grid.js';
			wp_register_script( 'thethe-layout-grid', $ScriptUrl);
			wp_enqueue_script( 'thethe-layout-grid' );
		}
	} // end func _hook_wp_enqueue_scripts
	
	// }}}
	
	public function _hook_wp_print_style()
	{
		$StyleUrl = WP_PLUGIN_URL . '/thethe-layout-grid/style/grid_css.css';
        wp_register_style('thethe-layout-grid', $StyleUrl);
		wp_enqueue_style('thethe-layout-grid');
		wp_register_style( 'grid-style-ie', WP_PLUGIN_URL . '/thethe-layout-grid/style/grid_css_ie.css', false);
		$GLOBALS['wp_styles']->add_data( 'grid-style-ie', 'conditional', 'lte IE 8' );
		wp_enqueue_style( 'grid-style-ie' );
	}
	
	public function _hook_wp_footer() {
		global $post;
		if (is_page($post->ID) || is_single($post->ID))	$config_meta=get_post_meta($post->ID, 'thethe-layout-grid'); else $config_meta=0;
		if ($config_meta[0]['grid']==1 || $config_meta[0]['grid']=="on") 
		{
			$config_meta= get_post_meta(get_the_ID(), 'thethe-layout-grid');
			$config=$config_meta[0];
		}
		else
		{
			$config = $this->config();
		}	
		foreach ($config as $key => $value) { 
			if (isset($_GET[$key]) && $_GET[$key]!='')
			{	
				if (!((isset($_GET['system']) && $_GET['system']!='') && (isset($_GET['vMargin']) || isset($_GET['vGutter']) || isset($_GET['vColWidth']) || isset($_GET['vColNumber']) || isset($_GET['vContentWidth']) || isset($_GET['vFullWidth'])))) 
					if ($key=='hColor' || $key=='vColor')	$config[$key]="#".$_GET[$key];
						else
							$config[$key]=$_GET[$key];
					else 
						$config['system']=$_GET['system'];
			}
			if (isset($_GET['grid']) && $_GET[$key]==1)
				$config['grid']=1;
		}
		if (($config['grid']==1 || $config['grid']=="on") )
		{ 
	?>
	<div id="grid_settings">
	<div class="pr_gr"><span><?php _e('Universal Layout Grid Generator','thethe-layout-grid'); ?></span>
	</div>
	<div id="gs_vertical">
		<p><?php _e('Vertical','thethe-layout-grid'); ?></p>
		<ul>
			<li>
				<span><?php _e('Popular Grids','thethe-layout-grid'); ?></span>
				<select id="popular_grids" size="1">
					<optgroup label="- 960px Grids -">
					<option value="0" <?php if ($config['system']==0 || $config['system']=='960x12') echo 'selected'; ?>>960px, 12cols</option>
					<option value="1" <?php if ($config['system']==1 || $config['system']=='960x16') echo 'selected'; ?>>960px, 16cols</option>
					<option value="2" <?php if ($config['system']==2 || $config['system']=='960x3') echo 'selected'; ?>>960px, 3cols</option>
					<option value="3" <?php if ($config['system']==3 || $config['system']=='960x4') echo 'selected'; ?>>960px, 4cols</option>
					<option value="4" <?php if ($config['system']==4 || $config['system']=='960x24') echo 'selected'; ?>>960px, 24cols</option>
				</optgroup>
				<optgroup label="- 1200px Grids -">
					<option value="5" <?php if ($config['system']==5 || $config['system']=='1200x15') echo 'selected'; ?>>1200px, 15cols</option>
					<option value="6" <?php if ($config['system']==6 || $config['system']=='1200x12') echo 'selected'; ?>>1200px, 12cols</option>
					<option value="7" <?php if ($config['system']==7 || $config['system']=='1200x3') echo 'selected'; ?>>1200px, 3cols</option>
					<option value="8" <?php if ($config['system']==8 || $config['system']=='1200x4') echo 'selected'; ?>>1200px, 4cols</option>
					<option value="9" <?php if ($config['system']==9 || $config['system']=='1200x24') echo 'selected'; ?>>1200px, 24cols</option>
				</optgroup>
				<option value="1000" <?php if ($config['system']==1000) echo 'selected'; ?>>Custom Grid</option>
				</select>
			</li> 
			<li><span><?php _e('Color','thethe-layout-grid'); ?></span><input type="text" id="cColor" size="10" value="<?php echo $config['vColor']; ?>"></li>
			<li><span><?php _e('Opacity','thethe-layout-grid'); ?></span><input type="text" id="cOpacity" size="10" value="<?php echo $config['vOpacity']; ?>"></li>
			<li><span><?php _e('Margin','thethe-layout-grid'); ?></span><input type="text" id="cMargin" size="10" value="<?php echo $config['vMargin']; ?>"></li>
			<li><span><?php _e('Gutter','thethe-layout-grid'); ?></span><input type="text" id="cGutter" size="10" value="<?php echo $config['vGutter']; ?>"></li>
			<li><span><?php _e('Column Width','thethe-layout-grid'); ?></span><input type="text" id="cWidth" size="10" value="<?php	switch ($config['system']) {
				case '960x12':
					echo (960-2*$config['vMargin']-$config['vGutter']*(12 - 1))/12;
					break;
				case '960x16':
					echo (960-2*$config['vMargin']-$config['vGutter']*(16 - 1))/16;
					break;
				case '960x3':
					echo (960-2*$config['vMargin']-$config['vGutter']*(3 - 1))/3;
					break;
				case '960x4':
					echo (960-2*$config['vMargin']-$config['vGutter']*(4 - 1))/4;
					break;
				case '960x24':
					echo (960-2*$config['vMargin']-$config['vGutter']*(24 - 1))/24;
					break;
				case '1200x15':
					echo (1200-2*$config['vMargin']-$config['vGutter']*(15 - 1))/15;
					break;
				case '1200x12':
					echo (1200-2*$config['vMargin']-$config['vGutter']*(12 - 1))/12;
					break;
				case '1200x3':
					echo (1200-2*$config['vMargin']-$config['vGutter']*(3 - 1))/3;
					break;
				case '1200x4':
					echo (1200-2*$config['vMargin']-$config['vGutter']*(4 - 1))/4;
					break;
				case '1200x24':
					echo (1200-2*$config['vMargin']-$config['vGutter']*(24 - 1))/24;
					break;
				default:
					echo $config['vColWidth'];
				}
			?>"></li>
			<li><span><?php _e('Column Number','thethe-layout-grid'); ?></span><input type="text" id="cNumber" size="10" value="<?php 	switch ($config['system']) {
				case '960x12':
					echo '12';
					break;
				case '960x16':
					echo '16';
					break;
				case '960x3':
					echo '3';
					break;
				case '960x4':
					echo '4';
					break;
				case '960x24':
					echo '24';
					break;
				case '1200x15':
					echo '15';
					break;
				case '1200x12':
					echo '12';
					break;
				case '1200x3':
					echo '3';
					break;
				case '1200x4':
					echo '4';
					break;
				case '1200x24':
					echo '24';
					break;
				default:
					echo $config['vColNumber'];
				}  ?>"></li>
			<li><span><?php _e('Content Width','thethe-layout-grid'); ?></span><input type="text" id="contentWidth" size="10" value="<?php echo $config['vContentWidth']; ?>"></li>
			<li><span><?php _e('Full Width','thethe-layout-grid'); ?></span><input type="text" id="fullWidth" size="10" value="<?php  echo $config['vFullWidth']; ?>"></li>
		</ul>
	</div>
	<div id="gs_horizontal">
		<p><?php _e('Horizontal','thethe-layout-grid'); ?></p>
		<ul>
			<li><span><?php _e('Color','thethe-layout-grid'); ?></span><input type="text" id="pColor" size="10" value="<?php echo $config['hColor']; ?>"></li>
			<li><span><?php _e('Opacity','thethe-layout-grid'); ?></span><input type="text" id="pOpacity" size="10" value="<?php echo $config['hOpacity']; ?>"></li>
			<li><span><?php _e('Height','thethe-layout-grid'); ?></span><input type="text" id="pHeight" size="10" value="<?php echo $config['hHeight']; ?>"></li>
			<li><span><?php _e('Offset','thethe-layout-grid'); ?></span><input type="text" id="pOffset" size="10" value="<?php echo $config['hOffset']; ?>"></li>
		</ul>
	</div>
	<div id="gs_globals">
		<ul>
			<li><label for="cGrid"><?php _e('Enable Vertical','thethe-layout-grid'); ?></label><input type="checkbox" id="cGrid" <?php if ($config['vEnabled']) echo 'checked="checked"'; ?>></li>
			<li><label for="pGrid"><?php _e('Enable Horizontal','thethe-layout-grid'); ?></label><input type="checkbox" id="pGrid" <?php if ($config['hEnabled']) echo 'checked="checked"'; ?>></li>
			<li><label for="cCenter"><?php _e('Center Grid','thethe-layout-grid'); ?></label><input type="checkbox" id="cCenter" <?php if ($config['gridCenter']) echo 'checked="checked"'; ?>></li>
		</ul>
	</div>
	<?php
		if (($config['backlink']==1 || $config['backlink']=="on") )
		{
			echo '
				<div class="thethe-backlink">
					<a href="http://thethefly.com/wp-plugins/thethe-layout-grid/" title="Powered by TheThe Layout Grid WordPress Plugin" target="_blank">?</a>
				</div>
			';
		}
	?>
	</div>
<?php
		}
	}

	// {{{ _settingsView
	
	/**
	 * Function _settingsView
	 */
	public function _settingsView()
	{  
		if (isset($_POST['data']) && isset($_POST['submit'])) {
			$dataValid = $this->_settingsValidate($_POST['data']);
			if ($dataValid) {
				update_option('_ttf-' . $this->_config['shortname'], $dataValid);
			}
		} elseif (isset($_POST['reset'])) {
			update_option('_ttf-' . $this->_config['shortname'],$this->_config['options']['default']);
		}
		parent::_defaultView();
	} // end func _settingsView
	
	// }}}
	// {{{ _settingsValidate

	/**
	 * Function _settingsValidate
	 * @param array $data
	 */
	public function _settingsValidate($data)
	{
		if (!is_array($data)) return false;
		foreach (($dataValid = array(
			/* All Settings*/
			'grid' => null,
			'vEnabled' => null,
			'hEnabled' => null,
			'gridCenter' => null,
			'backlink' => null,
			/* Vertical Settings*/
			'system' => null,
			'vColor' => null,
			'vOpacity' => null,
			'vMargin' => null,
			'vGutter' => null,
			'vColWidth' => null,
			'vColNumber' => null,
			'vContentWidth' =>null,
			'vFullWidth' =>null,
			/* Horizontal Settings*/
			'hColor' => null,
			'hOpacity' => null,
			'hHeight' => null,
			'hOffset' =>null
			)
		) as $k=>$v ) {
			if ($data[$k]=="on") $data[$k] = 1;
			if (!isset($data[$k])) $data[$k] = 0;
			$dataValid[$k] = trim($data[$k]);
		}		
		return $dataValid;
	} // end func _settingsValidate
	

	public function _hook_admin_init() {  
		add_meta_box( 'thethe-layout-grid', __( 'TheThe Layout Grid Settings', 'thethe-layout-grid' ),  array($this,'thethe_inner_custom_box'), 'post' );  
		add_meta_box( 'thethe-layout-grid', __( 'TheThe Layout Grid Settings', 'thethe-layout-grid' ),  array($this,'thethe_inner_custom_box'), 'page' ); 
	}  
	  
	public function thethe_inner_custom_box($post) {  
	  
	  // Используем nonce для верификации  
	  wp_nonce_field( plugin_basename(__FILE__), 'thethe-layout-grid' );  
	  
	  // Поля формы для введения данных  
	  $config_meta=get_post_meta($post->ID, 'thethe-layout-grid');
	  if ($config_meta[0]!="") 
		{
			$config_meta= get_post_meta($post->ID, 'thethe-layout-grid');
			$config=$config_meta[0];
		}
	  else
		{
			$config = $this->config();
			$config[grid]="";
		}
	  ?>
	  <table class="thethe-settings-list">
	   <tr>
		  <td><label for="data-grid"><?php _e('Enable Layout Grid Script','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[grid]" id="data-grid" class="str-field"  type="checkbox" <?php if ($config['grid']) echo 'checked="checked"'; ?> >
		   </td>
		</tr> 
		<tr>
		  <td><label for="data-vEnabled"><?php _e('Enable Vertical','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[vEnabled]" id="data-vEnabled" class="str-field"  type="checkbox" <?php if ($config['vEnabled']) echo 'checked="checked"';?> >
		  </td>
		</td> 
		<tr>
		  <td><label for="data-hEnabled "><?php _e('Enable Horizontal','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[hEnabled]" id="data-hEnabled" class="str-field" type="checkbox" <?php if ($config['hEnabled']) echo 'checked="checked"';?> >
		 </td>
		</td> 
		<tr>
		  <td><label for="data-gridCenter"><?php _e('Center Grid','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[gridCenter]" id="data-gridCenter" class="str-field"  type="checkbox" <?php if ($config['gridCenter']) echo 'checked="checked"';?> >
		  </td>
		</tr>
		<tr>
			<td colspan="2"><strong><?php _e('Horizontal','thethe-layout-grid'); ?></strong></td>
		</tr>
		<tr>
			<td><label for="data-hColor"><?php _e('Color','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[hColor]" id="pColor" class="str-field pickcolor" value="<?php print $config['hColor'];?>" type="text" />
			 </td>
		</tr> 
		<tr>
			<td><label for="data-hOpacity"><?php _e('Opacity','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[hOpacity]" id="pOpacity" class="str-field" value="<?php print $config['hOpacity'];?>" type="text" />
			 </td>
		</td> 
		<tr>
			<td><label for="data-hHeight"><?php _e('Height','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[hHeight]" id="pHeight" class="str-field" value="<?php print $config['hHeight'];?>" type="text" />
			 </td>
		</tr>
		<tr>
			<td><label for="data-hOffset"><?php _e('Offset','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[hOffset]" id="pOffset" class="str-field" value="<?php print $config['hOffset'];?>" type="text" />
			</td>
		</tr>
		<tr>
			<td colspan="2"> <strong><?php _e('Vertical','thethe-layout-grid'); ?></strong></td>
		</tr>
		<tr>
			<td><label for="data-system"><?php _e('Popular Grids','thethe-layout-grid'); ?>:</label></td>
			<td><select id="popular_grids" size="1" name="data[system]">
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
		 </td>
		</tr>
		<tr>
			<td><label for="data-vColor"><?php _e('Color','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[vColor]" id="cColor" class="str-field pickcolor" value="<?php print $config['vColor'];?>" type="text" />
		</td>
		</tr> 
		<tr>
			<td><label for="data-vOpacity"><?php _e('Opacity','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[vOpacity]" id="cOpacity" class="str-field" value="<?php print $config['vOpacity'];?>" type="text" />
			</td>
		</tr> 
		<tr>
			<td><label for="data-vMargin"><?php _e('Margin','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[vMargin]" id="cMargin" class="str-field" value="<?php print $config['vMargin'];?>" type="text" />
			 </td>
		</tr> 
		<tr>
			<td><label for="data-vGutter"><?php _e('Gutter','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[vGutter]" id="cGutter" class="str-field" value="<?php print $config['vGutter'];?>" type="text" />
			</span></a> </td>
		</tr> 
		<tr>
			<td><label for="data-vColWidth"><?php _e('Column Width','thethe-layout-grid'); ?>:</label></td>
			<td><input name="data[vColWidth]" id="cWidth" class="str-field" value="<?php print $config['vColWidth'];?>" type="text" />
		</span></a> </td>
		</tr> 
		<tr>
		  <td><label for="data-vColNumber"><?php _e('Column Number','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[vColNumber]" id="cNumber" class="str-field" value="<?php print $config['vColNumber'];?>" type="text" />
		</td>
		</tr> 
		<tr>
		  <td><label for="data-vContentWidth"><?php _e('Content Width','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[vContentWidth]" id="contentWidth" class="str-field" value="<?php print $config['vContentWidth'];?>" type="text" /> 
		</tr> 
		<tr>
		  <td><label for="data-vFullWidth"><?php _e('Full Width','thethe-layout-grid'); ?>:</label></td>
		  <td><input name="data[vFullWidth]" id="fullWidth" class="str-field" value="<?php print $config['vFullWidth'];?>" type="text" />
		</td>
		</tr> 
	  </table>
	  <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  
<?php
	}  
	public function _hook_save_post( $post_id ) {
		if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; 
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; 
		if ( !current_user_can('edit_post', $post_id) ) return false;  
	  
		if( !isset($_POST['data']) ) return false;  
		update_post_meta($post_id, "thethe-layout-grid", $_POST['data']); 
	
		return $post_id;
	}
} // end class PluginLayoutGrid