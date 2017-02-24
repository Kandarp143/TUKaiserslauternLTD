<?php
include 'database.php';
$pdo = Database::connect();

//check weather file posted or not
if (isset($_POST["submit"]) && $_POST['submit'] == "UploadFile") {
    if (!empty($_FILES['fileToUpload']) && file_exists($_FILES['fileToUpload']['tmp_name'])) {
        echo 'posted';

    }
}


?>
<form action="" method="post"
      enctype="multipart/form-data">
    <table>
        <tr>
            <th colspan="2"> Step 2 : Upload PM file (Please keep filename same as substance name
                )
            </th>
        </tr>

        <tr>
            <td>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="UploadFile" name="submit">
            </td>
        </tr>
    </table>
</form>