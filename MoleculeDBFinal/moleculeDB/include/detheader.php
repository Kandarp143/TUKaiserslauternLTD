<style>
    th, td {
        padding: 4px;
    }
</style>
<?php
$sql = 'SELECT master_id,filename,cas_no,name,
                        bibtex_key,model_type,type,description 
                        FROM pm_master where master_id = ' . $master_id;
$name = null;
foreach ($pdo->query($sql) as $row) {
    $name = $row['name'];
}
?>

<h1 class="title"><?php echo $name ?></h1>
<div class="entry">
    <table>
        <?php
        foreach ($pdo->query($sql) as $row) {
            $substance = $row['filename'];
            echo "<tr style='text-align: left'><th>Substance</th><td>" . toSubstanceTitle($substance) . "</td></tr>";
            echo "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Reference</th><td>[" . $row['bibtex_key'] . "]</td></tr>";
            echo "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
        }
        ?>
    </table>
</div>