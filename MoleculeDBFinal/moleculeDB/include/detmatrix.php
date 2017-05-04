<?php
$returnArray = makeZmatrix($master_id);
$zmatrix = $returnArray['zmatrix'];
$pmatrix = $returnArray['pmatrix'];
$maker = $returnArray['maker'];
?>

<h3 style="color: #2b2b2b"><b>Geometry in Z-Matrix</b></h3>

<table width="70%">
    <tr style="border-bottom: solid 1px grey;">
        <td><b>Site-ID</b></td>
        <td><b>Site-name</b></td>
        <td><b>Ref.</b></td>
        <td><b>Distance / <span>&#8491;</span></b></td>
        <td><b>Ref</b></td>
        <td><b>Angle / <span>&#xb0;</span></b></td>
        <td><b>Ref</b></td>
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
            <td><?php echo $z[1] ?></td>
            <td><?php echo toSubstanceTitle($z[2]) ?></td>
            <td><?php echo $z[3] ?></td>
            <td><?php echo $z[4] ?></td>
            <td><?php echo $z[5] ?></td>
            <td><?php echo $z[6] ?></td>
            <td><?php echo $z[7] ?></td>
            <td><?php echo $z[8] ?></td>
            <?php
            if (array_key_exists($z[1], $maker)) {
                $fsize = $maker[$z[1]];
                $fsize = 25 * $fsize;
                $fwidth = $fsize / 4;
                $fsize = $fsize . 'px';
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


<h3 style="color: #2b2b2b;margin-top: 5%"><b>Interaction Parameters</b></h3>


<table width="70%">
    <?php
    foreach ($pmatrix as $z):?>
        <?php if (array_key_exists($z[1], $maker)) {
            $isheader = true; ?>
            <tr>
                <td></td>
            </tr>
        <?php } ?>
        <?php if ($isheader) { ?>
            <tr style="border-bottom: solid 1px grey;">
                <?php foreach ($z[2] as $paramName => $value):
                    ?>
                    <td><b><?php echo toCustomHeader($paramName) ?></b></td>
                    <?php
                endforeach; ?>
            </tr>
        <?php }
        $isheader = false; ?>
        <tr>
            <?php foreach ($z[2] as $paramName => $value):
                ?>
                <td><?php echo
                    $paramName == 'SiteName' ? toSubstanceTitle($value) : $value;
                    ?>
                </td>
                <?php
            endforeach; ?>
            <?php
            if (array_key_exists($z[1], $maker)) {
                $fsize = $maker[$z[1]];
                $fsize = 25 * $fsize;
                $fwidth = $fsize / 3.0;
                $fwidth = $fwidth . 'px';
                $fsize = $fsize . 'px';
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