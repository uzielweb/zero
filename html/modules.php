<?php
/**
* @package     Joomla.Site
* @subpackage  Template.system
*
* @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;
/*
* none (output raw module content)
*/
function module_widths(){
}
function modChrome_zero_none($module, &$params, &$attribs)
{
$app =JFactory::getApplication('site');
$template = $app->getTemplate(true);
$col_bootversion = 'col-md';
if ($template->params->get('type_of_layout') == 'bootstrap') {
$bootstrap_version = $template->params->get('bootstrap_version');
if ($bootstrap_version == '2'){
$col_bootversion = 'span-';
}
if ($bootstrap_version == '3'){
$col_bootversion = 'col-md-';
}
if ($bootstrap_version == '4'){
$col_bootversion = 'col-md-';
}
}
$moduleTag      = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
$moduleClass    = $bootstrapSize !== 0 ? ' '. $col_bootversion . $bootstrapSize : '';
if ($template->params->get('type_of_layout') == 'custom') {
$col_module_width = ' style="float:left; width:'.(100/12*$bootstrapSize).'%;"';
}
else{
$col_module_width = '';
}
// Temporarily store header class in variable
$headerClass    = $params->get('header_class');
$headerClass    = !empty($headerClass) ? ' class="module-title ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';
if (!empty ($module->content)) : ?>
<<?php echo $moduleTag; ?> class="moduletable<?php echo $module->name." ".$module->name."-".$module->id." ".$module->name."-".$module->position.htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>"<?php echo $col_module_width?>>
<?php if ((bool) $module->showtitle) :?>
<<?php echo $headerTag . $headerClass . '>' . $module->title; ?>
</<?php echo $headerTag; ?>>
<?php endif; ?>
<?php echo $module->content; ?>
</<?php echo $moduleTag; ?>>
<?php endif;
}
/*
* html5 (chosen html5 tag and font header tags)
*/
function modChrome_zero_html5($module, &$params, &$attribs)
{
$app =JFactory::getApplication('site');
$template = $app->getTemplate(true);
$col_bootversion = 'col-md-';
if ($template->params->get('type_of_layout') == 'bootstrap') {
$bootstrap_version = $template->params->get('bootstrap_version');
if ($bootstrap_version == '2'){
$col_bootversion = 'span-';
}
if ($bootstrap_version == '3'){
$col_bootversion = 'col-md-';
}
if ($bootstrap_version == '4'){
$col_bootversion = 'col-md-';
}
}
$moduleTag      = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
$moduleClass    = $bootstrapSize !== 0 ? ' '.$col_bootversion . $bootstrapSize : '';
if ($template->params->get('type_of_layout') == 'custom') {
$col_module_width = ' style="float:left; width:'.(100/12*$bootstrapSize).'%;"';
}
else{
$col_module_width = '';
}
// Temporarily store header class in variable
$headerClass    = $params->get('header_class');
$headerClass    = !empty($headerClass) ? ' class="module-title ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';
if (!empty ($module->content)) : ?>
<<?php echo $moduleTag; ?> class="moduletable<?php echo " module-".$module->name." ".$module->name."-".$module->id." ".$module->name."-".$module->position.htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>"<?php echo $col_module_width?>>
<?php if ((bool) $module->showtitle) :?>
<<?php echo $headerTag . $headerClass . '>' . $module->title; ?>
</<?php echo $headerTag; ?>>
<?php endif; ?>
<?php echo $module->content; ?>
</<?php echo $moduleTag; ?>>
<?php endif;
}
/*
* Module chrome that wraps the module in a table
*/
function modChrome_zero_table($module, &$params, &$attribs)
{
$app =JFactory::getApplication('site');
$template = $app->getTemplate(true);
$col_bootversion = 'col-md-';
if ($template->params->get('type_of_layout') == 'bootstrap') {
$bootstrap_version = $template->params->get('bootstrap_version');
if ($bootstrap_version == '2'){
$col_bootversion = 'span-';
}
if ($bootstrap_version == '3'){
$col_bootversion = 'col-md-';
}
if ($bootstrap_version == '4'){
$col_bootversion = 'col-md-';
}
}
$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
$moduleClass    = $bootstrapSize !== 0 ? ' '.$col_bootversion . $bootstrapSize : '';
if ($template->params->get('type_of_layout') == 'custom') {
$col_module_width = ' style="float:left; width:'.(100/12*$bootstrapSize).'%;"';
}
else{
$col_module_width = '';
}
if (!empty ($module->content)) :
?>
<table cellpadding="0" cellspacing="0" class="moduletable<?php echo " module-".$module->name." ".$module->name."-".$module->id." ".$module->name."-".$module->position.htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8'); ?><?php echo $moduleClass;?>"<?php echo $col_module_width; ?>>
<?php if ((bool) $module->showtitle) : ?>
<tr>
  <th>
    <?php echo $module->title; ?>
  </th>
</tr>
<?php endif; ?>
<tr>
  <td>
    <?php echo $module->content; ?>
  </td>
</tr>
</table>
<?php  endif;
}
/*
* Module chrome that wraps the tabled module output in a <td> tag of another table
*/
function modChrome_zero_horz($module, &$params, &$attribs)
{
if (!empty ($module->content)) :
?>
<table cellspacing="1" cellpadding="0" width="100%">
  <tr>
    <td>
      <?php modChrome_zero_table($module, $params, $attribs); ?>
    </td>
  </tr>
</table>
<?php endif;
}
/*
* xhtml (divs and font header tags)
* With the new advanced parameter it does the same as the html5 chrome
*/
function modChrome_zero_xhtml($module, &$params, &$attribs)
{
$app =JFactory::getApplication('site');
$template = $app->getTemplate(true);
$col_bootversion = 'col-md-';
if ($template->params->get('type_of_layout') == 'bootstrap') {
$bootstrap_version = $template->params->get('bootstrap_version');
if ($bootstrap_version == '2'){
$col_bootversion = 'span-';
}
if ($bootstrap_version == '3'){
$col_bootversion = 'col-md-';
}
if ($bootstrap_version == '4'){
$col_bootversion = 'col-md-';
}
}
$moduleTag      = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
$moduleClass    = $bootstrapSize !== 0 ? ' '.$col_bootversion . $bootstrapSize : '';
if ($template->params->get('type_of_layout') == 'custom') {
$col_module_width = ' style="float:left; width:'.(100/12*$bootstrapSize).'%;"';
}
else{
$col_module_width = '';
}
// Temporarily store header class in variable
$headerClass    = $params->get('header_class');
$headerClass    = $headerClass ? ' class="module-title ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';
if (!empty ($module->content)) : ?>
<<?php echo $moduleTag; ?> class="moduletable<?php echo " module-".$module->name." ".$module->name."-".$module->id." ".$module->name."-".$module->position.htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>"<?php echo $col_module_width?>>
<?php if ((bool) $module->showtitle) : ?>
<<?php echo $headerTag . $headerClass . '>' . $module->title; ?>
</<?php echo $headerTag; ?>>
<?php endif; ?>
<?php echo $module->content; ?>
</<?php echo $moduleTag; ?>>
<?php endif;
}
/*
* Module chrome that allows for rounded corners by wrapping in nested div tags
*/
function modChrome_zero_rounded($module, &$params, &$attribs)
{
$app =JFactory::getApplication('site');
$template = $app->getTemplate(true);
$col_bootversion = 'col-md-';
if ($template->params->get('type_of_layout') == 'bootstrap') {
$bootstrap_version = $template->params->get('bootstrap_version');
if ($bootstrap_version == '2'){
$col_bootversion = 'span-';
}
if ($bootstrap_version == '3'){
$col_bootversion = 'col-md-';
}
if ($bootstrap_version == '4'){
$col_bootversion = 'col-md-';
}
}
$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
$moduleClass    = $bootstrapSize !== 0 ? ' '.$col_bootversion . $bootstrapSize : '';
if ($template->params->get('type_of_layout') == 'custom') {
$col_module_width = ' style="float:left; width:'.(100/12*$bootstrapSize).'%;"';
}
else{
$col_module_width = '';
}
if (!empty ($module->content)) :
?>
<div class="module<?php echo " module-".$module->name." ".$module->name."-".$module->id." ".$module->name."-".$module->position.htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>"<?php echo $col_module_width; ?>>
<div>
  <div>
    <div>
      <?php if ((bool) $module->showtitle) : ?>
      <h3>
        <?php echo $module->title; ?>
      </h3>
      <?php endif; ?>
      <?php echo $module->content; ?>
    </div>
  </div>
</div>
</div>
<?php  endif;
}
