<!-- Header and Nav -->
<nav class="top-bar">
  <ul class="title-area">
    <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
    <li><li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li></li>
  </ul>
  <section class="top-bar-section">
  <?php print $main_menu_links; ?>
  </section>
</nav>

  <?php if ($linked_site_name || $linked_logo): ?>
    <div class="large-2 columns">
      <?php if ($linked_logo): ?>
        <?php print $linked_logo; ?>
      <?php endif; ?>
    </div>
    <div class="large-4 columns">
      <?php if ($is_front): ?>
        <h1 id="site-name"><?php print $linked_site_name; ?></h1>
      <?php else: ?>
        <div id="site-name"><?php print $linked_site_name; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
    <?php if ($main_menu_links): ?>
      <nav class="large-12 columns">

      </nav>
    <?php endif; ?>


<?php if (!empty($page['header'])): ?>
  <div class="row">
    <div class="large-12 columns">
      <?php print render($page['header']);?>
    </div>
  </div>
<?php endif; ?>

<div class="row">
  <div class="<?php $site_slogan ? print 'large-6' : print 'large-4 columns large-offset-8'; ?> columns hide-for-small">
    <p>
      <?php if ($logged_in): ?>
        <?php print l(t('My Account'), 'user'); ?>
        <?php print l(t('Logout'), 'user/logout'); ?>
      <?php else: ?>
        <?php print l(t('Login'), 'user/login', array('attributes' => array('class' => array('large', 'radius', 'button')))); ?>
        <?php print l(t('Sign Up'), 'user/register', array('attributes' => array('class' => array('large', 'radius', 'success', 'button')))); ?>
      <?php endif;  ?>
    </p>
  </div>
  <?php if ($site_slogan): ?>
    <div class="large-6 columns panel radius hide-for-small">
      <?php print $site_slogan; ?>
    </div>
  <?php endif; ?>
  <div class="show-for-small">
    <div class="large-6 small-2 columns">
      <p><?php print l(t('Login'), 'user/login', array('attributes' => array('class' => array('radius', 'button', 'small')))); ?></p>
    </div>
    <div class="large-6 small-2 columns">
      <p><?php print l(t('Sign Up'), 'user/register', array('attributes' => array('class' => array('radius', 'success', 'button')))); ?></p>
    </div>
  </div>
</div>
<div class="row">
  <?php if ($messages): print $messages; endif; ?>
  <?php if (!empty($page['help'])): print render($page['help']); endif; ?>
  <div id="main" class="<?php print $main_grid; ?> columns">
    <?php if (!empty($page['highlighted'])): ?>
      <div class="highlight panel callout">
        <?php print render($page['highlighted']); ?>
      </div>
    <?php endif; ?>
    <a id="main-content"></a>
    <?php if ($breadcrumb): print $breadcrumb; endif; ?>
    <?php if ($title && !$is_front): ?>
      <?php print render($title_prefix); ?>
      <h1 id="page-title" class="title"><?php print $title; ?></h1>
      <?php print render($title_suffix); ?>
    <?php endif; ?>

    <?php if (!empty($tabs)): ?>
      <?php print render($tabs); ?>
      <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
    <?php endif; ?>
    <?php if ($action_links): ?>
      <ul class="action-links">
        <?php print render($action_links); ?>
      </ul>
    <?php endif; ?>
    <?php print render($page['content']); ?>
  </div>
  <?php if (!empty($page['sidebar_first'])): ?>
    <div id="sidebar-first" class="<?php print $sidebar_first_grid; ?> columns sidebar ">
      <?php print render($page['sidebar_first']); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($page['sidebar_second'])): ?>
    <div id="sidebar-second" class="<?php print $sidebar_sec_grid;?> columns sidebar">
      <?php print render($page['sidebar_second']); ?>
    </div>
  <?php endif; ?>
</div>
<?php if (!empty($page['footer_first']) || !empty($page['footer_middle']) || !empty($page['footer_last'])): ?>
  <footer class="row">
    <?php if (!empty($page['footer_first'])): ?>
      <div id="footer-first" class="large-4 columns">
        <?php print render($page['footer_first']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_middle'])): ?>
      <div id="footer-middle" class="large-4 columns">
        <?php print render($page['footer_middle']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_last'])): ?>
      <div id="footer-last" class="large-4 columns">
        <?php print render($page['footer_last']); ?>
      </div>
    <?php endif; ?>
  </footer>
<?php endif; ?>
<div class="bottom-bar panel">
  <div class="row">
    <div class="large-12 columns">
      &copy; <?php print date('Y') . ' ' . check_plain($site_name) . ' ' . t('All rights reserved.'); ?>
    </div>
  </div>
</div>
