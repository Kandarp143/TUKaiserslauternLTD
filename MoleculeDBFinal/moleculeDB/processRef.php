<?php
require 'database.php';
$act = '';
$id = 0;
$bib_title = '';
$bib_type = '';
$redirect = '';
isset($_GET['act']) ? $act = $_GET['act'] : '';
isset($_GET['id']) ? $id = $_GET['id'] : '';

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/*
 *
 * Case 5
 * 1.if only insert new reference (if act = ins and map = false)
 * 2.if only update exsisting reference ( if act = up and map = false)
 * 3.if only map reference (if act = false and map = true)
 * 4.if only delete reference (if act = delete and map = false)
 * 4.if new molecule and new ref (if act = ins nad map = true)
 * 5.if update molecule and new ref. (still not decided)
*/

print 'POST : ';
var_dump($_POST);
print 'GET : ';
var_dump($_GET);


//if data is posted(insert or update)
if (!empty($_POST)) {
    //if map true
    if (isset($_GET['map'])) {
        if ($act == 'insert') {
//            echo 'PERFORM : NEW REFERENCE AND MAP ON' . $_GET['master_id'];
            //1.get last id from db and incr
            $result = $pdo->query("SELECT MAX(bib_key)+1 FROM pm_bib");
            $id = $result->fetchColumn();
            //2.insert records
            try {
                foreach ($_POST as $key => $val) {
                    if ($val != '' && $key != 'bib_title' && $key != 'bib_type') {
                        echo $key . '-' . $val . '<br/>';
                        $sql = "INSERT INTO pm_bib (bib_key,bib_type,bib_title,param,value) values(?, ?, ?,?,?)";
                        $q = $pdo->prepare($sql);
                        $suc = $q->execute(array($id, trim($_POST['bib_type'], " "), trim($_POST['bib_title'], " "),
                            trim($key, " "), trim($val, " ")));
                    }

                }
            } catch (Exception $e) {
                echo $e;
            }
            //3.map
            $master_id = $_GET['master_id'];
            //3.map
            $sql = 'UPDATE pm_master SET bibtex_ref_key = ' . $id . ' , bibtex_key = "' . trim($_POST['bib_type'], " ") . '" WHERE master_id =' . $master_id;
            $pdo->query($sql);
            header("Location:  moldetail.php?id=$master_id");
            $pdo = Database::disconnect();
        }

        if ($act != 'insert') {
//            echo 'PERFORM : ONLY MAP TO' . $_GET['master_id'];
            //1.get master id
            $master_id = $_GET['master_id'];
            echo $_POST['bib_key'];
            //2.devide bib key to update id , name
            $radval = explode('-', $_POST['bib_key']);
            echo $radval[0] . $radval[1];
            //3.map
            $sql = 'UPDATE pm_master SET bibtex_ref_key = ' . $radval[0] . ' , bibtex_key = "' . $radval[1] . '" WHERE master_id =' . $master_id;
            $pdo->query($sql);
            header("Location:  moldetail.php?id=$master_id");
            $pdo = Database::disconnect();
        }

    } else {
        if ($act == 'insert') {
//            echo 'PERFORM : ONLY INSERT';

            //1.get last id from db and incr
            $result = $pdo->query("SELECT MAX(bib_key)+1 FROM pm_bib");
            $id = $result->fetchColumn();
            //2.insert records
            try {
                foreach ($_POST as $key => $val) {
                    if ($val != '' && $key != 'bib_title' && $key != 'bib_type') {
                        echo $key . '-' . $val . '<br/>';
                        $sql = "INSERT INTO pm_bib (bib_key,bib_type,bib_title,param,value) values(?, ?, ?,?,?)";
                        $q = $pdo->prepare($sql);
                        $suc = $q->execute(array($id, trim($_POST['bib_type'], " "), trim($_POST['bib_title'], " "),
                            trim($key, " "), trim($val, " ")));
                    }
                    header('Location: reference.php?act=' . $act);

                }
            } catch (Exception $e) {
                echo $e;
            }


        }

        if ($act == 'update') {
            //            echo 'PERFORM : ONLY UPDATE REF' . $_GET['id'];
            //1.delete previous record
            try {
                $sql = "DELETE FROM pm_bib  WHERE bib_key = ?";
                $result = $pdo->prepare($sql);
                $result->execute(array($id));
            } catch (Exception $e) {
                echo $e;
            }
            //2.insert records
            try {
                foreach ($_POST as $key => $val) {
                    if ($val != '' && $key != 'bib_title' && $key != 'bib_type') {
                        echo $key . '-' . $val . '<br/>';
                        $sql = "INSERT INTO pm_bib (bib_key,bib_type,bib_title,param,value) values(?, ?, ?,?,?)";
                        $q = $pdo->prepare($sql);
                        $suc = $q->execute(array($id, trim($_POST['bib_type'], " "), trim($_POST['bib_title'], " "),
                            trim($key, " "), trim($val, " ")));
                    }
                    header('Location: reference.php?act=' . $act);

                }
            } catch (Exception $e) {
                echo $e;
            }

        }
    }
} else {
    if ($act == 'delete') {
//        echo 'PERFORM : ONLY DELETE REF' . $_GET['id'];;
        try {
            $sql = "DELETE FROM pm_bib  WHERE bib_key = ?";
            $result = $pdo->prepare($sql);
            $result->execute(array($id));
            header('Location: reference.php?act=' . $act);
        } catch (Exception $e) {
            echo $e;
        }
    }
}

