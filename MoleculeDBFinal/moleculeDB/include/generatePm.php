<?
require '../database.php';
$db = new Database();

//var
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$filename = 'Error';
$sitetype = null;
$site = null;
$NSite = null;
$result = null;


//getting file name
$filename = $db->selectValue('filename', 'pm_master', 'master_id', $id);

//Generating file on the fly
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=" . $filename . '.pm');

//getting total sitetype
$result = $db->selectRecords('SELECT COUNT(b.site_type) FROM 
(                       SELECT DISTINCT a.site_type FROM pm_detail a WHERE a.master_id= ?) b', array($id));
$NSiteTypes = $result[0][0];

//getting  total site group by sitetype

$result = $db->selectRecords('SELECT COUNT(b.site) nsite,b.site_type 
FROM (SELECT DISTINCT a.site_type,a.site 
FROM pm_detail a WHERE a.master_id= ?)b 
GROUP BY b.site_type', array($id));
//get content of Number of types
foreach ($result as $row) {
    $NSite[$row['site_type']] = $row['nsite'];
}


$cout = 1;
$result = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($id));


//print content
print  "NSiteTypes" . "\t = " . $NSiteTypes . "\n\n";
foreach ($result as $row) {
    if ($sitetype != $row['site_type']) {
        print "\n" . "SiteType" . "   =  " . $row['site_type'] . "\n";
        print  "NSites" . "   =  " . $NSite[$row['site_type']] . "\n\n";
        $sitetype = $row['site_type'];
        $cout += 1;
    }
    if ($site != $row['site']) {
        print "\n" . "# " . $row['site'] . "\n";
        $site = $row['site'];
    }

    print  $row['param'] . "\t =  " . $row['val'] . "\n";

}


//print xml


//for print content into file
$content = '';
print $content;

$pdo = Database::disconnect();
?>