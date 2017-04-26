<?php include('include/header.php') ?>
<?php include('include/fetchref.php') ?>

<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"
          media="screen"/>
    <!--javascript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
</head>
<body>
<div id="wrapper">

    <?php include('include/nav.php') ?>


    <div id="page">

        <?php
        if (isset($_GET['act'])) {
            if ($_GET['act'] == 'insert') {
                echo '<p  style="color: green;text-align: center">' . 'Reference Successfully Inserted' . '</p>';
            } else if ($_GET['act'] == 'update') {
                echo '<p style="color: green;text-align: center">' . 'Reference Successfully Updated' . '</p>';
            } else if ($_GET['act'] == 'delete') {
                echo '<p  style="color: green;text-align: center">' . 'Reference Successfully Deleted' . '</p>';
            }
        }
        ?>
        <div style="width: 98%;margin: 0 auto;">
            <table id="example" class="display" cellspacing="0" width="95%">

                <thead>
                <tr>
                    <th nowrap>Reference</th>
                    <th>Author : Title,Journal,Volume,Number,Page(Year)</th>
                    <?php
                    if ($_SESSION['act'] == 'true') { ?>
                        <th> Action</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($references as $r) {
                    if ($r != null) {
                        $vol = '';
                        $jou = '';
                        $num = '';
                        $pg = '';
                        $year = '';
                        $ath = '';
                        $tit = '';

                        if (isset($r['Volume'])) {
                            $vol = $r['Volume'];
                        }
                        if (isset($r['Journal'])) {
                            $jou = $r['Journal'];
                        }
                        if (isset($r['Number'])) {
                            $num = $r['Number'];
                        }
                        if (isset($r['Pages'])) {
                            $pg = $r['Pages'];
                        }
                        if (isset($r['Year'])) {
                            $year = $r['Year'];
                        }
                        if (isset($r['Author'])) {
                            $ath = $r['Author'];
                        }
                        if (isset($r['Title'])) {
                            $tit = $r['Title'];
                        }
                        ?>
                        <tr>
                            <td nowrap><?php echo '[' . $r['bib_title'] . ']'; ?> </td>
                            <td><?php
                                echo $ath . ' : '
                                    . $tit . ', ' . $jou . $vol . ', '
                                    . $num . ', ' . $pg . ' (' . $year . ')';
                                ?></td>
                            <?php
                            if ($_SESSION['act'] == 'true') {

                                echo '<td><a class="a-success"  href="addref.php?id=' . $r['id'] . '&act=update">Update</a><br/>';
                                echo '<a  class="a-danger" href="addref.php?id=' . $r['id'] . '&act=delete">Delete</a>';
                                echo '</td>';
                            } ?>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
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




