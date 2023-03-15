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
    <?php echo $customheadercode; ?>
</head>
<body class="<?php echo $bodyClass; ?> testez">
<?php if ($customHeaderTop || $customHeaderBottom || $logo || $this->countModules('menu') || $this->countModules('search')): ?>
    <header class="header">
        <?php if ($customHeaderTop): ?>
            <div class="header-top">
                <div class="container<?php echo $fluid; ?>">
                    <div class="row">
                        <div class="col-12">
                            <?php echo $customHeaderTop; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="container<?php echo $fluid; ?>">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="<?php echo $customLogoLink ? $customLogoLink : $this->baseurl; ?>">
                                <?php if ($logo) : ?>
                                    <img src="<?php echo $logo; ?>" alt="<?php echo $sitename; ?>" width="<?php echo $logowidth; ?>" height="<?php echo $logoheight; ?>" />
                                <?php else : ?>
                                    <?php echo htmlspecialchars($sitename); ?>
                                <?php endif; ?>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <jdoc:include type="modules" name="menu" style="none" />
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <?php if ($customHeaderBottom): ?>
            <div class="header-bottom">
                <div class="container<?php echo $fluid; ?>">
                    <div class="row">
                        <div class="col-12">
                            <?php echo $customHeaderBottom; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>
<?php endif; ?>
    <main class="main">
        <div class="container<?php echo $fluid; ?>">
            <div class="row">
                <?php if ($this->countModules('main-top')): ?>
                    <?php echo  positions(array('main-top' => 12), $this->template . '_xhtml'); ?>
                <?php endif; ?>
                <?php if ($this->countModules('breadcrumbs')): ?>
                    <div class="col-12">
                        <jdoc:include type="modules" name="breadcrumbs" style="none" />
                    </div>
                <?php endif; ?>
                <?php if ($this->countModules('left')):?>
                    <div class="col-12 <?php echo $default_column.$col_side;?>">
                        <jdoc:include type="modules" name="left" style="none" />
                    </div>
                <?php endif; ?>
                <div class="col-12 <?php echo $default_column ?>">
                <?php if ($this->countModules('content-top')): ?>
                    <div class="row">
                    <?php echo  positions(array('content-top' => 12), $this->template . '_xhtml'); ?>
                    </div>
                <?php endif; ?>
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                <?php if ($this->countModules('content-bottom')): ?>
                    <div class="row">
                        <?php echo  positions(array('content-bottom' => 12), $this->template . '_xhtml'); ?>
                    </div>                    
                <?php endif; ?>
                </div>
                <?php if ($this->countModules('right')):?>
                    <div class="col-12 <?php echo $default_column.$col_side;?>">
                        <jdoc:include type="modules" name="right" style="none" />
                    </div>
                <?php endif; ?>
                <?php if ($this->countModules('main-bottom')): ?>
                    <?php echo  positions(array('main-bottom' => 12), $this->template . '_xhtml'); ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php if ($this->countModules('footer')): ?>
        <footer class="footer">
            <div class="container<?php echo $fluid; ?>">
                <div class="row">
                    <?php echo  positions(array('footer' => 12), $this->template . '_xhtml'); ?>
                </div>
            </div>
        </footer>
    <?php endif; ?>
    
    <?php echo $customafterbodycode; ?>
    <?php echo $customfootercode; ?>
</body>
</html>
