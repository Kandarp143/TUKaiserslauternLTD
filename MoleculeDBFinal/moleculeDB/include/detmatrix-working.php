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

$st = null;
//
//foreach ($zmatrix as $z) {
//    $st[] = $z[0];
//
//}
//var_dump($st);
//if (sizeof($st > 0)) {
////remove duplicate
//    $st = array_unique($st);
////re numbering keys
//    $st = array_values($st);
//}
?>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<h4><b>Geometry in Z-Matrix</b></h4>
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
        <td><b>SiteType</b></td>
    </tr>

    <?php
    $i = 0;
    $temp = $st[$i];
    foreach ($zmatrix as $z):
        if ($temp != $z[0]) { ?>
            <tr>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td colspan="7"></td>
            </tr>

            <?php if ($i < sizeof($st))
                $temp = $st[$i + 1];
        } ?>
        <tr>


            <td><?php echo $z[1] ?></td>
            <td><?php echo $z[2] ?></td>
            <td><?php echo $z[3] ?></td>
            <td><?php echo $z[4] ?></td>
            <td><?php echo $z[5] ?></td>
            <td><?php echo $z[6] ?></td>
            <td><?php echo $z[7] ?></td>
            <td><?php echo $z[8] ?></td>
            <td><?php echo $z[0] ?></td>
        </tr>
        </tbody>
        <?php
    endforeach; ?>
</table>

<table>
    <tr>
        <td>123</td>
        <td>123</td>
        <td>123</td>
        <td rowspan="2">}</td>
    </tr>
    <tr>
        <td>123</td>
        <td>123</td>
        <td>123</td>
    </tr>
</table>
