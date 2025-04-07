<?php
    /*
 * @package     Joomla.Site
 * @subpackage  Templates.zero
 *
 * @copyright   Copyright (C) 2018 Uziel Almeida Oliveira via Ponto Mega, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
    defined('_JEXEC') or die('Restricted access');
    // Get useful variables without relying on logic.php
    use Joomla\CMS\Factory as Factory;
    use Joomla\CMS\Uri\Uri as JUri;
    $app      = Factory::getApplication();
    $doc      = Factory::getDocument();
    $sitename = $app->get('sitename');
    $tpath    = JUri::base() . 'templates/' . Factory::getApplication()->getTemplate();
    // Try to use previous page tracking if available
    $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : JUri::base();
    $goBackUrl    = (strpos($previousPage, 'error') === false) ? $previousPage : JUri::base();
    // Error details
    if (! isset($this->error)) {
        $this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
        $this->debug = false;
    }
    $errorCode    = $this->error->getCode();
    $errorMessage = htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
    lang="<?php echo $this->language; ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $errorCode; ?> -<?php echo $errorMessage; ?></title>
    <!-- Load bootstrap CSS directly -->
    <link href="<?php echo $tpath; ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $tpath; ?>/css/template.css" rel="stylesheet" />
    <!-- Ensure FontAwesome is properly loaded -->
    <link href="<?php echo $tpath; ?>/css/all.min.css" rel="stylesheet" />
    <script src="<?php echo $tpath; ?>/js/all.min.js" defer></script>
    <link href="<?php echo $tpath; ?>/css/custom.css" rel="stylesheet" />
    <link href="<?php echo $tpath; ?>/css/responsive.css" rel="stylesheet" />
    <link href="<?php echo $tpath; ?>/css/error.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mx-auto mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="error-container">
                            <div class="text-center">
                                <div class="error-header">
                                    <div class="error-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="error-code"><?php echo $errorCode; ?></div>
                                    <div class="error-message"><?php echo $errorMessage; ?></div>
                                </div>
                                <div class="mb-4">
                                    <p class="fw-bold"><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
                                    <ol class="text-start ms-4">
                                        <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?>
                                        </li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?>
                                        </li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?>
                                        </li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?>
                                        </li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?>
                                        </li>
                                    </ol>
                                </div>
                                <div class="error-actions">
                                    <a href="<?php echo $goBackUrl; ?>" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>                                                                          <?php echo JText::_('JPREVIOUS'); ?>
                                    </a>
                                    <a href="<?php echo JUri::base(); ?>" class="btn btn-secondary">
                                        <i class="fas fa-home"></i>                                                                    <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?>
                                    </a>
                                </div>
                                <?php if ($this->debug): ?>
                                <div class="alert alert-info mt-4 text-start">
                                    <p>
                                        <i class="fas fa-bug me-2"></i>
                                        <?php echo $errorMessage; ?><br>
                                        <?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8'); ?>:<?php echo $this->error->getLine(); ?>
                                    </p>
                                    <?php echo $this->renderBacktrace(); ?>
<?php if ($this->error->getPrevious()): ?>
<?php $loop = true; ?>
<?php $this->setError($this->_error->getPrevious()); ?>
<?php while ($loop === true): ?>
                                    <p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
                                    <p>
                                        <?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
                                        <br><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8'); ?>:<?php echo $this->_error->getLine(); ?>
                                    </p>
                                    <?php echo $this->renderBacktrace(); ?>
<?php $loop = $this->setError($this->_error->getPrevious()); ?>
<?php endwhile; ?>
<?php $this->setError($this->error); ?>
<?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Load necessary JavaScript files directly -->
    <script src="<?php echo $tpath; ?>/js/bootstrap.bundle.min.js"></script>
</body>
</html>
