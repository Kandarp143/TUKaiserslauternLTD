<?php
include 'database.php';
$pdo = Database::connect();

//check weather file posted or not
if (isset($_POST["submit"]) && $_POST['submit'] == "UploadFile") {
    if (!empty($_FILES['fileToUpload']) && file_exists($_FILES['fileToUpload']['tmp_name'])) {
        //get id
        $master_id = $_GET['id'];

        //get file raw data
        $filename = $_FILES['fileToUpload']['name'];
        $file = $_FILES['fileToUpload']['tmp_name'];

        //Read and Insert data
        $f = fopen($file, "r") or exit("Unable to open file!");
        $members = array();
        while (!feof($f)) {
            $members[] = fgets($f);
        }

        //trim and remove blank lines
        $trimmed_array = array_values(array_filter($members, "trim"));
        $fileArray = array_map('trim', $trimmed_array);

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
                // echo "Key exists!" . $tempArray[0] . "<br>";
                $tempArray[0] = trim($tempArray[0]) . '$' . $count;
                $finalData[$tempArray[0]] = $tempArray[1];
            } else {
                $finalData[$tempArray[0]] = $tempArray[1];
                // echo "Key does not exist!<br>";
            }
        }

        //print filearray and file data
//        var_dump($fileArray);
//        var_dump($finalData);


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

    }
}

Database::disconnect();

?>