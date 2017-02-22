<?php include('include/header.php') ?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">

            <div class="post">
                <!--                molecule header part-->
                <h1 class="title">Molecule Header </h1>
                <div class="entry">
                    <table>
                        <?php
                        include 'database.php';
                        $master_id = $_GET['id'];
                        $pdo = Database::connect();
                        $sql = 'SELECT master_id,SUBSTRING(filename,1,POSITION("." IN filename)-1) as filename,cas_no,name,
                        SUBSTRING_INDEX(substr(bibtex_key,instr(bibtex_key,"{") + 1),"}", 1) as bib_key,model_type,type,description 
                        FROM pm_master where master_id = ' . $master_id;
                        foreach ($pdo->query($sql) as $row) {
                            echo "<tr style='text-align: left'><th>Substance</th><td>" . $row['filename'] . "</td></tr>";
                            echo "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
                            echo "<tr style='text-align: left'><th>Name</th><td>" . $row['name'] . "</td></tr>";
                            echo "<tr style='text-align: left'><th>Reference</th><td>[" . $row['bib_key'] . "]</td></tr>";
                            echo "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
                            echo "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
                            echo "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
                            $mst_ref = '[' . $row['bib_key'] . ']';

                        }
                        ?>
                    </table>
                </div>

                <!--                molecule detail part-->
                <h1 class="title">Molecule Detail </h1>
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
                <?php
                $bibq = "SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key WHERE pm_master.master_id =" . $master_id . ";";
                foreach ($pdo->query($bibq) as $row) {
                    if ($row['param'] == 'Author') {
                        $Author = $row['value'];
                    } else if ($row['param'] == 'Journal') {
                        $Journal = $row['value'];
                    } else if ($row['param'] == 'Volume') {
                        $Volume = $row['value'];
                    } else if ($row['param'] == 'Number') {
                        $Number = $row['value'];
                    } else if ($row['param'] == 'Pages') {
                        $Pages = $row['value'];
                    } else if ($row['param'] == 'Year') {
                        $Year = $row['value'];
                    } else if ($row['param'] == 'Title') {
                        $bib_title = $row['value'];
                    }
                    $bib_type = $row['bib_type'];
                }
                ?>
                <!--                molecule Reference part-->
                <h1 class="title">References</h1>
                <div class="entry">
                    <p>
                        <strong>
                            <?php echo $mst_ref . ' ' . $Author . ' : ' . $bib_title . ', ' . $Journal . $Volume . ', ' . $Number . ', ' . $Pages . ' (' . $Year . ')' ?>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
        <!-- end #content -->
        <div style="clear:both; margin:0;"></div>
    </div>
    <!-- end #page -->
</div>

<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>

