<?php
// variables
use Joomla\CMS\Factory as Factory;
use Joomla\CMS\Uri\Uri as Uri;
$app = Factory::getApplication();
$doc = $app->getDocument();
$wa = $doc->getWebAssetManager();
$wr = $wa->getRegistry();
$headData = $doc->getHeadData();
$template = $app->getTemplate(true);
$defaultmode = $template->params->get('type_of_layout', 'bootstrap');
$menu = $app->getMenu();
$active = $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;
if ($active != null) {
    $appParams = $app->getParams();
    $menuParams = $active->getParams();
}
$pageclass = $menuParams ? $menuParams->get('pageclass_sfx') : '';
$tpath = Uri::root(true) . 'templates/' . $this->template;
$jinput = Factory::getApplication()->input;
$option = $jinput->get('option');
$view = $jinput->get('view');
$task = $jinput->get('task');
$config = $app->getConfig();
$col_side = $this->params->get('col_side');
$footer_side = $this->params->get('footer_side');
$logo = $this->params->get('logo', '');
$logosize = $logo ? getimagesize(Juri::root() . $logo) : '';
$logowidth = $logosize ? $logosize[0] : '';
$logoheight = $logosize ? $logosize[1] : '';
// check if is set title in page
$show_page_heading = $menuParams->get('show_page_heading');
$sitename = $config->get('sitename');
//  Joomla Language
$lang = $app->getLanguage();
$locale = $lang->get('tag');
$templateParams = $app->getTemplate(true)->params;
$customHeaderCode = $templateParams->get('customheadercode', '');
$customAfterBodyCode = $templateParams->get('customafterbodycode', '');
$customFooterCode = $templateParams->get('customfootercode', '');
$customcss = $templateParams->get('customcss', '');
//  Check if current Joomla page is a homepage
$ishome = $active->home ? 'is-home ' : 'internal-page ';
$col_middle_style = '';
$openGraphEnabled = $templateParams->get('opengraph_enabled', '1');
$defaultOpenGraphImage = JUri::base() . $templateParams->get('default_opengraph_image', '');
// Social Meta Tags for Open Graph, Twitter, Facebook, Pinterest, LinkedIn
// check if the current view is Joomla article and add Open Graph meta tags
if ($openGraphEnabled == '1') {
    echo $defaultOpenGraphImage ? '' : JText::_('TPL_ENABLE_OPEN_GRAPH_IMAGE');
    $doc->setMetaData('og:description', $this->description, 'property');
    $doc->setMetaData('og:url', $this->baseurl, 'property');
    $doc->setMetaData('og:site_name', $sitename, 'property');
    $doc->setMetaData('og:locale', $locale, 'property');
    $doc->setMetaData('og:type', 'website', 'property');
    $doc->setMetaData('og:title', $this->title, 'property');
    $doc->setMetaData('og:image', $defaultOpenGraphImage, 'property');
    if ($option == 'com_content' && $view == 'article') {
        $doc->setMetaData('og:type', 'article', 'property');
        // check if has image_intro, else check if has image_full, else get first image from article, else get default image for articles from template... after set Open Graph meta tags
        $images = json_decode($this->item->images);
        if (isset($images->image_intro) && !empty($images->image_intro)) {
            $image = Uri::root() . $images->image_intro;
        } elseif (isset($images->image_full) && !empty($images->image_full)) {
            $image = Uri::root() . $images->image_full;
        } else {
            preg_match_all('/<img[^>]+>/i', $this->item->introtext . $this->item->fulltext, $result);
            if (isset($result[0][0])) {
                $image = Uri::root() . $result[0][0];
            } else {
                $default_image_for_article = $this->params->get('default_image_for_article');
                if ($default_image_for_article) {
                    $image = Uri::root() . $default_image_for_article;
                }
                // get logo
                else {
                    $image = Uri::root() . $defaultOpenGraphImage;
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
            $image = Uri::root() . $category_image;
        }
        // else if get default image for category from template
        else {
            $default_image_for_category = $this->params->get('default_image_for_category');
            if ($default_image_for_category) {
                $image = Uri::root() . $default_image_for_category;
            }
            // get logo
            else {
                $image = Uri::root() . $defaultOpenGraphImage;
            }
        }
    }
    //
    else {
        $doc->setMetaData('og:type', 'website', 'property');
        $doc->setMetaData('og:image', $defaultOpenGraphImage, 'property');
    }
    // add Twitter meta tags
    $doc->setMetaData('twitter:card', 'summary', 'property');
    $doc->setMetaData('twitter:site', '@' . $sitename, 'property');
    $doc->setMetaData('twitter:title', $this->title, 'property');
    $doc->setMetaData('twitter:description', $this->description, 'property');
    $doc->setMetaData('twitter:image', $defaultOpenGraphImage, 'property');
    $doc->setMetaData('twitter:type', 'website', 'property');
    if ($option == 'com_content' && $view == 'article') {
        $doc->setMetaData('twitter:type', 'article', 'property');
        // check if has image_intro, else check if has image_full, else get first image from article, else get default image for articles from template... after set Open Graph meta tags
        $images = json_decode($this->item->images);
        if (isset($images->image_intro) && !empty($images->image_intro)) {
            $image = Uri::root() . $images->image_intro;
        } elseif (isset($images->image_full) && !empty($images->image_full)) {
            $image = Uri::root() . $images->image_full;
        } else {
            preg_match_all('/<img[^>]+>/i', $this->item->introtext . $this->item->fulltext, $result);
            if (isset($result[0][0])) {
                $image = Uri::root() . $result[0][0];
            } else {
                $default_image_for_article = $this->params->get('default_image_for_article');
                if ($default_image_for_article) {
                    $image = Uri::root() . $default_image_for_article;
                }
                // get logo
                else {
                    $image = Uri::root() . $defaultOpenGraphImage;
                }
            }
        }
        $doc->setMetaData('twitter:image', $image, 'property');
    }
    // check if the current view is Joomla category and add Open Graph meta tags
    elseif ($option == 'com_content' && $view == 'category') {
        $doc->setMetaData('twitter:type', 'article', 'property');
        // get category image
        $category_image = $this->params->get('category_image');
        if ($category_image) {
            $image = Uri::root() . $category_image;
        }
        // else if get default image for category from template
        else {
            $default_image_for_category = $this->params->get('default_image_for_category');
            if ($default_image_for_category) {
                $image = Uri::root() . $default_image_for_category;
            }
            // get logo
            else {
                $image = Uri::root() . $defaultOpenGraphImage;
            }
        }
    }
    //
    else {
        $doc->setMetaData('twitter:type', 'website', 'property');
        $doc->setMetaData('twitter:image', $defaultOpenGraphImage, 'property');
    }
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
        $item_background = $item->section_background == '' ? '' : 'background-image: url(\'' . Uri::root() . $item->section_background . '\');';
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
$this->addFavicon(Uri::root(true) . '/' . $template->params->get('favicon'), $tpath . 'images/favicon.ico');

if ($defaultmode == 'bootstrap') {
    // if load bootstrap from template
    if ($this->params->get('bootstrap_from_template', '0') == '1') {
        // disable Joomla 4 bootstrap
        $wa->disableScript('bootstrap.es5');

        // load bootstrap from template

        $wa->registerAndUseStyle('cssbootstrapFromTemplate', $tpath . '/css/bootstrap.min.css');
        $wa->registerAndUseScript('jsbootstrapFromTemplate', $tpath . '/js/bootstrap.bundle.min.js');

    } else {
        // bootstrap.framework from Joomla
        $wa->registerAndUseStyle('joomlaBootstrap', Uri::root(true) . 'media/vendor/bootstrap/css/bootstrap.min.css');
        $wa->useScript('bootstrap.es5');
    }
}

// check if icomoon exist
if (file_exists(JPATH_ROOT . '/media/jui/css/icomoon.css')) {
    $wa->registerAndUseStyle('icomoon', Uri::root(true) . 'media/jui/css/icomoon.css');
}
// if load fontawesome from template
if ($templateParams->get('fontawesome', 'css_from_template') == 'css_from_template') {
    $wa->registerAndUseStyle('fontawesome', $tpath . '/css/all.min.css');
} elseif ($templateParams->get('fontawesome', 'css_from_template') == 'js_from_template') {
    $wa->registerAndUseScript('fontawesome.js', $tpath . '/js/all.min.js');
} elseif ($templateParams->get('fontawesome', 'css_from_template') == 'from_joomla') {
    $wa->useStyle('fontawesome');

}
// JS
// if load jquery from template, remove jquery from Joomla
if ($this->params->get('jquery_from_template', '1') == '1') {
    $wa->disableScript('jquery');
    $wa->disableScript('jquery-migrate');

    $wa->registerAndUseScript('templatejquery', $tpath . '/js/jquery-3.6.0.min.js');
    $wa->registerAndUseScript('templatejquery-migrate', $tpath . '/js/jquery-migrate-3.4.0.min.js');

}

// $tpath . '/js/main.js'
$wa->registerAndUseScript('main', $tpath . '/js/main.js');

// load icomoon.css $tpath . '/css/icomoon.css'
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/icomoon.css')) {
    $wa->registerAndUseStyle('icomoon', Uri::root(true) . 'templates/' . $this->template . '/css/icomoon.css');
}
// load animate css from template $tpath . '/css/animate.min.css'
if ($templateParams->get('animate_css_from_template', '1') == '1') {
    $wa->registerAndUseStyle('animate', $tpath . '/css/animate.min.css');
}
$templatecsstime = date('dmYHis', filemtime($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/template.css'));
// $tpath . '/css/template.css?' . $templatecsstime
$wa->registerAndUseStyle('template', Uri::root(true) . 'templates/' . $this->template . '/css/template.css?' . $templatecsstime);

// check if custom.css exists $tpath . '/css/custom.css?' . $customcsstime
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/custom.css')) {
    $customcsstime = date('dmYHis', filemtime($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/custom.css'));
    $wa->registerAndUseStyle('custom', Uri::root(true) . 'templates/' . $this->template . '/css/custom.css?' . $customcsstime);

}

// check if responsive.css exists
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/responsive.css')) {
    $responsivecsstime = date('dmYHis', filemtime($_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template . '/css/responsive.css'));
    $wa->registerAndUseStyle('responsive', Uri::root(true) . 'templates/' . $this->template . '/css/responsive.css?' . $responsivecsstime);
}

if ($defaultmode == 'bootstrap') {
    $default_column = $template->params->get('default_column', 'col-md');
    $col_side_boot_width = ' ' . $default_column . $col_side;
    $col_side_style = '';
    // Default width - for one column
    $col_middle_boot_width = ' ' . $default_column . '12';
    if (($this->countModules('left')) and ($this->countModules('right'))) {
        $col_middle_boot_width = ' ' . $default_column . (12 - (2 * $col_side));
    }
    if ((($this->countModules('left')) and !($this->countModules('right'))) or (!($this->countModules('left')) and ($this->countModules('right')))) {
        $col_middle_boot_width = ' ' . $default_column . (12 - $col_side);
    }
}
if ($defaultmode == 'custom') {
    $default_column = '';
    $col_side_boot_width = '';
    $col_side_style = ' style="width: ' . (100 / 12 * $col_side) . '%"';
    // Default width - for one column
    $col_middle_boot_width = ' ' . $default_column . '12';
    if (($this->countModules('left')) and ($this->countModules('right'))) {
        $col_middle_style = ' style="width: ' . (100 / 12 * 2 * $col_side) . '%"';
    }
    if ((($this->countModules('left')) and !($this->countModules('right'))) or (!($this->countModules('left')) and ($this->countModules('right')))) {
        $col_middle_style = ' style="width: ' . (100 / 12 * (12 - $col_side)) . '%"';
    }
}
function positions($position, $style)
{
    $app = Factory::getApplication('site');
    $template = $app->getTemplate(true);
    $defaultmode = $template->params->get('default_mode', 'bootstrap');
    $default_column = $template->params->get('default_column ', 'col-lg-');
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
                echo '<div class="' . $name . ' ' . '" style="width:' . $width . '%"><jdoc:include type="modules" name="' . $name . '" style="' . $style . '" /></div>';
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
