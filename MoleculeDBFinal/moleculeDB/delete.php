<?php include('include/header.php') ?>
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
                <h1 class="title">Delete a Molecule </h1>
                <div class="entry">
                    <form class="form-horizontal" action="email.php?id=<?php echo $_GET['id'] ?>" method="post">
                        <p class="alert alert-error">Are you sure to delete ?
                            <?php echo "<h2>" . $_REQUEST['substance'] . "</h2>" ?></p>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button class="btn btn-success" href="mollist.php">No</button>
                        </div>
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

