<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/20/2017
 * Time: 1:42 PM
 */
require '../class/Vector.php';


$vector = new vector();
//ponits
//$v1 = new vector();
//$v2 = new vector();
//$v3 = new vector();
//$v1->setCordinate(0, 0, 0);
//$v2->setCordinate(2, 5, -4);
//$v3->setCordinate(-2, -3, -5);
////var_dump($vector->dotVec($v2, $v3));
////$vector->subVec($v3, $v1);
////var_dump($vector->len());
////var_dump($vector);
//$v2->setCordinate(5, -1, 3);
//$v3->setCordinate(-7, 1, 3);
//
//
//var_dump($vector->arcsin($v2, $v3));
//var_dump($vector->angleXY($v2, $v3));


//ponits
$p1 = new Vector();
$p2 = new Vector();
$p3 = new Vector();
$p4 = new Vector();
$p5 = new Vector();
$p1->setCordinate(0, 0, 0);
$p2->setCordinate(-1.88114936521211, 0, 0);
$p3->setCordinate(-1.81251282750396, 1.87989620576911, 0);

$p4->setCordinate(-0.0686288761446934, 1.74755070684581, 0.69286633145835);
//$p4->setCordinate(-1.04800869543995, 2.61055262047298, -1.2241118176952);

var_dump($p1);
var_dump($p2);
var_dump($p3);
var_dump($p4);
//var_dump($p5);

//Vectors
$ve1 = new Vector();
$ve2 = new Vector();
$ve3 = new Vector();
$ve4 = new Vector();
$ve1->subVec($p2, $p1);
$ve2->subVec($p3, $p2);
$ve3->subVec($p4, $p3);
//$ve4->subVec($p5, $p4);

var_dump($ve1->len());
var_dump($ve2->len());
var_dump($ve3->len());
//var_dump($ve4->len());

var_dump($vector->angleXY($ve1, $ve2));
var_dump($vector->angleXY($ve2, $ve3));
//var_dump($vector->angleXY($ve3, $ve4));


var_dump($vector->angleXYZ($ve1, $ve2, $ve3));
//var_dump($vector->angleXYZ($ve2, $ve3, $ve4));




