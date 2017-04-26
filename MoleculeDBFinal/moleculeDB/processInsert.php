<?php
//going to use session var
session_set_cookie_params(0);
session_start();
require 'database.php';
require_once 'funcation/fileFunc.php';

$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data


/* Validation */

//inputdata
if (!empty($_POST)) {
    if (empty($_POST['substance']))
        $errors['substance'] = 'Substance required field';
    if (empty($_POST['casno']))
        $errors['casno'] = 'casno required field';
    if (empty($_POST['name']))
        $errors['name'] = 'name required field';
    if (empty($_POST['modeltype']))
        $errors['modeltype'] = 'modeltype required field';
} else {
    $errors['post'] = 'Empty form can not submit , Please add molecule detail';
}

//profile image
$allowedSize = 5000000;
$allowedFtypes = array('.jpg', '.gif', '.bmp', '.png');
if (!empty($_FILES['profile']['tmp_name'])) {
    if (!in_array(getExt($_FILES['profile']['name']), $allowedFtypes))//should be image
        $errors['profileType'] = 'Profile image  should be image file : .jpg,.gif,.bmp, .png ';
    if (!validateSize($_FILES['profile']['size'], $allowedSize))//less then 5 MB
        $errors['profileSize'] = 'File should be less then 5 MB';
}
//pm file
if (empty($_FILES['pmfile']['tmp_name'])) {//reqired file
    $errors['pmfile'] = 'PM File not found ! Please upload again';
} else {
    if (getExt($_FILES['pmfile']['name']) !== '.pm')//should be pm
        $errors['pmfileType'] = 'PM File should be .PM file';
    if (!validateSize($_FILES['profile']['size'], $allowedSize))//less then 5 MB
        $errors['pmfileSize'] = 'PM File should be less then 5 MB';
}

/*
 * if no errors then operate
 * */
$masterid = 0;
if (empty($errors)) {
//declare
    $substance = $_POST['substance'];
    $casno = $_POST['casno'];
    $name = $_POST['name'];
    $modeltype = $_POST['modeltype'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $profileName = '';


    //upload profile
    if (!empty($_FILES['profile']['tmp_name'])) {
        $profileName = $substance . $casno . '_profile' . getExt($_FILES['profile']['name']);
        uploadFile($_FILES['profile']['tmp_name'], '../img/profile/', $profileName);
    }
    //get pm data
    $pmData = parsePMFile($_FILES['pmfile']['tmp_name']);

    // insert data
    try {
        $db = new Database();
        $db->beginTransaction();
        //master record
        $masterid = $db->insert('INSERT INTO pm_master (filename,cas_no,name,bibtex_ref_key,bibtex_key,bibtex_year,model_type,memory_loc,description,type) 
                VALUES (?,?,?,?,?,?,?,?,?,?)',
            array($substance, $casno, $name, 0, '-', 0, $modeltype, 'img/profile/' . $profileName, $description, $type));
        //detail records;
        foreach ($pmData as $key => $value) {
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
                $db->insert('INSERT INTO pm_detail (master_id,site_type,site,param,val) values(?, ?, ?,?,?)', array($masterid, trim($sitetype, " "), trim($site, " "), trim($param, " "), trim($value, " ")));
            }
        }
        $db->commitTransaction();


        $data['success'] = true;
        $data['message'] = 'Success!';
        $data['id'] = $masterid;

    } catch (Exception $e) {
        $error = $e;
//        echo $e;
    }


} else {
    $data['success'] = false;
    $data['errors'] = $errors;
    $data['id'] = 0;

}
//
$_SESSION['processInsert'] = $data;
//

$url = 'addmol.php';
if (headers_sent()) {
    die("Redirect failed. Please click on this link: <a href= $url> CLICK HERE <a/>");
} else {
    exit(header('location:' . $url));
}

?>