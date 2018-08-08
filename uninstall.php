<?php
/**
* UNINSTALLER
  *
  * Fired when the plugin is uninstalled.
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPLv3
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
  */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  die( "I'm afraid I can't do that Dave." );
}

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  die( "I'm afraid I can't do that Dave.");
}
delete_option( 'udt_custom_header_text', $custom_header_text );
