<?php
/**
 * @file
 * Definition of zf_2col_stacked display suite layout.
 */

function ds_zf_2col_stacked() {
  return array(
    'label' => t('Zurb Foundation Two column stacked'),
    'regions' => array(
      'header' => t('Header'),
      'left' => t('Left'),
      'right' => t('Right'),
      'footer' => t('Footer'),
    ),
    'image' => TRUE,
  );
}
