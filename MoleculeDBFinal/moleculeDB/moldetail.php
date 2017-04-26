<?php include('include/header.php') ?>
<?php
require 'database.php';
require 'Vec.php';
require_once 'funcation/othFunc.php';
$master_id = $_GET['id'];
$substance = '';
$pdo = Database::connect();
?>
<!-- Design by Kandarp -->
<html>
<head>
    <?php include('include/links.php') ?>
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
                    <p><?php include('include/detmatrix.php') ?></p>
                </div>
                <!--                molecule Reference part-->
                <h1 class="title">Download Files</h1>
                <div class="entry">
                    <table>
                        <tr>
                            <th>
                                <b><i>Ms2 ----> </i></b>
                            </th>
                            <td>
                                <a class="a-button"
                                   href="generate.php?id=<?php echo $master_id ?>"><?php echo $substance ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <b>Ls1 Mardyn <i>----></i></b>
                            </th>
                            <td>
                                <a class="a-button"
                                   href="generate.php?id=<?php echo $master_id ?>"><?php echo $substance ?></a>
                            </td>
                        </tr>
                    </table>

                </div>
                <!--                molecule Reference part-->
                <h1 class="title">References</h1>
                <div class="entry">
                    <p>
                        <strong>
                            <?php echo referenceMessage($master_id) ?>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
        <?php if ($_SESSION['act'] == 'true') { ?>
            <div id="sidebar">
                <div id="sidebar-content">
                    <div id="sidebar-bgbtm">
                        <ul>
                            <li id="s">
                                <h2>Actions</h2>
                                <p style="text-align: center">
                                    <a class="a-button" href="update.php?id=<?php echo $master_id ?>">Update
                                        Molecule</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end #sidebar -->
        <?php } ?>
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
