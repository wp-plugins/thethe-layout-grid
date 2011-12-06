<?php
/*
Plugin Name: TheThe Layout Grid
Plugin URI: http://thethefly.com/wp-plugins/thethe-layout-grid/
Description: TheThe Fly Layout Grid

Version: 1.0.0
Author: TheThe Fly
Author URI: http://www.thethefly.com
*/
/**
 * @version 	$Id$
 */
/**
 * Init classes,func and libs
 */
/** Require RSS lib */
require_once ABSPATH . WPINC . '/class-simplepie.php';
require_once ABSPATH . WPINC . '/class-feed.php';
require_once ABSPATH . WPINC . '/feed.php';
/** Require WP Plugin API */
require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once realpath(dirname(__FILE__) . '/lib/lib.core.php');
TheTheFly_require(dirname(__FILE__) . '/inc', array('data.'));
TheTheFly_require(dirname(__FILE__) . '/lib', array('func.','lib.'));
TheTheFly_require(dirname(__FILE__) . '/lib', array('class.','widget.'));

/**
 * Current plugin config
 * @var array
 */
$Plugin_Config = array(
	'shortname' => 'layout-grid',
	'plugin-hook' => 'thethe-layout-grid/layout-grid.php',
	'options' => array(
		'default' => array(
			/* All Settings*/
			'grid' => false,
			'vEnabled' => true,
			'hEnabled' => true,
			'gridCenter' => true,
			'backlink' => true,
			/* Vertical Settings*/
			'system' => 0,
			'vColor' => '#FF0000',
			'vOpacity' => 0.15,
			'vMargin' => 10,
			'vGutter' => 20,
			'vColWidth' => 60,
			'vColNumber' => 12,
			'vContentWidth' =>940,
			'vFullWidth' =>960,
			/* Horizontal Settings*/
			'hColor' => '#C0C0C0',
			'hOpacity' => 0.3,
			'hHeight' => 18,
			'hOffset' =>1
		)
	),
	'requirements' => array('wp' => '3.1')
) + array('meta' => get_plugin_data(realpath(__FILE__)) + array(
	'wp_plugin_dir' => dirname(__FILE__),
	'wp_plugin_dir_url' => plugin_dir_url(__FILE__)
)) + array(
	'clubpanel' => array(),
	'adminpanel' => array('sidebar.donate' => true)
);

/**
 * @var PluginLayoutGrid
 */
$GLOBALS['PluginLayoutGrid'] = new PluginLayoutGrid();

/**
 * Configure
 */
$GLOBALS['PluginLayoutGrid']->configure($Plugin_Config);

/**
 * Init
 */
TheTheFly_require(dirname(__FILE__),array('init.'));
$GLOBALS['PluginLayoutGrid']->init();

/** @todo fixme */
if (!function_exists('TheThe_makeAdminPage')) {
	function TheThe_makeAdminPage() {
		$GLOBALS['PluginLayoutGrid']->displayAboutClub();
	}
}

load_plugin_textdomain('thethe-layout-grid', false, dirname(plugin_basename(__FILE__)).'/languages' );