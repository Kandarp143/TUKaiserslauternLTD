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
        <div id="content">
            <div class="post">
                <h1 class="title">Available References</h1>
                <div class="entry">

                    <form method="post" action="processRef.php?map=true&master_id=<?php echo $master_id ?>">
                        <table id="example" class="display" cellspacing="0" width="100%">

                            <thead>
                            <tr>
                                <th>Select</th>
                                <th nowrap>Reference</th>
                                <th>Title</th>
                                <!--                                <th>Action</th>-->
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
                                    ?>
                                    <tr>
                                        <td>
                                            <?php $radval = $r['id'] . '-' . $r['bib_title'] ?>
                                            <input type="radio" name="bib_key" value="<?php echo $radval ?>">
                                        </td>
                                        <td nowrap><?php echo '[ ' . $r['bib_title'] . ' ]'; ?> </td>
                                        <td><?php
                                            echo $r['Author'] . ' : '
                                                . $r['Title'] . ', ' . $jou . $vol . ', '
                                                . $num . ', ' . $pg . ' (' . $year . ')';
                                            ?></td>
                                        <?php
                                        //                                        if ($_SESSION['act'] == 'true') {
                                        //
                                        //                                            echo '<td><a class="a-success"  href="addref.php?id=' . $r['id'] . '&act=update">Update</a><br/>';
                                        //                                            echo '<a  class="a-danger" href="addref.php?id=' . $r['id'] . '&act=delete">Delete</a>';
                                        //                                            echo '</td>';
                                        //                                        } ?>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                        <button id="submit_button" name="submit_button" type="submit"> Map Reference</button>
                    </form>
                </div>
            </div>

            <!-- end #content -->
        </div>
        <div id="sidebar">
            <div id="sidebar-content">
                <div id="sidebar-bgbtm">
                    <ul>

                        <li id="search">
                            <h2>Add New Reference</h2>
                            <p style="text-align: center">
                                <a class="a-button"
                                   href="addref.php?map=true&master_id=<?php echo $master_id ?>&act=insert">Click
                                    Here</a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end #sidebar -->
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


