<?php
<?php
/**
 * Class: UDTheme Branding Deactivation
 *
 * The purpose of this class is to:
 * Register deactivation hook
 * Fire deactivation hook
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware | IT CS&S
 * @license     GPLv3
 * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
 * @copyright   Copyright (c) 2012-2017 University of Delaware
 * @version     3.0.4
 */
if ( ! class_exists( 'udtbp_Dectivation' ) ) :
  class udtbp_Dectivation {
  /**
   * PLUGIN DEACTIVATION
   *
   * Hook fires when plugin is deactivated.
   *
   * @since    3.0.0
   */
 	public function udtbp_deactivation_hook() {
	}
} // end class udtbp_Dectivation()
endif;
