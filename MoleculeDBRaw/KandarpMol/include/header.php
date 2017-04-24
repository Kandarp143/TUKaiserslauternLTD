<?php
session_set_cookie_params(0);
session_start();
//var_dump($_SESSION);

//addming all requried class and funcation
/* all classes*/
require_once 'class/Database.php';
require_once 'class/Vector.php';
require_once 'class/enum/Config.php';
require_once 'class/enum/Sqls.php';
require_once 'class/mailer/PHPMailerAutoload.php';

/* all funcation*/

require_once 'function/genFunc.php';
require_once 'function/refFunc.php';
require_once 'function/mailFunc.php';
require_once 'function/molFunc.php';
?>
<!DOCTYPE html>
<!-- Design by Kandarp -->
