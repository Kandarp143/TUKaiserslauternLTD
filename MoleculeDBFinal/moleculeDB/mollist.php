<?php include('include/header.php') ?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"
          media="screen"/>
    <style>
        table {
            /*max-width: 400px;*/
            width: 100% !important;
        }
    </style>
    <!--javascript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <!--add column level search-->
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#listmol tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '"/>');
            });
            // DataTable
            var table = $('#listmol').DataTable(

            );

            $('#listmol tfoot tr').appendTo('#listmol thead');
            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>
</head>
<body>


<div id="wrapper">
    <?php include('include/nav.php') ?>
    <!--Drop down -->
    <div id="content page">
        <?php
        include 'database.php';
        $pdo = Database::connect();
        $sql = 'SELECT DISTINCT model_type FROM pm_master ORDER BY model_type ASC';
        ?>
        <form action="" method="post">
            <select name="modelop">
                <?php
                if (isset($_POST['modelop'])) {
                    echo "<option value='" . $_POST['modelop'] . "'>" . $_POST['modelop'] . "</option>";
                    $tbl_sql = 'SELECT master_id, SUBSTRING(filename,1,POSITION("." IN filename)-1) as filename,
cas_no,name,model_type,type,SUBSTRING_INDEX(substr(bibtex_key,instr(bibtex_key,"{") + 1),"}", 1) as bib_key
 FROM pm_master WHERE  model_type = "' . $_POST['modelop'] . '"';
                } else {
                    echo "<option value=''>Select Model Type</option>";

                    $tbl_sql = 'SELECT master_id, SUBSTRING(filename,1,POSITION("." IN filename)-1) as filename,
cas_no,name,model_type,type,SUBSTRING_INDEX(substr(bibtex_key,instr(bibtex_key,"{") + 1),"}", 1) as bib_key
 FROM pm_master';
                }
                foreach ($pdo->query($sql) as $row) {
                    echo "<option value='" . $row['model_type'] . "'>" . $row['model_type'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Go"/>
        </form>
    </div>
    <div id="page">
        <table id="listmol" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Substance</th>
                <th>CAS-No</th>
                <th>Name</th>
                <th>Model Type</th>
                <th>References</th>
                <th>Type</th>
                <?php if ($_SESSION['act'] == 'true') { ?>
                    <th>Action</th>
                <?php } ?>

            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>Substance</th>
                <th>CAS-No</th>
                <th>Name</th>
                <th>Model Type</th>
                <th>References</th>
                <th>Type</th>
                <?php if ($_SESSION['act'] == 'true') { ?>
                    <th>Action</th>
                <?php } ?>

            </tr>
            </tfoot>
            <tbody>
            <!-- table print-->
            <?php
            foreach ($pdo->query($tbl_sql) as $row) {
                echo "<tr style='text-align: left'>";
                echo "<td>" . $row['master_id'] . "</td>";
                echo "<td><a href='moldetail.php?id=" . $row['master_id'] . "'>" . $row['filename'] . "</a></td>";
                echo "<td nowrap>" . $row['cas_no'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['model_type'] . "</td>";
                echo "<td nowrap> [" . $row['bib_key'] . "] </tdnowrap>";
                echo "<td>" . $row['type'] . "</td>";
                if ($_SESSION['act'] == 'true') {
                    echo '<td><a  href="update.php?id=' . $row['master_id'] . '">Update</a><br/>';
                    echo '<a  href="delete.php?id=' . $row['master_id'] . '&substance=' . $row['filename'] . '">Delete</a>';
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


