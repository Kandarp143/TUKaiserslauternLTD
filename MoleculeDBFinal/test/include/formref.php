<?php
if (isset($_GET['map'])) {
$master_id = 0;
if (isset($_GET['master_id'])) {
    $master_id = $_GET['master_id'];
}
?>
<link rel="stylesheet" type="text/css" href="css/tooltip.css" media="screen"/>
<form action="processRef.php?map=true&master_id=<?php echo $master_id ?>&id=<?php echo $id ?>&act=<?php echo $act ?>"
      method="post">
    <?php
    }else{
    ?>
    <form action="processRef.php?id=<?php echo $id ?>&act=<?php echo $act ?>" method="post"><?php
        } ?>
        <table>
            <tr>
                <td>Shorthand Title</td>
                <td><input name="bib_title" type="text"
                           placeholder=""
                           value="<?php echo $ref['Bib_Title'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Reference Type</td>
                <td><input name="bib_type" type="text"
                           placeholder=""
                           value="<?php echo $ref['Bib_Type'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Title</td>
                <td><input name="Title" type="text"
                           placeholder=""
                           value="<?php echo $ref['Title'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Author</td>
                <td><input name="Author" type="text"
                           placeholder=""
                           value="<?php echo $ref['Author'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Journal</td>
                <td><input name="Journal" type="text"
                           placeholder=""
                           value="<?php echo $ref['Journal'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Publisher</td>
                <td><input name="Publisher" type="text"
                           placeholder=""
                           value="<?php echo $ref['Publisher'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Volume</td>
                <td><input name="Volume" type="text"
                           placeholder=""
                           value="<?php echo $ref['Volume'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Number</td>
                <td><input name="Number" type="text"
                           placeholder=""
                           value="<?php echo $ref['Number'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Pages</td>
                <td><input name="Pages" type="text"
                           placeholder=""
                           value="<?php echo $ref['Pages'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Year</td>
                <td><input name="Year" type="text"
                           placeholder=""
                           value="<?php echo $ref['Year'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input name="Address" type="text"
                           placeholder=""
                           value="<?php echo $ref['Address'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Owner</td>
                <td><input name="Owner" type="text"
                           placeholder=""
                           value="<?php echo $ref['Owner'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Timestamp</td>
                <td><input name="Timestamp" type="text"
                           placeholder=""
                           value="<?php echo $ref['Timestamp'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Doi</td>
                <td><input name="Doi" type="text"
                           placeholder=""
                           value="<?php echo $ref['Doi'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Editor</td>
                <td><input name="Editor" type="text"
                           placeholder=""
                           value="<?php echo $ref['Editor'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Edition</td>
                <td><input name="Edition" type="text"
                           placeholder=""
                           value="<?php echo $ref['Edition'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>Url</td>
                <td><input name="Url" type="text"
                           placeholder=""
                           value="<?php echo $ref['Url'] ?>"
                           size="50"></td>
                <td>
                   <div class="tooltip">[i]
                <span class="tooltiptext">Tooltip text</span>
            </div>
                </td>
            </tr>
            <tr>
                <td>School</td>
                <td><input name="School" type="text"
                           placeholder=""
                           value="<?php echo $ref['School'] ?>"
                           size="50"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" id="mstsub"><strong><?php echo $submit ?></strong></button>
            </tr>
        </table>

    </form>