<?

//var
$id = $master_id;
$sitetype = null;
$site = null;
$NSite = null;

//getting total sitetype
$sql = 'SELECT COUNT(b.site_type) FROM (SELECT DISTINCT a.site_type FROM pm_detail a WHERE a.master_id=' . $id . ')  b';
$q = $pdo->query($sql);
$NSiteTypes = $q->fetchColumn();

//getting  total site group by sitetype
$sql = 'SELECT COUNT(b.site) nsite,b.site_type 
FROM (SELECT DISTINCT a.site_type,a.site 
FROM pm_detail a WHERE a.master_id=' . $id . ')b 
GROUP BY b.site_type';
//get content of Number of types
foreach ($pdo->query($sql) as $row) {
    $NSite[$row['site_type']] = $row['nsite'];
}
//print content

$cout = 0;
$sql = 'SELECT * FROM pm_detail WHERE master_id =' . $id;
print "NSiteTypes" . "&nbsp;&nbsp; = " . $NSiteTypes . "\n\n";
foreach ($pdo->query($sql) as $row) {
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