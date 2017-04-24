<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/22/2017
 * Time: 10:55 AM
 */
/* first include all required class and funcations*/
require_once 'requriedInc.php';

session_start(); // Starting Session
// check posted by submit button
if (isset($_POST['login-submit'])) {
    // check user-id and password posted
    if (isset($_POST['inputUser']) && isset($_POST['inputPassword'])) {
        //store to var
        $usr = $_POST['inputUser'];
        $pass = $_POST['inputPassword'];
        //db thing
        $db = new Database();
        $record = $db->selectRecords(Sqls::user_acc_by_userId_and_pass, array($usr, $pass));
        if (!empty($record)) {
            $_SESSION['usr'] = $usr;
            $_SESSION['usr_acc'] = $record[0]['usr_role'];
            //admin access
            $_SESSION['act'] = 'false';
            if ($_SESSION['usr_acc'] == 'SYS') {
                $_SESSION['act'] = 'true';
            }
//             redirect home page.
            header("location: ../welcome.php");
            die();
        } else {
            //back to login
            $_SESSION['err'] = 'Invalid user Id  or password. Please try again !';
            header('location: ../index.php?err=true');
            die();
        }

    } else {
        //back to login
        header('location: ../index.php?err=true');
        die();
    }
}