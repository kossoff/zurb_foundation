<?php
/**
 * @file
 * Template for Zurb Foundation Three row Display Suite layout.
 */

// Set up default classes so that layouts look decent if no classes are applied
// in the Display Suite UI.
if (empty($header_classes)) {
  $header_classes = ' large-12';
}
if (empty($ds_content_classes)) {
  $ds_content_classes = ' large-12';
}
if (empty($footer_classes)) {
  $footer_classes = ' large-12';
}
?>
<<?php print $layout_wrapper; print $layout_attributes; ?> class="row zf-3row <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <<?php print $header_wrapper ?> class="group-header columns<?php print $header_classes; ?>">
    <?php print $header; ?>
  </<?php print $header_wrapper ?>>

  <<?php print $ds_content_wrapper ?> class="group-content columns<?php print $ds_content_classes; ?>">
    <?php print $ds_content; ?>
  </<?php print $ds_content_wrapper ?>>

  <<?php print $footer_wrapper ?> class="group-footer columns<?php print $footer_classes; ?>">
    <?php print $footer; ?>
  </<?php print $footer_wrapper ?>>

</<?php print $layout_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
