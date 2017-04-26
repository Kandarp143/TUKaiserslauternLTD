<?php include('include/header.php') ?>
<?php
require 'database.php';
require 'Vec.php';
$master_id = $_GET['id'];
$pdo = Database::connect();
?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Available References</h1>
                <div class="entry">
                    <?php
                    //variable decl
                    $finalArry = array();
                    $Author = "";
                    $Journal = "";
                    $Volume = "";
                    $Number = "";
                    $Pages = "";
                    $Year = "";
                    $bib_title = "";
                    $bib_type = "";
                    $tit = "";

                    //db thing
                    $bibq = "SELECT DISTINCT pm_bib.bib_key,pm_bib.bib_type,pm_bib.bib_title,pm_bib.param,pm_bib.value FROM pm_bib ;";
                    $result = $pdo->query($bibq);

                    //assign initial id temp
                    //                    foreach ($result as $row) {
                    //                        $oldid = $row['bib_key'];
                    //                        break;
                    //                    }
                    $oldid = 0;
                    if ($result->rowCount() > 0) {
                        foreach ($result as $row) {
                            $id = $row['bib_key'];
                            echo 'Value :' . $id;
                            //array insert
                            if ($oldid != $id) {
                                array_push($finalArry, array(
                                    "bib_key" => $oldid,
                                    "bib_type" => $bib_type,
                                    "bib_title" => $bib_title,
                                    "tit" => $tit,
                                    "Author" => $Author,
                                    "Journal" => $Journal,
                                    "Volume" => $Volume,
                                    "Number" => $Number,
                                    "Pages" => $Pages,
                                    "Year" => $Year
                                ));
                                echo 'Add to Array' . $oldid . '</br>';
                                $oldid = $id;
                            }

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
                        foreach ($finalArry as $ele) {
                            echo $ele['bib_key'] . ' : ' . $ele['tit'] . '<br/>';
                        }
                    } else {
                        echo '<p> No References found</p>';

                    }


                    ?>
                </div>
            </div>
        </div>
        <!-- end #content -->
        <div style="clear:both; margin:0;"></div>
    </div>
    <!-- end #page -->
</div>
<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>
<?php
$pdo = Database::disconnect();
?>
