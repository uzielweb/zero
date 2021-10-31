<?php
// variables
use Joomla\CMS\Factory;
$app = Factory::getApplication();
$doc = Factory::getDocument();

$app = Factory::getApplication('site');
$template = $app->getTemplate(true);
$defaultmode = $template->params->get('type_of_layout', 'bootstrap');

$menu = $app->getMenu();
$active = $app->getMenu()->getActive();
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl . '/templates/' . $this->template;
$jinput = Factory::getApplication()->input;
$option = $jinput->get('option');
$view = $jinput->get('view');
$task = $jinput->get('task');
$config = Factory::getConfig();
$col_side = $this->params->get('col_side');
$footer_side = $this->params->get('footer_side');
$logo = $this->params->get('logo');
$col_middle_style = '';
//Sections Custom StyleSheet. Please configure in Joomla Template Administration as you need
$sections = $template->params->get('sections', '');
if ($sections) {
    foreach ($sections as $skey => $item) {
        //$item->section;
        //$item->section_background;
        //$item->section_background_color;
        //$item->section_padding;
        //$item->section_margin;
        $item_background = $item->section_background == '' ? '' : 'background-image: url(\'' . JUri::root() . $item->section_background . '\');';
        $item_background_color = $item->section_background_color == '' ? '' : 'background-color: ' . $item->section_background_color . ';';
        $item_padding = $item->section_padding == '' ? '' : 'padding: ' . $item->section_padding . ';';
        $item_margin = $item->section_margin == '' ? '' : 'margin: ' . $item->section_margin . ';';
        $doc->addStyleDeclaration('
      #{$this->template}-' . $item->section . '{'
            . $item_background
            . $item_background_color
            . $item_padding
            . $item_margin . '
  }
  ');
    }
}
// generator tag
$this->setGenerator(null);
//custom favicon
$this->addFavicon($this->baseurl . '/' . $template->params->get('favicon'), $tpath . 'images/favicon.ico');
// loading default bootstrap and jquery from Joomla to apply changes
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
//unset scripts
$headData = $doc->getHeadData();
$scripts = $headData['scripts'];
//scripts to remove, customise as required like mootools-core.js, mootools-more.js, jquery.min.js,jquery-noconflict.js,bootstrap.min.js,jquery-migrate.min.js
//unset($scripts[JUri::root(true) . '/media/system/js/mootools-core.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/mootools-more.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/core.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/modal.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/caption.js']);

//unset($scripts[JUri::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
//unset($scripts[JUri::root(true) . '/media/jui/js/jquery-migrate.min.js']);

$headData['scripts'] = $scripts;

$doc->setHeadData($headData);
// JS
// if load jquery from template, remove jquery from Joomla
if ($this->params->get('jquery_from_template', 0) == 1) {
    $doc->addScript($tpath . '/js/jquery-3.3.1.min.js');
    unset($scripts[JUri::root(true) . '/media/jui/js/jquery.min.js']);
}

if ($defaultmode == 'bootstrap') {
    // if load bootstrap from template
    $doc->addScript($tpath . '/js/bootstrap.bundle.min.js');
}
$doc->addScript($tpath . '/js/main.js');
$doc->addScript($tpath . '/js/fontawesome.min.js');
// CSS
$doc->addStyleSheet($this->baseurl . '/media/jui/css/icomoon.css');
if ($defaultmode == 'bootstrap') {
    $doc->addStyleSheet(JUri::root(true) . '/media/vendor/bootstrap/css/bootstrap.min.css');

}
// if load fontawesome from template
if ($params->get('fontawesome_from_template', 0) == 1) {
    $doc->addStyleSheet($tpath . '/css/all.min.css');
}
// load animate css from template
if ($params->get('animate_css_from_template', 0) == 1) {
    $doc->addStyleSheet($tpath . '/css/animate.css');
}
$doc->addStyleSheet($tpath . '/css/template.css');
// check if custom.css exists
if (file_exists($tpath . '/css/custom.css')) {
    $doc->addStyleSheet($tpath . '/css/custom.css');
}
// check if responsive.css exists
if (file_exists($tpath . '/css/responsive.css')) {
    $doc->addStyleSheet($tpath . '/css/responsive.css');
}
if ($defaultmode == 'bootstrap') {
    $default_column = $template->params->get('default_column', 'col-md-');
    $col_side_boot_width = ' ' . $default_column . $col_side;
    // Default width - for one column
    $col_middle_boot_width = ' ' . $default_column . '12';
    if (($this->countModules('left')) and ($this->countModules('right'))) {
        $col_middle_boot_width = ' ' . $default_column . (12 - (2 * $col_side));
    }
    if ((($this->countModules('left')) and !($this->countModules('right'))) or (!($this->countModules('left')) and ($this->countModules('right')))) {
        $col_middle_boot_width = ' ' . $default_column . (12 - $col_side);
    }
}
function positions($position, $style)
{
    $app = Factory::getApplication('site');
    $template = $app->getTemplate(true);
    $default_column = $template->params->get('default_column ', 'col-md-');
    // Default width - for one column
    $col_middle_boot_width = $default_column . '12';
    // This gets new value, if there is more than one active position
    // For Bootstrap use
    if ($defaultmode == "bootstrap") {
        $width = $default_column . '12';
    }
    // For Custom width use
    if ($defaultmode == "custom") {
        $width = "100";
    }
    // Number of positions, which have modules
    $countOfActivePositions = 0;
    // Positions to search modules in
    // Loop over every position
    $totalWidth = 0;
    foreach ($position as $name => $value) {
        // If position has modules
        if (Factory::getDocument()->countModules($name)) {
            // Increase active positions count
            $countOfActivePositions++;
            $totalWidth = $totalWidth + $value;
        }
    }
    if ($countOfActivePositions > 0) {
        // For Bootstrap with equal widths use
        if ((Factory::getDocument()->params->get('type_of_layout') == "bootstrap") and (Factory::getDocument()->params->get('proportional_equal') == "equal")) {
            $width = $default_column . (12 / $countOfActivePositions);
        }
        // For Custom with equal widths use
        if ((Factory::getDocument()->params->get('type_of_layout') == "custom") and (Factory::getDocument()->params->get('proportional_equal') == "equal")) {
            $width = (100 / $countOfActivePositions);
        }
    }
    foreach ($position as $name => $value) {
        if ($totalWidth < 100) {
            // For Bootstrap remove / comment the $width bellow
            // For custom with equal widths add / uncomment the $width bellow
            // For custom with proportional widths add / uncomment the $width bellow
            if ((Factory::getDocument()->params->get('type_of_layout') == "custom") and (Factory::getDocument()->params->get('proportional_equal') == "proportional")) {
                $width = round($value * 100 / $totalWidth);
            }
            // For Bootstrap with proportional widths add / uncomment the $width bellow
            // For Bootstrap with equal widths remove / comment the $width bellow
            if ((Factory::getDocument()->params->get('type_of_layout') == "bootstrap") and (Factory::getDocument()->params->get('proportional_equal') == "proportional")) {
                $width = $default_column . round($value * 12 / $totalWidth);
            }
            if ((Factory::getDocument()->params->get('type_of_layout') == "custom") and (Factory::getDocument()->params->get('proportional_equal') == "equal")) {
                // For Bootstrap with proportional widths remove / comment the IF bellow
                // For Custom with with more then 1 position add / uncomment the IF bellow
                if (($value > 0) and ($countOfActivePositions == 2) and (count($position) > 2)) {
                    $width = 100 / 2;
                }
                // For Bootstrap with proportional widths remove / comment the IF bellow
                // For Custom with with more then 1 position add / uncomment the IF bellow
                if (($value > 0) and ($countOfActivePositions == 3) and (count($position) > 3)) {
                    $width = 100 / 3;
                }
                // For Bootstrap with proportional widths remove / comment the IF bellow
                // For Custom with with more then 1 position add / uncomment the IF bellow
                if (($value > 0) and ($countOfActivePositions == 4) and (count($position) > 4)) {
                    $width = 100 / 4;
                }
            }
        }
        if (Factory::getDocument()->countModules($name)) {
            // For Bootstrap use
            if (Factory::getDocument()->params->get('type_of_layout') == "bootstrap") {
                echo '<div class="' . $name . ' ' . $width . '"><jdoc:include type="modules" name="' . $name . '" style="' . $style . '" /></div>';
            }
            // For Custom Width use
            if (Factory::getDocument()->params->get('type_of_layout') == "custom") {
                echo '<div class="' . $name . ' ' . '" style="float:left; width:' . $width . '%"><jdoc:include type="modules" name="' . $name . '" style="' . $style . '" /></div>';
            }
        }
    }
}
// For Bootstrap use the grid divisions by 12 in the width keys like this: 1,2,3,4,5,6,7,8,9,10,11
// Then use the code like this bellow
// echo positions(array('menu' => 4, 'login' => 6, 'nada' => 2), 'block');
// If You wish to use with equal widths FOREVER use the code like this bellow
// echo positions(array('menu', 'login', 'nada'), 'block');
// If You wish to use with custom percentages use the code like this bellow
// echo positions(array('menu' => 60, 'login' => 20, 'nada' => 20), 'block');
