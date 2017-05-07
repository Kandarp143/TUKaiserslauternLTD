<?php
//going to use session var
session_set_cookie_params(0);
session_start();
require_once 'database.php';
require_once 'mailer/PHPMailerAutoload.php';
require_once 'funcation/mailFunc.php';
require_once 'funcation/othFunc.php';
require_once 'funcation/fileFunc.php';


$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data

$master_id = $_GET['id'];
/* Validation */
if (!empty($_POST)) {
    if ($_POST['addPass'] != 'admin' || empty($_POST['addPass']))
        $errors['addPassWrong'] = 'Wrong password ! Try again';
} else {
    $errors['post'] = 'Empty form can not submit , Please add additional password ';
}


if (empty($errors)) {
    try {

        $db = new Database();
        $message = genMessageMol($master_id);
        $time = timeStamp();

        $db->beginTransaction();

        $fileName = $db->selectValue('filename', 'pm_master', 'master_id', $master_id);
        /*delete records*/
        $db->delete('DELETE FROM pm_master  WHERE master_id = ?', array($master_id));
        $db->delete('DELETE FROM pm_detail  WHERE master_id = ?', array($master_id));
        /*send mail*/
        sendMail(array('kppatel14392@gmail.com'), 'Alert ! Molecule :' . $fileName . ' has been deleted at (' . $time . ')', $message);

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

$_SESSION['processDelete'] = $data;

$url = 'deletemol.php?id=' . $master_id;
if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href= $url> CLICK HERE <a/>");
} else {
    exit(header('location:' . $url));
}

?>