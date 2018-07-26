# Zero
Zero - Joomla Template - A very basic Joomla Template without any aditional CSS or JS with special positions codes

## HOW TO USE :

### For Bootstrap
Use the grid divisions by 12 in the width keys like this: 1,2,3,4,5,6,7,8,9,10,11,12

Then use the code like this bellow:

echo positions(array('menu' => 4, 'login' => 6, 'other-position' => 2), 'block');

### For no-bootstrap
If You wish to use with custom percentages use the code like this bellow

echo positions(array('menu' => 60, 'login' => 20, 'other-position' => 20), 'block');

### For equal positions widths in bootstrap or no-bootstrap modes
If you wish to use with equal widths FOREVER (in bootstrap or custom mode) use the code like this bellow

echo positions(array('menu', 'login', 'other-position'), 'block');
