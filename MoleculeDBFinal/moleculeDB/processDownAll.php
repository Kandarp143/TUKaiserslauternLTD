<?php
/*
 * PHP XMLWriter - How to create a simple xml
 */
require_once 'database.php';
require_once 'FlxZipArchive.php';
require_once 'funcation/fileFunc.php';
require_once 'config.php';

$result = null;
$the_folder = '';
$zip_file_name = '';


/*Getting Data*/
$db = new Database();
$result = $db->selectRecords('SELECT DISTINCT b.filename,a.master_id,a.site_type,a.site,a.param,a.val 
FROM pm_detail a INNER JOIN pm_master b ON a.master_id=b.master_id
ORDER BY a.master_id ASC', null);


$typ = $_GET['typ'];

if ($typ === 'ms2') {                                                       /*------------ if ms2 database ---------- */
    //setting var for zip
    $the_folder = rootGenPM;
    $zip_file_name = $the_folder . 'databse_ms2.zip';
    clearDirectory($the_folder);

    /*preparation*/
    $NSiteTypes = array();
    $NSite = array();

    /*Getting NSiteType by masterId*/
    $NSiteTypesResult = $db->selectRecords('SELECT count(DISTINCT site_type),master_id 
                                          FROM pm_detail GROUP BY master_id ORDER BY master_id ASC', null);
    foreach ($NSiteTypesResult as $row)
        $NSiteTypes[$row['master_id']] = $row['count(DISTINCT site_type)'];

    /*Getting NSite by master id and site type*/
    $NSiteResult = $db->selectRecords('SELECT master_id,site_type,COUNT(DISTINCT site) 
                                          FROM pm_detail GROUP BY site_type,master_id ORDER BY master_id ASC', null);
    foreach ($NSiteResult as $row)
        $NSite[$row['master_id'] . '-' . $row['site_type']] = $row['COUNT(DISTINCT site)'];


    /*for each master_id's result*/
    $temp_master_id = 0;
    $count = 1;
    $content = null;
    $sitetype = null;
    $site = null;
    $file = '';
    foreach ($result as $row) {
        if ($row['master_id'] !== $temp_master_id) {
            $count++;
            if ($count > 2) {
                /*close previous file*/
                $pmFile = fopen($file, "w")
                or die("Unable to open file!");
                fwrite($pmFile, $content);
                fclose($pmFile);
                $content = '';
            }
            /*new molecule start file*/
            $file = $the_folder . $row['master_id'] . '-' . $row['filename'] . '.pm';
            $content = '';
            $content .= "NSiteTypes" . "   =  " . $NSiteTypes[$row['master_id']] . "\n\n";

            $temp_master_id = $row['master_id'];
        }
        /*print file content foreach*/
        if ($sitetype != $row['site_type']) {
            $content .= "\n" . "SiteType" . "   =  " . $row['site_type'] . "\n";
            $content .= "NSites" . "   =  " . $NSite[$row['master_id'] . '-' . $row['site_type']] . "\n\n";
            $sitetype = $row['site_type'];
        }
        if ($site != $row['site']) {
            $content .= "\n" . "# " . $row['site'] . "\n";
            $site = $row['site'];
        }

        $content .= $row['param'] . "  =  " . $row['val'] . "\n";
    }
    $content .= "\nNRotAxes   =   auto";

    /*last file*/
    $pmFile = fopen($file, "w")
    or die("Unable to open file!");
    fwrite($pmFile, $content);
    fclose($pmFile);

    /* Check sum all file start with NSiteTypes  */
    $files = glob($the_folder . '/*.{pm}', GLOB_BRACE);
    $checksum = true;
    foreach ($files as $file) {
//do your work her
        if (fopen($file, "r")) {
            $tmp = fopen($file, "r");
            $line = fgets($tmp);
//            echo $line;
            if (substr($line, 0, 10) != 'NSiteTypes') {
                die("There is an error ! please try after sometime.");
            }
        }
    }

} elseif ($typ === 'ls1') {                                                /*------------ if ls1 database ---------- */

    //setting var for zip
    $the_folder = rootGenLS;
    $zip_file_name = $the_folder . 'databse_ls1.zip';
    clearDirectory($the_folder);

    $temp_master_id = 0;
    $count = 1;
    foreach ($result as $row) {

        if ($row['master_id'] !== $temp_master_id) {
            $count++;
            if ($count > 2) {
                //Ending of file
                $xml->endElement(); //end last site
                $xml->startElement("momentsofinertia");
                $xml->writeAttribute('rotaxes', 'xyz');
                $xml->writeElement('Ixx', '0');
                $xml->writeElement('Iyy', '0');
                $xml->writeElement('Izz', '0');
                $xml->endElement(); //End momentsofinertia
                $xml->endElement(); //End moleculetype
                $xml->endElement(); //End components
                $xml->endDocument();
                $xml->flush();
            }
            //Starting of file
            $xml = new XMLWriter();
            $file = $the_folder . $row['master_id'] . '-' . $row['filename'] . '.xml';
            touch($file);
            $file = realpath($file);
            $xml->openURI($file);
            $xml->setIndent(true);
            $xml->startDocument('1.0', 'UTF-8');
            $xml->startElement("components");
            $xml->writeAttribute('version', date("dmY"));
            $xml->startElement("moleculetype");
            $xml->writeAttribute('id', 1);
            $xml->writeAttribute('name', $row['filename']);
            $c = 0;
            $temp_master_id = $row['master_id'];
        }
        //Element written
        if (trim($row['param']) == 'x') {
            $c += 1;
            if ($c > 1) {
                $xml->endElement();
            }
            $xml->startElement("site");
            $xml->writeAttribute('type', $row['site_type']);
            $xml->writeAttribute('id', $c);
            $xml->startElement("coords");
            $xml->setIndent(false);
            $xml->writeElement($row['param'], $row['val']);
        } else if (trim($row['param']) == 'y') {
            $xml->writeElement($row['param'], $row['val']);
        } else if (trim($row['param']) == 'z') {
            $xml->writeElement($row['param'], $row['val']);
            $xml->setIndent(true);
            $xml->endElement(); //end cord

        } else {
            if ($row['param'] != 'shielding')
                $xml->writeElement($row['param'], $row['val']);
        }
    }
    //Ending of last file
    $xml->endElement(); //end last site
    $xml->startElement("momentsofinertia");
    $xml->writeAttribute('rotaxes', 'xyz');
    $xml->writeElement('Ixx', '0');
    $xml->writeElement('Iyy', '0');
    $xml->writeElement('Izz', '0');
    $xml->endElement(); //End momentsofinertia
    $xml->endElement(); //End moleculetype
    $xml->endElement(); //End components
    $xml->endDocument();
    $xml->flush();


}


//Generate Zip
$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if ($res === TRUE) {
    $za->addDir($the_folder, basename($the_folder));
    $za->close();
} else {
    echo 'Could not create a zip archive';
}

////download prompt
header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename='.$zip_file_name.'");
header('Content-Length: ' . filesize($zip_file_name));
header("Location:" . $zip_file_name);
?>