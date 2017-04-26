<?php

if (isset($_POST['submit_button'])) {
    if (isset($_POST['bib_key'])) {
        //db thing
        include 'database.php';
        $master_id = $_GET['id'];
        $pdo = Database::connect();
        echo $_POST['bib_key'];
        $radval = explode('-', $_POST['bib_key']);
        echo $radval[0] . $radval[1];
        $sql = 'UPDATE pm_master SET bibtex_ref_key = ' . $radval[0] . ' , bibtex_key = "' . $radval[1] . '" WHERE master_id =' . $master_id;
        $pdo->query($sql);
        header("Location:  moldetail.php?id=$master_id");
        $pdo = Database::disconnect();
    } else {
        echo '<p style="color: red"> Something went wrong ! Go Back and Try again</p>';
    }
}
?>