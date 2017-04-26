<?php

/*prepareing display array*/
$zmatrix = makeZmatrix($master_id);
$pmatrix = $zmatrix [1];
unset($zmatrix[1]);
//$maker array for making dynamic rowspan and bracket
$maker = null;
$mk = null;
$i = 0;
$len = count($zmatrix);
$temp = $zmatrix[0][0];
foreach ($zmatrix as $z):
    if ($i == 0) {
        $mk[] = $z[1];
    }
    if ($i == $len - 1) {
        $mk[] = $z[1];
    }
    $i++;
    if ($temp != $z[0]) {
        $mk[] = $z[1];
        $temp = $z[0];
    }
endforeach;
//var_dump($mk);

for ($i = 0; $i <= sizeof($mk) - 2; $i++) {
    $key = $mk[$i];
    $val = $mk[$i + 1] - $mk[$i] + 1;
//    echo 'Key : ' . $key . ' Value : ' . $val . '</br>';
    $maker[$key] = $val;
}
?>
<h3 style="color: #2b2b2b"><b>Geometry in Z-Matrix</b></h3>

<table>
    <tr>
        <td><b>Site</b></td>
        <td><b>SiteName</b></td>
        <td><b>Ref</b></td>
        <td><b>Distance</b></td>
        <td><b>Ref</b></td>
        <td><b>Angle</b></td>
        <td><b>Ref</b></td>
        <td><b>DiHedral</b></td>


    </tr>
    <?php
    foreach ($zmatrix as $z):?>
        <?php if (array_key_exists($z[1], $maker)) { ?>
            <tr>
                <td colspan="8"></td>
            </tr>

        <?php } ?>
        <tr>
            <td><?php echo $z[1] ?></td>
            <td><?php echo preg_replace('/[0-9]+/', '<sub>$0</sub>', $z[2]) ?></td>
            <td><?php echo $z[3] ?></td>
            <td><?php echo $z[4] ?></td>
            <td><?php echo $z[5] ?></td>
            <td><?php echo $z[6] ?></td>
            <td><?php echo $z[7] ?></td>
            <td><?php echo $z[8] ?></td>
            <?php
            if (array_key_exists($z[1], $maker)) {
                $fsize = $maker[$z[1]];
                var_dump($maker);
                var_dump($fsize);
                $fsize = 25 * $fsize;
                $fsize = $fsize . 'px';
                $fwidth = $fsize / 4;
                $fwidth = $fwidth . 'px';
                ?>
                <td rowspan=" <?php echo $maker[$z[1]] ?>">

                    <img src="img/bracket.png"
                         style=" height: <?php echo $fsize; ?>;width: <?php echo $fwidth; ?>">
                </td>
                <td rowspan=" <?php echo $maker[$z[1]] ?>"><b><?php echo $z[0] ?></b>
                </td>
            <?php } ?>
        </tr>

        <?php
    endforeach; ?>
</table>


<h3 style="color: #2b2b2b;margin-top: 5%"><b>Interaction Perameters</b></h3>

<table>
    <?php
    foreach ($pmatrix as $z):?>
        <?php if (array_key_exists($z[1], $maker)) {
            $isheader = true; ?>
            <tr>
                <td></td>
            </tr>

        <?php } ?>
        <?php if ($isheader) { ?>
            <tr>
                <?php foreach ($z[2] as $paramName => $value):
                    ?>
                    <td><b><?php echo $paramName ?></b></td>
                    <?php
                endforeach; ?>
            </tr>
        <?php }
        $isheader = false; ?>
        <tr>
            <?php foreach ($z[2] as $paramName => $value):
                ?>
                <td><?php echo
                    $paramName == 'SiteName' ? preg_replace('/[0-9]+/', '<sub>$0</sub>', $value) : $value;
                    ?>
                </td>
                <?php
            endforeach; ?>
            <?php
            if (array_key_exists($z[1], $maker)) {
                $fsize = $maker[$z[1]];
                $fsize = 25 * $fsize;
                $fsize = $fsize . 'px';
                $fwidth = $fsize / 3.0;
                $fwidth = $fwidth . 'px';
                ?>
                <td rowspan=" <?php echo $maker[$z[1]] ?>">

                    <img src="img/bracket.png"
                         style=" height: <?php echo $fsize; ?>;width: <?php echo $fwidth; ?>">
                </td>
                <td rowspan=" <?php echo $maker[$z[1]] ?>"><b><?php echo $z[0] ?></b>
                </td>
            <?php } ?>
        </tr>
        <?php
    endforeach; ?>
</table>