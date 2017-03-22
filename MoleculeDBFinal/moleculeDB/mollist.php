<?php include('include/header.php') ?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
    <link rel="stylesheet" type="text/css" href="css/datatable.css" media="screen"/>
    <style>
        table {
            max-width: 90%;
            /*width: 100% !important;*/
        }
    </style>
    <!--javascript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <!--add column level search-->
    <script>
        //for select
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#listmol tfoot th').each(function () {

                var title = $(this).text();
                if (title != '') {
                    $(this).html('<input type="text" size="1" />');
                }
            });

            // DataTable
            var table = $('#listmol').DataTable();
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


            table.columns([4, 5, 6]).every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });

            });
        });

    </script>
    <script>
        $(document).ready(function () {
            var t = document.getElementById("listmol");
            var trs = t.getElementsByTagName("tr");
            var tds = null;

            for (var i = 0; i < trs.length; i++) {
                tds = trs[i].getElementsByTagName("td");
                for (var n = 0; n < trs.length; n++) {
                    tds[n].onclick = function () {
                        alert(this.id);
                    }
                }
            }
        }
    </script>
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
        <table id="listmol" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Substance</th>
                <th nowrap>CAS-No</th>
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
                echo "<tr style='text-align: left'>";
                echo "<td>" . $row['master_id'] . "</td>";
                echo "<td><a href='moldetail.php?id=" . $row['master_id'] . "'>"
                    . preg_replace('/[0-9]+/', '<sub>$0</sub>', $row['filename'])
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


