<?php

//var
$id = $master_id;
$sitetype = null;
$site = null;
$result = null;
$NSite = null;

//getting total sitetype
$result = $db->selectRecords('SELECT COUNT(b.site_type) FROM (SELECT DISTINCT a.site_type FROM pm_detail a 
WHERE a.master_id=?)  b', array($master_id));
$NSiteTypes = $result[0][0];

//getting  total site group by sitetype
$result = $db->selectRecords('SELECT COUNT(b.site) nsite,b.site_type 
FROM (SELECT DISTINCT a.site_type,a.site 
FROM pm_detail a WHERE a.master_id= ?)b 
GROUP BY b.site_type', array($master_id));
//get content of Number of types
foreach ($result as $row) {
    $NSite[$row['site_type']] = $row['nsite'];
}
//print content

$cout = 0;
$result = $db->selectRecords('SELECT * FROM pm_detail WHERE master_id =?', array($master_id));
print "NSiteTypes" . "&nbsp;&nbsp; = " . $NSiteTypes . "\n\n";
foreach ($result as $row) {
    if ($sitetype != $row['site_type']) {
        print "\n" . "SiteType" . "   =  " . $row['site_type'] . "\n";
        print "NSites" . "   =  " . $NSite[$row['site_type']] . "\n\n";
        $sitetype = $row['site_type'];
        $cout += 1;
    }
    if ($site != $row['site']) {
        print "\n" . "# " . $row['site'] . "\n";
        $site = $row['site'];
    }

    print $row['param'] . "&nbsp;&nbsp; =  " . $row['val'] . "\n";
}
?>