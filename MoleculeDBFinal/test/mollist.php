<?php include('include/header.php') ?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"
          media="screen"/>
    <!--javascript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/mollist.js"></script>
</head>
<body>


<div id="wrapper">
    <?php include('include/nav.php') ?>
    <?php
    include 'database.php';
    $pdo = Database::connect();
    $tbl_sql = 'SELECT master_id,  filename,cas_no,name,model_type,type,bibtex_key FROM pm_master';
    ?>
    <div id="page">

        <table id="listmol" class="display" cellspacing="0" width="90%">

            <thead>
            <tr>

                <td colspan="4" style="border: none;">
                    <input type="button" id="reload" value="Restore View">
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Substance</th>
                <th nowrap>CAS-No</th>
                <th>Name</th>
                <th>Model Type</th>
                <th>References</th>
                <th>Type</th>
                <?php if ($_SESSION['act'] == 'true') { ?>
                    <th><span style="color: green"><b>Action</b></span></th>
                <?php } ?>

            </tr>
            </thead>
            <tfoot>

            <tr>
                <th>ID</th>
                <th>Substance</th>
                <th nowrap>CAS-No</th>
                <th>Name</th>
                <th>Model Type</th>
                <th>References</th>
                <th>Type</th>
                <?php if ($_SESSION['act'] == 'true') { ?>
                    <th></th>
                <?php } ?>

            </tr>
            </tfoot>
            <tbody>

            <!-- table print-->
            <?php
            foreach ($pdo->query($tbl_sql) as $row) {
                if ($_SESSION['act'] == 'true') {
                    echo "<tr style='text-align: left'>";

                } else {

                    echo "<tr style='text-align: left;line-height: 23px;'>";
                }
                echo "<td>" . $row['master_id'] . "</td>";
                $substance = $row['filename'];
                if (0 === strpos($substance, 'R')) {
                    preg_match('~[a-z]~i', substr($substance, 1), $match, PREG_OFFSET_CAPTURE);
                    $left = substr($substance, 0, $match[0][1] + 1);
                    $right = substr($substance, $match[0][1] + 1);
                    $substance = $left . preg_replace('/[0-9]+/', '<sub>$0</sub>', $right);
                } else {
                    $substance = preg_replace('/[0-9]+/', '<sub>$0</sub>', $row['filename']);
                }
                echo "<td><a href='moldetail.php?id=" . $row['master_id'] . "'>"
                    . $substance
                    . "</a></td>";
                echo "<td nowrap>" . $row['cas_no'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['model_type'] . "</td>";
                echo "<td nowrap> [" . $row['bibtex_key'] . "] </tdnowrap>";
                echo "<td>" . $row['type'] . "</td>";
                if ($_SESSION['act'] == 'true') {
                    echo '<td><a class="a-success"  href="update.php?id=' . $row['master_id'] . '">Update</a><br/>';
                    echo '<a  class="a-danger" href="delete.php?id=' . $row['master_id'] . '&substance=' . $row['filename'] . '">Delete</a>';
                    echo '</td>';
                }
                echo "</tr>";
            }
            Database::disconnect();
            ?>
            </tbody>
        </table>
    </div>
    <div style="clear:both; margin:0;"></div>
</div>
<!-- end #page -->


<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>


