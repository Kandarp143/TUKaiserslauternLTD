<table style="text-align: left">
    <tr>
        <th colspan="2"> Step 1 : Insert Molecule Master Data and Molecule Image <br/> <br/>
        </th>
    </tr>
    <tr>
        <td>Substance</td>
        <td><input name="substance" type="text"
                   size="50"></td>
        <td>
            <a href="#"
               data-tooltip="should be same as PM file name (eg. CH3NO2 )">
                <img src="img/info.ico"></a>
        </td>
    </tr>
    <tr>
        <td>CAS-No</td>
        <td><input name="casno" type="text"
                   size="50"></td>
        <td>
            <a href="#"
               data-tooltip="casno">
                <img src="img/info.ico"></a>
        </td>

    </tr>
    <tr>
        <td>Name</td>
        <td><input name="name" type="text"
                   size="50"></td>
        <td>
            <a href="#"
               data-tooltip="Name">
                <img src="img/info.ico"></a>
        </td>
    </tr>
    <tr>
        <td>Model Type</td>
        <td><input name="modeltype" type="text"
                   size="50"></td>
        <td>
            <a href="#"
               data-tooltip="modeltype">
                <img src="img/info.ico"></a>
        </td>
    </tr>
    <tr>
        <td>Description</td>
        <td><textarea name="description" rows="4" cols="60"></textarea>
        </td>
    </tr>
    <tr>
        <td>Type</td>
        <td><input type="radio" name="type" value="rigid"> Rigid&nbsp
            <input type="radio" name="type" value="flexible"> Flexible
        </td>
    </tr>
    <tr>
        <td colspan="2"><br/>Upload molecule image : <input type="file" name="profile" id="profile"></td>

    </tr>
</table>
