<?php

/**
 * Implements template_preprocess_html().
 * 
 * Adds additional classes
 */
//function STARTER_preprocess_html(&$vars) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  // drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//  
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external'); 
//}

/**
 * Implements template_preprocess_page
 *
 * Add convenience variables and template suggestions
 */
//function STARTER_preprocess_page(&$vars) {
//}

/**
 * Implements template_preprocess_node
 *
 * Add template suggestions and classes
 */
//function STARTER_preprocess_node(&$vars) {
//}

/**
 * Implements hook_preprocess_block()
 */
//function STARTER_preprocess_block(&$vars) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function STARTER_form_element_label($vars) {
//  if (!empty($vars['element']['#title'])) {
//    $vars['element']['#title'] = '<span class="secondary label">' . $vars['element']['#title'] . '</span>';
//  }
//  if (!empty($vars['element']['#description'])) {
//    $vars['element']['#description'] = ' <span class="has-tip tip-top radius" data-width="250" title="' . $vars['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($vars);
//}

/**
 * Implements hook_form_alter()
 * Use foundation sexy buttons
 */
//function STARTER_form_alter(&$form, &$form_state, $form_id) {
//  // Sexy submit buttons
//  if (!empty($form['actions']) && $form['actions']['submit']) {
//    $form['actions']['submit']['#attributes'] = array('class' => array('secondary', 'button', 'radius'));
//  }
//}

//function STARTER_preprocess_views_view(&$vars) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 * Adds classes for styling.
 */
//function STARTER_preprocess_panels_pane(&$vars) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 * Shows/hides summary on tiles based on presence of images.
 */
//function THEMENAME_preprocess_views_view_fields(&$vars) {
//}