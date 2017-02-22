<?php

//setting file path
$target_dir = "/home/jp/Documents/pmArchive/pm/ok/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

//check weather file posted or not
if (isset($_POST["submit"]) && $_POST['submit'] == "UploadFile") {
    if (!empty($_FILES['fileToUpload']) && file_exists($_FILES['fileToUpload']['tmp_name'])) {

        //reading file
        $filename = $_FILES['fileToUpload']['name'];
        $file = $_FILES['fileToUpload']['tmp_name'];
        $f = fopen($file, "r") or exit("Unable to open file!");
        $members = array();
        while (!feof($f)) {
            $members[] = fgets($f);
        }

        //trim and remove blank lines
        $trimmed_array = array_values(array_filter($members, "trim"));
        $fileArray = array_map('trim', $trimmed_array);

        //geting master id from database
        include 'database.php';
        $pdo = Database::connect();
        $sql = "SELECT master_id FROM pm_master WHERE filename ='" . $filename . "';";
        foreach ($pdo->query($sql) as $row) {
            $master_id = $row["master_id"];
            echo "id: " . $master_id . "<br>";
        }

        //make master data array
        $count = 0;
        $finalData = array();

        foreach ($fileArray as $key => $value) {
            //remove unused lines
            if (strpos($value, "NSiteTypes") === 0 ||
                strpos($value, "NSites") === 0 ||
                strpos($value, "NRotAxes") === 0
            ) {
                echo "removing unused element <br>";
                unset($fileArray[$key]);
            }


        }
        //convert it to key value pair
        foreach ($fileArray as $key => $value) {
            $tempArray = explode("=", $value);
            if ($tempArray[1] == null) {
                $tempArray[1] = $tempArray[0];
            }
            if (array_key_exists($tempArray[0], $finalData)) {
                $count++;
                // echo "Key exists!" . $tempArray[0] . "<br>";
                $tempArray[0] = trim($tempArray[0]) . '$' . $count;
                $finalData[$tempArray[0]] = $tempArray[1];
            } else {
                $finalData[$tempArray[0]] = $tempArray[1];
                // echo "Key does not exist!<br>";
            }
        }

        //print filearray and file data
//         var_dump($fileArray);
//        var_dump($finalData);


        //if update is equal true
        $update = $_GET['update'];
        if ($update == "true") {
            $master_id = $_GET['id'];
            echo 'master' . $master_id;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM pm_detail WHERE master_id = ?";
            $q = $pdo->prepare($sql);
            $suc = $q->execute(array($master_id));

            echo 'in updcate';
        } else {
        }

        //LOOP THROUGH MASTER DATA AND INSERT
        foreach ($finalData as $key => $value) {
            if (strpos($key, "#") === 0 || strpos($key, "SiteType") === 0) {
                if (strpos($key, "SiteType") === 0) {
                    $sitetype = $value;
                }

                if (strpos($key, "#") === 0) {
                    $site = $value;
                }

            } else {
                $param = current(explode("$", $key));
                //inserting data
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO pm_detail (master_id,site_type,site,param,val) values(?, ?, ?,?,?)";
                $q = $pdo->prepare($sql);
                $suc = $q->execute(array($master_id, $sitetype, $site, $param, $value));
            }
        }
        if ($suc) {
            echo 'Done';
            if ($update == "true") {
                header('location: update.php?uploaded=true&id=' . $master_id);
            } else {
                header('location: addmol.php?uploaded=false');
            }
            die();
        } else {
            echo 'Not Done';
            if ($update == "true") {
                header('location: update.php?uploaded=false&id=' . $master_id);
            } else {
                header('location: addmol.php?uploaded=false');
            }
            echo 'NotDone';

            die();
        }
        Database::disconnect();

        //CLOSING FILE
        fclose($file);


    }
}


?>