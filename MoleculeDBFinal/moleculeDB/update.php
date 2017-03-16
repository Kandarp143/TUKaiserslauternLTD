<?php include('include/header.php') ?>
<?php

require 'database.php';

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
                    <form action="update.php?id=<?php echo $master_id ?>" method="post">
                        <table>
                            <tr>
                                <th>Substance :</th>
                                <td><input name="substance" type="text" placeholder="substance"
                                           value="<?php echo !empty($substance) ? $substance : ''; ?>" size="50"></td>
                            </tr>
                            <tr>
                                <th>CAS-No :</th>
                                <td><input name="casno" type="text" placeholder="casno"
                                           value="<?php echo !empty($casno) ? $casno : ''; ?>" size="50"></td>
                            </tr>
                            <tr>
                                <th>Name :</th>
                                <td><input name="name" type="text" placeholder="Name"
                                           value="<?php echo !empty($name) ? $name : ''; ?>" size="50"></td>
                            </tr>

                            <tr>
                                <th>Model Type :</th>
                                <td><input name="modeltype" type="text" placeholder="modeltype"
                                           value="<?php echo !empty($modeltype) ? $modeltype : ''; ?>" size="50"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><input name="description" type="text" placeholder="description"
                                           value="<?php echo !empty($description) ? $description : ''; ?>" size="50">
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success">Update</button>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $ans = isset($_GET['updated']) ? $_GET['updated'] : '';
                                    if ($ans == "true") {
                                        echo "<p style='color: green'> Master Data Updated  </p>";
                                    } else if ($ans == "false") {
                                        echo "<p style='color: red;' >  Error !  </p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="post">
                <div class="entry">
                    <!--        molecule file upload-->
                    <?php $filepath = 'pm/' . $substance . '.pm'; ?>
                    <h1 class="title">
                        Upload updated PM file

                    </h1>

                    <form action="processUpload.php?update=true&id=<?php echo $master_id ?>" method="post"
                          enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td colspan="2">

                                    <p style="text-align: center">
                                        <a href="<?php echo $filepath ?>"
                                        "><?php echo $filepath ?></a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </td>
                                <td>
                                    <input class="button" type="submit" value="UploadFile" name="submit">
                                    <?php
                                    $ans = isset($_GET['uploaded']) ? $_GET['uploaded'] : '';
                                    if ($ans == "true") {
                                        echo "<p style='color: green'> File uploaded successfully  </p>";
                                    } else if ($ans == "false") {
                                        echo "<p style='color: red;' > Upload Error !  </p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <h1 class="title">References</h1>
                <div class="entry">
                    <p>
                        <strong>
                            <?php include('include/detfooter.php') ?>
                        </strong>
                        <br/>
                        <b></b>
                        <a href="addref.php?id=<?php echo $master_id ?>">Update Refernece</a>
                        <b/>
                    </p>
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
