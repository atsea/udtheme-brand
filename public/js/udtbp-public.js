/**
 * PUBLIC JAVASCRIPT
 *
 * This file contains all custom jQuery plugins and code used on
 * the plugin public screens. It contains all of the js
 * code necessary to enable device, platform and browser
 * transparency.
 *
 * PLEASE NOTE: The following jQuery plugin dependencies are
 * required in order for this file to run correctly:
 *
 * 1. jQuery      ( http://jquery.com/ )
 *
 * @since 1.4.2
 * @version 1.0.0   added IE feature detection using code from @see
 * @author          Rob W
 * @see             http://stackoverflow.com/posts/9851769/revisions
 * @link         http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser/9851769#9851769
 *
 *
 */
(function( $ ) {
  'use strict';
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  var isEdge = !isIE && !!window.StyleMedia;
  /**
  * INTERNET EXPLORER 6-11 FEATURE CHECK
  *
  * @since  3.0.0
  * @link https://gist.github.com/atsea/3d0aac8f5bdabd95b1a4f04dbc7eaefe
  */
  $(function () {

    if ( isIE ) {
      $( '#udtbp_footer' ).addClass( 'is_ie' );
    }
  }) // end $(function)
  /**
  * MICROSOFT EDGE FEATURE CHECK
  *
  * @since  3.0.0
  * @link https://gist.github.com/atsea/3d0aac8f5bdabd95b1a4f04dbc7eaefe
  */
  $(function () {

    if ( isEdge ) {
      $( '#udtbp_footer' ).addClass( 'is_edge' );
    }
  }) // end $(function)
})( jQuery );

/**
 * FEATURE DETECTION CHECK FOR MS EDGE
 *
 * @link https://mobiforge.com/design-development/html5-pointer-events-api-combining-touch-mouse-and-pen
 */
if (window.PointerEvent) {
  //alert(' Pointer events are supported.');
}
