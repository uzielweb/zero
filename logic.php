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

$siteName = $config->get('sitename');
$col_middle_style = '';
// Social Meta Tags for Open Graph, Twitter, Facebook, Pinterest, LinkedIn

$doc->setMetaData('og:title', $this->title, 'property');
$doc->setMetaData('og:description', $this->description, 'property');
$doc->setMetaData('og:url', $this->baseurl, 'property');

$doc->setMetaData('og:site_name', $sitename, 'property');
$doc->setMetaData('og:locale', $locale, 'property');
$doc->setMetaData('og:type', 'website', 'property');

// check if the current view is Joomla article and add Open Graph meta tags

if ($option == 'com_content' && $view == 'article') {
    $doc->setMetaData('og:type', 'article', 'property');
    // check if has image_intro, else check if has image_full, else get first image from article, else get default image for articles from template... after set Open Graph meta tags
    $images = json_decode($this->item->images);
    if (isset($images->image_intro) && !empty($images->image_intro)) {
        $image = JUri::root() . $images->image_intro;
    } elseif (isset($images->image_full) && !empty($images->image_full)) {
        $image = JUri::root() . $images->image_full;
    } else {
        preg_match_all('/<img[^>]+>/i', $this->item->introtext . $this->item->fulltext, $result);
        if (isset($result[0][0])) {
            $image = JUri::root() . $result[0][0];
        } else {
            $default_image_for_article = $this->params->get('default_image_for_article');
            if ($default_image_for_article) {
                $image = JUri::root() . $default_image_for_article;
            }
            // get logo
            else {
                $image = JUri::root() . $logo;
            }
        }
    }
    $doc->setMetaData('og:image', $image, 'property');

}
// check if the current view is Joomla category and add Open Graph meta tags
elseif ($option == 'com_content' && $view == 'category') {
    $doc->setMetaData('og:type', 'article', 'property');
    // get category image
    $category_image = $this->params->get('category_image');
    if ($category_image) {
        $image = JUri::root() . $category_image;
    }
    // else if get default image for category from template
    else {
        $default_image_for_category = $this->params->get('default_image_for_category');
        if ($default_image_for_category) {
            $image = JUri::root() . $default_image_for_category;
        }
        // get logo
        else {
            $image = JUri::root() . $logo;
        }

    }
}
//
else {
    $doc->setMetaData('og:type', 'website', 'property');
    $doc->setMetaData('og:image', $logo, 'property');
}

// add Twitter meta tags
$doc->setMetaData('twitter:card', 'summary', 'property');
$doc->setMetaData('twitter:title', $this->title, 'property');
$doc->setMetaData('twitter:description', $this->description, 'property');
$doc->setMetaData('twitter:url', $this->baseurl, 'property');
// check if the current view is Joomla article and add Twitter meta tags
if ($option == 'com_content' && $view == 'article') {
    $doc->setMetaData('twitter:type', 'article', 'property');
    // check if has image_intro, else check if has image_full, else get first image from article, else get default image for articles from template... after set Twitter meta tags
    $images = json_decode($this->item->images);
    if (isset($images->image_intro) && !empty($images->image_intro)) {
        $image = JUri::root() . $images->image_intro;
    } elseif (isset($images->image_full) && !empty($images->image_full)) {
        $image = JUri::root() . $images->image_full;
    } else {
        preg_match_all('/<img[^>]+>/i', $this->item->introtext . $this->item->fulltext, $result);
        if (isset($result[0][0])) {
            $image = JUri::root() . $result[0][0];
        } else {
            $default_image_for_article = $this->params->get('default_image_for_article');
            if ($default_image_for_article) {
                $image = JUri::root() . $default_image_for_article;
            }
            // get logo
            else {
                $image = JUri::root() . $logo;
            }
        }
    }
    $doc->setMetaData('twitter:image', $image, 'property');
}
// check if the current view is Joomla category and add Twitter meta tags
elseif ($option == 'com_content' && $view == 'category') {
    $doc->setMetaData('twitter:type', 'article', 'property');
    // get category image
    $category_image = $this->params->get('category_image');
    if ($category_image) {
        $image = JUri::root() . $category_image;
    }
    // else if get default image for category from template
    else {
        $default_image_for_category = $this->params->get('default_image_for_category');
        if ($default_image_for_category) {
            $image = JUri::root() . $default_image_for_category;
        } else {
            $image = JUri::root() . $logo;
        }
    }
}
//
else {
    $doc->setMetaData('twitter:type', 'website', 'property');
    $doc->setMetaData('twitter:image', $logo, 'property');
}

// end for social meta tags

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
      #' . $this->template . '-' . $item->section . '{'
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
//unset($scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
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
if ($params->get('fontawesome_js_from_template', 0) == 1) {
    $doc->addScript($tpath . '/js/fontawesome.min.js');
}

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
    $defaultmode = $template->params->get('default_mode', 'bootstrap');
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