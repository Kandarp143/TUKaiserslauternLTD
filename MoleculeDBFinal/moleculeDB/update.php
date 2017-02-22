<?php include('include/header.php') ?>
<?php

require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
// keep track post values
    $substance = $_POST['substance'];
    $casno = $_POST['casno'];
    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $modeltype = $_POST['modeltype'];
    $description = $_POST['description'];

// update data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE pm_master SET filename = ?,cas_no =?,name = ?,bibtex_key= ?,model_type= ?,description = ? WHERE master_id= ?";
    $q = $pdo->prepare($sql);
    $suc = $q->execute(array($substance, $casno, $name, $reference, $modeltype, $description, $id));
    Database::disconnect();
    if ($suc) {
        header("Location: update.php?updated=true&id=" . $id);
    } else {
        header("Location: update.php?updated=false&id=" . $id);
    }


} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from pm_master where master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $substance = $data['filename'];
    $casno = $data['cas_no'];
    $name = $data['name'];
    $reference = $data['bibtex_key'];
    $modeltype = $data['model_type'];
    $description = $data['description'];
    Database::disconnect();

    echo $data['modeltype'];
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
                    <form action="update.php?id=<?php echo $id ?>" method="post">
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
                                <th>Reference :</th>
                                <td><input name="reference" type="text" placeholder="reference"
                                           value="<?php echo !empty($reference) ? $reference : ''; ?>" size="50"></td>
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
                                    <button href="listmol.php">Back</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    $ans = $_GET['updated'];
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
                    <?php $filepath = 'pm/' . $substance; ?>
                    <h1 class="title">
                        Upload updated PM file

                    </h1>

                    <form action="upload.php?update=true&id=<?php echo $id ?>" method="post"
                          enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td colspan="2">

                                    <p style="text-align: center">
                                        <a href="<?php echo $filepath ?>"
                                           download="<?php echo $substance ?>">Downlaod PM
                                            File</a>
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
                                    $ans = $_GET['uploaded'];
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
