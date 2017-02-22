<?php session_start();
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
    header("Location: mollist.php");
//    header("Location: email.php?id=" . $id);

}
?>