<!DOCTYPE html>

<html lang="en" class="gr__v4-alpha_getbootstrap_com">

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
        $master_id = $_GET['id'];
        ?>
        <h5> ------------------- Header-----------------</h5>
        <table>
            <?php
            $q = "select DISTINCT  * from master_entry where master_id = " . $master_id . ";";
            $result = mysql_query($q, $db_handle);
            while ($row = mysql_fetch_assoc($result)) {

                echo "<tr style='text-align: left'><th>File Name</th><td>" . $row['filename'] . "</td></tr>";
                echo "<tr style='text-align: left'><th>CAS NO</th><td>" . $row['cas_no'] . "</td></tr>";
                echo "<tr style='text-align: left'><th>Name</th><td>" . $row['name'] . "</td></tr>";
                echo "<tr style='text-align: left'><th>Bibtex Key</th><td>" . $row['bibtex_key'] . "</td></tr>";
                echo "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";

            }
            ?>
        </table>
        <h5> ------------------- Detail-----------------</h5>
        <?php
        $q = "select DISTINCT site_type from master_detail where master_id =" . $master_id . ";";
        $result = mysql_query($q, $db_handle);
        // Print the column names as the headers of a table
        echo "<table><tr>";
        // Print the data
        while ($row = mysql_fetch_row($result)) {
            echo "<tr>";
            foreach ($row as $_column) {
                echo "<th>Site Type :</th><th>{$_column}</th>";
                $q2 = "SELECT  param,val from master_detail where site_type = '{$_column}' and master_id=" . $master_id . ";";
                $result2 = mysql_query($q2, $db_handle);
                // Print the data
                while($row = mysql_fetch_row($result2)) {
                    echo "<tr>";
                    foreach($row as $_column) {
                        echo "<td style='text-align: left'>{$_column}</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>


        <?php

        ?>

    </div>

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include 'include/bootcore.php'; ?>
</body>
</html>