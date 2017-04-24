<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/21/2017
 * Time: 9:09 AM
 */
require_once 'MyEnum.php';

class Config extends MyEnum
{

    //bplaced server
//    const  dbName = 'kpatel';
//    const  dbHost = 'localhost';
//    const  dbUsername = 'kpatel';
//    const  dbUserPassword = 'xrStwTwRjzdWAcSX';

    //localhost
    const  dbName = 'molecule_db';
    const  dbHost = 'localhost';
    const  dbUsername = 'root';
    const  dbUserPassword = 'admin';

    //email configuration
    const  mailHost = 'smtp.gmail.com';
    const  mailPort = 587;
    const  mailUsername = "er.ikndp@gmail.com";
    const  mailPassword = "godwithmeking";
    const  mailAdmin = "er.ikndp@gmail.com";
    const  mailFromName = "Admin@MoleculeDB";
    const  mailFromAddress = "Admin@MoleculeDB";
    const  mailAltBody = "Plain ! No Content, Contact Admin";


}