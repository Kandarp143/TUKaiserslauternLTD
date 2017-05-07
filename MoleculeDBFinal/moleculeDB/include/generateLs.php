<?php
/*
 * PHP XMLWriter - How to create a simple xml
 */
require_once '../database.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result = '';
$filename = '';
$sitecount = 0;
$tempcount = 0;

/*Getting Data*/
$db = new Database();
$result = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($id));
$filename = $db->selectValue('filename', 'pm_master', 'master_id', $id);

/*file to be generate*/
$file = '../gen/ls/' . $filename . '-' . $id . '.xml';

//create a new xmlwriter object
$xml = new XMLWriter();
//Define File loc
$xml->openURI($file);
////using memory for string output
//$xml->openMemory();
//set the indentation to true (if false all the xml will be written on one line)
$xml->setIndent(true);
//create the document tag, you can specify the version and encoding here
$xml->startDocument();
//Create an element
//print content
$xml->startElement("components");
$xml->writeAttribute('version', 20100525);
$xml->startElement("moleculetype");
$xml->writeAttribute('id', 1);
$xml->writeAttribute('name', $filename);

//for each row
foreach ($result as $row) {
    //if paramaters are cords
    if (trim($row['param']) == 'x' || trim($row['param']) == 'y' || trim($row['param']) == 'z') {
        //if new site
        if (trim($row['param']) == 'x') {
            $sitecount = $sitecount + 1;
            if ($sitecount != $tempcount) {
                $xml->endElement(); //End site
            }
            $tempcount = $sitecount;
            $xml->startElement("site");
            $xml->writeAttribute('type', $row['site_type']);
            $xml->writeAttribute('id', $sitecount);
            $xml->startElement("cords");

            $xml->setIndent(false); //make cords tag in one line
        }
        $xml->writeElement($row['param'], $row['val']);
        if (trim($row['param']) == 'z') {
            $xml->setIndent(true);
            $xml->endElement(); //End conrds
        }
        //else
    } else {
        $xml->writeElement($row['param'], $row['val']);
    }
}
$xml->endElement(); //End last site
$xml->startElement("momentsofinertia");
$xml->writeAttribute('rotaxes', 'xy');
$xml->writeElement('Ixx', '1');
$xml->writeElement('Iyy', '1');
$xml->endElement(); //End momentsofinertia
$xml->endElement(); //End moleculetype
$xml->endElement(); //End components
$xml->endDocument();
$xml->flush();
////output the xml (obviosly this output could be written to a file)
//echo htmlentities($xml->outputMemory());
if (!file_exists($file)) die("I'm sorry, the file doesn't seem to exist.");
$type = filetype($file);
// Send file headers
header("Content-type: $type");
header("Content-Disposition: attachment;filename=" . $filename . '-' . $id . '.xml');
header("Content-Transfer-Encoding: binary");
header('Pragma: no-cache');
header('Expires: 0');
// Send the file contents.
set_time_limit(0);
readfile($file);
////Generating file on the fly
//header("Content-type: text/plain");
//header("Content-Disposition: attachment; filename=" . $file);
?>