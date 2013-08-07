<?php
/**
 * @file
 * Template for Zurb Foundation Two column stacked Display Suite layout.
 */

// Set up default classes so that layouts look decent if no classes are applied
// in the Display Suite UI.
if (empty($header_classes) && empty($left_classes) && empty($right_classes) && empty($footer_classes)) {
  $header_classes = ' large-12';
  $left_classes = ' large-6';
  $right_classes = ' large-6';
  $footer_classes = ' large-12';
}
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="row zf-2col-stacked <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php if (!empty($header)): ?>
    <<?php print $header_wrapper ?> class="group-header columns<?php print $header_classes; ?>">
    <?php print $header; ?>
    </<?php print $header_wrapper ?>>
  <?php endif; ?>

  <<?php print $left_wrapper ?> class="group-left columns<?php print $left_classes; ?>">
  <?php print $left; ?>
  </<?php print $left_wrapper ?>>

  <<?php print $right_wrapper ?> class="group-right columns<?php print $right_classes; ?>">
  <?php print $right; ?>
  </<?php print $right_wrapper ?>>

  <?php if (!empty($footer)): ?>
    <<?php print $footer_wrapper ?> class="group-footer columns<?php print $footer_classes; ?>">
    <?php print $footer; ?>
    </<?php print $footer_wrapper ?>>
  <?php endif; ?>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
