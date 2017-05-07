<link rel="stylesheet" type="text/css" href="css/tooltip.css" media="screen"/>
<form action="processUpdateHead.php?id=<?php echo $master_id ?>" method="post">
    <table width="50%" class="beta">
        <tr>
            <td>Substance</td>
            <td><input name="substance" type="text"
                       value="<?php echo !empty($substance) ? $substance : ''; ?>"
                       size="10"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>CAS-No</td>
            <td><input name="casno" type="text"
                       value="<?php echo !empty($casno) ? $casno : ''; ?>"
                       size="10"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>

        </tr>
        <tr>
            <td>Name</td>
            <td><input name="name" type="text"
                       value="<?php echo !empty($name) ? $name : ''; ?>"
                       size="10"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Model Type</td>
            <td><input name="modeltype" type="text"
                       value="<?php echo !empty($modeltype) ? $modeltype : ''; ?>"
                       size="10"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description" rows="4" cols="50"><?php echo !empty($description) ? $description : ''; ?>
                </textarea>
            </td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type="radio" name="type"
                       value="Rigid" <?php echo $type == "Rigid" || empty($type) ? 'checked' : '' ?>>
                Rigid &nbsp
                <input type="radio" name="type" value="Flexible"<?php echo $type == "Flexible" ? 'checked' : '' ?>>
                Flexible
            </td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext"><img src="img/info.ico"></span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td colspan="2">
                <button>Update Master Data</button>
            </td>
        </tr>
    </table>
</form>
<!-- Display error -->
<?php
$sParam = 'processUpdateHead';  /*page name of processor*/
$sMsg = 'Master data updated successfully !';

if (isset($_SESSION[$sParam])) {
    if (!$_SESSION[$sParam]['success']) {
        echo '<p class="msg-err"> Errors [';
        foreach ($_SESSION[$sParam]['errors'] as $err) {
            echo $err . ', ';
        }
        echo ']</p>';

    } else {
        echo '<br/><br/><h3 class="msg-suc">' . $sMsg . ' </h3>';
    }
    unset($_SESSION[$sParam]);
}
?>


