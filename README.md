# zero
Zero Joomla Template - Zero is a simple template with auto-width special positions with only basic css or js
## Zero is for Joomla 3. To see a Joomla 4 better template go to Minimalista Joomla Template https://github.com/uzielweb/minimalista
# Zero

## ADVISE
Included an index.php file with an example of a custom template. Please use the content of this sample to start a template.
PAY ATTENTION on upgrades. Backup forever.

### For Bootstrap
Use the grid divisions by 12 in the width keys like this: 1,2,3,4,5,6,7,8,9,10,11,12

Then use the code like this bellow:

echo positions(array('menu' => 4, 'login' => 6, 'other-position' => 2), 'zero_xhtml');

### For no-bootstrap
If You wish to use with custom percentages use the code like this bellow

echo positions(array('menu' => 60, 'login' => 20, 'other-position' => 20), 'zero_xhtml');
or this
echo positions(array('menu' => 8, 'login' => 2, 'other-position' => 2), 'zero_xhtml');

### For equal positions widths in bootstrap or no-bootstrap modes
If you wish to use with equal widths FOREVER (in bootstrap or custom mode) use the code like this bellow

echo positions(array('menu', 'login', 'other-position'), 'zero_xhtml');

_Note: zero_xhtml is the position style in mod_chrome in system default mode or module chrome layouts overrides. (you can user your own custom style. By default is zero_xhtml in this template)
_


