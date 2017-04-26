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