<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/21/2017
 * Time: 11:32 PM
 */


//include_once '../class/enum/Sqls.php';
//include_once  '../class/enum/Config.php';
//include_once  '../class/Database.php';


function referenceMessage($masterId)
{
    $db = new Database();
    $refs = $db->selectRecords(Sqls::pm_bib_by_master_id, array($masterId));
    $Number = 0;
    $Author = 0;
    $Journal = 0;
    $Volume = 0;
    $Number = 0;
    $Pages = 0;
    $Year = 0;
    if ($refs > 0) {
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