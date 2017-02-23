<table>
    <?php
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
         