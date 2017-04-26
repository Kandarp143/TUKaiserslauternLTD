<?php
require 'database.php';
if (isset($_GET['id'])) {
    $master_id = $_GET['id'];
} else {
    $master_id = 0;
}
$pdo = Database::connect();
//db thing
$bibq = "SELECT DISTINCT pm_bib.bib_key,pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value FROM pm_bib ORDER BY `pm_bib`.`bib_title`  ASC;";
$result = $pdo->query($bibq);
if ($result->rowCount() > 0) {
    //if result set there.
    $references = array();
    $ref = null;
    $bib = 1;
    $i = 0;
    foreach ($result as $row) {
        if ($bib != $row['bib_key']) {
//            var_dump($ref);
            $references[] = $ref;
            $bib = $row['bib_key'];
            $ref = array();
        }
        $ref['id'] = $row['bib_key'];
        $ref['bib_type'] = $row['bib_type'];
        $ref['bib_title'] = $row['bib_title'];
        $ref[$row['param']] = $row['value'];

        //explicitly add for last
        if ($i == $result->rowCount() - 1) {
            // last
            $references[] = $ref;
        }
        // …
        $i++;
    }

//    foreach ($references as $r) {
//        if (isset($r['Year'])) {
//            echo 'true<br/>';
//            echo $r['Year'];
//            $t = $r['Year'];
//        } else {
//            echo 'false<br/>';
//
//        }
//    }
//    var_dump($references);
} else {
    echo '<p> No References found</p>';
}
?>