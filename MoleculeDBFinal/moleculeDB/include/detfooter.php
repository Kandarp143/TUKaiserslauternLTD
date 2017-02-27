<?php
$bibq = "SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key 
WHERE pm_master.master_id =" . $master_id . ";";
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
    $tit = $row['bib_title'];
}
echo '[' . $tit . ']  ' . $Author . ' : '
    . $bib_title . ', ' . $Journal . $Volume . ', '
    . $Number . ', ' . $Pages . ' (' . $Year . ')'
?>