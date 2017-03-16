<?php include('include/header.php') ?>

<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" media="screen"/>
    <style>
        table {
            max-width: 90%;
            /*width: 100% !important;*/
        }
    </style>
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
                    <?php
                    //db thing
                    include 'database.php';
                    $master_id = $_GET['id'];
                    $pdo = Database::connect();
                    $bibq = "SELECT DISTINCT bib_key,bib_type,bib_title,param,value FROM pm_bib WHERE param='title' ORDER BY `pm_bib`.`bib_key`  ASC";
                    $result = $pdo->query($bibq);
                    ?>
                    <form method="post" action="proceeRef.php?map=true&id=<?php echo $master_id ?>">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Reference</th>
                                <th>Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($result as $row) { ?>
                                <tr>
                                    <td>
                                        <?php $radval = $row['bib_key'] . '-' . $row['bib_title'] ?>
                                        <input type="radio" name="bib_key" value="<?php echo $radval ?>">
                                    </td>
                                    <td><?php echo '[ ' . $row['bib_title'] . ' ]'; ?> </td>
                                    <td><?php echo $row['value'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <button id="submit_button" name="submit_button" type="submit"> Map Reference</button>
                    </form>
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


