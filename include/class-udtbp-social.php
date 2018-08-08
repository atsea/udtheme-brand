<?php
/**
 * Class: UDTheme Branding Social
 *
 * Provides the content for social components for the plugin
 * The purpose of this class is to:
 * Render the social icons in the public-facing footer
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/include
 * @author      Christopher Leonard - University of Delaware | IT CS&S
 * @license     GPLv3
 * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
 * @copyright   Copyright (c) 2012-2017 University of Delaware
 * @version     3.0.4
 */
if ( ! class_exists( 'udtbp_Social' ) ) :
	class udtbp_Social {
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
	 * The version of this plugin.
	 *
	 * @since    1.4.6
	 * @access   private
	 * @var      string    			$version    		The current version of this plugin.
	 */
	 private $version;
	 /**
	  * FOOTER SOCIAL ITEMS
	  *
	  * @since    3.0.0
		* @access   private
		* @var      array 				$items[]					Array that contains name, url and icon class
	  */
		public static function social_footer() {
	    $items = [
	      "twitter"   => [
	    		"url"     => "https://twitter.com/UDelaware",
	      	"icon"    => "twitter"
	      ],
	    	"facebook"  => [
	      	"url"     => "https://www.facebook.com/udelaware",
	       	"icon"    => "facebook"
	      ],
	     "instagram"  => [
	        "url"     => "https://www.instagram.com/udelaware",
	        "icon"    => "instagram"
	      ],
	     "youtube"    => [
	       	"url"     => "https://www.youtube.com/univdelaware",
	       	"icon"    => "youtube"
	       ],
	     "pintrest"   => [
	        "url"     => "https://www.pinterest.com/udelaware/",
	        "icon"    => "pintrest"
	      ],
	     "linkedin"   => [
	        "url"     => "https://www.linkedin.com/edu/school?id=18070",
	        "icon"    => "linkedin"
	      ]
	    ]; // end $items
		  	foreach( $items as $key => $value ) :
		?>
		    <li><a aria-label="<?php echo esc_attr( $key ) ?>" href="<?php echo esc_attr( $value['url'] ) ?>"><span data-icon="<?php echo esc_attr( $value['icon'] ) ?>"></span></a></li>
		<?php
		    endforeach; // end foreach

		} // end function social_footer

	} // end class udtbp_Social
endif;
