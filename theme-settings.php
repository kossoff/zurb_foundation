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

    /**
     * General settings.
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

    /**
     * Foundation settings.
     */
    $form['zurb_foundation']['foundation'] = array(
      '#type' => 'fieldset',
      '#title' => t('Foundation Settings'),
    );

    $form['zurb_foundation']['foundation']['top_bar'] = array(
      '#type' => 'fieldset',
      '#title' => t('Top Bar'),
      '#description' => t('The Foundation Top Bar gives you a great way to display a complex navigation bar on small or large screens.'),
    );

    $form['zurb_foundation']['foundation']['top_bar']['zurb_foundation_top_bar_enable'] = array(
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

    $form['zurb_foundation']['foundation']['top_bar']['zurb_foundation_top_bar_animate'] = array(
      '#type' => 'textfield',
      '#title' => t('Animation'),
      '#description' => t('Specify an animation for the top bar or leave blank for none.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_animate'),
      '#states' => array(
        'visible' => array(
          'select[name="zurb_foundation_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['zurb_foundation']['foundation']['top_bar']['zurb_foundation_top_bar_grid'] = array(
      '#type' => 'checkbox',
      '#title' => t('Contain to grid'),
      '#description' => t('Check this for your top bar to be set to your grid width.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_grid'),
      '#states' => array(
        'visible' => array(
          'select[name="zurb_foundation_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['zurb_foundation']['foundation']['top_bar']['zurb_foundation_top_bar_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sticky'),
      '#description' => t('Check this for your top bar to stick to the top of the screen when the user scrolls down.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_sticky'),
      '#states' => array(
        'visible' => array(
          'select[name="zurb_foundation_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['zurb_foundation']['foundation']['top_bar']['zurb_foundation_top_bar_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Menu text'),
      '#description' => t('Specify text to go beside the mobile menu icon or leave blank for none.'),
      '#default_value' => theme_get_setting('zurb_foundation_top_bar_menu_text'),
      '#states' => array(
        'visible' => array(
          'select[name="zurb_foundation_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );
  }
}
