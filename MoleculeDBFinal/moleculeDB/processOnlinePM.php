<?php
require 'database.php';
$pdo = Database::connect();
$arr = explode("\n", $_POST['confirmationText']);
$trimmed_array = array_values(array_filter($arr, "trim"));
$fileArray = array_map('trim', $trimmed_array);
$master_id = $_GET['id'];

//make master data array
$count = 0;
$finalData = array();
foreach ($fileArray as $key => $value) {
    //remove unused lines
    if (strpos($value, "NSiteTypes") === 0 ||
        strpos($value, "NSites") === 0 ||
        strpos($value, "NRotAxes") === 0
    ) {
//                echo "removing unused element <br>";
        unset($fileArray[$key]);
    }

}
//convert it to key value pair
foreach ($fileArray as $key => $value) {
    $tempArray = explode("=", $value);
    $tempArray[0] = trim($tempArray[0], " \t\n\r\0\x0B\xc2\xa0");
    if (!isset($tempArray[1])) {
        $tempArray[1] = $tempArray[0];
    }
    if (array_key_exists($tempArray[0], $finalData)) {
        $count++;
        $tempArray[0] = $tempArray[0] . '$' . $count;
        $finalData[$tempArray[0]] = $tempArray[1];
    } else {
        $finalData[$tempArray[0]] = $tempArray[1];

    }
}


//if update is equal true
$update = $_GET['update'];
if ($update == "true") {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM pm_detail WHERE master_id = ?";
    $q = $pdo->prepare($sql);
    $suc = $q->execute(array($master_id));
}


//LOOP THROUGH MASTER DATA AND INSERT
foreach ($finalData as $key => $value) {
    if (strpos($key, "#") === 0 || strpos($key, "SiteType") === 0) {
        if (strpos($key, "SiteType") === 0) {
            $sitetype = $value;
        }
        if (strpos($key, "#") === 0) {
            $site = str_replace('#', '', $value);
        }

    } else {
        $param = current(explode("$", $key));
        //inserting data
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pm_detail (master_id,site_type,site,param,val) values(?, ?, ?,?,?)";
        $q = $pdo->prepare($sql);
        $suc = $q->execute(array($master_id, trim($sitetype, " "), trim($site, " "), trim($param, " "), trim($value, " ")));
    }
}

//CLOSING FILE
fclose($file);
if ($suc) {
    try {
        move_uploaded_file($file, "pm/" . $filename);
    } catch (Exception $e) {
        echo $e;
    }
    if ($update == "true") {
        header('Location: update.php?uploaded=true&id=' . $master_id);
    } else {
        header("Location: addmol.php?master=done&uploaded=true&id=" . $master_id);
    }
} else {
    if ($update == "true") {
        header('Location: update.php?uploaded=false&id=' . $master_id);
    } else {
        header("Location: addmol.php?master=done&uploaded=false&id=" . $master_id);
    }
}

$pdo = Database::disconnect();
?>