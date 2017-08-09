<?php
require '../database.php';
require_once '../funcation/fileFunc.php';

//getting master id
$id = isset($_GET['id']) ? $_GET['id'] : 0;

//file require fields
$db = new Database();
$filePath = '../' . rootGenPM;
$fileName = $db->selectValue('filename', 'pm_master', 'master_id', $id);
$fileName = $fileName . '.pm';
$actualFile = $filePath . $fileName;
$db = Database::disconnect();

//generating PMFile
genPMFile($id, $filePath, $fileName);

//exsistance check
if (!file_exists($actualFile)) die("I'm sorry, the file doesn't seem to exist. at following location : " . $actualFile);

//popup_ attachment
header("Content-disposition: attachment; filename=" . $fileName);
header("Content-type: text/plain");
readfile($actualFile);

?>