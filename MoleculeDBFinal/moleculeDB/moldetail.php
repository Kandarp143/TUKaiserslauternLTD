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
                <!--                molecule header part-->
                <?php include('include/detheader.php') ?>

                <!--                molecule detail part-->
                <h1 class="title">Force Field </h1>
                <div class="entry">
                    <p>
                        <?php include('include/detmatrix.php') ?>
                    </p>
                </div>
                <!--                molecule Reference part-->
                <h1 class="title">References</h1>
                <div class="entry">
                    <p>
                        <strong>
                            <?php include('include/detfooter.php') ?>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
        <!--        <!-- end #content -->
        <!--        --><?php //if ($_SESSION['act'] == 'true') { ?>
        <!--            <div id="sidebar">-->
        <!--                <div id="sidebar-content">-->
        <!--                    <div id="sidebar-bgbtm">-->
        <!--                        <ul>-->
        <!--                            <li id="search">-->
        <!--                                <h2>Actions</h2>-->
        <!--                                <table>-->
        <!--                                    <tr>-->
        <!--                                        <td><b><a class="a-success"-->
        <!--                                                  href="update.php?id=-->
        <?php //echo $master_id ?><!--">Update</a></b></td>-->
        <!--                                        <td><b><a class="a-danger"-->
        <!--                                                  href="delete.php?id=' . -->
        <?php //echo $master_id ?><!-- . '&substance='this molecule'">Delete</a>-->
        <!--                                            </b></td>-->
        <!--                                    </tr>-->
        <!--                                </table>-->
        <!--                            </li>-->
        <!--                        </ul>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        --><?php //} ?>
        <!--        <!-- end #sidebar -->
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
