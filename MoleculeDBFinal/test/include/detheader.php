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
            if (0 === strpos($substance, 'R')) {
                preg_match('~[a-z]~i', substr($substance, 1), $match, PREG_OFFSET_CAPTURE);
                $left = substr($substance, 0, $match[0][1] + 1);
                $right = substr($substance, $match[0][1] + 1);
                $substance = $left . preg_replace('/[0-9]+/', '<sub>$0</sub>', $right);
            } else {
                $substance = preg_replace('/[0-9]+/', '<sub>$0</sub>', $row['filename']);
            }
            echo "<tr style='text-align: left'><th>Substance</th><td>" . $substance . "</td></tr>";
            echo "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Reference</th><td>[" . $row['bibtex_key'] . "]</td></tr>";
            echo "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
            echo "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
        }
        ?>
    </table>
</div>