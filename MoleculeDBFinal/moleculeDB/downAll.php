<?php include('include/header.php') ?>
<?php
require_once 'Vec.php';
require_once 'database.php';
require_once 'funcation/othFunc.php';
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
                <h1 class="title">Download Molecular Database of Boltzmann-Zuse Society</h1>
                <div class="entry">
                    <p>
                    <table>
                        <tr>
                            <th>
                                <b><i>ms2</i></b>
                            </th>
                            <th>:</th>
                            <td>
                                <a class="a-button"
                                   href="processDownAll.php?typ=ms2"><?php echo 'database_<i>ms2</i>.zip' ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <b>ls1 mardyn</b>
                            </th>
                            <th>
                                :
                            </th>
                            <td>
                                <a class="a-button"
                                   href="processDownAll.php?typ=ls1"><?php echo 'database_ls1_mardyn.zip' ?></a>
                            </td>
                        </tr>
                    </table>
                    </p>
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

