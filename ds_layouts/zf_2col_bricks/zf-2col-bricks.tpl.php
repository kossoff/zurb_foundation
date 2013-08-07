<?php
/**
 * @file
 * Template for Zurb Foundation Two column bricks Display Suite layout.
 */
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="row zf-2col-stacked <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php if (!empty($top)): ?>
    <<?php print $top_wrapper ?> class="group-top columns<?php print $top_classes; ?>">
    <?php print $top; ?>
    </<?php print $top_wrapper ?>>
  <?php endif; ?>

  <<?php print $left_above_wrapper ?> class="group-left-above columns<?php print $left_above_classes; ?>">
  <?php print $left_above; ?>
  </<?php print $left_above_wrapper ?>>

  <<?php print $right_above_wrapper ?> class="group-right-above columns<?php print $right_above_classes; ?>">
  <?php print $right_above; ?>
  </<?php print $right_above_wrapper ?>>

  <?php if (!empty($middle)): ?>
    <<?php print $middle_wrapper ?> class="group-middle columns<?php print $middle_classes; ?>">
    <?php print $middle; ?>
    </<?php print $middle_wrapper ?>>
  <?php endif; ?>

  <<?php print $left_below_wrapper ?> class="group-left-below columns<?php print $left_below_classes; ?>">
  <?php print $left_below; ?>
  </<?php print $left_below_wrapper ?>>

  <<?php print $right_below_wrapper ?> class="group-right-below columns<?php print $right_below_classes; ?>">
  <?php print $right_below; ?>
  </<?php print $right_below_wrapper ?>>

  <?php if (!empty($bottom)): ?>
    <<?php print $bottom_wrapper ?> class="group-bottom columns<?php print $bottom_classes; ?>">
    <?php print $bottom; ?>
    </<?php print $bottom_wrapper ?>>
  <?php endif; ?>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
