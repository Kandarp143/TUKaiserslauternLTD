<?php include('include/header.php') ?>
<html>
<head>
    <?php include('include/links.php') ?>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
    <h2>Following molecule has been deleted from database.</h2>
    <div class="post">
        <!--                molecule header part-->
        <h2 class="title">Molecule Header </h2>
        <div class="entry">
            <table>
                <?php
                include 'database.php';
                $master_id = $_GET['id'];
                $pdo = Database::connect();
                $sql = "select DISTINCT  * from pm_master where master_id = " . $master_id . ";";
                foreach ($pdo->query($sql) as $row) {
                    echo "<tr style='text-align: left'><th>Substance</th><td>" . $row['filename'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>Name</th><td>" . $row['name'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>Reference</th><td>" . $row['bibtex_key'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
                    echo "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";

                }
                ?>
            </table>
        </div>

        <?php
        $bibq = "SELECT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key WHERE pm_master.master_id =" . $master_id . ";";
        foreach ($pdo->query($bibq) as $row) {
            $bib_type = $row['bib_type'];
            $bib_title = $row['bib_title'];
        }
        ?>
        <!--                molecule Reference part-->
        <h2 class="title">References <?php echo ' @ ' . $bib_type . ' : ' . $bib_title ?></h2>
        <div class="entry">
            <table>
                <?php
                foreach ($pdo->query($bibq) as $row) {
                    echo "<tr style='text-align: left'><th>" . $row['param'] . "</th><td>" . $row['value'] . "</td></tr>";
                }
                ?>
            </table>
        </div>

        <!--                molecule detail part-->
        <h2 class="title">Molecule Detail </h2>
        <div class="entry">
            <?php
            $q = "select DISTINCT site_type from pm_detail where master_id =" . $master_id . ";";
            $stmt = $pdo->query($q);
            // Print the column names as the headers of a table
            echo "<table><tr>";
            // Print the data
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($row as $_column) {
                    echo "<th>Site Type :</th><th>{$_column}</th>";
                    $q2 = "SELECT  param,val from pm_detail where site_type = '{$_column}' and master_id=" . $master_id . ";";
                    $stmt2 = $pdo->query($q2);
                    // Print the data
                    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($row as $_column) {
                            echo "<td style='text-align: left'>{$_column}</td>";
                        }
                        echo "</tr>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
        </div>
    </div>
</div>
</div>
</body>
</html>
