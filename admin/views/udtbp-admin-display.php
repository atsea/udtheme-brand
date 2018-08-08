<div id="saveResult"></div>
<div id="udt_wrap" class="wrap">
<h1 id="icon-themes" class="udt_dash_icon"><?php echo esc_html( get_admin_page_title() ); ?></h1>
  <?php
    $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'header';
    $this->udtbp_render_tabs();
  ?>
  <div id="poststuff">
    <div id="post-body" class="metabox-holder columns-1">
      <form id="<?php echo esc_attr( $this->udtbp.'_form' )?>" method="post" action="options.php">
      <?php wp_nonce_field( $this->udtbp.'_nonce' );  ?>

        <div id="postbox-container-2" class="postbox-container">
        <?php
        $options = ( get_option( 'udtbp_header_options' ) ? get_option( 'udtbp_header_options' ) : FALSE );
        $options = ( get_option( 'udtbp_footer_options' ) ? get_option( 'udtbp_footer_options' ) : FALSE );
        //$json_theme_list = json_decode( JSON_THEME_LIST );
        // If no tab or header
        switch ($tab) {
          case 'footer':
        ?>
          <div id="udt_footer_settings" class="postbox" role="tabpanel" aria-labelledby="label_udt_footer_settings">
            <div class="inside">
              <?php
                settings_fields( 'udtbp_footer_options' );
                do_settings_sections( 'udtbp_footer-footer' );
              ?>
              <div class="clear"></div>
            </div>
            <div class="aligncenter">
              <button type="submit" class="button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-header-tab-save' );?>"><?php echo esc_html( 'Save Changes' ); ?></button>
            </div>
          </div>
          <?php
            break;
            case 'about':
            ?>
            <div id="udt_about_settings" class="postbox" role="tabpanel" aria-labelledby="label_udt_about_settings">
              <div class="inside">
              <h3>About <?php echo esc_html( UDTBP_NAME ); ?> Plugin</h3>
                <p>The <?php echo esc_html( UDTBP_NAME ); ?> plugin allows a University department or college to display the official University of Delaware branded header and footer on a website. The Branding plugin is only available for <strong>official University department web pages and websites</strong>.</p>
                <p>Academic departments and the seven University colleges may choose to use a college-specific logo in addition to the official University header and footer.</p>
                <div class="clear"></div>
              </div>
            </div>
          <?php
            break;
             case 'support':
            ?>
            <div id="udt_support_settings" class="postbox" role="tabpanel" aria-labelledby="label_udt_support_settings">
              <div class="inside">
               <h3>Support and help information.</h3>
                <p>If you are experiencing problems with this plugin, contact the Support Center at (302) 831-6000 or <a href="mailto:consult@udel.edu">consult@udel.edu</a>.</p>
                <h3>Known Incompatible Themes</h3>
                <p><?php echo esc_html( UDTBP_NAME ); ?> is designed to display a University branded header at the top of each page. Some themes contain features that may cause the UD header to 'hide' beneath the menu or cause the branding to display incorrectly. ( <a href="<?php echo esc_url( UDTBP_ADMIN_IMG_URL );?>/incompatible_example.jpg" class="dialogify" data-width="500" data-height="300">See example</a> ).</p>
                <ul class="support_list">

                <li>Aaron</li>
                  <li>Anjirai</li>
                  <li>Boardwalk</li>
                  <li>Cubic</li>
                  <li>Divi <span>(Only if fixed navigation is enabled)</span></li>
                  <li>Highwind <span>Deprecated</span></li>
                  <li>Magazino</li>
                  <li>Matheson</li>
                  <li>Radiate</li>
                  <li>Star</li>
                  <li>Swell Lite</li>
                  <li>Temptation</li>
                  <li>Tracks</li>
                  <li>Twenty Twelve</li>
                  <li>Twenty Fourteen</li>
                  <li>Twenty Fifteen</li>
                  <li>Twenty Sixteen</li>
                  <li>Twenty Seventeen</li>
                </ul>
              </div>
            </div>
            <div id="dialog" title="Dialog"></div>
          <?php
            break;
            default:
            ?>
          <div id="udt_header_settings" class="postbox" role="tabpanel" aria-labelledby="label_udt_header_settings">
            <div class="inside">
              <?php
              $options = get_option( 'udtbp_header_options' );
              settings_fields( 'udtbp_header_options' );
              do_settings_sections( 'udtbp_header-header' );
              ?>
              <div class="clear"></div>
            </div>
            <div class="aligncenter">
              <button type="submit" class="button save-button" aria-pressed="false" id="<?php echo esc_attr( $this->udtbp.'-header-tab-save' );?>"><?php _e( 'Save Changes' ); ?></button>
            </div>
          </div>
          <?php
            break;
          } // end switch
          ?>
        </div> <!-- end postbox-container-2 -->
      </form>
    </div>
  </div>
</div>
<div id="udtbp-ajax-saving" class="">
  <img src="<?php echo esc_url( UDTBP_ADMIN_IMG_URL.'/loader.gif' ); ?>" alt="loading" id="loading">
</div>
<div id="udtbp-ajax-message" class=""></div>
