<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.madtownagency.com
 * @since      1.0.0
 *
 * @package    mta_leadgenpopup
 * @subpackage mta_leadgenpopup/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div id="mta_leadgenpopup_wrapper" class="mta-leadgenpopup-wrapper <?php echo $wrapper_classes; ?>"<?php echo $data_page_name; ?><?php echo $data_timer; ?><?php echo $data_trigger; ?> >
  <div class='mta-leadgenpopup'>
    <div class='mta-leadgenpopup-inside'>
      <div class="header-wrapper">
        <a href="#"<?php echo $data_leadgenclose; ?> class="close-mta-leadgenpopup">&times;</a>
      </div>
      <div class="content-wrapper">
        <div class="text-wrapper">
          <div class="text">
            <div class="text-inside">
              <?php echo $content; ?>
            </div>
          </div>
        </div>
        <div class="form-wrapper <?php echo $form_labels; ?>">
          <div class="form">
            <div class="form-inside">
              <?php echo $form_header; ?>
              <?php echo $form; ?>
              <?php echo $form_footer; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
