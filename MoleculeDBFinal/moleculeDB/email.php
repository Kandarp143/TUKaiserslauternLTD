<?php
// HTML email starts here
$mol = "";
$message = "<html><body>";

$message .= "<div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;'>
            <h2>Following molecule has been deleted from database.</h2>
            <br/>
            <h2>Molecule Header </h2>
            <table>";
include 'database.php';
$master_id = $_GET['id'];
$pdo = Database::connect();
$sql = "select DISTINCT  * from pm_master where master_id = " . $master_id . ";";
$file = '';
foreach ($pdo->query($sql) as $row) {
    $mol = $row['filename'];
    $message .= "<tr style='text-align: left'><th>Substance</th><td>" . $row['filename'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>Name</th><td>" . $row['name'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>Reference</th><td>" . $row['bibtex_key'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
    $message .= "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
    $file = 'pm/' . $row['filename'] . '.pm';

}
$message .= "</table>";
$bib_type = "";
$bib_title = "";
$bibq = "SELECT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key WHERE pm_master.master_id =" . $master_id . ";";
foreach ($pdo->query($bibq) as $row) {
    $bib_type = $row['bib_type'];
    $bib_title = $row['bib_title'];
}
$message .= "<h2>References @ " . $bib_type . ":" . $bib_title . "</h2><br/>";

$message .= "<table>";
foreach ($pdo->query($bibq) as $row) {
    $message .= "<tr style='text-align: left'><th>" . $row['param'] . "</th><td>" . $row['value'] . "</td></tr>";
}
$message .= " </table>";
$message .= "<h2>Molecule Detail </h2><br/>";
$q = "select DISTINCT site_type from pm_detail where master_id =" . $master_id . ";";
$stmt = $pdo->query($q);
$message .= "<table><tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $message .= "<tr>";
    foreach ($row as $_column) {
        $message .= "<th>Site Type :</th><th>{$_column}</th>";
        $q2 = "SELECT  param,val from pm_detail where site_type = '{$_column}' and master_id=" . $master_id . ";";
        $stmt2 = $pdo->query($q2);

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $message .= "<tr>";
            foreach ($row as $_column) {
                $message .= "<td style='text-align: left'>{$_column}</td>";
            }
            $message .= "</tr>";
        }
    }
    $message .= "</tr>";
}
$message .= "</table>";
$message .= "</div></body></html>";


// HTML email ends here
date_default_timezone_set('Etc/UTC');
require 'mailer/PHPMailerAutoload.php';
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
$mail->setFrom('kppatel14392@gmail.com', 'Admin@MoleculeDB');
//$mail->addReplyTo('er.ikndp@gmail.com', 'First Last');
$mail->addAddress('kppatel14392@gmail.com');
$mail->addAddress('er.ikndp@gmail.com');
$mail->Subject = 'Alert ! Molecule :' . $mol . ' Has been deleted';
$mail->Body = $message;
$mail->addAttachment($file);
$mail->AltBody = 'This is a plain-text message body';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {

// delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//delete from master
    $sql = "DELETE FROM pm_master  WHERE master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($master_id));
//delete from detail
    $sql = "DELETE FROM pm_detail  WHERE master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($master_id));
    echo "Message sent!";
//    header("Location: mollist.php");
}
?>
<script type="text/javascript">
    window.location.href = 'mollist.php';
</script>
