<?php

//require_once '../class/Database.php';
//require_once '../class/enum/Config.php';
//require_once '../class/enum/Sqls.php';
//require_once '../class/mailer/PHPMailerAutoload.php';
//require_once '../function/refFunc.php';
//require 'genFunc.php';

function sendMail($emails, $subject, $message)
{
    date_default_timezone_set('Etc/UTC');
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = Config::mailHost;
    $mail->Port = Config::mailPort;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = Config::mailUsername;
    $mail->Password = Config::mailPassword;
    $mail->setFrom(Config::mailFromAddress, Config::mailFromName);
    if ($emails > 0) {
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }
    } else {
        $mail->addAddress(Config::mailAdmin);
    }
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = Config::mailUsername;
    try {
        $mail->send();
        echo 'Mail Sent';
        return true;
    } catch (Exception $e) {
        echo 'Mail Error' . $e;
        return false;
    }
}

function genMessage($masterId)
{
    $db = new Database();
    $master = $db->selectRecords(Sqls::pm_master_by_master_id, array($masterId));
    $detail = $db->selectRecords(Sqls::pm_datail_by_master_id, array($masterId));
    $sitetypes = $db->selectRecords(Sqls::pm_master_siteType_with_count_by_master_id, array($masterId));

    //string html
    $message = "<html><body>";
    //makeing master body
    $message .= "<p><b>Following molecule has been deleted from database.</b></p>";
    /* Prepare Header */
    $message .= "<p><b>Molecule Header </b></p>
    <table>";
    foreach ($master as $row) {
        $message .= "<tr style='text-align: left'><th>Substance</th><td>" . toSubstanceTitle($row['filename']) . "</td></tr>";
        $message .= "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
        $message .= "<tr style='text-align: left'><th>Reference</th><td>[" . $row['bibtex_key'] . "]</td></tr>";
        $message .= "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
        $message .= "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
        $message .= "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
    }
    $message .= "</table>";

    /* Prepare Detail   */
    $sitetype = null;
    $NSite = null;
    $site = null;
    $cout = 0;
    foreach ($sitetypes as $row) {
        $NSite[$row['site_type']] = $row['nsite'];
    }

    $message .= "<p><b>Molecule Detail</b> </p>";
    foreach ($detail as $row) {
        if ($sitetype != $row['site_type']) {
            $message .= "SiteType" . "&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;" . $row['site_type'] . "<br/>";
            $message .= "NSites" . "&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;" . $NSite[$row['site_type']] . "<br/><br/>";
            $sitetype = $row['site_type'];
            $cout += 1;
        }
        if ($site != $row['site']) {
            $message .= "<br/># " . $row['site'] . "<br/>";
            $site = $row['site'];
        }

        $message .= $row['param'] . "&nbsp;&nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;&nbsp;  " . $row['val'] . "<br/>";
    }

    $message .= "<p><b>Reference</b> </p>";
    $message .= referenceMessage($masterId);


    $message .= "</html></body>";

    return $message;

}

?>