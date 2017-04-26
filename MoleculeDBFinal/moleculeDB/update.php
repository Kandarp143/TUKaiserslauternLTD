<?php include('include/header.php') ?>

<?php

require 'database.php';
require_once 'funcation/othFunc.php';

$master_id = null;
if (!empty($_GET['id'])) {
    $master_id = $_REQUEST['id'];
}

if (!empty($_POST)) {
// keep track post values
    $substance = $_POST['substance'];
    $casno = $_POST['casno'];
    $name = $_POST['name'];
    $modeltype = $_POST['modeltype'];
    $description = $_POST['description'];

// update data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE pm_master SET filename = ?,cas_no =?,name = ?,model_type= ?,description = ? WHERE master_id= ?";
    $q = $pdo->prepare($sql);
    $suc = $q->execute(array($substance, $casno, $name, $modeltype, $description, $master_id));
    Database::disconnect();
    if ($suc) {
        header("Location: update.php?updated=true&id=" . $master_id);
    } else {
        header("Location: update.php?updated=false&id=" . $master_id);
    }


} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from pm_master where master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($master_id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $substance = $data['filename'];
    $casno = $data['cas_no'];
    $name = $data['name'];
    $modeltype = $data['model_type'];
    $description = $data['description'];
    Database::disconnect();
}
?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Update Master Data </h1>
                <div class="entry">
                    <!--        molecule header-->
                    <?php include('include/upheader.php') ?>
                </div>
            </div>
            <div class="post">
                <h1 class="title">Upload updated PM file</h1>

                <div class="entry">
                    <!--        molecule file upload-->
                    <?php include('include/updet.php') ?>
                </div>
                <h1 class="title">References</h1>
                <div class="entry">
                    <?php include('include/upfoot.php') ?>

                </div>
            </div>
        </div>
        <!-- end #content -->
        <div style="clear:both; margin:0;"></div>
    </div>
    <!-- end #page -->
</div>

<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>
