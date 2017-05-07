<link rel="stylesheet" type="text/css" href="css/tooltip.css" media="screen"/>
<form id="msform" action="processInsert.php" enctype="multipart/form-data" method="post">
    <table width="50%" class="beta">
        <tr>
            <th colspan="3">Step 1 : Insert master data</th>
        </tr>
        <tr>
            <td>Substance</td>
            <td><input name="substance" type="text"

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
                       size="10"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description" rows="4" cols="50"></textarea>
            </td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext">Tooltip text</span>
                </div>
            </td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type="radio" name="type" value="Rigid" checked="checked"> Rigid&nbsp
                <input type="radio" name="type" value="Flexible"> Flexible
            </td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext"><img src="img/info.ico"></span>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="3">Step 2 : Upload Files</th>
        </tr>
        <tr>
            <!--        step 2-->
            <td nowrap="">Molecule image</td>
            <td><input type="file" name="profile" id="profile"></td>
            <td>
                <div class="tooltip">[i]
                    <span class="tooltiptext"><img src="img/info.ico"></span>
                </div>
            </td>
        </tr>
        <tr>
            <td nowrap="">
                Force Fields <br/>(PM File)
            </td>
            <td>
                <input type="file" name="pmfile" id="pmfile">
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
                <button>Add Molecule</button>
            </td>

        </tr>
    </table>
</form>