<?php
/**
 * @file
 * Definition of zf_1col display suite layout.
 */

function ds_zf_1col() {
  return array(
    'label' => t('Zurb Foundation One column'),
    'regions' => array(
      'ds_content' => t('Content'),
    ),
    'image' => TRUE,
  );
}
