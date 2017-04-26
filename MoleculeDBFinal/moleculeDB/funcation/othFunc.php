<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/26/2017
 * Time: 4:37 PM
 */

function toSubstanceTitle($substance)
{
    $left = '';
    $mid = '';
    $right = '';

    //if string start with R
    if (0 === strpos($substance, 'R')) {
        //getting next char with index
        preg_match('~[a-z]~i', substr($substance, 1), $match, PREG_OFFSET_CAPTURE);

        $left = substr($substance, 0, $match[0][1] + 1);
        $substance = substr($substance, $match[0][1] + 1);
    }
    //if string end with ()
    if (strlen($substance) - 1 === strpos($substance, ')')) {
        //getting next char with index
        $pos = strpos($substance, '(');
        $right = substr($substance, $pos);
        $substance = substr($substance, 0, $pos - 1);
        //removeing spaces
        $substance = trim($substance);
    }

    //still if string end with (+ or -)
    if (strlen($substance) - 1 === strpos($substance, '+') || strlen($substance) - 1 === strpos($substance, '-')) {
        //getting one char before + or -
        $mid = substr($substance, strlen($substance) - 2);
        $substance = substr($substance, 0, strlen($substance) - 2);

    }
    //make numaric subscript
    $substance = $left . preg_replace('/[0-9]+/', '<sub>$0</sub>', $substance) . $mid . $right;
    return trim($substance);
}

function referenceMessage($masterId)
{
    $db = new Database();
    $refs = $db->selectRecords('SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key 
WHERE pm_master.master_id =?', array($masterId));
    $Number = 0;
    $Author = 0;
    $Journal = 0;
    $Volume = 0;
    $Number = 0;
    $Pages = 0;
    $Year = 0;
    $tit = 0;
    if (!empty($refs)) {
        foreach ($refs as $row) {
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
        return '[' . $tit . ']  ' . $Author . ' : '
            . $bib_title . ', ' . $Journal . $Volume . ', '
            . $Number . ', ' . $Pages . ' (' . $Year . ')';
    } else {

        return 'No reference found !';
    }
}


function makeZmatrix($masterId)
{

    /*declaring variables*/
    $points = array();
    $vectors = array();
    $angles = array();
    $fiangles = array();
    $count = 0;
    $point = null;
    $oth = null;
    $del_val = 'del_val';

    $db = new Database();
    /*getting co-ordinates from database*/
    $refs = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($masterId));

    /*saving points to array*/
    foreach ($refs as $row) {
        if ($row['param'] == 'x') {
            //this is break point of each new point (x) cordinate
            //creating structure of array
            $oth = array(
                'Site' => $del_val,
                'SiteName' => $del_val,
                'Mass' => $del_val,
                'Epsilon' => $del_val,
                'Sigma' => $del_val,
                'Charge' => $del_val,
                'Dipole' => $del_val,
                'Quadrupole' => $del_val,
                'Theta' => $del_val,
                'Phi' => $del_val
            );
            $count++;
            $site = $row['site'];
            $sitetype = $row['site_type'];
            $x = $row['val'];

            $point = new Vec();
            $point->setId($count);

            $point->setName($site);
            $point->setSitetype($sitetype);
            $point->setX($x);

            //making table for other pera
            $oth['Site'] = $count;
            $oth['SiteName'] = $row['site'];
//        $oth['SiteType'] = $row['site_type'];

            array_push($points, $point);
        } else if ($row['param'] == 'y') {
            $point->setY($row['val']);
        } else if ($row['param'] == 'z') {
            $point->setZ($row['val']);
        } else if ($row['param'] == 'sigma'
            || $row['param'] == 'epsilon' || $row['param'] == 'charge' || $row['param'] == 'mass'
            || $row['param'] == 'shielding' || $row['param'] == 'theta' || $row['param'] == 'phi'
            || $row['param'] == 'quadrupole' || $row['param'] == 'dipole'
        ) {
            $oth[ucwords($row['param'])] = (string)round($row['val'], 4);
        }
        $point->setOth($oth);
    }

    /*removeing del_val*/
    foreach ($points as $p) {
        $tmp = $p->getOth();
        while (($key = array_search($del_val, $tmp))) {
            unset($tmp[$key]);
        }
        $p->setOth($tmp);
    }

    /*making vector & distance*/
    for ($i = 0; $i <= sizeof($points) - 2; $i++) {
        $vector = new Vec();
        $p1 = $points[$i];
        $p2 = $points[$i + 1];
        $vector->subVec($p2, $p1);
        $vector->setId($i + 1);
        $len = $vector->len();
        $vector->setLen($len);
        array_push($vectors, $vector);
//    echo $vector->getId() . ' ' . $p2->getZ() . ' - '
//        . $p1->getZ() . '=' . $vector->getZ() . ' & Length = ' . $vector->getLen() . '<br/>';
//    echo 'Vector' . $vector->getId() . ': (' . $vector->getX() . ',' . $vector->getY() . ',' . $vector->getZ() . ')<br/>';
//    echo 'Length :' . $vector->getLen() . '</br>';
    }

    /*angles*/
    for ($i = 0; $i <= sizeof($vectors) - 2; $i++) {
        $vector = new Vec();
        $v1 = $vectors[$i];
        $v2 = $vectors[$i + 1];
        $angle = $vector->angleXY($v1, $v2);
        array_push($angles, $angle);
//    echo 'Angle : ' . $angle . '<br/>';

    }
    /*fiangles*/
    for ($i = 0; $i <= sizeof($vectors) - 3; $i++) {
        $vector = new Vec();
        $v1 = $vectors[$i];
        $v2 = $vectors[$i + 1];
        $v3 = $vectors[$i + 2];
//    echo 'ARC Sine <br/>';
//    echo 'Vector' . $vector->getId() . ': (' . $vector->getX() . ',' . $vector->getY() . ',' . $vector->getZ() . ')<br/>';
        $fiangle = $vector->angleXYZ($v1, $v2, $v3);
        array_push($fiangles, $fiangle);
//    echo 'FiAngle : ' . $fiangle . '<br/>';

    }


    /*prepareing display array*/
    $zmatrix = array();
    $pmatrix = array();
    for ($i = 0; $i <= sizeof($points) - 1; $i++) {
        //down to top (z matrix)
        if ($i > 2) {
            array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLen(), 4), $i - 1, round($angles[$i - 2], 4), $i - 2, round($fiangles[$i - 3], 4)));
        } else if ($i > 1) {
            array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLen(), 4), $i - 1, round($angles[$i - 2], 4), "-", "-"));
        } else if ($i > 0) {
            array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), $vectors[$i - 1]->getId(), round($vectors[$i - 1]->getLen(), 4), "-", "-", "-", "-"));
        } else {
            array_push($zmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getName(), "-", "-", "-", "-", "-", "-"));
        }
        //p matrix
        array_push($pmatrix, array($points[$i]->getSitetype(), $i + 1, $points[$i]->getOth()));
    }
    /*adding other parameter array at 2nd position*/
    array_push($zmatrix, $pmatrix);


    return $zmatrix;
}


function Pmatrix($masterId)
{

}

function timeStamp()
{
    $now = new DateTime();
    $now->format('Y-m-d H:i:s');
    return $now->format('d-m-Y H:i:s');
}