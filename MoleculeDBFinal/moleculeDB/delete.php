<?php include('include/header.php') ?>
<?php
require 'database.php';
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];

    // delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //delete from master
    $sql = "DELETE FROM pm_master  WHERE master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    //delete from detail
    $sql = "DELETE FROM pm_detail  WHERE master_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();

//    include('email.php');
    header("Location: email.php?id=" . $id);
//    header("Location: mollist.php");

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
                <h1 class="title">Delete a Molecule </h1>
                <div class="entry">
                    <form class="form-horizontal" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <p class="alert alert-error">Are you sure to delete ?
                            <?php echo "<h2>" . $_REQUEST['substance'] . "</h2>" ?></p>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button class="btn btn-success" href="mollist.php">No</button>
                        </div>
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

