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
                    <?php if ($_GET['master'] != 'true') { ?>
                        <?php include('include/addmst.php') ?>
                    <?php } ?>
                    <?php
                    if ($_GET['master'] == "true") {
                        echo "<p class='suc'> Master data uploaded successfully, Now upload file  </p>";
                        //showing uploaded data
                        require 'database.php';
                        $master_id = $_GET['id'];
                        $pdo = Database::connect();
                        include('include/detheader.php');

                    } else if ($_GET['master'] == "false") {
                        echo "<p class='err' > Upload Error !  </p>";
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
                    <?php if ($_GET['master'] == 'true') { ?>
                        <?php include('include/addfile.php') ?>
                    <?php } ?>
                    <?php
                    $ans = $_GET['uploaded'];
                    if ($ans == "true") {
                        echo "<p class='suc'> File uploaded successfully  </p>";
                    } else if ($ans == "false") {
                        echo "<p class='err' > Upload Error !  </p>";
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

