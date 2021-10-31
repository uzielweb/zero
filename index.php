<?php
/*

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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
    <jdoc:include type="head" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
</head>
<body class="<?php echo $active->alias . ' page-'.str_replace('com_','',$option) . ' view-'.$view. ' task-'.($task? $task : 'none').($pageclass? ' '.$pageclass : '').' itemid-'.$active->id;?>">
    <div class="offCanvas" data-menu="offcanvas_menu">
        <button class="btn button close-canvas ml-auto float-right" id="close-canvas">
            <i class="fa fa-times"></i>
        </button>
        <jdoc:include type="modules" name="menu" />
    </div>
    <header id="{$this->template}-header" class="{$this->template}-header header">
        <?php if ($this->countModules('above-header-top1') or $this->countModules('above-header-top2') or $this->countModules('above-header-top3')) : ?>
        <div id="{$this->template}-above-header-top" class="{$this->template}-above-header-top">
            <div class="container">
                <div class="row">
                    <?php echo positions(array('above-header-top1' => 4, 'above-header-top2' => 4, 'above-header-top3' => 4), 'zero_xhtml'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this->countModules('header-top1') or $this->countModules('header-top2') or $this->countModules('header-top3')) : ?>
        <div id="{$this->template}-header-top" class="{$this->template}-header-top">
            <div class="container">
                <div class="row">
                    <?php echo positions(array('header-top1' => 4, 'header-top2' => 4, 'header-top3' => 4), 'zero_none'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this->countModules('bellow-header-top1') or $this->countModules('bellow-header-top2') or $this->countModules('bellow-header-top3')) : ?>
        <div id="{$this->template}-bellow-header-top" class="{$this->template}-bellow-header-top">
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
                <div id="{$this->template}-logo" class="{$this->template}-logo <?php echo ($defaultmode == 'bootstrap' ? '' : $default_column.'3 col-6');?>" <?php echo ($defaultmode == 'custom' ? ' style="width: 25%"' : '');?>>
                    <h1>
                        <a href="<?php echo $this->baseurl; ?>">
                            <img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $config->get('sitename'); ?>" />
                        </a>
                    </h1>
                </div>
                <?php } ?>
                <?php if ($this->countModules('menu')) : ?>
                <div id="button-canvas" class="{$this->template}-navigation-button col d-block d-lg-none">
                    <button id="offcanvas_button" style="float:right;" class="btn button offCanvas_trigger float-right ml-auto">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <nav id="{$this->template}-navigation" class="{$this->template}-navigation navbar col d-lg-block d-none">
                    <jdoc:include type="modules" name="menu" style="zero_none" />
                </nav>
                <?php endif; ?>
                <?php if ($this->countModules('login')) : ?>
                <div id="{$this->template}-login" class="{$this->template}-login col-12 <?php echo $default_column;?>3 float-right ml-auto">
                    <jdoc:include type="modules" name="login" style="zero_xhtml" />
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <?php if ($this->countModules('slideshow')) : ?>
    <section id="{$this->template}-slideshow" class="{$this->template}-slideshow">
        <div class="row">
            <?php echo positions(array('slideshow' => 12), 'zero_xhtml'); ?>
        </div>
    </section>
    <?php endif; ?>
    <jdoc:include type="message" />
    <?php if ($this->countModules('breadcrumbs')): ?>
    <section id="{$this->template}-breadcrumbs" class="{$this->template}-breadcrumbs">
        <div class="container">
            <div class="row">
                <jdoc:include type="modules" name="breadcrumbs" style="zero_xhtml" />
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('above1')) : ?>
    <section id="{$this->template}-above-a" class="{$this->template}-above-a">
        <div class="container">
            <div class="row">
                <?php echo positions(array('above1' => 12), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('above2') or $this->countModules('above3') or $this->countModules('above4')) : ?>
    <section id="{$this->template}-above-b" class="{$this->template}-above-b">
        <div class="container">
            <div class="row">
                <?php echo positions(array('above2' => 4, 'above3' => 4, 'above4' => 4), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('above5')) : ?>
    <section id="{$this->template}-above-c" class="{$this->template}-above-c">
        <div class="container">
            <div class="row">
                <?php echo positions(array('above5' => 12), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section id="{$this->template}-main-section" class="{$this->template}-main-section">
        <div class="container">
            <div class="row">
                <?php if ($this->countModules('left')): ?>
                <div id="{$this->template}-side-left" class="{$this->template}-side-left <?php echo $col_side_boot_width; ?>" <?php echo $col_side_style; ?>>
                    <div class="row">
                        <?php echo positions(array('left' => 12), 'zero_xhtml'); ?>
                    </div>
                </div>
                <?php endif; ?>
                <div id="{$this->template}-main-content" class="{$this->template}-main-content <?php echo $col_middle_boot_width; ?>">
                    <?php if ($this->countModules('inner-top1')) : ?>
                    <div id="{$this->template}-inner-top-a" class="{$this->template}-inner-top-a">
                        <div class="row">
                            <?php echo positions(array('inner-top1' => 12), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('inner-top2') or $this->countModules('inner-top3') or $this->countModules('inner-top4')) : ?>
                    <div id="{$this->template}-inner-top-b" class="{$this->template}-inner-top-b">
                        <div class="row">
                            <?php echo positions(array('inner-top2' => 4, 'inner-top3' => 4, 'inner-top4' => 4), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('inner-top5')) : ?>
                    <div id="{$this->template}-inner-top-c" class="{$this->template}-inner-top-c">
                        <div class="row">
                            <?php echo positions(array('inner-top5' => 12), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div id="{$this->template}-main">
                        <jdoc:include type="component" />
                    </div>
                    <?php if ($this->countModules('inner-bottom1')) : ?>
                    <div id="{$this->template}-inner-bottom-a" class="{$this->template}-inner-bottom-a">
                        <div class="row">
                            <?php echo positions(array('inner-bottom1' => 12), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('inner-bottom2') or $this->countModules('inner-bottom3') or $this->countModules('inner-bottom4')) : ?>
                    <div id="{$this->template}-inner-bottom-b" class="{$this->template}-inner-bottom-b">
                        <div class="row">
                            <?php echo positions(array('inner-bottom2' => 4, 'inner-bottom3' => 4, 'inner-bottom4' => 4), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('inner-bottom5')) : ?>
                    <div id="{$this->template}-inner-bottom-c" class="{$this->template}-inner-bottom-c">
                        <div class="row">
                            <?php echo positions(array('inner-bottom5' => 12), 'zero_xhtml'); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($this->countModules('right')): ?>
                <div id="{$this->template}-side-right" class="{$this->template}-side-right <?php echo $col_side_boot_width; ?>" <?php echo $col_side_style; ?>>
                    <div class="row">
                        <?php echo positions(array('right' => 12), 'zero_xhtml'); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php if ($this->countModules('bellow1')) : ?>
    <section id="{$this->template}-bellow-a" class="{$this->template}-bellow-a">
        <div class="container">
            <div class="row">
                <?php echo positions(array('bellow1' => 12), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('bellow2') or $this->countModules('bellow3') or $this->countModules('bellow4')) : ?>
    <section id="{$this->template}-bellow-b" class="{$this->template}-bellow-b">
        <div class="container">
            <div class="row">
                <?php echo positions(array('bellow2' => 4, 'bellow3' => 4, 'bellow4' => 4), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('bellow5')) : ?>
    <section id="{$this->template}-bellow-c" class="{$this->template}-bellow-c">
        <div class="container">
            <div class="row">
                <?php echo positions(array('bellow5' => 12), 'zero_xhtml'); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <footer id="{$this->template}-footer" class="{$this->template}-footer">
        <?php if ($this->countModules('inner-footer1')) : ?>
        <div id="{$this->template}-inner-footer-a" class="{$this->template}-inner-footer-a">
            <div class="container">
                <div class="row">
                    <?php echo positions(array('inner-footer1' => 12), 'zero_xhtml'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this->countModules('inner-footer2') or $this->countModules('inner-footer3') or $this->countModules('inner-footer4')) : ?>
        <div id="{$this->template}-inner-footer-b" class="{$this->template}-inner-footer-b">
            <div class="container">
                <div class="row">
                    <?php echo positions(array('inner-footer2' => 4, 'inner-footer3' => 4, 'inner-footer4' => 4), 'zero_xhtml'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($this->countModules('inner-footer5')) : ?>
        <div id="{$this->template}-inner-footer-c" class="{$this->template}-inner-footer-c">
            <div class="container">
                <div class="row">
                    <?php echo positions(array('inner-footer5' => 12), 'zero_xhtml'); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div id="{$this->template}-inner-footer-d" class="{$this->template}-inner-footer-d">
            <div class="container">
                <div class="row">
                    <jdoc:include type="modules" name="footer" style="zero_none" />
                </div>
            </div>
        </div>
    </footer>
    <jdoc:include type="modules" name="debug" />
    <button id="scrolltoTopButton" class="btn button scrolltoTopButton"><i class="fa fa-chevron-up"></i></button>
</body>
</html>
