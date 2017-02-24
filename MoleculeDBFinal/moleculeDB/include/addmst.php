<form action="processInsert.php" method="post">
    <table>
        <tr>
            <th colspan="2"> Step 1 : Insert master data & Referencess</th>
        </tr>
        <tr>
            <td>Substance</td>
            <td><input name="substance" type="text" placeholder="should be same as PM file name (eg. CH3NO2 )"
                       size="50"></td>
        </tr>
        <tr>
            <td>CAS-No</td>
            <td><input name="casno" type="text" placeholder="casno"
                       size="50"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input name="name" type="text" placeholder="Name"
                       size="50"></td>
        </tr>
        <tr>
            <td>Reference</td>
            <td><input name="reference" type="text" placeholder="reference eg[Vrabec 2001]"
                       size="50"></td>
        </tr>
        <tr>
            <td>Model Type</td>
            <td><input name="modeltype" type="text" placeholder="modeltype"
                       size="50"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description" rows="4" cols="50"></textarea>
            </td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type="radio" name="type" value="rigid"> Rigid&nbsp
                <input type="radio" name="type" value="flexible"> Flexible
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" id="mstsub"><strong>Save</strong></button>
        </tr>
    </table>

</form>