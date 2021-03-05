<?php
// variables
$app              = JFactory::getApplication();
$doc              = JFactory::getDocument();
$menu             = $app->getMenu();
$active           = $app->getMenu()->getActive();
$params           = $app->getParams();
$pageclass        = $params->get('pageclass_sfx');
$tpath            = $this->baseurl . '/templates/' . $this->template;
$jinput           = JFactory::getApplication()->input;
$option           = $jinput->get('option');
$view             = $jinput->get('view');
$task             = $jinput->get('task');
$config           = JFactory::getConfig();
$col_side         = $this->params->get('col_side');
$footer_side      = $this->params->get('footer_side');
$logo             = $this->params->get('logo');
$col_middle_style = '';
$app              = JFactory::getApplication('site');
$template         = $app->getTemplate(true);
//Sections Custom StyleSheet. Please configure in Joomla Template Administration as you need
$sections = $template->params->get('sections');
foreach($sections as $skey=>$item){ 
  //$item->section;
  //$item->section_background;
  //$item->section_background_color;
  //$item->section_padding;
  //$item->section_margin;
  $item_background = $item->section_background == '' ? '' : 'background-image: url(\''.JUri::root().$item->section_background.'\');';
  $item_background_color = $item->section_background_color == '' ? '' : 'background-color: '.$item->section_background_color.';';
  $item_padding = $item->section_padding == '' ? '' : 'padding: '.$item->section_padding.';';
  $item_margin = $item->section_margin == '' ? '' : 'margin: '.$item->section_margin.';';
  $doc->addStyleDeclaration('
      #zero-'.$item->section.'{'
      .$item_background
      .$item_background_color
      .$item_padding
      .$item_margin.'
  }
  ');
}
// generator tag
$this->setGenerator(null);
//custom favicon
$this->addFavicon($this->baseurl . '/' . $template->params->get('favicon'), $tpath.'images/favicon.ico');
// loading default bootstrap and jquery from Joomla to apply changes
JHtml::_('bootstrap.framework');
JHtml::_('jquery.framework');
//unset scripts
$headData = $doc->getHeadData();
$scripts  = $headData['scripts'];
//scripts to remove, customise as required like mootools-core.js, mootools-more.js, jquery.min.js,jquery-noconflict.js,bootstrap.min.js,jquery-migrate.min.js
//unset($scripts[JUri::root(true) . '/media/system/js/mootools-core.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/mootools-more.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/core.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/modal.js']);
//unset($scripts[JUri::root(true) . '/media/system/js/caption.js']);
//unset($scripts[JUri::root(true) . '/media/jui/js/jquery.min.js']);
//unset($scripts[JUri::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
//unset($scripts[JUri::root(true) . '/media/jui/js/jquery-migrate.min.js']);
$headData['scripts'] = $scripts;
$doc->setHeadData($headData);
// JS
//$doc->addScript($tpath.'/js/jquery-3.3.1.min.js');
//$doc->addScript($tpath . '/js/popper.min.js');
//$doc->addScript($tpath . '/js/bootstrap.min.js');
//$doc->addScript($tpath . '/js/bootstrap.bundle.min.js');
$doc->addScript($tpath . '/js/main.js');
//$doc->addScript($tpath.'/js/fontawesome.min.js');
//file modification time 
$templatecsstime = date('dmYHis',filemtime($_SERVER['DOCUMENT_ROOT'].'/templates/'.$this->template.'/css/template.css'));
$customcsstime = date('dmYHis',filemtime($_SERVER['DOCUMENT_ROOT'].'/templates/'.$this->template.'/css/custom.css'));
$responsivecsstime = date('dmYHis',filemtime($_SERVER['DOCUMENT_ROOT'].'/templates/'.$this->template.'/css/responsive.css'));
// CSS
$doc->addStyleSheet($this->baseurl . '/media/jui/css/icomoon.css');
//$doc->addStyleSheet($tpath . '/css/bootstrap.css');
//$doc->addStyleSheet($tpath . '/css/fontawesome.css');
//$doc->addStyleSheet($tpath . '/css/animate.css');
$doc->addStyleSheet($tpath . '/css/template.css?v='.$templatecsstime);
//$doc->addStyleSheet($tpath . '/css/custom.css?v='.$customcsstime);
//$doc->addStyleSheet($tpath . '/css/responsive.css?v='.$responsivecsstime);
if ($template->params->get('type_of_layout') == 'bootstrap') {
    $default_column = $template->params->get('default_column', 'col-md-');
    $col_side_boot_width   = ' ' . $default_column . $col_side;
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
        $app      = JFactory::getApplication('site');
        $template = $app->getTemplate(true);
        $default_column   = $template->params->get('default_column ','col-md-');
        // Default width - for one column
        $col_middle_boot_width = $default_column . '12';
        // This gets new value, if there is more than one active position
        // For Bootstrap use
        if (JFactory::getDocument()->params->get('type_of_layout') == "bootstrap") {
            $width = $default_column . '12';
        }
        // For Custom width use
        if (JFactory::getDocument()->params->get('type_of_layout') == "custom") {
            $width = "100";
        }
        // Number of positions, which have modules
        $countOfActivePositions = 0;
        // Positions to search modules in
        // Loop over every position
        $totalWidth             = 0;
        foreach ($position as $name => $value) {
            // If position has modules
            if (JFactory::getDocument()->countModules($name)) {
                // Increase active positions count
                $countOfActivePositions++;
                $totalWidth = $totalWidth + $value;
            }
        }
        if ($countOfActivePositions > 0) {
            // For Bootstrap with equal widths use
            if ((JFactory::getDocument()->params->get('type_of_layout') == "bootstrap") and (JFactory::getDocument()->params->get('proportional_equal') == "equal")) {
                $width = $default_column . (12 / $countOfActivePositions);
            }
            // For Custom with equal widths use
            if ((JFactory::getDocument()->params->get('type_of_layout') == "custom") and (JFactory::getDocument()->params->get('proportional_equal') == "equal")) {
                $width = (100 / $countOfActivePositions);
            }
        }
        foreach ($position as $name => $value) {
            if ($totalWidth < 100) {
                // For Bootstrap remove / comment the $width bellow
                // For custom with equal widths add / uncomment the $width bellow
                // For custom with proportional widths add / uncomment the $width bellow
                if ((JFactory::getDocument()->params->get('type_of_layout') == "custom") and (JFactory::getDocument()->params->get('proportional_equal') == "proportional")) {
                    $width = round($value * 100 / $totalWidth);
                }
                // For Bootstrap with proportional widths add / uncomment the $width bellow
                // For Bootstrap with equal widths remove / comment the $width bellow
                if ((JFactory::getDocument()->params->get('type_of_layout') == "bootstrap") and (JFactory::getDocument()->params->get('proportional_equal') == "proportional")) {
                    $width = $default_column . round($value * 12 / $totalWidth);
                }
                if ((JFactory::getDocument()->params->get('type_of_layout') == "custom") and (JFactory::getDocument()->params->get('proportional_equal') == "equal")) {
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
            if (JFactory::getDocument()->countModules($name)) {
                // For Bootstrap use
                if (JFactory::getDocument()->params->get('type_of_layout') == "bootstrap") {
                    echo '<div class="' . $name . ' ' . $width . '"><jdoc:include type="modules" name="' . $name . '" style="' . $style . '" /></div>';
                }
                // For Custom Width use
                if (JFactory::getDocument()->params->get('type_of_layout') == "custom") {
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