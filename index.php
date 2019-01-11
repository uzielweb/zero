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
  <body class="<?php echo $active->alias . ' page-'.str_replace('com_','',$option) . ' view-'.$view. ' task-'.$task.($pageclass? ' '.$pageclass : '').' itemid-'.$active->id;?>">
   <header id="pm-header" class="pm-header">
      <?php if ($this->countModules('above-header-top1') or $this->countModules('above-header-top2') or $this->countModules('above-header-top3')) : ?>
      <div id="pm-above-header-top" class="pm-above-header-top">
        <div class="container">
          <div class="row">
            <?php echo positions(array('above-header-top1' => 4, 'above-header-top2' => 4, 'above-header-top3' => 4), 'zero_xhtml'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('header-top1') or $this->countModules('header-top2') or $this->countModules('header-top3')) : ?>
      <div id="pm-header-top" class="pm-header-top">
        <div class="container">
          <div class="row">
            <?php echo positions(array('header-top1' => 4, 'header-top2' => 4, 'header-top3' => 4), 'zero_none'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('bellow-header-top1') or $this->countModules('bellow-header-top2') or $this->countModules('bellow-header-top3')) : ?>
      <div id="pm-bellow-header-top" class="pm-bellow-header-top">
        <div class="container">
          <div class="row">
            <?php echo positions(array('bellow-header-top1' => 4, 'bellow-header-top2' => 4, 'bellow-header-top3' => 4), 'zero_xhtml'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class="container">
        <div class="row">
          <?php if (!empty($logo)) { ?>
          <div id="pm-logo" class="pm-logo <?php echo ($type_of_layout = 'custom' ? $col_bootversion.'3 col-6' : '');?>"<?php echo ($type_of_layout = 'custom' ? '' : ' style="width: 33.33%"');?>>
            <h1>
              <a href="<?php echo $this->baseurl; ?>">
                <img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $config->get('sitename'); ?>" />
              </a>
            </h1>
          </div>
          <?php } ?>
          <?php if ($this->countModules('menu')) : ?>

            <nav id="pm-navigation" class="pm-navigation navbar col d-md-block d-none">
              <jdoc:include type="modules" name="menu" style="zero_none" />
            </nav>

          <?php endif; ?>
          <?php if ($this->countModules('login')) : ?>
          <div id="pm-login" class="pm-login col-12 <?php echo $col_bootversion;?>3 float-right ml-auto">
            <jdoc:include type="modules" name="login" style="zero_xhtml" />
          </div>
          <?php endif; ?>
        </div>
      </div>
    </header>
    <?php if ($this->countModules('slideshow')) : ?>
    <section id="pm-slideshow" class="pm-slideshow">
      <div class="container">
        <div class="row">
          <?php echo positions(array('slideshow' => 12), 'zero_xhtml'); ?>
        </div>
       </div>     
    </section>
    <?php endif; ?>
    <jdoc:include type="message" />

    <?php if ($this->countModules('breadcrumbs')): ?>
    <section id="pm-breadcrumbs" class="pm-breadcrumbs">
      <div class="container">
        <div class="row">
          <jdoc:include type="modules" name="breadcrumbs" style="zero_xhtml" />
        </div>
      </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('above1')) : ?>
    <section id="pm-above-a" class="pm-above-a">
      <div class="container">
        <div class="row">
          <?php echo positions(array('above1' => 12), 'zero_xhtml'); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($this->countModules('above2') or $this->countModules('above3') or $this->countModules('above4')) : ?>
    <section id="pm-above-b" class="pm-above-b">
      <div class="container">
        <div class="row">
          <?php echo positions(array('above2' => 4, 'above3' => 4, 'above4' => 4), 'zero_xhtml'); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($this->countModules('above5')) : ?>
    <section id="pm-above-c" class="pm-above-c">
      <div class="container">
        <div class="row">
          <?php echo positions(array('above5' => 12), 'zero_xhtml'); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>
    <section id="pm-main-section" class="pm-main-section">
      <div class="container">
        <div class="row">

          <?php if ($this->countModules('left')): ?>
          <div id="pm-side-left" class="pm-side-left <?php echo $col_side_boot_width; ?>"
               <?php echo $col_side_style; ?>>

    <div class="row">
      <?php echo positions(array('left' => 12), 'zero_xhtml'); ?>
    </div>

          </div>
        <?php endif; ?>
        <div id="pm-main-content" class="pm-main-content <?php echo $col_middle_boot_width; ?>">
          <?php if ($this->countModules('inner-top1')) : ?>
          <div id="pm-inner-top-a" class="pm-inner-top-a">

              <div class="row">
                <?php echo positions(array('inner-top1' => 12), 'zero_xhtml'); ?>
              </div>

          </div>
          <?php endif; ?>

          <?php if ($this->countModules('inner-top2') or $this->countModules('inner-top3') or $this->countModules('inner-top4')) : ?>
          <div id="pm-inner-top-b" class="pm-inner-top-b">

              <div class="row">
                <?php echo positions(array('inner-top2' => 4, 'inner-top3' => 4, 'inner-top4' => 4), 'zero_xhtml'); ?>
              </div>

          </div>
          <?php endif; ?>

          <?php if ($this->countModules('inner-top5')) : ?>
          <div id="pm-inner-top-c" class="pm-inner-top-c">

              <div class="row">
                <?php echo positions(array('inner-top5' => 12), 'zero_xhtml'); ?>
              </div>

          </div>
          <?php endif; ?>
<div id="pm-main">
  <jdoc:include type="component" />
</div>
<?php if ($this->countModules('inner-bottom1')) : ?>
<div id="pm-inner-bottom-a" class="pm-inner-bottom-a">

    <div class="row">
      <?php echo positions(array('inner-bottom1' => 12), 'zero_xhtml'); ?>
    </div>

</div>
<?php endif; ?>

<?php if ($this->countModules('inner-bottom2') or $this->countModules('inner-bottom3') or $this->countModules('inner-bottom4')) : ?>
<div id="pm-inner-bottom-b" class="pm-inner-bottom-b">

    <div class="row">
      <?php echo positions(array('inner-bottom2' => 4, 'inner-bottom3' => 4, 'inner-bottom4' => 4), 'zero_xhtml'); ?>
    </div>

</div>
<?php endif; ?>

<?php if ($this->countModules('inner-bottom5')) : ?>
<div id="pm-inner-bottom-c" class="pm-inner-bottom-c">

    <div class="row">
      <?php echo positions(array('inner-bottom5' => 12), 'zero_xhtml'); ?>
    </div>

</div>
<?php endif; ?>
        </div>
        <?php if ($this->countModules('right')): ?>
        <div id="pm-side-right" class="pm-side-right <?php echo $col_side_boot_width; ?>" <?php echo $col_side_style; ?>>

    <div class="row">
      <?php echo positions(array('right' => 12), 'zero_xhtml'); ?>
    </div>

        </div>
        <?php endif; ?>

        </div>
      </div>
    </section>

        <?php if ($this->countModules('bellow1')) : ?>
        <section id="pm-bellow-a" class="pm-bellow-a">
          <div class="container">
            <div class="row">
              <?php echo positions(array('bellow1' => 12), 'zero_xhtml'); ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <?php if ($this->countModules('bellow2') or $this->countModules('bellow3') or $this->countModules('bellow4')) : ?>
        <section id="pm-bellow-b" class="pm-bellow-b">
          <div class="container">
            <div class="row">
              <?php echo positions(array('bellow2' => 4, 'bellow3' => 4, 'bellow4' => 4), 'zero_xhtml'); ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

        <?php if ($this->countModules('bellow5')) : ?>
        <section id="pm-bellow-c" class="pm-bellow-c">
          <div class="container">
            <div class="row">
              <?php echo positions(array('bellow5' => 12), 'zero_xhtml'); ?>
            </div>
          </div>
        </section>
        <?php endif; ?>

    <footer id="pm-footer" class="pm-footer">
      <?php if ($this->countModules('inner-footer1')) : ?>
      <div id="pm-inner-footer-a" class="pm-inner-footer-a">
        <div class="container">
          <div class="row">
            <?php echo positions(array('inner-footer1' => 12), 'zero_xhtml'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('inner-footer2') or $this->countModules('inner-footer3') or $this->countModules('inner-footer4')) : ?>
      <div id="pm-inner-footer-b" class="pm-inner-footer-b">
        <div class="container">
          <div class="row">
            <?php echo positions(array('inner-footer2' => 4, 'inner-footer3' => 4, 'inner-footer4' => 4), 'zero_xhtml'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('inner-footer5')) : ?>
      <div id="pm-inner-footer-c" class="pm-inner-footer-c">
        <div class="container">
          <div class="row">
            <?php echo positions(array('inner-footer5' => 12), 'zero_xhtml'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <jdoc:include type="modules" name="footer" style="zero_none" />
    </footer>
    <jdoc:include type="modules" name="debug" />
</body>
