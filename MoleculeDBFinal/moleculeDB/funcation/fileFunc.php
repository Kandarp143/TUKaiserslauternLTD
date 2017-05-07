<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/23/2017
 * Time: 10:10 AM
 */

function getExt($fileName)
{
    $ext = substr($fileName, strpos($fileName, '.'), strlen($fileName) - 1);
    return $ext;
}

function validateSize($actual, $expected)
{

//    echo '<br/><br/>validateSize' . $actual <= $expected;
    return $actual <= $expected;
}

function uploadFile($file, $path, $filename)
{
    // Check if we can upload to the specified path, if not DIE and inform the user.
    if (!is_writable($path))
        die('You cannot upload to the specified directory, ' . $path);

    // Upload the file to your specified path.
    if (move_uploaded_file($file, $path . $filename)) {
        //        echo 'Your file upload was successful'; // It worked.
    } else
        die ('There was an error during the file upload. Please try again.'); // It failed
}

function parsePMFile($file)
{
    //Read and Insert data
    $f = fopen($file, "r") or exit("Unable to open file!");
    $members = array();
    while (!feof($f)) {
        $members[] = fgets($f);
    }


    //print filearray and file data
//    var_dump($fileArray);
//    var_dump($finalData);

    fclose($f);
    return parsePMArray($members);
}

function parsePMArray($members)
{
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

    return $finalData;
}