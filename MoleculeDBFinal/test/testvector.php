<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 22/02/2017
 * Time: 10:23 AM
 */

require 'Vec.php';


$v1 = new Vec(-1.90445, 0,0);
$v2 = new Vec(-2.3151, 1.8596, 0);
$v3 = new Vec();
$ang = $v3->arccos($v1, $v2);
echo $v3->len() . '<br/>';
echo $ang;


//$v3->crossVec($v1, $v2);
//
//
////$v3->addVec($v1, $v2);
////$ans = $v3->arccos($v1, $v2);
////echo $ans . '</br>';
////echo acos((float)0.5) * (180 / M_PI);
//echo $v3->getX();
//echo $v3->getY();
//echo $v3->getZ();
////$v1->add($v2->getX(), $v2->getY(), $v2->getZ());
////$k = $call->add($v1, $v2);
////echo $k->getY();
?>