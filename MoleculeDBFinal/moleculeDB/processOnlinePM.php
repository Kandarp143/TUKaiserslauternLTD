<?php
//going to use session var
session_set_cookie_params(0);
session_start();
require 'database.php';
require_once 'funcation/fileFunc.php';

$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data

$master_id = $_GET['id'];

if (empty($errors)) {
    try {
        /* input pm file string */
        $arr = explode("\n", $_POST['confirmationText']);
        $pmData = parsePMArray($arr);

        $db = new Database();
        $db->beginTransaction();
        /* delete previous records*/
        $db->delete('DELETE FROM pm_detail WHERE master_id = ?', array($master_id));

        /* insert new records*/
        foreach ($pmData as $key => $value) {
            if (strpos($key, "#") === 0 || strpos($key, "SiteType") === 0) {
                if (strpos($key, "SiteType") === 0) {
                    $sitetype = $value;
                }
                if (strpos($key, "#") === 0) {
                    $site = str_replace('#', '', $value);
                }

            } else {
                $param = current(explode("$", $key));
                //inserting data
                $db->insert('INSERT INTO pm_detail (master_id,site_type,site,param,val) values(?, ?, ?,?,?)',
                    array($master_id, trim($sitetype, " "), trim($site, " "), trim($param, " "), trim($value, " ")));
            }
        }

        $db->commitTransaction();

        $data['success'] = true;
        $data['message'] = 'Success!';
        $data['id'] = $master_id;
    } catch (Exception $e) {
        $error = $e;
    }

} else {
    $data['success'] = false;
    $data['errors'] = $errors;
    $data['id'] = $master_id;

}

$_SESSION['processOnlinePM'] = $data;

$url = 'updatemol.php?id=' . $master_id;
if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href= $url> CLICK HERE <a/>");
} else {
    exit(header('location:' . $url));
}
?>