<?php
/**
  * Plugin Name:       UDTheme Branding
  * Plugin URI:        https://bitbucket.org/UDwebbranding/udtheme-brand
  * Description:       Displays University of Delaware branded header and footer within WordPress themes.
  *                    For official University of Delaware department sites in accordance with CPA guidelines.
  * Version:           3.0.4
  * Author:            Christopher Leonard - University of Delaware | IT CS&S
  * Author URI:        https://sites.udel.edu/cleonard
  * License:           GPLv3
  * Text Domain:       udtheme-brand
  * Domain Path:       /languages
*/

/**
* Function to begin execution of plugin
* Loads core class files
* The purpose of this file is to:
* Loads required files to run plugin
*
* @package     udtheme-brand
* @author      Christopher Leonard
* @license     GPLv3 or Later
* @copyright   Copyright (c)2012-2017 Christopher Leonard University of Delaware
* @version     3.0.4
*/

if ( ! defined( 'WPINC' ) ) {
  die( 'No soup for you!' );
}
/**
 * The function responsible for auto loading classes.
 */
require plugin_dir_path( __FILE__ ) . 'udtbp-autoloader.php';
/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'include/class-udtbp.php';
/**
 * The class responsible for defining constants.
 */
require plugin_dir_path(  __FILE__ ) . 'udtbp-defined-constants.php';
/**
 * RUN PLUGIN
 *
 * Begins execution of the plugin.
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.0
 */
function run_udtbp() {

  $plugin = new udtbp();
  $plugin->run();
}
run_udtbp();
