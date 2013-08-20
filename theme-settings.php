<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function zurb_foundation_form_system_theme_settings_alter(&$form, &$form_state) {
  if (!isset($form['zurb_foundation'])) {
    $form['zurb_foundation'] = array(
      '#type' => 'vertical_tabs',
      '#weight' => -10,
    );

    /*
     * General Settings.
     */
    $form['zurb_foundation']['general'] = array(
      '#type' => 'fieldset',
      '#title' => t('General Settings'),
    );

    $form['zurb_foundation']['general']['theme_settings'] = $form['theme_settings'];
    unset($form['theme_settings']);

    $form['zurb_foundation']['general']['logo'] = $form['logo'];
    unset($form['logo']);

    $form['zurb_foundation']['general']['favicon'] = $form['favicon'];
    unset($form['favicon']);

    /*
     * Foundation Top Bar.
     */
    $form['zurb_foundation']['topbar'] = array(
      '#type' => 'fieldset',
      '#title' => t('Foundation Top Bar'),
      '#description' => t('The Foundation Top Bar gives you a great way to display a complex navigation bar on small or large screens.'),
    );

    $form['zurb_foundation']['topbar']['zurb_foundation_top_bar_enable'] = array(
      '#type' => 'select',
      '#title' => t('Enable'),
      '#description' => t('If enabled, the site name and main menu will appear in a bar along the top of the page.'),
      '#options' => array(
        0 => t('Never'),
        1 => t('Always'),
        2 => t('Mobile only'),
      ),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_enable'),
    );

    // Group the rest of the settings in a container to be able to quickly hide
    // them if the Top Bar isn't being used.
    $form['zurb_foundation']['topbar']['container'] = array(
      '#type' => 'container',
      '#states' => array(
        'visible' => array(
          'select[name="zurb_foundation_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['zurb_foundation']['topbar']['container']['zurb_foundation_top_bar_grid'] = array(
      '#type' => 'checkbox',
      '#title' => t('Contain to grid'),
      '#description' => t('Check this for your top bar to be set to your grid width.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_grid'),
    );

    $form['zurb_foundation']['topbar']['container']['zurb_foundation_top_bar_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sticky'),
      '#description' => t('Check this for your top bar to stick to the top of the screen when the user scrolls down. If you\'re using the Admin Menu module and have it set to \'Keep menu at top of page\', you\'ll need to check this option to maintain compatibility.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_sticky'),
    );

    $form['zurb_foundation']['topbar']['container']['zurb_foundation_top_bar_scrolltop'] = array(
      '#type' => 'checkbox',
      '#title' => t('Scroll to top on click'),
      '#description' => t('Jump to top when sticky nav menu toggle is clicked.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_scrolltop'),
      '#states' => array(
        'visible' => array(
          'input[name="zurb_foundation_top_bar_sticky"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['zurb_foundation']['topbar']['container']['zurb_foundation_top_bar_is_hover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Hover to expand menu'),
      '#description' => t('Set this to false to require the user to click to expand the dropdown menu.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_is_hover'),
    );

    // Menu settings.
    $form['zurb_foundation']['topbar']['container']['menu'] = array(
      '#type' => 'fieldset',
      '#title' => t('Dropdown Menu'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['zurb_foundation']['topbar']['container']['menu']['zurb_foundation_top_bar_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Menu text'),
      '#description' => t('Specify text to go beside the mobile menu icon or leave blank for none.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_menu_text'),
    );

    $form['zurb_foundation']['topbar']['container']['menu']['zurb_foundation_top_bar_custom_back_text'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable custom back text'),
      '#description' => t('This is the text that appears to navigate back one level in the dropdown menu. Set this to false and it will pull the top level link name as the back text.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_custom_back_text'),
    );

    $form['zurb_foundation']['topbar']['container']['menu']['zurb_foundation_top_bar_back_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom back text'),
      '#description' => t('Define what you want your custom back text to be.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_back_text'),
      '#states' => array(
        'visible' => array(
          'input[name="zurb_foundation_top_bar_custom_back_text"]' => array('checked' => TRUE),
        ),
      ),
    );

    /*
     * Styles and Scripts.
     */
    $form['zurb_foundation']['styles_scripts'] = array(
      '#type' => 'fieldset',
      '#title' => t('Styles and Scripts'),
      '#collapsible' => TRUE,
    );

    $form['zurb_foundation']['styles_scripts']['zurb_foundation_disable_base_css'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Base Theme CSS'),
      '#description' => t('Disabling the base theme CSS is useful for using SASS in a sub-theme.<br><strong>If you select this option, uncomment the relevant CSS includes in your sub-theme\'s .info file.</strong>'),
      '#default_value' => theme_get_setting('zurb_foundation_disable_base_css'),
    );

    $form['zurb_foundation']['styles_scripts']['zurb_foundation_disable_base_js'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Base Theme JavaScript'),
      '#description' => t('Disabling the base theme JavaScript when using a sub-theme is also recommended for more flexibility over which components get included.<br><strong>If you select this option, uncomment the relevant JS includes in your sub-theme\'s .info file.</strong>'),
      '#default_value' => theme_get_setting('zurb_foundation_disable_base_js'),
    );

    $form['zurb_foundation']['styles_scripts']['zurb_foundation_disable_core_css'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Drupal Core CSS'),
      '#description' => t('Removes all CSS files provided by Drupal Core. <strong>Warning:</strong> This can break things, use with caution.'),
      '#default_value' => theme_get_setting('zurb_foundation_disable_core_css'),
    );

    /*
     * Misc Settings.
     */
    $form['zurb_foundation']['misc'] = array(
      '#type' => 'fieldset',
      '#title' => t('Misc Settings'),
      '#collapsible' => TRUE,
    );

    $form['zurb_foundation']['misc']['zurb_foundation_messages_modal'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display status messages in a modal'),
      '#description' => t('Check this to display Drupal status messages in a Zurb Foundation reveal modal.'),
      '#default_value' => theme_get_setting('zurb_foundation_messages_modal'),
    );

    $form['zurb_foundation']['misc']['zurb_foundation_pager_center'] = array(
      '#type' => 'checkbox',
      '#title' => t('Center pagers on screen'),
      '#description' => t('Uncheck this option to align the pager to the left.'),
      '#default_value' => theme_get_setting('zurb_foundation_pager_center'),
    );
  }
}
