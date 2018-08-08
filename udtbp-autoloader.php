<?php
/**
  * CLASS AUTOLOADER
  *
  * Auto load classes without having to create instances.
  *
  * @package     udtheme-brand
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPLv3
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
  *
*/
if ( ! function_exists( 'udtbp_server_autoloader' ) ) :
  /**
   * Generating classmap based autoload for WordPress plugins and themes
   *
   * @since     1.4.2
   * @version   1.0.1
   * @todo      												Finish translation functionality
   * @param     string    $class_name   Name of the class to load.
   */
  function udtbp_server_autoloader( $class_name ) {
    $class_prefix = 'class-udtbp-';
    $map = [
    'udtbp_Constants' => $class_prefix.'constants.php',
    'udtbp_Admin' => '/admin/'.$class_prefix.'admin.php',
    'udtbp_Admin_Notices' => '/admin/'.$class_prefix.'admin-notices.php',
    'udtbp_Header_Settings' => '/admin/'.$class_prefix.'header-settings.php',
    'udtbp_Footer_Settings' => '/admin/'.$class_prefix.'footer-settings.php',
    'udtbp_Loader' => '/include/'.$class_prefix.'loader.php',
    //'udtbp_i18n' => '/include/'.$class_prefix.'i18n.php',
    'udtbp_Social' => '/include/'.$class_prefix.'social.php',
    'udtbp_Public' => '/public/'.$class_prefix.'public.php'
    ];
    if ( isset( $map[$class_name] ) && file_exists( $file = dirname( __FILE__ ). DIRECTORY_SEPARATOR . $map[$class_name] ) ){
      include $file;
    }
  }
  spl_autoload_register( "udtbp_server_autoloader" );
endif;
