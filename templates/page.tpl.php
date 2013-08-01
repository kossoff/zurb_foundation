<!-- Top bar -->
<?php if ($top_bar): ?>
  <?php if ($top_bar_classes): ?>
    <div class="<?php print $top_bar_classes; ?>">
  <?php endif; ?>
    <nav class="top-bar"<?php print $top_bar_options; ?>>
      <ul class="title-area">
        <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
        <li class="toggle-topbar menu-icon"><a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
      </ul>
      <section class="top-bar-section">
        <?php if ($main_menu_links) :?>
          <?php print $main_menu_links; ?>
        <?php endif; ?>
        <?php if ($secondary_menu_links) :?>
          <?php print $secondary_menu_links; ?>
        <?php endif; ?>
      </section>
    </nav>
  <?php if ($top_bar_classes): ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
<!-- End top bar -->

<!-- Title, slogan and menu -->
<?php if ($alt_header): ?>
  <div class="row<?php print $alt_header_classes; ?>">

    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?>

    <?php if ($site_name): ?>
      <h1 title="<?php print $site_name; ?>" id="site-name" class="site-name">
        <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>"><?php print $site_name; ?></a>
      </h1>
    <?php endif; ?>

    <?php if ($site_slogan): ?>
      <h2 title="<?php print $site_slogan; ?>" id="site-slogan" class="site-slogan"><?php print $site_slogan; ?></h2>
    <?php endif; ?>

    <?php if ($main_menu): ?>
      <nav id="main-menu" class="navigation" role="navigation">
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu-links',
            'class' => array('links', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav> <!-- /#main-menu -->
    <?php endif; ?>

    <?php if ($secondary_menu): ?>
      <nav id="secondary-menu" class="navigation" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'id' => 'secondary-menu-links',
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Secondary menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav> <!-- /#secondary-menu -->
    <?php endif; ?>
  </div>
<?php endif; ?>
<!-- End title, slogan and menu -->

<div class="row">
  <?php if ($messages && !$zurb_foundation_messages_modal): print $messages; endif; ?>
  <?php if (!empty($page['help'])): print render($page['help']); endif; ?>

  <!--#main -->
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


  </div><!--/#main -->


  <?php if (!empty($page['sidebar_first'])): ?>
  <!--#sidebar-first -->
    <div id="sidebar-first" class="<?php print $sidebar_first_grid; ?> columns sidebar ">
      <?php print render($page['sidebar_first']); ?>
    </div><!--/#sidebar-first-->
  <?php endif; ?>

  <?php if (!empty($page['sidebar_second'])): ?>
  <!--#sidebar-second -->
    <div id="sidebar-second" class="<?php print $sidebar_sec_grid;?> columns sidebar">
      <?php print render($page['sidebar_second']); ?>
    </div><!--/#sidebar-second -->
  <?php endif; ?>

</div> <!--/.row -->

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
    <div class="large-6 columns">
      <?php if ($site_name) :?>
        &copy; <?php print date('Y') . ' ' . check_plain($site_name) . ' ' . t('All rights reserved.'); ?>
      <?php endif; ?>
    </div>
    <div class="large-6 small-12 columns">
      <?php if(!empty($page['bottom_menu'])) :?>
        <?php print render($page['bottom_menu']); ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
