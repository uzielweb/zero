<?php
// variables
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
$app = Factory::getApplication();
$doc = $app->getDocument();
$template = $app->getTemplate(true);
$headData = $doc->getHeadData();
$templateParams = $template->params;
$customHeaderTop = JHTML::_('content.prepare', $templateParams->get('custom_header_top'));
$customHeaderBottom = JHTML::_('content.prepare', $templateParams->get('custom_header_bottom'));
$customLogoLink = $templateParams->get('custom_logo_link', '');
$custom_body_background = $templateParams->get('custom_body_background', '') ? 'background-image: url(' . Uri::base('true') . '/' . $templateParams->get('custom_body_background', '') . ');' : '';
$custom_body_background_color = $templateParams->get('custom_body_background_color', '') ? 'background-color: ' . $templateParams->get('custom_body_background_color', '') . ';' : '';

$tpath = $this->baseurl . '/templates/' . $this->template;
$logo = $templateParams->get('logo', '');
$logosize = $logo ? getimagesize(Uri::base('true').'/' . $logo) : '';
$logowidth = $logosize ? $logosize[0] : '';
$logoheight = $logosize ? $logosize[1] : '';
$favicon = $templateParams->get('favicon', '');
$type_of_layout = $templateParams->get('type_of_layout', 'custom');
$default_column = $templateParams->get('default_column', 'col-lg');
$proportional_equal = $templateParams->get('proportional_equal', 'equal');
$col_side = $templateParams->get('col_side', '-3');
$animate_css_from_template = $templateParams->get('animate_css_from_template', '1');
$fontawesome = $templateParams->get('fontawesome', 'css_from_template');
$jquery_from_template = $templateParams->get('jquery_from_template', '1');
$bootstrap_from_template = $templateParams->get('bootstrap_from_template', '1');
$default_image_for_article = $templateParams->get('default_image_for_article', '');
$default_image_for_category = $templateParams->get('default_image_for_category', '');
$fluid = $templateParams->get('-fluid', '');
$sections = $templateParams->get('sections', '');
$customheadercode = $templateParams->get('customheadercode', '');
$customafterbodycode = $templateParams->get('customafterbodycode', '');
$customfootercode = $templateParams->get('customfootercode', '');
$customcss = $templateParams->get('customcss', '');
$customcss .= $custom_body_background || $custom_body_background_color ? 'body{' . $custom_body_background . $custom_body_background_color . '}' : '';

$opengraph_enabled = $templateParams->get('opengraph_enabled', '1');
$default_opengraph_image = $templateParams->get('default_opengraph_image', '');
$view = $app->input->get('view');
$layout = $app->input->get('layout');
$task = $app->input->get('task');
$itemid = $app->input->get('Itemid');
$option = $app->input->get('option');
$pageclass = $app->input->get('pageclass_sfx');
$active = $app->getMenu()->getActive();
$ishome = ($active == $app->getMenu()->getDefault()) ? 'is-home-page' : 'internal-page';
$language = Factory::getLanguage();
$langtag = $language->getTag();
$bodyClass = $ishome . ' language-'.$this->language. ' option-' . str_replace('com_', '', $option) . ' view-' . $view . ' layout-' . ($layout ? $layout : 'default') . ' task-' . ($task ? $task : 'default') . ' itemid-' . $itemid . $pageclass;
$sitename = $app->get('sitename');
$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0, maximum-scale=6.0, user-scalable=1');
if (file_exists(JPATH_THEMES . '/' . $this->template . '/js/jquery.min.js') && $jquery_from_template == 1) {
    $doc->addScript($tpath . '/js/jquery.min.js');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/css/bootstrap.min.css') && $bootstrap_from_template == 1 && $type_of_layout == 'bootstrap') {
    $doc->addStyleSheet($tpath . '/css/bootstrap.min.css');
    $doc->addScript($tpath . '/js/bootstrap.bundle.min.js');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/css/all.min.css') && $fontawesome == 'css_from_template') {
    $doc->addStyleSheet($tpath . '/css/all.min.css');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/js/all.min.js') && $fontawesome == 'js_from_template') {
    $doc->addStyleSheet($tpath . '/js/all.min.js');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/css/animate.min.css') && $animate_css_from_template == 1) {
    $doc->addStyleSheet($tpath . '/css/animate.min.css');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/css/template.css')) {
    $doc->addStyleSheet($tpath . '/css/template.css');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/css/custom.css')) {
    $doc->addStyleSheet($tpath . '/css/custom.css');
}

if (file_exists(JPATH_THEMES . '/' . $this->template . '/js/template.js')) {
    $doc->addScript($tpath . '/js/template.js');
}
if (file_exists(JPATH_THEMES . '/' . $this->template . '/js/custom.js')) {
    $doc->addScript($tpath . '/js/custom.js');
}
if ($customcss) {
    $doc->addStyleDeclaration($customcss);
}
if ($opengraph_enabled == 1) {
    $doc->setMetaData('og:title', $doc->getTitle());
    $doc->setMetaData('og:type', 'website');
    $doc->setMetaData('og:url', Uri::current());
    $doc->setMetaData('og:site_name', $app->get('sitename'));
    $doc->setMetaData('og:description', $doc->getDescription());
    // twitter cards
    $doc->setMetaData('twitter:card', 'summary');
    $doc->setMetaData('twitter:site', $app->get('sitename'));
    $doc->setMetaData('twitter:title', $doc->getTitle());
    $doc->setMetaData('twitter:description', $doc->getDescription());
    $doc->setMetaData('twitter:creator', $app->get('sitename'));
    if ($default_opengraph_image) {
        $doc->setMetaData('og:image', Uri::base('true') . $default_opengraph_image);
        $doc->setMetaData('twitter:image', Uri::base('true') . $default_opengraph_image);
    }
    // check if view is article or category
    if ($view == 'article') {
        $doc->setMetaData('og:image', Uri::base('true') . $default_image_for_article);
        $doc->setMetaData('twitter:image', Uri::base('true') . $default_image_for_article);
        $article_id = $app->input->get('id');
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('images')));
        $query->from($db->quoteName('#__content'));
        $query->where($db->quoteName('id') . ' = ' . $db->quote($article_id));
        $db->setQuery($query);
        $result = $db->loadObject();
        $images = json_decode($result->images);
        // check image intro, fulltext, or in article content and choose one of them
        if ($images->image_intro) {
            $doc->setMetaData('og:image', Uri::base('true') . $images->image_intro);
            $doc->setMetaData('twitter:image', Uri::base('true') . $images->image_intro);
        } elseif ($images->image_fulltext) {
            $doc->setMetaData('og:image', Uri::base('true') . $images->image_fulltext);
            $doc->setMetaData('twitter:image', Uri::base('true') . $images->image_fulltext);
        } else {
            $article = JTable::getInstance('content');
            $article->load($article_id);
            $content = $article->introtext . $article->fulltext;
            $regex = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
            preg_match($regex, $content, $matches);
            if (isset($matches[1])) {
                $doc->setMetaData('og:image', $matches[1]);
                $doc->setMetaData('twitter:image', $matches[1]);
            }
        }
    }
    if ($option = 'com_content' && $view == 'category') {
        $doc->setMetaData('og:image', Uri::base('true') . $default_image_for_category);
        $doc->setMetaData('twitter:image', Uri::base('true') . $default_image_for_category);
        $category_id = $app->input->get('id');
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('params')));
        $query->from($db->quoteName('#__categories'));
        $query->where($db->quoteName('id') . ' = ' . $db->quote($category_id));
        $db->setQuery($query);
        $result = $db->loadObject();
        $category_params = json_decode($result->params);
        if ($category_params->image) {
            $doc->setMetaData('og:image', Uri::base('true') . $category_params->image);
            $doc->setMetaData('twitter:image', Uri::base('true') . $category_params->image);
        }
    }
}
if ($favicon) {
    $doc->addFavicon(Uri::base('true'). '/'. $favicon);
}
// remove generator
$this->setGenerator(null);

//Sections Custom StyleSheet. Please configure in Joomla Template Administration as you need
$sections = $template->params->get('sections', '');
if ($sections) {
    foreach ($sections as $skey => $item) {
        //$item->section;
        //$item->section_background;
        //$item->section_background_color;
        //$item->section_padding;
        //$item->section_margin;
        $item_background = $item->section_background == '' ? '' : 'background-image: url(\'' . Uri::base('true') . $item->section_background . '\');';
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