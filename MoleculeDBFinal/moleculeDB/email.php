<?php
$master_id = $_GET['id'];
if ($_POST['addPass'] == 'admin') {
    require_once 'mailer/PHPMailerAutoload.php';
    require_once 'database.php';

    $fileName = '';
    $pdo = Database::connect();
    $masterSql = 'SELECT DISTINCT * FROM pm_master WHERE master_id =' . $master_id;
    $detailSql = 'SELECT * FROM pm_detail WHERE master_id =' . $master_id;
    $sitetypesSql = 'SELECT COUNT(b.site) nsite,b.site_type 
          FROM ( SELECT DISTINCT a.site_type,a.site FROM pm_detail a WHERE a.master_id=' . $master_id . ') b 
          GROUP BY b.site_type';
    $referenceSql = 'SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
          FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key 
          WHERE pm_master.master_id =' . $master_id;

//string html
    $message = "<html><body>";
//makeing master body
    $message .= "<p><b>Following molecule has been deleted from database.</b></p>";
    /* Prepare Header */
    $message .= "<p><b>Molecule Header </b></p>
    <table>";
    foreach ($pdo->query($masterSql) as $row) {
        $fileName = $row['filename'];
        $message .= "<tr style='text-align: left'><th>Substance</th><td>" . $row['filename'] . "</td></tr>";
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
    foreach ($pdo->query($sitetypesSql) as $row) {
        $NSite[$row['site_type']] = $row['nsite'];
    }

    $message .= "<p><b>Molecule Detail</b> </p>";
    foreach ($pdo->query($detailSql) as $row) {
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


    $message .= "</html></body>";

    echo $message;


    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "er.ikndp@gmail.com";
    $mail->Password = "godwithmeking";
    $mail->setFrom("Admin@MoleculeDB", "Admin@MoleculeDB");
    $mail->addAddress('kppatel14392@gmail.com');
    $mail->Subject = 'Alert ! Molecule :' . $fileName . ' has been deleted';
    $mail->Body = $message;
    $mail->AltBody = 'No Content';
    try {
        $mail->send();
//delete from master
        $sql = "DELETE FROM pm_master  WHERE master_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($master_id));
//delete from detail
        $sql = "DELETE FROM pm_detail  WHERE master_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($master_id));
        header("Location: mollist.php");
        echo 'Mail Sent';
        return true;
    } catch (Exception $e) {
        echo 'Mail Error' . $e;
        return false;
    }
} else {
    header("Location:delete.php?pass=false&id=" . $master_id);
}




