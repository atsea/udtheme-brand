<?php
/**
 * Class: UDTheme Branding Localization i18n
 *
 * Defines the internationalization functionality
 *
 * The purpose of this class is to:
 * Load and define internationalization files
 * for plugin translation
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware | IT CS&S
 * @license     GPLv3
 * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
 * @copyright   Copyright (c) 2012-2017 University of Delaware
 * @version     3.0.4
 */
if ( ! class_exists( 'udtbp_i18n' ) ) :
class udtbp_i18n {
  /**
   * The ID of this plugin.
   *
   * @since    1.4.2
   * @version  1.0.0                           New name introduced.
   * @access   private
   * @var      string         $udtbp           The ID of this plugin.
  */
   private $udtbp;
  /**
   * Initialize the class and set its properties.
   *
   * @since    3.0.0
   */
  public function __construct( $udtbp ) {
    $this->udtbp = $udtbp;
  }
  /**
   * Load the plugin text domain for translation.
   *
   * @since    3.0.0
   */
  public function udtbp_load_plugin_textdomain() {

    udtbp_load_plugin_textdomain( $this->udtbp, FALSE, UDTBP_SLUG . '/languages/' );
  }
} // end class udtbp_i18n
endif;
