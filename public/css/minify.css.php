<?php
/**
 * UDTheme Branding Minify
 *
 * The purpose of this file is to:
 * Minimize all plugin related CSS stylesheets into a single file
 *
 * @package     udtheme-brand
 * @subpackage  udtheme-brand/public/css
 * @author      Christopher Leonard - University of Delaware | IT CS&S
 * @license     GPLv3
 * @link        https://bitbucket.org/UDwebbranding/udtheme-brand
 * @copyright   Copyright (c) 2012-2018 University of Delaware
 * @version     3.0.4
 */
header( 'Content-type: text/css' );
  ob_start( "compress" );
  function compress( $buffer ) {
/**
 * @since       3.0.0
 * @param       string             $buffer
 * @link                           https://ikreativ.com/combine-minify-css-with-php/
 * @link                           http://stackoverflow.com/questions/9862904/css-merging-with-php
 */
      /* remove comments */
      $buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
      /* remove tabs, spaces, newlines, etc. */
      $buffer = str_replace( array ( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $buffer );
      return $buffer;
  }

  /* your css files */
  include( 'normalize.css' );
  include( 'wcag.css' );
  include( 'header.css' );
  include( 'footer.css' );
  ob_end_flush();
