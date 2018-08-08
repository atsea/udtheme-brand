<?php
/**
  * Class: UDTheme Branding Admin Notices
  *
  * The purpose of this class is to:
  * Define admin paths
  * Enqueue admin specific styles and scripts
  * Register plugin settings in admin dashboard
  * Validate and sanitize plugin options
  * Render plugin settings tabs
  * Display admin specific notices
  * Add settings link to plugin.php
  * Display admin html
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPLv3
  * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
*/
if ( ! class_exists( 'udtbp_Admin_Notices' ) ) :
  class udtbp_Admin_Notices extends udtbp_Admin {
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
    * The active theme.
    *
    * @since    3.0.0
    * @access   private
    * @var      string          $current_theme    The active theme.
    */
    private $current_theme;
    /**
    * Slug of the plugin screen.
    *
    * @since    3.0.0
    * @access   protected
    * @var      string          $plugin_screen_hook_suffix The plugin options screen.
    */
    protected $plugin_screen_hook_suffix = null;
    /**
    * Plugin tabs array.
    *
    * @since    3.0.0
    * @access   public
    * @var      array          $plugin_settings_tabs[]    Individual admin tabs settings.
    */
    public $plugin_settings_tabs = array();
    /**
    * Current Theme and Current Theme CSS Override Arrays (DEPRECATED)
    *
    * @since    3.0.0
    * @deprecated 3.0.4       Replaced with $json_theme_list
    * @access   public
    * @var      array          $issues_theme_name[]      Incompatible theme name and CSS overrides in array.
    */
     public $issues_theme_name = array();
    /**
      * Incompatible themes list array.
      *
      * @since    3.0.1
      * @access   public
      * @var      constant            $json_theme_list       Defined in udtbp-defined-constants.
    */
    //public $json_theme_list;
    /**
    * Initialize the class and set its properties.
    *
    * @since    3.0.0
    * @version  1.0.1    Create json_theme_list instance
    */
    public function __construct( $udtbp, $current_theme ) {
      $this->udtbp = $udtbp;
      $this->current_theme = wp_get_theme();
      $this->plugin_settings_tabs['header']  = 'Header';
      $this->plugin_settings_tabs['footer']  = 'Footer';
      $this->plugin_settings_tabs['about']   = 'About';
      $this->plugin_settings_tabs['support'] = 'Support';
      $this->json_theme_list = JSON_THEME_LIST;
    }
    /**
    * ADMIN NOTICES
    *
    * Display notices in admin area.
    *
    * This function is used to:
    * Verify current theme.
    * Checks if current theme (additional check for Divi)
    * has fixed navigation or has issues with the plugin.
    *
    * @since     3.0.0
    * @version   1.0.1                            Replaced static plugin text with CONSTANT.
    * @return    boolean                          If TRUE, apply CSS overrides.
    * @param     string      $screen              Used to get the name of the screen that the current user is on.
    * @var       string      $div_id              ID for theme override div.
    * @var       string      $div_class           Classes to make div dismissible and hidden.
    * @var       string      $p_class             Adds warning icon and class to $div_id div.
    * @var       string      $theme_name          The active theme.
    * @var       string      $button              Dismiss div button text.
    * @var       string      $current_tab         The current tab (Header, Footer, About, Support)
    * @var       array       $issues_theme_name[]   Array that contains incompatible themes by name.
    * @link   https://gist.github.com/JeffreyWay/3194444
    * @link   https://github.com/collizo4sky/persist-admin-notices-dismissal
    */

    public function udtbp_theme_override_notices( $screen ) {
      $div_id = $this->udtbp.'_theme_override';
      $div_class = 'notice notice-warning is-dismissible hide';
      $p_class = 'dashicons-before dashicons-warning';
      $theme_name = $this->current_theme;
      $button = __( 'Dismiss this notice.' );

      $screen = get_current_screen();
      $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';
      if ( $screen->id != 'settings_page_'.$this->udtbp ) {
        return;
      }

      if ( 'header' === $current_tab ) {
        $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
        $issues_theme_name =
          [
            "Aaron",
            "Anjirai",
            "Boardwalk",
            "Cubic",
            "Divi",
            "Highwind",
            "Matheson",
            "Radiate",
            "Star",
            "Swell Lite",
            "Temptation",
            "Tracks",
            "Twenty Twelve",
            "Twenty Fourteen",
            "Twenty Fifteen",
            "Twenty Sixteen",
            "Twenty Seventeen"
          ]; // end $issues_theme_name

        $notice_div = '<div id="%1$s" class="%2$s"><p class="%3$s">The <span class="theme_name">%4$s Theme</span> %5$s</p><button type="button" class="aria_pressed notice-dismiss" aria-pressed="false"><span class="screen-reader-text">%6$s</span></button></div>';

        if ( in_array( $this->current_theme, $issues_theme_name ) && 1 == $options['view-header']  )  :
          if ( function_exists( 'et_get_option' ) && 'on' === et_get_option( 'divi_fixed_nav', 'on' ) ) {
            $message = __( " has fixed navigation enabled. To ensure full compatibility with the UDTheme Branding Plugin, this setting MUST be disabled in your Theme Options.", $this->udtbp );
            echo sprintf( $notice_div, $div_id, $div_class, $p_class, $theme_name, $message, $button );
          }
          elseif ( function_exists( 'et_get_option' ) && 'false' === et_get_option( 'divi_fixed_nav', 'false' ) ) {
            $message = '';
            $notice_div = '';
            return false;
          }
          else {
            $message = __( ' is not fully compatible with the UDTheme Branding Plugin and may display incorrectly.', $this->udtbp );
            echo sprintf( $notice_div, $div_id, $div_class, $p_class, $theme_name, $message, $button );
          }
        endif; //end in_array check
        echo "MOO" . $this->json_theme_list;
      } // end if current_tab()
      //endif;
    } // end udtbp_theme_override_notices()
  } // end class udtbp_Admin_Notices
endif;
