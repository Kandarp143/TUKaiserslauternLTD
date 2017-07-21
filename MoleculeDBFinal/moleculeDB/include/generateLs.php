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
$today = date("dmY");

/*Getting Data*/
$db = new Database();
$result = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($id));
$filename = $db->selectValue('filename', 'pm_master', 'master_id', $id);

/*file to be generate*/
$file = '../' . rootGenLS . $filename . '-' . $id . '.xml';
//needed for latest php.
touch($file);
$file = realpath($file);

//create a new xmlwriter object
$xml = new XMLWriter();
//Define File loc

$xml->openURI($file);
////using memory for string output
//$xml->openMemory();
//set the indentation to true (if false all the xml will be written on one line)
$xml->setIndent(true);
//create the document tag, you can specify the version and encoding here
$xml->startDocument('1.0', 'UTF-8');
//Create an element
//print content
$xml->startElement("components");
$xml->writeAttribute('version', $today);
$xml->startElement("moleculetype");
$xml->writeAttribute('id', 1);
$xml->writeAttribute('name', $filename);
$c = 0;
foreach ($result as $row) {
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
//echo htmlentities($xml->outputMemory());
if (!file_exists($file)) die("I'm sorry, the file doesn't seem to exist. at following location : " . $file);
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
?>