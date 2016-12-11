<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Welcome to Molecule</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

    <!-- Datatables  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</head>
<body data-gr-c-s-loaded="true">
<?php include 'include/nav.php'; ?>

<div class="container">
    <div class="starter-template">
        <?php
        $user_name = "root";
        $password = "admin";
        $database = "molecule_db";
        $server = "127.0.0.1";

        $db_handle = mysql_connect($server, $user_name, $password);
        $db_found = mysql_select_db($database, $db_handle);
        ?>
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>CAS NO</th>
                <th>Name</th>
                <th>Bibtex Key</th>
                <th>Model Type</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $q = "select * from master_entry;";
            $result = mysql_query($q, $db_handle);
            while ($row = mysql_fetch_assoc($result)) {
                echo "<tr style='text-align: left'>";
                echo "<td>" . $row['master_id'] . "</td>";
                echo "<td>" . $row['filename'] . "</td>";
                echo "<td>" . $row['cas_no'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['bibtex_key'] . "</td>";
                echo "<td>" . $row['model_type'] . "</td>";
                echo "<td><a href='moldetail.php?id=" . $row['master_id'] . "'> Click </a> </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>