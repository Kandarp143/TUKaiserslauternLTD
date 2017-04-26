<form action="processUpload.php?update=false&id=<?php echo $_GET['id'] ?>" method="post"
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