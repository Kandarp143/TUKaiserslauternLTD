<table>
    <tr>
        <th>
            <b><i>Ms2 -------> </i></b>
        </th>
        <td>
            <a class="a-button"
               href="include/generatePm.php?id=<?php echo $master_id ?>"><?php echo toSubstanceTitle($substance) . '.pm' ?></a>
        </td>
    </tr>
    <tr>
        <th>
            <b>Ls1 Mardyn <i>----></i></b>
        </th>
        <td>
            <a class="a-button"
               href="include/generateLs.php?id=<?php echo $master_id ?>"><?php echo toSubstanceTitle($substance) . '.xml' ?></a>
        </td>
    </tr>
</table>