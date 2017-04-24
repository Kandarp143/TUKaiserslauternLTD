<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/21/2017
 * Time: 12:23 PM
 */
class Sqls extends MyEnum
{
    const  insert_pm_master = 'INSERT INTO pm_master (filename,cas_no,name,bibtex_ref_key,bibtex_key,bibtex_year,model_type,memory_loc,description,type) 
                VALUES (?,?,?,?,?,?,?,?,?,?)';
    const  insert_pm_detail = 'INSERT INTO pm_detail (master_id,site_type,site,param,val) values(?, ?, ?,?,?)';
    /*returns molecule master record by master id */
    const  pm_master_by_master_id =
        'SELECT DISTINCT * FROM pm_master WHERE master_id =?';

    const pm_master = 'SELECT master_id,  filename,cas_no,name,model_type,type,bibtex_key FROM pm_master';

    /*returns referance of that molecule by master id*/
    const pm_bib_by_master_id =
        'SELECT DISTINCT pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value 
          FROM pm_bib INNER JOIN pm_master on pm_master.bibtex_ref_key=pm_bib.bib_key 
          WHERE pm_master.master_id =?';

    /*returns detail data of molecule*/
    const pm_datail_by_master_id =
        'SELECT * FROM pm_detail WHERE master_id =?';

    /*returns list of sitetype with count of site by master id (ex . 2 , LJ126)*/
    const  pm_master_siteType_with_count_by_master_id =
        'SELECT COUNT(b.site) nsite,b.site_type 
          FROM ( SELECT DISTINCT a.site_type,a.site FROM pm_detail a WHERE a.master_id=?) b 
          GROUP BY b.site_type';

    const  pm_master_paramAndval_by_siteType_and_masterId =
        'SELECT  param,val from pm_detail where site_type =  ?  and master_id=?';

    const  user_acc_by_userId_and_pass =
        'SELECT DISTINCT * FROM usr_access WHERE usr_id = ? and usr_pass = ?';
}