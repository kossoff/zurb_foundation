<?php
/*
 * @file
 */

$files = array(
  'elements.inc',
  'form.inc',
  'menu.inc',
  'theme.inc',
);

function _zurb_foundation_load($files) {
  $tp = drupal_get_path('theme', 'zurb_foundation');
  $file = '';
  $dir = dirname(__FILE__);

  // Check file path and '.inc' extension
  foreach($files as $file) {
    $file_path = $dir . '/inc/' . $file;
    if ( strpos($file,'.inc') > 0 && file_exists($file_path)) {
      require_once($file_path);
    }
  }
}

_zurb_foundation_load($files);

/**
 * Implements hook_html_head_alter().
 */
function zurb_foundation_html_head_alter(&$head_elements) {
  // HTML5 charset declaration.
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );

  // Optimize mobile viewport.
  $head_elements['mobile_viewport'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width',
    ),
  );

  // Force IE to use Chrome Frame if installed.
  $head_elements['chrome_frame'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' => 'ie=edge, chrome=1',
      'http-equiv' => 'x-ua-compatible',
    ),
  );

  // Remove image toolbar in IE.
  $head_elements['ie_image_toolbar'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'ImageToolbar',
      'content' => 'false',
    ),
  );
}

/**
 * Implements theme_breadrumb().
 *
 * Print breadcrumbs as a list, with separators.
 */
function zurb_foundation_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $breadcrumbs = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $breadcrumbs .= '<ul class="breadcrumbs">';

    foreach ($breadcrumb as $key => $value) {
      $breadcrumbs .= '<li>' . $value . '</li>';
    }

    $title = strip_tags(drupal_get_title());
    $breadcrumbs .= '<li class="current"><a href="#">' . $title. '</a></li>';
    $breadcrumbs .= '</ul>';

    return $breadcrumbs;
  }
}

function zurb_foundation_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div ' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  foreach ($variables['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}

/**
 * Implements theme_field__field_type().
 */
function zurb_foundation_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h2 class="field-label">' . $variables['label'] . ': </h2>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

  return $output;
}

/**
 * Implements theme_links() targeting the main menu specifically.
 * Formats links for Top Bar http://foundation.zurb.com/docs/components/top-bar.html
 */
function zurb_foundation_links__system_main_menu($variables) {
  // Get all the main menu links
  $menu_links = menu_tree_output(menu_tree_all_data(variable_get('menu_main_links_source', 'main-menu')));
  $output = _zurb_foundation_links($menu_links);
  return '<ul class="left">' . $output . '</ul>';
}

/**
 * Implements theme_links() targeting the secondary menu specifically.
 * Formats links for Top Bar http://foundation.zurb.com/docs/components/top-bar.html
 */
function zurb_foundation_links__system_secondary_menu($variables) {
  // Get all the secondary menu links
  $menu_links = menu_tree_output(menu_tree_all_data(variable_get('menu_secondary_links_source', 'user-menu')));
  $output = _zurb_foundation_links($menu_links);
  return '<ul class="right">' . $output . '</ul>';
}

/**
 * Helper function to output menus with Foundation-friendly markup.
 *
 * @param array
 *   An array of menu links.
 *
 * @return string
 *   A rendered list of links, without a <ul> or <ol> wrapper.
 *
 * @see zurb_foundation_links__system_main_menu()
 * @see zurb_foundation_links__system_secondary_menu()
 */
function _zurb_foundation_links($menu_links) {
  // Initialize some variables to prevent errors
  $output = '';
  $sub_menu = '';
  $small_link = '';

  foreach ($menu_links as $link) {
    // Add special class needed for Foundation dropdown menu to work
    $small_link = $link; //duplicate version that won't get the dropdown class, save for later

    if (!empty($link['#below'])) {
      $link['#attributes']['class'][] = 'has-dropdown';
    }

    // Render top level and make sure we have an actual link
    if (!empty($link['#href'])) {
      $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
      // Uncomment if we don't want to repeat the links under the dropdown for large-screen
      // $small_link['#attributes']['class'][] = 'show-for-small';
      $sub_menu = '<li' . drupal_attributes($small_link['#attributes']) . '>' . l($link['#title'], $link['#href']);
      // Get sub navigation links if they exist
      foreach ($link['#below'] as $sub_link) {
        if (!empty($sub_link['#href'])) {
          $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
        }
      }
      $output .= !empty($link['#below']) ? '<ul class="dropdown">' . $sub_menu . '</ul>' : '';

      // Reset dropdown to prevent duplicates
      unset($sub_menu);
      unset($small_link);
      $small_link = '';
      $sub_menu = '';

      $output .=  '</li>';
    }
  }

  return $output;
}

/**
 * Implements hook_preprocess_block()
 */
function zurb_foundation_preprocess_block(&$variables) {
  // Convenience variable for block headers.
  $title_class = &$variables['title_attributes_array']['class'];

  // Generic block header class.
  $title_class[] = 'block-title';

  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $title_class[] = 'element-invisible';
  }

  // Add a unique class for each block for styling.
  $variables['classes_array'][] = $variables['block_html_id'];

  // Add classes based on region.
  switch ($variables['elements']['#block']->region) {
    // Add a striping class
    case 'sidebar_first':
    case 'sidebar_second':
      $variables['classes_array'][] = 'block-' . $variables['zebra'];
    break;

    case 'header':
      $variables['classes_array'][] = 'header';
    break;

    default;
  }
}
/**
 * Implements template_preprocess_field().
 */
function zurb_foundation_preprocess_field(&$variables) {
  $variables['title_attributes_array']['class'][] = 'field-label';

  // Edit classes for taxonomy term reference fields.
  if ($variables['field_type_css'] == 'taxonomy-term-reference') {
    $variables['content_attributes_array']['class'][] = 'comma-separated';
  }

  // Convinence variables
  $name = $variables['element']['#field_name'];
  $bundle = $variables['element']['#bundle'];
  $mode = $variables['element']['#view_mode'];
  $classes = &$variables['classes_array'];
  $title_classes = &$variables['title_attributes_array']['class'];
  $content_classes = &$variables['content_attributes_array']['class'];
  $item_classes = array();

  // Global field classes
  $classes[] = 'field-wrapper';
  $content_classes[] = 'field-items';
  $item_classes[] = 'field-item';

  // Uncomment the lines below to see variables you can use to target a field
  // print '<strong>Name:</strong> ' . $name . '<br/>';
  // print '<strong>Bundle:</strong> ' . $bundle  . '<br/>';
  // print '<strong>Mode:</strong> ' . $mode .'<br/>';

  // Add specific classes to targeted fields
  if(isset($field)) {
    switch ($mode) {
      // All teasers
      case 'teaser':
        switch ($field) {
          // Teaser read more links
          case 'node_link':
            $item_classes[] = 'more-link';
            break;
          // Teaser descriptions
          case 'body':
          case 'field_description':
            $item_classes[] = 'description';
            break;
        }
      break;
    }
  }
 // Check if exists
//  switch ($field) {
//    case 'field_authors':
//      $title_classes[] = 'inline';
//      $content_classes[] = 'authors';
//      $item_classes[] = 'author';
//      break;
//  }

  // Apply odd or even classes along with our custom classes to each item
  foreach ($variables['items'] as $delta => $item) {
    $item_classes[] = $delta % 2 ? 'odd' : 'even';
    $variables['item_attributes_array'][$delta]['class'] = $item_classes;
  }

  // Add class to a specific fields across content types.
  switch ($variables['element']['#field_name']) {
    case 'body':
      $variables['classes_array'] = array('body');
      break;

    case 'field_summary':
      $variables['classes_array'][] = 'text-teaser';
      break;

    case 'field_link':
    case 'field_date':
      // Replace classes entirely, instead of adding extra.
      $variables['classes_array'] = array('text-content');
      break;

    case 'field_image':
      // Replace classes entirely, instead of adding extra.
      $variables['classes_array'] = array('image');
      break;

    default:
      break;
  }
  // Add classes to body based on content type and view mode.
  if ($variables['element']['#field_name'] == 'body') {

    // Add classes to Foobar content type.
    if ($variables['element']['#bundle'] == 'foobar') {
      $variables['classes_array'][] = 'text-secondary';
    }

    // Add classes to other content types with view mode 'teaser';
    elseif ($variables['element']['#view_mode'] == 'teaser') {
      $variables['classes_array'][] = 'text-secondary';
    }

    // The rest is text-content.
    else {
      $variables['classes_array'][] = 'field';
    }
  }
}
/**
 * Implements template_preprocess_html().
 *
 * Adds additional classes
 */
function zurb_foundation_preprocess_html(&$variables) {
  global $language;

  // Clean up the lang attributes
  $variables['html_attributes'] = 'lang="' . $language->language . '" dir="' . $language->dir . '"';

  // Add language body class.
  if (function_exists('locale')) {
    $variables['classes_array'][] = 'lang-' . $variables['language']->language;
  }

  //  @TODO Custom fonts from Google web-fonts
  //  $font = str_replace(' ', '+', theme_get_setting('zurb_foundation_font'));
  //  if (theme_get_setting('zurb_foundation_font')) {
  //    drupal_add_css('http://fonts.googleapis.com/css?family=' . $font , array('type' => 'external', 'group' => CSS_THEME));
  //  }

  // Classes for body element. Allows advanced theming based on context
  if (!$variables['is_front']) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    $arg = explode('/', $_GET['q']);
    if ($arg[0] == 'node' && isset($arg[1])) {
      if ($arg[1] == 'add') {
        $section = 'node-add';
      }
      elseif (isset($arg[2]) && is_numeric($arg[1]) && ($arg[2] == 'edit' || $arg[2] == 'delete')) {
        $section = 'node-' . $arg[2];
      }
    }
    $variables['classes_array'][] = drupal_html_class('section-' . $section);
  }

  // Store the menu item since it has some useful information.
  $variables['menu_item'] = menu_get_item();
  if ($variables['menu_item']) {
    switch ($variables['menu_item']['page_callback']) {
      case 'views_page':
        $variables['classes_array'][] = 'views-page';
        break;
      case 'page_manager_page_execute':
      case 'page_manager_node_view':
      case 'page_manager_contact_site':
        $variables['classes_array'][] = 'panels-page';
        break;
    }
  }
  /*
   * Zepto Fallback
   *   Use with caution
   */
  // drupal_add_js('document.write(\'<script src=/' . drupal_get_path('theme', 'zurb_foundation') .'/js/vendor/\'
  //       + (\'__proto__\' in {} ? \'zepto\' : \'jquery\')
  //       + \'.js><\/script>\');',
  //       'inline', array('group',JS_LIBRARY));
}

/**
 * Implements template_preprocess_node
 *
 * Add template suggestions and classes
 */
function zurb_foundation_preprocess_node(&$variables) {
  // Add node--node_type--view_mode.tpl.php suggestions
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];

  // Add node--view_mode.tpl.php suggestions
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['view_mode'];

  // Add a class for the view mode.
  if (!$variables['teaser']) {
    $variables['classes_array'][] = 'view-mode-' . $variables['view_mode'];
  }

  $variables['title_attributes_array']['class'][] = 'node-title';

//  // Add classes based on node type.
//  switch ($variables['type']) {
//    case 'news':
//    case 'pages':
//      $variables['attributes_array']['class'][] = 'content-wrapper';
//      $variables['attributes_array']['class'][] = 'text-content';
//      break;
//  }
//
//  // Add classes & theme hook suggestions based on view mode.
//  switch ($variables['view_mode']) {
//    case 'block_display':
//      $variables['theme_hook_suggestions'][] = 'node__aside';
//      $variables['title_attributes_array']['class'] = array('title-block');
//      $variables['attributes_array']['class'][] = 'block-content';
//      break;
//  }
}

/**
 * Implements template_preprocess_page
 *
 * Add convenience variables and template suggestions
 */
function zurb_foundation_preprocess_page(&$variables) {
  // Add page--node_type.tpl.php suggestions
  if (!empty($variables['node'])) {
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }

  $variables['logo_img'] = '';
  if (!empty($variables['logo'])) {
    $variables['logo_img'] = theme('image', array(
      'path'  => $variables['logo'],
      'alt'   => strip_tags($variables['site_name']) . ' ' . t('logo'),
      'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
            'attributes' => array(
        'class' => array('logo'),
      ),
    ));
  }

  $variables['linked_logo']  = '';
  if (!empty($variables['logo_img'])) {
    $variables['linked_logo'] = l($variables['logo_img'], '<front>', array(
      'attributes' => array(
        'rel'   => 'home',
        'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
      ),
      'html' => TRUE,
    ));
  }

  $variables['linked_site_name'] = '';
  if (!empty($variables['site_name'])) {
    $variables['linked_site_name'] = l($variables['site_name'], '<front>', array(
      'attributes' => array(
        'rel'   => 'home',
        'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
      ),
    ));
  }

  // Top bar.
  if ($variables['top_bar'] = theme_get_setting('zurb_foundation_top_bar_enable')) {
    $top_bar_classes = array();

    if ($top_bar_animate = theme_get_setting('zurb_foundation_top_bar_animate')) {
      $top_bar_classes[] = 'animated';
      $top_bar_classes[] = $top_bar_animate;
    }

    if (theme_get_setting('zurb_foundation_top_bar_grid')) {
      $top_bar_classes[] = 'contain-to-grid';
    }

    if (theme_get_setting('zurb_foundation_top_bar_sticky')) {
      $top_bar_classes[] = 'sticky';
    }

    if ($variables['top_bar'] == 2) {
      $top_bar_classes[] = 'show-for-small';
    }

    $variables['top_bar_classes'] = implode(' ', $top_bar_classes);
    $variables['top_bar_menu_text'] = theme_get_setting('zurb_foundation_top_bar_menu_text');
  }

  // Site navigation links.
  $variables['main_menu_links'] = '';
  if (isset($variables['main_menu'])) {
    $variables['main_menu_links'] = theme('links__system_main_menu', array(
      'links' => $variables['main_menu'],
      'attributes' => array(
        'id' => 'main-menu',
        'class' => array('main-nav'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
    ));
  }

  $variables['secondary_menu_links'] = '';
  if (isset($variables['secondary_menu'])) {
    $variables['secondary_menu_links'] = theme('links__system_secondary_menu', array(
      'links' => $variables['secondary_menu'],
      'attributes' => array(
        'id'    => 'secondary-menu',
        'class' => array('secondary', 'link-list'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
    ));
  }

  // Convenience variables
  $left = $variables['page']['sidebar_first'];
  $right = $variables['page']['sidebar_second'];

  // Dynamic sidebars
  if (!empty($left) && !empty($right)) {
    $variables['main_grid'] = 'large-6 push-3';
    $variables['sidebar_first_grid'] = 'large-3 pull-6';
    $variables['sidebar_sec_grid'] = 'large-3';
  } elseif (empty($left) && !empty($right)) {
    $variables['main_grid'] = 'large-9';
    $variables['sidebar_first_grid'] = '';
    $variables['sidebar_sec_grid'] = 'large-3';
  } elseif (!empty($left) && empty($right)) {
    $variables['main_grid'] = 'large-9 push-3';
    $variables['sidebar_first_grid'] = 'large-3 pull-9';
    $variables['sidebar_sec_grid'] = '';
  } else {
    $variables['main_grid'] = 'large-12';
    $variables['sidebar_first_grid'] = '';
    $variables['sidebar_sec_grid'] = '';
  }
}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
function zurb_foundation_preprocess_panels_pane(&$variables) {
}

/**
* Implements template_preprocess_views_views_fields().
*/
/* Delete me to enable
function THEMENAME_preprocess_views_view_fields(&$variables) {
 if ($variables['view']->name == 'nodequeue_1') {

   // Check if we have both an image and a summary
   if (isset($variables['fields']['field_image'])) {

     // If a combined field has been created, unset it and just show image
     if (isset($variables['fields']['nothing'])) {
       unset($variables['fields']['nothing']);
     }

   } elseif (isset($variables['fields']['title'])) {
     unset ($variables['fields']['title']);
   }

   // Always unset the separate summary if set
   if (isset($variables['fields']['field_summary'])) {
     unset($variables['fields']['field_summary']);
   }
 }
}
// */
/**
 * Implements template_preprocess_views_view().
 */
function zurb_foundation_preprocess_views_view(&$variables) {

}

/**
 * Implements hook_css_alter()
 */
function zurb_foundation_css_alter(&$css) {
  // Remove defaults.css file.
  //dsm(drupal_get_path('module', 'system') . '/system.menus.css');
  unset($css[drupal_get_path('module', 'system') . '/system.menus.css']);
}

/**
 * Implements hook_js_alter()
 */
function zurb_foundation_js_alter(&$js) {
  if (!module_exists('jquery_update')) {
    // Swap out jQuery to use an updated version of the library.
    // $js['misc/jquery.js']['data'] = drupal_get_path('theme', 'zurb_foundation') . '/js/vendor/jquery.js';
    $js['misc/jquery.js']['version'] = '1.8.2';
  }

  // @TODO moving scripts to footer possibly remove?
  // foreach ($js as $key => $js_script) {
  //   $js[$key]['scope'] = 'footer';
  // }
}

/**
 * Replace Drupal pagers with Foundation pagers.
 */
function zurb_foundation_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('arrow'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('arrow'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('unavailable'),
          'data' => '<a href="">&hellip;</a>',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('current'),
            'data' => '<a href="">' . $i . '</a>',
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('unavailable'),
          'data' => '<a href="">&hellip;</a>',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('arrow'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('arrow'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pagination')),
    ));
  }
}
