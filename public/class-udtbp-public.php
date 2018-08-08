<?php
/**
  * Class: UDTheme Branding Public
  *
  * The purpose of this class is to:
  * Enqueue public specific styles and scripts
  * Display public html
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/public
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPLv3
  * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
*/
if ( ! class_exists( 'udtbp_Public' ) ) :
  class udtbp_Public {
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
     * The current active theme.
     *
     * @since    3.0.0
     * @access   private
     * @var      string    $current_theme    The active theme.
     */
    private $current_theme;
   /**
    * Public image URL Constant
    *
    * @since    3.0.0
    * @access   private
    * @var      string    $const_public_image    Defined within udtbp-defined-constant.
    *                                            Used in place of defined CONST limitation
    *                                            in heredoc
    *
  */
   private $const_public_image;
   /**
    * Public views URL Constant
    *
    * @since    3.0.4
    * @access   private
    * @var      string    $const_public_views    Defined within udtbp-defined-constant.
  */
   private $const_public_views;
    /**
     * Current Theme and Current Theme CSS Override Arrays
     *
     * @since   3.0.0
     * @access  public
     * @var     array    $issues_theme_name[]   Defined in udtbp_Admin_Notices class.
    */
   /**
    public $issues_theme_name = array();
    /**
      * Incompatible themes list array.
      *
      * @since    3.0.1
      * @access   public
      * @var      array   $json_theme_list[]    Defined in udtbp-defined-constants.
    */
    public $json_theme_list = array();
    /**
     * The custom college header text.
     *
     * @since    3.0.0
     * @deprecated 3.0.4          No longer used
     * @access   public
     * @var      string    $udtUrl                The option value of the custom college
     *                                            header text. Derived from Header Settings
     *                                            Primary Logo
     */
    public $udtUrl;
    /**
     * The current footer color.
     *
     * @since    3.0.0
     * @access   public
     * @var      string    $color_footer          The option value for the footer color.
     *                                            Derived from Footer Settings Text and Image Color
     */
    public $color_footer;
    /**
     * CSS Style for position used in theme override styles.
     *
     * @since    3.0.1
     * @access   public
     * @var    string      $strcss_pos_rel        Defines position:relative !important for theme override CSS
     */
    public $strcss_pos_rel;
    /**
     * CSS Style for top location used in theme override styles.
     *
     * @since    3.0.0
     * @access   public
     * @var    string      $strcss_top_0          Defines top:0 !important for theme override CSS
     */
    public $strcss_top_0;
    /**
     * CLASS INITIALIZATION
     * Initiates the class and set its properties.
     *
     * @since    3.0.0
     */
    public function __construct( $udtbp, $current_theme ) {
      $this->udtbp = $udtbp;
      $this->current_theme = wp_get_theme();
      $udtUrl = get_option( 'udt_custom_header_text' );
      $this->udtbp_public_views_url = UDTBP_PUBLIC_VIEWS_URL;
    }
    /**
     * ADD SITE ICON
     *
     * Checks to see if user has added a site icon through the theme customizer
     * and if FALSE, loads the default UD branded icon.
     *
     * @since     3.0.0
     * @todo   This is not working. Feature request for CampusPress?
     * @link   https://developer.wordpress.org/reference/functions/wp_site_icon/
     */
    public function udt_add_favicon() {
      if ( ! has_site_icon() && ! is_customize_preview() ) {
        return;
      }
      //
      // $notice_div = '<div id="%1$s"

      $meta_tags = [
        sprintf( '<link rel="icon" type="image/png" href="%s" sizes="32x32">', esc_url( get_site_icon_url( 32, site_url( UDTBP_PUBLIC_IMG_URL.'/touch/favicon-32x32.png' ) ) ) ),
        sprintf( '<link rel="icon" type="image/png" href="%s" sizes="192x192">', esc_url( get_site_icon_url( 192, site_url( UDTBP_PUBLIC_IMG_URL.'/touch/android-chrome-192x192' ) ) ) ),
        sprintf( '<link rel="apple-icon-precomposed" href="%s">', esc_url( get_site_icon_url( 180, site_url( UDTBP_PUBLIC_IMG_URL.'/touch/apple-touch-icon-192x192' ) ) ) ),
        sprintf( '<meta name="msapplication-TileImage" content="%s">', esc_url( get_site_icon_url( 270, site_url( UDTBP_PUBLIC_IMG_URL.'/touch/mediumtile.png' ) ) ) ),


      ];

      /**
      * SITE ICON FILTER
      * Filters the site icon meta tags, so Plugins can add their own.
      *
      * @since    3.0.0
      * @version  1.0.1  added stripslashes() to clean up data
      * @param    array   $meta_tags    Site Icon meta elements.
      */
      $meta_tags = apply_filters( 'site_icon_meta_tags', $meta_tags );
      $meta_tags = array_filter( $meta_tags );

      foreach ( $meta_tags as $meta_tag ) {
        echo stripslashes( $meta_tag )."\n";
      }

      echo "BOO" . get_site_icon_url();
    } // end udt_add_favicon()

      /**
       * ENQUEUE PUBLIC JAVASCRIPT
       * This function is used to:
       * Register and enqueue public-specific javascript
       * Adds public specific javascript files.
       *
       * @since       3.0.0
       * @return      null                   Return early if no settings page is registered.
      */
      public function enqueue_scripts() {
        wp_deregister_script( $this->udtbp . '-public-script' );
        wp_register_script( $this->udtbp .'-public-script', UDTBP_PUBLIC_JS_URL.'/udtbp-public.js', array( 'jquery' ), UDTBP_VERSION, TRUE );
        wp_enqueue_script( $this->udtbp . '-public-script' );
      } // end enqueue_scripts()
  /**
   * ENQUEUE PUBLIC CSS
   * This function is used to:
   * Register and enqueue public-specific stylesheets
   * Adds public specific stylesheets files.
   * Call styles only if plugin is enabled
   *
   * @since     3.0.0
   * @version   1.2     Append date to file name
   * @return    null    Return early if no settings page is registered.
  */
  public function enqueue_styles() {
    $kill_cache = date( 'mdY' );
    $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
    $footer_options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );

    if ( isset( $options ) && !empty( $options ) ) {
     wp_deregister_style( $this->udtbp .'-public-styles' );
     wp_register_style( $this->udtbp .'-public-styles', UDTBP_PUBLIC_CSS_URL.'/minify.css.php', array(), $kill_cache, 'all' );
     wp_enqueue_style( $this->udtbp .'-public-styles' );
   }
    } // end enqueue_styles()
    /**
    * ADD PUBLIC INLINE CSS
    * Adds social icons color to CSS for display in page footer.
    * Applies CSS Overrides for public facing admin bar.
    *
    * @since     3.0.0
    * @return    null    Return early if no settings page is registered.
    */
    public function udtbp_enqueue_inline_public_styles() {
      $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
      if ( isset( $options ) && !empty( $options ) ) :
        $option = $options['color-footer'];
        $custom_social_css = "";
        ?>
        <style type="text/css" id="<?php echo esc_html( $this->udtbp.'-theme-social-css' ) ?>">
        <?php

        $custom_social_css .= "
        span[data-icon='twitter']::after,
        span[data-icon='facebook']::after,
        span[data-icon='instagram']::after,
        span[data-icon='youtube']::after,
        span[data-icon='pintrest']::after,
        span[data-icon='linkedin']::after{
          background: url('".UDTBP_PUBLIC_IMG_URL."/icons/icons_social_footer_".strtolower( $option ).".png') no-repeat
        }"."\n";

        if ( is_admin_bar_showing() ) :
          $custom_social_css .=
          "@media screen and (max-width:600px) {#wpadminbar {position: fixed !important;}}"."\n";
          "@media only screen and (max-width:48em) {#wpadminbar {position:fixed !important;}}"."\n";
        endif;
        echo stripslashes( $custom_social_css );
        ?>
      </style>
      <?php
      else : $option = NULL;
      endif;
    } // end udtbp_enqueue_inline_public_styles
    /**
     * ENQUEUE PUBLIC INLINE CSS STYLES
     *
     * Check active theme and add CSS overrides to avoid plugin style conflicts.
     *
     * @since     3.0.0
     * @version   1.0.1   Removed Highland theme case statement because theme is deprecated.
     * @return    null    Return early if no settings page is registered.
     * @link   https://github.com/DevinVinson/no-sidebar-twentyfifteen/tree/master/nosidebar-twentyfifteen
     */
    public function udtbp_enqueue_inline_theme_styles() {
      $strcss_pos_rel = 'position:relative !important;';
      $strcss_top_0 = 'top:0px !important;';
      if ( in_array( $this->current_theme, $this->json_theme_list ) ) :
        ?>
        <style id="udtbp-theme-override-css">
        <?php
        switch ( $this->current_theme ) {
        	case "Aaron" :
          echo "#site-navigation{
            '. $strcss_pos_rel . '
          }
          .main-navigation{
            '. $strcss_top_0 . '
          }";
          break;

          case "Anjirai" :
          echo "admin-bar.masthead-fixed .site-header {
            '. $strcss_top_0 . '
          }
          .masthead-fixed .site-header {
           '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
         }";
         break;

         case "Boardwalk" :
         echo "archive .site-footer,
         .blog .site-footer,
         .site-header,
         .admin-bar .site-header{
          '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
          }";
          break;

          case "Cubic" :
          echo "body.unfixed-header > .site-header{
            '. $strcss_pos_rel . '
          }
          body.unfixed-header > .sidebar {
            '. $strcss_pos_rel . '
          }
          archive .site-footer,
          .blog .site-footer,
          .site-header,
          .admin-bar .site-header{
            '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
          }";
          break;

          case "Divi" :
          echo "#udtbp_ftlogo > a{
            z-index:99999
          }
                    #top-header{
            z-index:4999 !important
          }
          body.admin-bar.et_fixed_nav #main-header,
          body.admin-bar.et_fixed_nav #top-header{
            ' . $strcss_top_0 . '
          }
          .et_fixed_nav #main-header,
          .et_fixed_nav #top-header{
            '. $strcss_pos_rel . '
          }
          .et_fixed_nav.et_show_nav.et_secondary_nav_enabled.et_header_style_centered #page-container{
            margin-top:0 !important;
            padding-top:0 !important
          }
          #udtbp_footer{
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0
          }
          .ud_grid.ud_grid--gutters.ud_grid--full.large-ud_grid--fit{
            width:100%
          }";
        break;

          // case "Highwind" :
          //   echo ".inner-wrap {
          //           max-width:none !important
          //         }
          //         .admin-bar .main-nav {
          //           ' . $strcss_top_0 . '
          //         }
          //         .main-nav {
          //           position:absolute !important
          //         }";
          // break;

        case "Matheson" :
        echo ".image-anchor {
          display:inline
        }";
        break;

        case "Radiate" :
        echo "body.admin-bar .header-wrap {
          ' . $strcss_top_0 . '
        }
        .header-wrap {
          '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
          width: 100%;
          z-index: 9998 !important;
        }
        #udtbp_header{
          z-index:9999 !important
        }
        #parallax-bg {
          margin-top:182px;
        }";
        break;

        case "Star" :
        echo ".main-navigation {
          '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
        }";
        break;

        case "Swell Lite" :
        echo ".admin-bar #navigation.fixed-nav{
          margin-top: 0 !important
        }
                          #navigation.fixed-nav {
        '. $strcss_pos_rel . '
        }";
        break;

        case "Temptation" :
        echo "#parallax-bg{
          display:none !important;
          visibility:hidden !important
        }";
        break;

        case "Tracks" :
        echo "#udtbp_footer{
          z-index:-1;
          background:#FFF
        }";
        break;

        case "Twenty Twelve" :
        echo "#udtbp_footer {
          line-height: inherit !important;
          margin: 0 !important;
          max-width: 100% !important;
          padding: 1.125em 0 0 !important;
          font-size:10px !important;
          border-top: none !important;
          background:#FFF !important
        }
                        #yellowbar {
        margin: 8px 0 0 !important
        }";
        break;

        case "Twenty Fourteen" :
        echo ".masthead-fixed .site-header {
          '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
        }";
        break;

        case "Twenty Fifteen" :
        echo "body::before{
          display: none !important;
          visibility:hidden !important
        }
                          #page {
        overflow-y:hidden;
        }
                          #sidebar{
        '. $strcss_pos_rel . '
        z-index:1 !important
        }
                          #udtbp_footer {
        '. $strcss_pos_rel . '
        z-index:99 !important
        }
        @media only screen and ( min-width: 46.25em ){
         body::before{
           display: none !important;
           visibility:hidden !important
         }
         .sidebar {
           '. $strcss_pos_rel . '
           z-index:1 !important
         }
         .site-header {
           margin: 0 !important;
           padding: 7.6923% !important;
         }
         .main-navigation {
           margin-bottom: 11.1111% !important;
         }
         .site-footer  {
           display: block;
         }
         .secondary {
           background-color: #FFF !important;
           margin: 7.6923% 7.6923% 0 !important;
           padding: 7.6923% 7.6923% 0 !important;
         }
        }";
        break;

        case "Twenty Sixteen" :
        echo "body.admin-bar:not(.custom-background-image)::before,
        body:not(.custom-background-image)::before{
          '. $strcss_pos_rel . ' ' . $strcss_top_0 . '
          height:0 !important
        }";
        break;

        case "Twenty Seventeen" :
        echo ".site-navigation-fixed.navigation-top,
        .has-header-image .custom-header-media img,
        .has-header-video .custom-header-media video,
        .has-header-video .custom-header-media iframe{
          '. $strcss_pos_rel . '
        }";
        break;

        default:
        echo '';
        break;
        } // end switch()
      ?>
      </style>
      <?php
      endif; // end in_array()
    } // end udtbp_enqueue_inline_theme_styles

    /**
     * Check If Admin Bar Is Visible.
     * Display admin bar if user is logged in on public facing pages.
     *
     * @since     3.0.0
     * @link   http://stackoverflow.com/questions/21277190/wordpress-admin-bar-not-showing-on-frontend
     */
    public function udtbp_show_admin_bar(){
      if( is_user_logged_in() ){
        add_filter( 'show_admin_bar', '__return_TRUE' , 1000 );
      }
    }
    /**
     * Including Header Front End
     * Hack to load content directly after opening <body> tag.
     *
     * @since     3.0.0
     * @param     string        $template
     * @link   http://maltpress.co.uk/2010/10/wordpress-injecting-code-after-the-body-tag-for-plugins/
     */
    public function custom_include( $template ) {
      ob_start();
      return $template;
    }
    /**
     * Hide Plugin html Condition
     * Checks if current page is either wp-login or register action.
     *
     * @since     3.0.0
     * @return    boolean   [If TRUE, hide plugin html]
     * @link   https://code.tutsplus.com/tutorials/wordpress-error-handling-with-wp_error-class-i--cms-21120
     * @link   http://stackoverflow.com/questions/10041200/interpolate-constant-not-variable-into-heredoc
     */
    public function body_inject() {
      global $pagenow;
     $const_public_image = UDTBP_PUBLIC_IMG_URL;

      if ( $pagenow !== 'wp-login.php' && ! isset ( $_GET['action'] ) ) {
        $show_custom_text = '';
        wp_reset_query();
        $options = ( get_option('udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE);

        if ( isset( $options['custom-logo'] ) && ! empty( $options['custom-logo'] ) ) :
          $custom_logo = $options["custom-logo"];
          $udt_custom_header_text = get_option( 'udt_custom_header_text' );//, $custom_header_text);
          /**
            * Hide custom text <span> if no college is chosen in settings.
          */
          if( $custom_logo != NULL ) {
            $show_custom_text = <<<HTML
<span id='$custom_logo'><a href='//www.$custom_logo.udel.edu/' aria-label='$udt_custom_header_text'>$udt_custom_header_text</a></span>
HTML;
          } // end $custom_logo != NULL
        endif; // isset custom-logo

        if( isset( $options["view-header"] ) && !empty( $options["view-header"] ) ) :
          $inject = <<<HTML
<header role="banner" id="udtbp_header">
<div class="ud_grid ud_grid--gutters ud_grid--fit large-ud_grid--fit">
<div class="ud_grid-cell">
<a title="University of Delaware" href="//www.udel.edu/" id="udtbp_logo">
<img alt="Visit the University of Delaware web site." id="ud_primary_logo_big" width="218" height="91" src="{$const_public_image}/logos/logo-udel.png">
</a>$show_custom_text
</div>
</div>
</header>
HTML;

          $content = ob_get_clean();
          $content = preg_replace( '#<body([^>]*)>#i',"<body$1>{$inject}",$content );
          echo $content;
        endif; // isset view-header
      } // end $pagenow check
    } // end body_inject()
    /**
    * PUBLIC SETTINGS CALLBACK FUNCTION
    * Callback function for the admin settings page.
    *
    * @since    3.0.0
    */
    public function front_end_footer() {
      $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
      if( isset( $options['view-footer'] ) && $options['view-footer'] != 0  ):
        include_once ( plugin_dir_path( dirname( __FILE__ ) ) . 'public/views/udtbp-public-footer-display.php' );
      endif;
    }
  } // end class udtbp_Public
endif;
