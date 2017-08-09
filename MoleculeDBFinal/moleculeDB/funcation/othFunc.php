<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/26/2017
 * Time: 4:37 PM
 */


/*func to  format the site name by custom rule. */
function toSubstanceTitle($substance)
{
    //1.if {} - remove and change font
    //2.if start with R next number should be upstring
    //3.if () should be in upstring
    //4.if (+,-) one number before sign should be upstring
    //5.all remain string up and number substring
//    $substance2 = $substance;

    $substance = str_replace('{', '<span style="font-family: myFirstFont">', $substance);
    $substance = str_replace('}', ' </span>', $substance);
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
        $substance = substr($substance, 0, $pos);
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


//    return trim($substance2 . ' = ' . $substance);
    return $substance;
}

/*func to find if the site has ion (+.-) to display different in database */
function isSubstanceIonic($substance)
{

    if (strlen($substance) - 1 === strpos($substance, '+') || strlen($substance) - 1 === strpos($substance, '-'))
        return true;
    return false;

}

/*func to  format site type by custom role*/
function toFormatSiteType($siteType)
{
    if ($siteType === 'LJ126')
        $siteType = 'LJ 12- 6';
    return $siteType;
}

/*func to get formatted reference for given substance */
function referenceMessage($masterId)
{
    $db = new Database();
    $refs = $db->selectRecords('SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key 
WHERE pm_master.master_id =?', array($masterId));
    return referenceMessageMsg($refs);
}

function referenceMessageMsg($refs)
{
    $Author = '-';
    $Journal = '-';
    $Volume = 0;
    $Number = 0;
    $Pages = 0;
    $Year = '-';
    $tit = '-';
    $doi = '-';
    $url = '-';

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
            } else if ($row['param'] == 'Doi') {
                $doi = $row['value'];
            } else if ($row['param'] == 'Url') {
                $url = $row['value'];
            }
            $tit = $row['bib_title'];
        }
        return '[' . $tit . ']  ' . $Author . ': '
            . $bib_title . ', ' . $Journal . ', ' . $Volume . ', '
            . $Number . ', ' . $Pages . ' (' . $Year . '), <a href="' . $url . '" target="_blank" >' . $doi . '</a>.';
    } else {

        return 'No reference found !';
    }
}

function referenceParameter($refs, $parameter)
{
    $ans = '';

    if (!empty($refs)) {
        foreach ($refs as $row) {

            if ($parameter == 'bib_key' || $parameter == 'bib_title') {
                $ans = $row[$parameter];
            } else {
                if ($row['param'] == $parameter) {
                    $ans = $row['value'];
                }
            }
        }
        return $ans;
    } else {
        return 'No reference found !';
    }
}

function referenceTitle($refs)
{
    $Author = '-';
    $Journal = '-';
    $Volume = 0;
    $Number = 0;
    $Pages = 0;
    $Year = '-';
    $tit = '-';
    $doi = '-';
    $url = '-';
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
            } else if ($row['param'] == 'Doi') {
                $doi = $row['value'];
            } else if ($row['param'] == 'Url') {
                $url = $row['value'];
            }
            $tit = $row['bib_title'];
        }
        return '[' . $tit . ']  ' . $Author . ': '
            . $bib_title . ', ' . $Journal . ', ' . $Volume . ', '
            . $Number . ', ' . $Pages . ' (' . $Year . '), <a href="' . $url . '" target="_blank" >' . $doi . '</a>.';
    } else {

        return 'No reference found !';
    }
}

function referenceMessageKey($ref_id)
{
    $db = new Database();
    $refs = $db->selectRecords('SELECT DISTINCT * FROM pm_bib WHERE  pm_bib.bib_key =?', array($ref_id));
    return referenceMessageMsg($refs);
}

function referenceList()
{
    $db = new Database();
    $refs = $db->selectRecords('SELECT DISTINCT pm_bib.bib_key,pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
FROM pm_bib ORDER BY pm_bib.bib_key', null);
    $master_r = array();
    $new_r = array();
    $temp_id = 0;
    $i = 0;
    $numItems = count($refs);
    foreach ($refs as $r) {
        $i++;
        if ($r['bib_key'] != $temp_id) {
            array_push($master_r, $new_r);
            $new_r = array();
            $temp_id = $r['bib_key'];
        }
        array_push($new_r, $r);
        if ($i === $numItems) {
            //last loop
            array_push($master_r, $new_r);
        }
    }
    return $master_r;
}

/*func to generate Z-Matrix (Detail Page)  of molecule */
function makeZmatrix($masterId, $disp_sh)
{
    $retrunArray = array();

    //declaring variables
    $points = array();

    //getting co-ordinates from database
    $db = new Database();
    $result = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($masterId));

    $count = 0;
    $point = null;
    $oth = null;
    $del_val = 'del_val';

    //saving points to array
    foreach ($result as $row) {
        if ($row['param'] == 'x') {
            //this is break point of each new point (x) cordinate
            //creating structure of array
            $oth = array(
                'Site' => $del_val,
                'SiteName' => $del_val,
                'Mass' => $del_val,
                'Sigma' => $del_val,
                'Epsilon' => $del_val,
                'Charge' => $del_val,
                'Dipole' => $del_val,
                'Quadrupole' => $del_val,
                'Theta' => $del_val,
                'Phi' => $del_val,
                'Shielding' => $del_val
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

            array_push($points, $point);
        } else if ($row['param'] == 'y') {
            $point->setY($row['val']);
        } else if ($row['param'] == 'z') {
            $point->setZ($row['val']);
        } else if ($row['param'] == 'sigma'
            || $row['param'] == 'epsilon' || $row['param'] == 'charge' || $row['param'] == 'mass'
            || $row['param'] == 'theta' || $row['param'] == 'phi'
            || $row['param'] == 'quadrupole' || $row['param'] == 'dipole'
        ) {
            $oth[ucwords($row['param'])] = $row['val'];
        } else if ($row['param'] == 'shielding' && $disp_sh != 0) {
            $oth[ucwords($row['param'])] = $row['val'];
        }
        $point->setOth($oth);
    }

    //removeing del_val
    foreach ($points as $p) {
        $tmp = $p->getOth();
        while (($key = array_search($del_val, $tmp))) {
            unset($tmp[$key]);
        }
        $p->setOth($tmp);

        $p->setIsSame($points);
//        echo 'OLD Ponits :' . $p->getName() . '<br/>';
    }

    //prepareing display array
    $zmatrix = array();
    $pmatrix = array();
    $markerId = 0;

    $caller = new Vec();
//    echo '<pre>';
//    echo var_dump($points);
//    echo '</pre>';

    for ($i = 0; $i <= sizeof($points) - 1; $i++) {
        /*points*/
        $p1 = '-';
        $p2 = '-';
        $p3 = '-';
        $p4 = '-';
        /*reference*/
        $r1 = '-';
        $r2 = '-';
        $r3 = '-';
        $sign = 1;

        //init variables
        $p1 = isset($points[$i]) ? $points[$i] : '-';
        if ($i > 0) {
            //2nd point and distance (i=1)
            $r1 = $i;
            $p2 = $points[$i - 1];
        }
        if ($i > 1) {
            //3rd point and angle (i=2)
            $r2 = $i - 1;
            $p3 = $points[$i - 2];
        }
        if ($i > 2) {
            //4th point and dihiedral (i=3)
            $r3 = $i - 2;
            $p4 = $points[$i - 3];
            /*same reference check*/
            $rPoints = $caller->updateSamePoints(array($p2, $p3, $p4, $p1), $points);
            if (!empty($rPoints)) {
                $p3 = $rPoints[1];
                $key = array_search($p3, $points);
                $r2 = $key + 1;
                $p4 = $rPoints[2];
                $key = array_search($p4, $points);
                $r3 = $key + 1;
            }
            $sign = $caller->getAngleSign($p4, $p3, $p2, $p1, $sign);
        }

        $markerId += 1;
        /*if two points are lies on same co-ordinates*/
        if ($points[$i]->getIsSame()) {
            array_push($zmatrix, array($points[$i]->getSitetype(), $markerId, $points[$i]->getName(), $points[$i]->getRef(), 0, '-', '-', '-', '-', $i + 1));
        } else {
            array_push($zmatrix,
                array(
                    $points[$i]->getSitetype(),                                                                 /*Site-Type*/
                    $markerId,                                                                                  /*Site-ID*/
                    $points[$i]->getName(),                                                                     /*Site-name*/
                    $i > 0 ? $r1 : '-',                                                                         /*Ref.*/
                    $i > 0 ? round($caller->getDistance($p2, $p1), 4) : '-',                           /*Distance */
                    $i > 1 ? $r2 : '-',                                                                         /*Ref.*/
                    $i > 1 ? round($caller->getAngle($p3, $p2, $p1), 4) * $sign : '-',                 /*Angle*/
                    $i > 2 ? $r3 : '-',                                                                          /*Ref.*/
                    $i > 2 ? round($caller->getDihedral($p4, $p3, $p2, $p1), 4) : '-',                 /*Dihedral */
                    $i + 1
                ));

        }

        /*if site type is following then need to add new point*/
        if ($points[$i]->getSitetype() == 'Dipole' || $points[$i]->getSitetype() == 'Quadrupole') {
            /* ref point*/
            $p2 = $points[$i];
            /* new point*/
            $p1 = new Vec();
            $p1->setCordinatefromVec($p2);
            $p1->setName('dir.');
//            echo 'I' . $i . 'Dir' . '</br>';
            if ($i > 0) {
                $r1 = $i + 1;
            }
            if ($i > 1) {
                $r2 = $i;
                $p3 = $points[$i - 1];
            }
            if ($i > 2) {
                $r3 = $i - 1;
                $p4 = $points[$i - 2];
                /*same reference check*/
                $rPoints = $caller->updateSamePoints(array($p2, $p3, $p4, $p1), $points);
                if (!empty($rPoints)) {
                    $p3 = $rPoints[1];
                    $key = array_search($p3, $points);
                    $r2 = $key + 1;
//                    echo 'Before :' . $p4->getName();
                    $p4 = $rPoints[2];
//                    echo ' After :' . $p4->getName();
                    $key = array_search($p4, $points);
                    $r3 = $key + 1;

                }
                $sign = $caller->getAngleSign($p4, $p3, $p2, $p1, $sign);
            }

            $markerId += 1;
            array_push($zmatrix,
                array(
                    $points[$i]->getSitetype(),                                                            /*Site-Type*/
                    $markerId,                                                                              /*Site-ID*/
                    $p1->getName(),                                                                         /*Site-name*/
                    $i > 0 ? $r1 : '-',                                                                  /*Ref.*/
                    $i > 0 ? round($caller->getDistance($p2, $p1), 4) : '-',                        /*Distance */
                    $i > 1 ? $r2 : '-',                                                                      /*Ref.*/
                    $i > 1 ? round($caller->getAngle($p3, $p2, $p1) * $sign, 4) : '-',          /*Angle*/
                    $i > 2 ? $r3 : '-',                                                                  /*Ref.*/
                    $i > 2 ? round($caller->getDihedral($p4, $p3, $p2, $p1), 4) : '-',                      /*Dihedral */
                    null
                ));
        }


        //p matrix
        if (!empty($points[$i]->getOth())) {
            $tempOth = $points[$i]->getOth();
            if (array_key_exists('Phi', $tempOth)) {
                unset($tempOth['Phi']);
            }
            if (array_key_exists('Theta', $tempOth)) {
                unset($tempOth['Theta']);
            }
            array_push($pmatrix, array($points[$i]->getSitetype(), $i + 1, $tempOth));
        }

    }

    $temp = '';
    $mk = null;
    $mk2 = null;
    for ($i = 0; $i <= sizeof($zmatrix) - 1; $i++) {
        $siteType = $zmatrix[$i][0];
        $zId = $zmatrix[$i][1];
        $pId = empty($zmatrix[$i][9]) ? $zmatrix[$i - 1][9] : $zmatrix[$i][9];
        if ($temp !== $zmatrix[$i][0] && $pId !== 0) {
            $mk[] = $zId;
            $mk2[] = $pId;
            $temp = $siteType;
        }
        if ($i == sizeof($zmatrix) - 1) {
            //last
            $mk[] = $zId;
            $mk2[] = $pId;
        }
    }

    //$maker1 array for making dynamic rowspan and bracket
    $maker = null;
    for ($i = 0; $i <= sizeof($mk) - 2; $i++) {
        $key = $mk[$i];
        $val = $mk[$i + 1] - $mk[$i];
        if ($i == sizeof($mk) - 2) {
            $val += 1;
        }
        $maker[$key] = $val;
    }
    $maker2 = null;
    for ($i = 0; $i <= sizeof($mk2) - 2; $i++) {
        $key = $mk2[$i];
        $val = $mk2[$i + 1] - $mk2[$i];
        if ($i == sizeof($mk2) - 2) {
            $val += 1;
        }
        $maker2[$key] = $val;
    }
//    echo '<pre>';
//    echo var_dump($maker2);
//    echo '</pre>';

    $retrunArray['pmatrix'] = $pmatrix;
    $retrunArray['zmatrix'] = $zmatrix;
    $retrunArray['maker'] = $maker;
    $retrunArray['maker2'] = $maker2;

    return $retrunArray;
}

function timeStamp()
{
    $now = new DateTime();
    return $now->format('d-m-Y');
}

/*func to format the header of detail matrices*/
function toCustomHeader($header)
{
    switch (trim($header)) {
        case "Site":
            return 'Site-ID';
        case "SiteName";
            return 'Site-name';
        case "Mass":
            return 'M / g mol<sup>-1</sup>';
        case "Epsilon":
//            return '<span>&epsilon;</span>';
            return '<span>&epsilon;/k<sub>B</sub></span> / <span>&#8490;</span>';
        case "Sigma":
            return '<span>&sigma;</span> / <span>&#8491;</span>';
        case "Quadrupole":
            return 'Q / D<span>&#8491;</span>';
        case "Theta":
            return '<span>&Theta;</span> / <span>&#xb0;</span>';
        case "Phi":
            return '<span>&Phi;</span> / <span>&#xb0;</span>';
        case "Dipole":
            return '<span>&mu;</span> / D';
        case "Shielding":
            return $header . ' / <span>&#8491;</span>';
        case "Charge":
            return $header . ' / e';
        default:
            return $header;
    }
}

?>