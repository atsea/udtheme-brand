<?php
/**
 * Class: UDTheme Branding Activation
 *
 * The purpose of this class is to:
 * Register activation hook
 * Fire activation hook
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware | IT CS&S
 * @license     GPLv3
 * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
 * @copyright   Copyright (c) 2012-2017 University of Delaware
 * @version     3.0.4
 */
if ( ! class_exists( 'udtbp_Activation' ) ) :
  class udtbp_Activation {
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
     * @since     3.0.0
     * @param     string    $udtbp       The name of this plugin.
     */
    public function __construct( $udtbp ) {
      $this->udtbp = $udtbp;
    }
  	/**
     * Register Activation Hook
     *
     * Register hooks that are fired when the plugin is activated.
     * When the plugin is deleted, the uninstall.php file is loaded.
     *
     * @since 3.0.0
     */
    public function udtbp_start_activation() {
      $this->udtbp_requirements_check(); //php and wp version check method
      $this->udtbp_activation_hook(); //    set transient on activation method
    }
    public function udtbp_requirements_check() {
      global $wp_version;
      if ( version_compare( PHP_VERSION, UDTBP_REQUIRED_PHP_VERSION, '<' ) ) {
      ?>
      <ul class="ul-disc">
        <li>
          <strong>PHP <?php echo UDTBP_REQUIRED_PHP_VERSION; ?> version is the minimum requirement to install plugin.</strong>
          <em>( You're running version <?php echo PHP_VERSION; ?> )</em>
        </li>
      </ul>
    <?php
      return false;
      }

      if ( version_compare( $wp_version, UDTBP_REQUIRED_WP_VERSION, '<' ) ) {
        ?>
      <ul class="ul-disc">
        <li>
          <strong>WordPress <?php echo UDTBP_REQUIRED_WP_VERSION; ?> version is the minimum requirement to install plugin.</strong>
          <em>( You're running version <?php echo $wp_version; ?> )</em>
        </li>
      </ul>
    <?php
        return false;
      }
      return true;
    } // end udtbp_requirements_check()
    public function udtbp_activation_hook() {
      $options = get_option('udel_theme_module_option');
      echo 'old header'.$options;
      if ( function_exists ( 'displayCustomTemplatesHeader' ) ) {
        $options = get_option('udel_theme_module_option');
        echo 'old header'.$options;
      }
      include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
      $set_transient = set_transient( 'udtbp_activation_transient', true, 5 );
    } // end function udtbp_activate_hook

    public function udtbp_initialize() {
      $get_transient = get_transient( 'udtbp_activation_transient' );
      if ( $get_transient === TRUE ) {
        $legacy_args = array(
          $legacy_udbranding => '/ud-branding/ud-branding.php', // legacy ud-branding plugin
          $legacy_udtheme    => '/udtheme/udtheme.php' // legacy udtheme plugin
        );
      }
      if ( function_exists ( 'udel_init_theme' ) || function_exists ( 'template_footer_social' ) ) :
        // check if ud-branding or udtheme exists
        deactivate_plugins( array( $legacy_args ) );
        add_action( 'update_option_active_plugins', 'udtbp_deactivate_hook' );
      endif;
      delete_transient( 'udtbp_activation_pointer_transient' );
    }// end udtbp_initialize()

  /**
   * Display Admin Notice on Activation
   *
   * Displays dashboard notice to let users know a new
   * version of plugin is available.
   *
   * @since 3.0.0
   */
    public function udtbp_admin_notice_activate(){
      /* Check transient, if available display notice */
      if( get_transient( 'udtbp_admin_notice_activate_transient' ) ){
  ?>
        <div class="updated notice is-dismissible">
          <h1>UDTheme Branding Plugin has been updated.</h1>
          <p>The plugin has been completely rewritten with new features added. To configure the options, select UDTheme Options in the admin sidebar. If you have any questions please email <a href="mailto:consult@udel.edu">consult@udel.edu</a></p>
        </div>
    <?php
      /* Delete transient, only display this notice once. */
        delete_transient( 'udtbp_admin_notice_activate_transient' );
      }
    } // end udtbp_admin_notice_activate()
  /**
   * Define Activation Functionality
   *
   * Anything in this function is fired for each blog
   * when the plugin is activated.
   *
   * @since 1.3
   * @version 1.3.9
   *
   */
    private static function single_activate() {}
  } // end class udtbp_Activation
endif;
