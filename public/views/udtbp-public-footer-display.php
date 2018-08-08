<?php
/**
  * UDTheme Branding Footer Display
  *
  * Defines the core plugin class
  * Includes attributes and functions used in the admin and public areas
  *
  * The purpose of this file is to:
  * Display the UD branded footer on public-facing page.
  * Contains dynamic html that builds the footer on the page.
  *
  * @package     udtheme-brand
  * @subpackage  udtheme-brand/public/views
  * @author      Christopher Leonard - University of Delaware | IT CS&S
  * @license     GPLv3
  * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
  * @copyright   Copyright (c) 2012-2017 University of Delaware
  * @version     3.0.4
 */
  wp_reset_query();
  if( isset( $options["color-footer"] ) && $options["color-footer"] != '' ) {
    $color_footer = $options["color-footer"];
  }
  /**
   * FOOTER HTML
   *
   * Code printed in page footer that displays branded styles and content.
   * See example for IE 11 and Edge bug workaround for flexbox.
   *
   * @since    1.4.2
   * @version  1.1.0        New Accessibility link.
   * @link                  https://github.com/philipwalton/flexbugs
   */
?>
<footer itemtype="http://schema.org/EducationalOrganization" role="contentinfo" itemscope="" id="udtbp_footer">
	<div class="udgrid udgrid--gutters udgrid--full large-udgrid--fit">
		<div class="udgrid-cell ud_circle_logo">
			<div itemtype="http://schema.org/ImageObject" itemscope="" id="udtbp_ftlogo">
				<a href="//www.udel.edu">
					<img src="<?php echo esc_url( UDTBP_PUBLIC_IMG_URL ); ?>/logos/circle-ud-<?php echo esc_html( $color_footer );?>.png" alt="University of Delaware - Dare to be first." width="325">
				</a>
			</div>
		</div>
		<div id="udtbp_footer_social" class="udgrid-cell ud_alignleft">
			<div id="udtbp_sociallinks">
				<ul>
					<?php
	         $this->path = new udtbp_Social();
	         $this->social_data = udtbp_Social::social_footer();
	        ?>
				</ul>
			</div>
		</div>
		<div class="udgrid udgrid--fit large-udgrid--fit" id="udtbp_footer_legal">
	    <ul>
	      <li>&copy; <?php echo Date('Y'); ?> University of Delaware</li>
	      <li><a href="//www.udel.edu/home/comments.html">Comments</a></li>
	      <li><a href="//www.udel.edu/home/legal-notices.html">Legal Notices</a></li>
	      <li><a href="//www.udel.edu/home/legal-notices/accessibility/">Accessibility</a></li>
	    </ul>
   </div>
	</div>
</footer>
