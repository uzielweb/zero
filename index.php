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
       <?php if ($this->countModules('above-header-top1') or $this->countModules('above-header-top2') or $this->countModules('above-header-top3')) : ?>
         <div class="above-header-top">
           <div class="container">
             <div class="row">
               <?php echo positions(array('above-header-top1' => 4, 'above-header-top2' => 4, 'above-header-top3' => 4), 'zero_xhtml'); ?>
              </div>
           </div>
         </div>
       <?php endif; ?>
       <?php if ($this->countModules('header-top1') or $this->countModules('header-top2') or $this->countModules('header-top3')) : ?>
         <div class="header-top">
           <div class="container">
             <div class="row">
               <?php echo positions(array('header-top1' => 4, 'header-top2' => 4, 'header-top3' => 4), 'zero_none'); ?>
              </div>
           </div>
         </div>
       <?php endif; ?>
        <?php if ($this->countModules('bellow-header-top1') or $this->countModules('bellow-header-top2') or $this->countModules('bellow-header-top3')) : ?>
         <div class="bellow-header-top">
           <div class="container">
             <div class="row">
               <?php echo positions(array('bellow-header-top1' => 4, 'bellow-header-top2' => 4, 'bellow-header-top3' => 4), 'zero_xhtml'); ?>
              </div>
           </div>
         </div>
        <?php endif; ?>
        <div class="container">
          <div class="row">
             <?php

             if ((JFactory::getUser()->id == 0) and ($this->params->get('hidden-logo-for-public') == '1')){
              ?>

              <?php
             }
             elseif (!empty($logo)) { ?>
            <div class="logo col-md-9 col-6">
              <h1>
                <a href="<?php echo $this->baseurl; ?>">
                  <img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $config->get('sitename'); ?>" />
                </a>
              </h1>
            </div>
            <?php } ?>
              <?php if ($this->countModules('menu')) : ?>
             <div class="col d-block d-md-none mobile-menu-button">
                <div onclick="openNav()" class="open-menu"><i class="fa fa-bars"></i></div>
             </div>
            <?php endif; ?>

            <?php if ($this->countModules('login')) : ?>
             <div class="login col-12 col-md-3 float-right ml-auto">
                 <jdoc:include type="modules" name="login" style="zero_xhtml" />
             </div>
            <?php endif; ?>



         </div>
          <?php if ($this->countModules('menu')) : ?>

               <div class="row menu-row">
            <nav class="navigation col-12 d-md-block d-none">
              <jdoc:include type="modules" name="menu" style="zero_none" />
            </nav>
             </div>
             <?php endif; ?>

        </div>
</header>

  <?php if ($this->countModules('slideshow')) : ?>
      <section class="slideshow">
        <div class="row">
          <?php echo positions(array('slideshow' => 12), 'zero_xhtml'); ?>
        </div>
      </section>
      <?php endif; ?>
      <jdoc:include type="message" />
      <?php if ($this->countModules('above1')) : ?>
      <section class="above-a">
        <div class="container">
          <div class="row">
            <?php echo positions(array('above1' => 12), 'zero_xhtml'); ?>
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
            <?php echo positions(array('above5' => 12), 'zero_xhtml'); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php if ($this->countModules('breadcrumbs')): ?>
      <section class="breadcrumbs">
        <div class="container">
          <div class="row">
            <jdoc:include type="modules" name="breadcrumbs" style="xhtml" />
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php if ($this->countModules('welcome-home1') or $this->countModules('welcome-home2')) : ?>
          <section class="welcome-home">
            <div class="container">
              <div class="row">
                <?php echo positions(array('welcome-home1' => 9, 'welcome-home2' => 3), 'zero_xhtml'); ?>
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


           <?php

           $show_component = 'false';
           if (($option ==  'com_community') && (JFactory::getUser()->id == 0)){
               $is_logged = 'false';
           }
           if (($option ==  'com_community') && (JFactory::getUser()->id > 0)){
               $is_logged = 'true';
               $show_component = 'true';
           }
           if (($is_logged == 'false') && ($view  == 'register')) {
             $show_component = 'true';
           }
           if (($is_logged == 'false') && ($view  == 'register')) {
             $show_component = 'true';
           }
           if (($option !=  'com_community') && (JFactory::getUser()->id == 0)){
               $show_component = 'true';
           }


           ?>

           <?php if ($show_component == 'true') : ?>
             <jdoc:include type="component" />
           <?php endif; ?>
          <?php if ($this->countModules('inner-bottom1')) : ?>
          <div class="inner-bottom-a">
            <?php echo positions(array('inner-bottom1' => 12), 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-bottom2') or $this->countModules('inner-bottom3') or $this->countModules('inner-bottom4')) : ?>
          <div class="inner-bottom-b">
            <?php echo positions(array('inner-bottom2' => 4, 'inner-bottom3' => 4, 'inner-bottom4' => 4), 'zero_xhtml'); ?>
          </div>
          <?php endif; ?>
          <?php if ($this->countModules('inner-bottom5')) : ?>
          <div class="inner-bottom-c">
            <?php echo positions(array('inner-bottom5' => 12), 'zero_xhtml'); ?>
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
    <div class="row">
    <?php echo positions(array('bellow1' => 12), 'zero_xhtml'); ?>
   </div>
  </div>
</section>
<?php endif; ?>
<?php if ($this->countModules('bellow2') or $this->countModules('bellow3') or $this->countModules('bellow4')) : ?>
<section class="bellow-b">
  <div class="container">
    <div class="row">
    <?php echo positions(array('bellow2' => 4, 'bellow3' => 4, 'bellow4' => 4), 'zero_xhtml'); ?>
  </div>
  </div>
</section>
<?php endif; ?>
<?php if ($this->countModules('bellow5')) : ?>
<section class="bellow-c">
  <div class="container">
    <div class="row">
        <?php echo positions(array('bellow5' => 12), 'zero_xhtml'); ?>
    </div>
  </div>
</section>
<?php endif; ?>
<footer class="pm-footer">
  <?php if ($this->countModules('inner-footer1')) : ?>
  <div class="inner-footer-a">
    <div class="container">
        <div class="row">
      <?php echo positions(array('inner-footer1' => 12), 'zero_xhtml'); ?>
       </div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('inner-footer2') or $this->countModules('inner-footer3') or $this->countModules('inner-footer4')) : ?>
  <div class="inner-footer-b">
    <div class="container">
        <div class="row">
      <?php echo positions(array('inner-footer2' => 4, 'inner-footer3' => 4, 'inner-footer4' => 4), 'zero_xhtml'); ?>
     </div>
   </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('inner-footer5')) : ?>
  <div class="inner-footer-c">
    <div class="container">
        <div class="row">
      <?php echo positions(array('inner-footer5' => 12), 'zero_xhtml'); ?>
   </div>
   </div>
  </div>
  <?php endif; ?>
  <jdoc:include type="modules" name="foooter" style="zero_none" />
</footer>

<jdoc:include type="modules" name="debug" />

</body>
</html>

</html>
