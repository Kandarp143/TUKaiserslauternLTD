<?php include('include/header.php') ?>
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Add New Molecule</h1>
                <div class="entry">
                    <!--        molecule master data-->
                    <?php if (!isset($_GET['master'])) { ?>
                        <?php include('include/addmst.php') ?>
                    <?php } ?>
                    <?php
                    if (isset($_GET['master']) && $_GET['master'] == "true") {
                        echo "<p class='suc'> Master data uploaded successfully, Now upload file  </p>";
                        //showing uploaded data
                        require 'database.php';
                        $master_id = $_GET['id'];
                        $pdo = Database::connect();
                        include('include/detheader.php');

                    } else if (isset($_GET['master']) && $_GET['master'] == "false") {
                        echo "<p class='err' > Data not uploded ! try again  </p>";
                    }
                    if (isset($_SESSION['submit_msg'])) {
                        echo $_SESSION['submit_msg'];
                        unset($_SESSION['submit_msg']);
                    }
                    ?>
                    </br></br>
                </div>
                <div class="entry">
                    <!--        molecule file upload-->
                    <?php if (isset($_GET['master']) && $_GET['master'] == 'true') {
                        include('include/addfile.php');
                    }
                    ?>
                    <?php if (isset($_GET['master']) && $_GET['master'] == 'done') {
                        $ans = isset($_GET['uploaded']) ? $_GET['uploaded'] : 'false';
                        if ($ans == "true") {
                            $master_id = isset($_GET['id']) ? $_GET['id'] : 0;
                            echo "<p class='suc'> File uploaded successfully  </p>";
                            echo '<p> No References found : <a class="a-button" href="mapref.php?id=' . $master_id . '">Add Reference</a></p>';
                        } else if ($ans == "false") {
                            echo "<p class='err' > File Upload Error ! </p>";
                        }
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

