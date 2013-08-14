<?php
/**
 * @file
 * Definition of Zurb Foundation Three column bricks Display Suite layout.
 */

function ds_zf_3col_bricks() {
  return array(
    'label' => t('Zurb Foundation Three column bricks'),
    'regions' => array(
      'top' => t('Top'),
      'left_above' => t('Above Left'),
      'middle_above' => t('Above Middle'),
      'right_above' => t('Above Right'),
      'middle' => t('Middle'),
      'left_below' => t('Below Left'),
      'middle_below' => t('Below Middle'),
      'right_below' => t('Below Right'),
      'bottom' => t('Bottom'),
    ),
    'image' => TRUE,
  );
}
