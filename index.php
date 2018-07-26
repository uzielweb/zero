<?php
/**
* @package     Joomla.Site
* @subpackage  Templates.zero
*
* @copyright   Copyright (C) 2018 Uziel Almeida Oliveira via Ponto Mega, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die('Restricted access');
include_once JPATH_THEMES . '/' . $this->template . '/logic.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <jdoc:include type="head" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
</head>
<body class="<?php echo $active->alias . ' ' . $pageclass.' page-'.$active->id;?>">
   <header class="pm-header">
        <div class="pm-top">
          <jdoc:include type="modules" name="top" style="zero_none" />
        </div>
        <div class="container">
          <div class="row">
            <?php if (!empty($logo)) { ?>
            <div class="logo col-md-2">
              <h1>
                <a href="<?php echo $this->baseurl; ?>">
                  <img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $config->get('sitename'); ?>" />
                </a>
              </h1>
            </div>
            <?php } ?>
            <nav class="navigation  col-md-10">
              <jdoc:include type="modules" name="menu" style="zero_none" />
            </nav>
          </div>
        </div>
</header>
  <?php if ($this->countModules('slideshow')) : ?>
      <section class="slideshow">
        <div class="row">
          <jdoc:include type="modules" name="slideshow" style="zero_xhtml" />
        </div>
      </section>
      <?php endif; ?>
      <jdoc:include type="message" />
      <?php if ($this->countModules('above1')) : ?>
      <section class="above-a">
        <div class="container">
          <div class="row">
            <jdoc:include type="modules" name="above1" style="zero_xhtml" />
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php if ($this->countModules('above2') or $this->countModules('above3') or $this->countModules('above4')) : ?>
      <section class="above-b">
        <div class="container">
          <div class="row">
            <?php echo positions(array('above2' => 4, 'above3' => 4, 'above4' => 4), 'zero_xhtml'); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php if ($this->countModules('above5')) : ?>
      <section class="above-c">
        <div class="container">
          <div class="row">
            <?php echo positions(array('slideshow') => 12, 'zero_xhtml'); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php if ($this->countModules('breadcrumbs')): ?>
      <section class="breadcrumbs">
        <div class="container">
          <div class="row">
            <?php echo positions(array('breadcrumbs') => 12, 'zero_xhtml'); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
      <section class="main-section">
        <div class="container">
          <div class="row">
            <?php if ($this->countModules('left')): ?>
            <div class="side-left<?php echo $col_side_boot_width; ?>"
                 <?php echo $col_side_style; ?>>
            <jdoc:include type="modules" name="left" style="xhtml" />
          </div>
          <?php endif; ?>
          <div class="main-content<?php echo $col_middle_boot_width; ?>"
               <?php echo $col_middle_style; ?>>
          <?php if ($this->countModules('inner-top1')) : ?>
          <div class="inner-top-a">
            <?php echo positions(array('inner-top1' => 12), 'zero_xhtml' ); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-top2') or $this->countModules('inner-top3') or $this->countModules('inner-top4')) : ?>
          <div class="inner-top-b">
            <?php echo positions(array('inner-top2' => 4, 'inner-top3' => 4, 'inner-top4' => 4), 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-top5')) : ?>
          <div class="inner-top-c">
          <?php echo positions(array('inner-top5') => 12, 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <jdoc:include type="component" />
          <?php if ($this->countModules('inner-bottom1')) : ?>
          <div class="inner-bottom-a">
            <?php echo positions(array('inner-bottom1') => 12, 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-bottom2') or $this->countModules('inner-bottom3') or $this->countModules('inner-bottom4')) : ?>
          <div class="inner-bottom-b">
            <?php echo positions(array('inner-bottom2' => 4, 'inner-bottom3' => 4, 'inner-bottom4' => 4), 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-bottom5')) : ?>
          <div class="inner-bottom-c">
            <?php echo positions(array('inner-bottom5') => 12, 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
        </div>
        <?php if ($this->countModules('right')): ?>
        <div class="side-right<?php echo $col_side_boot_width; ?>"
             <?php echo $col_side_style; ?>>
        <jdoc:include type="modules" name="right" style="xhtml" />
        </div>
      <?php endif; ?>
      </div>
    </div>
  </section>
<?php if ($this->countModules('bellow1')) : ?>
<section class="bellow-a">
  <div class="container">
    <?php echo positions(array('bellow1') => 12, 'zero_xhtml'); ?>
  </div>
</section>
<?php endif; ?>
<?php if ($this->countModules('bellow2') or $this->countModules('bellow3') or $this->countModules('bellow4')) : ?>
<section class="bellow-b">
  <div class="container">
    <?php echo positions(array('bellow2' => 4, 'bellow3' => 4, 'bellow4' => 4), 'zero_xhtml'); ?>
  </div>
</section>
<?php endif; ?>
<?php if ($this->countModules('bellow5')) : ?>
<section class="bellow-c">
  <div class="container">
   <?php echo positions(array('bellow5') => 12, 'zero_xhtml'); ?>
  </div>
</section>
<?php endif; ?>
<footer class="pm-footer">
  <?php if ($this->countModules('inner-footer1')) : ?>
  <div class="inner-footer-a">
    <div class="container">
      <?php echo positions(array('inner-footer1') => 12, 'zero_xhtml'); ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('inner-footer2') or $this->countModules('inner-footer3') or $this->countModules('inner-footer4')) : ?>
  <div class="inner-footer-b">
    <div class="container">
      <?php echo positions(array('inner-footer2' => 4, 'inner-footer3' => 4, 'inner-footer4' => 4), 'zero_xhtml'); ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('inner-footer5')) : ?>
  <div class="inner-footer-c">
    <div class="container">
      <?php echo positions(array('inner-footer5') => 12, 'zero_xhtml'); ?>
    </div>
  </div>
  <?php endif; ?>
  <jdoc:include type="modules" name="foooter" style="zero_none" />
</footer>
<jdoc:include type="modules" name="debug" />
</body>
</html>

</html>
