<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.madtownagency.com
 * @since      1.0.0
 *
 * @package    mta_leadgenpopup
 * @subpackage mta_leadgenpopup/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    mta_leadgenpopup
 * @subpackage mta_leadgenpopup/public
 * @author     Ryan Baron <ryan@madtownagency.com>
 */
class Mta_Leadgenpopup_Public {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

    add_action('wp_footer', array($this, 'display_mta_leadgenpopup_content'), 10, 1);
    add_filter( 'body_class', array($this, 'mta_leadgenpopup_body_classes' ));


    //add_action('mta_leadgenpopup_content', array($this, 'display_mta_leadgenpopup_content'), 10, 1);
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Mta_Leadgenpopup_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Mta_Leadgenpopup_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/styles.min.css', array(), $this->version, 'all' );

  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Mta_Leadgenpopup_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Mta_Leadgenpopup_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/scripts.min.js', array( 'jquery' ), $this->version, true );

  }

  function mta_leadgenpopup_body_classes( $classes ) {
    if( !isset($post_id) || empty($post_id) )
      $post_id = get_the_ID();

    if( isset($post_id) && !empty($post_id) ) {
      $layout = get_post_meta($post_id, '_mta_leadgenpopup_layout', true);

      //only add a class if _mta_leadgenpopup_layout is set
      if(!empty($layout)) {
        $classes[] = 'mta-leadgenpopup';
      }
    }
    return $classes;
  }

  public function display_mta_leadgenpopup_content() {
    $content          = '';
    $form             = '';
    $wrapper_classes  = '';

    if( !isset($post_id) || empty($post_id) )
      $post_id = get_the_ID();

    if( isset($post_id) && !empty($post_id) ) {

      $enable_custom  = get_post_meta($post_id, '_mta_leadgenpopup_enable_custom', true);

      if(isset($enable_custom) && $enable_custom == 'custom') {
        //if mta_leadgenpopup_enable_custom is set user the meta values from the individual page
        $layout         = get_post_meta($post_id, '_mta_leadgenpopup_layout', true);
        $trigger        = get_post_meta($post_id, '_mta_leadgenpopup_trigger', true);
        $timer          = get_post_meta($post_id, '_mta_leadgenpopup_timer', true);
        $superheadline  = get_post_meta($post_id, '_mta_leadgenpopup_superheadline', true);
        $headline       = get_post_meta($post_id, '_mta_leadgenpopup_headline', true);
        $subheadline    = get_post_meta($post_id, '_mta_leadgenpopup_subheadline', true);
        $text           = get_post_meta($post_id, '_mta_leadgenpopup_text', true);

        $form_header_align  = get_post_meta($post_id, '_mta_leadgenpopup_form_header_align', true);
        $form_footer_align  = get_post_meta($post_id, '_mta_leadgenpopup_form_footer_align', true);
        $form_labels        = get_post_meta($post_id, '_mta_leadgenpopup_form_labels', true);
        $form_superheadline = get_post_meta($post_id, '_mta_leadgenpopup_form_superheadline', true);
        $form_headline      = get_post_meta($post_id, '_mta_leadgenpopup_form_headline', true);
        $form_subheadline   = get_post_meta($post_id, '_mta_leadgenpopup_form_subheadline', true);
        $form_text          = get_post_meta($post_id, '_mta_leadgenpopup_form_text', true);
        $gform_id           = get_post_meta($post_id, '_mta_leadgenpopup_gform_id',true);

      } else {

        $default_popup = 0; //assume the page/post is not displaying the popup

        if(is_page()) {
          //check if this page is selected for display of the default popup
          $page_display = get_option( 'mta_leadgen_popup_page_display' );
          $default_popup = isset($page_display['mta_leadgen_pages'][$post_id]) ? $page_display['mta_leadgen_pages'][$post_id] : 0;
        } elseif(is_single()) {
          //check if this ppostage is selected for display of the default popup
          $post_display = get_option( 'mta_leadgen_popup_post_display' );
          $default_popup = isset($post_display['mta_leadgen_posts'][$post_id]) ? $post_display['mta_leadgen_posts'][$post_id] : 0;
        }

        if($default_popup) {
          //if the page/post is using the default display get the popup content values
          $default_content = get_option( 'mta_leadgen_popup_content' );

          $layout             = isset($default_content['mta_leadgenpopup_layout']) ? $default_content['mta_leadgenpopup_layout'] : '';
          $trigger            = isset($default_content['mta_leadgenpopup_trigger']) ? $default_content['mta_leadgenpopup_trigger'] : '';
          $timer              = isset($default_content['mta_leadgenpopup_timer']) ? $default_content['mta_leadgenpopup_timer'] : '';
          $superheadline      = isset($default_content['mta_leadgenpopup_superheadline']) ? $default_content['mta_leadgenpopup_superheadline'] : '';
          $headline           = isset($default_content['mta_leadgenpopup_headline']) ? $default_content['mta_leadgenpopup_headline'] : '';
          $subheadline        = isset($default_content['mta_leadgenpopup_subheadline']) ? $default_content['mta_leadgenpopup_subheadline'] : '';
          $text               = isset($default_content['mta_leadgenpopup_text']) ? $default_content['mta_leadgenpopup_text'] : '';
          $form_header_align  = isset($default_content['mta_leadgenpopup_form_header_align']) ? $default_content['mta_leadgenpopup_form_header_align'] : '';
          $form_footer_align  = isset($default_content['mta_leadgenpopup_form_footer_align']) ? $default_content['mta_leadgenpopup_form_footer_align'] : '';
          $form_labels        = isset($default_content['mta_leadgenpopup_form_labels']) ? $default_content['mta_leadgenpopup_form_labels'] : '';
          $form_superheadline = isset($default_content['mta_leadgenpopup_form_superheadline']) ? $default_content['mta_leadgenpopup_form_superheadline'] : '';
          $form_headline      = isset($default_content['mta_leadgenpopup_form_headline']) ? $default_content['mta_leadgenpopup_form_headline'] : '';
          $form_subheadline   = isset($default_content['mta_leadgenpopup_form_subheadline']) ? $default_content['mta_leadgenpopup_form_subheadline'] : '';
          $form_text          = isset($default_content['mta_leadgenpopup_form_text']) ? $default_content['mta_leadgenpopup_form_text'] : '';
          $gform_id           = isset($default_content['mta_leadgenpopup_gform_id']) ? $default_content['mta_leadgenpopup_gform_id'] : '';
        }
      }

      //bail if the layout is empty
      if(empty($layout)) {
        return false;
      }

      //get the page name and sanitize it for html
      $page_name = sanitize_html_class(str_replace(" ", "-", strtolower(get_the_title($post_id))), 'default');

      //build our data attributes
      $data_trigger       = !empty($trigger) ? " data-leadgen-trigger='$trigger'" : "";
      $data_timer         = !empty($trigger) ? " data-leadgen-timer='$timer'" : "";
      $data_page_name     = !empty($trigger) ? " data-page-name='$page_name'" : "";
      $data_leadgenclose  = !empty($trigger) ? " data-leadgenclose='$page_name'" : "";

      //build the form headline html
      $form_headline_html  = "";
      $form_headline_html .= !empty($form_superheadline) ? "<span class='superheadline'>$form_superheadline</span>" : "";
      $form_headline_html .= !empty($form_headline) ? $form_headline : "";
      $form_headline_html .= !empty($form_subheadline) ? "<span class='subheadline'>$form_subheadline</span>" : "";
      //wrap the form headline html
      $form_header   = !empty($form_headline_html) ? "<div class='form-header $form_header_align'><h2>$form_headline_html</h2></div>" : "";
      //build the form footer html
      $form_footer = !empty($form_text) ? "<div class='form-footer $form_footer_align'>$form_text</div>" : "";

      //build the content headline html
      $headline_html  = "";
      $headline_html .= !empty($superheadline) ? "<span class='superheadline'>$superheadline</span>" : "";
      $headline_html .= !empty($headline) ? $headline : "";
      $headline_html .= !empty($subheadline) ? "<span class='subheadline'>$subheadline</span>" : "";
      //wrap the content headline html
      $content = !empty($headline_html) ? "<h1>$headline_html</h1>" : "";
      $content = isset($text) ? $content . "<div class='text'>" . $text ."</div>" : $content;

      //build the gravity form
      if(!empty($gform_id)) {
        $form .= do_shortcode('[gravityform id="'.$gform_id.'" name="" title="false" description="false" tabIndex="555" ajax="true"]');
      }

      //generate classes and data attributes
      $classes[] = sanitize_html_class($layout);
      $classes[] = $page_name;
      foreach($classes as $class) {
        $wrapper_classes .= isset($class) && !empty($class) ? ' ' . $class : '';
      }

      //include the template (which uses the above generated variables $content, $form, $wrapper_classes)
      include_once('partials/main-public-display.php');
    }
  }
}
