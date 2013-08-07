<?php
/**
 * @file
 * Template for Zurb Foundation Two column Display Suite layout.
 */

// Set up default classes so that layouts look decent if no classes are applied
// in the Display Suite UI.
if (empty($left_classes) && empty($right_classes)) {
  $left_classes = ' large-6';
  $right_classes = ' large-6';
}
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="row zf-2col <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <<?php print $left_wrapper ?> class="group-left columns<?php print $left_classes; ?>">
  <?php print $left; ?>
  </<?php print $left_wrapper ?>>

  <<?php print $right_wrapper ?> class="group-right columns<?php print $right_classes; ?>">
  <?php print $right; ?>
  </<?php print $right_wrapper ?>>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
