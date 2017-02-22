<?php
require 'database.php';
if (!empty($_POST)) {
// keep track post values
    $substance = $_POST['substance'];
    $substance = $substance . '.pm';
    $casno = $_POST['casno'];
    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $modeltype = $_POST['modeltype'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $error = '';

// insert data
    try {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO pm_master (filename,cas_no,name,bibtex_key,model_type,memory_loc,description,type) 
VALUES (?,?,?,?,?,?,?,?)';
        $q = $pdo->prepare($sql);
        $suc = $q->execute(array($substance, $casno, $name, $reference, $modeltype, '', $description, $type));
        Database::disconnect();
    } catch (Exception $e) {
        $error = $e;
//        echo $e;
    }
    if ($suc) {
        $_SESSION['submit_msg'] = "Master data successfully inserted , Please upload pm file";
        header("Location: addmol.php?master=true");

    } else {
        $_SESSION['submit_msg'] = "Error : " . $error;
        header("Location: addmol.php?master=false");

    }

}

echo $_SESSION['submit_msg'];

?>