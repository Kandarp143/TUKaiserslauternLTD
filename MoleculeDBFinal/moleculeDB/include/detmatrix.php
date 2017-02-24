<?php

//declaring variables
$points = array();
$vectors = array();
$angles = array();
$fiangles = array();

//getting co-ordinates from database
$pdo = Database::connect();
$query = "SELECT * FROM pm_detail WHERE master_id =" . $master_id . " AND site_type LIKE 'LJ%'";
$count = 0;
$point;


//saving points to array
foreach ($pdo->query($query) as $row) {
    if ($row['param'] == 'x') {
        $count++;
        $site = $row['site'];
        $x = $row['val'];

        $point = new Vec();
        $point->setId($count);

        $point->setName($site);
        $point->setX($x);

        array_push($points, $point);
    } else if ($row['param'] == 'y') {
        $point->setY($row['val']);
    } else if ($row['param'] == 'z') {
        $point->setZ($row['val']);
    }

}

//making vector & distance
for ($i = 0; $i <= sizeof($points) - 2; $i++) {

    $vector = new Vec();
    $p1 = $points[$i];
    $p2 = $points[$i + 1];
    $vector->subVec($p2, $p1);
    $vector->setId($i + 1);
    $len = $vector->len();
    $vector->setLength($len);
    array_push($vectors, $vector);
//    echo $vector->getId() . ' ' . $p2->getZ() . ' - '
//        . $p1->getZ() . '=' . $vector->getZ() . ' & Length = ' . $vector->getLength() . '<br/>';
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
    $fiangle = $vector->arcsin($vector, $v3);
    array_push($fiangles, $fiangle);
//    echo 'FiAngle : ' . $fiangle . '<br/>';

}

//prepareing display array
$zmatrix = array();
for ($i = 0; $i <= sizeof($points) - 1; $i++) {
    //down to top
    if ($i > 2) {
        array_push($zmatrix, array($points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), $i - 1, round($angles[$i - 2], 4), $i - 2, round($fiangles[$i - 3], 4)));
    } else if ($i > 1) {
        array_push($zmatrix, array($points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), $i - 1, round($angles[$i - 2], 4), "-", "-"));
    } else if ($i > 0) {
        array_push($zmatrix, array($points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLength(), 4), "-", "-", "-", "-"));
    } else {
        array_push($zmatrix, array($points[$i]->getName(), "-", "-", "-", "-", "-", "-"));
    }
}
?>
<table class="datagrid" style="width: 50%;font-weight: 200;font-size: medium">
    <?php foreach ($zmatrix as $z): ?>
        <tr>
            <td><?php echo $z[0] ?></td>
            <td><?php echo $z[1] ?></td>
            <td><?php echo $z[2] ?></td>
            <td><?php echo $z[3] ?></td>
            <td><?php echo $z[4] ?></td>
            <td><?php echo $z[5] ?></td>
            <td><?php echo $z[6] ?></td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>
