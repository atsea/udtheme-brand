<?php
/**
  * Class: UDTheme Branding Header Settings
  *
  * Header tab in admin dashboard.
  * Extends the udtbp_Admin class and used in public and admin areas.
  * Creates and registers settings and fields within the tabs.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/admin
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPL-3.0
  * @link        https://bitbucket.org/UDwebbranding/udtheme-branding-pluign
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
*/
if ( ! class_exists( 'udtbp_Header_Settings' ) ) :
  class udtbp_Header_Settings extends udtbp_Admin {
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
		$this->id    = 'header';
		$this->label = __( 'Header', $this->udtbp );
		$this->udtbp = $udtbp.'_header';
		$this->plugin_settings_tabs[$this->udtbp] = $this->label;
	}
	/**
   * SETTINGS INIT
	 * Creates HEADER settings sections with following fields.
   *
   * @since    3.0.0
   * @var      string           $option_group                   Header Settings group name.
   * @uses                                                      settings_fields( 'udtbp_header_options' ).
   * @var      string           $option_name                    The name of an option to sanitize and save.
   * @param    callable         $settings_sanitize_callback     Callback function for santization.
   * @uses                                                      settings_sanitize( $input )
   * @see                                                       Class: udtbp_Admin()
   * @param    array            $items                          Array of parameters for the social icons displayed in header.
   * @return   mixed                                            The header state and college header text.
	 */
	public function settings_api_init( $items ){
		register_setting(
			$this->udtbp . '_options',
			$this->udtbp . '_options',
			array( $this, 'settings_sanitize' )
		);
    /**
     * SETTINGS SECTION
     * Creates and Registers HEADER settings section on plugin options page.
     *
     * @since     3.0.0
     * @var       string            $id                          ID used to identify this section with which to register options.
     * @var       string            $title                       Title to be displayed on the administration page.
     * @param     callable          $callback                    Callback function used to render the description of the section.
     * @uses                                                     display_options_section()
     * @var       string            $page                        Page on which to add this section of options
    */
    add_settings_section(
      $this->udtbp . '-options',
      apply_filters( $this->udtbp . '-display-section-title', __( '', $this->udtbp ) ),
      array( $this, 'display_options_section' ),
      $this->udtbp . '-header'
    );
    /**
     * DISPLAY HEADER SETTINGS FIELD
     * Creates HEADER View Header field.
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
      'view-header',
      apply_filters( $this->udtbp . '-view-header', __( 'Visibility', $this->udtbp ) ),
      array( $this, 'view_header' ),
      $this->udtbp . '-header',
      $this->udtbp . '-options'
    );
    /**
     * CUSTOM LOGO SETTINGS FIELD
     * Creates HEADER Custom Logo selection field.
     *
     * @since    3.0.0
     * @var      string      $id                  ID used to identify the field. Used in the 'id' attribute of tags.
     * @var      string      $title               Formatted title of the field. Shown as the label for the field during output.
     * @var      callable    $callback            Function that fills the field with the desired form inputs.
     * @uses     custom_logo()
     * @var      string      $page                The page on which this option will be displayed.
     * @uses     options-general
     * @param    array       $items               Array of parameters passed to $callback.
     * @return   mixed                            The header custom logo select value.
    */
		add_settings_field(
			'custom-logo',
			apply_filters( $this->udtbp . '-custom-logo', __( 'Primary Logo', $this->udtbp ) ),
			array( $this, 'custom_logo' ),
			$this->udtbp.'-header',
			$this->udtbp . '-options',
      array(
        'options' => $items
      )
		);
	}
	/**
   * HEADER SECTION CALLBACK FUNCTION
   * Display paragraph at the top of the header fields.
   *
	 * @since     3.0.0
   * @version   1.5.0    Separated html from php
	 */
	public function display_options_section() {
	?>
  <h3 class=""><?php echo esc_html( 'Configure header branding options' ); ?></h3>
  <p><?php echo esc_html( 'Display header with UD or college labeled logo.' ); ?></p>
  <?php
	} // display_options_section()
  /**
   * TOGGLE HEADER VISIBILITY
   *
   * @since     1.4.2
   * @version   1.0.0         Updated code to more robust OOP styles.
   */
  public function view_header() {
    $options  = get_option( $this->udtbp . '_options' );
    $option   = 0;

    if ( ! empty( $options['view-header'] ) ) {
      $option = $options['view-header'];
    }
    else {
      $options['view-header'] = NULL;
    }
?>
    <div class="box-content">
    <input type="hidden" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" value="0">
    <input class="checkbox yes_no_button" style="display: none;" type="checkbox" id="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" name="<?php echo esc_attr( $this->udtbp.'_options[view-header]' )?>" value="1" <?php checked( $option, 1 , TRUE ) ?> >
      <div class="udt_yes_no_button <?php echo esc_attr( (  ! empty( $options['view-header'] ) ) ? 'udt_on_state' : 'udt_off_state' )?>">
        <span class="udt_value_text udt_on_value"><?php _e( 'Enable', $this->udtbp ) ?></span>
        <span class="udt_button_slider"></span>
        <span class="udt_value_text udt_off_value"><?php _e( 'Disable', $this->udtbp ) ?></span>
      </div>
    </div>
<?php
	} // view_header()

	/**
	 * HEADER PRIMARY LOGO
	 *
	 * @since     1.4.2
   * @version   1.0.0                     Updated code to more robust OOP styles.
   * @param     var       $options        Footer color checkbox.
   * @param     array     $items          List of options in array.
   * @return    mixed                     The Text of the 7 colleges to display under UD logo.
	 */
	public function custom_logo( $items ) {
		$options  	= get_option( $this->udtbp . '_options', $items );
		$items =
      [
        NULL => 'Default (No College)',
        'lerner'  => 'Alfred Lerner College of Business &amp; Economics',
        'canr'    => 'College of Agriculture &amp; Natural Resources',
        'cas'     => 'College of Arts &amp; Sciences',
        'ceoe'    => 'College of Earth, Ocean, &amp; Environment',
        'cehd'    => 'College of Education &amp; Human Development',
        'engr'    => 'College of Engineering',
        'chs'     => 'College of Health Sciences'
      ];
		$option 	= '';

		if ( isset( $options['custom-logo'] ) && ! empty( $options['custom-logo'] ) ) {
			$option = $options['custom-logo'];
      $custom_header_text = $items[$option];
		}
    else {
      $option = NULL;
      $custom_header_text = NULL;
    }
		?>
    <div class="box-content">
      <label for="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>">
		    <select id="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>" name="<?php echo esc_attr( $this->udtbp.'_options[custom-logo]' ) ?>" >
          <option style="color:#767676;" value="" disabled aria-disabled="true"><?php _e( 'Choose one...', $this->udtbp ) ?></option>
		      <?php
		      foreach ( $items as $key=>$value ) :
		      ?>
          <option value="<?php echo esc_attr( $key ) ?>" <?php selected( $option, $key ) ?> ><?php echo esc_attr( $value ) ?></option>
		      <?php
          endforeach;
		      ?>
		    </select>
      </label>
      <input type="hidden" id="udt_custom_header_text" name="udt_custom_header_text" value="<?php echo esc_attr( $custom_header_text ) ?>">
      <div class="field_prompt"><?php _e( 'Displays UD logo with college title or UD logo only.', $this->udtbp ) ?></div>
    </div>
  		<?php
      /**
      * UPDATE PRIMARY LOGO
      * Added to pass college text value to public view.
      * TODO: Is this sufficient
      * @since     3.0.0
      * @var       string         $custom_header_text            Hidden field that contains text value from selected option.
      */
      update_option( 'udt_custom_header_text', $custom_header_text );
    } // custom_logo()
  } // end class udtbp_Header_Settings
endif;
