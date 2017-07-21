<?php
$returnArray = makeZmatrix($master_id, $disp_sh);
$zmatrix = $returnArray['zmatrix'];
$pmatrix = $returnArray['pmatrix'];
$maker = $returnArray['maker'];
$maker2 = $returnArray['maker2'];
?>

<h3 style="color: #2b2b2b"><b>Geometry in Z-Matrix</b></h3>

<table width="80%">
    <tr style="border-bottom: solid 1px grey;">
        <td><b>Site-ID</b></td>
        <td><b>Site-name</b></td>
        <td><b>Ref.</b></td>
        <td><b>Distance / <span>&#8491;</span></b></td>
        <td><b>Ref.</b></td>
        <td><b>Angle / <span>&#xb0;</span></b></td>
        <td><b>Ref.</b></td>
        <td><b>Dihedral / <span>&#xb0;</span></b></td>
    </tr>
    <?php
    foreach ($zmatrix as $z):?>
        <?php if (array_key_exists($z[1], $maker)) { ?>
            <tr>
                <td colspan="8"></td>
            </tr>
        <?php } ?>
        <tr>
            <td><?php echo $z[9] ?></td>
            <td><?php echo toSubstanceTitle($z[2]) ?></td>
            <td><?php echo $z[3] ?></td>
            <td><?php echo $z[4] ?></td>
            <td><?php echo $z[5] ?></td>
            <td><?php echo $z[6] ?></td>
            <td><?php echo $z[7] ?></td>
            <td><?php echo $z[8] ?></td>
            <?php
            if (array_key_exists($z[1], $maker)) {
//                echo '$maker[$z[1]] : ' . $maker[$z[1]];
                $fsize = $maker[$z[1]];
                $fsize = 25 * $fsize;
                $maker[$z[1]] < 3 ? $fwidth = 30 : $fwidth = 40;
                $fsize = $fsize . 'px';
                $fwidth = $fwidth . 'px';
                ?>
                <td rowspan=" <?php echo $maker[$z[1]] ?>">
                    <img src="img/bracket.png"
                         style=" height: <?php echo $fsize; ?>;width: <?php echo $fwidth; ?>">
                </td>
                <td rowspan=" <?php echo $maker[$z[1]] ?>"><b><?php echo toFormatSiteType($z[0]) ?></b>
                </td>
            <?php } ?>
        </tr>

        <?php
    endforeach; ?>
</table>


<h3 style="color: #2b2b2b;margin-top: 5%"><b>Interaction Parameters</b></h3>


<table width="80%">
    <?php $isheader = false;
    foreach ($pmatrix as $z):?>
        <?php if (array_key_exists($z[1], $maker2)) {
            $isheader = true; ?>
            <tr>
                <td></td>
            </tr>
        <?php }
        if ($isheader) { ?>
            <tr style="border-bottom: solid 1px grey;">
                <?php foreach ($z[2] as $paramName => $value) { ?>
                    <td><b><?php echo toCustomHeader($paramName) ?></b></td>
                <?php } ?>
            </tr>
        <?php }
        $isheader = false; ?>
        <tr>
            <?php foreach ($z[2] as $paramName => $value) { ?>
                <td><?php echo $paramName == 'SiteName' ? toSubstanceTitle($value) : $value; ?>
                </td>
            <?php }
            if (array_key_exists($z[1], $maker2)) {
                $fsize = $maker2[$z[1]];
                $fsize = 25 * $fsize;
                $maker2[$z[1]] < 3 ? $fwidth = 30 : $fwidth = 40;
                $fwidth = $fwidth . 'px';
                $fsize = $fsize . 'px';
                ?>
                <td rowspan=" <?php echo $maker2[$z[1]] ?>">
                    <img src="img/bracket.png"
                         style=" height: <?php echo $fsize; ?>;width: <?php echo $fwidth; ?>">
                </td>
                <td rowspan=" <?php echo $maker2[$z[1]] ?>"><b><?php echo toFormatSiteType($z[0]) ?></b>
                </td>
            <?php } ?>
        </tr>
        <?php
    endforeach; ?>
</table>