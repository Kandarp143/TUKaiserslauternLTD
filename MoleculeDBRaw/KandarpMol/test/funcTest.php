<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/20/2017
 * Time: 12:40 PM
 */

require '../function/genFunc.php';

$substanc = 'R11_CFC44(1)';
echo toSubstanceTitle($substanc) . '<br/>';
$substanc = 'R11_CFC44';

echo toSubstanceTitle($substanc) . '<br/>';
$substanc = 'CFC44(1)';
echo toSubstanceTitle($substanc) . '<br/>';
$substanc = 'C33FC44';
echo toSubstanceTitle($substanc) . '<br/>';