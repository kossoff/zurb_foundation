<?php
/**
 * @file
 * Definition of Zurb Foundation Two column bricks Display Suite layout.
 */

function ds_zf_2col_bricks() {
  return array(
    'label' => t('Zurb Foundation Two column bricks'),
    'regions' => array(
      'top' => t('Top'),
      'left_above' => t('Above Left'),
      'right_above' => t('Above Right'),
      'middle' => t('Middle'),
      'left_below' => t('Below Left'),
      'right_below' => t('Below Right'),
      'bottom' => t('Bottom'),
    ),
    'image' => TRUE,
  );
}
