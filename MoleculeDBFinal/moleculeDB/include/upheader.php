<form action="update.php?id=<?php echo $master_id ?>" method="post">
    <table>
        <tr>
            <th>Substance :</th>
            <td><input name="substance" type="text" placeholder="substance"
                       value="<?php echo !empty($substance) ? $substance : ''; ?>" size="50"></td>
        </tr>
        <tr>
            <th>CAS-No :</th>
            <td><input name="casno" type="text" placeholder="casno"
                       value="<?php echo !empty($casno) ? $casno : ''; ?>" size="50"></td>
        </tr>
        <tr>
            <th>Name :</th>
            <td><input name="name" type="text" placeholder="Name"
                       value="<?php echo !empty($name) ? $name : ''; ?>" size="50"></td>
        </tr>

        <tr>
            <th>Model Type :</th>
            <td><input name="modeltype" type="text" placeholder="modeltype"
                       value="<?php echo !empty($modeltype) ? $modeltype : ''; ?>" size="50"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><input name="description" type="text" placeholder="description"
                       value="<?php echo !empty($description) ? $description : ''; ?>" size="50">
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-success">Update</button>

            </td>
        </tr>
        <tr>
            <td>
                <?php
                $ans = isset($_GET['updated']) ? $_GET['updated'] : '';
                if ($ans == "true") {
                    echo "<p style='color: green'> Master Data Updated  </p>";
                } else if ($ans == "false") {
                    echo "<p style='color: red;' >  Error !  </p>";
                }
                ?>
            </td>
        </tr>
    </table>
</form>