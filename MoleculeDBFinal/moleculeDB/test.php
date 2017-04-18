<?php include('include/header.php') ?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"
          media="screen"/>
    <!--javascript-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
            // DataTable
            var table = $('#example').DataTable(

            );

            $('#example tfoot tr').appendTo('#example thead');
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
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Substance</th>
        <th>CAS-No</th>
        <th>Name</th>
        <th>Model Type</th>
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
        <th>Type</th>
        <?php if ($_SESSION['act'] == 'true') { ?>
            <th>Action</th>
        <?php } ?>

    </tr>
    </tfoot>
    <tbody>
    <!-- db thing-->
    <?php
    include 'database.php';
    $pdo = Database::connect();
    $sql = 'SELECT master_id, SUBSTRING(filename,1,POSITION("." IN filename)-1) as filename,cas_no,name,model_type,type FROM pm_master';
    foreach ($pdo->query($sql) as $row) {
        echo "<tr style='text-align: left'>";
        echo "<td>" . $row['master_id'] . "</td>";
        echo "<td><a href='moldetail.php?id=" . $row['master_id'] . "'>" . $row['filename'] . "</a></td>";
        echo "<td nowrap>" . $row['cas_no'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['model_type'] . "</td>";
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
</body>
</html>





