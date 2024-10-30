<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.madtownagency.com
 * @since      1.0.0
 *
 * @package    mta_leadgenpopup
 * @subpackage mta_leadgenpopup/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    mta_leadgenpopup
 * @subpackage mta_leadgenpopup/includes
 * @author     Ryan Baron <ryan@madtownagency.com>
 */
class Mta_Leadgenpopup_i18n {


  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
      'mta-leadgenpopup',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );

  }



}
