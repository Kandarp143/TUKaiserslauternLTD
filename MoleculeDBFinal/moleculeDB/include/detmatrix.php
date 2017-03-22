<?php

//declaring variables
$points = array();
$vectors = array();
$angles = array();
$fiangles = array();

//getting co-ordinates from database
$pdo = Database::connect();
//$query = "SELECT * FROM pm_detail WHERE master_id =" . $master_id . " AND site_type LIKE 'LJ%'";
$query = "SELECT * FROM pm_detail WHERE master_id =" . $master_id;
$count = 0;
$point;


//saving points to array
foreach ($pdo->query($query) as $row) {
    if ($row['param'] == 'x') {
        $count++;
        $site = $row['site'];
        $sitetype = $row['site_type'];
        $x = $row['val'];

        $point = new Vec();
        $point->setId($count);

        $point->setName($site);
        $point->setSitetype($sitetype);
        $point->setX($x);

        array_push($points, $point);
    } else if ($row['param'] == 'y') {
        $point->setY($row['val']);
    } else if ($row['param'] == 'z') {
        $point->setZ($row['val']);
    }

}

//foreach ($points as $p) {
//    echo 'Point' . $p->getName() . ': (' . $p->getX() . ',' . $p->getY() . ',' . $p->getZ() . ')<br/>';
//}

//making vector & distance
for ($i = 0; $i <= sizeof($points) - 2; $i++) {
    $vector = new Vec();
    $p1 = $points[$i];
    $p2 = $points[$i + 1];
    $vector->subVec($p2, $p1);
    $vector->vround();
    $vector->setId($i + 1);
    $len = $vector->len();
    $vector->setLength($len);
    array_push($vectors, $vector);
//    echo $vector->getId() . ' ' . $p2->getZ() . ' - '
//        . $p1->getZ() . '=' . $vector->getZ() . ' & Length = ' . $vector->getLength() . '<br/>';
//    echo 'Vector' . $vector->getId() . ': (' . $vector->getX() . ',' . $vector->getY() . ',' . $vector->getZ() . ')<br/>';
//    echo 'Length :' . $vector->getLength() . '</br>';
}

//angles
for ($i = 0; $i <= sizeof($vectors) - 2; $i++) {
    $vector = new Vec();
    $v1 = $vectors[$i];
    $v2 = $vectors[$i + 1];
    $angle = $vector->arccos($v1, $v2);
    array_push($angles, $angle);
//    echo 'Angle : ' . $angle . '<br/>';

}
//fiangles
for ($i = 0; $i <= sizeof($vectors) - 3; $i++) {
    $vector = new Vec();
    $v1 = $vectors[$i];
    $v2 = $vectors[$i + 1];
    $v3 = $vectors[$i + 2];
    $vector->crossVec($v1, $v2);
//    echo 'ARC Sine <br/>';
//    echo 'Vector' . $vector->getId() . ': (' . $vector->getX() . ',' . $vector->getY() . ',' . $vector->getZ() . ')<br/>';
    $fiangle = $vector->arcsin($vector, $v3);
    array_push($fiangles, $fiangle);
//    echo 'FiAngle : ' . $fiangle . '<br/>';

}

//prepareing display array
$zmatrix = array();
for ($i = 0; $i <= sizeof($points) - 1; $i++) {
    //down to top
    if ($i > 2) {
        array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), $i - 1, round($angles[$i - 2], 4), $i - 2, round($fiangles[$i - 3], 4)));
    } else if ($i > 1) {
        array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), $i - 1, round($angles[$i - 2], 4), "-", "-"));
    } else if ($i > 0) {
        array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), "-", "-", "-", "-"));
    } else {
        array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), "-", "-", "-", "-", "-", "-"));
    }
}

//$maker = array("1" => "7", "8" => "1", "9" => 13 - 9 + 1, "14" => 19 - 14 + 1, "20" => 25 - 20 + 1);
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
    $val = $mk[$i + 1] - $mk[$i];
//    echo 'Key : ' . $key . ' Value : ' . $val . '</br>';
    $maker[$key] = $val;
}


?>
<h3 style="color: #2b2b2b"><b>Geometry in Z-Matrix</b></h3>

<table style="width:70%">
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
            <tr>
                <td colspan="8"></td>
            </tr>
        <?php } ?>
        <tr>
            <td><?php echo $z[1] ?></td>
            <td><?php echo $z[2] ?></td>
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
                $fsize = $fsize . 'px';
                ?>
                <td rowspan=" <?php echo $maker[$z[1]] ?>">

                    <img src="img/bracket.png"
                         style=" height: <?php echo $fsize; ?>;">
                </td>
                <td rowspan=" <?php echo $maker[$z[1]] ?>"><b><?php echo $z[0] ?></b>
                </td>
            <?php } ?>
        </tr>

        <?php
    endforeach; ?>
</table>
