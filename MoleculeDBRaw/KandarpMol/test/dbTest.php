<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/19/2017
 * Time: 8:51 PM
 */

require '../class/Database.php';


echo 'Start Transaction<br/>';
$sql = "INSERT INTO pm_bib (bib_key,bib_type,bib_title,param,value) values(?, ?, ?,?,?)";
$db = new Database();
$db->beginTransaction();
echo 'Insert 1 : ok<br/>';
$param = array(1, 1, 1, 1, 1);
$db->insert($sql, $param);
echo 'Insert 2 : error<br/>';
$param = array(1, 2, 2, 2, 2);
$db->insert($sql, $param);
$db->commitTransaction();

echo 'End Transaction<br/>';


//echo 'Insert Example<br/>';
//$sql = "INSERT INTO pm_bib (bib_key,bib_type,bib_title,param,value) values(?, ?, ?,?,?)";
//$param = array(1, 1, 1, 1, 1);
//$db = new Database();
//Database::connect();
//$db->insert($sql, $param);
//$db->insert($sql, $param);
//$id = $db->insert($sql, $param);
//echo $id;
//Database::connect();
//echo 'Update Example<br/>';
//$sql = "UPDATE pm_bib SET bib_type = ? WHERE bib_key = ?";
//$param = array('Trusha', 1);
//$db->update($sql, $param);
//
////Database::connect();
////echo 'Delete Example<br/>';
////$sql = "DELETE from pm_bib ";
////$param = array();
////$db->delete($sql, $param);
//
//Database::connect();
//echo 'Select Example<br/>';
//$sql = "Select * from pm_bib WHere id=?";
//$param = array(1);
//$result = $db->selectFlag($sql, $param);
//var_dump($result);
//
//Database::connect();
//echo 'Select Val Example<br/>';
//
//$result = $db->selectValue('bib_key', 'pm_bib', 'id', 1);
//var_dump($result);
//if ($db->selectFlag('select * from pm_master WHERE master_id = ?', array('83'))) {
//
//    echo 'eni ma';
//} else {
//    echo 'e';
//}