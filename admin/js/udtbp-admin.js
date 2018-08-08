/**
 * ADMIN JAVASCRIPT
 *
 * This file contains all custom jQuery plugins and code used on
 * the plugin admin screens. It contains all of the js
 * code necessary to enable the custom controls used in the live
 * previewer.
 *
 * PLEASE NOTE: The following jQuery plugin dependencies are
 * required in order for this file to run correctly:
 *
 * 1. jQuery      ( http://jquery.com/ )
 *
 * @since   1.4.2
 * @version 3.0.4  added accessibility scripts.
 *
 *
 *
 */
(function( $ ) {
  'use strict';


$(function() {
  // previous JS that controls radio sliders, localStorage etc.

      var groupInput = $('.grey-main input[type="radio"]');
      var hdstateinput = $('#header-state input[type="radio"]');
      var notify = $('p.notify');

      var plugin_name = udtheme_admin_js_vars.plugin_name;
      var Header = udtheme_admin_js_vars.Header;
      var header_id = udtheme_admin_js_vars.header_id;
      var header_custom_logo = udtheme_admin_js_vars.header_custom_logo;
      var Footer = udtheme_admin_js_vars.Footer;
      var footer_id = udtheme_admin_js_vars.footer_id;
      var footer_color = udtheme_admin_js_vars.footer_color;
      var block = udtheme_admin_js_vars.block;
      var blank = udtheme_admin_js_vars.blank;
      var hdblank = $( header_id ).add( blank, Header );
      var hdblock = $('#' + header_id + block + 'Header');
      var switch_selection = $('.switch-selection');
      var footerText = 'Footer';
      var ftblank = $('#' + plugin_name + '-blankFooter');
      var ftblock = $('#' + plugin_name + '-blockFooter');
      var ftcolorh3 = $('#footer-color h3 ');
      var ftcolorsmall = $('#footer-color small');
      var ftcolor = $('#footer-color');
      var ftstateinput = $('#footer-state > input');
      var ftcolorinput =$('#footer-color > input');//input[name="sb_bar_footer_options[color-footer]"]');
      var ftError ='';

      var subbut = $('#ud_form input[type="submit"]');
      var Off = 'off';
      var On = 'on';

  // get localStorage value of footer color

  $(function () {
      var data = localStorage.getItem("items");
      localStorage.removeItem('setHeader');

      if (data != null) {
          ftcolorinput.prop("disabled", true);
      }
      console.log(data);
  });

  // http://stackoverflow.com/questions/3357553/how-to-store-an-array-in-localstorage
  var setClass = JSON.parse(localStorage.getItem('setClass')) || {};
  $.each(setClass, function () {
      $(this.selector).addClass(this.className);
  });
  var addClassToLocalStorage = function(selector, className) {
      setClass[selector + ':' + className] = {
          selector: selector,
          className: className
      };
      localStorage.setItem('setClass', JSON.stringify(setClass));
  };
  var removeClassFromLocalStorage = function(selector, className) {
      delete setClass[selector + ':' + className];
      localStorage.setItem('setClass', JSON.stringify(setClass));
  };
  hdstateinput.on('change',function(){
    // http://stackoverflow.com/questions/8622336/jquery-get-value-of-selected-radio-button
    var selectedVal = "";
    var selected = $("#header-state input[type='radio']:checked");
    if (selected.length > 0) {
        selectedVal = selected.val();
    }

    if( selectedVal == 'blankHeader') {
      header_id = NULL;
      $('#header-state, .switch-selection').addClass('blank').removeClass('block');
      notify
        .text('You have turned ' + Off + ' the UD '+ Header.toLowerCase() + '. Click Save Changes for the setting to take effect.')
        .addClass('red')
        .removeClass('green slideup');
      setTimeout(function(){
        notify.addClass('slideup');
      }, 3000);
      $('.notice.notice-warning.is-dismissible').fadeOut('slow');
     //  $('.switch-label.switch-label-off').text(function(_, text) {
     //    return text === 'Disable' ? 'Disabled' : 'Disable';
      // });
      localStorage.removeItem('setHeader');
    }
    else {
      $('#header-state, .switch-selection').addClass('block').removeClass('blank');
      notify
     .text('You have turned ' + On + ' the UD '+ Header.toLowerCase() + '. Click Save Changes for the setting to take effect.')
          .addClass('green')
          .removeClass('red slideup');
      setTimeout(function(){
          notify.addClass('slideup');
      }, 3000);
      $('.notice.notice-warning.is-dismissible').fadeIn('slow');
      // addClassToLocalStorage(switch_selection, 'block');
      // removeClassFromLocalStorage(switch_selection, 'blank');
      localStorage.setItem('setHeader', 1);
    }
  }); // end header-state on()
  //footer control for text changes, on/off notifications and radio slide
  ftstateinput.on('change',function(){
      // http://stackoverflow.com/questions/8622336/jquery-get-value-of-selected-radio-button
      var ft_state_selectedValue = "";
      var ft_state_selected = $("#footer-state input[type='radio']:checked");
      var ft_color_selectedValue = "";
      var ft_color_selected = $("#footer-color input[type='radio']:checked");
      //var selected = $("#footer-state input[type='radio']:checked");
      if (ft_state_selected.length > 0) {
          ft_state_selectedValue = ft_state_selected.val();
      }
      if (ft_color_selected.length > 0) {
          ft_color_selectedValue = ft_state_selected.val();
      }
      else {
        ft_color_selectedValue == null;
      }
      if( ft_state_selectedValue == 'blankFooter') {

        $('#header-state, .switch-selection').addClass('block').removeClass('blank');
        ftcolorinput.prop('checked', false).prop('disabled',true).addClass('disabled');

        notify
          .text('You have turned ' + Off + ' the UD '+ Footer.toLowerCase() + '. Click Save Changes for the setting to take effect.')
          .addClass('red')
          .removeClass('green slideup');
        setTimeout(function(){
          notify.addClass('slideup');
        }, 3000);
        // addClassToLocalStorage(switch_selection, 'blank');
        // removeClassFromLocalStorage(switch_selection, 'block');
        localStorage.removeItem('setFooter');
        //localStorage.removeItem('setColorDiv', array(ftcolorinput.val(), ftcolorinput ) );

        var items = [];
        items[0] = ft_color_selectedValue == '';
        items[1] = ftcolorinput.prop('disabled',true);
        localStorage.setItem("items", JSON.stringify(items));

        //var storeItems = JSON.parse(localStorage.getItem("items"));
      }
      else {
            var ftError = '';
            if (!ftcolorinput.is(':checked') ){
              ftError = 'Choose "Text and images color"';
            }
            ftcolorinput.prop('disabled',false).removeClass('disabled');

            checkColor();

            switch_selection.addClass('block').removeClass('blank');
            notify
           .text('You have turned ' + On + ' the UD '+ Footer.toLowerCase() + ' ' + ftError +'. Click Save Changes for the setting to take effect.')
                .addClass('green')
                .removeClass('red slideur1p');
            setTimeout(function(){
                notify.addClass('slideup');
            }, 3000);
        // addClassToLocalStorage(switch_selection, 'block');
        // removeClassFromLocalStorage(switch_selection, 'blank');
        //localStorage.setItem('setColorDiv', array(ftcolorinput.val(), ftcolorinput.prop('disabled',false) ) );//, ftcolorinput.prop('disabled',true));
        localStorage.setItem('setFooter', 1);

        var items = [];
        items[0] = ftcolorinput.val();
        items[1] = ftcolorinput.prop('disabled',false);
        items[2] = 'setColorDiv';
        localStorage.removeItem("items", JSON.stringify(items));


      }
    }); // end footer state on()
    // footer color option control
    function checkColor() {
        ftcolorinput.on('click', function() {
            ftError = '';
        });
        return true;
    }

    /**********************************************/
    $('.box-content').on( 'click', '.udt_yes_no_button', function(e){
      e.preventDefault();

      var $click_area = $(this),
        $box_content              = $click_area.parents('.box-content'),
        $checkbox                 = $box_content.find('input[type="checkbox"]'),
        $state                    = $box_content.find('.udt_yes_no_button');
        //$header_custom_logo       = $box_content.find('#sb_bar_options[custom-logo]');

      $state.toggleClass('udt_on_state udt_off_state');


      if ( $checkbox.is(':checked' ) ) {
        // check if header visibility is not checked
        $checkbox.prop('checked', false, function(){
          if( $('#udtbp_theme_override').is(':visible')){
            $( '#udtbp_theme_override' ).addClass( 'hide').fadeOut( 'fast' );
          }
        });

      } else {
        $checkbox.prop('checked', true);
        $( '#udtbp_theme_override' ).removeClass( 'hide').fadeIn( 'fast' );
      }
    });  // end box-content on()
    $(' #udt_header_settings select ').on( 'click', function(){
      $( this ).parent( 'label' ).toggleClass( 'focus' );
    });
});

$(function () {
  /**
   * SAVE VIA AJAX
   *
   * @since  3.0.0
   * @link https://stackoverflow.com/questions/10873537/saving-wordpress-settings-api-options-with-ajax
   * @link https://www.wpoptimus.com/434/save-plugin-theme-setting-options-ajax-wordpress/
   */
  function save_main_options_ajax() {
    $( '#udtbp-ajax-saving' ).hide();
    $( '#udtbp_theme_override' ).removeClass( 'hide').fadeIn( 'fast' );
    $('#udtbp_form').submit( function () {
      $( '#udtbp-ajax-saving' ).show('fast').fadeIn( 'fast', function() {
        $(this).delay(500).fadeOut( 'fast' );
      });// fadeIn()
      var b =  $(this).serialize();

      $.post(
        'options.php', b
      )
      .fail(
        function( response ) {
          console.log( 'error' );
          $('#wpbody-content').prepend('<div class="error"><p>'+response.error_message+'</p></div>');
      })
      .done(
        function() {
          console.log('success');
          $('#udtbp-ajax-message')
          .css('background-color', '#090')
          .html('<p class="modal_header" tabindex="0">Settings saved successfully</p>')
          .fadeIn('slow', function() {
            $(this).delay(700).fadeOut('slow');
          });
          // console.log('success');
          // $('#udtbp-ajax-message').removeClass('none').delay(500).fadeIn( 'fast', function() {
          //   $(this).delay(500).fadeOut( 'fast' );
          // });
        }); // end done()
        //setTimeout("$('#saveMessage').hide('slow');", 5000);
        //$('#saveResult').html("<div id='saveMessage' class='successModal'></div>");
        //$('#saveMessage').append("<p>Settings Saved Successfully</p>").show();
      return false;
    }); // end submit()
  } // end save_main_options_ajax()
    save_main_options_ajax();
}) // end $(function)

/**
 * SUPPORT TAB DIALOG
 * @link  https://github.com/salmanarshad2000/demos/blob/v1.0.0/jquery-ui-dialog/size-to-fit-content.html
 */
  $(function () {
    $('#dialog').dialog({
      autoOpen: false,
      resizable: false,
      title: 'link of fixed navigation',
      width: 'auto',
      'closeOnEscape' : true,
      show: {
        effect: 'fade',
        duration: 1000
      },
      hide: {
        effect: 'fade',
        duration: 1000
      }
    }); // end dialog()
    $('.dialogify').on('click', function(e) {
      e.preventDefault();
      $('#dialog').html("<img src='" + $(this).prop("href") + "' width='" + $(this).attr("data-width") + "' height='" + $(this).attr("data-height") + "'>");
      $('#dialog').dialog(
        'option',
        'position', {
          my: 'center',
          at: 'center',
          of: window
      }); // end dialog()
      if ($('#dialog').dialog('isOpen') == false) {
        $('#dialog').dialog('open');
      }
    });
  }) // end $(function)
})( jQuery );


/**
 * ACCESSIBILITY SCRIPTS
 * @link https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role
 * @todo migrate if statement into helper function.
 */
document.querySelectorAll(".switch, .save-button").forEach(function(theSwitch) {
  theSwitch.addEventListener("click", handleClickEvent, false);
});

function handleClickEvent(evt) {
  let el = evt.target;

  if ( (el.getAttribute("aria-checked") == "true") || (el.getAttribute("aria-pressed") == "true") ){
      el.setAttribute("aria-checked", "false");
      el.getAttribute("aria-pressed", "false");
  } else {
      el.setAttribute("aria-checked", "true");
      el.setAttribute("aria-pressed", "true");
  }
}
/**
 * FEATURE DETECTION CHECK FOR MS EDGE
 *
 * @link https://mobiforge.com/design-development/html5-pointer-events-api-combining-touch-mouse-and-pen
 */
if (window.PointerEvent) {
  //alert(' Pointer events are supported.');
}
