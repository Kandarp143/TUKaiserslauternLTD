<?php
/**
 * Created by PhpStorm.
 * User: k4tru
 * Date: 6/23/2017
 * Time: 6:54 PM
 */

require_once 'Vec.php';
require_once 'database.php';
require_once 'funcation/othFunc.php';


$pdo = Database::connect();
$db = new Database();
$data = $db->selectRecords('select DISTINCT  master_id from pm_master', null);

foreach ($data as $d) {
//    echo 'ID : ' . $d[0] . '<br/>';
    $returnArray = makeZmatrix($d[0], 'false');
}

