<?php
$target_dir = "/home/jp/Documents/pmArchive/pm/ok/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


$user_name = "root";
$password = "admin";
$database = "molecule_db";
$server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);


if (isset($_POST["submit"]) && $_POST['submit'] == "Upload File") {
    if (!empty($_FILES['fileToUpload']) && file_exists($_FILES['fileToUpload']['tmp_name'])) {

        //UPLOAD FILE LOGIC
        $filename = $_FILES['fileToUpload']['name'];
        $file = $_FILES['fileToUpload']['tmp_name'];
        $f = fopen($file, "r") or exit("Unable to open file!");
        $members = array();
        while (!feof($f)) {
            $members[] = fgets($f);
        }

        //TRIM AND REMOVE BLANK LINES
        $trimmed_array = array_values(array_filter($members, "trim"));
        $fileArray = array_map('trim', $trimmed_array);

        //GET MASTER ID FROM FILE NAME
        $SelQ = "SELECT master_id FROM master_entry WHERE filename ='" . $filename . "';";
        $result = mysql_query($SelQ, $db_handle);
        while ($row = mysql_fetch_assoc($result)) {
            $master_id = $row["master_id"];
            echo "id: " . $master_id . "<br>";

        }


        //MAKE MASTER DATA ARRAY
        $count = 0;
        $finalData = array();
        var_dump($fileArray);
        foreach ($fileArray as $key => $value) {
            //remove unused lines
            if (strpos($value, "NSiteTypes") === 0 || strpos($value, "NSites") === 0 || strpos($value, "NRotAxes") === 0) {
                echo "removing unused element <br>";
                unset($fileArray[$key]);
            }


        }
        foreach ($fileArray as $key => $value) {
            //convert it to key value pair
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

        // var_dump($fileArray);
        var_dump($finalData);


        // //LOOP THROUGH MASTER DATA AND INSERT
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
                $sqlsql = "INSERT INTO master_detail (master_id,site_type,site,param,val)
					VALUES (" . $master_id . ",'" . $sitetype . "','" . $site . "','" . $param . "','" . $value . "')";
                if (mysql_query($sqlsql, $db_handle)) {
                    echo "insert :" . $sqlsql . "<br>";
                    header('location: addmol.php?uploaded=true');
                } else {
                    header('location: addmol.php?uploaded=false ');
                    echo "Error: " . $sqlsql . die(mysql_error());
                }
            }


        }


        //CLOSING FILE
        fclose($file);


    }
}
header('location: addmol.php?uploaded=true');

?>