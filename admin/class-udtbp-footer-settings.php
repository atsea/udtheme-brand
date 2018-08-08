<?php
/**
  * Class: UDTheme Branding Footer Settings
  *
  * Footer tab in admin dashboard.
  * Extends the udtbp_Admin class and used in public and admin areas.
  * Creates and registers settings and fields within the tabs.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPL-3.0
  * @link        https://bitbucket.org/UDwebbranding/udtheme-branding-plugin
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
 */
if ( ! class_exists( 'udtbp_Footer_Settings' ) ) :
  class udtbp_Footer_Settings extends udtbp_Admin {
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
   * CLASS INITIALIZATION class and set its properties.
   * Initiates the class and set its properties.
   *
   * @since    3.0.0
   * @param    string    $udtbp             The ID of this plugin.
   */
  public function __construct( $udtbp ) {

    $this->id    = 'footer';
    $this->label = __( 'Footer', $this->udtbp );
    $this->udtbp = $udtbp.'_footer';
    $this->plugin_settings_tabs[$this->udtbp] = $this->label;
  }
  /**
   * SETTINGS INIT
   * Creates FOOTER settings sections with following fields.
   *
   * @since    3.0.0
   * @var      string           $option_group                   Footer Settings group name.
   * @uses                                                      settings_fields( 'udtbp_footer_options' ).
   * @var      string           $option_name                    The name of an option to sanitize and save.
   * @param    callable         $settings_sanitize_callback     Callback function for santization.
   * @uses                                                      settings_sanitize( $input )
   * @see                                                       Class: udtbp_Admin()
   * @param    array            $items                          Array of parameters for the social icons displayed in footer.
   * @return   mixed                                            The footer state and color.
   */
  public function settings_api_init( $items ){
    register_setting(
      $this->udtbp . '_options',
      $this->udtbp . '_options',
      array( $this, 'settings_sanitize' )
    );
    /**
     * SETTINGS SECTION
     * Creates and Registers FOOTER settings section on plugin options page.
     *
     * @since     3.0.0
     * @var       string            $id                          ID used to identify this section with which to register options.
     * @var       string            $title                       Title to be displayed on the administration page.
     * @param     callable          $callback                    Callback function used to render the description of the section.
     * @uses                                                     display_options_section()
     * @var       string            $page                        Page on which to add this section of options
     * @see      udtbp-footer
    */
    add_settings_section(
      $this->udtbp . '-options',
      apply_filters( $this->udtbp . '-display-section-title', __( '', $this->udtbp ) ),
      array( $this, 'display_options_section' ),
      $this->udtbp . '-footer'
    );
    /**
     * DISPLAY FOOTER SETTINGS FIELD
     * Creates FOOTER View Footer field.
     *
     * @since    3.0.0
     * @var      string           $id                  ID used to identify the field. Used in the 'id' attribute of tags.
     * @var      string           $title               Formatted title of the field. Shown as the label for the field during output.
     * @var      callable         $callback            Function that fills the field with the desired form inputs.
     * @uses     view_footer()
     * @var      string           $page                The page on which this option will be displayed.
     * @uses                                           options-general
    */
    add_settings_field(
      'view-footer',
      apply_filters( $this->udtbp . '-view-footer', __( 'Visibility', $this->udtbp ) ),
      array( $this, 'view_footer' ),
      $this->udtbp . '-footer',
      $this->udtbp . '-options'
    );
    /**
     * DISPLAY FOOTER COLOR SETTINGS FIELD
     * Creates FOOTER Color field.
     *
     * @since    3.0.0
     * @var      string      $id                  ID used to identify the field. Used in the 'id' attribute of tags.
     * @var      string      $title               Formatted title of the field. Shown as the label for the field during output.
     * @var      callable    $callback            Function that fills the field with the desired form inputs.
     * @uses     color_footer()
     * @var      string      $page                The page on which this option will be displayed.
     * @uses     options-general
     * @param    array       $items               Array of parameters passed to $callback.
     * @return   mixed                            The footer color checkbox value.
    */
    add_settings_field(
      'color-footer',
      apply_filters( $this->udtbp . '-color-footer', __( 'Color', $this->udtbp ) ),
      array( $this, 'color_footer' ),
      $this->udtbp.'-footer',
      $this->udtbp . '-options',
      array(
        'options' => $items
      )
    );
  }

  /**
   * FOOTER SECTION CALLBACK FUNCTION
   * Display paragraph at the top of the header fields.
   *
   * @since     3.0.0
   * @version   1.5.0    Separated html from php
   */
  public function display_options_section() {
  ?>
    <h3 class=""><?php echo esc_html( 'Configure footer branding options' ); ?></h3>
    <p><?php echo esc_html( 'Display footer content in blue or white.' ); ?></p>
  <?php
  } // display_options_section()
  /**
   * TOGGLE FOOTER VISIBILITY
   *
   * @since     1.4.2
   * @version   1.0.0         Updated code to more robust OOP styles.
   */
  public function view_footer() {
    $options  = get_option( $this->udtbp . '_options' );
    $option   = 0;

    if ( ! empty( $options['view-footer'] ) ) {
      $option = $options['view-footer'];
    }
    else {
      $options['view-footer'] = NULL;
    }
    ?>
    <div class="box-content">
      <input type="hidden" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" value="0">
      <label for="<?php echo esc_attr( $this->udtbp.'_options[view-footer]' )?>">
        <input class="checkbox yes_no_button" style="display: none;" type="checkbox" id="<?php echo esc_attr( $this->udtbp )?>_options[view-footer]" name="<?php echo esc_attr( $this->udtbp ) ?>_options[view-footer]" value="1" <?php checked( $option, 1 , TRUE ); ?> >
        <div class="udt_yes_no_button <?php echo (  ! empty( $options['view-footer'] ) ) ? 'udt_on_state' : 'udt_off_state' ?>">

          <span class="udt_value_text udt_on_value"><?php _e( 'Enable', $this->udtbp ) ?></span>
          <span class="udt_button_slider"></span>
          <span class="udt_value_text udt_off_value"><?php _e( 'Disable', $this->udtbp ) ?></span>
        </div>
      </label>
    </div>
  <?php
  } // view_footer()

  /**
   * FOOTER TEXT AND IMAGES COLOR
   *
   * @since     1.4.2
   * @version   1.0.0                     Updated code to more robust OOP styles.
   * @param     var       $options        Footer color checkbox.
   * @param     array     $items[]        List of options in array.
   * @return    mixed                     The colors blue or white to set text and image colors.
   */
  public function color_footer( $items ) {
    $options = get_option( $this->udtbp . '_options', $items );
    $items =
      array(
        'blue'    => TRUE,
        'white'   => TRUE,
      );
    $option   = '';

    if ( isset( $options['color-footer'] ) && ! empty( $options['color-footer'] ) ) {
      $option = $options['color-footer'];
    }
    else {
      $option = NULL;
    }
  ?>
    <div class="box-content">
        <?php
        foreach ( $items as $key=>$value ) :
          ?>
        <label for="rad_<?php echo esc_attr( $key ) ?>_footer">
          <input type="radio" name="<?php echo esc_attr( $this->udtbp ) ?>_options[color-footer]" id="rad_<?php echo esc_attr( $key ) ?>_footer" value="<?php echo $key; ?>" <?php checked( $option, $key ) ?> >
          <div class="scheme_<?php echo esc_attr( $key ) ?>"></div>
        </label>
        <?php
        endforeach;
        ?>
      <div class="field_prompt"><?php _e( 'Choose blue for light background pages or white for dark background pages.', $this->udtbp ) ?></div>
    </div>
    <?php
    } // end color_footer()
  } // end class udtbp_Footer_Settings
endif;
