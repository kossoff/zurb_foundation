<?php
/**
 * @file
 * Template for Zurb Foundation Four column Display Suite layout.
 */

// Set up default classes so that layouts look decent if no classes are applied
// in the Display Suite UI.
if (empty($first_classes) && empty($second_classes) && empty($third_classes)
  && empty($fourth_classes)) {
  $first_classes = ' large-3';
  $second_classes = ' large-3';
  $third_classes = ' large-3';
  $fourth_classes = ' large-3';
}
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="row zf-4col <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <<?php print $first_wrapper ?> class="group-first columns<?php print $first_classes; ?>">
  <?php print $first; ?>
  </<?php print $first_wrapper ?>>

  <<?php print $second_wrapper ?> class="group-second columns<?php print $second_classes;?>">
  <?php print $second; ?>
  </<?php print $second_wrapper ?>>

  <<?php print $third_wrapper ?> class="group-third columns<?php print $third_classes; ?>">
  <?php print $third; ?>
  </<?php print $third_wrapper ?>>

  <<?php print $fourth_wrapper ?> class="group-fourth columns<?php print $fourth_classes; ?>">
  <?php print $fourth; ?>
  </<?php print $fourth_wrapper ?>>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
