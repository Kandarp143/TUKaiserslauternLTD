<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/21/2017
 * Time: 9:45 AM
 */

require_once '../function/mailFunc.php';
require_once '../function/genFunc.php';
require_once '../class/Database.php';


//sendMail(array('jalpa39@gmail.com', 'k4truefriend@gmail.com'), 'Test Mail', 'Test Message');
$masterId = 12;
$db = new Database();
$message = genMessage($masterId);
$time = timeStamp();

$fileName = $db->selectValue('filename', 'pm_master', 'master_id', $masterId);
sendMail(array('k4truefriend@gmail.com'), 'Alert ! Molecule :' . $fileName . ' has been deleted at (' . $time . ')', $message);